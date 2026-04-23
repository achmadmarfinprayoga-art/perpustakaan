@extends('layout.master')

@section('header', 'Tambah Peminjaman')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-200/60 p-8 max-w-2xl mx-auto">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-800">Catat Peminjaman Baru</h2>
            <p class="text-slate-500 text-sm mt-1">Isi detail di bawah ini untuk mencatat sirkulasi peminjaman buku.</p>
        </div>

        <form action="/peminjaman" method="POST" data-confirm="Lanjutkan mencatat peminjaman ini?" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="siswa_id" class="block text-sm font-bold text-slate-700">Siswa</label>
                    <div class="relative">
                        <select name="siswa_id" id="siswa_id"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 appearance-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium h-[50px]"
                            required>
                            <option value="">Pilih Siswa</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}">{{ $siswa->nama }} - {{ $siswa->kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="buku_id" class="block text-sm font-bold text-slate-700">Judul Buku</label>
                    <div class="relative">
                        <select name="buku_id" id="buku_id"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 appearance-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium h-[50px]"
                            required>
                            <option value="">Pilih Buku</option>
                            @foreach ($bukus as $buku)
                                <option value="{{ $buku->id }}">{{ $buku->judul }} (Stok: {{ $buku->stok }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="tanggal_pinjam" class="block text-sm font-bold text-slate-700">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ date('Y-m-d') }}"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        required>
                </div>
                
                <div class="space-y-2">
                    <label for="batas_pengembalian" class="block text-sm font-bold text-slate-700">Batas Pengembalian</label>
                    <input type="date" name="batas_pengembalian" id="batas_pengembalian"
                        value="{{ date('Y-m-d', strtotime('+7 days')) }}"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium">
                    <p class="text-xs text-slate-500">Abaikan jika ingin menggunakan default 7 hari.</p>
                </div>

                <div class="space-y-2">
                    <label for="status" class="block text-sm font-bold text-slate-700">Status Awal</label>
                    <div class="relative">
                        <select name="status" id="status"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 appearance-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium h-[50px]"
                            required>
                            <option value="dipinjam">Dipinjam</option>
                            <option value="dikembalikan">Dikembalikan</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="/peminjaman"
                    class="px-6 py-3 bg-slate-100 text-slate-600 font-semibold rounded-xl hover:bg-slate-200 transition-all duration-300">Batal</a>
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 active:scale-95">Simpan
                    Data</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect("#siswa_id",{
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
            new TomSelect("#buku_id",{
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    </script>
@endsection
