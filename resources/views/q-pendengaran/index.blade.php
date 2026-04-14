@extends('layouts.master')
@section('title', 'Data Deteksi Pendengaran')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500"
     x-data="{ 
        modalOpen: false, 
        editMode: false,
        formData: {
            id: '',
            age_group_id: '',
            question_text: ''
        },
        openCreateModal() {
            this.editMode = false;
            this.formData = { id: '', age_group_id: '{{ $ageGroups->first()->id ?? '' }}', question_text: '' };
            this.modalOpen = true;
        },
        openEditModal(data) {
            this.editMode = true;
            this.formData = { 
                id: data.id, 
                age_group_id: data.age_group_id,
                question_text: data.question_text 
            };
            this.modalOpen = true;
        }
     }"
     x-effect="if(modalOpen) { setTimeout(() => lucide.createIcons(), 50) }">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Data Deteksi</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Deteksi Pendengaran</h2>
        </div>
        @can('create deteksi qpendengaran')
        <button @click="openCreateModal()"
                class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Data
        </button>
        @endcan
    </div>

    {{-- Cards for Each Age Group --}}
    <div class="space-y-6">
        @foreach ($ageGroups as $group)
        <div class="card-premium overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-red-500 shrink-0">
                    <i data-lucide="ear" class="w-4 h-4"></i>
                </div>
                <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest">
                    Kelompok Umur: <span class="text-red-500">{{ $group->nama }}</span>
                </h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-12 text-center">No</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pertanyaan</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($group->questions as $q)
                        <tr class="hover:bg-slate-50/50 transition-colors group/row">
                            <td class="px-6 py-4 text-xs font-bold text-slate-400 text-center">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-slate-700 leading-relaxed">{{ $q->question_text }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2 opacity-0 group-hover/row:opacity-100 transition-opacity">
                                    @can('update qpendengaran')
                                    <button type="button" @click="openEditModal({ id: '{{ $q->id }}', age_group_id: '{{ $group->id }}', question_text: `{{ addslashes($q->question_text) }}` })"
                                            class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition-all shadow-sm border border-amber-100">
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                    </button>
                                    @endcan
                                    
                                    @can('delete qpendengaran')
                                    <form action="{{ route('qpendengaran.destroy', ['id' => $q->id]) }}" method="POST" class="inline">
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
                            <td colspan="3" class="px-6 py-12 text-center">
                                <i data-lucide="help-circle" class="w-8 h-8 text-slate-200 mx-auto mb-3"></i>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Belum ada pertanyaan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>


    <!-- Alpine Modal -->
    <template x-if="modalOpen">
        <div class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click="modalOpen = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full animate-in zoom-in duration-300">
                    <form :action="editMode ? '{{ url('q-pendengaran/update') }}/' + formData.id : '{{ route('qpendengaran.store') }}'" method="POST">
                        @csrf
                        <template x-if="editMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl shadow-lg flex items-center justify-center text-white" :class="editMode ? 'bg-amber-500 shadow-amber-200' : 'bg-red-500 shadow-red-200'">
                                    <i :data-lucide="editMode ? 'edit-3' : 'plus-circle'" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-black text-slate-800 uppercase italic tracking-tight" x-text="editMode ? 'Ubah Pertanyaan' : 'Tambah Pertanyaan'"></h3>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Klasifikasi kriteria deteksi pendengaran</p>
                                </div>
                            </div>
                            <button type="button" @click="modalOpen = false" class="text-slate-400 hover:text-red-500 transition-colors">
                                <i data-lucide="x" class="w-6 h-6"></i>
                            </button>
                        </div>

                        <div class="px-8 py-8 space-y-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Kelompok Umur</label>
                                <select name="age_group_id" x-model="formData.age_group_id" required class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-black focus:ring-4 transition-all outline-none appearance-none"
                                        :class="editMode ? 'focus:ring-amber-50' : 'focus:ring-red-50'">
                                    @foreach ($ageGroups as $age)
                                        <option value="{{ $age->id }}">{{ $age->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Isi Pertanyaan</label>
                                <textarea name="question_text" x-model="formData.question_text" rows="4" required placeholder="Masukkan pertanyaan..."
                                       class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 transition-all outline-none resize-none"
                                       :class="editMode ? 'focus:ring-amber-50' : 'focus:ring-red-50'"></textarea>
                            </div>
                        </div>

                        <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3 rounded-b-3xl">
                            <button type="button" @click="modalOpen = false" class="px-6 py-3 bg-white border border-slate-200 text-slate-500 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Batal</button>
                            <button type="submit" class="px-8 py-3 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg transition-all flex items-center gap-2 italic"
                                    :class="editMode ? 'bg-amber-500 hover:bg-amber-600 shadow-amber-100' : 'bg-red-500 hover:bg-red-600 shadow-red-100'">
                                <span x-text="editMode ? 'Simpan Perubahan' : 'Simpan Data'"></span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() { lucide.createIcons(); });
</script>
@endsection
