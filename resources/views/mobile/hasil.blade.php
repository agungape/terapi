@extends('mobile.master')
@section('mobileResult', 'active')

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
        <button @click="sidebarOpen = true" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-600 hover:bg-slate-100 transition-colors">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
        <span class="font-bold text-slate-800">Hasil Terapi</span>
        <div class="w-10"></div> <!-- Spacer -->
    </div>

    <!-- Main Content -->
    <div class="p-4 space-y-6" x-data="{ openTab: 1 }">
        <!-- Banner Video -->
        <div class="rounded-2xl overflow-hidden shadow-md">
            <video class="w-full" autoplay muted loop playsinline>
                <source src="{{ asset('assets/mobile/pixio/videos/banner/video4.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <!-- Fun Header -->
        <div class="text-center mb-4 animate-slide-up">
            <h2 class="text-xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent flex items-center justify-center gap-2">
                <i data-lucide="award" class="w-6 h-6 text-yellow-500"></i>
                <span>Hasil Hebatmu!</span>
                <i data-lucide="star" class="w-6 h-6 text-yellow-500 animate-wiggle"></i>
            </h2>
            <p class="text-xs text-slate-500 mt-1">Lihat perkembangan belajarmu!</p>
        </div>

        <!-- Custom Tabs/Accordions with Alpine -->
        <div class="space-y-4">
            <!-- Data Assessment -->
            <div class="border-2 border-purple-100 rounded-2xl overflow-hidden">
                <button @click="openTab = openTab === 1 ? 0 : 1" class="w-full px-4 py-3 bg-purple-50 flex items-center justify-between text-left">
                    <div class="flex items-center gap-2">
                        <i data-lucide="file-text" class="w-5 h-5 text-purple-600"></i>
                        <span class="font-bold text-slate-800 text-sm">Data Assessment</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-5 h-5 text-purple-600 transform transition-transform" :class="{'rotate-180': openTab === 1}"></i>
                </button>
                
                <div x-show="openTab === 1" x-transition class="p-4 bg-white space-y-3">
                    @forelse ($assessment as $a)
                        <div class="bg-white p-3 rounded-xl border border-purple-100 space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($a->tanggal_assessment)->translatedFormat('d F Y') }}</span>
                                @if ($a->persetujuan_psikolog == 1)
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-50 text-green-700 border border-green-200">Tervalidasi</span>
                                @endif
                            </div>
                            
                            <div>
                                <p class="text-xs text-slate-400">Psikolog</p>
                                <p class="text-sm font-bold text-slate-800">{{ $a->psikolog->nama }}</p>
                            </div>
                            
                            @if ($a->persetujuan_psikolog == 1)
                                <div class="pt-2 border-t border-purple-50 flex justify-between items-center">
                                    <span class="text-xs text-slate-500">Berkas Hasil:</span>
                                    <a href="{{ route('assessment.cetak', ['assessment' => $a->id]) }}" class="text-xs text-purple-600 font-bold hover:text-purple-700 transition-colors flex items-center gap-1" target="_blank">
                                        <i data-lucide="download" class="w-4 h-4"></i>
                                        assessment.pdf
                                    </a>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center text-slate-500 py-4">
                            <i data-lucide="smile" class="w-10 h-10 mx-auto mb-2 text-slate-300"></i>
                            <p class="text-sm">Data assessment belum ada</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Data Observasi -->
            <div class="border-2 border-purple-100 rounded-2xl overflow-hidden">
                <button @click="openTab = openTab === 2 ? 0 : 2" class="w-full px-4 py-3 bg-purple-50 flex items-center justify-between text-left">
                    <div class="flex items-center gap-2">
                        <i data-lucide="eye" class="w-5 h-5 text-purple-600"></i>
                        <span class="font-bold text-slate-800 text-sm">Data Observasi</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-5 h-5 text-purple-600 transform transition-transform" :class="{'rotate-180': openTab === 2}"></i>
                </button>
                
                <div x-show="openTab === 2" x-transition class="p-4 bg-white">
                    <div class="text-center text-slate-500 py-4">
                        <i data-lucide="construction" class="w-10 h-10 mx-auto mb-2 text-slate-300"></i>
                        <p class="text-sm">Data observasi belum ada</p>
                        <p class="text-xs text-green-600 font-semibold mt-1">Sedang dalam pengembangan 🚀</p>
                    </div>
                </div>
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
