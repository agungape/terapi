<!-- PWA Installation Modal (Slide-up Drawer) -->
<div x-show="showPwaModal" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-full"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 translate-y-full"
     class="fixed inset-0 z-[99999] flex flex-col justify-end" x-cloak>
    
    <!-- Backdrop overlay -->
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="dismissPwaModal()"></div>
    
    <!-- Modal content container -->
    <div class="relative bg-white rounded-t-[40px] shadow-2xl p-6 pb-10 w-full max-w-md mx-auto flex flex-col items-center text-center border-t border-slate-100 animate-slide-up">
        <!-- Cute header handle -->
        <div class="w-12 h-1.5 bg-slate-200 rounded-full mb-6"></div>
        
        <!-- App Logo (Bright Icon) -->
        <div class="relative mb-5 group">
            <div class="absolute -inset-1 bg-gradient-to-tr from-orange-400 to-indigo-500 rounded-[32px] blur opacity-30 group-hover:opacity-50 transition duration-300"></div>
            <img src="/assets/mobile/pixio/images/app-logo/bsc150x150.png" 
                 alt="Bright App Logo" 
                 class="relative w-20 h-20 rounded-[28px] shadow-lg border border-slate-100/50 hover:scale-105 transition-transform duration-300">
        </div>
        
        <!-- Main title -->
        <h3 class="text-xl font-black text-slate-800 tracking-tight leading-none mb-2">Pasang Aplikasi Bright</h3>
        <p class="text-xs text-slate-500 px-4 leading-relaxed mb-6">
            Nikmati kemudahan akses super cepat, hemat kuota internet, dan notifikasi real-time langsung dari layar utama Anda!
        </p>

        <!-- Dynamic Content: Standard Install or iOS Steps -->
        <div class="w-full text-left space-y-4 mb-8">
            <!-- iOS Instructions -->
            <template x-if="showIosInstructions">
                <div class="bg-indigo-50 rounded-2xl p-5 border border-indigo-100 animate-fade-in">
                    <h4 class="text-xs font-black text-indigo-900 uppercase tracking-widest mb-3 flex items-center">
                        <i class="fa-brands fa-apple text-sm mr-2"></i> Panduan Pasang di iOS / Safari
                    </h4>
                    <ol class="text-[11px] text-indigo-950 font-bold space-y-2.5 list-decimal list-inside">
                        <li class="leading-relaxed">
                            Ketuk tombol <span class="bg-white px-2 py-0.5 rounded-lg border border-slate-200 inline-flex items-center"><i class="fa-solid fa-share text-[10px] text-indigo-500 mr-1"></i> Bagikan (Share)</span> di bagian bawah Safari.
                        </li>
                        <li class="leading-relaxed">
                            Gulir ke bawah dan pilih menu <span class="bg-white px-2 py-0.5 rounded-lg border border-slate-200 inline-flex items-center"><i class="fa-regular fa-square-plus text-[10px] text-indigo-500 mr-1"></i> Tambah ke Layar Utama</span>.
                        </li>
                        <li class="leading-relaxed">
                            Ketuk tombol <span class="bg-indigo-600 text-white px-2 py-0.5 rounded-lg font-black">Tambah</span> di pojok kanan atas.
                        </li>
                    </ol>
                </div>
            </template>

            <!-- Standard Benefits List -->
            <template x-if="!showIosInstructions">
                <div class="grid grid-cols-1 gap-3 px-2">
                    <div class="flex items-center space-x-3.5 bg-slate-50/50 p-3 rounded-2xl border border-slate-100/50">
                        <div class="w-9 h-9 rounded-xl bg-orange-100 text-orange-500 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-bolt text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-xs font-black text-slate-800 leading-none">Akses Sekali Ketuk</h5>
                            <p class="text-[10px] text-slate-500 mt-1">Buka aplikasi secara instan dari homescreen.</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3.5 bg-slate-50/50 p-3 rounded-2xl border border-slate-100/50">
                        <div class="w-9 h-9 rounded-xl bg-blue-100 text-blue-500 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-cloud-arrow-down text-xs"></i>
                        </div>
                        <div>
                            <h5 class="text-xs font-black text-slate-800 leading-none">Sangat Ringan</h5>
                            <p class="text-[10px] text-slate-500 mt-1">Tidak membebani memori penyimpanan perangkat Anda.</p>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Call to Action Buttons -->
        <div class="w-full flex flex-col space-y-3.5">
            <button @click="installPwa()" 
                    class="w-full bg-gradient-to-r from-orange-500 to-indigo-600 text-white font-black text-xs py-4 px-6 rounded-2xl uppercase tracking-widest hover:shadow-lg active:scale-[0.98] transition-all duration-300 shadow-md">
                <span x-text="showIosInstructions ? 'Mengerti' : 'Pasang Sekarang'"></span>
            </button>
            <button @click="dismissPwaModal()" 
                    class="w-full bg-slate-50 hover:bg-slate-100 text-slate-500 font-bold text-xs py-3.5 px-6 rounded-2xl uppercase tracking-widest active:scale-[0.98] transition-all duration-300">
                Nanti Saja
            </button>
        </div>
    </div>
</div>
