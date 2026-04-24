<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $siswaAktif = Peminjaman::where('status', 'dipinjam')->distinct('siswa_id')->count('siswa_id');
        
        $totalKoleksi = Buku::sum('stok');
        $totalJudul = Buku::count();
        $bukuDipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $bukuTersedia = $totalKoleksi; // Stok in DB is already current stock

        $totalKategori = Kategori::count();

        $bukuTerpopuler = Peminjaman::with('buku')
            ->select('buku_id', \Illuminate\Support\Facades\DB::raw('count(*) as total_pinjam'))
            ->groupBy('buku_id')
            ->orderByDesc('total_pinjam')
            ->limit(5)
            ->get();

        return view('welcome', compact(
            'totalSiswa', 
            'siswaAktif', 
            'totalKoleksi', 
            'totalJudul',
            'bukuTersedia', 
            'bukuDipinjam', 
            'totalKategori',
            'bukuTerpopuler'
        ));
    }
}
