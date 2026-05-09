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
            background-color: #f8fafc;
        }
        [x-cloak] { display: none !important; }
        @keyframes slide-up {
            0% { transform: translateY(20px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
        .animate-slide-up { animation: slide-up 0.5s ease-out forwards; }
        
        /* Custom styles matching the theme */
        .primary-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #3b82f6 100%);
        }
        .text-gradient {
            background: linear-gradient(135deg, #6366f1 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <!-- Container for Desktop centering -->
    <div class="w-full max-w-md bg-white rounded-[40px] shadow-2xl shadow-indigo-100 overflow-hidden flex flex-col justify-center p-8 md:p-10 border border-indigo-50 relative">
        
        <!-- Animated background elements -->
        <div class="absolute -top-20 -left-20 w-40 h-40 bg-indigo-50 rounded-full -z-10"></div>
        <div class="absolute -bottom-20 -right-20 w-40 h-40 bg-blue-50 rounded-full -z-10"></div>

        <!-- Illustration/Media -->
        <div class="text-center mb-10 animate-slide-up">
            <div class="w-20 h-20 mx-auto mb-5 bg-indigo-50 rounded-[30px] flex items-center justify-center text-indigo-600 rotate-6 hover:rotate-0 transition-transform duration-300">
                <i class="fa-solid fa-rocket text-3xl text-indigo-500"></i>
            </div>
            <h3 class="text-2xl font-black text-gradient flex items-center justify-center gap-2">
                <span>Anak Hebat!</span>
            </h3>
            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mt-2">Masuk ke Ruang Belajar</p>
        </div>

        @if (session('error'))
            <div class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-2xl relative mb-6 text-sm flex items-center" role="alert">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <div class="account-section" x-data="{ showPass: false }">
            <form action="{{ route('login') }}" method="post" class="space-y-6">
                @csrf
                
                <div>
                    <label class="text-xs font-bold text-slate-500 mb-2 block uppercase tracking-wider" for="username">Username</label>
                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-300 text-sm"></i>
                        <input id="username" type="text" name="username" class="w-full pl-12 pr-4 py-3.5 rounded-2xl border border-slate-100 focus:border-indigo-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 text-sm transition-all @error('username') border-red-300 focus:ring-red-100 @enderror" value="{{ old('username') }}" placeholder="Ketik username kamu">
                    </div>
                    @error('username')
                        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-xs font-bold text-slate-500 mb-2 block uppercase tracking-wider" for="password">Password</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-300 text-sm"></i>
                        <input id="password" :type="showPass ? 'text' : 'password'" name="password" class="w-full pl-12 pr-12 py-3.5 rounded-2xl border border-slate-100 focus:border-indigo-300 focus:outline-none focus:ring-4 focus:ring-indigo-100 text-sm transition-all @error('password') border-red-300 focus:ring-red-100 @enderror" placeholder="Ketik password kamu">
                        
                        <button type="button" @click="showPass = !showPass" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-300 hover:text-indigo-500 transition-colors">
                            <i class="fa-solid" :class="showPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full primary-gradient text-white font-bold py-4 rounded-2xl hover:opacity-90 transition-all duration-300 shadow-lg shadow-indigo-100 flex items-center justify-center gap-2 text-sm uppercase tracking-wider">
                        <span>Masuk Sekarang</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>
                </div>

                <div class="text-center text-[10px] text-slate-400 mt-8 font-bold uppercase tracking-widest">
                    <span>Yayasan Plester Jiwa Indonesia</span>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
