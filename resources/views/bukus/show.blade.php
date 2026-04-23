@extends('layout.master')

@section('header', 'Detail Buku')

@section('content')
    <div class="mb-6">
        <a href="/buku" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Buku
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 p-6 md:p-10 relative overflow-hidden">
        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-indigo-50/50 blur-3xl pointer-events-none"></div>

        <div class="flex flex-col lg:flex-row gap-10 relative z-10">
            <!-- Left Side: Cover Image -->
            <div class="w-full lg:w-1/3 flex-shrink-0">
                <div class="w-full aspect-[3/4] bg-slate-100 rounded-2xl overflow-hidden shadow-lg border border-slate-200 flex items-center justify-center group relative">
                    @if($buku->cover)
                        <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover {{ $buku->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="flex flex-col items-center text-slate-400">
                            <i class="fas fa-book-open text-6xl mb-4"></i>
                            <span class="text-sm font-medium">Tidak ada cover</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 ring-1 ring-inset ring-black/10 rounded-2xl"></div>
                </div>
                
                <div class="mt-6 flex flex-col gap-3">
                    <a href="/buku/{{ $buku->id }}/edit" class="w-full py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-center transition-colors flex items-center justify-center">
                        <i class="fas fa-edit mr-2"></i> Edit Data Buku
                    </a>
                </div>
            </div>

            <!-- Right Side: Details -->
            <div class="w-full lg:w-2/3">
                <div class="mb-8">
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-bold uppercase tracking-wider border border-indigo-100 flex items-center shadow-sm">
                            <i class="fas fa-tag mr-1.5 opacity-70"></i> {{ $buku->kategori ? $buku->kategori->nama_kategori : 'Tanpa Kategori' }}
                        </span>
                        @if ($buku->stok > 0)
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-xs font-bold shadow-sm border border-emerald-100">
                                <i class="fas fa-check-circle mr-1 opacity-70"></i> Stok Tersedia ({{ $buku->stok }})
                            </span>
                        @else
                            <span class="px-3 py-1 bg-rose-50 text-rose-600 rounded-lg text-xs font-bold shadow-sm border border-rose-100 uppercase">
                                <i class="fas fa-times-circle mr-1 opacity-70"></i> Stok Habis
                            </span>
                        @endif
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight mb-2">{{ $buku->judul }}</h1>
                    <p class="text-lg text-slate-500 font-medium flex items-center">
                        <i class="fas fa-pen-nib w-6 text-slate-400"></i> Karya {{ $buku->penulis }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <div class="bg-slate-50/80 rounded-2xl p-5 border border-slate-100 space-y-4">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Penerbit</p>
                            <p class="font-semibold text-slate-800">{{ $buku->penerbit ?? 'Tidak disertakan' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Tahun Terbit</p>
                            <p class="font-semibold text-slate-800">{{ $buku->tahun_terbit }}</p>
                        </div>
                    </div>
                    
                    <div class="bg-slate-50/80 rounded-2xl p-5 border border-slate-100 space-y-4">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">ISBN</p>
                            <p class="font-semibold text-slate-800 font-mono">{{ $buku->isbn ?? 'Tidak ada ISBN' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Lokasi Rak</p>
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-indigo-100 text-indigo-700 rounded-lg font-bold text-sm">
                                <i class="fas fa-box"></i> {{ $buku->rak ?? 'Belum ditentukan' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-200/60 pt-8">
                    <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-indigo-500 mr-2"></i> Informasi Tambahan
                    </h3>
                    <p class="text-slate-600 leading-relaxed text-sm lg:text-base">
                        Buku <strong>{{ $buku->judul }}</strong> ditulis oleh <strong>{{ $buku->penulis }}</strong> dan diterbitkan pada tahun <strong>{{ $buku->tahun_terbit }}</strong> 
                        @if($buku->penerbit) oleh <strong>{{ $buku->penerbit }}</strong> @endif. 
                        Buku ini dikategorikan ke dalam <strong>{{ $buku->kategori ? $buku->kategori->nama_kategori : 'Kategori Umum' }}</strong>. 
                        Saat ini jumlah stok fisik yang tersedia di perpustakaan adalah <strong>{{ $buku->stok }} exemplar</strong>
                        @if($buku->rak) yang ditempatkan pada rak <strong>{{ $buku->rak }}</strong> @endif.
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection
