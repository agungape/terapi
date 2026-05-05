@php
    $profile = \App\Models\Profile::first();
    $primaryColor = $profile->warna_primer ?? '#ef4444';
    
    // Convert hex to rgb for opacity support
    list($r, $g, $b) = sscanf($primaryColor, "#%02x%02x%02x");
    $primaryRgb = "$r, $g, $b";
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->nama_apk ?? 'SMC Terapi' }} - @yield('title', 'Manajemen Terapi')</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/' . ($profile->logo ?? '')) }}">
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
    
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    @yield('style')
    
    <style>
        :root {
            --primary-color: {{ $primaryColor }};
            --primary-color-rgb: {{ $primaryRgb }};
            --primary-color-light: rgba({{ $primaryRgb }}, 0.15);
            --primary-50: rgba({{ $primaryRgb }}, 0.08);
            --primary-100: rgba({{ $primaryRgb }}, 0.2);
            --primary-200: rgba({{ $primaryRgb }}, 0.3);
            --primary-500: {{ $primaryColor }};
            --primary-600: {{ $primaryColor }};
        }

        [x-cloak] { display: none !important; }
        
        /* Custom Primary Utilities - Ensuring ALL Primary variants are defined */
        .bg-primary-50 { background-color: var(--primary-50) !important; }
        .bg-primary-100 { background-color: var(--primary-100) !important; }
        .bg-primary-200 { background-color: var(--primary-200) !important; }
        .bg-primary-300 { background-color: var(--primary-300) !important; }
        .bg-primary-400 { background-color: var(--primary-400) !important; }
        .bg-primary-500, .bg-primary-600, .bg-primary-700, .bg-primary-800, .bg-primary-900 { background-color: var(--primary-color) !important; }
        
        .hover\:bg-primary-50:hover { background-color: var(--primary-50) !important; }
        .hover\:bg-primary-100:hover { background-color: var(--primary-100) !important; }
        .hover\:bg-primary-500:hover, .hover\:bg-primary-600:hover, .hover\:bg-primary-700:hover { background-color: var(--primary-color) !important; filter: brightness(0.9); }
        
        .text-primary-50 { color: var(--primary-50) !important; }
        .text-primary-100 { color: var(--primary-100) !important; }
        .text-primary-200 { color: var(--primary-200) !important; }
        .text-primary-300 { color: var(--primary-300) !important; }
        .text-primary-400 { color: var(--primary-400) !important; }
        .text-primary-500, .text-primary-600, .text-primary-700, .text-primary-800, .text-primary-900 { color: var(--primary-color) !important; }
        
        .border-primary-50 { border-color: var(--primary-50) !important; }
        .border-primary-100 { border-color: var(--primary-100) !important; }
        .border-primary-500, .border-primary-600 { border-color: var(--primary-color) !important; }
        
        .focus\:ring-primary-50:focus { --tw-ring-color: var(--primary-100) !important; }
        .focus\:ring-primary-500:focus { --tw-ring-color: var(--primary-color) !important; }
        .shadow-primary-100 { --tw-shadow-color: var(--primary-100) !important; }
        .shadow-primary-500 { --tw-shadow-color: var(--primary-color) !important; }

        /* Powerful Global Overrides - Redirecting ALL RED variants to PRIMARY */
        /* Text Colors */
        .text-red-50:not(.btn-danger):not(.btn-hapus), 
        .text-red-100:not(.btn-danger):not(.btn-hapus), 
        .text-red-200:not(.btn-danger):not(.btn-hapus), 
        .text-red-300:not(.btn-danger):not(.btn-hapus), 
        .text-red-400:not(.btn-danger):not(.btn-hapus) { color: var(--primary-100) !important; }
        .text-red-500:not(.btn-danger):not(.btn-hapus), 
        .text-red-600:not(.btn-danger):not(.btn-hapus), 
        .text-red-700:not(.btn-danger):not(.btn-hapus), 
        .text-red-800:not(.btn-danger):not(.btn-hapus), 
        .text-red-900:not(.btn-danger):not(.btn-hapus), 
        .text-danger:not(.btn-danger):not(.btn-hapus) { color: var(--primary-color) !important; }
        
        /* Background Colors */
        .bg-red-50:not(.btn-danger):not(.btn-hapus) { background-color: var(--primary-50) !important; }
        .bg-red-100:not(.btn-danger):not(.btn-hapus) { background-color: var(--primary-100) !important; }
        .bg-red-200:not(.btn-danger):not(.btn-hapus) { background-color: var(--primary-200) !important; }
        .bg-red-500:not(.btn-danger):not(.btn-hapus), 
        .bg-red-600:not(.btn-danger):not(.btn-hapus), 
        .bg-red-700:not(.btn-danger):not(.btn-hapus), 
        .bg-red-800:not(.btn-danger):not(.btn-hapus), 
        .bg-red-900:not(.btn-danger):not(.btn-hapus) { background-color: var(--primary-color) !important; }
        
        /* Gradients */
        .from-red-400:not(.btn-danger):not(.btn-hapus) { --tw-gradient-from: var(--primary-color) !important; --tw-gradient-to: var(--primary-color) !important; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to) !important; }
        .from-red-500:not(.btn-danger):not(.btn-hapus) { --tw-gradient-from: var(--primary-color) !important; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to) !important; }
        .from-red-600:not(.btn-danger):not(.btn-hapus) { --tw-gradient-from: var(--primary-color) !important; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to) !important; }
        .to-red-600:not(.btn-danger):not(.btn-hapus) { --tw-gradient-to: var(--primary-color) !important; }
        .to-red-700:not(.btn-danger):not(.btn-hapus) { --tw-gradient-to: var(--primary-color) !important; }
        
        /* Border Colors */
        .border-red-50:not(.btn-danger):not(.btn-hapus), 
        .border-red-100:not(.btn-danger):not(.btn-hapus), 
        .border-red-200:not(.btn-danger):not(.btn-hapus) { border-color: var(--primary-100) !important; }
        .border-red-500:not(.btn-danger):not(.btn-hapus), 
        .border-red-600:not(.btn-danger):not(.btn-hapus) { border-color: var(--primary-color) !important; }
        
        /* Ring & Focus */
        .focus\:ring-red-50:focus, .focus\:ring-red-100:focus, .focus\:ring-red-200:focus, .focus\:ring-red-500:focus, .focus\:ring-primary-50:focus { 
            --tw-ring-color: var(--primary-100) !important; 
        }
        
        /* Shadows */
        .shadow-red-50:not(.btn-danger):not(.btn-hapus), 
        .shadow-red-100:not(.btn-danger):not(.btn-hapus), 
        .shadow-red-200:not(.btn-danger):not(.btn-hapus), 
        .shadow-red-500:not(.btn-danger):not(.btn-hapus), 
        .shadow-primary-100 { 
            --tw-shadow-color: var(--primary-100) !important; 
            --tw-shadow: var(--tw-shadow-colored) !important;
        }

        /* Hover States */
        .hover\:bg-red-600:not(.btn-danger):not(.btn-hapus):hover, 
        .hover\:bg-red-500:not(.btn-danger):not(.btn-hapus):hover { background-color: var(--primary-color) !important; filter: brightness(0.9); }
        .hover\:text-red-600:not(.btn-danger):not(.btn-hapus):hover, 
        .hover\:text-red-500:not(.btn-danger):not(.btn-hapus):hover { color: var(--primary-color) !important; filter: brightness(0.9); }
        .hover\:border-red-500:not(.btn-danger):not(.btn-hapus):hover { border-color: var(--primary-color) !important; }

        /* Decorations & Accents */
        .decoration-red-200, .decoration-red-500 { text-decoration-color: var(--primary-color) !important; }
        .accent-red-500 { accent-color: var(--primary-color) !important; }

        /* Sidebar Active State Overrides */
        .sidebar-link.active {
            background-color: var(--primary-50);
            color: var(--primary-color);
        }

        /* Global Premium Scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: var(--primary-100); border-radius: 10px; border: 2px solid #f1f5f9; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary-color); opacity: 0.8; }

        #sidebar {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar-active-indicator {
            background-color: var(--primary-color);
            @apply ml-auto w-1.5 h-1.5 rounded-full;
            box-shadow: 0 0 10px rgba(var(--primary-color-rgb), 0.5);
        }

        /* Float animation */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }
        .animate-float { animation: float 3s ease-in-out infinite; }

        /* Card Premium Utility */
        .card-premium {
            @apply bg-white border border-slate-200/60 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)] transition-all duration-300;
        }
        .card-premium:hover {
            @apply shadow-[0_8px_40px_rgb(0,0,0,0.05)] border-slate-300/50;
        }

        /* Glassmorphism utility */
        .glass {
            @apply bg-white/70 backdrop-blur-md border border-white/20;
        }
    </style>

    <script>
        window.primaryColor = "{{ $primaryColor }}";
        window.primaryColorRgb = "{{ $primaryRgb }}";

        // Global SweetAlert Config
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Swal !== 'undefined') {
                window.SwalCustom = Swal.mixin({
                    confirmButtonColor: window.primaryColor,
                    cancelButtonColor: '#94a3b8',
                });
            }
        });
    </script>
</head>

<body class="flex bg-[#f8fafc] font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 antialiased h-screen overflow-hidden" 
      x-data="{ 
        isMobile: window.innerWidth < 1024,
        sidebarOpen: window.innerWidth > 1024, 
        mobileSidebar: false,
        get isSidebarOpen() {
            return this.isMobile ? this.mobileSidebar : this.sidebarOpen;
        }
      }"
      x-init="
        if (isMobile) sidebarOpen = true;
        window.addEventListener('resize', () => { 
            isMobile = window.innerWidth < 1024;
            if (isMobile) {
                sidebarOpen = true;
            } else {
                mobileSidebar = false;
            }
        })
      ">

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
           class="fixed inset-y-0 left-0 z-50 bg-white border-r border-slate-200/80 shadow-[4px_0_24px_rgba(0,0,0,0.02)] flex flex-col transition-all duration-300"
           :class="{ 
               'w-64': sidebarOpen && !isMobile, 
               'w-20': !sidebarOpen && !isMobile,
               'w-64 translate-x-0': mobileSidebar && isMobile,
               '-translate-x-full': !mobileSidebar && isMobile,
               'relative': !isMobile,
               'fixed': isMobile
           }">

        <!-- Sidebar Header -->
        <div class="p-6 flex items-center justify-between border-b border-slate-100 h-[72px] overflow-hidden">
            <div class="flex items-center gap-3 shrink-0">
                <div class="p-1 rounded-xl bg-white border border-slate-100 shadow-sm w-10 h-10 flex items-center justify-center shrink-0">
                    <img src="{{ asset('storage/logo/' . ($profile->logo ?? 'logo.jpg')) }}" alt="Logo" class="w-full h-full object-contain overflow-hidden">
                </div>
                <div class="transition-all duration-300 whitespace-nowrap" x-show="isMobile ? true : sidebarOpen">
                    <h1 class="font-extrabold text-sm text-slate-800 tracking-tight leading-tight uppercase italic">{{ $profile->nama_apk ?? 'SMC TERAPI' }}</h1>
                    <p class="text-slate-400 text-[9px] font-black tracking-widest uppercase">{{ $profile->nama ?? 'Clinical System' }}</p>
                </div>
            </div>
            <button @click="mobileSidebar = false" class="md:hidden text-slate-400 hover:text-primary-500">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto scrollbar-hide">
            

            
            <!-- Dashboard -->
            <a href="{{ route('home') }}" class="sidebar-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="w-4 h-4 shrink-0 {{ request()->routeIs('home') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Dashboard Overview</span>
                @if(request()->routeIs('home')) <span class="sidebar-active-indicator" x-show="sidebarOpen"></span> @endif
            </a>



            @can('view terapis')
            <a href="{{ route('terapis.index') }}" class="sidebar-link {{ request()->routeIs('terapis.*') ? 'active' : '' }}">
                <i data-lucide="user-cog" class="w-4 h-4 shrink-0 {{ request()->routeIs('terapis.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Tenaga Terapis</span>
            </a>
            @endcan

            @can('view psikolog')
            <a href="{{ route('psikolog.index') }}" class="sidebar-link {{ request()->routeIs('psikolog.*') ? 'active' : '' }}">
                <i data-lucide="brain" class="w-4 h-4 shrink-0 {{ request()->routeIs('psikolog.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Tim Psikolog</span>
            </a>
            @endcan

            @can('view anak')
            <a href="{{ route('anak.index') }}" class="sidebar-link {{ request()->routeIs('anak.*') ? 'active' : '' }}">
                <i data-lucide="users" class="w-4 h-4 shrink-0 {{ request()->routeIs('anak.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Database Anak</span>
            </a>
            @endcan

            @can('view program anak')
            <a href="{{ route('program.index') }}" class="sidebar-link {{ request()->routeIs('program.*') ? 'active' : '' }}">
                <i data-lucide="clipboard-list" class="w-4 h-4 shrink-0 {{ request()->routeIs('program.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Program Terapi</span>
            </a>
            @endcan

            @can('view tarif')
            <a href="{{ route('tarif.index') }}" class="sidebar-link {{ request()->routeIs('tarif.*') ? 'active' : '' }}">
                <i data-lucide="tags" class="w-4 h-4 shrink-0 {{ request()->routeIs('tarif.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Paket & Tarif</span>
            </a>
            @endcan

            @can('view alat ukur')
            <a href="{{ route('alat-ukur.index') }}" class="sidebar-link {{ request()->routeIs('alat-ukur.*') ? 'active' : '' }}">
                <i data-lucide="ruler" class="w-4 h-4 shrink-0 {{ request()->routeIs('alat-ukur.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Alat Ukur Psikologi</span>
            </a>
            @endcan

            <!-- Deteksi Dini Submenu -->
            @canany(['view pendengaran', 'view penglihatan', 'view perilaku', 'view autis', 'view gpph', 'view wawancara', 'view master umur'])
            <div x-data="{ open: {{ (request()->is('question*') || request()->is('age*') || request()->routeIs('question.*')) ? 'true' : 'false' }} }" 
                 x-init="$watch('open', value => { if(value) { /* sync logic if needed */ } })"
                 class="space-y-1">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-500 hover:bg-slate-50/80 hover:text-primary-500 transition-all group {{ (request()->is('question*') || request()->is('age*')) ? 'bg-slate-50/80 text-red-500' : '' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="fingerprint" class="w-4 h-4 shrink-0"></i>
                        <span class="text-xs font-bold uppercase tracking-tight" x-show="sidebarOpen">Deteksi Dini</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" :class="{ 'rotate-180': open }" x-show="sidebarOpen"></i>
                </button>
                <div x-show="open" x-cloak class="pl-12 space-y-1 py-1">
                    @can('view master umur')
                    <a href="{{ route('question.umur') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.umur') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Master Umur</a>
                    @endcan
                    @can('view pendengaran')
                    <a href="{{ route('question.pendengaran') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.pendengaran') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Pendengaran</a>
                    @endcan
                    @can('view penglihatan')
                    <a href="{{ route('question.penglihatan') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.penglihatan') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Penglihatan</a>
                    @endcan
                    @can('view perilaku')
                    <a href="{{ route('question.perilaku') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.perilaku') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Perilaku</a>
                    @endcan
                    @can('view autis')
                    <a href="{{ route('question.autis') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.autis') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Autis</a>
                    @endcan
                    @can('view gpph')
                    <a href="{{ route('question.gpph') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.gpph') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">GPPH</a>
                    @endcan
                    @can('view wawancara')
                    <a href="{{ route('question.wawancara') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('question.wawancara') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Wawancara</a>
                    @endcan
                </div>
            </div>
            @endcanany



            @canany(['view kunjungan', 'view observasi', 'view assessment', 'view riwayat terapi'])
            <div x-data="{ open: {{ (request()->is('observasi*') || request()->is('assessment*') || request()->is('kunjungan*')) ? 'true' : 'false' }} }" 
                 x-init="$watch('open', value => { if(value) { /* sync logic if needed */ } })"
                 class="space-y-1">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-500 hover:bg-slate-50/80 hover:text-primary-500 transition-all group {{ (request()->is('observasi*') || request()->is('assessment*') || request()->is('kunjungan*') || request()->is('data*')) ? 'bg-slate-50/80 text-red-500 shadow-sm border border-slate-100' : '' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="activity" class="w-4 h-4 shrink-0"></i>
                        <span class="text-xs font-bold uppercase tracking-tight" x-show="sidebarOpen">Layanan Terapi</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" :class="{ 'rotate-180': open }" x-show="sidebarOpen"></i>
                </button>
                <div x-show="open" x-cloak class="pl-12 space-y-1 py-1 relative">
                    <div class="absolute left-6 top-0 w-px h-full bg-slate-100"></div>
                    @can('view kunjungan')
                    <a href="{{ route('kunjungan.index') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('kunjungan.index') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors flex items-center gap-2">
                        Pendaftaran Kunjungan
                    </a>
                    @endcan
                    @can('view observasi')
                    <a href="{{ route('observasi.index') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('observasi.*') ? 'text-red-500 shadow-none' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Observasi</a>
                    @endcan
                    @can('view assessment')
                    <a href="{{ route('assessment.index') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('assessment.*') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Assessment</a>
                    @endcan
                    @can('view riwayat terapi')
                    <a href="{{ route('kunjungan.data') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ (request()->routeIs('kunjungan.data') || request()->routeIs('kunjungan.detail')) ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Riwayat Terapi</a>
                    @endcan
                </div>
            </div>
            @endcanany

            @can('view jadwal anak')
            <a href="{{ route('jadwal.index') }}" class="sidebar-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                <i data-lucide="calendar-days" class="w-4 h-4 shrink-0 {{ request()->routeIs('jadwal.*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Jadwal Anak</span>
            </a>
            @endcan



            @canany(['view rekapan kas', 'view pemasukkan', 'view pengeluaran', 'view kategori', 'view laporan keuangan'])
            <div x-data="{ open: {{ (request()->is('keuangan*') || request()->routeIs('keuangan.*') || request()->is('kategori*') || request()->is('pemasukkan*') || request()->is('pengeluaran*') || request()->is('laporan-keuangan*')) ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-500 hover:bg-slate-50/80 hover:text-primary-500 transition-all group {{ request()->is('keuangan*') ? 'bg-slate-50/80 text-red-500' : '' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="banknote" class="w-4 h-4 shrink-0"></i>
                        <span class="text-xs font-bold uppercase tracking-tight" x-show="sidebarOpen">Keuangan</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" :class="{ 'rotate-180': open }" x-show="sidebarOpen"></i>
                </button>
                <div x-show="open" x-cloak class="pl-12 space-y-1 py-1">
                    @can('view rekapan kas')
                    <a href="{{ route('keuangan.rekap') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('keuangan.rekap') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Rekap Kas</a>
                    @endcan
                    @can('view pemasukkan')
                    <a href="{{ route('keuangan.pemasukkan') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('keuangan.pemasukkan') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Pemasukkan</a>
                    @endcan
                    @can('view pengeluaran')
                    <a href="{{ route('keuangan.pengeluaran') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('keuangan.pengeluaran') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Pengeluaran</a>
                    @endcan
                    @can('view kategori')
                    <a href="{{ route('keuangan.kategori') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('keuangan.kategori') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Kategori Kas</a>
                    @endcan
                    @can('view laporan keuangan')
                    <a href="{{ route('keuangan.laporan') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('keuangan.laporan') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Laporan Keuangan</a>
                    @endcan
                </div>
            </div>
            @endcanany

            {{-- <a href="{{ route('products.index') }}" class="sidebar-link {{ request()->routeIs('products.index') ? 'active' : '' }}">
                <i data-lucide="shopping-bag" class="w-4 h-4 shrink-0 {{ request()->routeIs('products.index') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Online Store</span>
            </a> --}}



            @can('view pelatihan')
            <a href="{{ route('pelatihan.index') }}" class="sidebar-link {{ request()->routeIs('pelatihan.index') ? 'active' : '' }}">
                <i data-lucide="graduation-cap" class="w-4 h-4 shrink-0 {{ request()->routeIs('pelatihan.index') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Katalog Pelatihan</span>
            </a>
            @endcan

            @can('view analisis kinerja')
            <a href="{{ route('analisis.kinerja') }}" class="sidebar-link {{ request()->routeIs('analisis.kinerja') ? 'active' : '' }}">
                <i data-lucide="bar-chart-big" class="w-4 h-4 shrink-0 {{ request()->routeIs('analisis.kinerja') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Analisis Kinerja</span>
            </a>
            @endcan



            @canany(['view role', 'view permission', 'view user', 'view manajemen menu'])
            <div x-data="{ open: {{ (request()->is('roles*') || request()->is('permissions*') || request()->is('users*') || request()->is('manajemen-menu*')) ? 'true' : 'false' }} }" class="space-y-1">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-500 hover:bg-slate-50/80 hover:text-primary-500 transition-all group {{ request()->is('roles*') ? 'bg-slate-50/80 text-red-500' : '' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="shield-alert" class="w-4 h-4 shrink-0"></i>
                        <span class="text-xs font-bold uppercase tracking-tight" x-show="sidebarOpen">Manajemen Akses</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" :class="{ 'rotate-180': open }" x-show="sidebarOpen"></i>
                </button>
                <div x-show="open" x-cloak class="pl-12 space-y-1 py-1">
                    @can('view role')
                    <a href="{{ route('roles.index') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('roles.*') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Roles / Group</a>
                    @endcan
                    @can('view permission')
                    <a href="{{ route('permissions.index') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('permissions.*') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Permissions</a>
                    @endcan
                    @can('view user')
                    <a href="{{ route('users.index') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->routeIs('users.*') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">User Pengguna</a>
                    @endcan
                     @can('view manajemen menu')
                    <a href="{{ url('manajemen-menu') }}" class="block py-2 text-[10px] font-black uppercase tracking-tight {{ request()->is('manajemen-menu*') ? 'text-red-500' : 'text-slate-400' }} hover:text-primary-500 transition-colors">Manajemen Menu</a>
                    @endcan
                </div>
            </div>
            @endcanany

            <!-- Others -->
            @can('view career')
            <a href="/career" class="sidebar-link {{ request()->is('career*') ? 'active' : '' }}">
                <i data-lucide="briefcase" class="w-4 h-4 shrink-0 {{ request()->is('career*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Career Room</span>
            </a>
            @endcan

            @can('view informasi')
            <a href="/informasi" class="sidebar-link {{ request()->is('informasi*') ? 'active' : '' }}">
                <i data-lucide="info" class="w-4 h-4 shrink-0 {{ request()->is('informasi*') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Informasi</span>
            </a>
            @endcan



            @can('view profile')
            <a href="{{ route('profile.index') }}" class="sidebar-link {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                <i data-lucide="settings" class="w-4 h-4 shrink-0 {{ request()->routeIs('profile.index') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Profil Yayasan</span>
            </a>
            @endcan

            <a href="{{ route('profile.user') }}" class="sidebar-link {{ request()->routeIs('profile.user') ? 'active' : '' }}">
                <i data-lucide="user-circle" class="w-4 h-4 shrink-0 {{ request()->routeIs('profile.user') ? 'text-red-500' : 'text-slate-400' }}"></i>
                <span x-show="isMobile ? true : sidebarOpen" class="text-xs font-bold uppercase tracking-tight">Keamanan Akun</span>
            </a>

            <!-- Penutup Footer Sidebar -->
            <div class="mt-auto p-4">
                <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-100" x-show="isMobile ? true : sidebarOpen">
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
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-white text-red-500 hover:bg-red-50 hover:text-red-600 rounded-xl font-bold text-[11px] transition-all border border-slate-200 hover:border-red-100 shadow-sm btn-logout">
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
                <button @click="isMobile ? mobileSidebar = !mobileSidebar : sidebarOpen = !sidebarOpen" class="p-2.5 text-slate-500 hover:text-primary-500 bg-white border border-slate-200 rounded-xl shadow-sm transition-all focus:ring-2 focus:ring-primary-50">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <div class="hidden sm:block">
                    <h2 class="text-lg font-extrabold text-slate-800 tracking-tight leading-none">@yield('title')</h2>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden md:flex items-center gap-2 text-[11px] font-bold text-slate-500 bg-slate-50 px-3 py-1.5 rounded-full border border-slate-100">
                    <i data-lucide="clock" class="text-primary-500 w-3.5 h-3.5"></i>
                    <span id="realtime-clock">00:00:00</span>
                </div>
                
                <div class="w-px h-6 bg-slate-200 mx-2"></div>

                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-extrabold text-slate-800 leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 font-bold mt-1 uppercase tracking-tighter">Level: {{ auth()->user()->roles->first()->name ?? 'Admin' }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-primary-50 border border-primary-100 flex items-center justify-center text-primary-600 font-extrabold text-sm shadow-sm shrink-0">
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
                <p class="text-[10px] font-bold text-slate-300 uppercase tracking-[0.2em]">&copy; 2026 {{ $profile->nama_apk ?? 'BRIGHT STAR' }} - {{ $profile->nama ?? 'CLINICAL SYSTEM' }}</p>
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
        
        // Logout Confirmation
        $(document).on('click', '.btn-logout', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');

            Swal.fire({
                title: 'Konfirmasi Keluar',
                text: "Apakah Anda yakin ingin mengakhiri sesi ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: window.primaryColor || '#ef4444',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Ya, Keluar!',
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
