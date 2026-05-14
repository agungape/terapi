<div class="space-y-6" x-show="!isLoading">
    <!-- Total Balance -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-[35px] border border-blue-100">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h4 class="font-bold text-gray-800">Total Tagihan</h4>
                <p class="text-[11px] text-gray-500">Bulan Ini</p>
            </div>
            <div class="text-right">
                <p class="text-2xl font-black text-indigo-600" x-text="'Rp ' + number_format(invoices.filter(i => i.status === 'Pending').reduce((acc, i) => acc + parseInt(i.amount.replace(/[^0-9]/g, '')), 0), 0, ',', '.')"></p>
                <p class="text-[10px] text-gray-500" x-text="tagihanCount + ' tagihan tertunda'"></p>
            </div>
        </div>
        <button @click="showToast('Bayar semua tagihan', 'success')"
            class="w-full bg-indigo-600 text-white py-3 rounded-2xl font-bold hover:bg-indigo-700 transition-colors">
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
                <div class="kid-card p-6 shadow-sm hover-lift animate-slide-up"
                    :style="`animation-delay: ${index * 0.1}s`">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h5 class="font-bold text-gray-800" x-text="invoice.id"></h5>
                            <p class="text-sm text-gray-600" x-text="invoice.description"></p>
                            <p class="text-[10px] text-gray-400 mt-1"
                                x-text="'Jatuh tempo: ' + invoice.dueDate"></p>
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
                            <p class="text-sm font-semibold" x-text="invoice.date"></p>
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
                        <button @click="showToast('Unduh invoice ' + invoice.id, 'success')"
                            class="flex-1 bg-white border border-indigo-600 text-indigo-600 py-3 rounded-xl text-sm font-bold hover:bg-indigo-50 transition-colors">
                            <i class="fa-solid fa-download mr-2"></i>Unduh
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Payment Methods -->
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 rounded-[35px] border border-gray-200">
        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
            <i class="fa-solid fa-wallet mr-2 text-gray-500"></i>
            Metode Pembayaran
        </h4>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-white rounded-2xl">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                        <i class="fa-solid fa-credit-card text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-bold text-sm">BCA Virtual Account</p>
                        <p class="text-[10px] text-gray-500">***1234</p>
                    </div>
                </div>
                <span class="text-green-500 text-sm font-bold">
                    <i class="fa-solid fa-check-circle"></i>
                </span>
            </div>
            <div class="flex items-center justify-between p-3 bg-white rounded-2xl">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                        <i class="fa-solid fa-qrcode text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-bold text-sm">QRIS</p>
                        <p class="text-[10px] text-gray-500">Semua e-wallet</p>
                    </div>
                </div>
                <button @click="showToast('Pilih metode pembayaran', 'success')"
                    class="text-gray-300 hover:text-indigo-500">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
