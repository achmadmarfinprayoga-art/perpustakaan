@extends('layout.master')

@section('header', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <!-- Card: Total Siswa -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100 flex items-center hover:shadow-md transition-shadow">
            <div class="p-4 rounded-xl bg-indigo-50 text-indigo-600 mr-4">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div>
                <p class="mb-1 text-sm font-medium text-slate-500">Total Siswa</p>
                <p class="text-2xl font-bold text-slate-800">{{ $totalSiswa }}</p>
                <p class="text-xs text-indigo-600 mt-1 font-medium">{{ $siswaAktif }} Aktif Meminjam</p>
            </div>
        </div>

        <!-- Card: Total Buku -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100 flex items-center hover:shadow-md transition-shadow">
            <div class="p-4 rounded-xl bg-green-50 text-green-600 mr-4">
                <i class="fas fa-book-open text-2xl"></i>
            </div>
            <div>
                <p class="mb-1 text-sm font-medium text-slate-500">Koleksi Buku</p>
                <div class="flex items-baseline mb-1">
                    <p class="text-2xl font-bold text-slate-800 mr-2">{{ $totalJudul }}</p>
                    <p class="text-sm font-medium text-slate-500">Judul</p>
                </div>
                <p class="text-xs text-green-600 font-medium">{{ $totalKoleksi }} Eksemplar</p>
            </div>
        </div>

        <!-- Card: Kategori -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100 flex items-center hover:shadow-md transition-shadow">
            <div class="p-4 rounded-xl bg-amber-50 text-amber-600 mr-4">
                <i class="fas fa-tags text-2xl"></i>
            </div>
            <div>
                <p class="mb-1 text-sm font-medium text-slate-500">Kategori</p>
                <p class="text-2xl font-bold text-slate-800">{{ $totalKategori }}</p>
                <p class="text-xs text-amber-600 mt-1 font-medium">Klasifikasi</p>
            </div>
        </div>

        <!-- Card: Buku Tersedia -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100 flex items-center hover:shadow-md transition-shadow font-inter">
            <div class="p-4 rounded-xl bg-emerald-50 text-emerald-600 mr-4">
                <i class="fas fa-check-circle text-2xl"></i>
            </div>
            <div>
                <p class="mb-1 text-sm font-medium text-slate-500">Buku Tersedia</p>
                <p class="text-2xl font-bold text-slate-800">{{ $bukuTersedia }}</p>
                <p class="text-xs text-emerald-600 mt-1 font-medium">Siap Dipinjam</p>
            </div>
        </div>

        <!-- Card: Buku Dipinjam -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100 flex items-center hover:shadow-md transition-shadow">
            <div class="p-4 rounded-xl bg-rose-50 text-rose-600 mr-4">
                <i class="fas fa-bookmark text-2xl"></i>
            </div>
            <div>
                <p class="mb-1 text-sm font-medium text-slate-500">Sedang Dipinjam</p>
                <p class="text-2xl font-bold text-slate-800">{{ $bukuDipinjam }}</p>
                <p class="text-xs text-rose-600 mt-1 font-medium">Di Tangan Siswa</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Selamat Datang di Halaman Admin</h3>
        <p class="text-gray-600">Gunakan menu di samping untuk mengelola data siswa, buku, kategori, dan transaksi
            peminjaman pada sistem perpustakaan.</p>
    </div>
@endsection
