@extends('layouts.master')
@section('title', 'Data Pelamar Karir')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span>Data Career</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Manajemen Pelamar</h2>
        </div>
    </div>

    <div class="card-premium overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex items-center gap-2">
            <i data-lucide="briefcase" class="w-4 h-4 text-red-500"></i>
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">REPOSITORY LAMARAN MASUK</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tgl. Registrasi</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Pelamar</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pendidikan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kualifikasi</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pengalaman</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Motivasi</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Telepon</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($career as $c)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 text-xs font-bold text-slate-500 whitespace-nowrap">{{ \Carbon\Carbon::parse($c->updated_at)->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-[10px] font-black text-slate-500">
                                    {{ strtoupper(substr($c->nama, 0, 2)) }}
                                </div>
                                <span class="text-xs font-black text-slate-700 uppercase tracking-tight">{{ $c->nama }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs font-bold text-slate-600">{{ $c->pendidikan }}</td>
                        <td class="px-6 py-4 text-xs font-bold text-slate-600 max-w-[180px]">
                            <p class="line-clamp-2 leading-relaxed">{{ $c->kualifikasi }}</p>
                        </td>
                        <td class="px-6 py-4 text-xs font-bold text-slate-600 max-w-[180px]">
                            <p class="line-clamp-2 leading-relaxed">{{ $c->pengalaman }}</p>
                        </td>
                        <td class="px-6 py-4 text-xs font-bold text-slate-600 max-w-[200px]">
                            <p class="line-clamp-2 leading-relaxed italic">{{ $c->motivasi }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-slate-600">{{ $c->telepon }}</span>
                                @if($c->telepon)
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^\d]/', '', $c->telepon)) }}" target="_blank"
                                   class="p-1 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-600 hover:text-white transition-all">
                                    <i data-lucide="message-circle" class="w-3 h-3"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-20 text-center">
                            <i data-lucide="briefcase" class="w-12 h-12 text-slate-100 mx-auto mb-3"></i>
                            <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Belum ada data lamaran masuk</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-center">
            {{ $career->fragment('judul')->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() { lucide.createIcons(); });
</script>
@endsection
