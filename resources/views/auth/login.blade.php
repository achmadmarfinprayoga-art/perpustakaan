<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — Sistem Perpustakaan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Outfit', sans-serif; }

        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .bg-image {
            background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
        }

        .input-glass {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.3s ease;
        }

        .input-glass:focus {
            background: #ffffff;
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            outline: none;
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 sm:p-8">
    
    @php
        $logo = \App\Models\Setting::where('key', 'logo')->value('value');
    @endphp
    <div class="w-full max-w-6xl h-[85vh] min-h-[600px] flex rounded-[2.5rem] overflow-hidden shadow-2xl bg-white relative">
        
        <!-- Left Side: Login Form -->
        <div class="w-full lg:w-5/12 p-8 sm:p-12 md:p-16 flex flex-col justify-center relative z-10 bg-white/95 backdrop-blur-xl">
            <div class="w-full max-w-md mx-auto">
                <div class="mb-10 text-center lg:text-left">
                    @if($logo)
                        <div class="inline-flex items-center justify-center h-24 bg-white/95 rounded-2xl p-3 shadow-[0_0_20px_rgba(255,255,255,0.3)] mb-6 transition-transform hover:scale-105 border border-slate-100">
                            <img src="{{ asset($logo) }}" alt="Logo" class="h-full object-contain filter drop-shadow-sm">
                        </div>
                    @else
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-500/30 mb-6 transition-transform hover:scale-105">
                            <i class="fas fa-book-open text-2xl text-white"></i>
                        </div>
                    @endif
                    <h1 class="text-4xl font-extrabold text-slate-800 tracking-tight mb-2">Selamat Datang 👋</h1>
                    <p class="text-slate-500 font-medium">Silakan masuk ke akun Anda untuk mengelola perpustakaan.</p>
                </div>

                @if (session('success'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-600 px-5 py-4 rounded-2xl text-sm flex items-center font-medium shadow-sm">
                        <i class="fas fa-check-circle mr-3 text-lg"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-600 px-5 py-4 rounded-2xl text-sm font-medium shadow-sm">
                        <ul class="list-none space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-center"><i class="fas fa-exclamation-circle mr-3 text-lg"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2 pl-1">Email Address</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                                class="input-glass w-full pl-11 pr-4 py-3.5 rounded-2xl text-sm text-slate-800 font-medium"
                                placeholder="nama@email.com">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 pl-1 pr-1">
                            <label for="password" class="block text-sm font-bold text-slate-700">Password</label>
                            <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-700">Lupa password?</a>
                        </div>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" id="password" name="password" required
                                class="input-glass w-full pl-11 pr-4 py-3.5 rounded-2xl text-sm text-slate-800 font-medium"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-5 h-5 rounded-md border-slate-300 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-w transition duration-200 ease-in-out cursor-pointer">
                            <span class="ml-3 text-sm font-medium text-slate-600 group-hover:text-slate-800 transition duration-200">Ingat saya pada perangkat ini</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 hover:bg-indigo-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-slate-900/20 hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-1 active:scale-[0.98] flex items-center justify-center">
                        Masuk Sekarang <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </form>

                <div class="mt-10 pt-6 border-t border-slate-100 text-center lg:text-left">
                    <p class="text-slate-400 text-xs tracking-wider uppercase font-bold">
                        &copy; {{ date('Y') }} Sistem Perpustakaan Modern
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Side: Image/Artwork -->
        <div class="hidden lg:block lg:w-7/12 relative bg-image">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/80 to-slate-900/90 mix-blend-multiply"></div>
            
            <div class="absolute inset-0 flex flex-col justify-end p-16 pb-20">
                <div class="glass-panel p-8 rounded-3xl max-w-lg transform transition-all hover:scale-105 duration-500">
                    <div class="flex items-center gap-3 mb-4">
                        <i class="fas fa-quote-left text-indigo-500 text-2xl"></i>
                        <span class="text-indigo-200 font-semibold tracking-widest uppercase text-xs">Inspirasi</span>
                    </div>
                    <p class="text-white text-2xl font-bold leading-snug mb-4">
                        "Perpustakaan adalah tempat di mana sejarah menjadi hidup, ruang bagi inspirasi tanpa batas."
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-indigo-500/30 rounded-full flex items-center justify-center border border-indigo-400/50">
                            <i class="fas fa-user-graduate text-indigo-100"></i>
                        </div>
                        <div>
                            <p class="text-white font-bold">Sistem Pintar</p>
                            <p class="text-indigo-200 text-sm">Manajemen Lebih Mudah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
