@extends('layouts.master')
@section('title', 'Master Data Pelatihan')

@section('content')
<div x-data="{ 
    modalOpen: false, 
    modalType: '',
    openModal(type) { 
        this.modalType = type; 
        this.modalOpen = true; 
        document.body.classList.add('overflow-hidden');
    },
    closeModal() { 
        this.modalOpen = false; 
        document.body.classList.remove('overflow-hidden');
    }
}" class="space-y-8 animate-in fade-in duration-500">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span>Data Pelatihan</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Katalog Pelatihan Terapis</h2>
        </div>
        @can('create pelatihan')
        <button @click="openModal('create')"
                class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Pelatihan
        </button>
        @endcan
    </div>

    <!-- Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($pelatihan as $p)
        <div class="card-premium group hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500 overflow-hidden bg-white border-none relative flex flex-col h-full">
            <div class="absolute top-0 left-0 w-1 h-full bg-red-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="p-8 flex-1 space-y-6">
                <div class="flex items-start justify-between">
                    <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:bg-red-50 group-hover:text-red-500 transition-colors">
                        <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                    </div>
                    @can('delete pelatihan')
                    <form action="{{ route('pelatihan.destroy', ['pelatihan' => $p->id]) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 text-slate-300 hover:text-red-500 transition-colors btn-hapus" data-name="{{ $p->nama }}">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </form>
                    @endcan
                </div>

                <div class="space-y-2">
                    <h3 class="text-lg font-black text-slate-800 uppercase italic leading-tight tracking-tight group-hover:text-red-500 transition-colors">
                        {{ $p->nama }}
                    </h3>
                    <div class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        <i data-lucide="building-2" class="w-3 h-3"></i>
                        <span>{{ $p->instansi }}</span>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-50 flex items-center justify-between mt-auto">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kursus Aktif</span>
                    </div>
                    <span class="text-[10px] font-bold text-slate-300 italic">#ID-{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 bg-slate-50/50 rounded-[2.5rem] border-2 border-dashed border-slate-100 flex flex-col items-center justify-center text-center space-y-4">
            <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center text-slate-200">
                <i data-lucide="database" class="w-8 h-8"></i>
            </div>
            <div class="space-y-1">
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Katalog Kosong</p>
                <p class="text-[10px] font-bold text-slate-300 italic uppercase">Belum ada data program pelatihan yang terdaftar.</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($pelatihan->hasPages())
    <div class="flex justify-center pt-8">
        {{ $pelatihan->links() }}
    </div>
    @endif

    <!-- Centered Alpine Modal -->
    <div x-show="modalOpen" x-cloak 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl w-full max-w-lg relative z-10 border border-slate-100 overflow-hidden"
             x-show="modalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <form action="{{ route('pelatihan.store') }}" method="POST">
                @csrf
                <div class="bg-slate-900 text-white p-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-red-500">
                                <i data-lucide="graduation-cap"></i>
                            </div>
                            <h5 class="text-sm font-black uppercase tracking-widest mb-0 italic">Tambah Program Pelatihan</h5>
                        </div>
                        <button type="button" @click="closeModal()" class="text-slate-400 hover:text-white transition-colors">
                            <i data-lucide="x" class="w-6 h-6"></i>
                        </button>
                    </div>
                </div>

                <div class="p-10 space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap Pelatihan</label>
                        <input type="text" name="nama" required placeholder="Contoh: Terapi Wicara Dasar..." 
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Instansi / Penyelenggara</label>
                        <input type="text" name="instansi" required placeholder="Contoh: Kementrian Kesehatan..." 
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                    </div>
                </div>

                <div class="bg-slate-50 p-8 flex justify-end gap-3">
                    <button type="button" @click="closeModal()" 
                            class="px-8 py-3 bg-white border border-slate-200 text-slate-500 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all hover:bg-slate-100">Batal</button>
                    <button type="submit" 
                            class="px-12 py-3 bg-red-500 hover:bg-red-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-red-100 italic transition-all">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() { 
        if (typeof lucide !== 'undefined') lucide.createIcons(); 
    });
</script>
@endsection
