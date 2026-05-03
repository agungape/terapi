@php
    $profile = \App\Models\Profile::first();
    $primaryColor = $profile->warna_primer ?? '#ef4444';
    list($r, $g, $b) = sscanf($primaryColor, "#%02x%02x%02x");
    $primaryRgb = "$r, $g, $b";
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | {{ $profile->nama_apk ?? 'Bright Star Of Child' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/' . ($profile->logo ?? '')) }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --primary-color-rgb: {{ $primaryRgb }};
        }

        [x-cloak] { display: none !important; }
        
        /* Dynamic Color Overrides */
        .text-red-500 { color: var(--primary-color) !important; }
        .text-red-600 { color: var(--primary-color) !important; filter: brightness(0.9); }
        .bg-red-50 { background-color: rgba(var(--primary-color-rgb), 0.05) !important; }
        .bg-red-500 { background-color: var(--primary-color) !important; }
        .hover\:bg-red-500:hover { background-color: var(--primary-color) !important; filter: brightness(0.9); }
        .hover\:text-red-600:hover { color: var(--primary-color) !important; filter: brightness(0.9); }
        .focus\:ring-red-50:focus { --tw-ring-color: rgba(var(--primary-color-rgb), 0.1) !important; }
        .shadow-red-100 { --tw-shadow-color: rgba(var(--primary-color-rgb), 0.1) !important; }
        .border-red-100 { border-color: rgba(var(--primary-color-rgb), 0.1) !important; }

        .bg-pattern {
            background-color: #f8fafc;
            background-image: radial-gradient(#e2e8f0 0.5px, transparent 0.5px);
            background-size: 24px 24px;
        }
    </style>
</head>

<body class="bg-pattern min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-red-500/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-slate-900/5 rounded-full blur-3xl"></div>

    <div class="w-full max-w-[440px] relative z-10 transition-all duration-500 ease-in-out">
        <!-- Card -->
        <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-100 overflow-hidden">
            
            <!-- Card Header -->
            <div class="p-10 pb-4 text-center">
                <div class="w-20 h-20 bg-white rounded-3xl shadow-xl shadow-red-100 border border-slate-50 flex items-center justify-center mx-auto mb-6 transform hover:rotate-3 transition-transform">
                    <img src="{{ asset('storage/logo/' . ($profile->logo ?? 'bsc.png')) }}" class="w-14 h-14 object-contain" alt="Logo">
                </div>
                <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">{{ $profile->nama_apk ?? 'Bright Star' }}</h2>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mt-2">Clinical Management System</p>
            </div>

            <!-- Card Body -->
            <div class="p-10 pt-6">
                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-start gap-3 animate-in fade-in slide-in-from-top-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <div>
                            <p class="text-[11px] font-black text-red-700 uppercase tracking-tight">Akses Ditolak</p>
                            <p class="text-[10px] font-bold text-red-500 leading-tight mt-0.5">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="space-y-2">
                        <label for="username" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Username</label>
                        <div class="relative group">
                            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-red-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" 
                                   required autofocus placeholder="ID Pengguna"
                                   class="w-full bg-slate-50 border-none rounded-2xl pl-14 pr-6 py-4 text-sm font-bold text-slate-700 placeholder:text-slate-300 focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none">
                        </div>
                        @error('username')
                            <p class="text-[10px] font-bold text-red-500 ml-1 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between ml-1">
                            <label for="password" class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[10px] font-black text-red-500 uppercase tracking-widest hover:text-red-600 transition-colors">Lupa?</a>
                            @endif
                        </div>
                        <div class="relative group">
                            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-red-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </div>
                            <input type="password" name="password" id="password" required placeholder="Kata Sandi Keamanan"
                                   class="w-full bg-slate-50 border-none rounded-2xl pl-14 pr-6 py-4 text-sm font-bold text-slate-700 placeholder:text-slate-300 focus:ring-4 focus:ring-red-50 focus:bg-white transition-all outline-none">
                        </div>
                        @error('password')
                            <p class="text-[10px] font-bold text-red-500 ml-1 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-slate-900 hover:bg-red-500 text-white py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-2xl shadow-red-100 transition-all group flex items-center justify-center gap-2 italic">
                            Masuk Ke Sistem
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </button>
                    </div>
                </form>

                <div class="mt-10 text-center">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pusat Layanan Terapi Terintegrasi</p>
                </div>
            </div>
        </div>
        
        <!-- Footer Info -->
        <p class="text-[10px] text-center font-bold text-slate-400 uppercase tracking-widest mt-8 italic">
            &copy; {{ date('Y') }} Bright Star Of Child. <span class="text-slate-300">Premium Clinical Hub</span>
        </p>
    </div>

    <!-- Font Awesome (for SweetAlert fallback if needed) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @include('sweetalert::alert')
</body>

</html>

