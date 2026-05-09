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
        <div @click="nav('buku_penghubung')" class="text-center cursor-pointer group">
            <div
                class="bg-purple-100 text-purple-500 w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-active:scale-90 transition-all duration-300 ripple">
                <i class="fa-solid fa-book-open-reader"></i>
            </div>
            <span class="text-[9px] font-bold text-gray-500 uppercase tracking-tighter">Buku</span>
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
        <div @click="nav('jadwal_terapi')" class="text-center cursor-pointer group">
            <div
                class="bg-yellow-100 text-yellow-500 w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-active:scale-90 transition-all duration-300 ripple">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
            <span class="text-[9px] font-bold text-gray-500 uppercase tracking-tighter">Jadwal</span>
        </div>
        <div @click="nav('galeri')" class="text-center cursor-pointer group">
            <div
                class="bg-pink-100 text-pink-500 w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-2 group-hover:scale-110 group-active:scale-90 transition-all duration-300 ripple">
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
            <button @click="showToast('Memuat semua aktivitas...', 'success')"
                class="text-xs font-bold text-indigo-500 hover:text-indigo-700 transition-colors">
                Lihat Semua
            </button>
        </div>

        <div class="space-y-4">
            <template x-for="(activity, index) in activities" :key="activity.title">
                <div class="kid-card p-5 border-2 shadow-sm hover-lift active:scale-[0.98] transition-all duration-300 cursor-pointer animate-slide-up"
                    :class="{
                        'border-green-100 bg-green-50/50': activity.color === 'green',
                        'border-blue-100 bg-blue-50/50': activity.color === 'blue'
                    }"
                    :style="`animation-delay: ${index * 0.1}s`"
                    @click="showToast(`Membuka detail ${activity.title}`, 'success')">
                    <div class="flex justify-between items-start">
                        <p class="font-bold text-indigo-900 text-sm flex items-center">
                            <i class="fa-solid fa-circle text-xs mr-2" :class="{
                                'text-green-500': activity.color === 'green',
                                'text-blue-500': activity.color === 'blue'
                            }"></i>
                            <span x-text="activity.title"></span>
                        </p>
                        <div class="flex items-center space-x-2">
                            <span
                                class="text-white text-[9px] font-bold px-2.5 py-1 rounded-lg uppercase"
                                :class="{
                                    'bg-green-500': activity.color === 'green',
                                    'bg-blue-500': activity.color === 'blue'
                                }"
                                x-text="activity.status"></span>
                        </div>
                    </div>
                    <p class="text-xs text-slate-700 mt-2 font-medium leading-relaxed" x-show="activity.note" x-text="activity.note">
                    </p>
                    <div class="mt-4 pt-4 border-t border-dashed border-slate-200 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <span class="text-[10px] text-slate-600 font-bold"
                                x-text="'Terapis: ' + activity.therapist"></span>
                            <span class="text-[9px] text-slate-500 font-bold"
                                x-text="activity.time"></span>
                        </div>
                        <i
                            class="fa-solid fa-arrow-right text-indigo-300 text-xs group-hover:translate-x-1 transition-transform"></i>
                    </div>
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
            <div class="bg-white p-3 rounded-2xl text-center hover-lift cursor-pointer"
                @click="nav('jadwal_terapi')">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Sesi</p>
                <p class="text-lg font-black text-indigo-600">3</p>
            </div>
            <div class="bg-white p-3 rounded-2xl text-center hover-lift cursor-pointer"
                @click="nav('progres')">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Progress</p>
                <p class="text-lg font-black text-green-600">+8%</p>
            </div>
            <div class="bg-white p-3 rounded-2xl text-center hover-lift cursor-pointer"
                @click="nav('tagihan')">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Tagihan</p>
                <p class="text-lg font-black text-blue-600">1</p>
            </div>
        </div>
    </div>
</div>
