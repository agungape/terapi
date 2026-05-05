@extends('layouts.master')
@section('title', 'Alat Ukur Psikologi')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span>Alat Ukur</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Data Alat Ukur Psikologi</h2>
        </div>
        @can('create alat ukur')
        <a href="{{ route('alat-ukur.create') }}" class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Alat Ukur
        </a>
        @endcan
    </div>

    <div class="card-premium overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex items-center gap-2">
            <i data-lucide="ruler" class="w-4 h-4 text-red-500"></i>
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">INVENTORI ALAT UKUR</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-12">No</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Alat Ukur</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Domain</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Singkatan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Usia (Bln)</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($alatUkurs as $alatUkur)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 text-xs font-bold text-slate-300 italic">{{ $alatUkurs->firstItem() + $loop->iteration - 1 }}</td>
                        <td class="px-6 py-4 text-xs font-black text-slate-700 uppercase tracking-tight">{{ $alatUkur->nama }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 border border-blue-100 rounded-lg text-[9px] font-black uppercase tracking-widest">{{ $alatUkur->domain_label }}</span>
                        </td>
                        <td class="px-6 py-4 text-xs font-bold text-slate-500">{{ $alatUkur->singkatan ?? '-' }}</td>
                        <td class="px-6 py-4 text-center text-xs font-bold text-slate-500">
                            @if($alatUkur->min_usia_bulan || $alatUkur->max_usia_bulan)
                                {{ $alatUkur->min_usia_bulan ?? 0 }} &mdash; {{ $alatUkur->max_usia_bulan ?? '+' }}
                            @else
                                <span class="text-slate-300 italic">Semua Usia</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border
                                {{ $alatUkur->is_active ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-red-50 text-red-600 border-red-100' }}">
                                {{ $alatUkur->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2 transition-opacity">
                                @can('update alat ukur')
                                <a href="{{ route('alat-ukur.edit', $alatUkur->id) }}" class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition-all shadow-sm border border-amber-100">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </a>
                                @endcan
                                @can('delete alat ukur')
                                <form action="{{ route('alat-ukur.destroy', $alatUkur->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus" data-name="{{ $alatUkur->nama }}">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-20 text-center">
                            <i data-lucide="ruler" class="w-12 h-12 text-slate-100 mx-auto mb-3"></i>
                            <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Belum ada data alat ukur</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-center">
            {{ $alatUkurs->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() { lucide.createIcons(); });
</script>
@endsection
