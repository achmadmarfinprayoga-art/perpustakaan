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
    @php
        $settings = \App\Models\Setting::pluck('value', 'key');
        $warnaUtama = $settings['warna_utama'] ?? '#4f46e5';
        $logo = $settings['logo'] ?? null;
    @endphp
    <script>
        // Check local storage for dark mode
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
        
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '{{ $warnaUtama }}',
                    }
                }
            }
        }
    </script>
    
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
<body class="bg-gradient-to-br from-slate-50 to-indigo-50 dark:from-slate-900 dark:to-slate-800 min-h-screen antialiased text-slate-800 dark:text-slate-200 transition-colors duration-300">
    
    <div class="flex h-screen overflow-hidden">
        
        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 dark:bg-slate-950 text-white flex flex-col shadow-2xl transition-all duration-300 md:relative absolute z-40 h-full border-r border-slate-800">
            <div class="p-6 border-b border-white/10 flex items-center justify-center space-x-3">
                @if($logo)
                    <div class="w-[85%] h-16 flex items-center justify-center bg-white/95 rounded-xl p-2 shadow-[0_0_15px_rgba(255,255,255,0.1)] transition-all">
                        <img src="{{ asset($logo) }}" alt="Logo" class="max-w-full h-full object-contain filter drop-shadow-sm">
                    </div>
                @else
                    <div class="w-10 h-10 bg-primary rounded-xl flex shadow-lg items-center justify-center">
                        <i class="fas fa-book-open text-xl text-white"></i>
                    </div>
                    <h1 class="text-xl font-bold tracking-wide">Perpustakaan</h1>
                @endif
            </div>
            
            <div class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
                <p class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Menu Utama</p>
                
                <a href="/" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('/') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <a href="/siswa" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('siswa*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-users w-5 text-center"></i>
                    <span class="font-medium">Mst Siswa</span>
                </a>
                
                <a href="/buku" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('buku*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-book w-5 text-center"></i>
                    <span class="font-medium">Mst Buku</span>
                </a>
                
                <a href="/kategori" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('kategori*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-tags w-5 text-center"></i>
                    <span class="font-medium">Kategori Buku</span>
                </a>

                <p class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-6 mb-2">Transaksi</p>

                <a href="/peminjaman" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('peminjaman*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-hand-holding w-5 text-center"></i>
                    <span class="font-medium">Peminjaman</span>
                </a>

                <p class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-6 mb-2">Laporan</p>

                <a href="/laporan/denda" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('laporan/denda') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-file-invoice-dollar w-5 text-center"></i>
                    <span class="font-medium">Laporan Denda</span>
                </a>

                <p class="px-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-6 mb-2">Sistem</p>

                <a href="/settings" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('settings*') ? 'bg-primary text-white shadow-md shadow-primary/20' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-cog w-5 text-center"></i>
                    <span class="font-medium">Pengaturan</span>
                </a>
            </div>
            
            <div class="p-4 border-t border-white/10">
                <div class="flex items-center justify-between px-2 py-2">
                    <div class="flex items-center space-x-3 overflow-hidden">
                        <div class="w-9 h-9 rounded-full bg-primary/70 flex items-center justify-center flex-shrink-0">
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
        <div class="flex-1 flex flex-col h-full relative w-full overflow-hidden bg-transparent">
            
            {{-- Header/Navbar --}}
            <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md shadow-sm border-b border-slate-200/60 dark:border-slate-700/60 sticky top-0 z-30 h-16 flex items-center justify-between px-6 transition-colors duration-300">
                <div class="flex items-center">
                    {{-- Mobile menu button could go here --}}
                    <h2 class="text-xl font-bold text-slate-800 dark:text-white">@yield('header', 'Dashboard')</h2>
                </div>
                <div class="flex items-center space-x-3 hidden md:flex">
                    <span class="text-sm font-medium text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-3 py-1.5 rounded-full">Sistem Manajemen Perpustakaan</span>
                    
                    <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-700 mx-2"></div>

                    <div class="flex items-center space-x-3">
                        <button id="theme-toggle" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:text-indigo-500 dark:hover:text-indigo-400 transition-colors">
                            <i id="theme-toggle-icon" class="fas fa-moon"></i>
                        </button>
                        
                        <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-700 mx-1"></div>
                        
                        <div class="text-right">
                            <p class="text-xs font-bold text-slate-800 dark:text-slate-200 leading-none">{{ Auth::user()->name ?? '' }}</p>
                            <p class="text-[10px] text-indigo-500 dark:text-indigo-400 font-medium uppercase leading-tight">{{ Auth::user()->role ?? '' }}</p>
                        </div>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 text-xs font-bold text-slate-500 dark:text-slate-400 hover:text-red-500 dark:hover:text-red-400 bg-slate-100 dark:bg-slate-800 hover:bg-red-50 dark:hover:bg-red-900/30 px-4 py-2 rounded-xl transition-all duration-200 border border-transparent hover:border-red-100 dark:hover:border-red-900/50">
                                <i class="fas fa-power-off text-[10px]"></i>
                                LOGOUT
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            {{-- Main Content --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 md:p-8 w-full transition-colors duration-300">
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
        // Dark Mode Toggle Logic
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleIcon = document.getElementById('theme-toggle-icon');

        // Initial icon state
        if (document.documentElement.classList.contains('dark')) {
            themeToggleIcon.classList.remove('fa-moon');
            themeToggleIcon.classList.add('fa-sun');
        } else {
            themeToggleIcon.classList.remove('fa-sun');
            themeToggleIcon.classList.add('fa-moon');
        }

        themeToggleBtn.addEventListener('click', function() {
            // toggle icons
            themeToggleIcon.classList.toggle('fa-moon');
            themeToggleIcon.classList.toggle('fa-sun');

            // toggle theme
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });

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
