@extends('layouts.master')
@section('title', 'Data Deteksi Perilaku')

@section('content')
<div x-data="{ 
    modalOpen: false, 
    editMode: false,
    formData: {
        id: '',
        question_text: ''
    },
    openCreateModal() {
        this.editMode = false;
        this.formData = { id: '', question_text: '' };
        this.modalOpen = true;
    },
    openEditModal(item) {
        this.editMode = true;
        this.formData = { ...item };
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
                <span class="text-slate-600">Data Deteksi</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Deteksi Perilaku</h2>
        </div>
        @can('create deteksi qperilaku')
        <button @click="openCreateModal()"
                class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Data
        </button>
        @endcan
    </div>

    {{-- Card Table --}}
    <div class="card-premium overflow-hidden bg-white shadow-xl shadow-slate-200/50 border-none">
        <div class="p-6 border-b border-slate-50 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-red-500 shrink-0">
                <i data-lucide="activity" class="w-4 h-4"></i>
            </div>
            <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest">DAFTAR PERTANYAAN DETEKSI PERILAKU</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-12 text-center">No</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pertanyaan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($perilaku as $q)
                    <tr class="hover:bg-slate-50/50 transition-colors group/row">
                        <td class="px-6 py-4 text-xs font-bold text-slate-400 text-center">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-slate-700 leading-relaxed">{{ $q->question_text }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2 opacity-0 group-hover/row:opacity-100 transition-opacity">
                                <button @click="openEditModal({ id: '{{ $q->id }}', question_text: '{{ addslashes($q->question_text) }}' })"
                                        class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm border border-blue-100">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </button>
                                @can('delete qperilaku')
                                <form action="{{ route('qperilaku.destroy', ['id' => $q->id]) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus"
                                            data-name="Pertanyaan ini">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <i data-lucide="database" class="w-10 h-10 text-slate-200"></i>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Belum ada pertanyaan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Alpine Modal --}}
    <div x-show="modalOpen" 
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="closeModal()"></div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl w-full max-w-lg relative z-10 overflow-hidden border border-slate-100"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <form :action="editMode ? '{{ route('qperilaku.update', ['id' => ':id']) }}'.replace(':id', formData.id) : '{{ route('qperilaku.store') }}'" 
                  method="POST">
                @csrf
                <template x-if="editMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div class="modal-header bg-slate-900 text-white p-7 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                            <i data-lucide="help-circle" class="text-red-500"></i>
                        </div>
                        <h5 class="text-sm font-black uppercase tracking-widest mb-0" x-text="editMode ? 'Edit Pertanyaan' : 'Tambah Pertanyaan'"></h5>
                    </div>
                    <button type="button" @click="closeModal()" class="text-slate-400 hover:text-white transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <div class="p-8 space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Pertanyaan</label>
                        <textarea class="w-full bg-slate-50 border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none resize-none" 
                                  rows="4" name="question_text" x-model="formData.question_text" required placeholder="Masukkan pertanyaan deteksi perilaku..."></textarea>
                    </div>
                </div>

                <div class="bg-slate-50 p-7 flex justify-end gap-3">
                    <button type="button" @click="closeModal()" 
                            class="px-8 py-3.5 bg-white border border-slate-200 text-slate-500 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all hover:bg-slate-100">Batal</button>
                    <button type="submit" 
                            class="px-12 py-3.5 bg-red-500 hover:bg-red-600 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-red-100 italic transition-all">
                        <span x-text="editMode ? 'Update Data' : 'Simpan Data'"></span>
                    </button>
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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() { lucide.createIcons(); });
</script>
@endsection
