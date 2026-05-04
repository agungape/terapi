@extends('layouts.master')
@section('title', 'Pemasukkan Keuangan')

@section('content')
<div x-data="{ 
    modalOpen: false, 
    modalType: '',
    openModal(type) {
        this.modalType = type;
        this.modalOpen = true;
    },
    closeModal() {
        this.modalOpen = false;
    }
}" class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Top Bar / Breadcrumb -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Keuangan</span>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600 italic">Pemasukkan</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Data Pemasukkan Kas</h2>
        </div>
        
        @can('create pemasukkan')
        <div class="relative flex items-center gap-3" x-data="{ dropOpen: false }">
            <button @click="dropOpen = !dropOpen" class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
                <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Data
                <i data-lucide="chevron-down" class="w-3.5 h-3.5" :class="{'rotate-180': dropOpen}"></i>
            </button>
            <div x-show="dropOpen" @click.away="dropOpen = false" x-cloak x-transition
                 class="absolute right-0 top-full mt-2 w-56 bg-white rounded-2xl border border-slate-100 shadow-2xl z-50 overflow-hidden py-1">
                <button @click="dropOpen = false; openModal('pembayaran-anak')" class="w-full text-left px-5 py-3 hover:bg-slate-50 transition-colors flex items-center gap-3">
                    <i data-lucide="user-plus" class="w-4 h-4 text-emerald-500"></i>
                    <span class="text-xs font-bold text-slate-700">Pembayaran Anak</span>
                </button>
                <button @click="dropOpen = false; openModal('pemasukkan-lain')" class="w-full text-left px-5 py-3 hover:bg-slate-50 transition-colors flex items-center gap-3 border-t border-slate-50">
                    <i data-lucide="external-link" class="w-4 h-4 text-blue-500"></i>
                    <span class="text-xs font-bold text-slate-700">Pemasukkan Lain</span>
                </button>
            </div>
        </div>
        @endcan
    </div>

    <!-- Quick Stats Hub -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Saldo Kas -->
        <div class="card-premium p-6 border-l-4 border-l-blue-500 group">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Saldo Saat Ini</span>
                <div class="p-2 bg-blue-50 text-blue-600 rounded-lg group-hover:bg-blue-500 group-hover:text-white transition-all">
                    <i data-lucide="piggy-bank" class="w-4 h-4"></i>
                </div>
            </div>
            <h3 class="text-2xl font-black text-slate-800 tracking-tight italic">
                Rp {{ $saldoKas ? number_format((int)$saldoKas->getRawOriginal('saldo_awal'), 0, ',', '.') : '0' }}
            </h3>
            <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-tighter italic">Total Dana Tersedia</p>
        </div>

        <!-- Total Pemasukkan -->
        <div class="card-premium p-6 border-l-4 border-l-emerald-500 group">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Pemasukkan</span>
                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg group-hover:bg-emerald-500 group-hover:text-white transition-all">
                    <i data-lucide="trending-up" class="w-4 h-4"></i>
                </div>
            </div>
            <h3 class="text-2xl font-black text-emerald-700 tracking-tight italic">
                Rp {{ $formattedPemasukan ?: '0' }}
            </h3>
            <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-tighter italic">Akumulasi Pendapatan</p>
        </div>
    </div>

    <!-- Transaction Table -->
    <div class="card-premium overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between bg-white gap-4">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                <h3 class="text-xs font-black text-slate-800 uppercase tracking-[0.2em]">RIWAYAT PEMASUKKAN KAS</h3>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 bg-slate-50 text-slate-400 border border-slate-100 rounded-lg text-[9px] font-black uppercase tracking-widest italic">Real-time Sync</span>
            </div>
        </div>

        {{-- Desktop View --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-16">#</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Keterangan Transaksi</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Jumlah</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Saldo Kas</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($pemasukkans as $pemasukkan)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 text-xs font-bold text-slate-300 italic">{{ $pemasukkans->firstItem() + $loop->iteration - 1 }}</td>
                        <td class="px-6 py-4 text-xs font-black text-slate-700 whitespace-nowrap italic uppercase tracking-tighter">{{ $pemasukkan->tanggal_formatted }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-xs font-black text-slate-800 leading-tight uppercase tracking-tight">{{ $pemasukkan->deskripsi }}</span>
                                @if($pemasukkan->jenis_layanan === 'paket_terapi')
                                    <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest italic mt-0.5 flex items-center gap-1">
                                        <i data-lucide="package" class="w-2.5 h-2.5"></i> {{ $pemasukkan->tarif->nama ?? 'Paket Terapi' }}
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-slate-100 text-slate-500 border border-slate-200 rounded-lg text-[9px] font-black uppercase tracking-widest italic">
                                {{ $pemasukkan->kategori->nama }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                           <span class="text-xs font-black text-emerald-600 italic tracking-tight">{{ $pemasukkan->jumlah_formatted }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-xs font-bold text-slate-400 italic">{{ $pemasukkan->saldo_akhir_formatted }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                @if ($pemasukkan->gambar)
                                <button @click="openModal('bukti-transfer'); $nextTick(() => { document.getElementById('img-preview').src = '{{ asset('storage/bukti-transfer/' . $pemasukkan->gambar) }}' })"
                                        class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm border border-blue-100">
                                    <i data-lucide="image" class="w-3.5 h-3.5"></i>
                                </button>
                                @endif

                                <a href="{{ route('pemasukkan.kwitansi', $pemasukkan->id) }}" target="_blank"
                                   class="p-2 bg-slate-50 text-slate-600 rounded-xl hover:bg-slate-900 hover:text-white transition-all border border-slate-100 shadow-sm" title="Cetak Kwitansi">
                                    <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                                </a>

                                @if($pemasukkan->jenis_layanan === 'paket_terapi')
                                <button @click="openModal('log-pemakaian'); $nextTick(() => { fetchLogData('{{ $pemasukkan->id }}') })"
                                        class="p-2 bg-emerald-50 text-emerald-600 rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm border border-emerald-100">
                                    <i data-lucide="clipboard-list" class="w-3.5 h-3.5"></i>
                                </button>
                                @endif

                                @can('delete pemasukkan')
                                    @if ($pemasukkan->id == $dataTerakhir->id)
                                    <form action="{{ route('pemasukkan.destroy', ['pemasukkan' => $pemasukkan->id]) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="button" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus" data-name="{{ $pemasukkan->deskripsi }}">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                    @endif
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-6 py-24 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <i data-lucide="inbox" class="w-12 h-12 text-slate-200"></i>
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest italic tracking-widest">Tidak ada data transaksi ditemukan</p>
                        </div>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile View --}}
        <div class="md:hidden divide-y divide-slate-100">
            @forelse ($pemasukkans as $pemasukkan)
            <div class="p-5 space-y-4">
                <div class="flex justify-between items-start">
                    <div class="space-y-1">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $pemasukkan->tanggal_formatted }}</p>
                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-tight leading-tight">{{ $pemasukkan->deskripsi }}</h4>
                    </div>
                    <span class="text-sm font-black text-emerald-600 italic">{{ $pemasukkan->jumlah_formatted }}</span>
                </div>
                <div class="flex items-center justify-between pt-2">
                    <span class="px-2.5 py-1 bg-slate-50 text-slate-400 border border-slate-200 rounded-lg text-[8px] font-black uppercase tracking-widest">
                        {{ $pemasukkan->kategori->nama }}
                    </span>
                    <div class="flex items-center gap-2">
                        @if ($pemasukkan->gambar)
                        <button @click="openModal('bukti-transfer'); $nextTick(() => { document.getElementById('img-preview').src = '{{ asset('storage/bukti-transfer/' . $pemasukkan->gambar) }}' })"
                                class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-600 rounded-lg border border-blue-100">
                            <i data-lucide="image" class="w-3 h-3"></i>
                        </button>
                        @endif

                        <a href="{{ route('pemasukkan.kwitansi', $pemasukkan->id) }}" target="_blank"
                                class="w-8 h-8 flex items-center justify-center bg-slate-50 text-slate-600 rounded-lg border border-slate-100">
                            <i data-lucide="printer" class="w-3 h-3"></i>
                        </a>

                        @if($pemasukkan->jenis_layanan === 'paket_terapi')
                        <button @click="openModal('log-pemakaian'); $nextTick(() => { fetchLogData('{{ $pemasukkan->id }}') })"
                                class="w-8 h-8 flex items-center justify-center bg-emerald-50 text-emerald-600 rounded-lg border border-emerald-100">
                            <i data-lucide="clipboard-list" class="w-3 h-3"></i>
                        </button>
                        @endif
                        
                        @if($pemasukkan->id == $dataTerakhir->id)
                        <form action="{{ route('pemasukkan.destroy', $pemasukkan->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="button" class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-600 rounded-lg border border-red-100 btn-hapus" data-name="{{ $pemasukkan->deskripsi }}">
                                <i data-lucide="trash-2" class="w-3 h-3"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="p-12 text-center text-slate-300 text-[10px] font-black uppercase tracking-widest italic">Tidak ada data.</div>
            @endforelse
        </div>

        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-center">
            {{ $pemasukkans->fragment('judul')->links() }}
        </div>
    </div>

    {{-- Universal Modal Container --}}
    <div x-show="modalOpen" 
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="closeModal()"></div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl w-full relative z-10 border border-slate-100 flex flex-col max-h-[90vh] overflow-hidden"
             :class="modalType === 'bukti-transfer' ? 'max-w-xl' : 'max-w-2xl'"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            {{-- Modals for Forms --}}
            <template x-if="modalType === 'pembayaran-anak'">
                <form action="{{ route('pemasukkan.store') }}" method="POST" enctype="multipart/form-data" id="tarifForm" class="flex flex-col max-h-[90vh]">
                    @csrf
                    <div class="bg-emerald-600 text-white p-7 flex items-center justify-between shrink-0">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                                <i data-lucide="user-plus" class="text-white"></i>
                            </div>
                            <h5 class="text-sm font-black uppercase tracking-widest mb-0 italic">Registrasi Pembayaran Anak</h5>
                        </div>
                        <button type="button" @click="closeModal()" class="text-emerald-100 hover:text-white transition-colors"><i data-lucide="x" class="w-6 h-6"></i></button>
                    </div>

                    <div class="p-8 space-y-6 overflow-y-auto flex-1 scrollbar-thin">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Tanggal Bayar</label>
                                <input type="date" name="tanggal" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-emerald-50 transition-all outline-none" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Pilih Pasien/Anak</label>
                                <select name="anak_id" id="anak_id" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-emerald-50 transition-all outline-none" required>
                                    <option value="">-- Nama Anak --</option>
                                    @foreach ($anaks as $anak)
                                        <option value="{{ $anak->id }}" data-nama="{{ $anak->nama }}">{{ $anak->nama }} ({{ $anak->nib }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Layanan Tertagih</label>
                            <select name="layanan_select" id="layanan_select" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-emerald-50 transition-all outline-none" required disabled>
                                <option value="">-- Pilih Anak Terlebih Dahulu --</option>
                            </select>
                            <div class="hidden px-4 py-2 bg-emerald-50 rounded-xl border border-emerald-100 flex items-center gap-2" id="info_layanan">
                                <i data-lucide="info" class="w-3.5 h-3.5 text-emerald-500"></i>
                                <span class="text-[10px] font-black text-emerald-600 uppercase italic tracking-tighter">Kuota: <span id="info_sesi">0</span> Sesi</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Jumlah Pembayaran</label>
                                <div class="relative">
                                    <span class="absolute left-6 top-1/2 -translate-y-1/2 text-xs font-black text-emerald-400">Rp</span>
                                    <input type="text" id="jumlah" name="jumlah" readonly class="w-full bg-emerald-50/50 border-none rounded-2xl pl-14 pr-6 py-4 text-sm font-black text-emerald-700 outline-none italic">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Metode Bayar</label>
                                <select id="metode-pembayaran1" name="metode_bayar" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-emerald-50 transition-all outline-none">
                                    <option value="tunai">Tunai / Cash</option>
                                    <option value="transfer">Bank Transfer</option>
                                </select>
                            </div>
                        </div>

                        <div id="bukti-transfer1" class="hidden animate-in zoom-in-95 duration-300">
                             <div class="p-8 bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200 text-center space-y-4">
                                 <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mx-auto text-slate-400 shadow-sm"><i data-lucide="upload-cloud"></i></div>
                                 <div class="space-y-1">
                                     <p class="text-[10px] font-black text-slate-700 uppercase tracking-widest">Unggah Bukti Transfer</p>
                                     <p class="text-[8px] font-bold text-slate-400 uppercase">Format: JPG, PNG, PDF (Maks 2MB)</p>
                                 </div>
                                 <input type="file" id="unggah-bukti1" name="gambar" accept="image/*" class="text-[10px] font-bold text-slate-500 mx-auto">
                                 <img id="preview1" src="#" alt="Preview" class="hidden mt-4 max-h-48 mx-auto rounded-xl shadow-md border-4 border-white">
                            </div>
                        </div>

                        <input type="hidden" name="deskripsi" id="hidden_deskripsi">
                        <input type="hidden" name="tarif_id" id="hidden_tarif_id">
                        <input type="hidden" name="assessment_id" id="hidden_assessment_id">
                        <input type="hidden" name="jenis_layanan" id="hidden_jenis_layanan">
                        @if ($kategori) <input type="hidden" name="kategori_id" value="{{ $kategori->id }}"> @endif
                    </div>

                    <div class="bg-slate-50 p-7 flex justify-end gap-3 shrink-0">
                        <button type="button" @click="closeModal()" class="px-8 py-4 bg-white border border-slate-200 text-slate-500 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-100 transition-all">Batal</button>
                        <button type="submit" @if(!$kategori) disabled title="Kategori Pembayaran Anak Belum Diatur" @endif 
                                class="px-12 py-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-emerald-100 italic transition-all disabled:opacity-50">Simpan Transaksi</button>
                    </div>
                </form>
            </template>

            <template x-if="modalType === 'pemasukkan-lain'">
                <form action="{{ route('pemasukkan.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col max-h-[90vh]">
                    @csrf
                    <div class="bg-blue-600 text-white p-7 flex items-center justify-between shrink-0">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                                <i data-lucide="external-link" class="text-white"></i>
                            </div>
                            <h5 class="text-sm font-black uppercase tracking-widest mb-0 italic">Pemasukkan Umum / Lainnya</h5>
                        </div>
                        <button type="button" @click="closeModal()" class="text-blue-100 hover:text-white transition-colors"><i data-lucide="x" class="w-6 h-6"></i></button>
                    </div>

                    <div class="p-8 space-y-6 overflow-y-auto flex-1 scrollbar-thin">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Tanggal</label>
                                <input type="date" name="tanggal" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-50 transition-all outline-none" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Kategori</label>
                                <select name="kategori_id" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-50 transition-all outline-none" required>
                                    @foreach ($kategoris as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Deskripsi Transaksi</label>
                            <input type="text" name="deskripsi" placeholder="Contoh: Sewa alat, Penjualan ATK, Donasi..." class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-50 transition-all outline-none" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                             <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Jumlah Masuk</label>
                                <div class="relative">
                                    <span class="absolute left-6 top-1/2 -translate-y-1/2 text-xs font-black text-blue-400">Rp</span>
                                    <input type="text" name="jumlah" oninput="if(window.formatRupiah) formatRupiah(this)" class="w-full bg-white border-slate-200 rounded-2xl pl-14 pr-6 py-4 text-sm font-black text-blue-700 outline-none ring-4 ring-blue-50/50 italic" required>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Metode Bayar</label>
                                <select id="metode-pembayaran2" name="metode_bayar" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold">
                                    <option value="tunai">Tunai</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                            </div>
                        </div>

                        <div id="bukti-transfer2" class="hidden animate-in slide-in-from-top-2">
                             <div class="p-6 bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200 text-center space-y-4">
                                <input type="file" id="unggah-bukti2" name="gambar" accept="image/*" class="text-[10px] font-bold">
                                <img id="preview2" src="#" alt="Preview" class="hidden mt-4 max-h-48 mx-auto rounded-xl shadow-md border-4 border-white">
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 p-7 flex justify-end gap-3 shrink-0">
                        <button type="button" @click="closeModal()" class="px-8 py-4 bg-white border border-slate-200 text-slate-500 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-100 transition-all">Batal</button>
                        <button type="submit" class="px-12 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-blue-100 italic transition-all">Simpan Data</button>
                    </div>
                </form>
            </template>

            {{-- Modal for Previews --}}
            <template x-if="modalType === 'bukti-transfer'">
                <div class="bg-white">
                    <div class="bg-slate-900 text-white p-7 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center"><i data-lucide="image" class="text-blue-400"></i></div>
                            <h5 class="text-sm font-black uppercase tracking-widest mb-0 italic">Detail Bukti Pembayaran</h5>
                        </div>
                        <button type="button" @click="closeModal()" class="text-slate-400 hover:text-white transition-colors"><i data-lucide="x" class="w-6 h-6"></i></button>
                    </div>
                    <div class="p-8 bg-slate-50 flex justify-center">
                        <img id="img-preview" src="" class="max-h-[80vh] w-auto object-contain mx-auto rounded-[2.5rem] shadow-2xl border-8 border-white">
                    </div>
                </div>
            </template>

            <template x-if="modalType === 'log-pemakaian'">
                <div class="bg-white">
                    <div class="bg-emerald-600 text-white p-7 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center"><i data-lucide="history" class="text-white"></i></div>
                            <h5 class="text-sm font-black uppercase tracking-widest mb-0 italic">Audit Log Pemakaian Sesi</h5>
                        </div>
                        <button type="button" @click="closeModal()" class="text-emerald-100 hover:text-white transition-colors"><i data-lucide="x" class="w-6 h-6"></i></button>
                    </div>
                    <div class="max-h-[60vh] overflow-y-auto" id="log-container">
                        <div class="p-20 text-center space-y-4">
                            <div class="animate-spin w-8 h-8 border-4 border-emerald-500 border-t-transparent rounded-full mx-auto"></div>
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Memuat Riwayat...</p>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@include('keuangan.script1')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
        
        // Custom formatting for Rupiah in non-script1 handled inputs
        window.formatRupiah = function(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            input.value = value ? 'Rp ' + parseInt(value).toLocaleString('id-ID') : '';
        }

        // SweetAlert Delete
        $(document).on('click', '.btn-hapus', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const name = $(this).data('name');

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus data '${name}'? Saldo kas akan disesuaikan kembali.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#f1f5f9',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-[2.5rem] border-none shadow-2xl',
                    confirmButton: 'rounded-xl font-bold uppercase text-[10px] tracking-widest px-8 py-4',
                    cancelButton: 'rounded-xl font-bold uppercase text-[10px] tracking-widest px-8 py-4 text-slate-500'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Global function for Log Pemakaian (Moved outside DOMContentLoaded for global access)
    window.fetchLogData = function(id, retryCount = 0) {
        const container = document.getElementById('log-container');
        
        // If container not found (modal not rendered yet), retry up to 5 times
        if (!container) {
            if (retryCount < 10) {
                console.log(`Log container not found, retrying... (${retryCount + 1}/10)`);
                setTimeout(() => fetchLogData(id, retryCount + 1), 100);
            } else {
                console.error('Critical Error: Log container could not be found after multiple retries.');
            }
            return;
        }

        container.innerHTML = `<div class="p-20 text-center">
            <div class="animate-spin w-10 h-10 border-4 border-emerald-500 border-t-transparent rounded-full mx-auto mb-4"></div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest animate-pulse">Menghubungkan ke Server...</p>
        </div>`;
        
        // Generate URL using route helper
        const baseUrl = "{{ route('pemasukkan.log', ':id') }}";
        const url = baseUrl.replace(':id', id);
        
        console.log('Fetching log from:', url);
        
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(res => {
            console.log('Response status:', res.status);
            if(!res.ok) {
                if(res.status === 403) throw new Error('Akses Ditolak (Izin Diperlukan)');
                if(res.status === 404) throw new Error('Data Log Tidak Ditemukan');
                throw new Error(`Server Error (${res.status})`);
            }
            return res.text();
        })
        .then(html => {
            if (!html.trim()) throw new Error('Server mengembalikan data kosong');
            container.innerHTML = html;
            if (typeof lucide !== 'undefined') lucide.createIcons();
            console.log('Log loaded successfully');
        })
        .catch(err => {
            console.error('Fetch error:', err);
            container.innerHTML = `<div class="p-20 text-center">
                <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl shadow-red-100 animate-bounce">
                    <i data-lucide="alert-triangle" class="w-8 h-8"></i>
                </div>
                <h6 class="text-xs font-black text-slate-800 uppercase tracking-widest mb-2">Gagal Memuat Riwayat</h6>
                <p class="text-[10px] font-bold text-red-500 uppercase tracking-tighter mb-4">${err.message}</p>
                <button onclick="fetchLogData('${id}')" class="px-6 py-2 bg-slate-800 text-white text-[9px] font-black uppercase rounded-lg hover:bg-slate-700 transition-all">Coba Lagi</button>
            </div>`;
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });
    }
</script>
@endsection
