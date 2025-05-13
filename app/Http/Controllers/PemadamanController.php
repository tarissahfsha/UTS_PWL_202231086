<?php

namespace App\Http\Controllers;  

use App\Models\Pemadaman;
use App\Models\Wilayah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PemadamanController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        if ($search) {
            $pemadamans = Pemadaman::with('wilayah')
                ->whereHas('wilayah', function($query) use ($search) {
                    $query->where('nama_wilayah', 'like', '%' . $search . '%')
                        ->orWhere('kelurahan', 'like', '%' . $search . '%');
                })
                ->latest()
                ->paginate(10);
        } else {
            $pemadamans = Pemadaman::with('wilayah')->latest()->paginate(10);
        }

        return view('pemadaman.index', compact('pemadamans'));
    }

    public function create(): View
    {
        $wilayahs = Wilayah::all();
        return view('pemadaman.create', compact('wilayahs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'wilayah_id' => 'required|exists:wilayahs,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'jenis_pemadaman' => 'required|in:terencana,mendadak',
            'alasan' => 'required|min:10',
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
        ]);

        Pemadaman::create([
            'wilayah_id' => $request->wilayah_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'jenis_pemadaman' => $request->jenis_pemadaman,
            'alasan' => $request->alasan,
            'status' => $request->status,
        ]);

        return redirect()->route('pemadaman.index')->with(['success' => 'Jadwal Pemadaman Berhasil Ditambahkan']);
    }

    public function show(string $id): View
    {
        $pemadaman = Pemadaman::with('wilayah')->findOrFail($id);
        return view('pemadaman.show', compact('pemadaman'));
    }

    public function edit(string $id): View
    {
        $pemadaman = Pemadaman::findOrFail($id);
        $wilayahs = Wilayah::all();
        return view('pemadaman.edit', compact('pemadaman', 'wilayahs'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'wilayah_id' => 'required|exists:wilayahs,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'jenis_pemadaman' => 'required|in:terencana,mendadak',
            'alasan' => 'required|min:10',
            'status' => 'required|in:scheduled,ongoing,completed,cancelled',
        ]);

        $pemadaman = Pemadaman::findOrFail($id);

        $pemadaman->update([
            'wilayah_id' => $request->wilayah_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'jenis_pemadaman' => $request->jenis_pemadaman,
            'alasan' => $request->alasan,
            'status' => $request->status,
        ]);

        return redirect()->route('pemadaman.index')->with(['success' => 'Jadwal Pemadaman Berhasil Diubah']);
    }

    public function destroy($id): RedirectResponse
    {
        $pemadaman = Pemadaman::findOrFail($id);
        $pemadaman->delete();

        return redirect()->route('pemadaman.index')->with(['success' => 'Jadwal Pemadaman Berhasil Dihapus']);
    }

    // Untuk halaman publik (tanpa login)
    public function publicIndex()
    {
        $wilayahs = Wilayah::all();
        return view('public.index', compact('wilayahs'));
    }

    public function cekPemadaman($wilayah_id)
{
    $wilayah = Wilayah::find($wilayah_id);

    if ($wilayah) {
        // Mengambil pemadaman untuk wilayah yang dipilih
        // Yang saat ini dan akan datang (tidak menampilkan yang sudah selesai)
        $pemadamans = $wilayah->pemadamans()
            ->whereDate('tanggal', '>=', now()->toDateString())  // Mulai hari ini dan seterusnya
            ->whereIn('status', ['scheduled', 'ongoing'])  // Hanya yang terjadwal atau sedang berlangsung
            ->orderBy('tanggal', 'asc')  // Urutkan dari tanggal terdekat
            ->orderBy('jam_mulai', 'asc')  // Kemudian urutkan dari jam paling awal
            ->get();

        return response()->json($pemadamans);
    }

    return response()->json([], 404);
}
}