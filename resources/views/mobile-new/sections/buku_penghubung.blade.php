<div class="space-y-6" x-show="!isLoading">
    <!-- Filter Buttons -->
    <div class="flex space-x-2 overflow-x-auto pb-2 scrollbar-thin scrollbar-thumb-indigo-200">
        <button @click="filterTerapi = 'semua'"
            :class="filterTerapi === 'semua' ? 'bg-indigo-600 text-white shadow-lg' : 'bg-white text-gray-400 hover:bg-indigo-50'"
            class="px-5 py-2 rounded-2xl text-xs font-bold transition-all shadow-sm whitespace-nowrap border border-indigo-50 hover:scale-105 active:scale-95 ripple">
            Semua Sesi
        </button>
        <button @click="filterTerapi = 'wicara'"
            :class="filterTerapi === 'wicara' ? 'bg-indigo-600 text-white shadow-lg' : 'bg-white text-gray-400 hover:bg-indigo-50'"
            class="px-5 py-2 rounded-2xl text-xs font-bold transition-all shadow-sm whitespace-nowrap border border-indigo-50 hover:scale-105 active:scale-95 ripple">
            <i class="fa-solid fa-comment-dots mr-1"></i> Wicara
        </button>
        <button @click="filterTerapi = 'sensori'"
            :class="filterTerapi === 'sensori' ? 'bg-indigo-600 text-white shadow-lg' : 'bg-white text-gray-400 hover:bg-indigo-50'"
            class="px-5 py-2 rounded-2xl text-xs font-bold transition-all shadow-sm whitespace-nowrap border border-indigo-50 hover:scale-105 active:scale-95 ripple">
            <i class="fa-solid fa-puzzle-piece mr-1"></i> Sensori
        </button>
    </div>

    <!-- Session Cards -->
    <div class="space-y-4">
        <template x-for="(session, index) in filteredSessions()" :key="session.id">
            <div class="kid-card p-6 shadow-lg hover-lift border-l-4 animate-slide-up" :class="{
                    'border-l-indigo-400': session.type === 'wicara',
                    'border-l-teal-400': session.type === 'sensori'
                }" :style="`animation-delay: ${index * 0.1}s`"
                @click="showToast(`Membuka detail sesi ${session.type}`, 'success')">
                <div class="flex justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="bg-indigo-50 text-indigo-600 w-10 h-10 rounded-xl flex items-center justify-center text-lg"
                            :class="{'bg-teal-50 text-teal-600': session.type === 'sensori'}">
                            <i class="fa-solid" :class="session.type === 'wicara' ? 'fa-comment-dots' : 'fa-puzzle-piece'"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm"
                                x-text="'Terapi ' + (session.type === 'wicara' ? 'Wicara' : 'Sensori')">
                            </h4>
                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter"
                                x-text="session.date + ' • ' + session.time"></p>
                        </div>
                    </div>
                    <span class="text-[8px] font-black px-2 py-1 rounded-md self-start border uppercase"
                        :class="{
                            'bg-yellow-100 text-yellow-700 border-yellow-200': session.status === 'excellent',
                            'bg-green-100 text-green-700 border-green-200': session.status === 'good'
                        }" x-text="session.status"></span>
                </div>
                <p class="text-xs text-gray-600 italic leading-relaxed mb-4" x-text="session.note"></p>
                <div
                    class="bg-gradient-to-r from-indigo-50/50 to-indigo-50/20 p-4 rounded-2xl border border-indigo-100">
                    <p class="text-[10px] font-bold text-indigo-700 uppercase mb-1 flex items-center">
                        <i class="fa-solid fa-star-of-life mr-1"></i>
                        Misi Rumah:
                    </p>
                    <p class="text-[11px] text-indigo-900" x-text="session.mission"></p>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-[10px] text-gray-400 font-bold"
                        x-text="'Terapis: ' + session.therapist"></span>
                    <div class="flex space-x-2">
                        <button @click.stop="showToast('Laporkan sesi ini', 'success')"
                            class="text-gray-300 hover:text-rose-500 transition-colors text-xs">
                            <i class="fa-solid fa-flag"></i>
                        </button>
                        <button @click.stop="showToast('Sesi disimpan', 'success')"
                            class="text-gray-300 hover:text-indigo-500 transition-colors text-xs">
                            <i class="fa-regular fa-bookmark"></i>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
