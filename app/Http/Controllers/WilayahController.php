<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WilayahController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');

        if ($search) {
            $wilayahs = Wilayah::where('nama_wilayah', 'like', '%' . $search . '%')
                ->orWhere('kelurahan', 'like', '%' . $search . '%')
                ->orWhere('kecamatan', 'like', '%' . $search . '%')
                ->latest()
                ->paginate(10);
        } else {
            $wilayahs = Wilayah::latest()->paginate(10);
        }

        return view('wilayah.index', compact('wilayahs'));
    }

    public function create(): View
    {
        return view('wilayah.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_wilayah' => 'required|min:3',
            'kode_wilayah' => 'required|unique:wilayahs,kode_wilayah',
            'kecamatan' => 'required|min:3',
            'kelurahan' => 'required|min:3',
        ]);

        Wilayah::create([
            'nama_wilayah' => $request->nama_wilayah,
            'kode_wilayah' => $request->kode_wilayah,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
        ]);

        return redirect()->route('wilayah.index')->with(['success' => 'Data Wilayah Berhasil Ditambahkan']);
    }

    public function show(string $id): View
    {
        $wilayah = Wilayah::with('pemadamans')->findOrFail($id);
        return view('wilayah.show', compact('wilayah'));
    }

    public function edit(string $id): View
    {
        $wilayah = Wilayah::findOrFail($id);
        return view('wilayah.edit', compact('wilayah'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nama_wilayah' => 'required|min:3',
            'kode_wilayah' => 'required|unique:wilayahs,kode_wilayah,' . $id,
            'kecamatan' => 'required|min:3',
            'kelurahan' => 'required|min:3',
        ]);

        $wilayah = Wilayah::findOrFail($id);

        $wilayah->update([
            'nama_wilayah' => $request->nama_wilayah,
            'kode_wilayah' => $request->kode_wilayah,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
        ]);

        return redirect()->route('wilayah.index')->with(['success' => 'Data Wilayah Berhasil Diubah']);
    }

    public function destroy($id): RedirectResponse
    {
        $wilayah = Wilayah::findOrFail($id);
        
        // Cek apakah ada pemadaman yang terkait
        if ($wilayah->pemadamans()->count() > 0) {
            return redirect()->route('wilayah.index')
                ->with(['error' => 'Tidak dapat menghapus wilayah yang memiliki jadwal pemadaman']);
        }
        
        $wilayah->delete();

        return redirect()->route('wilayah.index')->with(['success' => 'Data Wilayah Berhasil Dihapus']);
    }
}