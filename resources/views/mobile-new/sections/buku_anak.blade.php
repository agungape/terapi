<div class="space-y-6" x-show="!isLoading">
    <!-- Child Profile Card -->
    <div
        class="bg-gradient-to-r from-orange-50 to-amber-50 p-6 rounded-[35px] border border-orange-100">
        <div class="flex items-center space-x-4 mb-6">
            <div class="relative">
                <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($anak->nama ?? 'Anak') . '&background=f97316&color=fff' }}"
                    class="w-16 h-16 rounded-2xl border-4 border-white shadow-lg">
                <div
                    class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 rounded-full border-2 border-white">
                </div>
            </div>
            <div class="flex-1">
                <h4 class="font-bold text-gray-800 text-lg" x-text="childBook.personalInfo.fullName">
                </h4>
                <p class="text-sm text-gray-600" x-text="childBook.personalInfo.age"></p>
                <p class="text-[10px] text-gray-500"
                    x-text="'Lahir: ' + childBook.personalInfo.birthDate"></p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div class="bg-white p-3 rounded-2xl">
                <p class="text-[9px] font-bold text-gray-400 uppercase">Gol. Darah</p>
                <p class="text-sm font-semibold text-gray-700"
                    x-text="childBook.personalInfo.bloodType"></p>
            </div>
            <div class="bg-white p-3 rounded-2xl">
                <p class="text-[9px] font-bold text-gray-400 uppercase">Alergi</p>
                <p class="text-sm font-semibold text-gray-700"
                    x-text="childBook.personalInfo.allergies"></p>
            </div>
        </div>
    </div>

    <!-- Personal Information -->
    <div class="kid-card p-6 shadow-sm">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-child mr-2 text-orange-500"></i>
            Informasi Pribadi
        </h4>

        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Nama Panggilan</p>
                    <p class="text-sm font-semibold text-gray-700"
                        x-text="childBook.personalInfo.nickname"></p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Makanan Favorit</p>
                    <p class="text-sm font-semibold text-gray-700"
                        x-text="childBook.personalInfo.favoriteFood"></p>
                </div>
            </div>

            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase">Aktivitas Favorit</p>
                <p class="text-sm font-semibold text-gray-700"
                    x-text="childBook.personalInfo.favoriteActivity"></p>
            </div>

            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase">Pola Tidur</p>
                <p class="text-sm font-semibold text-gray-700 whitespace-pre-line"
                    x-text="childBook.personalInfo.sleepPattern"></p>
            </div>

            <div class="bg-orange-50 p-4 rounded-2xl border border-orange-100">
                <p class="text-[10px] font-bold text-orange-700 uppercase mb-2">Catatan Khusus</p>
                <p class="text-sm text-gray-700" x-text="childBook.personalInfo.specialNotes"></p>
            </div>
        </div>
    </div>

    <!-- Developmental Milestones -->
    <div class="kid-card p-6 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h4 class="font-bold text-gray-800 flex items-center">
                <i class="fa-solid fa-star mr-2 text-yellow-500"></i>
                Tonggak Perkembangan
            </h4>
            <button @click="showToast('Tambah milestone baru', 'success')"
                class="text-xs text-orange-600 font-bold hover:text-orange-700">
                <i class="fa-solid fa-plus mr-1"></i>Tambah
            </button>
        </div>

        <div class="space-y-3">
            <template x-for="(milestone, index) in childBook.milestones" :key="milestone.id">
                <div class="p-4 rounded-2xl animate-slide-up" :class="{
                        'milestone-achieved': milestone.status === 'Achieved',
                        'milestone-progress': milestone.status === 'In Progress',
                        'milestone-planned': milestone.status === 'Planned'
                    }" :style="`animation-delay: ${index * 0.1}s`">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="flex items-center space-x-2 mb-1">
                                <span class="text-xs font-bold px-2 py-1 rounded-full" :class="{
                                        'bg-green-100 text-green-700': milestone.status === 'Achieved',
                                        'bg-yellow-100 text-yellow-700': milestone.status === 'In Progress',
                                        'bg-purple-100 text-purple-700': milestone.status === 'Planned'
                                    }" x-text="milestone.status">
                                </span>
                                <span class="text-sm font-bold text-gray-700"
                                    x-text="milestone.age"></span>
                            </div>
                            <p class="font-semibold text-gray-800" x-text="milestone.milestone"></p>
                            <p class="text-[10px] text-gray-500 mt-1"
                                x-text="'Target: ' + milestone.date"></p>
                        </div>
                        <div class="text-right">
                            <i class="fa-solid text-xl" :class="{
                                    'fa-check-circle text-green-500': milestone.status === 'Achieved',
                                    'fa-spinner text-yellow-500': milestone.status === 'In Progress',
                                    'fa-calendar-plus text-purple-500': milestone.status === 'Planned'
                                }">
                            </i>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Medical Records -->
    <div class="kid-card p-6 shadow-sm">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-heart-pulse mr-2 text-red-500"></i>
            Catatan Medis
        </h4>

        <div class="space-y-4">
            <template x-for="(record, index) in childBook.medicalRecords" :key="record.id">
                <div class="border-l-4 border-l-red-400 pl-4 py-2 animate-slide-up"
                    :style="`animation-delay: ${index * 0.1}s`">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-bold text-gray-800" x-text="record.date"></p>
                            <p class="text-sm text-gray-600" x-text="record.doctor"></p>
                        </div>
                        <span
                            class="text-[10px] font-bold bg-red-100 text-red-700 px-2 py-1 rounded-full">
                            <i class="fa-solid fa-stethoscope mr-1"></i>Medis
                        </span>
                    </div>
                    <div class="mt-2">
                        <p class="text-xs font-bold text-gray-400 uppercase">Diagnosis</p>
                        <p class="text-sm text-gray-700" x-text="record.diagnosis"></p>
                    </div>
                    <div class="mt-1">
                        <p class="text-xs font-bold text-gray-400 uppercase">Perawatan</p>
                        <p class="text-sm text-gray-700" x-text="record.treatment"></p>
                    </div>
                    <div class="mt-2 p-2 bg-gray-50 rounded-lg">
                        <p class="text-[10px] font-bold text-gray-400 uppercase">Catatan</p>
                        <p class="text-xs text-gray-600" x-text="record.notes"></p>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Daily Routine -->
    <div class="kid-card p-6 shadow-sm">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-clock mr-2 text-blue-500"></i>
            Rutinitas Harian
        </h4>

        <div class="space-y-4">
            <div class="routine-time p-4 rounded-2xl">
                <p class="text-xs font-bold text-blue-700 uppercase mb-2">Pagi (07:00 - 12:00)</p>
                <p class="text-sm text-gray-700 whitespace-pre-line"
                    x-text="childBook.dailyRoutine.morning"></p>
            </div>

            <div class="routine-time p-4 rounded-2xl">
                <p class="text-xs font-bold text-green-700 uppercase mb-2">Terapi (10:00 - 12:00)</p>
                <p class="text-sm text-gray-700 whitespace-pre-line"
                    x-text="childBook.dailyRoutine.therapy"></p>
            </div>

            <div class="routine-time p-4 rounded-2xl">
                <p class="text-xs font-bold text-yellow-700 uppercase mb-2">Siang (12:00 - 18:00)</p>
                <p class="text-sm text-gray-700 whitespace-pre-line"
                    x-text="childBook.dailyRoutine.afternoon"></p>
            </div>

            <div class="routine-time p-4 rounded-2xl">
                <p class="text-xs font-bold text-purple-700 uppercase mb-2">Malam (18:00 - 21:00)</p>
                <p class="text-sm text-gray-700 whitespace-pre-line"
                    x-text="childBook.dailyRoutine.evening"></p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-[35px] border border-blue-100">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-file-export mr-2 text-blue-500"></i>
            Ekspor Buku Anak
        </h4>
        <div class="grid grid-cols-2 gap-3">
            <button @click="showToast('Mencetak buku anak', 'success')"
                class="bg-white p-4 rounded-2xl text-center hover-lift">
                <i class="fa-solid fa-print text-blue-600 text-xl mb-2"></i>
                <p class="text-xs font-bold text-gray-700">Cetak</p>
            </button>
            <button @click="showToast('Mengunduh PDF buku anak', 'success')"
                class="bg-white p-4 rounded-2xl text-center hover-lift">
                <i class="fa-solid fa-file-pdf text-red-600 text-xl mb-2"></i>
                <p class="text-xs font-bold text-gray-700">PDF</p>
            </button>
        </div>
    </div>
</div>
