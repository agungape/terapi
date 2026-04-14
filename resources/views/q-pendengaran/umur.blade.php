@extends('layouts.master')
@section('title', 'Master Data Umur Deteksi')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500"
     x-data="{ 
        modalOpen: false, 
        editMode: false,
        formData: {
            id: '',
            nama: ''
        },
        openCreateModal() {
            this.editMode = false;
            this.formData = { id: '', nama: '' };
            this.modalOpen = true;
        },
        openEditModal(data) {
            this.editMode = true;
            this.formData = { 
                id: data.id, 
                nama: data.nama 
            };
            this.modalOpen = true;
        }
     }"
     x-effect="if(modalOpen) { setTimeout(() => lucide.createIcons(), 50) }">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Master Detection</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Data Kelompok Umur</h2>
        </div>
        
        @can('create deteksi umur')
        <button @click="openCreateModal()" class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Kelompok Umur
        </button>
        @endcan
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Table List -->
        <div class="card-premium overflow-hidden bg-white">
            <div class="p-6 border-b border-slate-50 flex items-center gap-3">
                <i data-lucide="list-ordered" class="w-4 h-4 text-red-500"></i>
                <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest">KELOMPOK USIA TERDAFTAR</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama / Rentang Umur</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($ageGroups as $age)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg text-[10px] font-black uppercase tracking-widest border border-slate-200">
                                    {{ $age->nama }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    @can('create deteksi umur') {{-- Using generic permission for update if specific update doesn't exist --}}
                                    <button @click="openEditModal({ id: '{{ $age->id }}', nama: '{{ $age->nama }}' })"
                                            class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition-all shadow-sm border border-amber-100">
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                    </button>
                                    @endcan

                                    @can('delete program anak')
                                    <form action="{{ route('age.destroy', ['id' => $age->id]) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus"
                                                data-name="{{ $age->nama }}">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-6 py-12 text-center text-slate-300 italic font-bold">Belum ada data kelompok umur</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Info Card -->
        <div class="hidden lg:block">
            <div class="card-premium p-10 bg-slate-900 text-white relative overflow-hidden h-full flex flex-col justify-center">
                <i data-lucide="help-circle" class="w-64 h-64 text-white/5 absolute -right-16 -bottom-16"></i>
                <div class="relative z-10 space-y-4">
                    <h2 class="text-3xl font-black tracking-tight leading-tight">Master <br><span class="text-red-500 text-shadow-red">Age Groups</span></h2>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed max-w-xs">
                        Pengelompokan umur ini akan digunakan sebagai kategori utama dalam instrumen deteksi dini psikologi anak.
                    </p>
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
                    <form :action="editMode ? '{{ url('q-umur/update') }}/' + formData.id : '{{ route('age.store') }}'" method="POST">
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
                                    <h3 class="text-lg font-black text-slate-800 uppercase italic tracking-tight" x-text="editMode ? 'Ubah Kelompok Umur' : 'Tambah Kelompok Umur'"></h3>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Klasifikasi target deteksi dini</p>
                                </div>
                            </div>
                            <button type="button" @click="modalOpen = false" class="text-slate-400 hover:text-red-500 transition-colors">
                                <i data-lucide="x" class="w-6 h-6"></i>
                            </button>
                        </div>

                        <div class="px-8 py-8 space-y-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Nama / Label Umur</label>
                                <input type="text" name="nama" x-model="formData.nama" required placeholder="Contoh: 0 - 6 Bulan, 1 - 2 Tahun..."
                                       class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 transition-all outline-none italic"
                                       :class="editMode ? 'focus:ring-amber-50' : 'focus:ring-red-50'">
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

