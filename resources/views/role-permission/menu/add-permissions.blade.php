@extends('layouts.master')
@section('title', 'Konfigurasi Hak Akses')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500 pb-20">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <a href="{{ route('menu.index') }}" class="hover:text-red-500 transition-colors">Menu Mapping</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Assign Permissions</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Set Otoritas: {{ $r->name }}</h2>
        </div>
        
        <a href="{{ route('menu.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all italic">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Roles List (Quick Switch) -->
        <div class="lg:col-span-4 space-y-6">
            <div class="card-premium overflow-hidden bg-white">
                <div class="p-6 border-b border-slate-50 flex items-center gap-3">
                    <i data-lucide="layers" class="w-4 h-4 text-red-500"></i>
                    <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest">PILIH ROLE LAIN</h3>
                </div>
                <div class="divide-y divide-slate-50 max-h-[400px] overflow-y-auto scrollbar-hide">
                    @foreach ($roles as $role)
                    <a href="{{ url('roles/' . $role->id . '/give-permissions') }}" 
                       class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 transition-colors {{ $r->id == $role->id ? 'bg-red-50/50' : '' }}">
                        <span class="text-xs font-bold {{ $r->id == $role->id ? 'text-red-600' : 'text-slate-600' }}">{{ $role->name }}</span>
                        @if($r->id == $role->id)
                        <i data-lucide="check" class="w-4 h-4 text-red-500"></i>
                        @endif
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="p-8 bg-slate-900 rounded-[2.5rem] text-white space-y-4 shadow-xl shadow-slate-200 relative overflow-hidden">
                <i data-lucide="shield-check" class="w-32 h-32 text-white/5 absolute -right-4 -bottom-4"></i>
                <h4 class="text-sm font-black uppercase tracking-widest italic">Panduan Cepat</h4>
                <ul class="space-y-3">
                    <li class="flex gap-3 text-[10px] font-bold text-slate-400">
                        <div class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1 shrink-0"></div>
                        <span>Aktifkan switch (hijau) untuk memberikan izin akses pada menu tersebut.</span>
                    </li>
                    <li class="flex gap-3 text-[10px] font-bold text-slate-400">
                        <div class="w-1.5 h-1.5 rounded-full bg-red-500 mt-1 shrink-0"></div>
                        <span>Klik tombol update di bawah untuk menyimpan perubahan.</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Permission Mapper -->
        <div class="lg:col-span-8">
            <form action="{{ url('roles/' . $r->id . '/give-permissions') }}" method="POST">
                @csrf @method('PUT')
                <div class="space-y-6">
                    @foreach ($menus as $menu)
                    <div class="card-premium bg-white overflow-hidden border border-slate-100">
                        <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                            <h4 class="text-xs font-black text-slate-700 uppercase tracking-[0.15em] flex items-center gap-2">
                                <i data-lucide="folder" class="w-4 h-4 text-emerald-500"></i>
                                Modul: {{ $menu->name }}
                            </h4>
                            <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest">{{ count($menu->permissions) }} Endpoints</span>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($menu->permissions as $permission)
                                <div class="flex items-center justify-between p-4 bg-slate-50/50 rounded-2xl border border-slate-100/50 hover:border-emerald-200 hover:bg-emerald-50/20 transition-all group">
                                    <div class="space-y-0.5">
                                        <p class="text-[10px] font-black text-slate-600 uppercase tracking-tighter group-hover:text-emerald-700 transition-colors">{{ $permission->name }}</p>
                                        <p class="text-[8px] font-bold text-slate-400 uppercase">Capability Node</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                               class="sr-only peer" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500 shadow-sm"></div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @if ($otherPermissions->isNotEmpty())
                    <div class="card-premium bg-white overflow-hidden border border-slate-100">
                        <div class="px-6 py-4 bg-slate-900 text-white flex items-center justify-between">
                            <h4 class="text-xs font-black uppercase tracking-[0.15em] flex items-center gap-2 italic">
                                <i data-lucide="box" class="w-4 h-4 text-red-500"></i> Global / Lainnya
                            </h4>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($otherPermissions as $permission)
                                <div class="flex items-center justify-between p-4 bg-slate-50/50 rounded-2xl border border-slate-100/50 filter grayscale group hover:grayscale-0 transition-all">
                                    <div class="space-y-0.5">
                                        <p class="text-[10px] font-black text-slate-600 uppercase tracking-tighter">{{ $permission->name }}</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                               class="sr-only peer" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500 shadow-sm"></div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="mt-10 flex items-center justify-end">
                    <button type="submit" class="group relative px-12 py-4 bg-red-500 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-2xl shadow-red-200 hover:bg-red-600 transition-all flex items-center gap-3">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Simpan Konfigurasi Akses
                        <div class="absolute -right-2 -top-2 w-5 h-5 bg-white text-red-500 rounded-full flex items-center justify-center text-[8px] border border-red-100 shadow-md transform group-hover:scale-110 transition-transform">!</div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() { lucide.createIcons(); });
</script>
@endsection

