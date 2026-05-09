@extends('mobile.master')
@section('mobileTerapi', 'active')

@section('style')
<style>
    @keyframes slide-up {
        0% { transform: translateY(20px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
    .animate-slide-up { animation: slide-up 0.5s ease-out forwards; }
</style>
@endsection

@section('content')
<!-- Container for Desktop centering -->
<div class="max-w-lg mx-auto bg-white min-h-screen shadow-xl sm:rounded-3xl overflow-hidden mb-20">
    
    <!-- Header -->
    <div class="bg-white border-b border-slate-100 px-4 py-3 flex items-center justify-between sticky top-0 z-30">
        <button @click="window.history.back()" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-600 hover:bg-slate-100 transition-colors">
            <i data-lucide="chevron-left" class="w-5 h-5"></i>
        </button>
        <span class="font-bold text-slate-800">Detail Terapi</span>
        <div class="w-10"></div> <!-- Spacer -->
    </div>

    <!-- Main Content -->
    <div class="p-4 space-y-6">
        <!-- Child Info Card (Fun Style) -->
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 md:p-6 rounded-[25px] border-2 border-purple-200 animate-slide-up flex items-center gap-4">
            <div class="w-16 h-16 rounded-2xl overflow-hidden border-2 border-white shadow-md flex-shrink-0">
                <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/foto-anak/avatar.png') }}" alt="avatar" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-lg font-bold text-slate-800 truncate">{{ $anak->nama }}</h3>
                <div class="grid grid-cols-2 gap-x-2 gap-y-1 text-xs text-slate-500 mt-1">
                    <div>
                        <span class="font-semibold text-slate-400">Sesi:</span>
                        <span class="text-purple-600 font-bold">{{ $kunjungan->sesi }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-slate-400">Pertemuan:</span>
                        <span class="text-purple-600 font-bold">{{ $kunjungan->pertemuan }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-slate-400">Status:</span>
                        <span class="text-green-600 font-bold">{{ $kunjungan->status }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-slate-400">Waktu:</span>
                        <span class="text-slate-600">{{ \Carbon\Carbon::parse($kunjungan->created_at)->translatedFormat('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Therapist Info -->
        <div class="bg-white p-4 rounded-2xl border border-slate-100 flex items-center gap-3">
            <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600">
                <i data-lucide="user" class="w-5 h-5"></i>
            </div>
            <div>
                <span class="text-[10px] text-slate-400 font-bold uppercase">Terapis</span>
                <p class="text-sm font-bold text-slate-800">
                    {{ $kunjungan->terapis->nama }}
                    @if ($kunjungan->terapis_id_pendamping)
                        <span class="text-slate-400 font-normal"> & {{ $kunjungan->terapisPendamping->nama }}</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Programs Section -->
        <div>
            <h4 class="font-bold text-slate-800 mb-3 flex items-center text-sm">
                <i data-lucide="book-open" class="w-4 h-4 mr-2 text-purple-500"></i>
                @if ($kunjungan->jenis_terapi == 'terapi_perilaku')
                    Program Terapi Perilaku
                @else
                    Program Fisioterapi & SI
                @endif
            </h4>
            
            <div class="space-y-3">
                @if ($kunjungan->jenis_terapi == 'terapi_perilaku')
                    @forelse ($pemeriksaan as $p)
                        <div class="bg-white p-4 rounded-2xl border border-slate-100 space-y-2">
                            <div class="flex justify-between items-start">
                                <span class="w-6 h-6 bg-purple-100 text-purple-700 rounded-full flex items-center justify-center text-xs font-bold">{{ $loop->iteration }}</span>
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full 
                                    @if($p->status == 'dp') bg-red-50 text-red-700 border border-red-200
                                    @elseif($p->status == 'ds') bg-yellow-50 text-yellow-700 border border-yellow-200
                                    @elseif($p->status == 'tb') bg-green-50 text-green-700 border border-green-200
                                    @else bg-slate-50 text-slate-700 border border-slate-200
                                    @endif">
                                    @if ($p->status == 'dp') Dibantu Penuh
                                    @elseif ($p->status == 'ds') Dibantu Sebagian
                                    @elseif ($p->status == 'tb') Tidak Dibantu
                                    @else Status Unknown
                                    @endif
                                </span>
                            </div>
                            
                            <p class="text-sm text-slate-800 font-semibold">{{ $p->program->deskripsi }}</p>
                            
                            @if ($loop->last && $p->keterangan)
                                <div class="mt-3 pt-3 border-t border-slate-50">
                                    <p class="text-xs text-slate-400 font-bold mb-1">Keterangan:</p>
                                    <div class="text-xs text-slate-600 text-justify">
                                        {!! nl2br(e($p->keterangan)) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="bg-slate-50 rounded-2xl p-6 text-center text-slate-500">
                            <p class="text-sm">Data program terapi tidak ada</p>
                        </div>
                    @endforelse
                @else
                    @forelse ($fisioterapi as $f)
                        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden" x-data="{ open: false }">
                            <button @click="open = !open" class="w-full px-4 py-3 flex items-center justify-between text-left">
                                <span class="text-sm font-semibold text-slate-800">{{ $f->program->deskripsi }}</span>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transform transition-transform" :class="{'rotate-180': open}"></i>
                            </button>
                            
                            <div x-show="open" x-transition class="px-4 pb-4 pt-1 bg-slate-50 text-xs text-slate-600 text-justify">
                                {!! nl2br(e($f->aktivitas_terapi)) !!}
                            </div>
                        </div>
                        
                        @if ($loop->last)
                            @if ($f->evaluasi)
                                <div class="bg-white p-4 rounded-2xl border border-slate-100 mt-3">
                                    <h6 class="text-sm font-bold text-slate-800 mb-2">Respons Anak:</h6>
                                    <div class="text-xs text-slate-600 text-justify">
                                        {!! nl2br(e($f->evaluasi)) !!}
                                    </div>
                                </div>
                            @endif
                            
                            @if ($f->catatan_khusus)
                                <div class="bg-white p-4 rounded-2xl border border-slate-100 mt-3">
                                    <h6 class="text-sm font-bold text-slate-800 mb-2">Catatan Khusus:</h6>
                                    <div class="text-xs text-slate-600 text-justify">
                                        {!! nl2br(e($f->catatan_khusus)) !!}
                                    </div>
                                </div>
                            @endif
                        @endif
                    @empty
                        <div class="bg-slate-50 rounded-2xl p-6 text-center text-slate-500">
                            <p class="text-sm">Data program fisioterapi tidak ada</p>
                        </div>
                    @endforelse
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('alpine:initialized', () => {
        lucide.createIcons();
    });
</script>
@endsection
