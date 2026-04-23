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

        return view('welcome', compact(
            'totalSiswa', 
            'siswaAktif', 
            'totalKoleksi', 
            'totalJudul',
            'bukuTersedia', 
            'bukuDipinjam', 
            'totalKategori'
        ));
    }
}
