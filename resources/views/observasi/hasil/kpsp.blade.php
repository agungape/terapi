@extends('layouts.master')
@section('title', 'Detail Kuesioner Praskrining Perkembangan (KPSP)')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-pink-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="{{ route('observasi.index') }}" class="hover:text-pink-500 transition-colors">Data Observasi</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="{{ route('observasi.show', $anak->id) }}" class="hover:text-pink-500 transition-colors">Assessment</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Detail KPSP</span>
        </div>
        <a href="{{ route('observasi.show', $anak->id) }}" class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-pink-500 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Assessment
        </a>
    </div>

    <!-- Header Card -->
    <div class="card-premium p-8 bg-white border-none shadow-xl shadow-slate-200/50 relative overflow-hidden group">
        <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
            <div class="w-24 h-24 rounded-[2rem] bg-pink-50 flex items-center justify-center text-pink-500 shadow-inner">
                <i data-lucide="baby" class="w-10 h-10"></i>
            </div>
            <div class="flex-1 text-center md:text-left space-y-2">
                <div class="flex items-center gap-3 justify-center md:justify-start">
                    <h2 class="text-2xl font-black tracking-tight text-slate-800 uppercase italic">Hasil KPSP</h2>
                    <span class="px-3 py-1 bg-pink-100 text-pink-600 rounded-full text-[10px] font-black uppercase tracking-widest">
                        Usia {{ $kpspHasil->kelompokUsia->nama }}
                    </span>
                </div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">{{ $anak->nama }} • Usia Kronologis: {{ $umur }}</p>
                
                <!-- Score Cards -->
                <div class="flex flex-wrap gap-4 mt-4 justify-center md:justify-start">
                    <div class="px-4 py-2 bg-emerald-50 rounded-xl border border-emerald-100 flex items-center gap-3">
                        <div class="p-1.5 bg-emerald-100 text-emerald-600 rounded-lg"><i data-lucide="check" class="w-4 h-4"></i></div>
                        <div>
                            <p class="text-[9px] font-black text-emerald-400 uppercase tracking-widest">Jawaban Ya</p>
                            <p class="text-lg font-black text-emerald-600">{{ $kpspHasil->total_ya }}</p>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-red-50 rounded-xl border border-red-100 flex items-center gap-3">
                        <div class="p-1.5 bg-red-100 text-red-600 rounded-lg"><i data-lucide="x" class="w-4 h-4"></i></div>
                        <div>
                            <p class="text-[9px] font-black text-red-400 uppercase tracking-widest">Jawaban Tidak</p>
                            <p class="text-lg font-black text-red-600">{{ $kpspHasil->total_tidak }}</p>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-{{ $kpspHasil->badge_color }}-50 rounded-xl border border-{{ $kpspHasil->badge_color }}-100 flex items-center gap-3">
                        <div class="p-1.5 bg-{{ $kpspHasil->badge_color }}-100 text-{{ $kpspHasil->badge_color }}-600 rounded-lg"><i data-lucide="activity" class="w-4 h-4"></i></div>
                        <div>
                            <p class="text-[9px] font-black text-{{ $kpspHasil->badge_color }}-400 uppercase tracking-widest">Interpretasi</p>
                            <p class="text-lg font-black text-{{ $kpspHasil->badge_color }}-600 uppercase">{{ $kpspHasil->label_interpretasi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <i data-lucide="activity-square" class="absolute -right-4 -bottom-4 w-48 h-48 text-slate-50 opacity-50 group-hover:scale-110 transition-transform duration-700"></i>
    </div>

    <!-- Questions Table -->
    <div class="card-premium overflow-hidden bg-white shadow-xl shadow-slate-200/50">
        <div class="p-6 border-b border-slate-50 bg-white flex justify-between items-center">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                <i data-lucide="list-todo" class="w-4 h-4 text-pink-500"></i> Rincian Jawaban KPSP
            </h3>
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($kpspHasil->tanggal_pemeriksaan)->translatedFormat('d F Y') }}</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-16 text-center">No</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest w-24 text-center">Bidang</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pertanyaan / Aspek Perkembangan</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center w-24">Hasil</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($kpspJawaban as $index => $item)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 text-xs font-black text-slate-400 text-center">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 bg-slate-100 text-slate-500 rounded text-[9px] font-black uppercase tracking-widest">
                                {{ $item->pertanyaan->bidang }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs font-bold text-slate-700 leading-relaxed">{{ $item->pertanyaan->pertanyaan }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($item->jawaban == 'ya')
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-lg text-[10px] font-black uppercase tracking-widest">YA</span>
                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-600 rounded-lg text-[10px] font-black uppercase tracking-widest">TIDAK</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Legend -->
    <div class="flex gap-4 items-center justify-center p-4">
        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Keterangan Bidang:</span>
        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest"><span class="bg-slate-100 px-1 rounded mr-1 text-slate-400">MK</span> Motorik Kasar</span>
        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest"><span class="bg-slate-100 px-1 rounded mr-1 text-slate-400">MH</span> Motorik Halus</span>
        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest"><span class="bg-slate-100 px-1 rounded mr-1 text-slate-400">B</span> Bahasa</span>
        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest"><span class="bg-slate-100 px-1 rounded mr-1 text-slate-400">PS</span> Personal Sosial</span>
    </div>
</div>
@endsection
