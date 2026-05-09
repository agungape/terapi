@extends('mobile.master')
@section('mobileDashboard', 'active')

@section('style')
<style>
    @keyframes slide-up {
        0% { transform: translateY(20px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
    @keyframes wiggle {
        0%, 100% { transform: rotate(-3deg); }
        50% { transform: rotate(3deg); }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    .animate-slide-up { animation: slide-up 0.5s ease-out forwards; }
    .animate-wiggle { animation: wiggle 0.5s ease-in-out infinite; }
    .animate-float { animation: float 2s ease-in-out infinite; }
</style>
@endsection

@section('content')
<div x-data="dashboardData()">
    <!-- Container for Desktop centering -->
    <div class="max-w-lg mx-auto bg-white min-h-screen shadow-xl sm:rounded-3xl overflow-hidden mb-20">
        
        <!-- Header -->
        <div class="bg-white border-b border-slate-100 px-4 py-3 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-600 hover:bg-slate-100 transition-colors">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full overflow-hidden">
                        <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/foto-anak/avatar.png') }}" alt="avatar" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <span class="text-xs text-slate-500 block">Halo,</span>
                        <span class="text-sm font-semibold text-slate-800 block truncate max-w-[150px]">{{ $anak->nama }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <!-- Notification or other icons -->
            </div>
        </div>

        <!-- Main Content -->
        <div class="p-4 space-y-6">
            <!-- Fun Header -->
            <div class="text-center mb-4 animate-slide-up">
                <h2 class="text-xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent flex items-center justify-center gap-2">
                    <i data-lucide="smile" class="w-6 h-6 text-yellow-500 animate-bounce"></i>
                    <span>Dashboard Ceria!</span>
                    <i data-lucide="star" class="w-6 h-6 text-yellow-500 animate-wiggle"></i>
                </h2>
                <p class="text-xs text-slate-500 mt-1">Selamat datang kembali!</p>
            </div>

            <!-- Profile Card (Fun Style) -->
            <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-[25px] p-6 text-white shadow-lg shadow-purple-200 animate-slide-up">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-2xl font-bold mb-1">{{ $anak->nama }}</h2>
                        <div class="flex items-center gap-2 text-purple-100 text-sm">
                            <span>{{ $anak->usia }} Tahun</span>
                            <span>•</span>
                            <span class="truncate max-w-[150px]">{{ $anak->alamat }}</span>
                        </div>
                    </div>
                    <div class="w-16 h-16 rounded-2xl overflow-hidden border-2 border-white/50 shadow-md flex-shrink-0">
                        <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/foto-anak/default.png') }}" alt="avatar" class="w-full h-full object-cover">
                    </div>
                </div>
                
                <div class="mt-6 grid grid-cols-2 gap-4 bg-white/10 rounded-2xl p-4 backdrop-blur-sm">
                    <div>
                        <span class="text-xs text-purple-100 block">Status</span>
                        <span class="text-sm font-semibold block">Aktif</span>
                    </div>
                    <div>
                        <span class="text-xs text-purple-100 block">Program</span>
                        <span class="text-sm font-semibold block">Terapi</span>
                    </div>
                </div>
            </div>

            <!-- Riwayat Terapi -->
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-bold text-slate-800">Riwayat Terapi</h3>
                    <a href="{{ route('mobile.kunjungan') }}" class="text-sm text-purple-600 font-semibold">Lihat Semua</a>
                </div>
                
                <div class="space-y-3">
                    @forelse ($kunjungan as $k)
                        <div class="bg-white rounded-2xl p-4 border border-slate-100 hover:border-purple-100 transition-colors flex items-center gap-4 cursor-pointer" @click="window.location.href = '{{ route('kunjunganmobile.detail', ['id' => $k->id]) }}'">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0">
                                @if ($k->status == 'hadir')
                                    <img src="{{ $k->terapis->foto ? asset('storage/terapis/' . $k->terapis->foto) : asset('assets/mobile/pixio/images/terapis-default.png') }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('assets/mobile/pixio/images/terapis-default.png') }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-slate-800 truncate">{{ $k->created_at->translatedFormat('d M Y') }}</h4>
                                <p class="text-xs text-slate-500 truncate">Pertemuan {{ $k->pertemuan }}</p>
                            </div>
                            <div>
                                @if ($k->status == 'hadir')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Hadir</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">{{ $k->status }}</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="bg-slate-50 rounded-2xl p-6 text-center text-slate-500">
                            <i data-lucide="clipboard-x" class="w-10 h-10 mx-auto mb-2 text-slate-400"></i>
                            <p>Belum ada riwayat terapi</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Paket Terapi -->
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-bold text-slate-800">Paket Terapi</h3>
                </div>
                
                <div class="flex overflow-x-auto gap-4 pb-4 snap-x -mx-4 px-4">
                    @foreach ($tarif as $t)
                        <div class="flex-shrink-0 w-64 bg-white rounded-2xl border border-slate-100 overflow-hidden snap-start hover:border-purple-100 transition-colors">
                            <div class="h-32 bg-slate-100 overflow-hidden">
                                <img src="{{ $t->gambar ? asset('storage/tarif/' . $t->gambar) : asset('assets/mobile/pixio/images/fisioterapi.png') }}" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4">
                                <h4 class="font-semibold text-slate-800 mb-1 truncate">{{ $t->nama }}</h4>
                                <p class="text-sm text-purple-600 font-bold mb-3">Rp {{ number_format($t->tarif, 0, ',', '.') }}</p>
                                <button @click="openModal({
                                    name: '{{ $t->nama }}',
                                    description: {!! json_encode($t->deskripsi) !!},
                                    tarif: '{{ number_format($t->tarif, 0, ',', '.') }}',
                                    image: '{{ $t->gambar ? asset('storage/tarif/' . $t->gambar) : asset('assets/mobile/pixio/images/fisioterapi.png') }}'
                                })" class="w-full bg-purple-50 text-purple-600 hover:bg-purple-100 text-sm font-semibold py-2.5 rounded-xl transition-colors">Detail Paket</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Terapis -->
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-bold text-slate-800">Terapis</h3>
                </div>
                
                <div class="flex overflow-x-auto gap-4 pb-4 snap-x -mx-4 px-4">
                    @foreach ($terapis as $t)
                        <div class="flex-shrink-0 w-40 bg-white rounded-2xl border border-slate-100 p-4 text-center snap-start hover:border-purple-100 transition-colors">
                            <div class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-3 border-2 border-slate-50">
                                <img src="{{ $t->foto ? asset('storage/terapis/' . $t->foto) : asset('assets/mobile/pixio/images/terapis-default.png') }}" class="w-full h-full object-cover">
                            </div>
                            <h4 class="font-semibold text-slate-800 truncate">{{ $t->nama }}</h4>
                            <p class="text-xs text-slate-500 truncate">{{ $t->role }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Package Detail Modal -->
        <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Backdrop -->
                <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" aria-hidden="true" @click="modalOpen = false">
                    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"></div>
                </div>

                <!-- Modal Content -->
                <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-t-3xl sm:rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full w-full">
                    <div class="relative h-48 bg-slate-100">
                        <img :src="selectedPackage.image" class="w-full h-full object-cover">
                        <button @click="modalOpen = false" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center text-slate-600 hover:bg-white transition-colors">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-800 mb-1" x-text="selectedPackage.name"></h3>
                        <p class="text-lg text-purple-600 font-bold mb-4" x-text="'Rp ' + selectedPackage.tarif"></p>
                        
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-semibold text-slate-700 mb-1">Deskripsi</h4>
                                <div class="text-sm text-slate-600 text-justify" x-html="selectedPackage.description.replace(/\n/g, '<br>')"></div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-6 py-4 flex flex-row-reverse">
                        <button type="button" @click="modalOpen = false" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2.5 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:text-sm transition-colors">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function dashboardData() {
        return {
            modalOpen: false,
            selectedPackage: {
                name: '',
                description: '',
                tarif: '',
                image: ''
            },
            openModal(pkg) {
                this.selectedPackage = pkg;
                this.modalOpen = true;
            }
        }
    }

    document.addEventListener('alpine:initialized', () => {
        lucide.createIcons();
    });
</script>
@endsection
