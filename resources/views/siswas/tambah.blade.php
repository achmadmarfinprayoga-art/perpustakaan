@extends('layout.master')

@section('header', 'Tambah Siswa')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/40 border border-slate-200/60 p-8 max-w-2xl mx-auto">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-800">Tambah Siswa</h2>
            <p class="text-slate-500 text-sm mt-1">Lengkapi form di bawah ini untuk menambahkan data siswa baru.</p>
        </div>

        <form action="/siswa" method="POST" data-confirm="Apakah data siswa sudah benar dan siap disimpan?" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="nama" class="block text-sm font-bold text-slate-700">Nama Siswa</label>
                <input type="text" name="nama" id="nama"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                    placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="space-y-2">
                <label for="nis" class="block text-sm font-bold text-slate-700">NIS</label>
                <input type="text" name="nis" id="nis"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                    placeholder="Masukkan NIS (Nomor Induk Siswa)" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="kelas" class="block text-sm font-bold text-slate-700">Kelas</label>
                    <select name="kelas" id="kelas"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        required>
                        <option value="" disabled selected>Pilih Kelas</option>
                        <option value="X RPL 1">X RPL 1</option>
                        <option value="X RPL 2">X RPL 2</option>
                        <option value="X DKV 1">X DKV 1</option>
                        <option value="X DKV 2">X DKV 2</option>
                        <option value="X BD 1">X BD 1</option>
                        <option value="X BD 2">X BD 2</option>
                        <option value="X TKJ 1">X TKJ 1</option>
                        <option value="XI RPL 1">XI RPL 1</option>
                        <option value="XI RPL 2">XI RPL 2</option>
                        <option value="XI DKV 1">XI DKV 1</option>
                        <option value="XI DKV 2">XI DKV 2</option>
                        <option value="XI BD 1">XI BD 1</option>
                        <option value="XI BD 2">XI BD 2</option>
                        <option value="XI TKJ 1">XI TKJ 1</option>
                        <option value="XII RPL 1">XII RPL 1</option>
                        <option value="XII RPL 2">XII RPL 2</option>
                        <option value="XII DKV 1">XII DKV 1</option>
                        <option value="XII DKV 2">XII DKV 2</option>
                        <option value="XII BD 1">XII BD 1</option>
                        <option value="XII BD 2">XII BD 2</option>
                        <option value="XII TKJ 1">XII TKJ 1</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="jurusan" class="block text-sm font-bold text-slate-700">Jurusan</label>
                    <select name="jurusan" id="jurusan"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all font-medium"
                        required>
                        <option value="" disabled selected>Pilih Jurusan</option>
                        <option value="RPL">RPL (Rekayasa Perangkat Lunak)</option>
                        <option value="TKJ">TKJ (Teknik Komputer Jaringan)</option>
                        <option value="BD">BD (Bisnis Digital)</option>
                        <option value="DKV">DKV (Desain Komunikasi Visual)</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="/siswa"
                    class="px-6 py-3 bg-slate-100 text-slate-600 font-semibold rounded-xl hover:bg-slate-200 transition-all duration-300">Batal</a>
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 active:scale-95">Simpan
                    Data</button>
            </div>
        </form>
    </div>
@endsection
