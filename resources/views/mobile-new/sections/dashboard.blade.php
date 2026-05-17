<div class="space-y-8" x-show="!isLoading">
    <!-- Quick Actions Grid -->
    <div
        class="bg-white rounded-[35px] shadow-xl p-6 grid grid-cols-4 gap-4 border border-indigo-50 hover-lift">
        <div @click="nav('absensi')" class="text-center cursor-pointer group">
            <div
                class="bg-indigo-100 text-indigo-500 w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-active:scale-90 transition-all duration-300 ripple">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <span class="text-[9px] font-bold text-gray-500 uppercase tracking-tighter">Absensi</span>
        </div>
        <div @click="nav('buku_anak')" class="text-center cursor-pointer group">
            <div
                class="bg-orange-100 text-orange-500 w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-active:scale-90 transition-all duration-300 ripple">
                <i class="fa-solid fa-book-open-reader"></i>
            </div>
            <span class="text-[9px] font-bold text-gray-500 uppercase tracking-tighter">Buku Anak</span>
        </div>
        <div @click="nav('assessment_psikolog')" class="text-center cursor-pointer group">
            <div
                class="bg-rose-100 text-rose-500 w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-active:scale-90 transition-all duration-300 ripple">
                <i class="fa-solid fa-brain"></i>
            </div>
            <span class="text-[9px] font-bold text-gray-500 uppercase tracking-tighter">Psikolog</span>
        </div>
        <div @click="nav('observasi')" class="text-center cursor-pointer group">
            <div
                class="bg-teal-100 text-teal-500 w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-active:scale-90 transition-all duration-300 ripple">
                <i class="fa-solid fa-eye"></i>
            </div>
            <span class="text-[9px] font-bold text-gray-500 uppercase tracking-tighter">Observasi</span>
        </div>
        <div @click="nav('daftar_terapis')" class="text-center cursor-pointer group">
            <div
                class="bg-blue-100 text-blue-500 w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-active:scale-90 transition-all duration-300 ripple">
                <i class="fa-solid fa-user-doctor"></i>
            </div>
            <span class="text-[9px] font-bold text-gray-500 uppercase tracking-tighter">Terapis</span>
        </div>
        <div @click="nav('paket_terapi')" class="text-center cursor-pointer group">
            <div
                class="bg-green-100 text-green-500 w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-active:scale-90 transition-all duration-300 ripple">
                <i class="fa-solid fa-box-open"></i>
            </div>
            <span class="text-[9px] font-bold text-gray-500 uppercase tracking-tighter">Paket</span>
        </div>
        <div @click="nav('tagihan')" class="text-center cursor-pointer group">
            <div
                class="bg-yellow-100 text-yellow-600 w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-active:scale-90 transition-all duration-300 ripple">
                <i class="fa-solid fa-file-invoice-dollar"></i>
            </div>
            <span class="text-[9px] font-bold text-gray-500 uppercase tracking-tighter">Tagihan</span>
        </div>
        <div class="text-center opacity-40 cursor-not-allowed group">
            <div
                class="bg-pink-100 text-pink-500 w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-2">
                <i class="fa-solid fa-images"></i>
            </div>
            <span class="text-[9px] font-bold text-gray-500 uppercase tracking-tighter">Galeri</span>
        </div>
    </div>

    <!-- Recent Activities -->
    <div>
        <div class="flex justify-between items-center mb-4 px-2">
            <h3 class="font-bold text-gray-800 flex items-center">
                <i class="fa-solid fa-clock-rotate-left mr-2 text-indigo-500"></i>
                Aktivitas Terakhir
            </h3>
            <button @click="nav('buku_anak')"
                class="text-xs font-bold text-indigo-500 hover:text-indigo-700 transition-colors">
                Lihat Semua
            </button>
        </div>

        <div class="space-y-4">
            <template x-for="(activity, index) in activities" :key="activity.id">
                <div class="kid-card p-5 border-2 shadow-sm hover-lift active:scale-[0.98] transition-all duration-300 cursor-pointer animate-slide-up"
                    :class="{
                        'border-green-100 bg-green-50/50': activity.color === 'green',
                        'border-blue-100 bg-blue-50/50': activity.color === 'blue'
                    }"
                    :style="`animation-delay: ${index * 0.1}s`"
                    @click="openActivityDetail(activity.id)">
                    <div class="flex justify-between items-start">
                        <p class="font-bold text-indigo-900 text-sm flex items-center">
                            <i class="fa-solid fa-circle text-xs mr-2" :class="{
                                'text-green-500': activity.color === 'green',
                                'text-blue-500': activity.color === 'blue'
                            }"></i>
                            <span x-text="activity.title"></span>
                        </p>
                        <div class="flex items-center space-x-2">
                            <!-- Icon Wajah di sebelah kanan (Kuning) -->
                            <i x-show="activity.hasil" class="fa-solid text-lg text-yellow-400" :class="{
                                'fa-face-smile': activity.hasil === 'baik',
                                'fa-face-meh': activity.hasil === 'cukup',
                                'fa-face-frown': activity.hasil === 'kurang'
                            }"></i>
                            <span
                                class="text-white text-[9px] font-black px-2.5 py-1 rounded-lg uppercase shadow-sm bg-green-500"
                                x-text="activity.status"></span>
                        </div>
                    </div>
                    
                    <!-- Result Text -->
                    <div class="mt-2" x-show="activity.hasil">
                        <p class="text-xs text-slate-700 font-medium leading-relaxed italic">
                            "Menyelesaikan sesi dengan <span x-text="activity.hasil === 'baik' ? 'baik' : (activity.hasil === 'cukup' ? 'cukup baik' : 'kurang baik')"></span>"
                        </p>
                    </div>

                    <div class="mt-4 pt-4 border-t border-dashed border-slate-200 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-1">
                                <i class="fa-solid fa-user-doctor text-[10px] text-indigo-300"></i>
                                <span class="text-[10px] text-slate-600 font-bold" x-text="activity.therapist"></span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i class="fa-solid fa-clock text-[10px] text-slate-300"></i>
                                <span class="text-[9px] text-slate-500 font-bold" x-text="activity.time"></span>
                            </div>
                        </div>
                        <i
                            class="fa-solid fa-arrow-right text-indigo-300 text-xs group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </div>
            </template>

            <!-- Empty State -->
            <template x-if="activities.length === 0">
                <div class="bg-gray-50/50 border-2 border-dashed border-gray-100 rounded-[35px] p-8 text-center">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <i class="fa-solid fa-calendar-minus text-gray-300 text-2xl"></i>
                    </div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Belum ada aktivitas terbaru</p>
                    <p class="text-[10px] text-gray-300 mt-1">Daftarkan anak untuk mulai terapi</p>
                </div>
            </template>
        </div>
    </div>

    <!-- Quick Stats -->
    <div
        class="bg-gradient-to-r from-indigo-50 to-purple-50 p-6 rounded-[35px] border border-indigo-100">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-chart-column mr-2 text-purple-500"></i>
            Statistik Minggu Ini
        </h4>
        <div class="grid grid-cols-3 gap-3">
            <div class="bg-white p-3 rounded-2xl text-center cursor-default">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Sesi</p>
                <p class="text-lg font-black text-indigo-600" x-text="sesiMingguIni"></p>
            </div>
            <div class="bg-white p-3 rounded-2xl text-center cursor-default">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Progress</p>
                <p class="text-lg font-black text-green-600" x-text="progress"></p>
            </div>
            <div class="bg-white p-3 rounded-2xl text-center cursor-default">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Tagihan</p>
                <p class="text-lg font-black text-blue-600" x-text="tagihanCount"></p>
            </div>
        </div>
    </div>
</div>
