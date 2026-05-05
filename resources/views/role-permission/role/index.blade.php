@extends('layouts.master')
@section('title', 'Manajemen Role')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500"
     x-data="{ 
        showAddModal: false, 
        showEditModal: false,
        selectedRoleId: '',
        selectedRoleName: '',
        openEdit(id, name) {
            this.selectedRoleId = id;
            this.selectedRoleName = name;
            this.showEditModal = true;
        }
     }">
    
    <!-- Top Bar / Breadcrumb -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Roles Management</span>
        </div>
        
        @can('create role')
        <button @click="showAddModal = true" class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Role
        </button>
        @endcan
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Roles List Table -->
        <div class="card-premium overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                    <i data-lucide="shield-check" class="w-4 h-4 text-red-500"></i> MASTER DATA ROLES
                </h3>

                <form action="{{ route('roles.index') }}" method="GET" class="flex items-center gap-2">
                    <div class="relative">
                        <i data-lucide="search" class="w-3.5 h-3.5 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Cari role..."
                               class="pl-10 pr-4 py-2 bg-slate-50 border border-slate-100 rounded-xl text-[10px] font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none w-full md:w-48">
                    </div>
                    <button type="submit" class="p-2 bg-slate-900 text-white rounded-xl hover:bg-black transition-all">
                        <i data-lucide="filter" class="w-3.5 h-3.5"></i>
                    </button>
                    @if(request('search'))
                    <a href="{{ route('roles.index') }}" class="p-2 bg-slate-100 text-slate-500 rounded-xl hover:bg-slate-200 transition-all">
                        <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                    </a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-16">#</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Role / Group</th>
                            <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($roles as $role)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 text-xs font-bold text-slate-400 italic">{{ $roles->firstItem() + $loop->iteration - 1 }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg text-[10px] font-black uppercase tracking-tighter border border-red-100 shadow-sm shadow-red-50/50">
                                    {{ $role->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @can('update role')
                                    <button @click="openEdit({{ $role->id }}, '{{ $role->name }}')" 
                                            class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition-all shadow-sm border border-amber-100">
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                    </button>
                                    @endcan

                                    @can('delete role')
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus"
                                                data-name="{{ $role->name }}">
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
                {{ $roles->links() }}
            </div>
        </div>

        <!-- Info Card (MCU Accent) -->
        <div class="hidden lg:block">
            <div class="card-premium p-10 bg-gradient-to-br from-slate-900 to-slate-800 text-white relative overflow-hidden h-full flex flex-col justify-center">
                <i data-lucide="lock" class="w-64 h-64 text-white/5 absolute -right-16 -bottom-16"></i>
                <div class="relative z-10 space-y-4">
                    <h2 class="text-3xl font-black tracking-tight leading-tight">Keamanan & <br><span class="text-red-500 italic">Hak Akses</span></h2>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed max-w-xs">
                        Kelola peran pengguna dengan teliti. Memberikan akses yang tepat memastikan integritas data dan efisiensi operasional sistem.
                    </p>
                    <div class="pt-6 flex gap-4">
                        <div class="flex flex-col">
                            <span class="text-2xl font-black text-red-500">{{ $roles->total() }}</span>
                            <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Total Active Roles</span>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <!-- Modals Layout -->
    <div x-show="showAddModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click.away="showAddModal = false" 
             class="w-full max-w-md bg-white rounded-[2.5rem] shadow-2xl overflow-hidden relative"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            
            <button @click="showAddModal = false" class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 transition-colors z-10">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>

            <!-- 1. Add Modal Body -->
            <form action="{{ url('roles') }}" method="POST">
                @csrf
                <div class="p-10 space-y-8">
                    <div class="space-y-2">
                        <h5 class="text-sm font-black uppercase tracking-widest text-slate-800 flex items-center gap-2">
                            <i data-lucide="plus-circle" class="w-5 h-5 text-red-500"></i> Tambah Role Baru
                        </h5>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Daftarkan Group User Baru</p>
                    </div>

                    @if($errors->any())
                    <div class="p-4 bg-red-50 border border-red-100 rounded-2xl">
                        @foreach($errors->all() as $error)
                            <p class="text-[10px] font-bold text-red-600 uppercase tracking-tight">{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Role</label>
                        <input type="text" name="name" placeholder="Misal: Manager, Keuangan..." required
                               class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none italic placeholder:text-slate-300">
                    </div>

                    <div class="pt-4 flex justify-end gap-3">
                        <button type="button" @click="showAddModal = false" class="text-slate-400 py-3 px-6 text-[10px] font-black uppercase tracking-widest">Batal</button>
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-3.5 px-10 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-red-100 italic transition-all">Simpan Role</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div x-show="showEditModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click.away="showEditModal = false" 
             class="w-full max-w-md bg-white rounded-[2.5rem] shadow-2xl overflow-hidden relative"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            
            <button @click="showEditModal = false" class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 transition-colors z-10">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>

            <!-- 2. Edit Modal Body -->
            <form :action="`/roles/${selectedRoleId}`" method="POST">
                @csrf @method('PUT')
                <div class="p-10 space-y-8">
                    <div class="space-y-2">
                        <h5 class="text-sm font-black uppercase tracking-widest text-slate-800 flex items-center gap-2">
                            <i data-lucide="edit-3" class="w-5 h-5 text-amber-500"></i> Modifikasi Role
                        </h5>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Update Identitas Peran</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Role Baru</label>
                        <input type="text" x-model="selectedRoleName" name="name" required
                               class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-amber-50 transition-all outline-none italic">
                    </div>

                    <div class="pt-4 flex justify-end gap-3">
                        <button type="button" @click="showEditModal = false" class="text-slate-400 py-3 px-6 text-[10px] font-black uppercase tracking-widest">Tutup</button>
                        <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white py-3.5 px-10 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-amber-100 italic transition-all font-bold">Update Role</button>
                    </div>
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
        
        $('.btn-hapus').on('click', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const name = $(this).data('name');

            Swal.fire({
                title: 'Hapus Role?',
                text: `Peran '${name}' akan dihapus permanen.`,
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
