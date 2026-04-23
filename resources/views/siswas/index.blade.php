@extends('layout.master')

@section('header', 'Data Siswa')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 md:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Master Data Siswa</h1>
                <p class="text-slate-500 text-sm mt-1">Kelola informasi dan data lengkap siswa terdaftar.</p>
            </div>
            <a href="/tambahsiswa"
                class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 active:scale-95">
                <i class="fas fa-plus mr-2"></i> Tambah Siswa
            </a>
        </div>

        <!-- Filter & Search Section -->
        <div class="mb-8 bg-slate-50/50 rounded-2xl p-4 border border-slate-200/60">
            <form action="/siswa" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-search"></i>
                    </div>
                    <input type="text" name="search" value="{{ $search }}" 
                        class="block w-full pl-10 pr-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all" 
                        placeholder="Cari Nama atau NIS...">
                </div>
                
                <div class="w-full md:w-48">
                    <select name="kelas" class="block w-full px-3 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                        <option value="">Semua Kelas</option>
                        <option value="X RPL 1" {{ $kelas == 'X RPL 1' ? 'selected' : '' }}>X RPL 1</option>
                        <option value="X RPL 2" {{ $kelas == 'X RPL 2' ? 'selected' : '' }}>X RPL 2</option>
                        <option value="X DKV 1" {{ $kelas == 'X DKV 1' ? 'selected' : '' }}>X DKV 1</option>
                        <option value="X DKV 2" {{ $kelas == 'X DKV 2' ? 'selected' : '' }}>X DKV 2</option>
                        <option value="X BD 1" {{ $kelas == 'X BD 1' ? 'selected' : '' }}>X BD 1</option>
                        <option value="X BD 2" {{ $kelas == 'X BD 2' ? 'selected' : '' }}>X BD 2</option>
                        <option value="X TKJ 1" {{ $kelas == 'X TKJ 1' ? 'selected' : '' }}>X TKJ 1</option>
                        <option value="XI RPL 1" {{ $kelas == 'XI RPL 1' ? 'selected' : '' }}>XI RPL 1</option>
                        <option value="XI RPL 2" {{ $kelas == 'XI RPL 2' ? 'selected' : '' }}>XI RPL 2</option>
                        <option value="XI DKV 1" {{ $kelas == 'XI DKV 1' ? 'selected' : '' }}>XI DKV 1</option>
                        <option value="XI DKV 2" {{ $kelas == 'XI DKV 2' ? 'selected' : '' }}>XI DKV 2</option>
                        <option value="XI BD 1" {{ $kelas == 'XI BD 1' ? 'selected' : '' }}>XI BD 1</option>
                        <option value="XI BD 2" {{ $kelas == 'XI BD 2' ? 'selected' : '' }}>XI BD 2</option>
                        <option value="XI TKJ 1" {{ $kelas == 'XI TKJ 1' ? 'selected' : '' }}>XI TKJ 1</option>
                        <option value="XII RPL 1" {{ $kelas == 'XII RPL 1' ? 'selected' : '' }}>XII RPL 1</option>
                        <option value="XII RPL 2" {{ $kelas == 'XII RPL 2' ? 'selected' : '' }}>XII RPL 2</option>
                        <option value="XII DKV 1" {{ $kelas == 'XII DKV 1' ? 'selected' : '' }}>XII DKV 1</option>
                        <option value="XII DKV 2" {{ $kelas == 'XII DKV 2' ? 'selected' : '' }}>XII DKV 2</option>
                        <option value="XII BD 1" {{ $kelas == 'XII BD 1' ? 'selected' : '' }}>XII BD 1</option>
                        <option value="XII BD 2" {{ $kelas == 'XII BD 2' ? 'selected' : '' }}>XII BD 2</option>
                        <option value="XII TKJ 1" {{ $kelas == 'XII TKJ 1' ? 'selected' : '' }}>XII TKJ 1</option>
                    </select>
                </div>
                
                <button type="submit" class="px-5 py-2.5 bg-slate-800 text-white font-medium rounded-xl hover:bg-slate-900 transition-all active:scale-95">
                    Filter
                </button>
                @if($search || $kelas)
                    <a href="/siswa" class="px-5 py-2.5 bg-slate-200 text-slate-600 font-medium rounded-xl hover:bg-slate-300 transition-all text-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div>
            @if ($siswas->count() > 0)
                <div class="overflow-x-auto border border-slate-200/60 rounded-2xl">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="tracking-wide border-b border-slate-200/60 bg-slate-50/50 text-slate-500">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold w-16 text-center">No</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Nama Lengkap</th>
                                <th scope="col" class="px-6 py-4 font-semibold">NIS</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Kelas</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Jurusan</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center w-40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($siswas as $siswa)
                                <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                    <th scope="row" class="px-6 py-4 font-medium text-slate-400 text-center">
                                        {{ $loop->iteration }}</th>
                                    <td class="px-6 py-4 font-medium text-slate-800">{{ $siswa->nama }}</td>
                                    <td class="px-6 py-4 text-slate-500">{{ $siswa->nis }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">{{ $siswa->kelas }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">{{ $siswa->jurusan }}</td>

                                    <td class="px-6 py-4 flex justify-center gap-2">
                                        <a href="/siswa/{{ $siswa->id }}/edit"
                                            class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center hover:bg-amber-500 hover:text-white transition-all duration-200"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="/siswa/{{ $siswa->id }}" method="POST"
                                            data-confirm="Apakah Anda yakin ingin menghapus data siswa ini? Semua riwayat peminjaman siswa ini juga akan terpengaruh."
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
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-700 mb-1">Belum ada data siswa</h3>
                    <p class="text-slate-500 mb-4 text-sm">Tambahkan data siswa pertama Anda ke dalam sistem.</p>
                    <a href="/tambahsiswa"
                        class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 text-slate-600 font-medium rounded-lg hover:bg-slate-50 transition-colors">
                        Tambah Data
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
