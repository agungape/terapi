<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <title>Bright Start - Login</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        [x-cloak] { display: none !important; }
        
        @keyframes slide-up {
            0% { transform: translateY(30px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
        .animate-slide-up { animation: slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        
        @keyframes float-slow {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(3deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .animate-float-slow { animation: float-slow 6s ease-in-out infinite; }

        @keyframes float-fast {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(-5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .animate-float-fast { animation: float-fast 4s ease-in-out infinite; }
        
        @keyframes pulse-soft {
            0% { transform: scale(1); opacity: 0.3; }
            50% { transform: scale(1.05); opacity: 0.5; }
            100% { transform: scale(1); opacity: 0.3; }
        }
        .animate-pulse-soft { animation: pulse-soft 4s ease-in-out infinite; }
        
        /* Custom styles matching the theme */
        .primary-gradient {
            background: linear-gradient(135deg, #06b6d4 0%, #6366f1 50%, #d946ef 100%);
        }
        .text-gradient {
            background: linear-gradient(135deg, #06b6d4 0%, #6366f1 50%, #d946ef 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        
        /* Input focus effects */
        .input-glow:focus {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-tr from-sky-100 via-pink-50 to-yellow-50 relative overflow-hidden">

    <!-- Decorative Floating Elements Background (More Colorful) -->
    <div class="absolute top-10 left-10 text-sky-400/60 text-4xl animate-float-slow -z-10">
        <i class="fa-solid fa-cloud"></i>
    </div>
    <div class="absolute bottom-10 right-10 text-pink-400/60 text-5xl animate-float-fast -z-10" style="animation-delay: 1s;">
        <i class="fa-solid fa-heart"></i>
    </div>
    <div class="absolute top-1/4 right-20 text-yellow-400/70 text-3xl animate-float-fast -z-10" style="animation-delay: 0.5s;">
        <i class="fa-solid fa-star"></i>
    </div>
    <div class="absolute bottom-1/4 left-20 text-purple-400/60 text-3xl animate-float-slow -z-10" style="animation-delay: 1.5s;">
        <i class="fa-solid fa-puzzle-piece"></i>
    </div>
    <div class="absolute top-1/2 left-10 text-teal-400/60 text-2xl animate-float-fast -z-10" style="animation-delay: 2s;">
        <i class="fa-solid fa-face-smile"></i>
    </div>
    <div class="absolute top-10 right-1/4 text-orange-400/60 text-2xl animate-float-slow -z-10" style="animation-delay: 0.8s;">
        <i class="fa-solid fa-bell"></i>
    </div>

    <!-- Container for Desktop centering -->
    <div class="w-full max-w-md glass-card rounded-[45px] shadow-2xl shadow-indigo-100/50 overflow-hidden flex flex-col justify-center p-8 md:p-10 relative animate-slide-up">
        
        <!-- Animated background elements inside card -->
        <div class="absolute -top-10 -left-10 w-32 h-32 bg-sky-100/50 rounded-full blur-2xl -z-10 animate-pulse-soft"></div>
        <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-pink-100/50 rounded-full blur-2xl -z-10 animate-pulse-soft" style="animation-delay: 2s;"></div>

        <!-- Illustration/Media -->
        <div class="text-center mb-10">
            <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-tr from-sky-50 to-pink-50 rounded-[35px] flex items-center justify-center text-indigo-600 shadow-lg shadow-indigo-100/50 animate-float-slow relative">
                <i class="fa-solid fa-rocket text-4xl text-gradient"></i>
                <!-- Sparkles -->
                <div class="absolute -top-2 -right-2 text-yellow-400 animate-pulse">
                    <i class="fa-solid fa-star text-xs"></i>
                </div>
                <div class="absolute -bottom-1 -left-2 text-yellow-400 animate-pulse" style="animation-delay: 0.5s;">
                    <i class="fa-solid fa-star text-[10px]"></i>
                </div>
            </div>
            <h3 class="text-3xl font-black text-gradient flex items-center justify-center gap-2">
                <span>Anak Hebat!</span>
            </h3>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-2">Masuk ke Ruang Belajar</p>
        </div>

        @if (session('error'))
            <div class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-2xl relative mb-6 text-xs flex items-center animate-slide-up" role="alert">
                <i class="fa-solid fa-circle-exclamation mr-2 text-sm"></i>
                <span class="font-bold">{{ session('error') }}</span>
            </div>
        @endif

        <div class="account-section" x-data="{ showPass: false }">
            <form action="{{ route('login') }}" method="post" class="space-y-6">
                @csrf
                
                <div class="group">
                    <label class="text-[10px] font-bold text-slate-400 mb-2 block uppercase tracking-widest group-focus-within:text-sky-600 transition-colors" for="username">Username</label>
                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-300 text-sm group-focus-within:text-sky-500 transition-colors"></i>
                        <input id="username" type="text" name="username" class="w-full pl-14 pr-5 py-4 rounded-2xl border border-slate-100 bg-white/50 focus:bg-white focus:border-sky-300 focus:outline-none input-glow text-sm transition-all duration-300 @error('username') border-red-300 focus:ring-red-100 @enderror" value="{{ old('username') }}" placeholder="Ketik username kamu">
                    </div>
                    @error('username')
                        <p class="text-xs text-red-500 mt-1.5 font-medium flex items-center">
                            <i class="fa-solid fa-circle-exclamation mr-1 text-[10px]"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="group">
                    <label class="text-[10px] font-bold text-slate-400 mb-2 block uppercase tracking-widest group-focus-within:text-sky-600 transition-colors" for="password">Password</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-300 text-sm group-focus-within:text-sky-500 transition-colors"></i>
                        <input id="password" :type="showPass ? 'text' : 'password'" name="password" class="w-full pl-14 pr-14 py-4 rounded-2xl border border-slate-100 bg-white/50 focus:bg-white focus:border-sky-300 focus:outline-none input-glow text-sm transition-all duration-300 @error('password') border-red-300 focus:ring-red-100 @enderror" placeholder="Ketik password kamu">
                        
                        <button type="button" @click="showPass = !showPass" class="absolute right-5 top-1/2 transform -translate-y-1/2 text-slate-300 hover:text-sky-500 transition-colors">
                            <i class="fa-solid" :class="showPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-xs text-red-500 mt-1.5 font-medium flex items-center">
                            <i class="fa-solid fa-circle-exclamation mr-1 text-[10px]"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full primary-gradient text-white font-bold py-4 rounded-2xl hover:opacity-90 active:scale-[0.98] transition-all duration-300 shadow-lg shadow-sky-100 flex items-center justify-center gap-2 text-sm uppercase tracking-wider">
                        <span>Masuk Sekarang</span>
                        <i class="fa-solid fa-arrow-right text-xs animate-pulse"></i>
                    </button>
                </div>

                <div class="text-center text-[9px] text-slate-300 mt-8 font-bold uppercase tracking-widest">
                    <span>Yayasan Plester Jiwa Indonesia</span>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
