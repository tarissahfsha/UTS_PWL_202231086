<?php

namespace App\Http\Controllers;

use App\Models\Pemadaman;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk dashboard
        $totalWilayah = Wilayah::count();
        $pemadamanHariIni = Pemadaman::today()->count();
        $pemadamanBulanIni = Pemadaman::whereMonth('tanggal', now()->month)
                                    ->whereYear('tanggal', now()->year)
                                    ->count();
        $pemadamanAktif = Pemadaman::where('status', 'ongoing')->count();

        // Data untuk grafik pemadaman per bulan (6 bulan terakhir)
        $chartData = Pemadaman::select(
                DB::raw('MONTH(tanggal) as month'),
                DB::raw('YEAR(tanggal) as year'),
                DB::raw('COUNT(*) as total')
            )
            ->where('tanggal', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($item) {
                $date = Carbon::createFromDate($item->year, $item->month, 1);
                return [
                    'month' => $date->format('M Y'),
                    'total' => $item->total
                ];
            });

        // Data untuk pie chart jenis pemadaman
        $jenisPemadaman = Pemadaman::select('jenis_pemadaman', DB::raw('COUNT(*) as total'))
            ->groupBy('jenis_pemadaman')
            ->get()
            ->map(function ($item) {
                return [
                    'jenis' => ucfirst($item->jenis_pemadaman),
                    'total' => $item->total
                ];
            });

        // Data untuk bar chart pemadaman per wilayah (top 10)
        $pemadamanPerWilayah = Pemadaman::select(
                'wilayah_id',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, jam_mulai, jam_selesai)) as total_menit')
            )
            ->with('wilayah')
            ->groupBy('wilayah_id')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'wilayah' => $item->wilayah->kelurahan,
                    'total' => $item->total,
                    'durasi' => round($item->total_menit / 60, 1) // convert to hours
                ];
            });

        // Pemadaman mendatang
        $upcomingPemadaman = Pemadaman::with('wilayah')
            ->where('status', 'scheduled')
            ->where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'totalWilayah',
            'pemadamanHariIni',
            'pemadamanBulanIni',
            'pemadamanAktif',
            'chartData',
            'jenisPemadaman',
            'pemadamanPerWilayah',
            'upcomingPemadaman'
        ));
    }
}