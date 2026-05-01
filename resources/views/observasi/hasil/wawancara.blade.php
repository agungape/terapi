@extends('layouts.master')
@section('title', 'Hasil Wawancara Pasien')

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
                <span class="text-slate-600">Hasil Wawancara</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Dokumentasi Wawancara Klinis</h2>
        </div>
        
        <a href="{{ route('observasi.show', ['anak' => $anak->id]) }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all italic">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Patient Info Card -->
        <div class="lg:col-span-4 space-y-6">
            <div class="card-premium p-8 bg-white text-center flex flex-col items-center">
                <div class="w-24 h-24 rounded-[2rem] bg-slate-50 border-4 border-white shadow-xl overflow-hidden mb-4">
                    <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/images/faces/face1.jpg') }}" class="w-full h-full object-cover">
                </div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight">{{ $anak->nama }}</h3>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 italic">Summary Wawancara Orang Tua</p>
                
                <div class="w-full grid grid-cols-2 gap-4 mt-8">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[9px] font-black text-slate-400 uppercase mb-1">Usia Pasien</p>
                        <p class="text-xs font-black text-slate-700 uppercase italic">{{ $umur }}</p>
                    </div>
                    <div class="p-4 bg-red-50 rounded-2xl border border-red-100">
                        <p class="text-[9px] font-black text-red-400 uppercase mb-1">Metode</p>
                        <p class="text-xs font-black text-red-600 uppercase italic">Interview</p>
                    </div>
                </div>
            </div>

            <div class="card-premium p-8 bg-slate-900 text-white relative overflow-hidden">
                <i data-lucide="message-square" class="w-32 h-32 absolute -right-4 -bottom-4 text-white/5"></i>
                <h4 class="text-xs font-black uppercase tracking-widest mb-4 italic">Kerahasiaan Data</h4>
                <p class="text-[11px] text-slate-400 font-medium leading-relaxed">
                    Seluruh informasi hasil wawancara bersifat rahasia dan hanya digunakan untuk keperluan diagnosa serta perencanaan program terapi pasien.
                </p>
            </div>
        </div>

        <!-- Q&A Section -->
        <div class="lg:col-span-8">
            <div class="card-premium bg-white overflow-hidden shadow-xl shadow-slate-200/50">
                <div class="px-8 py-6 bg-slate-900 text-white flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                            <i data-lucide="mic" class="w-5 h-5 text-red-500"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-black uppercase tracking-widest mb-0.5">TRANSKRIP JAWABAN INSTRUMEN WAWANCARA</h4>
                            <p class="text-[9px] font-bold text-slate-400 uppercase">Catatan Respon Pasien & Orang Tua</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest w-16">#</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pertanyaan Wawancara</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($qrwawancara as $index => $q)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-5 text-[10px] font-black text-slate-300">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-8 py-5">
                                    <p class="text-xs font-bold text-slate-600 leading-relaxed tracking-tight group-hover:text-slate-900 transition-colors uppercase italic">{{ $q->question_wawancara->question_text ?? 'Pertanyaan tidak ditemukan / dihapus' }}</p>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span class="inline-block px-5 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border {{ strtolower($q->answer) == 'ya' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-red-50 text-red-600 border-red-100' }}">
                                        {{ $q->answer }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="p-8 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4 text-slate-400"></i>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">Tersimpan otomatis: {{ date('d M Y') }}</span>
                    </div>
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

