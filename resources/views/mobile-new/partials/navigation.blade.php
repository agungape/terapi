<nav x-show="!showSessionDetail && !showPackageDetail && !showPdfViewer" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-10" class="fixed bottom-6 left-1/2 transform -translate-x-1/2 w-[92%] max-w-[400px] bg-white/90 backdrop-blur-xl border border-white/20 px-8 py-4 rounded-[35px] flex justify-between items-center z-40 shadow-[0_20px_50px_rgba(0,0,0,0.1)]">
    <button @click="nav('home')" :class="page === 'home' ? 'text-indigo-600 bg-indigo-50/50' : 'text-slate-400'" class="flex flex-col items-center gap-1.5 transition-all duration-500 px-4 py-2 rounded-2xl relative">
        <i class="fa-solid fa-house text-lg" :class="{'scale-110': page === 'home'}"></i>
        <span class="text-[9px] font-black uppercase tracking-tight">Home</span>
        <div x-show="page === 'home'" class="absolute -bottom-1 w-1 h-1 bg-indigo-600 rounded-full"></div>
    </button>
    <button @click="nav('absensi')" :class="page === 'absensi' ? 'text-green-600 bg-green-50/50' : 'text-slate-400'" class="flex flex-col items-center gap-1.5 transition-all duration-500 px-4 py-2 rounded-2xl relative">
        <i class="fa-solid fa-calendar-check text-lg" :class="{'scale-110': page === 'absensi'}"></i>
        <span class="text-[9px] font-black uppercase tracking-tight">Absensi</span>
        <div x-show="page === 'absensi'" class="absolute -bottom-1 w-1 h-1 bg-green-600 rounded-full"></div>
    </button>
    <button @click="nav('buku_anak')" :class="page === 'buku_anak' ? 'text-orange-500 bg-orange-100/50' : 'text-slate-400'" class="flex flex-col items-center gap-1.5 transition-all duration-500 px-4 py-2 rounded-2xl relative">
        <i class="fa-solid fa-book-open text-lg" :class="{'scale-110': page === 'buku_anak'}"></i>
        <span class="text-[9px] font-black uppercase tracking-tight">Buku Anak</span>
        <div x-show="page === 'buku_anak'" class="absolute -bottom-1 w-1 h-1 bg-orange-500 rounded-full"></div>
    </button>
    <button @click="nav('profil')" :class="page === 'profil' ? 'text-purple-600 bg-purple-50/50' : 'text-slate-400'" class="flex flex-col items-center gap-1.5 transition-all duration-500 px-4 py-2 rounded-2xl relative">
        <i class="fa-solid fa-user text-lg" :class="{'scale-110': page === 'profil'}"></i>
        <span class="text-[9px] font-black uppercase tracking-tight">Profil</span>
        <div x-show="page === 'profil'" class="absolute -bottom-1 w-1 h-1 bg-purple-600 rounded-full"></div>
    </button>
</nav>
