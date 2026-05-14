<div class="space-y-6" x-show="!isLoading">
    <!-- Current Package Section -->
    <template x-for="pkg in formattedActivePackages" :key="pkg.id">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-[35px] border border-green-100 animate-slide-up shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h4 class="font-bold text-gray-800 text-lg flex items-center">
                        <i class="fa-solid fa-crown mr-2 text-yellow-500"></i>
                        Paket Aktif
                    </h4>
                    <p class="text-[11px] text-gray-500" x-text="'Mulai: ' + pkg.date"></p>
                </div>
                <span class="bg-green-100 text-green-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase" x-text="pkg.name"></span>
            </div>
            <div class="bg-white p-5 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center mb-3">
                    <div>
                        <p class="text-xl font-black text-gray-800" x-text="pkg.remaining"></p>
                        <p class="text-sm text-gray-600">Sisa dari <span class="font-bold" x-text="pkg.total + ' sesi'"></span></p>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-black text-green-600" x-text="pkg.price"></p>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Status: Aktif</p>
                    </div>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-3">
                    <div class="bg-green-500 h-3 rounded-full transition-all duration-1000" :style="`width: ${pkg.percentage}%`"
                         x-init="$el.style.width = '0%'; setTimeout(() => $el.style.width = pkg.percentage + '%', 100)"></div>
                </div>
                <p class="text-right text-[10px] font-bold text-green-600 mt-2" x-text="pkg.percentage + '% Terpakai'"></p>
            </div>
        </div>
    </template>

    <!-- Empty State for Active Packages -->
    <template x-if="formattedActivePackages.length === 0">
        <div class="bg-gray-50 border-2 border-dashed border-gray-100 rounded-[35px] p-10 text-center">
            <i class="fa-solid fa-box-open text-gray-200 text-3xl mb-3"></i>
            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Belum ada paket aktif</p>
        </div>
    </template>

    <!-- Available Packages List -->
    <div>
        <h4 class="font-black text-slate-800 mb-4 flex items-center px-2">
            <i class="fa-solid fa-boxes-stacked mr-2 text-indigo-500"></i>
            Pilihan Paket Lain
        </h4>

        <div class="space-y-4">
            <template x-for="(pkg, index) in therapyPackages" :key="pkg.id">
                <div class="bg-white p-5 rounded-[35px] shadow-sm border border-slate-50 hover:border-indigo-100 transition-all cursor-pointer animate-slide-up active:scale-[0.98]"
                    :style="`animation-delay: ${index * 0.1}s`"
                    @click="selectedPackage = pkg; showPackageDetail = true">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl shadow-inner transition-colors duration-300"
                                :class="{
                                    'bg-orange-50 text-orange-500': pkg.color === 'orange',
                                    'bg-blue-50 text-blue-500': pkg.color === 'blue',
                                    'bg-purple-50 text-purple-500': pkg.color === 'purple',
                                    'bg-indigo-50 text-indigo-500': pkg.color === 'indigo',
                                    'bg-teal-50 text-teal-600': pkg.color === 'teal',
                                    'bg-rose-50 text-rose-500': pkg.color === 'rose',
                                    'bg-emerald-50 text-emerald-600': pkg.color === 'emerald'
                                }">
                                <i class="fa-solid" :class="pkg.icon"></i>
                            </div>
                            <div class="flex-1">
                                <h5 class="font-black text-slate-800 text-sm leading-tight mb-1" x-text="pkg.name"></h5>
                                <div class="flex items-center space-x-2">
                                    <span class="text-[9px] font-black px-2 py-0.5 rounded-lg uppercase tracking-widest"
                                        :class="{
                                            'bg-orange-100 text-orange-600': pkg.color === 'orange',
                                            'bg-blue-100 text-blue-600': pkg.color === 'blue',
                                            'bg-purple-100 text-purple-600': pkg.color === 'purple',
                                            'bg-indigo-100 text-indigo-600': pkg.color === 'indigo',
                                            'bg-teal-100 text-teal-700': pkg.color === 'teal',
                                            'bg-rose-100 text-rose-600': pkg.color === 'rose',
                                            'bg-emerald-100 text-emerald-700': pkg.color === 'emerald'
                                        }" x-text="pkg.sessions + ' Sesi'"></span>
                                    <span x-show="pkg.popular" class="text-[8px] bg-yellow-400 text-indigo-900 px-2 py-0.5 rounded-lg font-black uppercase tracking-tighter">Populer</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-black text-indigo-600" x-text="pkg.price"></p>
                            <i class="fa-solid fa-chevron-right text-[10px] text-slate-200 mt-1"></i>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Package Detail Modal (Sempurna & Sinkron) -->
    <div x-show="showPackageDetail" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full"
         class="fixed inset-0 z-[9999] flex flex-col justify-end" x-cloak>
        <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" @click="showPackageDetail = false"></div>
        <div class="relative bg-white rounded-t-[48px] shadow-2xl h-[92vh] flex flex-col w-full max-w-md mx-auto overflow-hidden">
            <!-- Header Sticky Area -->
            <div class="bg-white px-8 pt-4 flex-shrink-0 z-10 border-b border-slate-50 pb-4">
                <div class="w-12 h-1.5 bg-slate-200 rounded-full mx-auto mb-4"></div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="showPackageDetail = false" 
                            class="w-10 h-10 rounded-2xl flex items-center justify-center shadow-sm border transition-colors duration-500"
                            :class="{
                                'bg-orange-50 text-orange-500 border-orange-100': selectedPackage?.color === 'orange',
                                'bg-blue-50 text-blue-500 border-blue-100': selectedPackage?.color === 'blue',
                                'bg-purple-50 text-purple-500 border-purple-100': selectedPackage?.color === 'purple',
                                'bg-indigo-50 text-indigo-500 border-indigo-100': selectedPackage?.color === 'indigo',
                                'bg-teal-50 text-teal-600 border-teal-100': selectedPackage?.color === 'teal',
                                'bg-rose-50 text-rose-500 border-rose-100': selectedPackage?.color === 'rose',
                                'bg-emerald-50 text-emerald-600 border-emerald-100': selectedPackage?.color === 'emerald'
                            }">
                            <i class="fas fa-times"></i>
                        </button>
                        <div>
                            <h3 class="text-xl font-black text-slate-800 tracking-tight leading-none">Detail Layanan</h3>
                            <p class="text-[10px] font-black uppercase tracking-widest mt-1.5"
                                :class="{
                                    'text-orange-400': selectedPackage?.color === 'orange',
                                    'text-blue-400': selectedPackage?.color === 'blue',
                                    'text-purple-400': selectedPackage?.color === 'purple',
                                    'text-indigo-400': selectedPackage?.color === 'indigo',
                                    'text-teal-400': selectedPackage?.color === 'teal',
                                    'text-rose-400': selectedPackage?.color === 'rose',
                                    'text-emerald-400': selectedPackage?.color === 'emerald'
                                }">Layanan Profesional</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-black px-3 py-1.5 rounded-xl border uppercase shadow-sm transition-colors duration-500"
                        :class="{
                            'bg-orange-50 text-orange-500 border-orange-100': selectedPackage?.color === 'orange',
                            'bg-blue-50 text-blue-500 border-blue-100': selectedPackage?.color === 'blue',
                            'bg-purple-50 text-purple-500 border-purple-100': selectedPackage?.color === 'purple',
                            'bg-indigo-50 text-indigo-500 border-indigo-100': selectedPackage?.color === 'indigo',
                            'bg-teal-50 text-teal-600 border-teal-100': selectedPackage?.color === 'teal',
                            'bg-rose-50 text-rose-500 border-rose-100': selectedPackage?.color === 'rose',
                            'bg-emerald-50 text-emerald-600 border-emerald-100': selectedPackage?.color === 'emerald'
                        }" x-text="selectedPackage?.sessions + ' Sesi'"></span>
                </div>
            </div>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto px-8 py-6 space-y-6 pb-32 no-scrollbar bg-slate-50/30">
                <!-- Visual Card -->
                <div class="flex items-center justify-between bg-white rounded-[32px] p-5 border border-slate-100 shadow-sm animate-fade-in">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl border flex-shrink-0"
                            :class="{
                                'bg-orange-50 text-orange-500 border-orange-100': selectedPackage?.color === 'orange',
                                'bg-blue-50 text-blue-500 border-blue-100': selectedPackage?.color === 'blue',
                                'bg-purple-50 text-purple-500 border-purple-100': selectedPackage?.color === 'purple',
                                'bg-indigo-50 text-indigo-500 border-indigo-100': selectedPackage?.color === 'indigo',
                                'bg-teal-50 text-teal-600 border-teal-100': selectedPackage?.color === 'teal',
                                'bg-rose-50 text-rose-500 border-rose-100': selectedPackage?.color === 'rose',
                                'bg-emerald-50 text-emerald-600 border-emerald-100': selectedPackage?.color === 'emerald'
                            }">
                            <i class="fa-solid" :class="selectedPackage?.icon"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Paket</p>
                            <h5 class="text-sm font-black text-slate-800 leading-none" x-text="selectedPackage?.name"></h5>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="rounded-xl px-3 py-1.5 shadow-lg text-white transition-all duration-500"
                            :class="{
                                'bg-orange-500 shadow-orange-100': selectedPackage?.color === 'orange',
                                'bg-blue-500 shadow-blue-100': selectedPackage?.color === 'blue',
                                'bg-purple-500 shadow-purple-100': selectedPackage?.color === 'purple',
                                'bg-indigo-600 shadow-indigo-100': selectedPackage?.color === 'indigo',
                                'bg-teal-600 shadow-teal-100': selectedPackage?.color === 'teal',
                                'bg-rose-500 shadow-rose-100': selectedPackage?.color === 'rose',
                                'bg-emerald-600 shadow-emerald-100': selectedPackage?.color === 'emerald'
                            }">
                            <p class="text-[8px] font-black uppercase opacity-70">Harga</p>
                            <p class="text-xs font-black leading-none" x-text="selectedPackage?.price"></p>
                        </div>
                    </div>
                </div>

                <!-- Session Breakdown (For Combined Packages) -->
                <template x-if="selectedPackage?.type === 'gabungan' && selectedPackage?.breakdown">
                    <div class="bg-white rounded-[32px] p-6 border border-slate-100 shadow-sm animate-slide-up">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest text-center mb-4">Rincian Sesi</p>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-orange-50/50 p-4 rounded-[24px] text-center border border-orange-100">
                                <p class="text-2xl font-black text-slate-800" x-text="selectedPackage.breakdown.perilaku"></p>
                                <p class="text-[9px] font-bold text-orange-600 uppercase">Perilaku</p>
                            </div>
                            <div class="bg-blue-50/50 p-4 rounded-[24px] text-center border border-blue-100">
                                <p class="text-2xl font-black text-slate-800" x-text="selectedPackage.breakdown.fisioterapi"></p>
                                <p class="text-[9px] font-bold text-blue-600 uppercase">Fisioterapi</p>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Information Points -->
                <div class="space-y-4">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-2">Keterangan Layanan</h4>
                    <div class="grid gap-4">
                        <template x-for="point in (selectedPackage?.description || '').split(/[.\n]/).filter(p => p.trim().length > 5)">
                            <div class="flex items-start space-x-4 bg-white p-5 rounded-[28px] border border-slate-100 shadow-sm animate-slide-up">
                                <div class="w-7 h-7 rounded-lg bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <i class="fas fa-check text-[10px]"></i>
                                </div>
                                <p class="text-[13px] text-slate-600 font-medium leading-relaxed" x-text="point.trim() + '.'"></p>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="h-20"></div>
            </div>
        </div>
    </div>

    <div class="h-10"></div>
</div>
