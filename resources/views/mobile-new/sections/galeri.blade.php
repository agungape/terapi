<div class="space-y-6" x-show="!isLoading">
    <!-- Gallery Stats -->
    <div class="bg-gradient-to-r from-pink-50 to-rose-50 p-6 rounded-[35px] border border-pink-100">
        <div class="flex justify-between items-center">
            <div>
                <h4 class="font-bold text-gray-800">Memori Terapi</h4>
                <p class="text-[11px] text-gray-500">Total 156 foto & video</p>
            </div>
            <button @click="showToast('Upload foto baru', 'success')"
                class="bg-pink-600 text-white p-3 rounded-2xl hover:bg-pink-700 transition-colors">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
    </div>

    <!-- Photo Grid -->
    <div class="grid grid-cols-2 gap-4">
        <template x-for="(photo, index) in galleryPhotos" :key="photo.id">
            <div class="kid-card p-4 hover-lift animate-slide-up"
                :style="`animation-delay: ${index * 0.1}s`">
                <!-- Photo Placeholder -->
                <div
                    class="w-full h-40 rounded-2xl bg-gradient-to-br from-pink-200 to-rose-300 mb-3 flex items-center justify-center">
                    <i class="fa-solid fa-images text-white text-3xl"></i>
                </div>

                <div class="space-y-2">
                    <div>
                        <p class="font-bold text-gray-800 text-sm" x-text="photo.activity"></p>
                        <p class="text-[10px] text-gray-500" x-text="photo.date"></p>
                    </div>
                    <p class="text-xs text-gray-600 leading-relaxed" x-text="photo.description"></p>

                    <div class="flex items-center justify-between pt-3 border-t border-dashed">
                        <div class="flex items-center space-x-4">
                            <button @click="likePhoto(index)"
                                class="flex items-center space-x-1 text-gray-400 hover:text-pink-500 transition-colors">
                                <i class="fa-regular fa-heart"></i>
                                <span class="text-xs" x-text="photo.likes"></span>
                            </button>
                            <button @click="showToast('Tambah komentar', 'success')"
                                class="flex items-center space-x-1 text-gray-400 hover:text-blue-500 transition-colors">
                                <i class="fa-regular fa-comment"></i>
                                <span class="text-xs" x-text="photo.comments"></span>
                            </button>
                        </div>
                        <button @click="showToast('Bagikan foto', 'success')"
                            class="text-gray-400 hover:text-green-500 transition-colors">
                            <i class="fa-solid fa-share-nodes"></i>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Recent Memories -->
    <div
        class="bg-gradient-to-r from-yellow-50 to-orange-50 p-6 rounded-[35px] border border-yellow-100">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-trophy mr-2 text-yellow-500"></i>
            Momen Terbaik
        </h4>
        <div class="flex space-x-4 overflow-x-auto pb-2">
            <div class="flex-shrink-0">
                <div
                    class="w-24 h-24 rounded-2xl bg-gradient-to-br from-blue-200 to-indigo-300 flex items-center justify-center">
                    <i class="fa-solid fa-medal text-white text-2xl"></i>
                </div>
                <p class="text-[9px] font-bold text-center mt-2 text-gray-700">Pertama Kali Bicara</p>
            </div>
            <div class="flex-shrink-0">
                <div
                    class="w-24 h-24 rounded-2xl bg-gradient-to-br from-green-200 to-emerald-300 flex items-center justify-center">
                    <i class="fa-solid fa-puzzle-piece text-white text-2xl"></i>
                </div>
                <p class="text-[9px] font-bold text-center mt-2 text-gray-700">Selesaikan Puzzle</p>
            </div>
            <div class="flex-shrink-0">
                <div
                    class="w-24 h-24 rounded-2xl bg-gradient-to-br from-purple-200 to-pink-300 flex items-center justify-center">
                    <i class="fa-solid fa-hands-clapping text-white text-2xl"></i>
                </div>
                <p class="text-[9px] font-bold text-center mt-2 text-gray-700">Interaksi Sosial</p>
            </div>
        </div>
    </div>
</div>
