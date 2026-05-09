<div class="space-y-6" x-show="!isLoading">
    <div
        class="primary-purple p-6 rounded-[35px] text-white shadow-xl relative overflow-hidden hover-lift">
        <div class="relative z-10">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-sm font-bold flex items-center italic">
                    <i class="fa-solid fa-chart-line mr-2"></i> Grafik Kenaikan Skor
                </h4>
                <select
                    class="bg-white/20 text-white text-xs font-bold p-2 rounded-xl border border-white/30">
                    <option>Bulanan</option>
                    <option>Mingguan</option>
                    <option>Tahunan</option>
                </select>
            </div>
            <div class="h-48 w-full">
                <canvas id="progressChart"></canvas>
            </div>
        </div>
        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Progress Stats -->
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white p-5 rounded-[30px] border-2 border-indigo-50 text-center hover-lift cursor-pointer"
            @click="showToast('Detail progress kognitif', 'success')">
            <div
                class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                <i class="fa-solid fa-brain text-indigo-600"></i>
            </div>
            <p class="text-[9px] font-bold text-gray-400 uppercase">Kognitif</p>
            <p class="text-xl font-black text-indigo-600">+15%</p>
            <p class="text-[8px] text-gray-400 mt-1">Naik 5% dari bulan lalu</p>
        </div>
        <div class="bg-white p-5 rounded-[30px] border-2 border-indigo-50 text-center hover-lift cursor-pointer"
            @click="showToast('Detail progress sosial', 'success')">
            <div
                class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                <i class="fa-solid fa-people-arrows text-purple-600"></i>
            </div>
            <p class="text-[9px] font-bold text-gray-400 uppercase">Sosial</p>
            <p class="text-xl font-black text-purple-600">+10%</p>
            <p class="text-[8px] text-gray-400 mt-1">Naik 3% dari bulan lalu</p>
        </div>
    </div>

    <!-- Achievement Badges -->
    <div
        class="bg-gradient-to-r from-yellow-50 to-orange-50 p-6 rounded-[35px] border border-yellow-100">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-trophy mr-2 text-yellow-500"></i>
            Penghargaan Terbaru
        </h4>
        <div class="flex space-x-4 overflow-x-auto pb-2">
            <div class="flex-shrink-0 w-20 text-center">
                <div
                    class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-2">
                    <i class="fa-solid fa-fire text-yellow-600 text-2xl"></i>
                </div>
                <p class="text-[9px] font-bold text-gray-700">Siswa Berprestasi</p>
            </div>
            <div class="flex-shrink-0 w-20 text-center">
                <div
                    class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-2">
                    <i class="fa-solid fa-star text-green-600 text-2xl"></i>
                </div>
                <p class="text-[9px] font-bold text-gray-700">Konsisten</p>
            </div>
            <div class="flex-shrink-0 w-20 text-center">
                <div
                    class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-2">
                    <i class="fa-solid fa-comments text-blue-600 text-2xl"></i>
                </div>
                <p class="text-[9px] font-bold text-gray-700">Komunikator</p>
            </div>
        </div>
    </div>
</div>
