<div x-show="!isLoading" x-data="{ 
    toggleGroup(id) {
        if (this.expandedGroups.includes(id)) {
            this.expandedGroups = this.expandedGroups.filter(i => i !== id);
        } else {
            this.expandedGroups.push(id);
        }
    },
    isExpanded(id) {
        return this.expandedGroups.includes(id);
    },
    groupHasItems(group, filter) {
        const matchFilter = (filter === 'semua' || group.type === filter);
        const hasValidItems = group.items.some(item => item.programs && item.programs.length > 0);
        return matchFilter && hasValidItems;
    },
    showSectionHeader(index, filter) {
        if (filter !== 'semua') return false;
        // Hanya tampilkan header seksi jika grup ini dan setidaknya satu grup di seksi ini memiliki item valid
        if (!this.groupHasItems(this.sessions[index], filter)) return false;
        
        if (index === 0) return true;
        
        // Cari tipe sebelumnya yang valid
        let prevValidType = null;
        for(let i = index - 1; i >= 0; i--) {
            if(this.groupHasItems(this.sessions[i], filter)) {
                prevValidType = this.sessions[i].type;
                break;
            }
        }
        return this.sessions[index].type !== prevValidType;
    },
    // Fungsi pembantu untuk cek apakah ada data sama sekali untuk filter aktif
    hasAnyData(filter) {
        return this.sessions.some(g => this.groupHasItems(g, filter));
    }
}" x-init="if (sessions.length > 0) expandedGroups.push(sessions[0].sesi_id + '-' + sessions[0].type)">
    
    <!-- Filter Buttons -->
    <div class="bg-white rounded-t-[40px] -mx-6 px-0 pt-8 pb-4">
        <div class="flex space-x-3 overflow-x-auto pb-4 px-6 no-scrollbar">
            <button @click="filterTerapi = 'semua'"
                :class="filterTerapi === 'semua' ? 'bg-orange-500 text-white shadow-orange-200 shadow-lg' : 'bg-white text-slate-400 border border-slate-100'"
                class="px-8 py-3 rounded-2xl text-sm font-black transition-all whitespace-nowrap active:scale-95 flex-shrink-0">
                Semua
            </button>
            <button @click="filterTerapi = 'terapi_perilaku'"
                :class="filterTerapi === 'terapi_perilaku' ? 'bg-orange-500 text-white shadow-orange-200 shadow-lg' : 'bg-white text-slate-400 border border-slate-100'"
                class="px-8 py-3 rounded-2xl text-sm font-black transition-all whitespace-nowrap active:scale-95 flex-shrink-0">
                Perilaku
            </button>
            <button @click="filterTerapi = 'fisioterapi'"
                :class="filterTerapi === 'fisioterapi' ? 'bg-orange-500 text-white shadow-orange-200 shadow-lg' : 'bg-white text-slate-400 border border-slate-100'"
                class="px-8 py-3 rounded-2xl text-sm font-black transition-all whitespace-nowrap active:scale-95 flex-shrink-0">
                Fisioterapi
            </button>
        </div>

        <!-- Session Groups -->
        <div class="space-y-6 pb-32 mt-2 px-6 min-h-[400px]">
            <!-- Empty State -->
            <template x-if="!hasAnyData(filterTerapi)">
                <div class="flex flex-col items-center justify-center py-20 text-center animate-fade-in">
                    <div class="w-32 h-32 bg-orange-50 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-folder-open text-4xl text-orange-200"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-800 mb-2">Belum Ada Laporan</h3>
                    <p class="text-sm text-slate-400 max-w-[200px] leading-relaxed">Laporan aktivitas terapi akan muncul di sini setelah sesi selesai.</p>
                </div>
            </template>

            <!-- Data List -->
            <template x-for="(group, gIndex) in sessions" :key="group.sesi_id + '-' + group.type">
                <div x-show="groupHasItems(group, filterTerapi)">
                    
                    <!-- Section Divider -->
                    <template x-if="showSectionHeader(gIndex, filterTerapi)">
                        <div class="flex items-center space-x-4 mb-4 mt-2">
                            <div class="flex-1 h-px bg-slate-100"></div>
                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]" x-text="'Kategori ' + group.type_label"></span>
                            <div class="flex-1 h-px bg-slate-100"></div>
                        </div>
                    </template>

                    <div x-transition:enter="transition ease-out duration-300"
                         class="bg-white rounded-[32px] overflow-hidden border border-slate-100 shadow-sm transition-all duration-300 mb-4">
                        
                        <!-- Header Paket -->
                        <div @click="toggleGroup(group.sesi_id + '-' + group.type)" 
                            class="p-5 flex items-center justify-between cursor-pointer transition-colors"
                            :class="isExpanded(group.sesi_id + '-' + group.type) ? 'bg-orange-500 text-white shadow-lg' : 'bg-orange-50 hover:bg-orange-100'">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center mr-4 shadow-md"
                                    :class="isExpanded(group.sesi_id + '-' + group.type) ? 'bg-white/20 border border-white/30' : 'bg-orange-500 text-white'">
                                    <i class="fas" :class="group.type === 'fisioterapi' ? 'fa-walking' : 'fa-brain'"></i>
                                </div>
                                <div>
                                    <h3 class="font-black text-sm" :class="isExpanded(group.sesi_id + '-' + group.type) ? 'text-white' : 'text-orange-600'" 
                                        x-text="group.type_label + ' • Sesi ' + group.sesi_id"></h3>
                                    <p class="text-[10px] font-bold" :class="isExpanded(group.sesi_id + '-' + group.type) ? 'text-orange-100' : 'text-orange-400'" 
                                       x-text="group.items.filter(i => i.programs.length > 0).length + ' Laporan Tersedia'"></p>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-full flex items-center justify-center transition-transform duration-300"
                                :class="isExpanded(group.sesi_id + '-' + group.type) ? 'rotate-180 text-white' : 'text-orange-300'">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>

                        <!-- Items List -->
                        <div x-show="isExpanded(group.sesi_id + '-' + group.type)" x-collapse class="px-4 pb-5 space-y-3 pt-3 bg-slate-50/30">
                            <template x-for="(session, sIndex) in group.items" :key="session.id">
                                <div x-show="session.programs.length > 0"
                                    class="bg-white rounded-3xl p-5 border border-slate-100 shadow-sm hover:border-orange-200 transition-all duration-300 cursor-pointer group active:scale-[0.98]"
                                    @click="openSessionDetail(session)">
                                    <div class="flex justify-between items-start mb-3">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-base shadow-inner"
                                                :class="{
                                                    'bg-orange-100 text-orange-600': session.type === 'terapi_perilaku',
                                                    'bg-blue-100 text-blue-600': session.type === 'fisioterapi',
                                                    'bg-purple-100 text-purple-600': session.type === 'terapi_wicara'
                                                }">
                                                <i class="fas" :class="{
                                                    'fa-brain': session.type === 'terapi_perilaku',
                                                    'fa-walking': session.type === 'fisioterapi',
                                                    'fa-comment-dots': session.type === 'terapi_wicara'
                                                }"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-slate-800 text-xs" x-text="session.type_label"></h4>
                                                <span class="text-[10px] font-bold text-slate-400 uppercase" x-text="session.date"></span>
                                            </div>
                                        </div>
                                        <span class="text-[10px] font-black text-orange-500 bg-orange-50 px-2 py-1 rounded-lg border border-orange-100" x-text="'P-' + session.pertemuan"></span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3 text-[10px] font-bold text-slate-400">
                                            <div class="flex items-center space-x-1"><i class="fas fa-clock opacity-50"></i><span x-text="session.time"></span></div>
                                            <div class="flex items-center space-x-1"><i class="fas fa-user-md opacity-50"></i><span x-text="session.therapist"></span></div>
                                        </div>
                                        <i class="fas fa-arrow-right text-orange-500 text-[10px]"></i>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Detail Panel (Slide-over) -->
    <div x-show="showSessionDetail" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full"
         class="fixed inset-0 z-[9999] flex flex-col justify-end" x-cloak>
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showSessionDetail = false"></div>
        <div class="relative bg-white rounded-t-[48px] shadow-2xl h-[92vh] flex flex-col w-full max-w-md mx-auto overflow-hidden">
            <!-- Header Sticky Area -->
            <div class="bg-white px-8 pt-4 flex-shrink-0 z-10 border-b border-slate-50 pb-4">
                <div class="w-12 h-1.5 bg-slate-200 rounded-full mx-auto mb-4"></div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="showSessionDetail = false" class="w-10 h-10 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center shadow-sm border border-orange-100">
                            <i class="fas fa-times"></i>
                        </button>
                        <div>
                            <h3 class="text-xl font-black text-slate-800 tracking-tight leading-none">Detail Aktivitas</h3>
                            <p class="text-[10px] font-black text-orange-400 uppercase tracking-widest mt-1.5" x-text="selectedSession?.date"></p>
                        </div>
                    </div>
                    <span class="text-[10px] font-black text-green-500 bg-green-50 px-3 py-1.5 rounded-xl border border-green-100 uppercase shadow-sm" x-text="selectedSession?.status_sesi"></span>
                </div>
            </div>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto px-8 py-6 space-y-6 pb-32 no-scrollbar bg-slate-50/30">
                <!-- Info Terapis Card -->
                <div class="flex items-center justify-between bg-white rounded-[32px] p-5 border border-slate-100 shadow-sm">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-500 border border-orange-100 flex-shrink-0">
                            <i class="fas fa-user-md text-xl"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Terapis</p>
                            <h5 class="text-sm font-black text-slate-800 leading-none" x-text="selectedSession?.therapist"></h5>
                            <p x-show="selectedSession?.therapist_pendamping" class="text-[10px] font-bold text-blue-500 mt-1" x-text="'Pendamping: ' + selectedSession?.therapist_pendamping"></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="bg-orange-500 text-white rounded-xl px-3 py-1.5 shadow-orange-100 shadow-lg">
                            <p class="text-[8px] font-black uppercase opacity-70">Sesi <span x-text="selectedSession?.sesi"></span></p>
                            <p class="text-base font-black leading-none" x-text="'#' + selectedSession?.pertemuan"></p>
                        </div>
                    </div>
                </div>

                <!-- Hasil Kegiatan Card -->
                <template x-if="selectedSession?.hasil_kegiatan">
                    <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-[32px] p-5 border border-orange-100 shadow-sm flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center border border-orange-100 flex-shrink-0 shadow-sm">
                                <i class="fa-solid text-2xl text-yellow-500" :class="{
                                    'fa-face-smile-beam': selectedSession.hasil_kegiatan === 'baik',
                                    'fa-face-meh': selectedSession.hasil_kegiatan === 'cukup',
                                    'fa-face-frown': selectedSession.hasil_kegiatan === 'kurang'
                                }"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-orange-400 uppercase tracking-widest mb-1">Hasil Kegiatan</p>
                                <h5 class="text-sm font-black text-slate-800 leading-none capitalize" 
                                    x-text="selectedSession.hasil_kegiatan === 'baik' ? 'Sangat Baik' : (selectedSession.hasil_kegiatan === 'cukup' ? 'Cukup Baik' : 'Kurang Optimal')"></h5>
                            </div>
                        </div>
                        <span class="text-[10px] font-black px-3 py-1.5 rounded-xl uppercase text-white shadow-sm"
                            :class="{
                                'bg-green-500': selectedSession.hasil_kegiatan === 'baik',
                                'bg-yellow-500': selectedSession.hasil_kegiatan === 'cukup',
                                'bg-red-500': selectedSession.hasil_kegiatan === 'kurang'
                            }"
                            x-text="selectedSession.hasil_kegiatan">
                        </span>
                    </div>
                </template>

                <!-- Pesan untuk Orang Tua -->
                <div x-show="selectedSession?.extra?.catatan_ortu" class="bg-indigo-600 rounded-[35px] p-6 text-white shadow-xl shadow-indigo-100 relative overflow-hidden">
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                    <div class="relative z-10">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="w-8 h-8 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-md">
                                <i class="fas fa-heart text-xs"></i>
                            </div>
                            <h6 class="text-[10px] font-black uppercase tracking-widest">Pesan untuk Ayah & Bunda</h6>
                        </div>
                        <p class="text-[12px] font-medium leading-relaxed italic whitespace-pre-line" x-text="selectedSession?.extra?.catatan_ortu"></p>
                    </div>
                </div>

                <!-- Consolidated Evaluation Note -->
                <div x-show="allNotesSame()" class="bg-white rounded-[35px] p-0.5 border-2 border-orange-100 shadow-xl shadow-orange-50/50 overflow-hidden">
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-[30px] p-6 text-white relative">
                        <div class="absolute top-4 right-4 text-white/10 text-5xl transform rotate-12 select-none">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <div class="relative z-10">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-7 h-7 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-md shadow-inner">
                                    <i class="fas fa-file-signature text-[10px]"></i>
                                </div>
                                <h6 class="text-[10px] font-black uppercase tracking-[0.15em]">Evaluasi Sesi</h6>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20 shadow-inner">
                                <p class="text-[12px] font-medium leading-relaxed whitespace-pre-line italic text-orange-50" x-text="selectedSession?.programs[0]?.note"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Program List -->
                <div>
                    <div class="flex items-center justify-between mb-6 px-2">
                        <h5 class="font-black text-slate-800 flex items-center text-base tracking-tight">
                            <span class="w-7 h-7 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center mr-3 shadow-sm">
                                <i class="fas fa-tasks text-[10px]"></i>
                            </span>
                            Program Latihan
                        </h5>
                        <span class="text-[10px] font-bold text-slate-400" x-text="(selectedSession?.programs || []).length + ' Langkah' "></span>
                    </div>
                    
                    <div class="relative space-y-6 pl-2">
                        <div class="absolute left-[24px] top-4 bottom-4 w-0.5 bg-gradient-to-b from-orange-200 via-slate-100 to-transparent"></div>

                        <template x-for="(prog, pIndex) in selectedSession?.programs || []" :key="pIndex">
                            <div class="relative">
                                <div class="absolute left-0 top-0 w-12 h-12 rounded-2xl bg-white border border-slate-100 flex items-center justify-center z-10 shadow-sm">
                                    <div class="w-8 h-8 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center font-black text-[12px]" x-text="pIndex + 1"></div>
                                </div>
                                
                                <div class="ml-8 pl-8">
                                    <div class="bg-white rounded-[24px] p-4 border border-slate-100 shadow-sm hover:border-orange-200 transition-all duration-300">
                                        <div class="flex justify-between items-center mb-1">
                                            <h6 class="text-[12px] font-black text-slate-800 leading-snug pr-3" x-text="prog.name"></h6>
                                            <template x-if="prog.status">
                                                <span class="text-[10px] font-black px-2 py-1 rounded-lg uppercase text-white flex-shrink-0 shadow-sm"
                                                    :class="{
                                                        'bg-rose-500': prog.status === 'dp',
                                                        'bg-amber-400': prog.status === 'ds',
                                                        'bg-green-500': prog.status === 'tb'
                                                    }"
                                                    x-text="prog.status === 'dp' ? 'Dibantu Penuh' : (prog.status === 'ds' ? 'Dibantu Sebagian' : 'Mandiri')">
                                                </span>
                                            </template>
                                        </div>

                                        <div x-show="prog.activity" class="mt-2 bg-slate-50/50 rounded-xl p-3 border border-slate-100/50">
                                            <p class="text-[11px] text-slate-600 leading-relaxed font-medium" x-text="prog.activity"></p>
                                        </div>

                                        <div x-show="prog.note && !allNotesSame()" class="flex items-start space-x-2 mt-2 bg-orange-50/30 p-2 rounded-lg border border-orange-100/30">
                                            <i class="fas fa-comment-alt text-orange-300 text-[10px] mt-1"></i>
                                            <p class="text-[11px] text-slate-500 italic leading-relaxed" x-text="prog.note"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div x-show="selectedSession?.catatan_umum" class="bg-white rounded-[24px] p-5 border border-slate-100 shadow-sm italic text-[11px] text-slate-500 leading-relaxed">
                    <p x-text="selectedSession?.catatan_umum"></p>
                </div>

                <div class="h-10"></div>
            </div>
        </div>
    </div>
</div>
