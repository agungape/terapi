@extends('mobile.master')
@section('mobilePayment', 'active')

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
        <span class="font-bold text-slate-800">Pembayaran</span>
        <div class="w-10"></div> <!-- Spacer -->
    </div>

    <!-- Main Content -->
    <div class="p-4 space-y-6">
        <!-- Notification Card (Fun Style) -->
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 md:p-6 rounded-[25px] border-2 border-purple-200 animate-slide-up">
            <h4 class="font-bold text-slate-800 mb-2 flex items-center text-sm">
                <i data-lucide="megaphone" class="w-4 h-4 mr-2 text-purple-500 animate-pulse"></i>
                Pemberitahuan Pembayaran
            </h4>
            <p class="text-xs text-slate-600 mb-4">Silakan lakukan pembayaran <strong>hanya</strong> ke rekening berikut:</p>

            <div class="space-y-3">
                <div class="bg-white p-3 rounded-xl border border-purple-100 flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600">
                        <i data-lucide="landmark" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Bank</span>
                        <p class="text-sm font-bold text-slate-800">BRI</p>
                    </div>
                </div>
                
                <div class="bg-white p-3 rounded-xl border border-purple-100 flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600">
                        <i data-lucide="credit-card" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Nomor Rekening</span>
                        <p class="text-sm font-bold text-slate-800">493001052151535</p>
                    </div>
                </div>
                
                <div class="bg-white p-3 rounded-xl border border-purple-100 flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600">
                        <i data-lucide="user" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 font-bold uppercase">Atas Nama</span>
                        <p class="text-sm font-bold text-slate-800">INNE PUSVITASARI</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Warning Card -->
        <div class="bg-red-50 border border-red-200 p-4 rounded-xl text-xs text-red-700">
            <p class="font-bold mb-1 flex items-center">
                <i data-lucide="alert-triangle" class="w-4 h-4 mr-1"></i>
                Penting!
            </p>
            <ul class="list-disc list-inside space-y-1">
                <li>Kami <strong>tidak bertanggung jawab</strong> atas pembayaran ke rekening selain yang tercantum di atas.</li>
                <li>Mohon <strong>pastikan nama penerima sesuai</strong> sebelum melakukan transfer.</li>
                <li>Simpan bukti pembayaran dan konfirmasikan kepada kami setelah transaksi selesai.</li>
            </ul>
        </div>

        <!-- Contact Info -->
        <div class="text-center text-sm text-slate-600">
            <p>Jika ada pertanyaan, hubungi admin:</p>
            <a href="https://wa.me/+6285123238404" target="_blank" class="inline-flex items-center gap-1 text-purple-600 font-bold hover:text-purple-700 transition-colors">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                085123238404
            </a>
        </div>

        <!-- Payment History -->
        <div>
            <h4 class="font-bold text-slate-800 mb-3 flex items-center text-sm">
                <i data-lucide="clock" class="w-4 h-4 mr-2 text-purple-500"></i>
                Riwayat Pembayaran
            </h4>
            
            <div class="space-y-3">
                @forelse ($pembayaran as $p)
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 hover:border-purple-100 transition-colors flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-600 flex-shrink-0">
                                <i data-lucide="receipt" class="w-6 h-6"></i>
                            </div>
                            <div class="min-w-0">
                                <h5 class="font-semibold text-slate-800 truncate">{{ $p->tarif->nama ?? 'Terapi Perilaku' }}</h5>
                                <p class="text-xs text-slate-500">{{ $p->tanggal }}</p>
                                <p class="text-sm font-bold text-purple-600">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex flex-col items-end gap-2">
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-50 text-green-700 border border-green-200">Diterima</span>
                            <a href="{{ route('invoice.download', $p->id) }}" class="text-xs text-purple-600 font-semibold hover:text-purple-700 transition-colors flex items-center gap-0.5">
                                <i data-lucide="download" class="w-3 h-3"></i>
                                Invoice
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-slate-50 rounded-2xl p-6 text-center text-slate-500">
                        <i data-lucide="receipt" class="w-10 h-10 mx-auto mb-2 text-slate-300"></i>
                        <p class="text-sm">Belum ada riwayat pembayaran</p>
                    </div>
                @endforelse
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
