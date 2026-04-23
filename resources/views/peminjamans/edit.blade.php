@extends('layout.master')

@section('header', 'Edit Peminjaman')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-200/60 p-8 max-w-2xl mx-auto">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-800">Validasi Peminjaman</h2>
            <p class="text-slate-500 text-sm mt-1">Ubah status atau detail peminjaman buku.</p>
        </div>

        <form action="/peminjaman/{{ $peminjaman->id ?? '' }}" method="POST" data-confirm="Simpan perubahan sirkulasi ini?" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="siswa_id" class="block text-sm font-bold text-slate-700">Siswa</label>
                    <div class="relative">
                        <select name="siswa_id" id="siswa_id"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 appearance-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium h-[50px]"
                            required>
                            <option value="">Pilih Siswa</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}"
                                    {{ ($peminjaman->siswa_id ?? '') == $siswa->id ? 'selected' : '' }}>{{ $siswa->nama }}
                                    -
                                    {{ $siswa->kelas }}</option>
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
                                <option value="{{ $buku->id }}"
                                    {{ ($peminjaman->buku_id ?? '') == $buku->id ? 'selected' : '' }}>{{ $buku->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="tanggal_pinjam" class="block text-sm font-bold text-slate-700">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                        value="{{ $peminjaman->tanggal_pinjam ?? '' }}"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        required>
                </div>
                
                <div class="space-y-2">
                    <label for="batas_pengembalian" class="block text-sm font-bold text-slate-700">Batas Pengembalian</label>
                    <input type="date" name="batas_pengembalian" id="batas_pengembalian"
                        value="{{ $peminjaman->batas_pengembalian ?? '' }}"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium">
                </div>

                <div class="space-y-2">
                    <label for="status" class="block text-sm font-bold text-slate-700">Status Peminjaman</label>
                    <div class="relative">
                        <select name="status" id="status"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 appearance-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium h-[50px]"
                            required>
                            <option value="dipinjam" {{ ($peminjaman->status ?? '') == 'dipinjam' ? 'selected' : '' }}>
                                Dipinjam
                            </option>
                            <option value="dikembalikan"
                                {{ ($peminjaman->status ?? '') == 'dikembalikan' ? 'selected' : '' }}>
                                Dikembalikan</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="denda" class="block text-sm font-bold text-slate-700">Denda (Rp)</label>
                    <div class="relative">
                        <input type="number" name="denda" id="denda" value="{{ $peminjaman->denda ?? 0 }}"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                            placeholder="0">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                            @php
                                $hariTerlambat = 0;
                                if ($peminjaman->status == 'dipinjam') {
                                    $batas = \Carbon\Carbon::parse($peminjaman->batas_pengembalian);
                                    $sekarang = \Carbon\Carbon::now()->startOfDay();
                                    $hariTerlambat = $sekarang->greaterThan($batas) ? $sekarang->diffInDays($batas) : 0;
                                } else {
                                    $batas = \Carbon\Carbon::parse($peminjaman->batas_pengembalian);
                                    $kembali = \Carbon\Carbon::parse($peminjaman->tanggal_kembali);
                                    $hariTerlambat = $kembali->greaterThan($batas) ? $kembali->diffInDays($batas) : 0;
                                }
                            @endphp
                            @if($hariTerlambat > 0)
                                <span class="text-[10px] font-bold text-red-500 bg-red-50 px-2 py-1 rounded">
                                    {{ $hariTerlambat }} Hari Terlambat
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-2 mt-2 pt-4 border-t border-slate-100">
                <label for="tanggal_kembali" class="block text-sm font-bold text-slate-700">Catat Pengembalian</label>
                <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                    value="{{ $peminjaman->tanggal_kembali ?? '' }}"
                    class="w-full sm:w-1/2 bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium">
                <p class="text-xs text-indigo-500 mt-2 font-medium bg-indigo-50 inline-block px-3 py-1 rounded-md mb-2">
                    Kosongkan jika buku belum dikembalikan! (Isi bagian ini saat akan mengubah status menjadi Dikembalikan)
                </p>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-slate-100 mt-6">
                <a href="/peminjaman"
                    class="px-6 py-3 bg-slate-100 text-slate-600 font-semibold rounded-xl hover:bg-slate-200 transition-all duration-300">Batal</a>
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 active:scale-95">Update
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
