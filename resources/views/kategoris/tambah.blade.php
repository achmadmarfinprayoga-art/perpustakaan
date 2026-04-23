@extends('layout.master')

@section('header', 'Tambah Kategori')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-200/60 p-8 max-w-2xl mx-auto">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-800">Tambah Kategori</h2>
            <p class="text-slate-500 text-sm mt-1">Lengkapi form di bawah ini untuk membuat kategori buku baru.</p>
        </div>

        <form action="/kategori" method="POST" data-confirm="Simpan kategori buku baru ini?" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="nama_kategori" class="block text-sm font-bold text-slate-700">Nama Kategori</label>
                <input type="text" name="nama_kategori" id="nama_kategori"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                    placeholder="Masukkan nama kategori" required>
            </div>

            <div class="space-y-2">
                <label for="keterangan" class="block text-sm font-bold text-slate-700">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="4"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                    placeholder="Masukkan keterangan/deskripsi kategori"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="/kategori"
                    class="px-6 py-3 bg-slate-100 text-slate-600 font-semibold rounded-xl hover:bg-slate-200 transition-all duration-300">Batal</a>
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 active:scale-95">Simpan
                    Data</button>
            </div>
        </form>
    </div>
@endsection
