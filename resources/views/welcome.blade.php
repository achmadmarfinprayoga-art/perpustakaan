@extends('layout.master')

@section('header', 'Dashboard')

@section('content')
    <!-- Aksi Cepat -->
    <div class="mb-8">
        <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
            <i class="fas fa-bolt text-amber-500"></i> Aksi Cepat
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="/tambahpeminjaman" class="bg-indigo-600 text-white p-5 rounded-2xl shadow-sm hover:shadow-lg hover:shadow-indigo-500/30 hover:-translate-y-1 transition-all duration-300 flex flex-col items-center justify-center gap-3 border border-indigo-500">
                <i class="fas fa-handshake text-3xl opacity-90"></i>
                <span class="text-sm font-bold text-center">Pinjam Baru</span>
            </a>
            <a href="/peminjaman?status=dipinjam" class="bg-emerald-500 text-white p-5 rounded-2xl shadow-sm hover:shadow-lg hover:shadow-emerald-500/30 hover:-translate-y-1 transition-all duration-300 flex flex-col items-center justify-center gap-3 border border-emerald-400">
                <i class="fas fa-undo-alt text-3xl opacity-90"></i>
                <span class="text-sm font-bold text-center">Pengembalian</span>
            </a>
            <a href="/tambahsiswa" class="bg-amber-500 text-white p-5 rounded-2xl shadow-sm hover:shadow-lg hover:shadow-amber-500/30 hover:-translate-y-1 transition-all duration-300 flex flex-col items-center justify-center gap-3 border border-amber-400">
                <i class="fas fa-user-plus text-3xl opacity-90"></i>
                <span class="text-sm font-bold text-center">Tambah Anggota</span>
            </a>
            <a href="/buku" class="bg-rose-500 text-white p-5 rounded-2xl shadow-sm hover:shadow-lg hover:shadow-rose-500/30 hover:-translate-y-1 transition-all duration-300 flex flex-col items-center justify-center gap-3 border border-rose-400">
                <i class="fas fa-boxes text-3xl opacity-90"></i>
                <span class="text-sm font-bold text-center">Cek Stok Buku</span>
            </a>
        </div>
    </div>

    <!-- Ringkasan Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
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
    </div>

    <!-- Area Widget Report -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Buku Terpopuler -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col h-full">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <i class="fas fa-fire text-orange-500"></i> Buku Terpopuler
                </h3>
                <a href="/buku" class="text-sm text-indigo-600 font-semibold hover:underline">Lihat Semua</a>
            </div>
            
            <div class="flex-1">
                @if($bukuTerpopuler->count() > 0)
                    <div class="space-y-4">
                        @foreach($bukuTerpopuler as $index => $item)
                        <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold {{ $index == 0 ? 'bg-amber-100 text-amber-600' : ($index == 1 ? 'bg-slate-200 text-slate-600' : ($index == 2 ? 'bg-orange-100 text-orange-600' : 'bg-slate-100 text-slate-400')) }}">
                                #{{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-slate-800 truncate">{{ $item->buku->judul ?? 'Buku Tidak Diketahui' }}</h4>
                                <p class="text-xs text-slate-500">{{ $item->buku->penulis ?? '-' }} • {{ $item->buku->penerbit ?? '-' }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-black text-indigo-600">{{ $item->total_pinjam }}x</div>
                                <div class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Dipinjam</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center h-full py-8 text-slate-400">
                        <i class="fas fa-book-reader text-4xl mb-3 opacity-50"></i>
                        <p class="text-sm">Belum ada riwayat peminjaman.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Chart Ketersediaan -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col h-full">
            <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <i class="fas fa-chart-pie text-indigo-500"></i> Persentase Ketersediaan
            </h3>
            <div class="flex-1 flex flex-col justify-center items-center relative">
                <div class="w-48 h-48 relative">
                    <canvas id="ketersediaanChart"></canvas>
                </div>
                <div class="w-full mt-8 space-y-3">
                    <div class="flex justify-between items-center text-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                            <span class="text-slate-600 font-medium">Tersedia</span>
                        </div>
                        <span class="font-bold text-slate-800">{{ $bukuTersedia }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-rose-400"></span>
                            <span class="text-slate-600 font-medium">Dipinjam</span>
                        </div>
                        <span class="font-bold text-slate-800">{{ $bukuDipinjam }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('ketersediaanChart').getContext('2d');
            const dataTersedia = {{ $bukuTersedia }};
            const dataDipinjam = {{ $bukuDipinjam }};
            
            // Handle empty state
            const isZero = (dataTersedia === 0 && dataDipinjam === 0);
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Tersedia', 'Dipinjam'],
                    datasets: [{
                        data: isZero ? [1] : [dataTersedia, dataDipinjam],
                        backgroundColor: isZero ? ['#cbd5e1'] : ['#34d399', '#fb7185'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: !isZero }
                    }
                }
            });
        });
    </script>
@endsection
