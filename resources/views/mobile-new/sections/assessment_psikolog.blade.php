<div class="space-y-6" x-show="!isLoading">
    <!-- Summary Card -->
    <div class="bg-gradient-to-r from-rose-50 to-pink-50 p-6 rounded-[35px] border border-rose-100">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h4 class="font-bold text-gray-800 text-lg flex items-center">
                    <i class="fa-solid fa-brain mr-2 text-rose-500"></i>
                    Hasil Assessment Terbaru
                </h4>
                <p class="text-[11px] text-gray-500">25 Januari 2026 - Dr. Maya Sari, M.Psi</p>
            </div>
            <button @click="showToast('Mengunduh laporan assessment', 'success')"
                class="bg-rose-100 text-rose-600 p-3 rounded-2xl hover:bg-rose-200 transition-colors">
                <i class="fa-solid fa-download"></i>
            </button>
        </div>
        <div class="bg-white p-4 rounded-3xl text-center mb-4">
            <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Skor Keseluruhan</p>
            <div class="flex items-center justify-center space-x-2">
                <p class="text-3xl font-black text-rose-600">78</p>
                <span
                    class="bg-green-100 text-green-600 text-[10px] font-bold px-2 py-1 rounded-lg">+5%</span>
            </div>
            <p class="text-[10px] text-gray-500 mt-2">Naik dari 73 pada assessment sebelumnya</p>
        </div>
    </div>

    <!-- Assessment Categories -->
    <div class="space-y-4">
        <h4 class="font-bold text-gray-800 flex items-center">
            <i class="fa-solid fa-layer-group mr-2 text-indigo-500"></i>
            Detail Per Kategori
        </h4>

        <template x-for="(assessment, index) in assessmentResults" :key="assessment.id">
            <div class="kid-card p-5 border-2 border-indigo-50 shadow-sm hover-lift cursor-pointer animate-slide-up"
                :style="`animation-delay: ${index * 0.1}s`"
                @click="showToast('Detail assessment ' + assessment.category, 'success')">
                <div class="flex justify-between items-start">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white text-lg"
                            :class="{
                                'bg-purple-500': assessment.color === 'purple',
                                'bg-blue-500': assessment.color === 'blue',
                                'bg-green-500': assessment.color === 'green'
                            }">
                            <i class="fa-solid" :class="{
                                'fa-lightbulb': assessment.category === 'Kognitif',
                                'fa-heart': assessment.category === 'Sosial-Emosional',
                                'fa-comment-dots': assessment.category === 'Bahasa'
                            }"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-sm" x-text="assessment.category"></h5>
                            <p class="text-[9px] text-gray-400 font-bold">Skor: <span
                                    x-text="assessment.score" class="text-indigo-600"></span>/100</p>
                        </div>
                    </div>
                    <span
                        class="bg-indigo-100 text-indigo-600 text-[8px] font-black px-2 py-1 rounded-md"
                        x-text="assessment.status"></span>
                </div>
                <p class="text-xs text-gray-600 mt-3" x-text="assessment.details"></p>
                <div class="mt-4">
                    <div class="w-full bg-gray-100 rounded-full h-2">
                        <div class="bg-indigo-500 h-2 rounded-full"
                            :style="`width: ${assessment.score}%`"></div>
                    </div>
                    <div class="flex justify-between text-[9px] text-gray-400 mt-1">
                        <span>0</span>
                        <span>50</span>
                        <span>100</span>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Recommendations -->
    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 p-6 rounded-[35px] border border-indigo-100">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-lightbulb mr-2 text-yellow-500"></i>
            Rekomendasi Psikolog
        </h4>
        <ul class="space-y-3">
            <li class="flex items-start">
                <i class="fa-solid fa-check text-green-500 mt-1 mr-3"></i>
                <p class="text-sm text-gray-700">Teruskan latihan fonetik dengan kartu bergambar 15
                    menit/hari</p>
            </li>
            <li class="flex items-start">
                <i class="fa-solid fa-check text-green-500 mt-1 mr-3"></i>
                <p class="text-sm text-gray-700">Tambahkan sesi bermain sosial dengan teman sebaya
                    2x/minggu</p>
            </li>
            <li class="flex items-start">
                <i class="fa-solid fa-check text-green-500 mt-1 mr-3"></i>
                <p class="text-sm text-gray-700">Assessment follow-up direncanakan 1 bulan lagi</p>
            </li>
        </ul>
    </div>
</div>
