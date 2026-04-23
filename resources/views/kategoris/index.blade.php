@extends('layout.master')

@section('header', 'Data Kategori')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 md:p-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Master Data Kategori</h1>
                <p class="text-slate-500 text-sm mt-1">Kelola kategori untuk mengklasifikasikan buku.</p>
            </div>
            <a href="/tambahkategori"
                class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 active:scale-95">
                <i class="fas fa-plus mr-2"></i> Tambah Kategori
            </a>
        </div>

        <div>
            @if ($kategoris->count() > 0)
                <div class="overflow-x-auto border border-slate-200/60 rounded-2xl">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="tracking-wide border-b border-slate-200/60 bg-slate-50/50 text-slate-500">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold w-16 text-center">No</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Nama Kategori</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Keterangan</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center w-40">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($kategoris as $kategori)
                                <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                    <th scope="row" class="px-6 py-4 font-medium text-slate-400 text-center">
                                        {{ $loop->iteration }}</th>
                                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $kategori->nama_kategori }}</td>
                                    <td class="px-6 py-4 text-slate-500 whitespace-normal min-w-[200px]">
                                        {{ $kategori->keterangan }}</td>
                                    <td class="px-6 py-4 flex justify-center gap-2">
                                        <a href="/kategori/{{ $kategori->id }}/edit"
                                            class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center hover:bg-amber-500 hover:text-white transition-all duration-200"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="/kategori/{{ $kategori->id }}" method="POST"
                                            data-confirm="Apakah Anda yakin ingin menghapus kategori ini? Buku yang terhubung ke kategori ini mungkin akan terpengaruh."
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
                        <i class="fas fa-bookmark"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-700 mb-1">Belum ada data kategori</h3>
                    <p class="text-slate-500 mb-4 text-sm">Tambahkan kategori pertama Anda ke dalam sistem.</p>
                    <a href="/tambahkategori"
                        class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 text-slate-600 font-medium rounded-lg hover:bg-slate-50 transition-colors">
                        Tambah Kategori
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
