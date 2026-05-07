
@extends('layout.master')

@section('header', 'Edit Buku')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-200/60 p-8 max-w-2xl mx-auto">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-800">Edit Data Buku</h2>
            <p class="text-slate-500 text-sm mt-1">Perbarui informasi detail buku di bawah ini.</p>
        </div>

        <form action="/buku/{{ $buku->id }}" method="POST" enctype="multipart/form-data" data-confirm="Simpan perubahan data buku ini?" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="judul" class="block text-sm font-bold text-slate-700">Judul Buku</label>
                <input type="text" name="judul" id="judul" value="{{ $buku->judul }}"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                    required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="penulis" class="block text-sm font-bold text-slate-700">Penulis</label>
                    <input type="text" name="penulis" id="penulis" value="{{ $buku->penulis }}"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        required>
                </div>

                <div class="space-y-2">
                    <label for="penerbit" class="block text-sm font-bold text-slate-700">Penerbit</label>
                    <input type="text" name="penerbit" id="penerbit" value="{{ $buku->penerbit }}"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="tahun_terbit" class="block text-sm font-bold text-slate-700">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ $buku->tahun_terbit }}"
                        min="1900" max="2099"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        required>
                </div>

                <div class="space-y-2">
                    <label for="kategori_id" class="block text-sm font-bold text-slate-700">Kategori</label>
                    <div class="relative">
                        <select name="kategori_id" id="kategori_id"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 appearance-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium h-[50px]" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ $buku->kategori_id == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="stok" class="block text-sm font-bold text-slate-700">Stok</label>
                    <input type="number" name="stok" id="stok" value="{{ $buku->stok }}" min="0"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        required>
                </div>

                <div class="space-y-2">
                    <label for="rak" class="block text-sm font-bold text-slate-700">Lokasi Rak</label>
                    <input type="text" name="rak" id="rak" value="{{ $buku->rak }}"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        placeholder="Contoh: A-01">
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-bold text-slate-700">Sampul Buku</label>
                <div class="flex items-start gap-6 bg-slate-50 p-4 rounded-2xl border border-slate-200">
                    <div class="w-24 h-32 bg-white rounded-lg border border-slate-200 overflow-hidden flex-shrink-0 shadow-sm">
                        @if($buku->cover)
                            <img src="{{ asset('storage/' . $buku->cover) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <i class="fas fa-image text-2xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <label for="cover" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Ganti Sampul</label>
                        <input type="file" name="cover" id="cover" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <p class="mt-2 text-xs text-slate-400">Format: PNG, JPG, GIF (Max 2MB)</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="/buku"
                    class="px-6 py-3 bg-slate-100 text-slate-600 font-semibold rounded-xl hover:bg-slate-200 transition-all duration-300">Batal</a>
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 active:scale-95">Update
                    Data</button>
            </div>
        </form>
    </div>
@endsection
