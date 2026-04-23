@extends('layout.master')

@section('header', 'Edit Siswa')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-200/60 p-8 max-w-2xl mx-auto">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-800">Edit Data Siswa</h2>
            <p class="text-slate-500 text-sm mt-1">Perbarui informasi data siswa di bawah ini.</p>
        </div>

        <form action="/siswa/{{ $siswa->id ?? '' }}" method="POST" data-confirm="Simpan perubahan data siswa ini?" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="nama" class="block text-sm font-bold text-slate-700">Nama Siswa</label>
                <input type="text" name="nama" id="nama" value="{{ $siswa->nama ?? '' }}"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                    required>
            </div>

            <div class="space-y-2">
                <label for="nis" class="block text-sm font-bold text-slate-700">NIS</label>
                <input type="text" name="nis" id="nis" value="{{ $siswa->nis ?? '' }}"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                    required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="kelas" class="block text-sm font-bold text-slate-700">Kelas</label>
                    <select name="kelas" id="kelas"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        required>
                        <option value="X" {{ (isset($siswa) && $siswa->kelas == 'X') ? 'selected' : '' }}>X</option>
                        <option value="XI" {{ (isset($siswa) && $siswa->kelas == 'XI') ? 'selected' : '' }}>XI</option>
                        <option value="XII" {{ (isset($siswa) && $siswa->kelas == 'XII') ? 'selected' : '' }}>XII</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="jurusan" class="block text-sm font-bold text-slate-700">Jurusan</label>
                    <select name="jurusan" id="jurusan"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        required>
                        <option value="RPL" {{ (isset($siswa) && $siswa->jurusan == 'RPL') ? 'selected' : '' }}>RPL (Rekayasa Perangkat Lunak)</option>
                        <option value="TKJ" {{ (isset($siswa) && $siswa->jurusan == 'TKJ') ? 'selected' : '' }}>TKJ (Teknik Komputer Jaringan)</option>
                        <option value="BD" {{ (isset($siswa) && $siswa->jurusan == 'BD') ? 'selected' : '' }}>BD (Bisnis Digital)</option>
                        <option value="DKV" {{ (isset($siswa) && $siswa->jurusan == 'DKV') ? 'selected' : '' }}>DKV (Desain Komunikasi Visual)</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="/siswa"
                    class="px-6 py-3 bg-slate-100 text-slate-600 font-semibold rounded-xl hover:bg-slate-200 transition-all duration-300">Batal</a>
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 active:scale-95">Update
                    Data</button>
            </div>
        </form>
    </div>
@endsection
