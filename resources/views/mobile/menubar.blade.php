<div class="fixed bottom-0 inset-x-0 bg-white border-t border-slate-100 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] z-40">
    <div class="flex justify-around items-center h-16">
        <a href="{{ route('mobile.payment') }}" class="nav-link flex flex-col items-center justify-center w-full h-full text-slate-400 hover:text-sky-600 @yield('mobilePayment')">
            <i data-lucide="credit-card" class="w-5 h-5"></i>
            <span class="text-xs mt-1">Payment</span>
        </a>
        <a href="{{ route('mobile.result') }}" class="nav-link flex flex-col items-center justify-center w-full h-full text-slate-400 hover:text-sky-600 @yield('mobileResult')">
            <i data-lucide="file-text" class="w-5 h-5"></i>
            <span class="text-xs mt-1">Hasil</span>
        </a>
        <a href="{{ route('app') }}" class="nav-link flex flex-col items-center justify-center w-full h-full text-slate-400 hover:text-sky-600 @yield('mobileDashboard')">
            <i data-lucide="home" class="w-5 h-5"></i>
            <span class="text-xs mt-1">Home</span>
        </a>
        <a href="{{ route('mobile.kunjungan') }}" class="nav-link flex flex-col items-center justify-center w-full h-full text-slate-400 hover:text-sky-600 @yield('mobileTerapi')">
            <i data-lucide="clipboard-list" class="w-5 h-5"></i>
            <span class="text-xs mt-1">Terapi</span>
        </a>
        <a href="{{ route('mobile.profile') }}" class="nav-link flex flex-col items-center justify-center w-full h-full text-slate-400 hover:text-sky-600 @yield('mobileProfile')">
            <i data-lucide="user" class="w-5 h-5"></i>
            <span class="text-xs mt-1">Profile</span>
        </a>
    </div>
</div>
