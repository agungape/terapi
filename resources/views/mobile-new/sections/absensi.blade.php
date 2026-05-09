<div class="space-y-6" x-show="!isLoading">
    <!-- Attendance Stats -->
    <div
        class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-[35px] border border-green-100">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h4 class="font-bold text-gray-800 text-lg">Presensi Bulan Ini</h4>
                <p class="text-[11px] text-gray-500">Februari 2026</p>
            </div>
            <div class="text-right">
                <p class="text-2xl font-black text-green-600"
                    x-text="getAttendanceStats().percentage + '%'"></p>
                <p class="text-[10px] text-gray-500">Kehadiran</p>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-3">
            <div class="bg-white p-3 rounded-2xl text-center">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Total</p>
                <p class="text-lg font-black text-gray-700" x-text="getAttendanceStats().total"></p>
            </div>
            <div class="bg-white p-3 rounded-2xl text-center">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Hadir</p>
                <p class="text-lg font-black text-green-600" x-text="getAttendanceStats().present"></p>
            </div>
            <div class="bg-white p-3 rounded-2xl text-center">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Tidak</p>
                <p class="text-lg font-black text-red-600" x-text="getAttendanceStats().absent"></p>
            </div>
            <div class="bg-white p-3 rounded-2xl text-center">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Libur</p>
                <p class="text-lg font-black text-blue-600" x-text="getAttendanceStats().holiday"></p>
            </div>
        </div>
    </div>

    <!-- Quick Check In/Out -->
    <div class="kid-card p-6 border-2 border-green-100 shadow-sm">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-clock mr-2 text-green-500"></i>
            Presensi Hari Ini
        </h4>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="bg-green-50 p-4 rounded-2xl text-center">
                <p class="text-[10px] font-bold text-green-700 uppercase mb-2">Check In</p>
                <p class="text-2xl font-black text-green-600">09:58</p>
                <p class="text-[9px] text-green-500">Tepat waktu</p>
            </div>
            <div class="bg-blue-50 p-4 rounded-2xl text-center">
                <p class="text-[10px] font-bold text-blue-700 uppercase mb-2">Check Out</p>
                <p class="text-2xl font-black text-blue-600">11:05</p>
                <p class="text-[9px] text-blue-500">Sesi selesai</p>
            </div>
        </div>

        <div class="flex space-x-3">
            <button @click="checkIn()"
                class="flex-1 bg-green-600 text-white py-3 rounded-xl text-sm font-bold hover:bg-green-700 transition-colors">
                <i class="fa-solid fa-right-to-bracket mr-2"></i>Check In
            </button>
            <button @click="checkOut()"
                class="flex-1 bg-blue-600 text-white py-3 rounded-xl text-sm font-bold hover:bg-blue-700 transition-colors">
                <i class="fa-solid fa-right-from-bracket mr-2"></i>Check Out
            </button>
        </div>
    </div>

    <!-- Attendance History -->
    <div>
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-calendar-days mr-2 text-gray-500"></i>
            Riwayat Presensi
        </h4>

        <div class="space-y-3">
            <template x-for="(attendance, index) in attendanceData" :key="attendance.id">
                <div class="kid-card p-5 hover-lift animate-slide-up"
                    :style="`animation-delay: ${index * 0.1}s`">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-2xl flex flex-col items-center justify-center"
                                :class="{
                                    'bg-green-100 text-green-700': attendance.status === 'Hadir',
                                    'bg-red-100 text-red-700': attendance.status === 'Sakit',
                                    'bg-yellow-100 text-yellow-700': attendance.status === 'Izin',
                                    'bg-blue-100 text-blue-700': attendance.status === 'Libur'
                                }">
                                <span class="text-xs font-bold"
                                    x-text="attendance.day.substring(0, 3)"></span>
                                <span class="text-sm font-black"
                                    x-text="attendance.date.split(' ')[0]"></span>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800" x-text="attendance.date"></p>
                                <p class="text-sm text-gray-600" x-text="attendance.type"></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] font-bold px-3 py-1 rounded-full border"
                                :class="getStatusColor(attendance.status)" x-text="attendance.status">
                            </span>
                            <div class="mt-1">
                                <i class="fa-solid text-lg" :class="getMoodIcon(attendance.mood)"
                                    :style="{
                                        color: attendance.mood === 'happy' ? '#f59e0b' :
                                               attendance.mood === 'excited' ? '#ec4899' :
                                               attendance.mood === 'neutral' ? '#6b7280' :
                                               attendance.mood === 'sick' ? '#ef4444' : '#3b82f6'
                                    }">
                                </i>
                            </div>
                        </div>
                    </div>

                    <template x-if="attendance.status === 'Hadir'">
                        <div class="grid grid-cols-2 gap-3 p-3 bg-gray-50 rounded-2xl">
                            <div class="text-center">
                                <p class="text-[9px] font-bold text-gray-400 uppercase">Masuk</p>
                                <p class="text-sm font-semibold text-gray-700"
                                    x-text="attendance.timeIn"></p>
                            </div>
                            <div class="text-center">
                                <p class="text-[9px] font-bold text-gray-400 uppercase">Pulang</p>
                                <p class="text-sm font-semibold text-gray-700"
                                    x-text="attendance.timeOut"></p>
                            </div>
                        </div>
                    </template>

                    <div class="mt-3 flex items-center justify-between">
                        <span class="text-[10px] text-gray-500 font-bold"
                            x-text="attendance.therapist !== '-' ? 'Terapis: ' + attendance.therapist : ''">
                        </span>
                        <button @click="showToast('Detail presensi ' + attendance.date, 'success')"
                            class="text-xs text-green-600 font-bold hover:text-green-700">
                            <i class="fa-solid fa-info-circle mr-1"></i>Detail
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Attendance Calendar -->
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 rounded-[35px] border border-gray-200">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-calendar-alt mr-2 text-gray-500"></i>
            Kalender Presensi
        </h4>
        <div class="grid grid-cols-7 gap-1 text-center">
            <div class="text-[10px] font-bold text-gray-400 p-2">S</div>
            <div class="text-[10px] font-bold text-gray-400 p-2">S</div>
            <div class="text-[10px] font-bold text-gray-400 p-2">R</div>
            <div class="text-[10px] font-bold text-gray-400 p-2">K</div>
            <div class="text-[10px] font-bold text-gray-400 p-2">J</div>
            <div class="text-[10px] font-bold text-gray-400 p-2">S</div>
            <div class="text-[10px] font-bold text-gray-400 p-2">M</div>

            <template x-for="day in 31" :key="day">
                <div class="aspect-square flex items-center justify-center">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm" :class="{
                            'bg-green-100 text-green-700': day <= 10,
                            'bg-red-100 text-red-700': day > 10 && day <= 12,
                            'bg-blue-100 text-blue-700': day === 13 || day === 14,
                            'text-gray-400': day > 14
                        }">
                        <span x-text="day"></span>
                    </div>
                </div>
            </template>
        </div>
        <div class="mt-4 flex items-center justify-center space-x-4 text-[10px]">
            <div class="flex items-center">
                <div class="w-3 h-3 rounded-full bg-green-100 mr-1"></div>
                <span>Hadir</span>
            </div>
            <div class="flex items-center">
                <div class="w-3 h-3 rounded-full bg-red-100 mr-1"></div>
                <span>Tidak Hadir</span>
            </div>
            <div class="flex items-center">
                <div class="w-3 h-3 rounded-full bg-blue-100 mr-1"></div>
                <span>Libur</span>
            </div>
        </div>
    </div>
</div>
