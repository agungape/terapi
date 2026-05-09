<div x-show="sidebarOpen" class="fixed inset-0 z-50 overflow-hidden" x-cloak>
    <!-- Backdrop -->
    <div x-show="sidebarOpen" x-transition:enter="ease-in-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="sidebarOpen = false"></div>

    <div class="fixed inset-y-0 left-0 max-w-full flex">
        <!-- Sidebar Content -->
        <div x-show="sidebarOpen" x-transition:enter="transform transition ease-in-out duration-300" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="w-screen max-w-xs bg-white shadow-2xl flex flex-col">
            
            <!-- Header -->
            <div class="p-6 bg-sky-600 text-white flex items-center gap-4">
                <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-white flex-shrink-0">
                    <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/foto-anak/small.png') }}" alt="avatar" class="w-full h-full object-cover">
                </div>
                <div class="overflow-hidden">
                    <h5 class="font-bold truncate">{{ $anak->nama }}</h5>
                    <span class="text-sky-100 text-sm">Bright Star of Child</span>
                </div>
            </div>

            <!-- Links -->
            <div class="flex-1 overflow-y-auto p-4">
                <nav class="space-y-1">
                    <a href="{{ route('app') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50">
                        <i data-lucide="home" class="w-5 h-5 text-slate-500"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('mobile.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50">
                        <i data-lucide="user" class="w-5 h-5 text-slate-500"></i>
                        <span>Profile</span>
                    </a>
                    <a href="{{ route('mobile.payment') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50">
                        <i data-lucide="credit-card" class="w-5 h-5 text-slate-500"></i>
                        <span>Pembayaran</span>
                    </a>
                    
                    <hr class="my-4 border-slate-100">
                    
                    <a href="#" @click.prevent="logoutModalOpen = true; sidebarOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50">
                        <i data-lucide="log-out" class="w-5 h-5 text-red-500"></i>
                        <span>Logout</span>
                    </a>
                </nav>
            </div>

            <!-- Footer -->
            <div class="p-6 border-t border-slate-100 text-slate-500 text-sm">
                <h6 class="font-semibold text-slate-700">Bright Star Of Child</h6>
                <span>App Version 1.01</span>
            </div>
        </div>
    </div>
</div>
