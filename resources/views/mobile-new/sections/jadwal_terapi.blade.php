<div class="space-y-6" x-show="!isLoading">
    <!-- Calendar Header -->
    <div
        class="flex items-center justify-between bg-white p-4 rounded-3xl border border-gray-100 shadow-sm">
        <button class="p-3 rounded-2xl bg-gray-100 hover:bg-gray-200 transition-colors">
            <i class="fa-solid fa-chevron-left text-gray-600"></i>
        </button>
        <div class="text-center">
            <h4 class="font-bold text-gray-800">Februari 2026</h4>
            <p class="text-[10px] text-gray-500">Minggu ke-2</p>
        </div>
        <button class="p-3 rounded-2xl bg-gray-100 hover:bg-gray-200 transition-colors">
            <i class="fa-solid fa-chevron-right text-gray-600"></i>
        </button>
    </div>

    <!-- Schedule Cards -->
    <div class="space-y-4">
        <template x-for="(schedule, index) in therapySchedules" :key="schedule.id">
            <div class="kid-card p-6 shadow-sm hover-lift animate-slide-up"
                :style="`animation-delay: ${index * 0.1}s`">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div
                            class="bg-indigo-100 text-indigo-600 w-12 h-12 rounded-2xl flex flex-col items-center justify-center">
                            <span class="text-xs font-bold"
                                x-text="schedule.day.substring(0, 3)"></span>
                            <span class="text-sm font-black"
                                x-text="schedule.date.split(' ')[1]"></span>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800" x-text="schedule.type"></h5>
                            <p class="text-sm text-gray-600" x-text="schedule.time"></p>
                        </div>
                    </div>
                    <span class="status-badge" :class="{
                        'status-confirmed': schedule.status === 'Confirmed',
                        'status-pending': schedule.status === 'Pending'
                    }" x-text="schedule.status">
                    </span>
                </div>

                <div class="flex items-center space-x-3 mb-4 p-3 bg-gray-50 rounded-2xl">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fa-solid fa-user-md text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400">Terapis</p>
                        <p class="text-sm font-semibold text-gray-700" x-text="schedule.therapist"></p>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <button @click="showToast('Reschedule sesi ' + schedule.type, 'success')"
                        class="flex-1 bg-white border border-indigo-600 text-indigo-600 py-3 rounded-xl text-sm font-bold hover:bg-indigo-50 transition-colors">
                        <i class="fa-solid fa-calendar-arrow-up mr-2"></i>Reschedule
                    </button>
                    <button @click="showToast('Konfirmasi kehadiran ' + schedule.type, 'success')"
                        class="flex-1 bg-indigo-600 text-white py-3 rounded-xl text-sm font-bold hover:bg-indigo-700 transition-colors">
                        <i class="fa-solid fa-check mr-2"></i>Konfirmasi
                    </button>
                </div>
            </div>
        </template>
    </div>

    <!-- Schedule Stats -->
    <div
        class="bg-gradient-to-r from-indigo-50 to-purple-50 p-6 rounded-[35px] border border-indigo-100">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-calendar-check mr-2 text-purple-500"></i>
            Ringkasan Jadwal
        </h4>
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-3xl">
                <p class="text-[9px] font-bold text-gray-400 uppercase">Minggu Ini</p>
                <p class="text-xl font-black text-indigo-600">3 Sesi</p>
            </div>
            <div class="bg-white p-4 rounded-3xl">
                <p class="text-[9px] font-bold text-gray-400 uppercase">Bulan Ini</p>
                <p class="text-xl font-black text-purple-600">12 Sesi</p>
            </div>
        </div>
    </div>
</div>
