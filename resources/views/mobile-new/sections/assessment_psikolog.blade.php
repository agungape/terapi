<div class="space-y-6" x-show="!isLoading">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-rose-50 to-pink-50 p-6 rounded-[35px] border border-rose-100 shadow-sm animate-slide-up">
        <div class="flex items-center justify-between mb-2">
            <h4 class="font-bold text-gray-800 text-lg flex items-center">
                <i class="fa-solid fa-user-doctor mr-2 text-rose-500"></i>
                Catatan Psikolog
            </h4>
            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-rose-500 shadow-sm">
                <i class="fa-solid fa-clipboard-check"></i>
            </div>
        </div>
        <p class="text-xs text-gray-600 leading-relaxed mb-4">
            Riwayat evaluasi dan perkembangan psikologis Ananda. Semua data dirahasiakan dan hanya untuk keperluan terapi.
        </p>
        <div class="bg-white/60 p-3 rounded-2xl flex items-center justify-between backdrop-blur-sm border border-white">
            <span class="text-[10px] font-black text-rose-600 uppercase tracking-widest">Total Evaluasi</span>
            <span class="text-sm font-black text-slate-800" x-text="assessments.length + ' Catatan'"></span>
        </div>
    </div>

    <!-- Empty State -->
    <template x-if="assessments.length === 0">
        <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-[35px] p-12 text-center animate-fade-in">
            <div class="w-20 h-20 bg-white rounded-[28px] flex items-center justify-center mx-auto mb-5 shadow-sm">
                <i class="fa-solid fa-folder-open text-slate-300 text-3xl"></i>
            </div>
            <h5 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-1">Belum Ada Evaluasi</h5>
            <p class="text-[11px] text-slate-400">Hasil assessment dari psikolog akan muncul di sini.</p>
        </div>
    </template>

    <!-- Assessment List -->
    <div class="space-y-4">
        <template x-for="(ass, index) in assessments" :key="ass.id">
            <div class="bg-white p-5 rounded-[35px] shadow-sm border border-slate-50 hover:border-blue-100 transition-all animate-slide-up relative overflow-hidden"
                :style="`animation-delay: ${index * 0.1}s`"
                @click="selectedAssessment = ass; showAssessmentDetail = true">
                
                <div class="flex justify-between items-start relative z-10">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center text-xl shadow-inner flex-shrink-0">
                            <i class="fa-solid fa-stethoscope"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1" x-text="ass.date"></p>
                            <h5 class="font-black text-slate-800 text-sm leading-tight mb-2" x-text="'Oleh: ' + ass.psychologist"></h5>
                            
                            <div class="flex flex-wrap gap-2 mb-3">
                                <span class="text-[9px] font-black bg-rose-50 text-rose-600 px-2.5 py-1 rounded-lg uppercase" x-text="ass.diagnosis"></span>
                                <template x-if="ass.iq_score && ass.iq_score !== '-'">
                                    <span class="text-[9px] font-black bg-purple-50 text-purple-600 px-2.5 py-1 rounded-lg uppercase">
                                        <i class="fas fa-brain mr-1"></i> <span x-text="'IQ: ' + ass.iq_score"></span>
                                    </span>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2">
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300"></i>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Assessment Detail Modal -->
    <div x-show="showAssessmentDetail" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full"
         class="fixed inset-0 z-[9999] flex flex-col justify-end" x-cloak>
        
        <div class="absolute inset-0 bg-slate-900/90 backdrop-blur-md" @click="showAssessmentDetail = false"></div>
        
        <div class="relative bg-white rounded-t-[48px] shadow-2xl h-[92vh] flex flex-col w-full max-w-[400px] mx-auto overflow-hidden">
            <!-- Header Sticky Area -->
            <div class="bg-white px-8 pt-4 flex-shrink-0 z-10 border-b border-slate-50 pb-4 text-left">
                <div class="w-12 h-1.5 bg-slate-200 rounded-full mx-auto mb-4"></div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="showAssessmentDetail = false" class="w-10 h-10 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center shadow-sm border border-rose-100">
                            <i class="fas fa-times"></i>
                        </button>
                        <div>
                            <h3 class="text-xl font-black text-slate-800 tracking-tight leading-none">Evaluasi Psikolog</h3>
                            <p class="text-[10px] font-black text-rose-400 uppercase tracking-widest mt-1.5" x-text="selectedAssessment?.date"></p>
                        </div>
                    </div>
                    <span class="text-[10px] font-black text-green-500 bg-green-50 px-3 py-1.5 rounded-xl border border-green-100 uppercase shadow-sm">Rahasia</span>
                </div>
            </div>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto px-8 py-6 space-y-6 pb-40 no-scrollbar bg-slate-50/30">
                <!-- Visual Header Info -->
                <div class="flex items-center justify-between bg-white rounded-[32px] p-5 border border-slate-100 shadow-sm animate-fade-in">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-2xl bg-rose-500 text-white flex items-center justify-center text-xl shadow-lg shadow-rose-200 flex-shrink-0">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Pemeriksa</p>
                            <h5 class="text-sm font-black text-slate-800 leading-none" x-text="selectedAssessment?.psychologist"></h5>
                        </div>
                    </div>
                    <!-- Quick PDF View -->
                    <button @click="showAssessmentDetail = false; showPdfViewer = true; $nextTick(() => $dispatch('open-pdf', { url: selectedAssessment?.file_url }))"
                       class="w-10 h-10 bg-rose-600 text-white rounded-xl flex items-center justify-center shadow-md shadow-rose-200 active:scale-90 transition-all">
                        <i class="fas fa-file-pdf text-xs"></i>
                    </button>
                </div>

                <!-- Diagnosis & IQ Cards -->
                <div class="grid grid-cols-2 gap-4 animate-slide-up" style="animation-delay: 0.1s;">
                    <div class="bg-rose-50/50 p-5 rounded-[28px] text-center border border-rose-100 shadow-sm flex flex-col justify-center h-full">
                        <div class="w-8 h-8 bg-rose-100 text-rose-500 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-notes-medical text-[12px]"></i>
                        </div>
                        <p class="text-xs font-black text-slate-800 leading-tight mb-1" x-text="selectedAssessment?.diagnosis"></p>
                        <p class="text-[8px] font-black text-rose-400 uppercase tracking-widest">Diagnosa</p>
                    </div>
                    <div class="bg-purple-50/50 p-5 rounded-[28px] text-center border border-purple-100 shadow-sm flex flex-col justify-center h-full">
                        <div class="w-8 h-8 bg-purple-100 text-purple-500 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-brain text-[12px]"></i>
                        </div>
                        <p class="text-xs font-black text-slate-800 leading-tight mb-1" x-text="selectedAssessment?.classification"></p>
                        <p class="text-[8px] font-black text-purple-400 uppercase tracking-widest" x-text="'Skor IQ: ' + selectedAssessment?.iq_score"></p>
                    </div>
                </div>

                <!-- Keluhan Utama Card (Conditional) -->
                <template x-if="selectedAssessment?.main_complaint">
                    <div class="bg-white rounded-[32px] p-6 border border-slate-100 shadow-sm animate-slide-up" style="animation-delay: 0.2s;">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-8 h-8 bg-rose-50 text-rose-500 rounded-xl flex items-center justify-center">
                                <i class="fas fa-comment-medical text-[12px]"></i>
                            </div>
                            <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">Keluhan Utama</h4>
                        </div>
                        <p class="text-[13px] text-slate-600 font-medium leading-relaxed italic" x-text="'&quot;' + selectedAssessment?.main_complaint + '&quot;'"></p>
                    </div>
                </template>

                <!-- Hasil Pemeriksaan Section -->
                <div class="space-y-4 animate-slide-up" style="animation-delay: 0.3s;" x-show="selectedAssessment?.examination_results && selectedAssessment?.examination_results.length > 0">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-2">Hasil Pemeriksaan</h4>
                    <div class="grid gap-3">
                        <template x-for="item in selectedAssessment?.examination_results">
                            <div class="flex items-start space-x-4 bg-white p-5 rounded-[28px] border border-slate-100 shadow-sm">
                                <div class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fas fa-microscope text-[10px]"></i>
                                </div>
                                <p class="text-[13px] text-slate-600 font-medium leading-relaxed" x-text="item"></p>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Saran Orang Tua Section -->
                <div class="space-y-4 animate-slide-up" style="animation-delay: 0.4s;" x-show="selectedAssessment?.parent_recommendations && selectedAssessment?.parent_recommendations.length > 0">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-2 text-orange-400">Saran Bagi Orang Tua</h4>
                    <div class="grid gap-3">
                        <template x-for="item in selectedAssessment?.parent_recommendations">
                            <div class="flex items-start space-x-4 bg-white p-5 rounded-[28px] border border-slate-100 shadow-sm">
                                <div class="w-7 h-7 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fas fa-house-user text-[10px]"></i>
                                </div>
                                <p class="text-[13px] text-slate-600 font-medium leading-relaxed" x-text="item"></p>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Footer View PDF -->
                <div class="pt-4 animate-slide-up" style="animation-delay: 0.5s;">
                    <button @click="showAssessmentDetail = false; showPdfViewer = true; $nextTick(() => $dispatch('open-pdf', { url: selectedAssessment?.file_url }))"
                       class="w-full bg-rose-600 text-white flex items-center justify-center space-x-3 py-5 rounded-[24px] shadow-xl shadow-rose-200 active:scale-95 transition-all">
                        <i class="fas fa-file-pdf"></i>
                        <span class="font-black text-sm uppercase tracking-widest">Lihat Laporan Lengkap</span>
                    </button>
                </div>
                <div class="h-32"></div>
            </div>
        </div>
    </div>

    <div class="h-10"></div>
</div>
