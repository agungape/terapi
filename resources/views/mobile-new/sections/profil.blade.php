<div class="text-center pt-10 animate-slide-up" x-show="!isLoading">
    <div class="relative inline-block mb-6">
        <div
            class="w-32 h-32 bg-indigo-100 rounded-[40px] rotate-6 absolute inset-0 -z-10 animate-pulse-slow">
        </div>
        <div class="relative group">
            <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($anak->nama ?? 'Anak') . '&background=6366f1&color=fff&size=400' }}"
                class="w-32 h-32 rounded-[40px] border-4 border-white shadow-xl mx-auto object-cover group-hover:scale-105 transition-transform duration-300">
            <button @click="showToast('Ubah foto profil', 'success')"
                class="absolute bottom-2 right-2 w-8 h-8 bg-indigo-600 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                <i class="fa-solid fa-camera text-xs"></i>
            </button>
        </div>
    </div>
    <h2 class="text-2xl font-black text-indigo-900" x-text="childBook.personalInfo.fullName"></h2>
    <p class="text-xs text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Super Kid #001</p>
    <div class="mt-2">
        <span
            class="inline-block bg-indigo-100 text-indigo-600 text-[10px] font-bold px-3 py-1 rounded-full">
            <i class="fa-solid fa-gem mr-1"></i> Member Premium
        </span>
    </div>

    <div class="mt-10 space-y-3 px-4">
        <button @click="nav('buku_anak')"
            class="w-full flex items-center justify-between p-5 bg-white rounded-3xl border border-gray-100 shadow-sm hover:bg-gray-50 active:scale-[0.98] transition-all hover-lift ripple">
            <span class="flex items-center text-sm font-bold text-gray-700">
                <i class="fa-solid fa-book-open mr-4 text-orange-500"></i> Buku Anak
            </span>
            <i
                class="fa-solid fa-angle-right text-gray-300 group-hover:translate-x-1 transition-transform"></i>
        </button>
        <button @click="nav('paket_terapi')"
            class="w-full flex items-center justify-between p-5 bg-white rounded-3xl border border-gray-100 shadow-sm hover:bg-gray-50 active:scale-[0.98] transition-all hover-lift ripple">
            <span class="flex items-center text-sm font-bold text-gray-700">
                <i class="fa-solid fa-shield-heart mr-4 text-rose-500"></i> Paket & Langganan
            </span>
            <i
                class="fa-solid fa-angle-right text-gray-300 group-hover:translate-x-1 transition-transform"></i>
        </button>
        <button @click="nav('tagihan')"
            class="w-full flex items-center justify-between p-5 bg-white rounded-3xl border border-gray-100 shadow-sm hover:bg-gray-50 active:scale-[0.98] transition-all hover-lift ripple">
            <span class="flex items-center text-sm font-bold text-gray-700">
                <i class="fa-solid fa-credit-card mr-4 text-teal-500"></i> Tagihan & Pembayaran
            </span>
            <i
                class="fa-solid fa-angle-right text-gray-300 group-hover:translate-x-1 transition-transform"></i>
        </button>
        <button disabled
            class="w-full flex items-center justify-between p-5 bg-gray-50 rounded-3xl border border-gray-100 shadow-none cursor-not-allowed opacity-60">
            <span class="flex items-center text-sm font-bold text-gray-400">
                <i class="fa-solid fa-gear mr-4 text-gray-400"></i> Pengaturan Aplikasi
            </span>
            <span class="text-[9px] font-bold bg-gray-200 text-gray-500 px-2.5 py-0.5 rounded-full">
                Disabled
            </span>
        </button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
        <button @click="document.getElementById('logout-form').submit()"
            class="w-full mt-8 py-4 rounded-3xl bg-gradient-to-r from-rose-50 to-pink-50 text-rose-500 font-bold text-xs uppercase tracking-widest border border-rose-100 hover:from-rose-100 hover:to-pink-100 active:scale-95 transition-all hover-lift">
            Keluar Aplikasi
        </button>
    </div>
</div>
