<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMC Terapi - @yield('title', 'Manajemen Terapi')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-1734059476.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('style')
    
    <style>
        [x-cloak] { display: none !important; }
        
        #sidebar {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-active-indicator {
            @apply ml-auto w-1.5 h-1.5 rounded-full bg-red-500 shadow-[0_0_10px_rgba(220,38,38,0.5)];
        }

        /* Float animation */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }
        .animate-float { animation: float 3s ease-in-out infinite; }
    </style>
</head>

<body class="flex h-screen overflow-hidden text-slate-800 bg-[#f8f7f7]" x-data="{ sidebarOpen: true, mobileSidebar: false }">

    <!-- Mobile Overlay -->
    <div x-show="mobileSidebar" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileSidebar = false"
         class="fixed inset-0 bg-slate-900/50 z-40 backdrop-blur-sm md:hidden">
    </div>

    <!-- Sidebar -->
    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-50 bg-white border-r border-slate-200/80 shadow-[4px_0_24px_rgba(0,0,0,0.02)] flex flex-col transition-all duration-300 md:relative"
           :class="{ 
               'w-60': sidebarOpen, 
               'w-20': !sidebarOpen,
               'translate-x-0': mobileSidebar,
               '-translate-x-full': !mobileSidebar && window.innerWidth < 768,
               'md:translate-x-0': true
           }">

        <!-- Sidebar Header -->
        <div class="p-6 flex items-center justify-between border-b border-slate-100 h-[72px] overflow-hidden">
            <div class="flex items-center gap-3 shrink-0">
                <div class="p-1 rounded-xl bg-white border border-slate-100 shadow-sm w-10 h-10 flex items-center justify-center shrink-0">
                    <img src="{{ asset('assets/images/logo-1734059476.png') }}" alt="Logo" class="w-full h-full object-contain overflow-hidden">
                </div>
                <div class="transition-all duration-300 whitespace-nowrap" x-show="sidebarOpen">
                    <h1 class="font-extrabold text-sm text-slate-800 tracking-tight leading-tight uppercase italic">SMC TERAPI</h1>
                    <p class="text-slate-400 text-[9px] font-black tracking-widest uppercase">Clinical System</p>
                </div>
            </div>
            <button @click="mobileSidebar = false" class="md:hidden text-slate-400 hover:text-red-500">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto scrollbar-hide">
            
            <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3" x-show="sidebarOpen">Main Desktop</p>
            
            <!-- Dashboard -->
            <a href="{{ route('home') }}" class="sidebar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="w-4 h-4 shrink-0 {{ request()->routeIs('home') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Dashboard Overview</span>
                @if(request()->routeIs('home')) <span class="sidebar-active-indicator" x-show="sidebarOpen"></span> @endif
            </a>

            <!-- Data Master -->
            <div class="pt-4" x-show="sidebarOpen">
                <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Master Repository</p>
            </div>

            @can('view terapis')
            <a href="{{ route('terapis.index') }}" class="sidebar-link {{ request()->routeIs('terapis.*') ? 'active' : '' }}">
                <i data-lucide="user-cog" class="w-4 h-4 shrink-0 {{ request()->routeIs('terapis.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Tenaga Terapis</span>
            </a>
            @endcan

            @can('view psikolog')
            <a href="{{ route('psikolog.index') }}" class="sidebar-link {{ request()->routeIs('psikolog.*') ? 'active' : '' }}">
                <i data-lucide="brain" class="w-4 h-4 shrink-0 {{ request()->routeIs('psikolog.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Tim Psikolog</span>
            </a>
            @endcan

            @can('view anak')
            <a href="{{ route('anak.index') }}" class="sidebar-link {{ request()->routeIs('anak.*') ? 'active' : '' }}">
                <i data-lucide="users" class="w-4 h-4 shrink-0 {{ request()->routeIs('anak.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Database Anak</span>
            </a>
            @endcan

            @can('view program')
            <a href="{{ route('program.index') }}" class="sidebar-link {{ request()->routeIs('program.*') ? 'active' : '' }}">
                <i data-lucide="clipboard-list" class="w-4 h-4 shrink-0 {{ request()->routeIs('program.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Program Terapi</span>
            </a>
            @endcan

            @can('view tarif')
            <a href="{{ route('tarif.index') }}" class="sidebar-link {{ request()->routeIs('tarif.*') ? 'active' : '' }}">
                <i data-lucide="tags" class="w-4 h-4 shrink-0 {{ request()->routeIs('tarif.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Paket & Tarif</span>
            </a>
            @endcan

            @can('view alat-ukur')
            <a href="{{ route('alat-ukur.index') }}" class="sidebar-link {{ request()->routeIs('alat-ukur.*') ? 'active' : '' }}">
                <i data-lucide="ruler" class="w-4 h-4 shrink-0 {{ request()->routeIs('alat-ukur.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Alat Ukur Psikologi</span>
            </a>
            @endcan

            <!-- Deteksi Dini Submenu -->
            <div x-data="{ open: {{ (request()->is('question*') || request()->is('age*') || request()->routeIs('question.*')) ? 'true' : 'false' }} }" 
                 x-init="$watch('open', value => { if(value) { /* sync logic if needed */ } })"
                 class="space-y-1">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-500 hover:bg-slate-50/80 hover:text-red-500 transition-all group {{ (request()->is('question*') || request()->is('age*')) ? 'bg-slate-50/80 text-red-500' : '' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="fingerprint" class="w-4 h-4 shrink-0"></i>
                        <span class="text-xs font-bold uppercase tracking-tight" x-show="sidebarOpen">Deteksi Dini</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" :class="{ 'rotate-180': open }" x-show="sidebarOpen"></i>
                </button>
                <div x-show="open" x-cloak class="pl-12 space-y-1 py-1">
                    <a href="{{ route('question.umur') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.umur') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Master Umur</a>
                    <a href="{{ route('question.pendengaran') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.pendengaran') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Pendengaran</a>
                    <a href="{{ route('question.penglihatan') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.penglihatan') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Penglihatan</a>
                    <a href="{{ route('question.perilaku') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.perilaku') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Perilaku</a>
                    <a href="{{ route('question.autis') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.autis') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Autis</a>
                    <a href="{{ route('question.gpph') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.gpph') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">GPPH</a>
                    <a href="{{ route('question.wawancara') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.wawancara') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Wawancara</a>
                </div>
            </div>

            <!-- Operasional -->
            <div class="pt-4" x-show="sidebarOpen">
                <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Clinical Workflow</p>
            </div>

            <div x-data="{ open: {{ (request()->is('observasi*') || request()->is('assessment*') || request()->is('kunjungan*')) ? 'true' : 'false' }} }" 
                 x-init="$watch('open', value => { if(value) { /* sync logic if needed */ } })"
                 class="space-y-1">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-500 hover:bg-slate-50/80 hover:text-red-500 transition-all group {{ (request()->is('observasi*') || request()->is('assessment*') || request()->is('kunjungan*')) ? 'bg-slate-50/80 text-red-500 shadow-sm border border-slate-100' : '' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="activity" class="w-4 h-4 shrink-0"></i>
                        <span class="text-xs font-bold uppercase tracking-tight" x-show="sidebarOpen">Layanan Terapi</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" :class="{ 'rotate-180': open }" x-show="sidebarOpen"></i>
                </button>
                <div x-show="open" x-cloak class="pl-12 space-y-1 py-1 relative">
                    <div class="absolute left-6 top-0 w-px h-full bg-slate-100"></div>
                    <a href="{{ route('kunjungan.index') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('kunjungan.index') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors flex items-center gap-2">
                        <i data-lucide="plus-circle" class="w-3 h-3"></i> Pendaftaran Kunjungan
                    </a>
                    @can('view observasi')
                    <a href="{{ route('observasi.index') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('observasi.*') ? 'text-red-500 shadow-none' : 'text-slate-400' }} hover:text-red-500 transition-colors">Observasi</a>
                    @endcan
                    @can('view assessment')
                    <a href="{{ route('assessment.index') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('assessment.*') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Assessment</a>
                    @endcan
                    <a href="{{ route('kunjungan.data') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('kunjungan.data') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Riwayat Terapi</a>
                </div>
            </div>

            @can('view jadwal')
            <a href="{{ route('jadwal.index') }}" class="sidebar-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                <i data-lucide="calendar-days" class="w-4 h-4 shrink-0 {{ request()->routeIs('jadwal.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Jadwal Anak</span>
            </a>
            @endcan

            <!-- Keuangan -->
            <div class="pt-4" x-show="sidebarOpen">
                <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">E-Finance & Shop</p>
            </div>

            <div x-data="{ open: {{ (request()->is('keuangan*') || request()->routeIs('keuangan.*')) ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-500 hover:bg-slate-50/80 hover:text-red-500 transition-all group {{ request()->is('keuangan*') ? 'bg-slate-50/80 text-red-500' : '' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="banknote" class="w-4 h-4 shrink-0"></i>
                        <span class="text-xs font-bold uppercase tracking-tight" x-show="sidebarOpen">Keuangan</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" :class="{ 'rotate-180': open }" x-show="sidebarOpen"></i>
                </button>
                <div x-show="open" x-cloak class="pl-12 space-y-1 py-1">
                    @can('view rekapan kas')
                    <a href="{{ route('keuangan.rekap') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('keuangan.rekap') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Rekap Kas</a>
                    @endcan
                    @can('view pemasukkan')
                    <a href="{{ route('keuangan.pemasukkan') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('keuangan.pemasukkan') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Pemasukkan</a>
                    @endcan
                    @can('view pengeluaran')
                    <a href="{{ route('keuangan.pengeluaran') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('keuangan.pengeluaran') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Pengeluaran</a>
                    @endcan
                    @can('view kategori')
                    <a href="{{ route('keuangan.kategori') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('keuangan.kategori') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Kategori Kas</a>
                    @endcan
                </div>
            </div>

            <a href="{{ route('products.index') }}" class="sidebar-link {{ request()->routeIs('products.index') ? 'active' : '' }}">
                <i data-lucide="shopping-bag" class="w-4 h-4 shrink-0 {{ request()->routeIs('products.index') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Online Store</span>
            </a>

            <!-- Analysis & Training -->
            <div class="pt-4" x-show="sidebarOpen">
                <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Analysis & Insight</p>
            </div>

            <a href="{{ route('pelatihan.index') }}" class="sidebar-link {{ request()->routeIs('pelatihan.index') ? 'active' : '' }}">
                <i data-lucide="graduation-cap" class="w-4 h-4 shrink-0 {{ request()->routeIs('pelatihan.index') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Katalog Pelatihan</span>
            </a>

            <a href="{{ route('analisis.kinerja') }}" class="sidebar-link {{ request()->routeIs('analisis.kinerja') ? 'active' : '' }}">
                <i data-lucide="bar-chart-big" class="w-4 h-4 shrink-0 {{ request()->routeIs('analisis.kinerja') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Analisis Kinerja</span>
            </a>

            <!-- User Management -->
            <div class="pt-4" x-show="sidebarOpen">
                <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">System & Access</p>
            </div>

            <div x-data="{ open: {{ (request()->is('roles*') || request()->is('permissions*') || request()->is('users*') || request()->is('manajemen-menu*')) ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-500 hover:bg-slate-50/80 hover:text-red-500 transition-all group {{ request()->is('roles*') ? 'bg-slate-50/80 text-red-500' : '' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="shield-alert" class="w-4 h-4 shrink-0"></i>
                        <span class="text-xs font-bold uppercase tracking-tight" x-show="sidebarOpen">Manajemen Akses</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" :class="{ 'rotate-180': open }" x-show="sidebarOpen"></i>
                </button>
                <div x-show="open" x-cloak class="pl-12 space-y-1 py-1">
                    @can('view role')
                    <a href="{{ route('roles.index') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('roles.*') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Roles / Group</a>
                    @endcan
                    @can('view permission')
                    <a href="{{ route('permissions.index') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('permissions.*') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Permissions</a>
                    @endcan
                    @can('view user')
                    <a href="{{ route('users.index') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('users.*') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">User Pengguna</a>
                    @endcan
                     @can('view manajemen menu')
                    <a href="{{ url('manajemen-menu') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->is('manajemen-menu*') ? 'text-red-500' : 'text-slate-400' }} hover:text-red-500 transition-colors">Manajemen Menu</a>
                    @endcan
                </div>
            </div>

            <!-- Others -->
            @can('view career')
            <a href="/career" class="sidebar-link {{ request()->is('career*') ? 'active' : '' }}">
                <i data-lucide="briefcase" class="w-4 h-4 shrink-0 {{ request()->is('career*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Career Room</span>
            </a>
            @endcan

            @can('view informasi')
            <a href="/informasi" class="sidebar-link py-2 scale-90 opacity-70 hover:opacity-100 {{ request()->is('informasi*') ? 'active' : '' }}">
                <i data-lucide="info" class="w-4 h-4 shrink-0 {{ request()->is('informasi*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-[10px] font-black uppercase tracking-tight">Informasi</span>
            </a>
            @endcan

            <!-- Settings -->
            <div class="pt-4" x-show="sidebarOpen">
                <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Pengaturan</p>
            </div>

            <a href="{{ route('profile.index') }}" class="sidebar-link py-2 scale-90 opacity-70 hover:opacity-100 {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                <i data-lucide="settings" class="w-4 h-4 shrink-0 {{ request()->routeIs('profile.index') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-[10px] font-black uppercase tracking-tight">Profil Yayasan</span>
            </a>

            <a href="{{ route('profile.user') }}" class="sidebar-link py-2 scale-90 opacity-70 hover:opacity-100 {{ request()->routeIs('profile.user') ? 'active' : '' }}">
                <i data-lucide="user-circle" class="w-4 h-4 shrink-0 {{ request()->routeIs('profile.user') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="sidebarOpen" class="text-[10px] font-black uppercase tracking-tight">Keamanan Akun</span>
            </a>

            <!-- Penutup Footer Sidebar -->
            <div class="mt-auto p-4">
                <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-100" x-show="sidebarOpen">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-red-600 font-bold shadow-sm">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs font-extrabold text-slate-800 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider">{{ auth()->user()->roles->first()->name ?? 'Administrator' }}</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-white text-red-500 hover:bg-red-50 hover:text-red-600 rounded-xl font-bold text-[11px] transition-all border border-slate-200 hover:border-red-100 shadow-sm">
                            <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
        
        <!-- Header -->
        <header class="h-[72px] bg-white/80 backdrop-blur-md border-b border-slate-200/60 flex items-center justify-between px-6 shrink-0 z-20">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen; mobileSidebar = !mobileSidebar" class="p-2.5 text-slate-500 hover:text-red-500 bg-white border border-slate-200 rounded-xl shadow-sm transition-all focus:ring-2 focus:ring-red-100">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <div class="hidden sm:block">
                    <h2 class="text-lg font-extrabold text-slate-800 tracking-tight leading-none">@yield('title')</h2>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden md:flex items-center gap-2 text-[11px] font-bold text-slate-500 bg-slate-50 px-3 py-1.5 rounded-full border border-slate-100">
                    <i data-lucide="clock" class="w-3.5 h-3.5 text-red-500"></i>
                    <span id="realtime-clock">00:00:00</span>
                </div>
                
                <div class="w-px h-6 bg-slate-200 mx-2"></div>

                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-extrabold text-slate-800 leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 font-bold mt-1 uppercase tracking-tighter">Level: {{ auth()->user()->roles->first()->name ?? 'Admin' }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-red-50 border border-red-100 flex items-center justify-center text-red-600 font-extrabold text-sm shadow-sm shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="flex-1 overflow-y-auto p-6 md:p-8">
            @yield('content')

            <!-- Footer -->
            <footer class="mt-auto py-8 text-center border-t border-slate-100 mt-12">
                <p class="text-[10px] font-bold text-slate-300 uppercase tracking-[0.2em]">&copy; 2026 BRIGHT STAR - SMC TERAPI SYSTEM</p>
            </footer>
        </div>
    </main>

    @yield('scripts')
    
    <script>
        // Init Lucide
        lucide.createIcons();

        // Clock
        function updateClock() {
            const now = new Date();
            const el = document.getElementById('realtime-clock');
            if (el) el.innerText = now.toLocaleTimeString('id-ID', { hour12: false });
        }
        updateClock();
        setInterval(updateClock, 1000);

        // SweetAlert config
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });

        @if(session('success'))
            Toast.fire({ icon: 'success', title: '{{ session('success') }}' });
        @endif
        @if(session('error'))
            Toast.fire({ icon: 'error', title: '{{ session('error') }}' });
        @endif

        // Global Delete Confirmation
        $(document).on('click', '.btn-hapus', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const name = $(this).data('name') || 'data ini';

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus ${name}? Tindakan ini tidak dapat dibatalkan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-[2.5rem] border-none shadow-2xl',
                    confirmButton: 'rounded-xl font-bold uppercase text-[10px] tracking-widest px-8 py-4',
                    cancelButton: 'rounded-xl font-bold uppercase text-[10px] tracking-widest px-8 py-4 text-slate-500'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
