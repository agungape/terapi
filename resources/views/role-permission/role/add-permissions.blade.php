@extends('layouts.master')
@section('title', 'Konfigurasi Hak Akses Role')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Premium Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <a href="{{ route('roles.index') }}" class="hover:text-red-500 transition-colors">Roles</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Permissions Assignment</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Assignment Map: Otoritas & Role</h2>
        </div>

        @can('create role')
        <button data-toggle="modal" data-target="#exampleModal" class="px-6 py-2.5 bg-slate-900 hover:bg-black text-white rounded-xl text-[10px] font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-xl shadow-slate-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Create New Role
        </button>
        @endcan
    </div>

    <!-- Main Workspace Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Section: Roles Navigator -->
        <div class="lg:col-span-5 space-y-6">
            <div class="card-premium overflow-hidden bg-white shadow-xl shadow-slate-200/50">
                <div class="p-6 border-b border-slate-50">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                        <i data-lucide="shield" class="w-4 h-4 text-red-500"></i> SELECT ROLE TO CONFIGURE
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-12">#</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Role Name</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($roles as $r)
                            <tr class="transition-colors {{ $r->id == $role->id ? 'bg-red-50/50' : 'hover:bg-slate-50/70' }}">
                                <td class="px-6 py-4 text-xs font-bold text-slate-300 italic">{{ $roles->firstItem() + $loop->iteration - 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($r->id == $role->id)
                                            <div class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></div>
                                        @endif
                                        <span class="text-xs font-black uppercase italic tracking-tight {{ $r->id == $role->id ? 'text-red-700' : 'text-slate-700' }}">
                                            {{ $r->name }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ url('roles/' . $r->id . '/give-permissions') }}" 
                                           class="p-2 {{ $r->id == $role->id ? 'bg-red-500 text-white shadow-lg shadow-red-200' : 'bg-white text-slate-400 border border-slate-200' }} rounded-lg transition-all"
                                           title="Configure Permissions">
                                            <i data-lucide="settings-2" class="w-3.5 h-3.5"></i>
                                        </a>
                                        <button onclick="openEditModal({{ $r->id }}, '{{ $r->name }}')" 
                                                class="p-2 bg-white text-slate-400 border border-slate-200 rounded-lg hover:text-blue-600 transition-all">
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-center">
                    {{ $roles->fragment('judul')->links() }}
                </div>
            </div>
        </div>

        <!-- Right Section: Permission Assignment Matrix -->
        <div class="lg:col-span-7">
            <div class="card-premium bg-white shadow-2xl shadow-slate-200/50 border-none overflow-hidden">
                <div class="p-8 bg-slate-900 text-white relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="relative z-10 space-y-1">
                        <p class="text-[10px] font-black text-red-500 uppercase tracking-widest leading-none">Configuring Security Target</p>
                        <h3 class="text-2xl font-black uppercase italic tracking-tight">ROLE: {{ $role->name }}</h3>
                    </div>
                    <div class="relative z-10 flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Nodes Assigned</p>
                            <p class="text-lg font-black text-emerald-400 italic leading-none">{{ count($rolePermissions) }} / {{ count($permissions) }}</p>
                        </div>
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-white border border-white/10">
                            <i data-lucide="shield-check" class="w-6 h-6"></i>
                        </div>
                    </div>
                    <i data-lucide="fingerprint" class="w-48 h-48 text-white/5 absolute -right-8 -bottom-8"></i>
                </div>

                <div class="p-8">
                    <form action="{{ url('roles/' . $role->id . '/give-permissions') }}" method="POST" class="space-y-8">
                        @csrf @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($permissions as $permission)
                            <label class="relative block cursor-pointer group">
                                <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                       {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                       class="hidden peer">
                                <div class="p-5 bg-slate-50 border-2 border-transparent rounded-2xl transition-all peer-checked:bg-white peer-checked:border-red-500 peer-checked:shadow-xl group-hover:bg-slate-100/50 flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-5 h-5 rounded-lg border-2 border-slate-200 peer-checked:border-red-500 flex items-center justify-center transition-all bg-white relative">
                                            <div class="w-2.5 h-2.5 rounded-[3px] bg-red-500 opacity-0 group-has-[:checked]:opacity-100 transition-opacity"></div>
                                        </div>
                                        <span class="text-[11px] font-black text-slate-600 uppercase tracking-tight group-has-[:checked]:text-slate-900 transition-colors italic">
                                            {{ $permission->name }}
                                        </span>
                                    </div>
                                    <i data-lucide="unlock" class="w-3 h-3 text-slate-200 group-has-[:checked]:text-emerald-400 transition-colors"></i>
                                </div>
                            </label>
                            @endforeach
                        </div>

                        <div class="pt-8 border-t border-slate-50 flex flex-col sm:flex-row justify-between items-center gap-6">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest max-w-[250px] italic">
                                Pastikan anda memahami implikasi keamanan sebelum menberikan izin administratif.
                            </p>
                            <button type="submit" class="w-full sm:w-max bg-slate-900 hover:bg-black text-white px-12 py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-2xl transition-all italic">
                                Synchronize Authorities
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Modals -->
<form action="{{ url('roles') }}" method="POST">
    @csrf
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-none rounded-3xl overflow-hidden shadow-2xl">
                <div class="modal-header border-none bg-slate-900 text-white p-7">
                    <h5 class="text-sm font-black uppercase tracking-widest mb-0 italic">Generate New Role</h5>
                    <button type="button" class="text-slate-400 hover:text-white" data-dismiss="modal"><i data-lucide="x" class="w-5 h-5"></i></button>
                </div>
                <div class="modal-body p-8 space-y-4">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Internal Identifier Name</label>
                        <input type="text" name="name" required placeholder="Misal: accounting, therapy_lead"
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-black focus:ring-4 focus:ring-red-50 transition-all outline-none italic">
                    </div>
                </div>
                <div class="modal-footer bg-slate-50 p-6 flex justify-end gap-3">
                    <button type="button" class="bg-white border border-slate-200 text-slate-500 py-3 px-8 rounded-2xl text-[10px] font-black uppercase tracking-widest" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-3 px-10 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-red-100">Create Role</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="editRoleForm" method="POST">
            @csrf @method('PUT')
            <div class="modal-content border-none rounded-3xl overflow-hidden shadow-2xl">
                <div class="modal-header border-none bg-blue-600 text-white p-7">
                    <h5 class="text-sm font-black uppercase tracking-widest mb-0">Modify Identity Role</h5>
                    <button type="button" class="text-blue-100 hover:text-white" data-dismiss="modal"><i data-lucide="x" class="w-5 h-5"></i></button>
                </div>
                <div class="modal-body p-8 space-y-4">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Update Descriptor Name</label>
                        <input type="text" id="editRoleName" name="name" required
                               class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-sm font-black focus:ring-4 focus:ring-blue-50 transition-all outline-none italic">
                    </div>
                </div>
                <div class="modal-footer bg-slate-50 p-6 flex justify-end gap-3">
                    <button type="button" class="bg-white border border-slate-200 text-slate-500 py-3 px-8 rounded-2xl text-[10px] font-black uppercase tracking-widest" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-10 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-blue-100">Update Authority</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() { lucide.createIcons(); });

    function openEditModal(roleId, roleName) {
        document.getElementById('editRoleForm').action = `/roles/${roleId}`;
        document.getElementById('editRoleName').value = roleName;
        $('#editRoleModal').modal('show');
    }
</script>
@endsection
