@extends('layout.master')

@section('header', 'Data Buku')

@section('content')
@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 md:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Master Data Buku</h1>
                <p class="text-slate-500 text-sm mt-1">Kelola katalog buku, stok, dan informasi relasinya.</p>
            </div>
            <a href="/tambahbuku"
                class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 active:scale-95">
                <i class="fas fa-plus mr-2"></i> Tambah Buku
            </a>
        </div>

        <!-- Filter & Search Section -->
        <div class="mb-8 bg-slate-50/50 rounded-2xl p-4 border border-slate-200/60">
            <form action="/buku" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" name="search" value="{{ $search }}" 
                        class="block w-full pl-10 pr-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all" 
                        placeholder="Cari Judul Buku...">
                </div>
                
                <div class="w-full md:w-48">
                    <select name="kategori_id" class="block w-full px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ $kategori_id == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="px-5 py-2.5 bg-slate-800 text-white font-medium rounded-xl hover:bg-slate-900 transition-all active:scale-95">
                    Filter
                </button>
                @if($search || $kategori_id)
                    <a href="/buku" class="px-5 py-2.5 bg-slate-200 text-slate-600 font-medium rounded-xl hover:bg-slate-300 transition-all text-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div>
            @if ($bukus->count() > 0)
                <div class="overflow-x-auto border border-slate-200/60 rounded-2xl">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="tracking-wide border-b border-slate-200/60 bg-slate-50/50 text-slate-500">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold w-16 text-center">No</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Buku</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Kategori</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Rak</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center">Stok</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center w-40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($bukus as $buku)
                                <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                    <th scope="row" class="px-6 py-4 font-medium text-slate-400 text-center">
                                        {{ $loop->iteration }}</th>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-14 bg-slate-100 rounded-lg overflow-hidden flex-shrink-0 border border-slate-200 shadow-sm">
                                                @if($buku->cover)
                                                    <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                                                        <i class="fas fa-book text-xs"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-800">{{ $buku->judul }}</div>
                                                <div class="text-[11px] text-slate-500 mt-1 uppercase tracking-wider">{{ $buku->penulis }} · {{ $buku->tahun_terbit }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-xs font-semibold bg-indigo-50 text-indigo-600 border border-indigo-100">
                                            {{ $buku->kategori ? $buku->kategori->nama_kategori : '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-slate-700">Rak: {{ $buku->rak ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($buku->stok > 0)
                                            <div class="text-sm font-bold text-slate-800">{{ $buku->stok }} <span class="text-[10px] font-medium text-slate-400">Pcs</span></div>
                                        @else
                                            <span class="px-2 py-0.5 bg-rose-50 text-rose-600 text-[10px] font-bold rounded uppercase">Habis</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 flex justify-center gap-2">
                                        <a href="/buku/{{ $buku->id }}"
                                            class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center hover:bg-indigo-500 hover:text-white transition-all duration-200"
                                            title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="/buku/{{ $buku->id }}/edit"
                                            class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center hover:bg-amber-500 hover:text-white transition-all duration-200"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="/buku/{{ $buku->id }}" method="POST"
                                            data-confirm="Apakah Anda yakin ingin menghapus buku ini dari katalog?"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all duration-200"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
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
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-700 mb-1">Belum ada data buku</h3>
                    <p class="text-slate-500 mb-4 text-sm">Tambahkan data buku pertama Anda ke dalam sistem.</p>
                    <a href="/tambahbuku"
                        class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 text-slate-600 font-medium rounded-lg hover:bg-slate-50 transition-colors">
                        Tambah Data
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
