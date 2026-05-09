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
        <span class="font-bold text-slate-800">Detail Paket</span>
        <div class="w-10"></div> <!-- Spacer -->
    </div>

    <!-- Main Content -->
    <div class="p-4 space-y-6">
        <!-- Package Card (Fun Style) -->
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-[25px] border-2 border-purple-200 animate-slide-up text-center">
            <div class="w-20 h-20 mx-auto mb-4 bg-white rounded-2xl flex items-center justify-center text-purple-600 shadow-sm border border-purple-100">
                <i data-lucide="package" class="w-10 h-10"></i>
            </div>
            
            <h3 class="text-xl font-bold text-slate-800">Paket Terapi Hebat</h3>
            <p class="text-xs text-slate-500 mt-1">Pilihan terbaik untuk tumbuh kembang optimal.</p>
            
            <div class="mt-4 text-2xl font-black text-purple-600">
                Rp 1.500.000 <span class="text-xs text-slate-400 font-normal">/ 10 Sesi</span>
            </div>
        </div>

        <!-- Benefits -->
        <div>
            <h4 class="font-bold text-slate-800 mb-3 flex items-center text-sm">
                <i data-lucide="check-circle" class="w-4 h-4 mr-2 text-purple-500"></i>
                Apa yang Didapat?
            </h4>
            
            <div class="space-y-2">
                <div class="bg-white p-3 rounded-xl border border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center text-green-600 flex-shrink-0">
                        <i data-lucide="check" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm text-slate-700">10 Sesi Terapi Perilaku / Fisioterapi</span>
                </div>
                
                <div class="bg-white p-3 rounded-xl border border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center text-green-600 flex-shrink-0">
                        <i data-lucide="check" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm text-slate-700">Laporan Perkembangan Berkala</span>
                </div>
                
                <div class="bg-white p-3 rounded-xl border border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center text-green-600 flex-shrink-0">
                        <i data-lucide="check" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm text-slate-700">Konsultasi dengan Psikolog</span>
                </div>
                
                <div class="bg-white p-3 rounded-xl border border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center text-green-600 flex-shrink-0">
                        <i data-lucide="check" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm text-slate-700">Akses E-Book Terapi</span>
                </div>
            </div>
        </div>

        <!-- Action Button -->
        <div class="pt-4">
            <a href="https://wa.me/+6285123238404" target="_blank" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-3 rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-300 shadow-lg shadow-purple-100 flex items-center justify-center gap-2">
                <i data-lucide="message-circle" class="w-5 h-5"></i>
                Hubungi Admin untuk Beli
            </a>
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
