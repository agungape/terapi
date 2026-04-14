@extends('layouts.master')
@section('title', 'Manajemen Pengguna')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500"
     x-data="{ 
        showAddModal: false, 
        showEditModal: false,
        selectedUserId: '',
        selectedUserName: '',
        selectedUserEmail: '',
        selectedUserUsername: '',
        selectedUserRole: '',
        openEdit(user) {
            this.selectedUserId = user.id;
            this.selectedUserName = user.name;
            this.selectedUserEmail = user.email;
            this.selectedUserUsername = user.username;
            this.selectedUserRole = user.role_id;
            this.showEditModal = true;
        }
     }">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Access Control</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">User / Pengguna</h2>
        </div>
        
        @can('create user')
        <button @click="showAddModal = true" class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
            <i data-lucide="user-plus" class="w-4 h-4"></i> Tambah User
        </button>
        @endcan
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card-premium p-6 bg-white flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Pengguna</p>
                <h3 class="text-xl font-black text-slate-800">{{ $users->total() }}</h3>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card-premium overflow-hidden bg-white">
        <div class="p-6 border-b border-slate-50 flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-red-500 shrink-0">
                <i data-lucide="shield-check" class="w-4 h-4"></i>
            </div>
            <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest">DAFTAR AKUN PENGGUNA SISTEM</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-16">#</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Username</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Email</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Level / Role</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Last Login</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($users as $user)
                    <tr class="hover:bg-slate-50/50 transition-colors group/row">
                        <td class="px-6 py-4 text-xs font-bold text-slate-400">{{ $users->firstItem() + $loop->iteration - 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 font-black text-[10px] uppercase">
                                    {{ substr($user->username, 0, 2) }}
                                </div>
                                <span class="text-xs font-black text-slate-700 uppercase tracking-tight">{{ $user->username }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold text-slate-500 italic">{{ $user->email }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach ($user->getRoleNames() as $rolename)
                                <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-md text-[9px] font-black uppercase tracking-tighter border border-blue-100">
                                    {{ $rolename }}
                                </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-[10px] font-bold text-slate-400 uppercase">{{ $user->last_login_duration ?? 'Never' }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                @can('update user')
                                <button type="button" @click="openEdit({
                                            id: '{{ $user->id }}',
                                            name: '{{ $user->name }}',
                                            email: '{{ $user->email }}',
                                            username: '{{ $user->username }}',
                                            role_id: '{{ $user->roles->first()->id ?? '' }}'
                                        })"
                                        class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition-all shadow-sm border border-amber-100">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </button>
                                @endcan

                                @can('delete user')
                                <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus"
                                            data-name="{{ $user->username }}">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400 font-bold uppercase tracking-widest text-[10px]">
                            Tidak ada data pengguna ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-center">
            {{ $users->links() }}
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
                 class="w-full max-w-xl bg-white rounded-[2.5rem] shadow-2xl overflow-hidden relative"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <button @click="showAddModal = false; showEditModal = false" class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 transition-colors z-10">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>

                <!-- 1. Add User Body -->
                <div x-show="showAddModal">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="p-10 space-y-8">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center border border-red-100">
                                    <i data-lucide="user-plus" class="w-6 h-6"></i>
                                </div>
                                <div class="space-y-0.5">
                                    <h5 class="text-sm font-black uppercase tracking-widest text-slate-800">Tambah User Baru</h5>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Registrasi Akun Pengguna</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilih Terapis / Nama</label>
                                    <select name="name" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none italic cursor-pointer">
                                        @foreach ($terapis as $terapi)
                                        <option value="{{ $terapi->nama }}">{{ $terapi->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Username</label>
                                        <input type="text" name="username" required placeholder="User ID..."
                                               class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Level / Role</label>
                                        <select name="role" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none italic cursor-pointer">
                                            @foreach ($role as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Address</label>
                                    <input type="email" name="email" required placeholder="email@example.com"
                                           class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none uppercase italic">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Password</label>
                                        <input type="password" name="password" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Confirm</label>
                                        <input type="password" name="password_confirmation" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 flex justify-end gap-3">
                                <button type="button" @click="showAddModal = false" class="text-slate-400 py-4 px-8 text-xs font-black uppercase tracking-widest">Batal</button>
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-4 px-12 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-red-100 italic transition-all">Simpan Akun</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- 2. Edit User Body -->
                <div x-show="showEditModal">
                    <form :action="`/users/${selectedUserId}`" method="POST">
                        @csrf @method('PUT')
                        <div class="p-10 space-y-8">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-amber-50 text-amber-500 rounded-2xl flex items-center justify-center border border-amber-100">
                                    <i data-lucide="user-cog" class="w-6 h-6"></i>
                                </div>
                                <div class="space-y-0.5">
                                    <h5 class="text-sm font-black uppercase tracking-widest text-slate-800">Update Data User</h5>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Modifikasi Akun Pengguna</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                                    <input type="text" x-model="selectedUserName" name="name_edit" required
                                           class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-amber-50 transition-all outline-none italic">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Username</label>
                                        <input type="text" x-model="selectedUserUsername" name="username_edit" required
                                               class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-amber-50 transition-all outline-none italic">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Level / Role</label>
                                        <select x-model="selectedUserRole" name="role_edit" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-amber-50 transition-all outline-none italic cursor-pointer">
                                            @foreach ($role as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email Address</label>
                                    <input type="email" x-model="selectedUserEmail" name="email_edit" required
                                           class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-amber-50 transition-all outline-none italic">
                                </div>

                                <div class="p-6 bg-slate-900 rounded-3xl border border-slate-800 space-y-4 shadow-xl">
                                    <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest italic">Update Keamanan (Opsional)</p>
                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="password" name="password_edit" class="w-full bg-white/5 border-none rounded-xl px-4 py-3 text-xs font-bold text-white transition-all outline-none placeholder:text-slate-600 focus:ring-1 focus:ring-amber-500" placeholder="Password Baru">
                                        <input type="password" name="password_confirmation_edit" class="w-full bg-white/5 border-none rounded-xl px-4 py-3 text-xs font-bold text-white transition-all outline-none placeholder:text-slate-600 focus:ring-1 focus:ring-amber-500" placeholder="Konfirmasi">
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 flex justify-end gap-3">
                                <button type="button" @click="showEditModal = false" class="text-slate-400 py-4 px-8 text-xs font-black uppercase tracking-widest">Tutup</button>
                                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white py-4 px-12 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-amber-100 italic transition-all font-bold">Update Akses</button>
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
                title: 'Hapus User?',
                text: `Akun '${name}' akan dihapus permanen.`,
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
