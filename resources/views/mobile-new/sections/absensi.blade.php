<div class="space-y-6" x-show="!isLoading">
    <!-- Statistik Paket -->
    <div class="pt-10 space-y-4">
        <template x-for="pkg in attendanceStats.packages" :key="pkg.id">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-5 rounded-[30px] border border-green-100 shadow-sm relative overflow-hidden group mx-2">
                <div class="absolute -right-4 -top-4 w-20 h-20 bg-green-200/20 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                
                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div>
                        <h5 class="font-black text-indigo-900 text-sm uppercase tracking-tight" x-text="pkg.name"></h5>
                        <p class="text-[10px] text-gray-500" x-text="new Date().toLocaleString('id-ID', { month: 'long', year: 'numeric' })"></p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-black text-green-600" x-text="Math.round((pkg.hadir / pkg.totalQuota) * 100) + '%'"></p>
                        <p class="text-[9px] font-bold text-gray-400 uppercase">Pemakaian</p>
                    </div>
                </div>

                <div class="grid grid-cols-5 gap-1.5 relative z-10">
                    <div class="bg-white/80 backdrop-blur-sm p-2 rounded-2xl text-center border border-white">
                        <p class="text-[7px] font-bold text-gray-400 uppercase mb-0.5">Total</p>
                        <p class="text-[11px] font-black text-gray-700" x-text="pkg.totalUsed + '/' + pkg.totalQuota"></p>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm p-2 rounded-2xl text-center border border-white">
                        <p class="text-[7px] font-bold text-gray-400 uppercase mb-0.5">Hadir</p>
                        <p class="text-[11px] font-black text-green-600" x-text="pkg.hadir"></p>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm p-2 rounded-2xl text-center border border-white">
                        <p class="text-[7px] font-bold text-gray-400 uppercase mb-0.5">Sakit</p>
                        <p class="text-[11px] font-black text-purple-600" x-text="pkg.sakit"></p>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm p-2 rounded-2xl text-center border border-white">
                        <p class="text-[7px] font-bold text-gray-400 uppercase mb-0.5">Izin</p>
                        <p class="text-[11px] font-black text-amber-500" x-text="pkg.izin"></p>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm p-2 rounded-2xl text-center border border-white">
                        <p class="text-[7px] font-bold text-gray-400 uppercase mb-0.5">Hangus</p>
                        <p class="text-[11px] font-black text-red-600" x-text="pkg.hangus"></p>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Package Selector (Tabs) -->
    <div x-show="attendanceStats.packages.length > 1" class="flex p-1 bg-gray-100 rounded-2xl mx-4">
        <template x-for="pkg in attendanceStats.packages" :key="pkg.id">
            <button 
                @click="selectedPackageId = pkg.id"
                class="flex-1 py-2.5 rounded-xl text-[10px] font-black transition-all duration-300 uppercase tracking-wider"
                :class="selectedPackageId === pkg.id ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-400 hover:text-gray-600'"
                x-text="pkg.name">
            </button>
        </template>
    </div>

    <!-- Attendance Calendar -->
    <div class="bg-white p-6 rounded-[35px] border-2 border-gray-50 shadow-sm mx-2">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-3">
                <button @click="prevMonth()" class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-colors">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>
                <div class="text-center min-w-[120px]">
                    <h4 class="font-black text-gray-800 text-sm uppercase tracking-wider" x-text="currentViewDate.toLocaleString('id-ID', { month: 'long' })"></h4>
                    <p class="text-[10px] font-bold text-gray-400" x-text="currentViewDate.getFullYear()"></p>
                </div>
                <button @click="nextMonth()" class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition-colors">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>
            <div class="w-10 h-10 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-500">
                <i class="fa-solid fa-calendar-days text-lg"></i>
            </div>
        </div>
        
        <div class="grid grid-cols-7 gap-1 text-center mb-4">
            <template x-for="day in ['S','S','R','K','J','S','M']">
                <div class="text-[10px] font-black text-gray-300 p-2" x-text="day"></div>
            </template>

            <!-- Start Padding -->
            <template x-for="p in getFirstDayOfMonth()">
                <div class="aspect-square flex items-center justify-center opacity-10">
                    <div class="w-1.5 h-1.5 rounded-full bg-gray-200"></div>
                </div>
            </template>

            <!-- Days -->
            <template x-for="day in getDaysInMonth()" :key="day">
                <div class="aspect-square flex items-center justify-center">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-black transition-all duration-500 relative" 
                        :class="{
                            'bg-green-500 text-white shadow-lg shadow-green-200 scale-110': getStatusForDate(day) === 'hadir',
                            'bg-purple-500 text-white shadow-lg shadow-purple-100': getStatusForDate(day) === 'sakit',
                            'bg-amber-400 text-white shadow-lg shadow-amber-100': getStatusForDate(day) === 'izin',
                            'bg-red-500 text-white shadow-lg shadow-red-100': getStatusForDate(day) === 'izin_hangus',
                            'bg-blue-400 text-white shadow-lg shadow-blue-100': getStatusForDate(day) === 'libur',
                            'text-gray-400 hover:bg-gray-50': getStatusForDate(day) === 'none',
                            'ring-2 ring-indigo-600 ring-offset-2': isToday(day)
                        }">
                        <span x-text="day"></span>
                    </div>
                </div>
            </template>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-3 pt-4 border-t border-gray-50">
            <div class="flex items-center space-x-1.5">
                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                <span class="text-[9px] font-bold text-gray-500 uppercase">Hadir</span>
            </div>
            <div class="flex items-center space-x-1.5">
                <div class="w-2 h-2 rounded-full bg-purple-500"></div>
                <span class="text-[9px] font-bold text-gray-500 uppercase">Sakit</span>
            </div>
            <div class="flex items-center space-x-1.5">
                <div class="w-2 h-2 rounded-full bg-amber-400"></div>
                <span class="text-[9px] font-bold text-gray-500 uppercase">Izin</span>
            </div>
            <div class="flex items-center space-x-1.5">
                <div class="w-2 h-2 rounded-full bg-red-500"></div>
                <span class="text-[9px] font-bold text-gray-500 uppercase">Hangus</span>
            </div>
            <div class="flex items-center space-x-1.5">
                <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                <span class="text-[9px] font-bold text-gray-500 uppercase">Libur</span>
            </div>
        </div>
    </div>

    <!-- Attendance History -->
    <div class="px-2">
        <h4 class="font-bold text-gray-800 mb-4 px-2 flex items-center">
            <i class="fa-solid fa-clock-rotate-left mr-2 text-gray-400"></i>
            10 Sesi Terakhir
        </h4>

        <div class="space-y-3">
            <template x-for="(attendance, index) in getSelectedPackage()?.history.slice(0, 10)" :key="attendance.id">
                <div class="kid-card p-5 hover-lift transition-all duration-300">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-2xl flex flex-col items-center justify-center shadow-sm"
                                :class="{
                                    'bg-green-100 text-green-700': attendance.status === 'Hadir',
                                    'bg-purple-100 text-purple-700': attendance.status === 'Sakit',
                                    'bg-amber-100 text-amber-700': attendance.status === 'Izin',
                                    'bg-red-100 text-red-700': attendance.status === 'Hangus'
                                }">
                                <span class="text-[10px] font-black uppercase" x-text="attendance.day.substring(0, 3)"></span>
                                <span class="text-base font-black leading-none" x-text="attendance.date.split(' ')[0]"></span>
                            </div>
                            <div>
                                <p class="font-black text-indigo-900 text-sm" x-text="attendance.date"></p>
                                <p class="text-[11px] font-bold text-gray-400" x-text="attendance.type"></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-[9px] font-black px-3 py-1 rounded-full border-2 transition-colors duration-300"
                                :class="getStatusColor(attendance.status)" x-text="attendance.status">
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-dashed border-gray-100 flex items-center justify-between">
                        <div class="flex items-center space-x-1 text-[10px] font-bold text-gray-400">
                            <i class="fa-solid fa-user-doctor text-indigo-300"></i>
                            <span x-text="attendance.therapist"></span>
                        </div>
                        <div class="flex items-center space-x-1 text-[10px] font-bold text-gray-400">
                            <i class="fa-solid fa-clock text-indigo-300"></i>
                            <span x-text="attendance.timeIn + ' - ' + attendance.timeOut"></span>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="!getSelectedPackage()?.history.length">
                <div class="text-center py-10">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fa-solid fa-calendar-minus text-gray-200 text-2xl"></i>
                    </div>
                    <p class="text-xs font-bold text-gray-400 uppercase">Belum ada riwayat sesi</p>
                </div>
            </template>
        </div>
    </div>
</div>
