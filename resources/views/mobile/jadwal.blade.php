@extends('mobile.master')
@section('mobileJadwal', 'active')

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
        <span class="font-bold text-slate-800">Jadwal Terapi</span>
        <div class="w-10"></div> <!-- Spacer -->
    </div>

    <!-- Main Content -->
    <div class="p-4 space-y-6">
        <!-- Fun Header -->
        <div class="text-center mb-4 animate-slide-up">
            <h2 class="text-xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent flex items-center justify-center gap-2">
                <i data-lucide="calendar" class="w-6 h-6 text-yellow-500"></i>
                <span>Jadwal Seru!</span>
                <i data-lucide="star" class="w-6 h-6 text-yellow-500 animate-wiggle"></i>
            </h2>
            <p class="text-xs text-slate-500 mt-1">Jangan sampai terlambat ya!</p>
        </div>

        <!-- Weekly Schedule (Mockup) -->
        <div class="space-y-4">
            <!-- Day Card -->
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-2xl border-2 border-purple-200">
                <div class="flex justify-between items-center mb-3">
                    <h4 class="font-bold text-slate-800 flex items-center text-sm">
                        <i data-lucide="calendar-days" class="w-4 h-4 mr-2 text-purple-500"></i>
                        Senin
                    </h4>
                    <span class="text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full font-bold">2 Sesi</span>
                </div>
                
                <div class="space-y-2">
                    <div class="bg-white p-3 rounded-xl border border-purple-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600">
                                <i data-lucide="brain" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-800">Terapi Perilaku</p>
                                <p class="text-xs text-slate-500">08:00 - 09:00</p>
                            </div>
                        </div>
                        <span class="text-xs text-slate-400">Sesi 1</span>
                    </div>
                    
                    <div class="bg-white p-3 rounded-xl border border-purple-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-pink-50 rounded-lg flex items-center justify-center text-pink-600">
                                <i data-lucide="accessibility" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-800">Fisioterapi</p>
                                <p class="text-xs text-slate-500">09:00 - 10:00</p>
                            </div>
                        </div>
                        <span class="text-xs text-slate-400">Sesi 2</span>
                    </div>
                </div>
            </div>

            <!-- Day Card -->
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-2xl border-2 border-purple-200">
                <div class="flex justify-between items-center mb-3">
                    <h4 class="font-bold text-slate-800 flex items-center text-sm">
                        <i data-lucide="calendar-days" class="w-4 h-4 mr-2 text-purple-500"></i>
                        Rabu
                    </h4>
                    <span class="text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full font-bold">1 Sesi</span>
                </div>
                
                <div class="space-y-2">
                    <div class="bg-white p-3 rounded-xl border border-purple-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600">
                                <i data-lucide="brain" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-800">Terapi Perilaku</p>
                                <p class="text-xs text-slate-500">08:00 - 09:00</p>
                            </div>
                        </div>
                        <span class="text-xs text-slate-400">Sesi 1</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State / Info -->
        <div class="bg-slate-50 p-4 rounded-2xl text-center text-slate-500">
            <i data-lucide="smile" class="w-10 h-10 mx-auto mb-2 text-slate-400"></i>
            <p class="text-sm">Jadwal di atas adalah contoh.</p>
            <p class="text-xs text-slate-400">Hubungi admin untuk mengatur jadwal tetap Anda.</p>
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
