@extends('layouts.master')
@section('title', 'Manajemen Menu & Akses')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Top Bar / Breadcrumb -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Permissions Mapping</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Manajemen Hubungan Menu</h2>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Main Content (Roles List) -->
        <div class="lg:col-span-8">
            <div class="card-premium overflow-hidden bg-white">
                <div class="p-6 border-b border-slate-50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-500 shrink-0">
                        <i data-lucide="layout-template" class="w-4 h-4"></i>
                    </div>
                    <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest">HUBUNGKAN PERMISSION KE ROLE & MENU</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-16">#</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Role / Group</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Opsi Pengaturan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($roles as $role)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4 text-xs font-bold text-slate-400">{{ $roles->firstItem() + $loop->iteration - 1 }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-black text-slate-700 uppercase tracking-tight">{{ $role->name }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ url('roles/' . $role->id . '/give-permissions') }}" 
                                       class="inline-flex items-center gap-2 px-5 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-emerald-100 italic">
                                        <i data-lucide="key" class="w-3.5 h-3.5"></i>
                                        Configure Permissions
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-center">
                    {{ $roles->fragment('judul')->links() }}
                </div>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="lg:col-span-4 space-y-6">
            <div class="card-premium p-10 bg-slate-900 text-white relative overflow-hidden">
                <i data-lucide="cog" class="w-40 h-40 text-white/5 absolute -right-8 -bottom-8"></i>
                <div class="relative z-10 space-y-4">
                    <h3 class="text-xl font-black uppercase italic tracking-tight leading-tight">Menu <br>Architecture</h3>
                    <p class="text-slate-400 text-[10px] font-bold leading-relaxed uppercase tracking-wider">
                        Gunakan modul ini untuk memetakan permission secara visual berdasarkan struktur menu navigasi yang ada di sistem.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() { lucide.createIcons(); });
</script>
@endsection

