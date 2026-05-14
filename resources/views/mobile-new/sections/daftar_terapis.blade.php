<div class="space-y-6" x-show="!isLoading">
    <!-- Search Bar -->
    <div class="relative group">
        <input type="text" placeholder="Cari terapis aktif..."
            x-model="searchTherapist"
            class="w-full p-5 pl-14 rounded-[30px] border-2 border-indigo-50 bg-white shadow-sm focus:outline-none focus:border-indigo-300 transition-all duration-300">
        <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-indigo-300 group-focus-within:text-indigo-500 transition-colors">
            <i class="fa-solid fa-magnifying-glass text-lg"></i>
        </div>
    </div>

    <!-- Therapist Cards -->
    <div class="space-y-5 min-h-[300px]">
        <!-- Data List -->
        <template x-for="(therapist, index) in therapists.filter(t => t.name.toLowerCase().includes(searchTherapist.toLowerCase()))" :key="therapist.id">
            <div class="bg-white rounded-[35px] p-6 shadow-sm border border-slate-50 hover:shadow-xl hover:border-indigo-100 transition-all duration-500 animate-slide-up group"
                :style="`animation-delay: ${index * 0.1}s`"
                x-data="{ imgError: false }">
                <div class="flex items-center space-x-5">
                    <!-- Avatar/Photo -->
                    <div class="relative flex-shrink-0">
                        <!-- Show real photo if available and no error -->
                        <template x-if="therapist.photo && !imgError">
                            <img :src="therapist.photo" 
                                 x-on:error="imgError = true"
                                 class="w-20 h-20 rounded-[28px] object-cover border-4 border-white shadow-lg group-hover:scale-105 transition-transform duration-500">
                        </template>
                        
                        <!-- Show initials if no photo OR if image fails to load -->
                        <template x-if="!therapist.photo || imgError">
                            <div class="w-20 h-20 rounded-[28px] bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-2xl font-black shadow-lg group-hover:scale-105 transition-transform duration-500"
                                x-text="therapist.avatar">
                            </div>
                        </template>
                        
                        <!-- Status Indicator Dot -->
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full border-4 border-white bg-green-500 shadow-sm animate-pulse-slow"></div>
                    </div>

                    <!-- Info Area -->
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-start mb-1">
                            <div class="flex-1 min-w-0 pr-2">
                                <h4 class="font-black text-slate-800 text-base leading-tight mb-2" x-text="therapist.name"></h4>
                                <div class="inline-flex items-center px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-600 border border-indigo-100">
                                    <i class="fa-solid fa-stethoscope text-[9px] mr-1.5 opacity-70"></i>
                                    <span class="text-[10px] font-black uppercase tracking-wider" x-text="therapist.specialization"></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center text-slate-400 font-bold">
                                <i class="fa-solid fa-calendar-check text-[10px] mr-2"></i>
                                <span class="text-[11px]" x-text="therapist.schedule"></span>
                            </div>
                            <span class="text-[10px] font-black px-3 py-1.5 rounded-xl bg-green-500 text-white shadow-lg shadow-green-100 uppercase tracking-tighter"
                                x-text="therapist.status">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <!-- Empty State Search -->
        <template x-if="therapists.filter(t => t.name.toLowerCase().includes(searchTherapist.toLowerCase())).length === 0">
            <div class="flex flex-col items-center justify-center py-12 animate-fade-in text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-200">
                    <i class="fas fa-user-slash text-2xl"></i>
                </div>
                <p class="text-sm font-bold text-slate-400">Terapis tidak ditemukan</p>
                <p class="text-[10px] text-slate-300 mt-1 uppercase tracking-widest">Coba kata kunci lain</p>
            </div>
        </template>
    </div>

    <!-- Quick Stats -->
    <div class="bg-indigo-900 rounded-[40px] p-8 text-white shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
        
        <div class="relative z-10">
            <h4 class="text-sm font-black uppercase tracking-[0.2em] opacity-60 mb-6 flex items-center">
                <i class="fa-solid fa-chart-pie mr-3"></i>
                Statistik Tim Ahli
            </h4>
            
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-3xl font-black mb-1" x-text="therapists.length"></p>
                    <p class="text-[10px] font-bold text-indigo-300 uppercase tracking-widest">Total Terapis Aktif</p>
                </div>
                <div class="border-l border-white/10 pl-6">
                    <p class="text-3xl font-black mb-1 text-green-400">100%</p>
                    <p class="text-[10px] font-bold text-indigo-300 uppercase tracking-widest">Status Tersedia</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="h-20"></div>
</div>
