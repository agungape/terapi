<div class="space-y-6" x-show="!isLoading">
    <!-- Total Balance -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-[35px] border border-blue-100 shadow-sm animate-fade-in">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h4 class="font-bold text-gray-800 text-lg">Total Tagihan</h4>
                <p class="text-[11px] text-gray-500">Bulan Ini</p>
            </div>
            <div class="text-right">
                <p class="text-2xl font-black text-indigo-600" x-text="'Rp ' + number_format(invoices.filter(i => i.status === 'Pending').reduce((acc, i) => acc + parseInt(i.amount.replace(/[^0-9]/g, '')), 0), 0, ',', '.')"></p>
                <p class="text-[10px] text-gray-500" x-text="tagihanCount + ' tagihan tertunda'"></p>
            </div>
        </div>
        <button @click="showToast('Bayar semua tagihan', 'success')"
            class="w-full bg-indigo-600 text-white py-3.5 rounded-2xl font-bold hover:bg-indigo-700 transition-colors shadow-md shadow-indigo-100 active:scale-95 transition-all">
            <i class="fa-solid fa-credit-card mr-2"></i>Bayar Sekarang
        </button>
    </div>

    <!-- Invoice List -->
    <div>
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-receipt mr-2 text-gray-500"></i>
            Riwayat Tagihan
        </h4>

        <div class="space-y-4">
            <template x-for="(invoice, index) in invoices" :key="invoice.id">
                <div class="kid-card p-6 shadow-sm hover-lift animate-slide-up bg-white rounded-[30px] border border-slate-50 relative overflow-hidden"
                    :style="`animation-delay: ${index * 0.1}s`">
                    
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h5 class="font-bold text-gray-800 tracking-tight" x-text="invoice.id"></h5>
                            <p class="text-sm text-gray-600 font-medium" x-text="invoice.description"></p>
                            <template x-if="invoice.status === 'Paid'">
                                <div class="flex items-center mt-1.5">
                                    <span class="text-[9px] font-bold bg-emerald-50 text-emerald-600 px-2.5 py-0.5 rounded-full flex items-center">
                                        <i class="fa-solid fa-circle-check mr-1 text-[8px]"></i>Kwitansi Digital
                                    </span>
                                </div>
                            </template>
                        </div>
                        <span class="status-badge" :class="{
                            'status-paid': invoice.status === 'Paid',
                            'status-pending': invoice.status === 'Pending',
                            'status-upcoming': invoice.status === 'Upcoming'
                        }" x-text="invoice.status">
                        </span>
                    </div>

                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <p class="text-xs font-bold text-gray-400">Tanggal</p>
                            <p class="text-sm font-semibold text-slate-700" x-text="invoice.date"></p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-bold text-gray-400">Jumlah</p>
                            <p class="text-lg font-black text-indigo-600" x-text="invoice.amount"></p>
                        </div>
                    </div>

                    <div class="flex space-x-3">
                        <button @click="payInvoice(invoice.id)"
                            x-show="invoice.status === 'Pending' || invoice.status === 'Upcoming'"
                            class="flex-1 bg-green-600 text-white py-3 rounded-xl text-sm font-bold hover:bg-green-700 transition-colors">
                            <i class="fa-solid fa-credit-card mr-2"></i>Bayar
                        </button>
                        <button @click="invoice.file_url ? (showPdfViewer = true, $nextTick(() => $dispatch('open-pdf', { url: invoice.file_url, title: 'Kwitansi Pembayaran' }))) : showToast('Unduh invoice ' + invoice.id, 'success')"
                            class="flex-1 bg-white border border-indigo-600 text-indigo-600 py-3 rounded-xl text-sm font-bold hover:bg-indigo-50 transition-colors active:scale-95 transition-all">
                            <i class="fa-solid mr-2" :class="invoice.file_url ? 'fa-file-invoice text-indigo-600' : 'fa-download'"></i>
                            <span x-text="invoice.file_url ? 'Lihat Kwitansi' : 'Unduh'"></span>
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Billing Support & Policy -->
    @php
        $whatsappUrl = 'https://wa.me/6281234567890'; // Default fallback
        if (isset($profile) && $profile->telepon) {
            $phone = preg_replace('/[^0-9]/', '', $profile->telepon);
            if (str_starts_with($phone, '0')) {
                $phone = '62' . substr($phone, 1);
            } elseif (str_starts_with($phone, '8')) {
                $phone = '62' . $phone;
            }
            
            // Template pesan WhatsApp dengan nama anak dinamis
            $childName = isset($anak) ? $anak->nama : 'anak saya';
            $message = "Halo Admin Keuangan Bright Star, saya orang tua dari *" . $childName . "*. Saya ingin melakukan konfirmasi/bertanya terkait tagihan dan pembayaran terapi anak saya. Terima kasih.";
            
            $whatsappUrl = 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
        }
    @endphp
    <div class="bg-gradient-to-r from-indigo-50/50 to-purple-50/50 p-6 rounded-[35px] border border-indigo-100 shadow-sm animate-fade-in">
        <h4 class="font-bold text-indigo-900 mb-3 flex items-center">
            <i class="fa-solid fa-circle-info mr-2 text-indigo-500"></i>
            Informasi Pembayaran
        </h4>
        <ul class="space-y-2.5 text-xs text-slate-600 leading-relaxed mb-5 pl-1">
            <li class="flex items-start">
                <i class="fa-solid fa-circle text-[6px] text-indigo-500 mt-2 mr-2 flex-shrink-0"></i>
                <span>Pembayaran paket terapi dilakukan di awal sebelum sesi terapi berjalan.</span>
            </li>
            <li class="flex items-start">
                <i class="fa-solid fa-circle text-[6px] text-indigo-500 mt-2 mr-2 flex-shrink-0"></i>
                <span>Kwitansi resmi diterbitkan secara otomatis setelah pembayaran diverifikasi oleh Admin.</span>
            </li>
            <li class="flex items-start">
                <i class="fa-solid fa-circle text-[6px] text-indigo-500 mt-2 mr-2 flex-shrink-0"></i>
                <span>Untuk konfirmasi pelunasan tagihan manual atau deposit, silakan hubungi admin keuangan.</span>
            </li>
        </ul>
        <a href="{{ $whatsappUrl }}" target="_blank"
           class="w-full bg-white border border-indigo-200 hover:border-indigo-400 text-indigo-600 py-3.5 rounded-2xl font-bold flex items-center justify-center transition-all active:scale-95 shadow-sm text-sm">
            <i class="fa-brands fa-whatsapp text-emerald-500 text-lg mr-2 animate-pulse"></i>Hubungi Admin Keuangan
        </a>
    </div>
</div>
