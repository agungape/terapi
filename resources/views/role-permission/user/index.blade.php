@extends('layouts.master')
@section('title', 'Manajemen User')

@section('content')
<div x-data="{ 
    showTambah: false, 
    showTambahAnak: false, 
    showTambahTerapis: false, 
    showTambahPsikolog: false,
    showEdit: @json($errors->any() && old('form') == 'edit'),
    editUser: {
        id: '',
        name: '',
        username: '',
        email: '',
        roles: []
    },
    openEdit(user) {
        this.editUser = user;
        this.showEdit = true;
    }
}" class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Sophisticated Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">User Accounts</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Data Login Pengguna</h2>
        </div>

        <!-- Multi-Action Button Group -->
        <div class="grid grid-cols-2 sm:flex sm:flex-wrap gap-2 w-full md:w-auto">
            @can('create user')
            <button @click="showTambah = true" class="px-5 py-2.5 bg-slate-900 hover:bg-black text-white rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-2 transition-all shadow-xl shadow-slate-200">
                <i data-lucide="user-plus" class="w-4 h-4 text-emerald-400"></i> <span class="hidden xs:inline">Akun Admin</span><span class="xs:hidden">Admin</span>
            </button>
            @endcan

            @can('create user anak')
            <button @click="showTambahAnak = true" class="px-5 py-2.5 bg-white border border-slate-200 hover:border-red-500 text-slate-600 hover:text-red-500 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-2 transition-all shadow-sm">
                <i data-lucide="baby" class="w-4 h-4"></i> <span class="hidden xs:inline">Akun Anak</span><span class="xs:hidden">Anak</span>
            </button>
            @endcan

            @can('create user terapis')
            <button @click="showTambahTerapis = true" class="px-5 py-2.5 bg-white border border-slate-200 hover:border-blue-500 text-slate-600 hover:text-blue-500 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-2 transition-all shadow-sm">
                <i data-lucide="heart" class="w-4 h-4"></i> <span class="hidden xs:inline">Akun Terapis</span><span class="xs:hidden">Terapis</span>
            </button>
            @endcan

            @can('create user psikolog')
            <button @click="showTambahPsikolog = true" class="px-5 py-2.5 bg-white border border-slate-200 hover:border-purple-500 text-slate-600 hover:text-purple-500 rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-2 transition-all shadow-sm">
                <i data-lucide="user-check" class="w-4 h-4"></i> <span class="hidden xs:inline">Akun Psikolog</span><span class="xs:hidden">Psikolog</span>
            </button>
            @endcan
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card-premium p-6 bg-white border-none shadow-xl shadow-slate-100/50 flex items-center gap-6">
            <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 shadow-inner">
                <i data-lucide="users" class="w-7 h-7"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Total Pengguna</p>
                <h3 class="text-2xl font-black text-slate-800 italic">{{ $users->total() }}</h3>
            </div>
        </div>
        <div class="card-premium p-6 bg-white border-none shadow-xl shadow-slate-100/50 flex items-center gap-6">
            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 shadow-inner">
                <i data-lucide="shield-check" class="w-7 h-7"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Roles Active</p>
                <h3 class="text-2xl font-black text-slate-800 italic">{{ count($roles) }}</h3>
            </div>
        </div>
        <div class="card-premium p-6 bg-slate-900 border-none shadow-xl shadow-slate-200/50 text-white relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest leading-none mb-1">System Security</p>
                <h3 class="text-xl font-black italic text-emerald-400">ENCRYPTED</h3>
            </div>
            <i data-lucide="fingerprint" class="w-20 h-20 text-white/5 absolute -right-4 -bottom-4 group-hover:scale-110 transition-transform"></i>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="card-premium overflow-hidden bg-white shadow-xl shadow-slate-200/50">
        <div class="p-6 border-b border-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white">
            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                <i data-lucide="database" class="w-4 h-4 text-red-500"></i> REPOSITORY LOGIN DATA
            </h3>

            <form action="{{ route('users.index') }}" method="GET" class="flex items-center gap-2">
                <div class="relative">
                    <i data-lucide="search" class="w-3.5 h-3.5 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari user..."
                           class="pl-10 pr-4 py-2 bg-slate-50 border border-slate-100 rounded-xl text-[10px] font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none w-full md:w-64">
                </div>
                <button type="submit" class="p-2 bg-slate-900 text-white rounded-xl hover:bg-black transition-all">
                    <i data-lucide="filter" class="w-3.5 h-3.5"></i>
                </button>
                @if(request('search'))
                <a href="{{ route('users.index') }}" class="p-2 bg-slate-100 text-slate-500 rounded-xl hover:bg-slate-200 transition-all">
                    <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-12">#</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Identitas Pengguna</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kontak / Login</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status / Last Login</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Otoritas (Role)</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Manajemen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($users as $user)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 text-xs font-bold text-slate-300 italic">#{{ $users->firstItem() + $loop->iteration - 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 font-black text-[10px] uppercase">
                                    {{ substr($user->name, 0, 2) }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xs font-black text-slate-800 uppercase italic tracking-tight group-hover:text-red-600 transition-colors leading-none mb-1">{{ $user->name }}</span>
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter italic">UID: {{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-slate-600 tracking-tight leading-none mb-1">{{ $user->email ?? '-' }}</span>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">{{ $user->username }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1.5">
                                <span class="px-2 py-0.5 {{ $user->is_active ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-red-50 text-red-600 border-red-100' }} border rounded text-[9px] font-black uppercase tracking-widest w-max">
                                    {{ $user->is_active ? 'Aktif' : 'Suspended' }}
                                </span>
                                <span class="text-[10px] font-bold text-slate-400 italic leading-none">{{ $user->last_login_duration ?? 'Belum pernah login' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-black">
                            <div class="flex flex-wrap gap-1">
                                @forelse ($user->getRoleNames() as $rolename)
                                    <span class="px-2 py-1 bg-slate-900 text-white rounded-lg text-[9px] font-black uppercase tracking-tighter">{{ $rolename }}</span>
                                @empty
                                    <span class="text-slate-300 italic text-[10px]">No Role</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                @can('update user')
                                <button type="button" @click='openEdit({{ json_encode([
                                    'id' => $user->id,
                                    'name' => $user->name,
                                    'username' => $user->username,
                                    'email' => $user->email ?? '',
                                    'roles' => $user->getRoleNames()
                                ], JSON_HEX_APOS) }})' class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm border border-blue-100">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                @endcan

                                @can('update status user')
                                <form action="{{ route('users.update-status', $user->id) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="is_active" value="{{ $user->is_active ? 0 : 1 }}">
                                    <button type="submit" class="p-2 {{ $user->is_active ? 'bg-amber-50 text-amber-600 hover:bg-amber-600' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-600' }} rounded-xl hover:text-white transition-all shadow-sm border border-amber-100" 
                                            title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <i data-lucide="{{ $user->is_active ? 'user-minus' : 'user-check' }}" class="w-4 h-4"></i>
                                    </button>
                                </form>
                                @endcan

                                @can('delete user')
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus"
                                            data-name="{{ $user->name }}">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-20 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <i data-lucide="users-2" class="w-16 h-16 text-slate-100"></i>
                                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Belum ada data user yang terdaftar</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50 border-t border-slate-100">
            <div class="overflow-x-auto max-w-full flex justify-center custom-scrollbar pb-2">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Modals (Alpine.js Powered) -->

    {{-- Modal Tambah User Admin --}}
    <div x-show="showTambah" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div x-show="showTambah" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="showTambah = false"></div>
        
        <div x-show="showTambah" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative w-full max-w-lg bg-white rounded-3xl overflow-hidden shadow-2xl">
            <div class="bg-slate-900 text-white p-7 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center"><i data-lucide="user-plus" class="text-emerald-400"></i></div>
                    <div class="space-y-0.5">
                        <h5 class="text-sm font-black uppercase tracking-widest mb-0 leading-none">Registrasi Akun Admin</h5>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Membuat hak akses sistem level internal</p>
                    </div>
                </div>
                <button @click="showTambah = false" class="text-slate-400 hover:text-white transition-colors"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <input type="hidden" name="form" value="tambah">
                <div class="p-8 space-y-6 max-h-[70vh] overflow-y-auto">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap</label>
                            <input type="text" name="name" required class="form-modern-input" placeholder="Nama User">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Username</label>
                            <input type="text" name="username" required class="form-modern-input" placeholder="login_id">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Alamat Email</label>
                        <input type="email" name="email" class="form-modern-input" placeholder="email@example.com">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Password</label>
                            <input type="password" name="password" required class="form-modern-input">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" required class="form-modern-input">
                        </div>
                    </div>
                    <div class="space-y-2 font-bold">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Penugasan Role</label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($roles as $role)
                                <label class="flex items-center gap-2 p-2 rounded-lg border border-slate-100 hover:bg-slate-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="roles[]" value="{{ $role }}" class="w-4 h-4 text-red-500 rounded border-slate-300 focus:ring-red-100">
                                    <span class="text-[10px] font-black uppercase text-slate-600">{{ $role }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 p-6 flex justify-end gap-3">
                    <button type="button" @click="showTambah = false" class="bg-white border border-slate-200 text-slate-500 py-3 px-8 rounded-2xl text-[10px] font-black uppercase tracking-widest">Batal</button>
                    <button type="submit" class="bg-slate-900 hover:bg-black text-white py-3 px-10 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-slate-200 italic transition-all">Submit Registration</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Tambah User Anak --}}
    <div x-show="showTambahAnak" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div x-show="showTambahAnak" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="showTambahAnak = false"></div>
        
        <div x-show="showTambahAnak" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative w-full max-w-lg bg-white rounded-3xl overflow-hidden shadow-2xl">
            <div class="bg-red-600 text-white p-7 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center"><i data-lucide="baby" class="text-white"></i></div>
                    <div class="space-y-0.5">
                        <h5 class="text-sm font-black uppercase tracking-widest mb-0 leading-none">Registrasi Akun Anak</h5>
                        <p class="text-[9px] font-bold text-red-100 uppercase tracking-tighter">Membuat akses untuk pasien / anak</p>
                    </div>
                </div>
                <button @click="showTambahAnak = false" class="text-red-100 hover:text-white transition-colors"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <form action="{{ route('users.store-anak') }}" method="POST">
                @csrf
                <input type="hidden" name="form" value="tambah_anak">
                <div class="p-8 space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pilih Anak</label>
                        <select name="name" required class="form-modern-input appearance-none">
                            <option value="">Pilih Data Anak...</option>
                            @foreach ($anaks as $anak)
                                <option value="{{ $anak->nama }}">{{ $anak->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Username</label>
                        <input type="text" name="username" required class="form-modern-input" placeholder="login_id_anak">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Password</label>
                            <input type="password" name="password" required class="form-modern-input">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Konfirmasi</label>
                            <input type="password" name="password_confirmation" required class="form-modern-input">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Role Akses</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($roles as $role)
                                @if($role == 'anak')
                                <label class="flex items-center gap-2 p-2 px-4 rounded-xl bg-red-50 border border-red-100 text-red-600">
                                    <input type="checkbox" name="roles[]" value="{{ $role }}" checked class="w-4 h-4 text-red-500 rounded border-red-300 focus:ring-red-100">
                                    <span class="text-[10px] font-black uppercase">{{ $role }}</span>
                                </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 p-6 flex justify-end gap-3">
                    <button type="button" @click="showTambahAnak = false" class="bg-white border border-slate-200 text-slate-500 py-3 px-8 rounded-2xl text-[10px] font-black uppercase tracking-widest">Batal</button>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-3 px-10 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-red-100 italic transition-all">Create Account</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Tambah User Terapis --}}
    <div x-show="showTambahTerapis" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div x-show="showTambahTerapis" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="showTambahTerapis = false"></div>
        
        <div x-show="showTambahTerapis" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative w-full max-w-lg bg-white rounded-3xl overflow-hidden shadow-2xl">
            <div class="bg-blue-600 text-white p-7 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center"><i data-lucide="heart" class="text-white"></i></div>
                    <div class="space-y-0.5">
                        <h5 class="text-sm font-black uppercase tracking-widest mb-0 leading-none">Registrasi Akun Terapis</h5>
                        <p class="text-[9px] font-bold text-blue-100 uppercase tracking-tighter">Membuat akses untuk tim medis / terapis</p>
                    </div>
                </div>
                <button @click="showTambahTerapis = false" class="text-blue-100 hover:text-white transition-colors"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <form action="{{ route('users.store-terapis') }}" method="POST">
                @csrf
                <input type="hidden" name="form" value="tambah_terapis">
                <div class="p-8 space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pilih Terapis</label>
                        <select name="terapis" required class="form-modern-input appearance-none">
                            <option value="">Pilih Data Terapis...</option>
                            @foreach ($terapis as $terapi)
                                <option value="{{ $terapi->id }}">{{ $terapi->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Username</label>
                            <input type="text" name="username" required class="form-modern-input" placeholder="login_id">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Email</label>
                            <input type="email" name="email" required class="form-modern-input" placeholder="email@terapi.com">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Password</label>
                            <input type="password" name="password" required class="form-modern-input">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Konfirmasi</label>
                            <input type="password" name="password_confirmation" required class="form-modern-input">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Role Akses</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($roles as $role)
                                @if($role == 'terapis')
                                <label class="flex items-center gap-2 p-2 px-4 rounded-xl bg-blue-50 border border-blue-100 text-blue-600">
                                    <input type="checkbox" name="roles[]" value="{{ $role }}" checked class="w-4 h-4 text-blue-500 rounded border-blue-300 focus:ring-blue-100">
                                    <span class="text-[10px] font-black uppercase">{{ $role }}</span>
                                </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 p-6 flex justify-end gap-3">
                    <button type="button" @click="showTambahTerapis = false" class="bg-white border border-slate-200 text-slate-500 py-3 px-8 rounded-2xl text-[10px] font-black uppercase tracking-widest">Batal</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-10 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-blue-100 italic transition-all">Activate Account</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Tambah User Psikolog --}}
    <div x-show="showTambahPsikolog" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div x-show="showTambahPsikolog" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="showTambahPsikolog = false"></div>
        
        <div x-show="showTambahPsikolog" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative w-full max-w-lg bg-white rounded-3xl overflow-hidden shadow-2xl">
            <div class="bg-purple-600 text-white p-7 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center"><i data-lucide="user-check" class="text-white"></i></div>
                    <div class="space-y-0.5">
                        <h5 class="text-sm font-black uppercase tracking-widest mb-0 leading-none">Registrasi Akun Psikolog</h5>
                        <p class="text-[9px] font-bold text-purple-100 uppercase tracking-tighter">Membuat akses untuk tim psikolog</p>
                    </div>
                </div>
                <button @click="showTambahPsikolog = false" class="text-purple-100 hover:text-white transition-colors"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <form action="{{ route('users.store-psikolog') }}" method="POST">
                @csrf
                <input type="hidden" name="form" value="tambah_psikolog">
                <div class="p-8 space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pilih Psikolog</label>
                        <select name="name" required class="form-modern-input appearance-none">
                            <option value="">Pilih Data Psikolog...</option>
                            @foreach ($psikologs as $psikolog)
                                <option value="{{ $psikolog->nama }}">{{ $psikolog->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Username</label>
                        <input type="text" name="username" required class="form-modern-input" placeholder="login_id_psikolog">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Password</label>
                            <input type="password" name="password" required class="form-modern-input">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Konfirmasi</label>
                            <input type="password" name="password_confirmation" required class="form-modern-input">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Role Akses</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($roles as $role)
                                @if($role == 'psikolog')
                                <label class="flex items-center gap-2 p-2 px-4 rounded-xl bg-purple-50 border border-purple-100 text-purple-600">
                                    <input type="checkbox" name="roles[]" value="{{ $role }}" checked class="w-4 h-4 text-purple-500 rounded border-purple-300 focus:ring-purple-100">
                                    <span class="text-[10px] font-black uppercase">{{ $role }}</span>
                                </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 p-6 flex justify-end gap-3">
                    <button type="button" @click="showTambahPsikolog = false" class="bg-white border border-slate-200 text-slate-500 py-3 px-8 rounded-2xl text-[10px] font-black uppercase tracking-widest">Batal</button>
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-3 px-10 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-purple-100 italic transition-all">Create Account</button>
                </div>
            </form>
        </div>
    </div>
    <div x-show="showEdit" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div x-show="showEdit" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" @click="showEdit = false"></div>
        
        <div x-show="showEdit" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="relative w-full max-w-lg bg-white rounded-3xl overflow-hidden shadow-2xl">
            <div class="bg-blue-600 text-white p-7 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center"><i data-lucide="user-cog" class="text-white"></i></div>
                    <div class="space-y-0.5">
                        <h5 class="text-sm font-black uppercase tracking-widest mb-0 leading-none italic">Update Metadata Account</h5>
                        <p class="text-[9px] font-bold text-blue-100 uppercase tracking-tighter">Modifikasi profile dan link otoritas user</p>
                    </div>
                </div>
                <button @click="showEdit = false" class="text-blue-100 hover:text-white transition-colors"><i data-lucide="x" class="w-5 h-5"></i></button>
            </div>
            <form :action="'{{ route('users.index') }}/' + editUser.id" method="POST">
                @csrf @method('PUT')
                <input type="hidden" name="form" value="edit">
                <div class="p-8 space-y-6 max-h-[70vh] overflow-y-auto">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap</label>
                            <input type="text" name="name" x-model="editUser.name" required class="form-modern-input">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Username</label>
                            <input type="text" name="username" x-model="editUser.username" required class="form-modern-input">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Email Aktif</label>
                        <input type="email" name="email" x-model="editUser.email" class="form-modern-input">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Password Baru</label>
                            <input type="password" name="password" class="form-modern-input" placeholder="Kosongkan jika tidak diubah">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-modern-input">
                        </div>
                    </div>
                    <div class="space-y-2 font-bold">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Penugasan Role</label>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($roles as $role)
                                <label class="flex items-center gap-2 p-2 rounded-lg border border-slate-100 hover:bg-slate-50 cursor-pointer transition-colors">
                                    <input type="checkbox" name="roles[]" value="{{ $role }}" 
                                           :checked="editUser.roles.includes('{{ $role }}')"
                                           class="w-4 h-4 text-blue-500 rounded border-slate-300 focus:ring-blue-100">
                                    <span class="text-[10px] font-black uppercase text-slate-600">{{ $role }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 p-6 flex justify-end gap-3">
                    <button type="button" @click="showEdit = false" class="bg-white border border-slate-200 text-slate-500 py-3 px-8 rounded-2xl text-[10px] font-black uppercase tracking-widest">Tutup</button>
                    <button type="submit" class="bg-blue-600 hover:bg-black text-white py-3 px-10 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-blue-100 transition-all italic tracking-tight">Commit Changes</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<style>
    .form-modern-input {
        width: 100%;
        background-color: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 1rem;
        padding: 0.875rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #1e293b;
        transition: all 0.3s ease;
        outline: none;
    }
    .form-modern-input:focus {
        background-color: #ffffff;
        border-color: #ef4444;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() { 
        if(typeof lucide !== 'undefined') lucide.createIcons(); 
    });
</script>
@endsection
