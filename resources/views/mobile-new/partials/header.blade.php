<div :class="{
    'primary-purple': page === 'home' || page === 'buku_penghubung' || page === 'progres' || page === 'profil',
    'primary-rose': page === 'assessment_psikolog',
    'primary-teal': page === 'observasi',
    'primary-blue': page === 'daftar_terapis' || page === 'paket_terapi' || page === 'jadwal_terapi' || page === 'tagihan' || page === 'galeri',
    'primary-green': page === 'absensi',
    'primary-orange': page === 'buku_anak'
}" class="p-8 pb-20 rounded-b-[50px] text-white relative transition-all duration-500">

    <!-- Animated background elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden rounded-b-[50px]">
        <div class="absolute -top-20 -left-20 w-40 h-40 bg-white/10 rounded-full animate-float"></div>
        <div class="absolute top-10 -right-10 w-32 h-32 bg-white/5 rounded-full animate-float"
            style="animation-delay: 0.5s;"></div>
    </div>

    <template x-if="page === 'home'">
        <div class="flex justify-between items-center relative z-10 animate-slide-up">
            <div class="flex items-center space-x-4">
                <div class="relative group">
                    @php
                        $photoUrl = 'https://ui-avatars.com/api/?name=' . urlencode($anak->nama ?? 'Arkan') . '&background=fff&color=6366f1';
                        if (isset($anak->foto) && $anak->foto) {
                            $path = $anak->foto;
                            // Bersihkan awalan public/ atau storage/ jika ada di database
                            $path = preg_replace('/^(public\/|storage\/)/', '', $path);
                            
                            if (str_starts_with($path, 'http')) {
                                $photoUrl = $path;
                            } else {
                                $photoUrl = asset('storage/anak/' . $path);
                            }
                        }
                    @endphp
                    <img src="{{ $photoUrl }}"
                        class="w-14 h-14 rounded-2xl border-4 border-white/30 shadow-lg group-hover:scale-110 transition-transform duration-300 object-cover">
                    <div
                        class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-400 rounded-full border-2 border-white shadow-lg">
                    </div>
                </div>
                <div>
                    <p class="text-xs font-medium opacity-90">Halo Bunda {{ $anak->nama ?? 'Arkan' }}!</p>
                    <h1 class="text-xl font-bold">{{ $anak->nama ?? 'Arkan Putra' }}</h1>
                </div>
            </div>
            <button @click="markNotificationRead" class="relative group ripple">
                <div
                    class="bg-white/20 p-3 rounded-2xl group-hover:bg-white/30 transition-all duration-300 group-active:scale-90">
                    <i class="fa-regular fa-bell text-xl"></i>
                    <span x-show="notificationCount > 0" x-text="notificationCount"
                        class="absolute -top-1 -right-1 min-w-5 h-5 bg-yellow-400 text-indigo-900 text-xs font-bold rounded-full border-2 border-indigo-600 flex items-center justify-center animate-pulse-slow">
                    </span>
                </div>
            </button>
        </div>
    </template>

    <template x-if="page !== 'home' && page !== 'profil'">
        <div class="flex items-center space-x-4 relative z-10 animate-slide-up">
            <button @click="nav('home')"
                class="bg-white/20 p-3 rounded-2xl hover:bg-white/30 active:scale-90 transition-all duration-300 ripple">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <div class="flex-1">
                <h1 class="text-xl font-bold capitalize" x-text="page.replace(/_/g, ' ')"></h1>
                <p class="text-[10px] opacity-80 font-bold uppercase tracking-widest">Update Terbaru Arkan</p>
            </div>
            <button
                class="bg-white/20 p-3 rounded-2xl hover:bg-white/30 active:scale-90 transition-all duration-300">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
        </div>
    </template>

    <template x-if="page === 'home'">
        <div class="grid grid-cols-2 gap-4 mt-6 relative z-10 animate-slide-up" style="animation-delay: 0.1s;">
            <!-- Kehadiran Card -->
            <div class="bg-white/20 p-4 rounded-3xl border border-white/20 backdrop-blur-sm hover-lift group cursor-pointer h-[130px] flex flex-col justify-between"
                @click="nav('absensi')">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] uppercase font-bold opacity-80">Kehadiran</p>
                    <i class="fa-solid fa-arrow-right text-white/50 group-hover:translate-x-1 transition-transform text-xs"></i>
                </div>
                
                <div class="flex-1 flex flex-col justify-center mt-1">
                    @if($activePackages->count() === 1)
                        @php $p = $activePackages->first(); @endphp
                        <div>
                            <p class="text-2xl font-black">{{ $p->sudah_terpakai }} / {{ $p->tarif->jumlah_pertemuan ?? 20 }}</p>
                            <p class="text-[9px] font-bold opacity-70 truncate">{{ $p->tarif->nama ?? 'Paket' }}</p>
                        </div>
                        @php
                            $total = $p->tarif->jumlah_pertemuan ?? 20;
                            $percentage = $total > 0 ? round(($p->sudah_terpakai / $total) * 100) : 0;
                        @endphp
                        <div class="mt-1.5 w-full bg-white/30 rounded-full h-1.5">
                            <div class="bg-yellow-400 h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    @else
                        @forelse($activePackages as $p)
                            <div class="mb-1.5 last:mb-0">
                                <div class="flex justify-between items-center text-xs mb-0.5">
                                    <span class="font-bold opacity-70 truncate max-w-[65px]">{{ $p->tarif->nama ?? 'Paket' }}</span>
                                    <span class="font-black">{{ $p->sudah_terpakai }}/{{ $p->tarif->jumlah_pertemuan ?? 20 }}</span>
                                </div>
                                @php
                                    $total = $p->tarif->jumlah_pertemuan ?? 20;
                                    $percentage = $total > 0 ? round(($p->sudah_terpakai / $total) * 100) : 0;
                                @endphp
                                <div class="w-full bg-white/20 rounded-full h-0.5">
                                    <div class="bg-yellow-400 h-0.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm font-black">0 / 0</p>
                        @endforelse
                    @endif
                </div>
            </div>

            <!-- Sisa Paket Card -->
            <div class="bg-yellow-400 p-4 rounded-3xl text-indigo-900 shadow-xl hover-lift group cursor-pointer h-[130px] flex flex-col justify-between"
                @click="nav('paket_terapi')">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] uppercase font-bold opacity-70">Sisa Paket</p>
                    <i class="fa-solid fa-gem text-indigo-900/50 group-hover:rotate-12 transition-transform text-xs"></i>
                </div>
                
                <div class="flex-1 flex flex-col justify-center mt-1">
                    @if($activePackages->count() === 1)
                        @php $p = $activePackages->first(); @endphp
                        <div>
                            @if(is_array($p->sisa_pertemuan))
                                <p class="text-lg font-black">P: {{ $p->sisa_pertemuan['perilaku'] }} | F: {{ $p->sisa_pertemuan['fisioterapi'] }}</p>
                            @else
                                <p class="text-2xl font-black">{{ $p->sisa_pertemuan }} <span class="text-xs font-normal">Sesi</span></p>
                            @endif
                            <p class="text-[9px] font-bold opacity-70 truncate">{{ $p->tarif->nama ?? 'Paket' }}</p>
                        </div>
                    @else
                        @forelse($activePackages as $p)
                            <div class="flex justify-between items-center text-xs mb-1 last:mb-0">
                                <span class="font-bold opacity-70 truncate max-w-[65px]">{{ $p->tarif->nama ?? 'Paket' }}</span>
                                @if(is_array($p->sisa_pertemuan))
                                    <span class="font-black">P:{{ $p->sisa_pertemuan['perilaku'] }}|F:{{ $p->sisa_pertemuan['fisioterapi'] }}</span>
                                @else
                                    <span class="font-black">{{ $p->sisa_pertemuan }} Sesi</span>
                                @endif
                            </div>
                        @empty
                            <p class="text-sm font-black">0 Sesi</p>
                        @endforelse
                    @endif
                </div>
            </div>
        </div>
    </template>
</div>
