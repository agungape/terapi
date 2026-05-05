@extends('layouts.master')
@section('title', 'Data Psikolog')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500"
     x-data="{ 
        modalOpen: false, 
        editMode: false, 
        formData: {
            id: '',
            nama: '',
            str: '',
            sipp: '',
            alamat: '',
            telepon: ''
        },
        openCreateModal() {
            this.editMode = false;
            this.formData = { id: '', nama: '', str: '', sipp: '', alamat: '', telepon: '' };
            this.modalOpen = true;
        },
        openEditModal(data) {
            this.editMode = true;
            this.formData = { 
                id: data.id, 
                nama: data.nama, 
                str: data.str,
                sipp: data.sipp,
                alamat: data.alamat, 
                telepon: data.telepon 
            };
            this.modalOpen = true;
        }
     }">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Master Data Psikolog</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Data Psikolog</h2>
        </div>
        @can('create psikolog')
        <button @click="openCreateModal()" class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Psikolog
        </button>
        @endcan
    </div>

    {{-- Table --}}
    <div class="card-premium overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                <i data-lucide="brain" class="w-4 h-4 text-red-500"></i> DAFTAR PSIKOLOG TERDAFTAR
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-12">#</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Psikolog</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">STR / SIPP</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Alamat</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Telepon</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($psikolog as $p)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 text-xs font-bold text-slate-300 italic">{{ $psikolog->firstItem() + $loop->iteration - 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-500 font-black text-xs">
                                    {{ strtoupper(substr($p->nama, 0, 2)) }}
                                </div>
                                <span class="text-xs font-black text-slate-700 uppercase tracking-tight group-hover:text-red-500 transition-colors">{{ $p->nama }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <p class="text-[10px] font-bold text-slate-500">STR: <span class="text-slate-800">{{ $p->str ?? '-' }}</span></p>
                                <p class="text-[10px] font-bold text-slate-500">SIPP: <span class="text-slate-800">{{ $p->sipp ?? '-' }}</span></p>
                            </div>
                        </td>
                        <td class="px-6 py-4 max-w-[250px]">
                            <p class="text-xs font-bold text-slate-500 line-clamp-2">{{ $p->alamat ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-slate-600">{{ $p->telepon ?? '-' }}</span>
                                @if($p->telepon)
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^\d]/', '', $p->telepon)) }}" target="_blank"
                                   class="p-1 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-600 hover:text-white transition-all">
                                    <i data-lucide="message-circle" class="w-3 h-3"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2 transition-opacity">
                                @can('update psikolog')
                                <button @click="openEditModal({ id: '{{ $p->id }}', nama: '{{ $p->nama }}', str: '{{ $p->str }}', sipp: '{{ $p->sipp }}', alamat: `{!! addslashes($p->alamat) !!}`, telepon: '{{ $p->telepon }}' })"
                                   class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition-all shadow-sm border border-amber-100">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </button>
                                @endcan
                                @can('delete psikolog')
                                <form action="{{ route('psikolog.destroy', ['psikolog' => $p->id]) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus"
                                            data-name="{{ $p->nama }}">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <i data-lucide="brain" class="w-12 h-12 text-slate-100 mx-auto mb-3"></i>
                            <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Belum ada data psikolog</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50/50 border-t border-slate-100">
            <div class="overflow-x-auto max-w-full flex justify-center custom-scrollbar pb-2">
                {{ $psikolog->fragment('judul')->links() }}
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
                    <form :action="editMode ? '{{ url('psikolog') }}/' + formData.id : '{{ route('psikolog.store') }}'" method="POST">
                        @csrf
                        <template x-if="editMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-red-500 text-white flex items-center justify-center shadow-lg shadow-red-200">
                                    <i data-lucide="brain" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-black text-slate-800 uppercase italic tracking-tight" x-text="editMode ? 'Ubah Data Psikolog' : 'Tambah Psikolog Baru'"></h3>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Lengkapi data tim psikolog ahli</p>
                                </div>
                            </div>
                            <button type="button" @click="modalOpen = false" class="text-slate-400 hover:text-red-500 transition-colors">
                                <i data-lucide="x" class="w-6 h-6"></i>
                            </button>
                        </div>

                        <div class="px-8 py-8 space-y-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Nama Lengkap & Gelar</label>
                                <input type="text" name="nama" x-model="formData.nama" required placeholder="dr. Name, M.Psi..."
                                       class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Nomor STR</label>
                                    <input type="text" name="str" x-model="formData.str" placeholder="XP00..."
                                           class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Nomor SIPP</label>
                                    <input type="text" name="sipp" x-model="formData.sipp" placeholder="2013..."
                                           class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Nomor HP / WA</label>
                                <input type="text" name="telepon" x-model="formData.telepon" required placeholder="08..."
                                       class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Alamat Praktik</label>
                                <textarea name="alamat" x-model="formData.alamat" rows="3" required placeholder="Jl. Raya..."
                                          class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none resize-none"></textarea>
                            </div>
                        </div>

                        <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3 rounded-b-3xl">
                            <button type="button" @click="modalOpen = false" class="px-6 py-3 bg-white border border-slate-200 text-slate-500 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Batal</button>
                            <button type="submit" class="px-8 py-3 bg-red-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-600 shadow-lg shadow-red-100 transition-all flex items-center gap-2 italic">
                                <span x-text="editMode ? 'Simpan Perubahan' : 'Daftarkan Psikolog'"></span>
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
