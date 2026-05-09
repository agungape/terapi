<div class="space-y-6" x-show="!isLoading">
    <!-- Current Package -->
    <div
        class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-[35px] border border-green-100">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h4 class="font-bold text-gray-800 text-lg flex items-center">
                    <i class="fa-solid fa-crown mr-2 text-yellow-500"></i>
                    Paket Aktif
                </h4>
                <p class="text-[11px] text-gray-500">Berakhir 15 Maret 2026</p>
            </div>
            <span class="bg-green-100 text-green-700 text-[10px] font-bold px-3 py-1 rounded-full">
                Premium
            </span>
        </div>
        <div class="bg-white p-5 rounded-3xl">
            <div class="flex justify-between items-center mb-3">
                <div>
                    <p class="text-xl font-black text-gray-800">24 Sesi</p>
                    <p class="text-sm text-gray-600">Sisa: <span class="font-bold text-green-600">4
                            sesi</span></p>
                </div>
                <div class="text-right">
                    <p class="text-lg font-black text-green-600">Rp 4.200.000</p>
                    <p class="text-[10px] text-gray-500">2 Bulan</p>
                </div>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-3">
                <div class="bg-green-500 h-3 rounded-full" style="width: 83%"></div>
            </div>
        </div>
    </div>

    <!-- Available Packages -->
    <div>
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-boxes-stacked mr-2 text-purple-500"></i>
            Pilihan Paket Lain
        </h4>

        <div class="space-y-4">
            <template x-for="(pkg, index) in therapyPackages" :key="pkg.id">
                <div class="kid-card p-6 shadow-sm hover-lift border-2 animate-slide-up"
                    :class="pkg.popular ? 'border-yellow-300 border-3' : 'border-gray-100'"
                    :style="`animation-delay: ${index * 0.1}s`">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h5 class="font-bold text-lg text-gray-800" x-text="pkg.name"></h5>
                            <p class="text-sm text-gray-600" x-text="pkg.period"></p>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-black text-indigo-600" x-text="pkg.price"></p>
                            <p class="text-[10px] text-gray-500" x-text="pkg.sessions + ' sesi'"></p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <template x-for="feature in pkg.features" :key="feature">
                            <div class="flex items-center space-x-2 mb-2">
                                <i class="fa-solid fa-check text-green-500"></i>
                                <span class="text-sm text-gray-700" x-text="feature"></span>
                            </div>
                        </template>
                    </div>

                    <div class="flex space-x-3">
                        <button @click="selectPackage(pkg.name)"
                            class="flex-1 bg-indigo-600 text-white py-3 rounded-xl text-sm font-bold hover:bg-indigo-700 transition-colors">
                            Pilih Paket
                        </button>
                        <button @click="showToast('Detail paket ' + pkg.name, 'success')"
                            class="flex-1 bg-white border border-indigo-600 text-indigo-600 py-3 rounded-xl text-sm font-bold hover:bg-indigo-50 transition-colors">
                            Detail
                        </button>
                    </div>

                    <div x-show="pkg.popular" class="mt-4 text-center">
                        <span
                            class="inline-block bg-yellow-100 text-yellow-700 text-[10px] font-bold px-3 py-1 rounded-full">
                            <i class="fa-solid fa-fire mr-1"></i>Paling Populer
                        </span>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
