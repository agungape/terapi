<div class="space-y-6" x-show="!isLoading" x-data="{ showObservasiDetail: false, selectedObservasi: null }">


    <!-- Observation Cards -->
    <div class="space-y-4">
        <template x-for="(obs, index) in observations" :key="obs.id">
            <div @click="selectedObservasi = obs; showObservasiDetail = true"
                class="kid-card p-6 border-l-4 border-l-teal-400 shadow-sm hover-lift animate-slide-up cursor-pointer"
                :style="`animation-delay: ${index * 0.1}s`">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h4 class="font-bold text-gray-800 text-sm flex items-center">
                            <i class="fa-solid fa-eye mr-2 text-teal-500"></i>
                            <span x-text="obs.activity"></span>
                        </h4>
                        <p class="text-[9px] text-gray-400 font-bold mt-1"
                            x-text="obs.date + ' • ' + obs.time"></p>
                    </div>
                    <span class="bg-teal-100 text-teal-700 text-[8px] font-black px-2 py-1 rounded-md"
                        x-text="obs.result"></span>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-teal-50 p-3 rounded-2xl">
                        <p class="text-[9px] font-bold text-teal-700 uppercase mb-1">Fokus Observasi</p>
                        <p class="text-[11px] font-semibold text-gray-700" x-text="obs.focus"></p>
                    </div>
                    <div class="bg-indigo-50 p-3 rounded-2xl">
                        <p class="text-[9px] font-bold text-indigo-700 uppercase mb-1">Pengamat</p>
                        <p class="text-[11px] font-semibold text-gray-700" x-text="obs.observer"></p>
                    </div>
                </div>
                
                <div class="mt-4 pt-4 border-t border-dashed flex justify-end">
                    <span class="text-[10px] text-teal-600 font-bold flex items-center">
                        Lihat Hasil Detail <i class="fas fa-chevron-right ml-1"></i>
                    </span>
                </div>
            </div>
        </template>
    </div>

    <!-- Observation Stats -->
    <div class="bg-gradient-to-r from-teal-50 to-emerald-50 p-6 rounded-[35px] border border-teal-100">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-chart-pie mr-2 text-teal-500"></i>
            Statistik Observasi
        </h4>
        <div class="grid grid-cols-2 gap-3">
            <div class="bg-white p-3 rounded-2xl text-center">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Total Riwayat</p>
                <p class="text-lg font-black text-teal-600" x-text="observations.length"></p>
            </div>
            <div class="bg-white p-3 rounded-2xl text-center">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Terakhir</p>
                <p class="text-[10px] font-black text-blue-600 mt-2" x-text="observations.length > 0 ? observations[0].date : '-'"></p>
            </div>
        </div>
    </div>

    <!-- Observation Detail Modal -->
    <div x-show="showObservasiDetail" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-full"
         class="fixed inset-0 z-[9999] flex flex-col bg-gray-50 w-full max-w-[400px] mx-auto shadow-2xl" x-cloak>
        
        <!-- Header Modal -->
        <div class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-100 flex-shrink-0">
            <button @click="showObservasiDetail = false" class="text-gray-400 hover:text-gray-600 transition-colors active:scale-95">
                <i class="fas fa-times text-xl"></i>
            </button>
            <h3 class="font-black text-gray-800 text-sm uppercase tracking-widest">Detail Observasi</h3>
            <div class="w-5"></div>
        </div>

        <!-- Konten Scrollable -->
        <div class="flex-1 overflow-y-auto p-6 space-y-6 scrollbar-hide">
            <!-- Info Utama -->
            <div class="bg-white rounded-[35px] p-6 border border-gray-100 shadow-sm relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-teal-50 rounded-full blur-2xl opacity-60"></div>
                
                <h4 class="text-lg font-black text-slate-800 mb-1" x-text="selectedObservasi?.activity"></h4>
                <p class="text-[11px] text-slate-400 font-bold mb-4 flex items-center">
                    <i class="fas fa-calendar-alt mr-2 text-teal-400"></i>
                    <span x-text="selectedObservasi?.date"></span>
                </p>

                <div class="bg-slate-50 p-4 rounded-2xl mb-2">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Cakupan Pemeriksaan</p>
                    <p class="text-xs text-slate-600 font-medium leading-relaxed" x-text="selectedObservasi?.focus"></p>
                </div>
            </div>

            <!-- Hasil per Jenis Pemeriksaan -->
            <div class="space-y-4" x-show="selectedObservasi?.results_summary && selectedObservasi?.results_summary.length > 0">
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-2">Rincian Hasil Evaluasi</h4>
                
                <div class="grid gap-3">
                    <template x-for="res in selectedObservasi?.results_summary">
                        <div class="flex items-start space-x-4 bg-white p-5 rounded-[28px] border border-slate-100 shadow-sm">
                            <div class="w-8 h-8 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5"
                                 :class="{
                                     'bg-emerald-100 text-emerald-600': res.hasil.toLowerCase().includes('normal') || res.hasil.toLowerCase().includes('sesuai'),
                                     'bg-amber-100 text-amber-600': res.hasil.toLowerCase().includes('meragukan') || res.hasil.toLowerCase().includes('risiko'),
                                     'bg-rose-100 text-rose-600': res.hasil.toLowerCase().includes('penyimpangan') || res.hasil.toLowerCase().includes('gangguan') || res.hasil.toLowerCase().includes('gpph'),
                                     'bg-blue-100 text-blue-600': !res.hasil.toLowerCase().includes('normal') && !res.hasil.toLowerCase().includes('sesuai') && !res.hasil.toLowerCase().includes('meragukan') && !res.hasil.toLowerCase().includes('risiko') && !res.hasil.toLowerCase().includes('penyimpangan') && !res.hasil.toLowerCase().includes('gangguan') && !res.hasil.toLowerCase().includes('gpph')
                                 }">
                                <i class="fas fa-stethoscope text-[12px]"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1" x-text="res.jenis"></p>
                                <p class="text-[13px] font-black"
                                   :class="{
                                       'text-emerald-600': res.hasil.toLowerCase().includes('normal') || res.hasil.toLowerCase().includes('sesuai'),
                                       'text-amber-600': res.hasil.toLowerCase().includes('meragukan') || res.hasil.toLowerCase().includes('risiko'),
                                       'text-rose-600': res.hasil.toLowerCase().includes('penyimpangan') || res.hasil.toLowerCase().includes('gangguan') || res.hasil.toLowerCase().includes('gpph'),
                                       'text-slate-700': !res.hasil.toLowerCase().includes('normal') && !res.hasil.toLowerCase().includes('sesuai') && !res.hasil.toLowerCase().includes('meragukan') && !res.hasil.toLowerCase().includes('risiko') && !res.hasil.toLowerCase().includes('penyimpangan') && !res.hasil.toLowerCase().includes('gangguan') && !res.hasil.toLowerCase().includes('gpph')
                                   }" x-text="res.hasil"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Footer View PDF -->
            <div class="pt-4">
                <button @click="showObservasiDetail = false; showPdfViewer = true; $nextTick(() => $dispatch('open-pdf', { url: selectedObservasi?.file_url, title: 'Laporan Observasi' }))"
                    class="w-full py-4 bg-teal-600 hover:bg-teal-700 text-white rounded-2xl font-black text-sm transition-colors active:scale-[0.98] flex items-center justify-center space-x-2 shadow-lg shadow-teal-600/30">
                    <i class="fas fa-file-pdf"></i>
                    <span>Cetak Laporan Lengkap (PDF)</span>
                </button>
            </div>
            
            <div class="h-32"></div>
        </div>
    </div>
</div>
