@extends('layouts.master')
@section('title', 'Hasil Observasi ATEC')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500 pb-20">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <a href="{{ route('observasi.index') }}" class="hover:text-red-500 transition-colors">Observasi</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <a href="{{ route('observasi.show', $anak->id) }}" class="hover:text-red-500 transition-colors">Detail Pasien</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Hasil ATEC</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Evaluasi ATEC (Autism Treatment Evaluation Checklist)</h2>
        </div>
        
        <a href="{{ route('observasi.show', ['anak' => $anak->id]) }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all italic">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Summary Stats -->
        <div class="lg:col-span-4 space-y-6">
            <div class="card-premium p-8 bg-white text-center flex flex-col items-center">
                <div class="w-24 h-24 rounded-[2rem] bg-slate-50 border-4 border-white shadow-xl overflow-hidden mb-4">
                    <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/images/faces/face1.jpg') }}" class="w-full h-full object-cover">
                </div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight">{{ $anak->nama }}</h3>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 italic">Hasil Penilaian ATEC</p>
                
                <div class="w-full mt-8 bg-slate-900 rounded-3xl p-8 text-white shadow-xl shadow-slate-900/20 relative overflow-hidden group">
                    <i data-lucide="bar-chart-3" class="w-24 h-24 absolute -right-4 -top-4 text-white/10 group-hover:scale-110 transition-transform"></i>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] mb-2 opacity-80">Total Score ATEC</p>
                    <div class="flex justify-center items-baseline gap-2">
                        <h2 class="text-5xl font-black italic">{{ $hasil->total_skor }}</h2>
                    </div>
                </div>

                <div class="w-full mt-6 space-y-3 text-left">
                    <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl">
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">I. Bicara/Bahasa</span>
                        <span class="text-xs font-black text-slate-800">{{ $subskor['I'] }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl">
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">II. Bersosialisasi</span>
                        <span class="text-xs font-black text-slate-800">{{ $subskor['II'] }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl">
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">III. Sensori/Kognitif</span>
                        <span class="text-xs font-black text-slate-800">{{ $subskor['III'] }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl">
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">IV. Kesehatan/Fisik</span>
                        <span class="text-xs font-black text-slate-800">{{ $subskor['IV'] }}</span>
                    </div>
                </div>
            </div>

            <div class="card-premium p-8 @if($hasil->total_skor > 50) bg-orange-50 border border-orange-200 @else bg-emerald-50 border border-emerald-200 @endif space-y-4">
                <h4 class="text-xs font-black uppercase tracking-widest flex items-center gap-2 italic @if($hasil->total_skor > 50) text-orange-600 @else text-emerald-600 @endif">
                    <i data-lucide="info" class="w-4 h-4"></i> Interpretasi
                </h4>
                <div class="space-y-3">
                    <div class="flex gap-3 text-[10px] font-black @if($hasil->total_skor > 50) text-orange-900 @else text-emerald-900 @endif leading-relaxed uppercase tracking-wider">
                        <div class="w-1.5 h-1.5 rounded-full @if($hasil->total_skor > 50) bg-orange-500 @else bg-emerald-500 @endif mt-1 shrink-0"></div>
                        <span>@if($hasil->total_skor > 50) Menunjukkan bahwa anak masih perlu untuk di-treatment secara berkelanjutan. @else Menunjukkan perkembangan positif. Lanjutkan observasi dan stimulasi sesuai porsi terapi. @endif</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="lg:col-span-8">
            <div class="card-premium bg-white overflow-hidden shadow-xl shadow-slate-200/50">
                <div class="px-8 py-6 bg-slate-900 text-white flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                            <i data-lucide="eye" class="w-5 h-5 text-red-500"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-black uppercase tracking-widest mb-0.5">INSTITUT PSIKOLOGI BRAIN & HEART</h4>
                            <p class="text-[9px] font-bold text-slate-400 uppercase">Rincian Jawaban ATEC</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto max-h-[800px] custom-scrollbar">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-100 sticky top-0 z-10">
                            <tr>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest w-24">Bagian</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Kriteria / Perilaku</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Skor</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($qratec as $index => $q)
                            @php
                                $question = App\Models\QuestionAtec::find($q->question_atec_id);
                            @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-5 text-[10px] font-black text-slate-400">Bag. {{ $question->section ?? '-' }}</td>
                                <td class="px-8 py-5">
                                    <p class="text-xs font-bold text-slate-600 leading-relaxed tracking-tight uppercase italic">{{ $question->question_text ?? 'Pertanyaan dihapus' }}</p>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-700 text-[10px] font-black border border-slate-200">
                                        {{ $q->answer }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-slate-900 text-white sticky bottom-0 z-10">
                            <tr>
                                <td colspan="2" class="px-8 py-6 text-[10px] font-black uppercase tracking-widest text-right italic">Total Akumulasi</td>
                                <td class="px-8 py-6 text-center">
                                    <span class="text-xl font-black italic text-emerald-400">{{ $hasil->total_skor }}</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
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
