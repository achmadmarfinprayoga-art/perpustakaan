<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function denda(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        // Ambil data peminjaman yang memiliki denda (yang sudah dibayar / belum namun denda > 0)
        $peminjamans = Peminjaman::with(['siswa', 'buku'])
            ->where(function($q) {
                $q->where('denda', '>', 0)
                  ->orWhere('is_paid', true);
            })
            ->whereMonth('tanggal_kembali', $bulan)
            ->whereYear('tanggal_kembali', $tahun)
            ->latest('tanggal_kembali')
            ->get();

        $totalDendaBulanIni = $peminjamans->where('is_paid', true)->sum('denda');
        $totalDendaBelumDibayar = $peminjamans->where('is_paid', false)->sum('denda');

        $totalKeseluruhan = Peminjaman::where('is_paid', true)->sum('denda');

        // Untuk Chart/Summary bulanan denda dibayar
        $summaryBulanan = Peminjaman::select(
                DB::raw('MONTH(tanggal_kembali) as bulan'),
                DB::raw('SUM(denda) as total')
            )
            ->whereYear('tanggal_kembali', $tahun)
            ->where('is_paid', true)
            ->where('denda', '>', 0)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        $arrBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return view('laporan.denda', compact('peminjamans', 'bulan', 'tahun', 'totalDendaBulanIni', 'totalDendaBelumDibayar', 'totalKeseluruhan', 'summaryBulanan', 'arrBulan'));
    }
}
