@extends('layout.master')

@section('header', 'Data Peminjaman')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 md:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Sirkulasi Peminjaman</h1>
                <p class="text-slate-500 text-sm mt-1">Kelola data peminjaman buku dan pengembalian.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 items-center w-full md:w-auto">
                <form action="/peminjaman" method="GET" class="relative w-full sm:w-64">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama siswa/judul buku..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-all duration-300">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i class="fas fa-search text-slate-400"></i>
                    </div>
                </form>
                <a href="/tambahpeminjaman"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 active:scale-95 shrink-0">
                    <i class="fas fa-handshake mr-2"></i> Pinjam Buku
                </a>
            </div>
        </div>

        <!-- Statistics & Filters -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200/60 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-red-100 text-red-600 flex items-center justify-center text-xl">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Terlambat</div>
                    <div class="text-xl font-bold text-slate-800">{{ $totalTerlambat }} <span class="text-xs font-normal text-slate-500">Siswa</span></div>
                </div>
            </div>
            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200/60 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Denda</div>
                    <div class="text-xl font-bold text-slate-800">Rp{{ number_format($totalDenda, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <div class="flex gap-2 mb-6 p-1.5 bg-slate-100 rounded-2xl w-fit">
            <a href="/peminjaman" class="px-5 py-2 rounded-xl text-sm font-bold transition-all {{ !$status ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                Semua
            </a>
            <a href="/peminjaman?status=dipinjam" class="px-5 py-2 rounded-xl text-sm font-bold transition-all {{ $status == 'dipinjam' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                Dipinjam
            </a>
            <a href="/peminjaman?status=dikembalikan" class="px-5 py-2 rounded-xl text-sm font-bold transition-all {{ $status == 'dikembalikan' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                Selesai
            </a>
            <a href="/peminjaman?terlambat=1" class="px-5 py-2 rounded-xl text-sm font-bold transition-all {{ request('terlambat') ? 'bg-white text-rose-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                Lihat Terlambat
            </a>
        </div>

        <div>
            @if ($peminjamans->count() > 0)
                <div class="overflow-x-auto border border-slate-200/60 rounded-2xl">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="tracking-wide border-b border-slate-200/60 bg-slate-50/50 text-slate-500">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-bold w-16 text-center">No</th>
                                <th scope="col" class="px-6 py-4 font-bold">INFO PEMINJAMAN</th>
                                <th scope="col" class="px-6 py-4 font-bold">WAKTU & STATUS</th>
                                <th scope="col" class="px-6 py-4 font-bold text-center">KEUANGAN</th>
                                <th scope="col" class="px-6 py-4 font-bold text-center w-36">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($peminjamans as $p)
                                <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                    <th scope="row" class="px-6 py-4 font-medium text-slate-400 text-center">{{ $loop->iteration }}</th>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-14 bg-slate-200 rounded-lg overflow-hidden flex-shrink-0 border border-slate-300">
                                                @if($p->buku?->cover)
                                                    <img src="{{ asset('storage/' . $p->buku->cover) }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                                                        <i class="fas fa-book text-xs"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-black text-slate-800 uppercase tracking-tight">{{ $p->siswa?->nama ?? '-' }}</div>
                                                <div class="text-[11px] text-indigo-600 font-bold mt-1 flex items-center gap-1">
                                                    <i class="fas fa-book-reader"></i>
                                                    {{ $p->buku?->judul ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col gap-1.5">
                                            <div class="flex items-center gap-2">
                                                @if ($p->hari_terlambat > 0 && $p->status === 'dipinjam')
                                                    <span class="px-2 py-0.5 rounded text-[10px] font-black bg-rose-600 text-white uppercase italic">Terlambat</span>
                                                @elseif ($p->status === 'dipinjam')
                                                    <span class="px-2 py-0.5 rounded text-[10px] font-black bg-amber-500 text-white uppercase">Aktif</span>
                                                @else
                                                    <span class="px-2 py-0.5 rounded text-[10px] font-black bg-emerald-500 text-white uppercase">Selesai</span>
                                                @endif
                                                <span class="text-xs font-bold text-slate-600">{{ $p->tanggal_pinjam }}</span>
                                            </div>
                                            @if($p->status === 'dipinjam')
                                                <div class="text-[10px] text-slate-400 flex items-center gap-1 font-bold">
                                                    <i class="fas fa-hourglass-half"></i> Batas: {{ $p->batas_pengembalian ?? '-' }}
                                                </div>
                                            @else
                                                <div class="text-[10px] text-emerald-600 flex items-center gap-1 font-bold">
                                                    <i class="fas fa-calendar-check"></i> Kembali: {{ $p->tanggal_kembali ?? '-' }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($p->estimasi_denda > 0)
                                            <div class="font-black text-lg {{ $p->is_paid ? 'text-slate-300 line-through' : 'text-rose-600' }} tracking-tighter">
                                                Rp{{ number_format($p->estimasi_denda, 0, ',', '.') }}
                                            </div>
                                            @if(!$p->is_paid && $p->status === 'dipinjam')
                                                <div class="text-[10px] text-slate-400 font-bold mt-1">{{ $p->hari_terlambat }} Hari</div>
                                            @elseif($p->is_paid)
                                                <span class="px-2 py-0.5 bg-emerald-100 text-emerald-600 text-[10px] font-black rounded uppercase">Dibayar</span>
                                            @endif
                                        @else
                                            <span class="px-2 py-0.5 bg-slate-100 text-slate-400 text-[10px] font-black rounded uppercase">Bebas Denda</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col gap-2 justify-center items-center h-full">
                                            @if ($p->status === 'dipinjam')
                                                <form action="/peminjaman/{{ $p->id }}/kembalikan" method="POST"
                                                    data-confirm="Siswa sudah mengembalikan buku?" class="w-full">
                                                    @csrf
                                                    <button type="submit"
                                                        class="w-full px-3 py-2 rounded-xl bg-indigo-600 text-white text-[11px] font-bold flex items-center justify-center hover:bg-slate-800 transition-all duration-300 shadow-sm"
                                                        title="Kembalikan Buku">
                                                        <i class="fas fa-undo mr-1.5 flex-shrink-0"></i> Kembalikan
                                                    </button>
                                                </form>
                                                @if($p->estimasi_denda > 0 && !$p->is_paid)
                                                <form action="/peminjaman/{{ $p->id }}/bayar-denda" method="POST" class="w-full mt-1">
                                                    @csrf
                                                    <button type="submit"
                                                        class="w-full px-3 py-2 rounded-xl bg-emerald-600 text-white text-[11px] font-bold flex items-center justify-center hover:bg-emerald-700 transition-all duration-300 shadow-sm"
                                                        title="Bayar Denda">
                                                        <i class="fas fa-money-bill-wave mr-1.5 flex-shrink-0"></i> Bayar Denda
                                                    </button>
                                                </form>
                                                @endif
                                            @elseif ($p->status === 'dikembalikan' && !$p->is_paid && $p->denda > 0)
                                                <form action="/peminjaman/{{ $p->id }}/bayar-denda" method="POST" class="w-full">
                                                    @csrf
                                                    <button type="submit"
                                                        class="w-full px-3 py-2 rounded-xl bg-emerald-600 text-white text-[11px] font-bold flex items-center justify-center hover:bg-emerald-700 transition-all duration-300 shadow-sm"
                                                        title="Bayar Denda">
                                                        <i class="fas fa-money-bill-wave mr-1.5 flex-shrink-0"></i> Bayar Denda
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <div class="flex gap-2 w-full mt-1">
                                                <a href="/peminjaman/{{ $p->id }}/edit"
                                                    class="flex-1 py-1.5 rounded-lg bg-slate-100 text-slate-600 text-[10px] font-bold flex items-center justify-center hover:bg-slate-200 transition-all duration-300"
                                                    title="Edit">
                                                    <i class="fas fa-pen-nib mr-1"></i> Edit
                                                </a>
                                                <form action="/peminjaman/{{ $p->id }}" method="POST"
                                                    data-confirm="Hapus data transaksi secara permanen?"
                                                    class="flex-1 inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full py-1.5 rounded-lg bg-rose-50 text-rose-600 text-[10px] font-bold flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all duration-300"
                                                        title="Hapus">
                                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="mt-8 border-2 border-dashed border-slate-200 rounded-3xl p-12 text-center bg-slate-50/50">
                    <div
                        class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400 text-2xl">
                        <i class="fas fa-hand-holding"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-700 mb-1">Belum ada data sirkulasi</h3>
                    <p class="text-slate-500 mb-4 text-sm">Catat peminjaman buku pertama Anda ke dalam sistem.</p>
                    <a href="/tambahpeminjaman"
                        class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 text-slate-600 font-medium rounded-lg hover:bg-slate-50 transition-colors">
                        Pinjam Buku
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
