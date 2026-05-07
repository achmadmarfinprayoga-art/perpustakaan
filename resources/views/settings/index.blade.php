@extends('layout.master')

@section('header', 'Pengaturan Sistem')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200/60 dark:border-slate-800 overflow-hidden transition-colors duration-300">
            <div class="p-6 md:p-8 border-b border-slate-100 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-800/30 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 dark:text-white">Pengaturan Perpustakaan</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-1"> manajemen biaya denda.</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="fas fa-sliders-h"></i>
                </div>
            </div>

            <form action="/settings" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
                @csrf
                @method('PUT')

                <div class="space-y-10">
                    
                    <!-- Area Tema & Tampilan -->
                    <section>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-4 pb-2 border-b border-slate-100 dark:border-slate-800 flex items-center">
                            <i class="fas fa-palette text-indigo-500 w-6"></i> Pengaturan Tema & Tampilan
                        </h3>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Warna Utama (Primary Color)</label>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 mb-3">Pilih warna utama yang akan digunakan untuk menu navigasi, tombol utama, dan aksen keseluruhan aplikasi.</p>
                                <div class="flex items-center gap-4">
                                    <input type="color" name="warna_utama" value="{{ $settings['warna_utama'] ?? '#4f46e5' }}" 
                                        class="h-12 w-20 cursor-pointer rounded-xl border border-slate-200 dark:border-slate-700 bg-transparent">
                                    <input type="text" value="{{ $settings['warna_utama'] ?? '#4f46e5' }}" readonly class="w-32 py-2 px-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-bold text-slate-700 dark:text-slate-300 focus:outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Logo Aplikasi</label>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 mb-3">Unggah logo aplikasi Anda. Direkomendasikan format PNG transparan atau SVG.</p>
                                <div class="flex items-start gap-4">
                                    @if(isset($settings['logo']))
                                        <div class="w-16 h-16 rounded-xl border border-slate-200 dark:border-slate-700 flex items-center justify-center bg-slate-50 dark:bg-slate-800/50 overflow-hidden flex-shrink-0">
                                            <img src="{{ asset($settings['logo']) }}" alt="Logo" class="w-full h-full object-contain p-2">
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <input type="file" name="logo" accept="image/*"
                                            class="block w-full text-sm text-slate-500 dark:text-slate-400
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-indigo-50 dark:file:bg-indigo-500/10 file:text-indigo-700 dark:file:text-indigo-400
                                            hover:file:bg-indigo-100 dark:hover:file:bg-indigo-500/20 transition-all cursor-pointer">
                                        @error('logo')
                                            <p class="text-rose-500 text-xs mt-2 font-bold"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Area Biaya & Denda -->
                    <section>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-slate-200 mb-4 pb-2 border-b border-slate-100 dark:border-slate-800 flex items-center">
                            <i class="fas fa-file-invoice-dollar text-indigo-500 w-6"></i> Konfigurasi Denda
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                            <div class="col-span-1">
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1">Denda Keterlambatan Harian</label>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 mb-3">Biaya denda ini akan dikenakan per hari untuk setiap buku yang pengembaliannya melewati batas jatuh tempo.</p>
                                
                                <div class="relative max-w-sm">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-800 dark:text-slate-300 font-bold text-sm bg-slate-100 dark:bg-slate-800 w-12 border-r border-slate-200 dark:border-slate-700 rounded-l-xl">
                                        Rp
                                    </span>
                                    <input type="number" name="denda_harian" value="{{ $settings['denda_harian'] ?? 5000 }}" 
                                        class="block w-full pl-16 pr-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all font-bold text-slate-800 dark:text-slate-100"
                                        placeholder="5000">
                                </div>
                                @error('denda_harian')
                                    <p class="text-rose-500 text-xs mt-2 font-bold"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="col-span-1 border-l-2 border-amber-100 dark:border-amber-500/30 pl-6 bg-amber-50/50 dark:bg-amber-900/10 rounded-r-2xl py-2">
                                <h4 class="font-bold text-amber-800 dark:text-amber-500 mb-1.5 text-xs uppercase tracking-wider flex items-center"><i class="fas fa-lightbulb text-amber-500 mr-2"></i> Info Perubahan</h4>
                                <p class="text-amber-700/80 dark:text-amber-200/60 text-[11px] leading-relaxed text-justify font-medium">
                                    Pengaturan denda di atas hanya mengubah tarif yang berlangsung. Transaksi peminjaman yang sudah lunas sebelumnya tidak akan dikalkulasi ulang demi menjaga validasi pendapatan riwayat laporan denda kas pusat.
                                </p>
                            </div>
                        </div>
                    </section>

                </div>

                <div class="pt-8 mt-10 border-t border-slate-200/80 dark:border-slate-800 flex justify-end">
                    <button type="submit" 
                        class="pl-6 pr-5 py-3.5 bg-slate-900 dark:bg-indigo-600 border border-slate-800 dark:border-indigo-500 text-white font-bold rounded-xl hover:bg-indigo-600 dark:hover:bg-indigo-500 hover:border-indigo-600 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 active:scale-95 flex items-center gap-3">
                        Simpan Penyesuaian
                        <i class="fas fa-arrow-right opacity-50"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
