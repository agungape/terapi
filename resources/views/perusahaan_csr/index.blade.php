@extends('layouts.master')
@section('title', 'Perusahaan CSR')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500"
     x-data="{ 
        modalOpen: false, 
        editMode: false, 
        formData: {
            id: '',
            nama_perusahaan: '',
            deskripsi_program: '',
            logo_url: null
        },
        openCreateModal() {
            this.editMode = false;
            this.formData = { id: '', nama_perusahaan: '', deskripsi_program: '', logo_url: null };
            this.modalOpen = true;
        },
        openEditModal(data) {
            this.editMode = true;
            this.formData = { 
                id: data.id, 
                nama_perusahaan: data.nama_perusahaan, 
                deskripsi_program: data.deskripsi_program,
                logo_url: data.logo_url || null
            };
            this.modalOpen = true;
        }
     }">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-amber-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Master Data CSR</span>
        </div>
        
        <button @click="openCreateModal()" class="bg-amber-500 hover:bg-amber-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-amber-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Perusahaan CSR
        </button>
    </div>

    <!-- Data Table Card -->
    <div class="card-premium overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-white flex items-center justify-between">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                <i data-lucide="building-2" class="w-4 h-4 text-amber-500"></i> DATA PERUSAHAAN CSR
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-16">#</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Perusahaan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Deskripsi Program</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Logo</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($csrs as $csr)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 text-xs font-bold text-slate-400">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <h4 class="text-xs font-black text-slate-700 uppercase tracking-tight group-hover:text-amber-500 transition-colors">{{ $csr->nama_perusahaan }}</h4>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs text-slate-500">{{ $csr->deskripsi_program ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($csr->logo)
                                <img src="{{ route('perusahaan-csr.logo', $csr->id) }}?v={{ optional($csr->updated_at)->timestamp ?? time() }}"
                                     alt="Logo {{ $csr->nama_perusahaan }}"
                                     class="h-10 mx-auto object-contain rounded bg-white p-1 border border-slate-100">
                            @else
                                <span class="text-[9px] font-bold text-slate-300 uppercase">Tidak ada logo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button @click="openEditModal({ id: '{{ $csr->id }}', nama_perusahaan: {{ \Illuminate\Support\Js::from($csr->nama_perusahaan) }}, deskripsi_program: {{ \Illuminate\Support\Js::from($csr->deskripsi_program) }}, logo_url: {{ \Illuminate\Support\Js::from($csr->logo ? route('perusahaan-csr.logo', $csr->id) . '?v=' . (optional($csr->updated_at)->timestamp ?? time()) : null) }} })"
                                        class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm border border-blue-100" title="Ubah CSR">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </button>

                                <form action="{{ route('perusahaan-csr.destroy', $csr->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus"
                                            data-name="{{ $csr->nama_perusahaan }}" data-table="perusahaan csr">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-3 text-slate-300">
                                <i data-lucide="building" class="w-8 h-8"></i>
                            </div>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Belum ada data perusahaan CSR</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Alpine.js -->
    <div x-show="modalOpen" 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-0" x-cloak>
        
        <div x-show="modalOpen" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm"
             @click="modalOpen = false"></div>

        <div x-show="modalOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="bg-white rounded-3xl overflow-hidden shadow-2xl transform transition-all w-full max-w-lg relative border border-slate-100">
            
            <form :action="editMode ? '{{ url('perusahaan-csr') }}/' + formData.id : '{{ route('perusahaan-csr.store') }}'" method="POST" enctype="multipart/form-data">
                @csrf
                <template x-if="editMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="px-5 py-4 sm:px-8 sm:py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <div>
                        <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider" x-text="editMode ? 'Ubah Perusahaan CSR' : 'Tambah Perusahaan CSR'"></h3>
                        <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest">Lengkapi formulir di bawah ini</p>
                    </div>
                    <button type="button" @click="modalOpen = false" class="w-8 h-8 flex items-center justify-center bg-white rounded-xl text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors shadow-sm">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>

                <div class="p-5 sm:p-8 space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Nama Perusahaan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_perusahaan" x-model="formData.nama_perusahaan" required
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-amber-50 focus:border-amber-500 transition-all outline-none"
                               placeholder="Contoh: PT. ANTAM TBK POMALAA">
                    </div>

                    
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Deskripsi Program (Opsional)</label>
                        <input type="text" name="deskripsi_program" x-model="formData.deskripsi_program" 
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-4 focus:ring-amber-50 focus:border-amber-500 transition-all outline-none"
                               placeholder="Contoh: Program terapi gratis">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Logo Perusahaan (Opsional)</label>
                        <template x-if="editMode && formData.logo_url">
                            <div class="p-3 bg-slate-50 border border-slate-100 rounded-2xl flex items-center gap-3 mb-2">
                                <img :src="formData.logo_url" alt="Logo Saat Ini" class="h-12 w-auto object-contain rounded bg-white p-1 border border-slate-100">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Logo saat ini</span>
                            </div>
                        </template>
                        <input type="file" name="logo" accept="image/*"
                               class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-4 py-3 text-sm text-slate-600 focus:ring-4 focus:ring-amber-50 focus:border-amber-500 transition-all outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                        <p class="text-[9px] font-bold text-slate-400 uppercase px-1 mt-1">Format: JPG, PNG, SVG, WEBP (Maks 2MB). Kosongkan jika tidak ada/ingin logo lama.</p>
                    </div>
                </div>

                <div class="px-5 py-4 sm:px-8 sm:py-5 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                    <button type="button" @click="modalOpen = false" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-500 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-slate-50 transition-colors shadow-sm">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-amber-500 text-white rounded-xl text-xs font-black uppercase tracking-wider hover:bg-amber-600 transition-all shadow-lg shadow-amber-200 flex items-center gap-2">
                        <i data-lucide="save" class="w-3.5 h-3.5"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
