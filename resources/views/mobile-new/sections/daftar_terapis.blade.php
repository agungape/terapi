<div class="space-y-6" x-show="!isLoading">
    <!-- Search Bar -->
    <div class="relative">
        <input type="text" placeholder="Cari terapis..."
            class="w-full p-4 pl-12 rounded-3xl border-2 border-indigo-100 bg-white focus:outline-none focus:border-indigo-300 transition-colors">
        <i
            class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
    </div>

    <!-- Therapist Cards -->
    <div class="space-y-4">
        <template x-for="(therapist, index) in therapists" :key="therapist.id">
            <div class="kid-card p-6 shadow-sm hover-lift animate-slide-up"
                :style="`animation-delay: ${index * 0.1}s`">
                <div class="flex items-start space-x-4">
                    <!-- Avatar -->
                    <div class="relative">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-xl font-bold"
                            x-text="therapist.avatar">
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full border-2 border-white"
                            :class="therapist.status === 'Available' ? 'bg-green-400' : 'bg-yellow-400'">
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-gray-800" x-text="therapist.name"></h4>
                                <p class="text-sm text-blue-600 font-semibold"
                                    x-text="therapist.specialization"></p>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center justify-end space-x-1">
                                    <i class="fa-solid fa-star text-yellow-400 text-xs"></i>
                                    <span class="text-sm font-bold" x-text="therapist.rating"></span>
                                </div>
                                <span class="text-[9px] px-2 py-1 rounded-full font-bold"
                                    :class="therapist.status === 'Available' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'"
                                    x-text="therapist.status">
                                </span>
                            </div>
                        </div>

                        <div class="mt-3 space-y-2">
                            <div class="flex items-center text-xs text-gray-600">
                                <i class="fa-solid fa-briefcase mr-2 text-gray-400"></i>
                                <span x-text="'Pengalaman: ' + therapist.experience"></span>
                            </div>
                            <div class="flex items-center text-xs text-gray-600">
                                <i class="fa-solid fa-clock mr-2 text-gray-400"></i>
                                <span x-text="therapist.schedule"></span>
                            </div>
                        </div>

                        <div class="mt-4 flex space-x-3">
                            <button @click="bookTherapist(therapist.name)"
                                class="flex-1 bg-blue-600 text-white py-2 rounded-xl text-sm font-bold hover:bg-blue-700 transition-colors">
                                <i class="fa-solid fa-calendar-plus mr-2"></i>Book
                            </button>
                            <button @click="showToast('Kirim pesan ke ' + therapist.name, 'success')"
                                class="flex-1 bg-white border border-blue-600 text-blue-600 py-2 rounded-xl text-sm font-bold hover:bg-blue-50 transition-colors">
                                <i class="fa-solid fa-message mr-2"></i>Chat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Quick Stats -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-[35px] border border-blue-100">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-users mr-2 text-blue-500"></i>
            Tim Terapis Arkan
        </h4>
        <div class="grid grid-cols-3 gap-3">
            <div class="bg-white p-3 rounded-2xl text-center">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Total</p>
                <p class="text-lg font-black text-blue-600">3</p>
            </div>
            <div class="bg-white p-3 rounded-2xl text-center">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Tersedia</p>
                <p class="text-lg font-black text-green-600">2</p>
            </div>
            <div class="bg-white p-3 rounded-2xl text-center">
                <p class="text-[8px] font-bold text-gray-400 uppercase">Rating</p>
                <p class="text-lg font-black text-yellow-600">4.9</p>
            </div>
        </div>
    </div>
</div>
