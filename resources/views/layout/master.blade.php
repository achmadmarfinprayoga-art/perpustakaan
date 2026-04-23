<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('header', 'Perpustakaan - Sistem Manajemen Perpustakaan')</title>
    
    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Tailwind CDN Fallback --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Font Awesome 6 CDN for icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    {{-- Tom Select for searchable dropdowns --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    {{-- SweetAlert2 for premium alerts --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Custom Styles --}}
    <style>
        body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
        .swal2-popup {
            border-radius: 1.5rem !important;
            padding: 2rem !important;
        }
        .swal2-styled.swal2-confirm {
            border-radius: 0.75rem !important;
            padding: 0.75rem 1.5rem !important;
            font-weight: 600 !important;
        }
        .swal2-styled.swal2-cancel {
            border-radius: 0.75rem !important;
            padding: 0.75rem 1.5rem !important;
            font-weight: 600 !important;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-indigo-50 min-h-screen antialiased text-slate-800">
    
    <div class="flex h-screen overflow-hidden">
        
        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 text-white flex flex-col shadow-2xl transition-all duration-300 md:relative absolute z-40 h-full">
            <div class="p-6 border-b border-white/10 flex items-center space-x-3">
                <div class="w-10 h-10 bg-indigo-500 rounded-xl flex shadow-lg items-center justify-center">
                    <i class="fas fa-book-open text-xl text-white"></i>
                </div>
                <h1 class="text-xl font-bold tracking-wide">Perpustakaan</h1>
            </div>
            
            <div class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
                <p class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Menu Utama</p>
                
                <a href="/" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('/') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <a href="/siswa" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('siswa*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-users w-5 text-center"></i>
                    <span class="font-medium">Mst Siswa</span>
                </a>
                
                <a href="/buku" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('buku*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-book w-5 text-center"></i>
                    <span class="font-medium">Mst Buku</span>
                </a>
                
                <a href="/kategori" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('kategori*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-tags w-5 text-center"></i>
                    <span class="font-medium">Kategori Buku</span>
                </a>

                <p class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-6 mb-2">Transaksi</p>

                <a href="/peminjaman" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('peminjaman*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-hand-holding w-5 text-center"></i>
                    <span class="font-medium">Peminjaman</span>
                </a>

                <p class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-6 mb-2">Laporan</p>

                <a href="/laporan/denda" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('laporan/denda') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-file-invoice-dollar w-5 text-center"></i>
                    <span class="font-medium">Laporan Denda</span>
                </a>

                <p class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-6 mb-2">Sistem</p>

                <a href="/settings" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('settings*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-cog w-5 text-center"></i>
                    <span class="font-medium">Pengaturan</span>
                </a>
            </div>
            
            <div class="p-4 border-t border-white/10">
                <div class="flex items-center justify-between px-2 py-2">
                    <div class="flex items-center space-x-3 overflow-hidden">
                        <div class="w-9 h-9 rounded-full bg-indigo-600/70 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user text-sm text-white"></i>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name ?? 'Guest' }}</p>
                            <p class="text-[10px] text-indigo-300 uppercase tracking-tighter">{{ Auth::user()->role ?? '' }}</p>
                        </div>
                    </div>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" 
                            title="Logout"
                            class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-red-400 hover:bg-red-400/10 transition-all duration-200 ml-1">
                            <i class="fas fa-sign-out-alt text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Main Wrapper for Header & Content --}}
        <div class="flex-1 flex flex-col h-full relative w-full overflow-hidden">
            
            {{-- Header/Navbar --}}
            <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-slate-200/60 sticky top-0 z-30 h-16 flex items-center justify-between px-6">
                <div class="flex items-center">
                    {{-- Mobile menu button could go here --}}
                    <h2 class="text-xl font-bold text-slate-800">@yield('header', 'Dashboard')</h2>
                </div>
                <div class="flex items-center space-x-3 hidden md:flex">
                    <span class="text-sm font-medium text-slate-500 bg-slate-100 px-3 py-1.5 rounded-full">Sistem Manajemen Perpustakaan</span>
                    
                    <div class="h-8 w-[1px] bg-slate-200 mx-2"></div>

                    <div class="flex items-center space-x-3">
                        <div class="text-right">
                            <p class="text-xs font-bold text-slate-800 leading-none">{{ Auth::user()->name ?? '' }}</p>
                            <p class="text-[10px] text-indigo-500 font-medium uppercase leading-tight">{{ Auth::user()->role ?? '' }}</p>
                        </div>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-red-500 bg-slate-100 hover:bg-red-50 px-4 py-2 rounded-xl transition-all duration-200 border border-transparent hover:border-red-100">
                                <i class="fas fa-power-off text-[10px]"></i>
                                LOGOUT
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            {{-- Main Content --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50/50 p-6 md:p-8 w-full">
                @if (session('success'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl p-4 shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-emerald-500 text-xl"></i>
                            </div>
                            <div class="ml-3">
                                <span class="text-emerald-800 font-medium">{{ session('success') }}</span>
                            </div>
                            <div class="ml-auto pl-3">
                                <div class="-mx-1.5 -my-1.5">
                                    <button type="button" onclick="this.parentElement.parentElement.parentElement.parentElement.remove()" class="inline-flex bg-emerald-50 rounded-md p-1.5 text-emerald-500 hover:bg-emerald-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-emerald-50 focus:ring-emerald-600 transition-colors">
                                        <span class="sr-only">Dismiss</span>
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                            </div>
                            <div class="ml-3">
                                <span class="text-red-800 font-medium">{{ session('error') }}</span>
                            </div>
                            <div class="ml-auto pl-3">
                                <div class="-mx-1.5 -my-1.5">
                                    <button type="button" onclick="this.parentElement.parentElement.parentElement.parentElement.remove()" class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600 transition-colors">
                                        <span class="sr-only">Dismiss</span>
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="mx-auto max-w-7xl">
                    @yield('content')
                </div>
            </main>
        </div>
        
    </div>

    {{-- Global Scripts --}}
    <script>
        // Global delete confirmation
        function confirmDelete(title = 'Apakah Anda yakin?', text = 'Data ini akan dihapus secara permanen!', icon = 'warning') {
            return Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            });
        }

        // Global Action confirmation
        function confirmAction(title, text, icon = 'question', confirmText = 'Ya, Lanjutkan!') {
            return Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: confirmText,
                cancelButtonText: 'Batal',
                reverseButtons: true
            });
        }

        // Success/Error Toasts
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        @if (session('error'))
            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });
        @endif

        // Form confirmation handler
        document.addEventListener('submit', function(e) {
            const form = e.target;
            if (form.dataset.confirm) {
                e.preventDefault();
                confirmAction('Konfirmasi', form.dataset.confirm, 'question', 'Ya, Kirim!')
                    .then((result) => {
                        if (result.isConfirmed) {
                            form.removeAttribute('data-confirm');
                            form.submit();
                        }
                    });
            }
        });
    </script>
</body>
</html>
