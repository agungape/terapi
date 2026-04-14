@extends('layouts.master')
@section('title', 'Manajemen Otoritas (Permissions)')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500"
     x-data="{ 
        showAddModal: false, 
        showEditModal: false,
        selectedPermissionId: '',
        selectedPermissionName: '',
        isLinkToMenu: false,
        openEdit(id, name) {
            this.selectedPermissionId = id;
            this.selectedPermissionName = name;
            this.showEditModal = true;
        }
     }">
    
    <!-- Sophisticated Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Permissions Management</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Katalog Izin & Otoritas</h2>
        </div>

        @can('create role')
        <button @click="showAddModal = true" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-xl shadow-red-100 italic">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Permission
        </button>
        @endcan
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Main Permission Table -->
        <div class="lg:col-span-8">
            <div class="card-premium overflow-hidden bg-white shadow-xl shadow-slate-200/50">
                <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                        <i data-lucide="lock" class="w-4 h-4 text-red-500"></i> REGISTERED PERMISSIONS
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-16">#</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Descriptor Permission</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Modul Terkait</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($permissions as $permission)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4 text-xs font-bold text-slate-300 italic">{{ $permissions->firstItem() + $loop->iteration - 1 }}</td>
                                <td class="px-6 py-4 text-sm font-black text-slate-700 uppercase tracking-tight italic">{{ $permission->name }}</td>
                                <td class="px-6 py-4">
                                    @if ($permission->menu)
                                        <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-slate-200">
                                            {{ $permission->menu->name }}
                                        </span>
                                    @else
                                        <span class="text-slate-300 italic text-[10px]">Global Permission</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-20 group-hover:opacity-100 transition-opacity">
                                        @can('update permission')
                                        <button @click="openEdit({{ $permission->id }}, '{{ $permission->name }}')" 
                                                class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm border border-blue-100">
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        </button>
                                        @endcan

                                        @can('delete permission')
                                        <form action="{{ route('permissions.destroy', ['permission' => $permission->id]) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus"
                                                    data-name="{{ $permission->name }}">
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
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>

        <!-- Descriptive Info Card -->
        <div class="lg:col-span-4 space-y-8">
            <div class="card-premium p-10 bg-slate-900 text-white relative overflow-hidden h-full">
                <i data-lucide="shield-alert" class="w-40 h-40 text-white/5 absolute -right-8 -bottom-8 rotate-12"></i>
                <div class="relative z-10 space-y-4">
                    <h3 class="text-xl font-black uppercase italic tracking-tight leading-tight">Security <br>Leveling</h3>
                    <p class="text-slate-400 text-xs font-bold leading-relaxed uppercase tracking-wider">
                        Atur izin akses user secara spesifik berdasarkan fungsionalitas menu atau modul sistem.
                    </p>
                    <div class="pt-6">
                        <div class="flex items-center gap-3 p-4 bg-white/5 rounded-2xl border border-white/10">
                            <div class="w-10 h-10 bg-red-500 rounded-xl flex items-center justify-center shadow-lg shadow-red-500/20"><i data-lucide="key" class="w-5 h-5"></i></div>
                            <div>
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Total Active Nodes</p>
                                <p class="text-lg font-black italic">{{ $permissions->total() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals Layout -->
    <template x-if="showAddModal || showEditModal">
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div @click.away="showAddModal = false; showEditModal = false" 
                 class="w-full max-w-lg bg-white rounded-[2.5rem] shadow-2xl overflow-hidden relative"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <button @click="showAddModal = false; showEditModal = false" class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 transition-colors z-10">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>

                <!-- 1. Create Modal -->
                <div x-show="showAddModal">
                    <form action="{{ url('permissions') }}" method="POST">
                        @csrf
                        <div class="p-10 space-y-8">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center shadow-sm border border-red-100">
                                    <i data-lucide="key" class="w-6 h-6"></i>
                                </div>
                                <div class="space-y-0.5">
                                    <h5 class="text-sm font-black uppercase tracking-widest">Generate Permission</h5>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Daftarkan Izin Akses Baru</p>
                                </div>
                            </div>

                            <div class="space-y-5">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Permission</label>
                                    <input type="text" name="name" required placeholder="Contoh: edit profile, view dashboard"
                                           class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none italic">
                                </div>

                                <div class="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-slate-100">
                                    <div class="space-y-0.5">
                                        <p class="text-[10px] font-black text-slate-800 uppercase tracking-widest">Link ke Menu Navigasi?</p>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Izin bersifat spesifik per module</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" x-model="isLinkToMenu">
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500 shadow-sm"></div>
                                    </label>
                                </div>

                                <div x-show="isLinkToMenu" x-transition class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilih Menu Parent</label>
                                    <select name="menu_id" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-emerald-50 transition-all outline-none appearance-none cursor-pointer">
                                        <option value="" disabled selected>Pilih Modul Menu...</option>
                                        @foreach ($menus as $menu)
                                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="pt-2 flex justify-end gap-3">
                                <button type="button" @click="showAddModal = false" class="text-slate-400 py-4 px-8 text-xs font-black uppercase tracking-widest">Batal</button>
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-4 px-10 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-red-100 italic">Create Node</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- 2. Edit Modal -->
                <div x-show="showEditModal">
                    <form :action="`/permissions/${selectedPermissionId}`" method="POST">
                        @csrf @method('PUT')
                        <div class="p-10 space-y-8">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center shadow-sm border border-blue-100">
                                    <i data-lucide="edit-3" class="w-6 h-6"></i>
                                </div>
                                <div class="space-y-0.5">
                                    <h5 class="text-sm font-black uppercase tracking-widest">Modify Authority</h5>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Update Izin Akses Terdaftar</p>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">New Descriptor Name</label>
                                <input type="text" x-model="selectedPermissionName" name="name" required
                                       class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-blue-50 transition-all outline-none italic">
                            </div>

                            <div class="pt-2 flex justify-end gap-3">
                                <button type="button" @click="showEditModal = false" class="text-slate-400 py-4 px-8 text-xs font-black uppercase tracking-widest">Tutup</button>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-4 px-10 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-blue-100 italic transition-all font-bold">Update Node</button>
                            </div>
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
        
        $('.btn-hapus').on('click', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const name = $(this).data('name');

            Swal.fire({
                title: 'Hapus Permission?',
                text: `Izin '${name}' akan dihapus permanen dari sistem.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-[2.5rem]',
                    confirmButton: 'rounded-xl font-bold uppercase text-[11px] px-6 py-3',
                    cancelButton: 'rounded-xl font-bold uppercase text-[11px] px-6 py-3'
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