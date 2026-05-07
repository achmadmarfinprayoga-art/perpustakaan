@extends('layout.master')

@section('header', 'Tambah Buku')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-200/60 p-8 max-w-2xl mx-auto">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-800">Tambah Buku Baru</h2>
            <p class="text-slate-500 text-sm mt-1">Lengkapi form di bawah ini untuk menambahkan koleksi buku baru.</p>
        </div>

        <form action="/buku" method="POST" enctype="multipart/form-data" data-confirm="Apakah data buku sudah benar dan siap disimpan?" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="judul" class="block text-sm font-bold text-slate-700">Judul Buku</label>
                <input type="text" name="judul" id="judul"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                    placeholder="Masukkan judul buku lengkap" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="penulis" class="block text-sm font-bold text-slate-700">Penulis</label>
                    <input type="text" name="penulis" id="penulis"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        placeholder="Nama Penulis" required>
                </div>

                <div class="space-y-2">
                    <label for="penerbit" class="block text-sm font-bold text-slate-700">Penerbit</label>
                    <input type="text" name="penerbit" id="penerbit"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        placeholder="Nama Penerbit">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="tahun_terbit" class="block text-sm font-bold text-slate-700">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" id="tahun_terbit" min="1900" max="2099"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        placeholder="Contoh: 2023" required>
                </div>

                <div class="space-y-2">
                    <label for="kategori_id" class="block text-sm font-bold text-slate-700">Kategori</label>
                    <div class="relative">
                        <select name="kategori_id" id="kategori_id"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 appearance-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium h-[50px]" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
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
                    <label for="stok" class="block text-sm font-bold text-slate-700">Stok Awal</label>
                    <input type="number" name="stok" id="stok" min="0" value="1"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        required>
                </div>

                <div class="space-y-2">
                    <label for="rak" class="block text-sm font-bold text-slate-700">Lokasi Rak</label>
                    <input type="text" name="rak" id="rak"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        placeholder="Contoh: A-01">
                </div>
            </div>

            <div class="space-y-2">
                <label for="cover" class="block text-sm font-bold text-slate-700">Sampul Buku</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-xl hover:border-indigo-400 transition-colors cursor-pointer bg-slate-50">
                    <div class="space-y-1 text-center">
                        <i class="fas fa-image text-slate-400 text-3xl mb-2"></i>
                        <div class="flex text-sm text-slate-600">
                            <label for="cover" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Upload a file</span>
                                <input id="cover" name="cover" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-slate-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="/buku"
                    class="px-6 py-3 bg-slate-100 text-slate-600 font-semibold rounded-xl hover:bg-slate-200 transition-all duration-300">Batal</a>
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 active:scale-95">Simpan
                    Data</button>
            </div>
        </form>
    </div>
@endsection
