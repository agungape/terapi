<div class="space-y-6" x-show="!isLoading">
    <!-- Filter Buttons -->
    <div class="flex space-x-2 overflow-x-auto pb-2 scrollbar-thin">
        <button
            class="bg-teal-600 text-white px-5 py-2 rounded-2xl text-xs font-bold shadow-sm whitespace-nowrap">
            <i class="fa-solid fa-filter mr-2"></i>Semua Observasi
        </button>
        <button
            class="bg-white text-gray-400 px-5 py-2 rounded-2xl text-xs font-bold border border-gray-200 whitespace-nowrap hover:bg-gray-50">
            Minggu Ini
        </button>
        <button
            class="bg-white text-gray-400 px-5 py-2 rounded-2xl text-xs font-bold border border-gray-200 whitespace-nowrap hover:bg-gray-50">
            Bulan Ini
        </button>
    </div>

    <!-- Observation Cards -->
    <div class="space-y-4">
        <template x-for="(obs, index) in observations" :key="obs.id">
            <div class="kid-card p-6 border-l-4 border-l-teal-400 shadow-sm hover-lift animate-slide-up"
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

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-teal-50 p-3 rounded-2xl">
                        <p class="text-[9px] font-bold text-teal-700 uppercase mb-1">Fokus Observasi</p>
                        <p class="text-xs font-semibold text-gray-700" x-text="obs.focus"></p>
                    </div>
                    <div class="bg-indigo-50 p-3 rounded-2xl">
                        <p class="text-[9px] font-bold text-indigo-700 uppercase mb-1">Pengamat</p>
                        <p class="text-xs font-semibold text-gray-700" x-text="obs.observer"></p>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 p-4 rounded-2xl">
                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-2">Catatan Observasi</p>
                    <p class="text-sm text-gray-600 leading-relaxed" x-text="obs.note"></p>
                </div>

                <div class="mt-4 pt-4 border-t border-dashed flex items-center justify-between">
                    <div class="flex space-x-2">
                        <button @click="showToast('Simpan observasi', 'success')"
                            class="text-gray-300 hover:text-indigo-500 transition-colors">
                            <i class="fa-regular fa-bookmark"></i>
                        </button>
                        <button @click="showToast('Bagikan observasi', 'success')"
                            class="text-gray-300 hover:text-teal-500 transition-colors">
                            <i class="fa-solid fa-share-nodes"></i>
                        </button>
                    </div>
                    <button @click="showToast('Unduh laporan observasi', 'success')"
                        class="text-xs text-teal-600 font-bold hover:text-teal-700">
                        <i class="fa-solid fa-download mr-1"></i>Unduh
                    </button>
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
        <div class="grid grid-cols-3 gap-3">
            <div class="bg-white p-3 rounded-2xl text-center">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Total</p>
                <p class="text-lg font-black text-teal-600">24</p>
            </div>
            <div class="bg-white p-3 rounded-2xl text-center">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Sangat Baik</p>
                <p class="text-lg font-black text-green-600">15</p>
            </div>
            <div class="bg-white p-3 rounded-2xl text-center">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Bulan Ini</p>
                <p class="text-lg font-black text-blue-600">8</p>
            </div>
        </div>
    </div>
</div>
