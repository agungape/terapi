@extends('layouts.master')
@section('title', 'Daftar Observasi & Assesmen')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Layanan Medik & Observasi</span>
        </div>
        
        <div class="flex items-center gap-3">
            <div class="hidden sm:flex items-center gap-2 px-4 py-2 bg-white rounded-xl border border-slate-200 shadow-sm">
                <i data-lucide="clipboard-list" class="w-4 h-4 text-red-500"></i>
                <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest tracking-tighter">Total: {{ $anaks->total() }} Pasien Aktif</span>
            </div>
        </div>
    </div>

    <!-- Info Header Card -->
    <div class="card-premium p-8 bg-slate-900 text-white relative overflow-hidden group">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <h2 class="text-2xl font-black tracking-tight leading-tight italic">Portal Observasi & <br class="hidden md:block">Evaluasi Tumbuh Kembang</h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Pusat Dokumentasi Kemajuan Pasien Bright Star</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="h-12 w-px bg-white/10 hidden md:block"></div>
                <p class="text-[11px] font-medium text-slate-400 max-w-xs text-right hidden md:block leading-relaxed">
                    Pilih pasien dari daftar di bawah untuk memulai pencatatan observasi rutin atau melihat riwayat assessment lengkap.
                </p>
            </div>
        </div>
        <div class="absolute -right-8 -bottom-8 text-white/5 group-hover:scale-110 transition-transform duration-700">
            <i data-lucide="stethoscope" class="w-48 h-48"></i>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="card-premium overflow-hidden bg-white shadow-xl shadow-slate-200/50">
        <div class="p-6 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                <i data-lucide="users" class="w-4 h-4 text-red-500"></i> DIREKTORI PASIEN OBSERVASI
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest w-24">Aksi</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Detail Identitas Pasien</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Informasi Domisili</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Usia</th>
                        <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($anaks as $anak)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-5">
                            @can('create observasi')
                            <a href="{{ route('observasi.show', ['anak' => $anak->id]) }}" 
                               class="flex items-center justify-center w-10 h-10 bg-slate-50 text-slate-400 rounded-xl hover:bg-slate-900 hover:text-white transition-all shadow-sm border border-slate-100" 
                               title="Lihat & Buat Observasi">
                                <i data-lucide="file-spreadsheet" class="w-4 h-4"></i>
                            </a>
                            @endcan
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                    <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/images/faces/face1.jpg') }}" 
                                         class="w-12 h-12 rounded-2xl object-cover border-2 border-white shadow-md">
                                    <div class="absolute -right-1 -bottom-1 w-4 h-4 rounded-full bg-emerald-500 border-2 border-white"></div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xs font-black text-slate-800 uppercase tracking-tight">{{ $anak->nama }}</span>
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">NID: {{ $anak->nib }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="max-w-[200px]">
                                <p class="text-[11px] font-bold text-slate-500 line-clamp-1 italic tracking-tight">{{ $anak->alamat }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-[10px] font-black uppercase tracking-tighter border border-red-100 italic">
                                {{ $anak->usia }} TAHUN
                            </span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[9px] font-black uppercase tracking-widest border border-emerald-100 shadow-sm">
                                {{ $anak->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-24 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <i data-lucide="user-minus" class="w-12 h-12 text-slate-200"></i>
                                <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] italic">Tidak ada data pasien yang tersedia saat ini...</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-end">
            {{ $anaks->fragment('judul')->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection
