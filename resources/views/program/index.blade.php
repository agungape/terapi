@extends('layouts.master')
@section('title', 'Program Terapi')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500"
     x-data="{ 
        modalOpen: false, 
        editMode: false, 
        formData: {
            id: '',
            deskripsi: '',
            jenis: 'terapi_perilaku'
        },
        openCreateModal() {
            this.editMode = false;
            this.formData = { id: '', deskripsi: '', jenis: 'terapi_perilaku' };
            this.modalOpen = true;
        },
        openEditModal(data) {
            this.editMode = true;
            this.formData = { 
                id: data.id, 
                deskripsi: data.deskripsi, 
                jenis: data.jenis 
            };
            this.modalOpen = true;
        }
     }">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Master Data Program</span>
        </div>
        
        @can('create program anak')
        <button @click="openCreateModal()" class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Program
        </button>
        @endcan
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Table Column -->
        <div class="lg:col-span-8">
            <div class="card-premium overflow-hidden h-full flex flex-col">
                <div class="p-6 border-b border-slate-100 bg-white">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                        <i data-lucide="book-open" class="w-4 h-4 text-red-500"></i> MODUL KURIKULUM TERAPI
                    </h3>
                </div>

                <div class="flex-1 overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-16">#</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Deskripsi Program</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Jenis Program</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($program as $p)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4 text-xs font-bold text-slate-400">{{ $program->firstItem() + $loop->iteration - 1 }}</td>
                                <td class="px-6 py-4">
                                    <h4 class="text-xs font-black text-slate-700 uppercase tracking-tight group-hover:text-red-500 transition-colors">{{ $p->deskripsi }}</h4>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($p->jenis == 'terapi_perilaku')
                                        <span class="px-2.5 py-1 bg-amber-50 text-amber-700 rounded-lg text-[9px] font-black uppercase tracking-tighter border border-amber-100">Behavioral Therapy</span>
                                    @elseif ($p->jenis == 'fisioterapi')
                                        <span class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg text-[9px] font-black uppercase tracking-tighter border border-blue-100">Physio & SI</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-slate-100 text-slate-500 rounded-lg text-[9px] font-black uppercase tracking-tighter">{{ $p->jenis }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        @can('update program anak')
                                        <button @click="openEditModal({ id: '{{ $p->id }}', deskripsi: `{{ addslashes($p->deskripsi) }}`, jenis: '{{ $p->jenis }}' })"
                                                class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition-all shadow-sm border border-amber-100" title="Ubah Program">
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        </button>
                                        @endcan

                                        @can('delete program anak')
                                        <form action="{{ route('program.destroy', ['program' => $p->id]) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus"
                                                    data-name="{{ $p->deskripsi }}" data-table="program">
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
                
                <div class="p-6 bg-slate-50 border-t border-slate-100 flex justify-center">
                    {{ $program->fragment('judul')->links() }}
                </div>
            </div>
        </div>

        <!-- Info Sidebar Column -->
        <div class="lg:col-span-4">
            <div class="space-y-6">
                <!-- Info Section -->
                <div class="card-premium p-8 bg-slate-900 text-white relative overflow-hidden group">
                    <i data-lucide="info" class="w-48 h-48 text-white/5 absolute -right-12 -bottom-12 group-hover:rotate-12 transition-transform duration-500"></i>
                    <div class="relative z-10 space-y-4">
                        <div class="p-3 bg-red-500 rounded-2xl w-max shadow-lg shadow-red-500/20">
                            <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-xl font-black tracking-tight leading-tight">Panduan <br>Kurikulum</h3>
                        <p class="text-slate-400 text-xs font-medium leading-relaxed">
                            Program terapi dirancang khusus untuk memantau perkembangan anak sesuai dengan spesialisasi yang dipilih. Pastikan penamaan program ringkas dan informatif.
                        </p>
                    </div>
                </div>

                <!-- Stats Summary -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="card-premium p-6 text-center bg-white">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total</h4>
                        <p class="text-2xl font-black text-slate-800">{{ $program->total() }}</p>
                    </div>
                    <div class="card-premium p-6 text-center bg-white">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Terapi</h4>
                        <p class="text-2xl font-black text-red-500">2 Jenis</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Alpine Modal -->
    <template x-if="modalOpen">
        <div class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click="modalOpen = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full animate-in zoom-in duration-300">
                    <form :action="editMode ? '{{ url('program') }}/' + formData.id : '{{ route('program.store') }}'" method="POST">
                        @csrf
                        <template x-if="editMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-red-500 text-white flex items-center justify-center shadow-lg shadow-red-200">
                                    <i data-lucide="book-open" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-black text-slate-800 uppercase italic tracking-tight" x-text="editMode ? 'Ubah Program Terapi' : 'Tambah Program Baru'"></h3>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Definisikan kurikulum modul layanan</p>
                                </div>
                            </div>
                            <button type="button" @click="modalOpen = false" class="text-slate-400 hover:text-red-500 transition-colors">
                                <i data-lucide="x" class="w-6 h-6"></i>
                            </button>
                        </div>

                        <div class="px-8 py-8 space-y-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Deskripsi Modul / Program</label>
                                <textarea name="deskripsi" x-model="formData.deskripsi" rows="3" required placeholder="Contoh: Terapi Perilaku Dasar..."
                                       class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none resize-none"></textarea>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Jenis Program</label>
                                <select name="jenis" x-model="formData.jenis" required class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-black focus:ring-4 focus:ring-red-50 transition-all outline-none appearance-none">
                                    @foreach ($jenis as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3 rounded-b-3xl">
                            <button type="button" @click="modalOpen = false" class="px-6 py-3 bg-white border border-slate-200 text-slate-500 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Batal</button>
                            <button type="submit" class="px-8 py-3 bg-red-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-600 shadow-lg shadow-red-100 transition-all flex items-center gap-2 italic">
                                <span x-text="editMode ? 'Simpan Modul' : 'Tambahkan Modul'"></span>
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
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection
