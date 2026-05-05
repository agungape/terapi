@extends('layouts.master')
@section('title', 'Pengeluaran Keuangan')

@section('content')
<div x-data="{ 
    modalOpen: false, 
    modalType: '',
    currentImage: '',
    openModal(type, image = '') {
        this.modalType = type;
        this.currentImage = image;
        this.modalOpen = true;
    },
    closeModal() {
        this.modalOpen = false;
    }
}" class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Manajemen Pengeluaran Kas</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Catatan Pengeluaran</h2>
        </div>
        
        @can('create pengeluaran')
        <button @click="openModal('tambah')" class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Catat Pengeluaran
        </button>
        @endcan
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Saldo Card -->
        <div class="card-premium p-8 bg-white border-l-4 border-l-emerald-500 relative overflow-hidden group">
            <div class="relative z-10 flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Saldo Kas</p>
                    <h3 class="text-3xl font-black text-slate-800 tracking-tighter italic">Rp {{ $saldoKas ? number_format($saldoKas->saldo_awal, 0, ',', '.') : '0' }}</h3>
                </div>
                <div class="p-4 bg-emerald-50 text-emerald-500 rounded-2xl group-hover:scale-110 transition-transform">
                    <i data-lucide="wallet" class="w-8 h-8"></i>
                </div>
            </div>
            <div class="absolute -right-8 -bottom-8 text-emerald-50/50">
                <i data-lucide="wallet" class="w-32 h-32"></i>
            </div>
        </div>

        <!-- Pengeluaran Card -->
        <div class="card-premium p-8 bg-white border-l-4 border-l-red-500 relative overflow-hidden group">
            <div class="relative z-10 flex items-center justify-between">
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Pengeluaran</p>
                    <h3 class="text-3xl font-black text-slate-800 tracking-tighter italic">Rp {{ $formattedPengeluaran ?? '0' }}</h3>
                </div>
                <div class="p-4 bg-red-50 text-red-500 rounded-2xl group-hover:scale-110 transition-transform">
                    <i data-lucide="trending-down" class="w-8 h-8"></i>
                </div>
            </div>
            <div class="absolute -right-8 -bottom-8 text-red-50/50">
                <i data-lucide="trending-down" class="w-32 h-32"></i>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="card-premium overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-white flex items-center justify-between">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                <i data-lucide="list" class="w-4 h-4 text-red-500"></i> RIWAYAT TRANSAKSI PENGELUARAN
            </h3>
        </div>

        {{-- Desktop View --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-16 text-center">#</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Deskripsi / Kategori</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Jumlah</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Saldo Akhir</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($pengeluarans as $pengeluaran)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 text-xs font-bold text-slate-300 italic text-center">{{ $pengeluarans->firstItem() + $loop->iteration - 1 }}</td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-black text-slate-700 italic uppercase whitespace-nowrap">{{ $pengeluaran->tanggal_formatted }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <h4 class="text-xs font-black text-slate-800 uppercase tracking-tight">{{ $pengeluaran->deskripsi }}</h4>
                            <p class="text-[9px] font-black text-red-500 uppercase mt-0.5 tracking-widest italic flex items-center gap-1">
                                <i data-lucide="tag" class="w-2.5 h-2.5"></i> {{ $pengeluaran->kategori->nama }}
                            </p>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-xs font-black text-red-600 italic tracking-tight">
                                - {{ $pengeluaran->jumlah_formatted }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-xs font-bold text-slate-400 italic">{{ $pengeluaran->saldo_akhir_formatted }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                @if ($pengeluaran->gambar)
                                <button @click="openModal('lihat-bukti', '{{ asset('storage/sturk-bayar/' . $pengeluaran->gambar) }}')" 
                                        class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all border border-blue-100 shadow-sm" title="Lihat Struk">
                                    <i data-lucide="image" class="w-3.5 h-3.5"></i>
                                </button>
                                @endif

                                @can('delete pengeluaran')
                                    @if ($pengeluaran->id == $dataTerakhir->id)
                                    <form action="{{ route('pengeluaran.destroy', $pengeluaran->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="button" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus" 
                                                data-name="{{ $pengeluaran->deskripsi }}"
                                                title="Batalkan Transaksi">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                    @endif
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-24 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <i data-lucide="inbox" class="w-12 h-12 text-slate-200"></i>
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest italic tracking-widest">Data pengeluaran belum tersedia...</p>
                        </div>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile View --}}
        <div class="md:hidden divide-y divide-slate-100">
            @forelse ($pengeluarans as $pengeluaran)
            <div class="p-5 space-y-4">
                <div class="flex justify-between items-start">
                    <div class="space-y-1">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $pengeluaran->tanggal_formatted }}</p>
                        <h4 class="text-xs font-black text-slate-800 uppercase tracking-tight leading-tight">{{ $pengeluaran->deskripsi }}</h4>
                        <span class="inline-block text-[8px] font-black text-red-500 uppercase italic">{{ $pengeluaran->kategori->nama }}</span>
                    </div>
                    <span class="text-sm font-black text-red-600 italic">- {{ $pengeluaran->jumlah_formatted }}</span>
                </div>
                <div class="flex items-center justify-between pt-2">
                    <div class="flex flex-col">
                         <p class="text-[9px] font-bold text-slate-400 uppercase">Saldo Kas</p>
                         <span class="text-[10px] font-black text-slate-600 italic">{{ $pengeluaran->saldo_akhir_formatted }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        @if ($pengeluaran->gambar)
                        <button @click="openModal('lihat-bukti', '{{ asset('storage/sturk-bayar/' . $pengeluaran->gambar) }}')"
                                class="w-8 h-8 flex items-center justify-center bg-blue-50 text-blue-600 rounded-lg border border-blue-100">
                            <i data-lucide="image" class="w-3 h-3"></i>
                        </button>
                        @endif
                        
                        @can('delete pengeluaran')
                        @if($pengeluaran->id == $dataTerakhir->id)
                        <form action="{{ route('pengeluaran.destroy', $pengeluaran->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="button" class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-600 rounded-lg border border-red-100 btn-hapus" data-name="{{ $pengeluaran->deskripsi }}">
                                <i data-lucide="trash-2" class="w-3 h-3"></i>
                            </button>
                        </form>
                        @endif
                        @endcan
                    </div>
                </div>
            </div>
            @empty
            <div class="p-12 text-center text-slate-300 text-[10px] font-black uppercase tracking-widest italic">Tidak ada data.</div>
            @endforelse
        </div>
        
        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-center">
            {{ $pengeluarans->fragment('judul')->links() }}
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
             :class="modalType === 'lihat-bukti' ? 'max-w-xl' : 'max-w-2xl'"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <template x-if="modalType === 'tambah'">
                <form action="{{ route('pengeluaran.store') }}" method="POST" enctype="multipart/form-data" id="pengeluaranForm" class="flex flex-col max-h-[90vh]">
                    @csrf
                    <div class="bg-red-600 text-white p-7 flex items-center justify-between shrink-0">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                                <i data-lucide="trending-down" class="text-white"></i>
                            </div>
                            <div>
                                <h5 class="text-sm font-black uppercase tracking-widest mb-0 italic">Input Pengeluaran Kas</h5>
                                <p class="text-[9px] font-bold text-red-100 uppercase tracking-tighter">Saldo kas akan diperbarui otomatis</p>
                            </div>
                        </div>
                        <button type="button" @click="closeModal()" class="text-red-100 hover:text-white transition-colors"><i data-lucide="x" class="w-6 h-6"></i></button>
                    </div>

                    <div class="p-8 space-y-6 overflow-y-auto flex-1 scrollbar-thin">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Tanggal Transaksi</label>
                                <input type="date" name="tanggal" required value="{{ old('tanggal', date('Y-m-d')) }}"
                                       class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Kategori Biaya</label>
                                <select name="kategori_id" required class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Deskripsi Transaksi</label>
                            <input type="text" name="deskripsi" required placeholder="Contoh: Pembelian peralatan sensory, Listrik, dsb..."
                                   class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                             <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Jumlah Nominal</label>
                                <div class="relative">
                                    <span class="absolute left-6 top-1/2 -translate-y-1/2 text-xs font-black text-red-400">Rp</span>
                                    <input type="text" id="jumlah_input" name="jumlah" required oninput="window.formatRupiah(this)"
                                           class="w-full bg-white border-slate-200 rounded-2xl pl-14 pr-6 py-4 text-sm font-black text-red-700 outline-none ring-4 ring-red-50/50 italic">
                                </div>
                            </div>
                            <div class="space-y-2" x-data="{ hasFile: false }">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Lampiran Struk (Opsional)</label>
                                <div class="relative">
                                    <input type="file" name="gambar" accept="image/*" @change="hasFile = $event.target.files.length > 0"
                                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-xs font-black uppercase flex items-center justify-between transition-all"
                                         :class="hasFile ? 'text-emerald-500 bg-emerald-50 border-emerald-100' : 'text-slate-400'">
                                        <span x-text="hasFile ? 'File Terpilih' : 'Pilih File Struk...'"></span>
                                        <i :data-lucide="hasFile ? 'check-circle' : 'upload-cloud'" class="w-4 h-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 p-7 flex justify-end gap-3 shrink-0">
                        <button type="button" @click="closeModal()" class="px-8 py-4 bg-white border border-slate-200 text-slate-500 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-100 transition-all">Batal</button>
                        @if (empty($saldoKas))
                            <button type="button" disabled class="px-12 py-4 bg-slate-300 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest cursor-not-allowed">Saldo Kosong</button>
                        @else
                            <button type="submit" class="px-12 py-4 bg-red-600 hover:bg-red-700 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-red-100 italic transition-all">Simpan Transaksi</button>
                        @endif
                    </div>
                </form>
            </template>

            <template x-if="modalType === 'lihat-bukti'">
                <div class="bg-white">
                    <div class="bg-slate-900 text-white p-7 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center"><i data-lucide="image" class="text-blue-400"></i></div>
                            <h5 class="text-sm font-black uppercase tracking-widest mb-0 italic">Bukti Pengeluaran Kas</h5>
                        </div>
                        <button type="button" @click="closeModal()" class="text-slate-400 hover:text-white transition-colors"><i data-lucide="x" class="w-6 h-6"></i></button>
                    </div>
                    <div class="p-8 bg-slate-50 flex justify-center">
                        <img :src="currentImage" class="max-h-[80vh] w-auto object-contain mx-auto rounded-[2.5rem] shadow-2xl border-8 border-white">
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    window.formatRupiah = function(input) {
        let value = input.value.replace(/[^0-9]/g, '');
        if (value) {
            value = parseInt(value).toLocaleString('id-ID');
        }
        input.value = value || '';
    }

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        // Standard form submit to strip dots
        document.addEventListener('submit', function(e) {
            const jumlahInput = document.getElementById('jumlah_input');
            if (jumlahInput) {
                // Strip dots before final submit
                jumlahInput.value = jumlahInput.value.replace(/\./g, '');
            }
        });

        // SweetAlert Delete
        $(document).on('click', '.btn-hapus', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const name = $(this).data('name');

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus pengeluaran '${name}'? Saldo kas akan disesuaikan kembali.`,
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
</script>
@endsection
