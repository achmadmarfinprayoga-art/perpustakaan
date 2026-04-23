@extends('layout.master')

@section('header', 'Pengaturan Sistem')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
            <div class="p-6 md:p-8 border-b border-slate-100 bg-slate-50/30 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Profil & Pengaturan Perpustakaan</h1>
                    <p class="text-slate-500 text-sm mt-1">Konfigurasi identitas sistem dan manajemen biaya denda.</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="fas fa-sliders-h"></i>
                </div>
            </div>

            <form action="/settings" method="POST" class="p-6 md:p-8">
                @csrf
                @method('PUT')

                <div class="space-y-10">
                    
                    <!-- Area Identitas -->
                    <section>
                        <h3 class="text-lg font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100 flex items-center">
                            <i class="fas fa-building text-indigo-500 w-6"></i> Identitas Instansi
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Perpustakaan</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                        <i class="fas fa-university"></i>
                                    </span>
                                    <input type="text" name="nama_perpustakaan" value="{{ $settings['nama_perpustakaan'] ?? 'Perpustakaan Cerdas' }}" 
                                        class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all font-semibold text-slate-700"
                                        placeholder="Contoh: Perpustakaan Nasional Daerah Y">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Telepon / Kontak</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                        <i class="fas fa-phone-alt"></i>
                                    </span>
                                    <input type="text" name="kontak_perpustakaan" value="{{ $settings['kontak_perpustakaan'] ?? '0812-3456-7890' }}" 
                                        class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all font-semibold text-slate-700"
                                        placeholder="0812-XXXX-XXXX">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Email</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email_perpustakaan" value="{{ $settings['email_perpustakaan'] ?? 'admin@perpus.com' }}" 
                                        class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all font-semibold text-slate-700"
                                        placeholder="admin@perpus.com">
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap</label>
                                <textarea name="alamat_perpustakaan" rows="3"
                                    class="block w-full p-4 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all font-semibold text-slate-700 placeholder-slate-400"
                                    placeholder="Masukkan alamat lengkap perpustakaan di sini...">{{ $settings['alamat_perpustakaan'] ?? 'Jl. Merdeka No. 1, Kota Pusat' }}</textarea>
                            </div>
                        </div>
                    </section>

                    <!-- Area Biaya & Denda -->
                    <section>
                        <h3 class="text-lg font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100 flex items-center">
                            <i class="fas fa-file-invoice-dollar text-indigo-500 w-6"></i> Konfigurasi Denda
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                            <div class="col-span-1">
                                <label class="block text-sm font-bold text-slate-700 mb-1">Denda Keterlambatan Harian</label>
                                <p class="text-[11px] text-slate-500 mb-3">Biaya denda ini akan dikenakan per hari untuk setiap buku yang pengembaliannya melewati batas jatuh tempo.</p>
                                
                                <div class="relative max-w-sm">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-800 font-bold text-sm bg-slate-100 w-12 border-r border-slate-200 rounded-l-xl">
                                        Rp
                                    </span>
                                    <input type="number" name="denda_harian" value="{{ $settings['denda_harian'] ?? 5000 }}" 
                                        class="block w-full pl-16 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all font-bold text-slate-800"
                                        placeholder="5000">
                                </div>
                                @error('denda_harian')
                                    <p class="text-rose-500 text-xs mt-2 font-bold"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="col-span-1 border-l-2 border-amber-100 pl-6 bg-amber-50/50 rounded-r-2xl py-2">
                                <h4 class="font-bold text-amber-800 mb-1.5 text-xs uppercase tracking-wider flex items-center"><i class="fas fa-lightbulb text-amber-500 mr-2"></i> Info Perubahan</h4>
                                <p class="text-amber-700/80 text-[11px] leading-relaxed text-justify font-medium">
                                    Pengaturan denda di atas hanya mengubah tarif yang berlangsung. Transaksi peminjaman yang sudah lunas sebelumnya tidak akan dikalkulasi ulang demi menjaga validasi pendapatan riwayat laporan denda kas pusat.
                                </p>
                            </div>
                        </div>
                    </section>

                </div>

                <div class="pt-8 mt-10 border-t border-slate-200/80 flex justify-end">
                    <button type="submit" 
                        class="pl-6 pr-5 py-3.5 bg-slate-900 border border-slate-800 text-white font-bold rounded-xl hover:bg-indigo-600 hover:border-indigo-600 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 active:scale-95 flex items-center gap-3">
                        Simpan Penyesuaian
                        <i class="fas fa-arrow-right opacity-50"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
