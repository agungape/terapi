<nav class="fixed bottom-0 left-1/2 transform -translate-x-1/2 w-full max-w-md bg-white border-t border-slate-100 px-6 py-3 flex justify-between items-center z-30 shadow-lg">
    <button @click="nav('home')" :class="{'text-indigo-600': page === 'home', 'text-slate-400': page !== 'home'}" class="flex flex-col items-center gap-1 transition-colors">
        <i class="fa-solid fa-house text-xl"></i>
        <span class="text-[10px] font-bold">Home</span>
    </button>
    <button @click="nav('absensi')" :class="{'text-green-600': page === 'absensi', 'text-slate-400': page !== 'absensi'}" class="flex flex-col items-center gap-1 transition-colors">
        <i class="fa-solid fa-calendar-check text-xl"></i>
        <span class="text-[10px] font-bold">Absensi</span>
    </button>
    <button @click="nav('buku_anak')" :class="{'text-orange-600': page === 'buku_anak', 'text-slate-400': page !== 'buku_anak'}" class="flex flex-col items-center gap-1 transition-colors">
        <i class="fa-solid fa-child text-xl"></i>
        <span class="text-[10px] font-bold">Buku Anak</span>
    </button>
    <button @click="nav('profil')" :class="{'text-purple-600': page === 'profil', 'text-slate-400': page !== 'profil'}" class="flex flex-col items-center gap-1 transition-colors">
        <i class="fa-solid fa-user text-xl"></i>
        <span class="text-[10px] font-bold">Profil</span>
    </button>
</nav>
