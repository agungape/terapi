<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bright Star Of Child | Pusat Layanan Terapi Terpadu</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/website/images/logo-title-bar.png') }}" type="image/png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            red: '#ef4444',
                            slate: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        [x-cloak] { display: none !important; }
        .nav-link-active {
            color: #ef4444 !important;
            font-weight: 800;
        }
    </style>
    
    @yield('extra_css')
</head>

<body class="font-sans bg-white text-slate-900 antialiased" x-data="{ mobileMenuOpen: false }">
    
    <!-- Top Bar -->
    <div class="bg-brand-slate py-2.5 px-6 hidden lg:block">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <i data-lucide="phone" class="w-3 h-3 text-brand-red"></i>
                    <span>{{ $profile->telepon }}</span>
                </div>
                <div class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest border-l border-slate-800 pl-6">
                    <i data-lucide="mail" class="w-3 h-3 text-brand-red"></i>
                    <span>{{ $profile->email }}</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="#" class="text-slate-400 hover:text-brand-red transition-colors"><i data-lucide="facebook" class="w-3.5 h-3.5"></i></a>
                <a href="#" class="text-slate-400 hover:text-brand-red transition-colors"><i data-lucide="instagram" class="w-3.5 h-3.5"></i></a>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-12 h-12 bg-white rounded-2xl shadow-lg border border-slate-50 flex items-center justify-center overflow-hidden group-hover:rotate-3 transition-transform">
                    <img src="{{ asset('assets/website/images/logo.jpg') }}" alt="BSC Logo" class="w-full h-full object-cover">
                </div>
                <div>
                    <h1 class="text-sm font-black text-brand-slate uppercase italic tracking-tight leading-none">Bright Star</h1>
                    <p class="text-[9px] font-black text-brand-red uppercase tracking-[0.2em] mt-0.5">Of Child</p>
                </div>
            </a>

            <!-- Desktop Menu -->
            <ul class="hidden lg:flex items-center gap-8">
                <li><a href="/" class="text-[11px] font-black uppercase tracking-widest @yield('menuIndex') hover:text-brand-red transition-colors">Beranda</a></li>
                <li><a href="/about" class="text-[11px] font-black uppercase tracking-widest @yield('menuAbout') hover:text-brand-red transition-colors">Tentang Kami</a></li>
                <li><a href="/services" class="text-[11px] font-black uppercase tracking-widest @yield('menuServices') hover:text-brand-red transition-colors">Layanan</a></li>
                <li><a href="/therapists" class="text-[11px] font-black uppercase tracking-widest @yield('menuTherapists') hover:text-brand-red transition-colors">Terapis</a></li>
                <li><a href="/contact" class="text-[11px] font-black uppercase tracking-widest @yield('menuContact') hover:text-brand-red transition-colors">Kontak</a></li>
                <li class="ml-4">
                    <a href="{{ route('login') }}" class="bg-brand-red hover:bg-brand-slate text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-red-100 transition-all flex items-center gap-2 italic">
                        Login Dashboard
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </li>
            </ul>

            <!-- Mobile Toggle -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-brand-slate hover:bg-slate-50 rounded-xl transition-all">
                <i data-lucide="menu" x-show="!mobileMenuOpen" class="w-6 h-6"></i>
                <i data-lucide="x" x-show="mobileMenuOpen" class="w-6 h-6" x-cloak></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden absolute top-full left-0 w-full bg-white border-b border-slate-100 shadow-xl py-6 px-6 space-y-4">
            <a href="/" class="block text-[11px] font-black uppercase tracking-widest @yield('menuIndex') py-2 border-b border-slate-50 last:border-0">Beranda</a>
            <a href="/about" class="block text-[11px] font-black uppercase tracking-widest @yield('menuAbout') py-2 border-b border-slate-50 last:border-0">Tentang Kami</a>
            <a href="/services" class="block text-[11px] font-black uppercase tracking-widest @yield('menuServices') py-2 border-b border-slate-50 last:border-0">Layanan</a>
            <a href="/therapists" class="block text-[11px] font-black uppercase tracking-widest @yield('menuTherapists') py-2 border-b border-slate-50 last:border-0">Terapis</a>
            <a href="/contact" class="block text-[11px] font-black uppercase tracking-widest @yield('menuContact') py-2 border-b border-slate-50 last:border-0">Kontak</a>
            <a href="{{ route('login') }}" class="w-full bg-brand-slate text-white py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest text-center italic block mt-6">
                Login Akses Sistem
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-brand-slate text-white pt-24 pb-12 overflow-hidden relative">
        <!-- Decoration -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-red/5 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24">
                <!-- Branding -->
                <div class="lg:col-span-5 space-y-8">
                    <a href="/" class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center p-2 shadow-xl shadow-white/5">
                            <img src="{{ asset('assets/website/images/logo.jpg') }}" alt="Logo" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <h2 class="text-xl font-black uppercase italic tracking-tight">Bright Star <span class="text-brand-red">Of Child</span></h2>
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Integrated Therapy Center</p>
                        </div>
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-md font-medium">
                        Pusat Terapi Anak Berkebutuhan Khusus yang menyediakan layanan terpadu dengan pendekatan klinis modern untuk masa depan buah hati Anda.
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="https://www.facebook.com/brightstarofchild" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-brand-red hover:text-white hover:border-brand-red transition-all group">
                            <i data-lucide="facebook" class="w-4 h-4"></i>
                        </a>
                        <a href="https://www.instagram.com/brightstarofchild" target="_blank" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-brand-red hover:text-white hover:border-brand-red transition-all group">
                            <i data-lucide="instagram" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- Fast Links -->
                <div class="lg:col-span-3">
                    <h5 class="text-xs font-black text-white uppercase tracking-[0.2em] mb-8 border-l-4 border-brand-red pl-4">Tautan Cepat</h5>
                    <ul class="space-y-4">
                        <li><a href="/" class="text-[11px] font-black text-slate-400 uppercase tracking-widest hover:text-brand-red transition-colors flex items-center gap-2 group"><i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i> Beranda</a></li>
                        <li><a href="/about" class="text-[11px] font-black text-slate-400 uppercase tracking-widest hover:text-brand-red transition-colors flex items-center gap-2 group"><i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i> Tentang Kami</a></li>
                        <li><a href="/services" class="text-[11px] font-black text-slate-400 uppercase tracking-widest hover:text-brand-red transition-colors flex items-center gap-2 group"><i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i> Layanan Kami</a></li>
                        <li><a href="/therapists" class="text-[11px] font-black text-slate-400 uppercase tracking-widest hover:text-brand-red transition-colors flex items-center gap-2 group"><i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i> Tim Terapis</a></li>
                        <li><a href="/contact" class="text-[11px] font-black text-slate-400 uppercase tracking-widest hover:text-brand-red transition-colors flex items-center gap-2 group"><i data-lucide="chevron-right" class="w-3 h-3 group-hover:translate-x-1 transition-transform"></i> Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="lg:col-span-4">
                    <h5 class="text-xs font-black text-white uppercase tracking-[0.2em] mb-8 border-l-4 border-brand-red pl-4">Kontak Kami</h5>
                    <div class="bg-white/5 rounded-3xl p-8 border border-white/10 space-y-6">
                        <div class="flex gap-4">
                            <i data-lucide="map-pin" class="w-5 h-5 text-brand-red shrink-0"></i>
                            <div class="space-y-1">
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Lokasi Kami</p>
                                <p class="text-[11px] font-bold text-slate-300 leading-relaxed italic">{{ $profile->alamat }}</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <i data-lucide="phone" class="w-5 h-5 text-brand-red shrink-0"></i>
                            <div class="space-y-1">
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Telepon / WhatsApp</p>
                                <p class="text-[11px] font-bold text-slate-300 italic">{{ $profile->telepon }}</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <i data-lucide="clock" class="w-5 h-5 text-brand-red shrink-0"></i>
                            <div class="space-y-1">
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Jam Operasional</p>
                                <p class="text-[11px] font-bold text-slate-300 italic">Senin - Jumat: 09:00 - 17:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-24 pt-10 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] text-center md:text-left">
                    &copy; {{ date('Y') }} Bright Star Of Child. <span class="text-slate-700 italic">All Rights Reserved.</span>
                </p>
                <div class="flex items-center gap-8">
                    <a href="#" class="text-[10px] font-black text-slate-600 uppercase tracking-widest hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="text-[10px] font-black text-slate-600 uppercase tracking-widest hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <div x-data="{ show: false }" 
         x-init="window.addEventListener('scroll', () => { show = window.pageYOffset > 500 })"
         x-show="show" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-10"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="fixed bottom-10 right-10 z-[60]">
        <button @click="window.scrollTo({top: 0, behavior: 'smooth'})" 
                class="w-14 h-14 bg-brand-red text-white rounded-2xl shadow-2xl shadow-red-500/30 flex items-center justify-center hover:bg-brand-slate hover:scale-110 active:scale-95 transition-all">
            <i data-lucide="arrow-up" class="w-6 h-6"></i>
        </button>
    </div>

    <!-- Scripts -->
    <script>
        lucide.createIcons();
    </script>
    @yield('extra_js')
</body>

</html>

