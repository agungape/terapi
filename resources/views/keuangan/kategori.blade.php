@extends('layouts.master')
@section('title', 'Kategori Keuangan')

@section('content')
<div x-data="{ 
    modalOpen: false, 
    modalType: '',
    currentData: { nama: '', jenis: 'Pemasukkan' },
    openModal(type, data = { nama: '', jenis: 'Pemasukkan' }) {
        this.modalType = type;
        this.currentData = { ...data };
        this.modalOpen = true;
    },
    closeModal() {
        this.modalOpen = false;
    }
}" class="space-y-8 animate-in fade-in duration-500">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Kategori Keuangan</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Kategori Transaksi</h2>
        </div>
        @can('create kategori')
        <button @click="openModal('tambah')"
                class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Kategori
        </button>
        @endcan
    </div>

    {{-- Info Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="card-premium p-6 border-l-4 border-l-emerald-500 flex items-center gap-5">
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500">
                <i data-lucide="trending-up" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori Pemasukkan</p>
                <h3 class="text-2xl font-black text-slate-800 italic">{{ $kategoris->where('jenis', 'Pemasukkan')->count() }}</h3>
            </div>
        </div>
        <div class="card-premium p-6 border-l-4 border-l-red-500 flex items-center gap-5">
            <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center text-red-500">
                <i data-lucide="trending-down" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori Pengeluaran</p>
                <h3 class="text-2xl font-black text-slate-800 italic">{{ $kategoris->where('jenis', 'Pengeluaran')->count() }}</h3>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card-premium overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex items-center gap-2">
            <i data-lucide="tags" class="w-4 h-4 text-red-500"></i>
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">SEMUA KATEGORI TRANSAKSI</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-12">#</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Kategori</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Jenis Transaksi</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($kategoris as $kategori)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 text-xs font-bold text-slate-300 italic">{{ $kategoris->firstItem() + $loop->iteration - 1 }}</td>
                        <td class="px-6 py-4 text-xs font-black text-slate-700 uppercase tracking-tight">{{ $kategori->nama }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border
                                {{ $kategori->jenis == 'Pemasukkan' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-red-50 text-red-600 border-red-100' }}">
                                {{ $kategori->jenis }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end transition-opacity">
                                @can('delete kategori')
                                <form action="{{ route('kategori.destroy', ['kategori' => $kategori->id]) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus"
                                            data-name="{{ $kategori->nama }}">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-center">
            {{ $kategoris->fragment('judul')->links() }}
        </div>
    </div>

    {{-- Alpine Modal --}}
    <div x-show="modalOpen" 
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="closeModal()"></div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl w-full max-w-lg relative z-10 overflow-hidden border border-slate-100"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="modal-header border-none bg-slate-900 text-white p-7 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                            <i data-lucide="tags" class="text-red-500"></i>
                        </div>
                        <h5 class="text-sm font-black uppercase tracking-widest mb-0">Tambah Kategori Baru</h5>
                    </div>
                    <button type="button" @click="closeModal()" class="text-slate-400 hover:text-white transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <div class="p-8 space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Nama Kategori <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" required x-model="currentData.nama" placeholder="Contoh: Investasi, Gajih, Sewa..."
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Jenis Transaksi <span class="text-red-500">*</span></label>
                        <select name="jenis" required x-model="currentData.jenis"
                                class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                            @foreach ($jenis as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="bg-slate-50 p-7 flex justify-end gap-3">
                    <button type="button" @click="closeModal()" 
                            class="px-8 py-3.5 bg-white border border-slate-200 text-slate-500 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-100 transition-all">Batal</button>
                    <button type="submit" class="px-12 py-3.5 bg-red-500 hover:bg-red-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-red-100 italic transition-all">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() { 
        lucide.createIcons(); 
    });
</script>
@endsection
