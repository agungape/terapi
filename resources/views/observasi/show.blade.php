@extends('layouts.master')
@section('title', 'Ruang Observasi & Assessment')

@section('content')
<div x-data="{ 
    modalOpen: false, 
    modalType: '',
    modalData: {},
    openModal(type, data = {}) { 
        this.modalType = type; 
        this.modalData = data;
        this.modalOpen = true; 
        document.body.classList.add('overflow-hidden');
    },
    closeModal() { 
        this.modalOpen = false; 
        this.modalData = {};
        document.body.classList.remove('overflow-hidden');
    }
}" class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Premium Patient Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="{{ route('observasi.index') }}" class="hover:text-red-500 transition-colors">Data Observasi</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Assessment Detail</span>
        </div>
        <a href="{{ route('observasi.index') }}" class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-red-500 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    <!-- Main Identity Card -->
    <div class="card-premium p-8 bg-white border-none shadow-xl shadow-slate-200/50 relative overflow-hidden group">
        <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
            <div class="relative">
                <div class="w-32 h-32 rounded-[2.5rem] bg-slate-50 border-4 border-white shadow-2xl overflow-hidden">
                    <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/images/faces/face1.jpg') }}" 
                         class="w-full h-full object-cover">
                </div>
                <div class="absolute -right-2 -bottom-2 w-10 h-10 bg-emerald-500 rounded-2xl border-4 border-white flex items-center justify-center text-white shadow-lg">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
            </div>

            <div class="flex-1 text-center md:text-left space-y-2">
                <div class="flex flex-col md:flex-row md:items-center gap-3">
                    <h2 class="text-3xl font-black tracking-tight text-slate-800 uppercase italic">{{ $anak->nama }}</h2>
                    <span class="px-4 py-1.5 bg-red-500 text-white rounded-full text-[10px] font-black uppercase tracking-widest w-max mx-auto md:mx-0 shadow-lg shadow-red-100">
                        {{ $umur }} - ANAK AKTIF
                    </span>
                </div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.3em]">ID ANAK: {{ $anak->nib }} • TERDAFTAR: {{ \Carbon\Carbon::parse($anak->created_at)->format('d F Y') }}</p>
                <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-4">
                    <div class="flex items-center gap-2 px-3 py-1 bg-slate-50 rounded-lg text-slate-500 text-[10px] font-bold">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5"></i> {{ Str::limit($anak->alamat, 40) }}
                    </div>
                    <div class="flex items-center gap-2 px-3 py-1 bg-blue-50 rounded-lg text-blue-600 text-[10px] font-bold">
                        <i data-lucide="heart" class="w-3.5 h-3.5"></i> {{ $anak->jenis_kelamin == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN' }}
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col gap-2">
                <button type="button" @click="document.getElementById('form-cetak').scrollIntoView({behavior: 'smooth'})" 
                        class="bg-slate-900 text-white px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-black transition-all shadow-lg flex items-center gap-2">
                    <i data-lucide="printer" class="w-4 h-4"></i> Cetak PDF
                </button>
            </div>
        </div>
        <div class="absolute -right-4 -top-4 text-slate-50 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-700">
            <i data-lucide="dna" class="w-48 h-48 opacity-10"></i>
        </div>
    </div>

    <!-- Diagnostic Dashboard Grid -->
    <div class="space-y-6">
        <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
            <i data-lucide="grid" class="w-4 h-4 text-red-500"></i> Clinical Diagnostic Center
        </h4>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 lg:gap-4">
            <!-- CHAT -->
            <button @click="openModal('autis')" class="card-premium p-6 bg-white hover:bg-indigo-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600 mx-auto group-hover:scale-110 transition-transform">
                    <i data-lucide="brain-circuit" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">CHAT</p>
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Deteksi Autis</p>
                </div>
            </button>

            <!-- GPPH -->
            <button @click="openModal('gpph')" class="card-premium p-6 bg-white hover:bg-emerald-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 mx-auto group-hover:scale-110 transition-transform">
                    <i data-lucide="zoom-in" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">GPPH</p>
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Hiperaktivitas</p>
                </div>
            </button>

            <!-- KMME -->
            <button @click="openModal('perilaku')" class="card-premium p-6 bg-white hover:bg-blue-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mx-auto group-hover:scale-110 transition-transform">
                    <i data-lucide="smile" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">KMME</p>
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Emosional</p>
                </div>
            </button>

            <!-- Pendengaran -->
            <button @click="openModal('pendengaran')" class="card-premium p-6 bg-white hover:bg-purple-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-600 mx-auto group-hover:scale-110 transition-transform">
                    <i data-lucide="ear" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">Dengar</p>
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Pendengaran (TDD)</p>
                </div>
            </button>

            <!-- Penglihatan -->
            <button @click="openModal('penglihatan')" class="card-premium p-6 bg-white hover:bg-amber-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600 mx-auto group-hover:scale-110 transition-transform">
                    <i data-lucide="eye" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">Lihat</p>
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Penglihatan (TDL)</p>
                </div>
            </button>

            <!-- KPSP -->
            <button @click="openModal('kpsp')" class="card-premium p-6 bg-white hover:bg-pink-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 bg-pink-100 rounded-2xl flex items-center justify-center text-pink-600 mx-auto group-hover:scale-110 transition-transform">
                    <i data-lucide="baby" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">KPSP</p>
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Tumbuh Kembang</p>
                </div>
            </button>

            <!-- Anthropometri -->
            <button @click="openModal('anthropometri')" class="card-premium p-6 bg-white hover:bg-slate-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform" style="background-color: #cffafe; color: #0891b2;">
                    <i data-lucide="ruler" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">Fisik</p>
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Anthropometri</p>
                </div>
            </button>

            <!-- ATEC -->
            <button @click="openModal('atec')" class="card-premium p-6 bg-white hover:bg-slate-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform" style="background-color: var(--primary-color-light, #fee2e2); color: var(--primary-color);">
                    <i data-lucide="bar-chart-3" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">ATEC</p>
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Evaluasi Terapi</p>
                </div>
            </button>

            <!-- Wawancara -->
            <button @click="openModal('wawancara')" class="card-premium p-6 bg-white hover:bg-slate-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform" style="background-color: #ffe4e6; color: #e11d48;">
                    <i data-lucide="mic-2" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">Wawancara</p>
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Anamnesis</p>
                </div>
            </button>

            <!-- Obs Perilaku -->
            <button @click="openModal('hpperilaku')" class="card-premium p-6 bg-white hover:bg-slate-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform" style="background-color: #f1f5f9; color: #475569;">
                    <i data-lucide="activity" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">Perilaku</p>
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Observasi Klinis</p>
                </div>
            </button>

            <!-- Obs Sensorik -->
            <button @click="openModal('hpsensorik')" class="card-premium p-6 bg-white hover:bg-slate-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform" style="background-color: #ffedd5; color: #ea580c;">
                    <i data-lucide="waves" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">Sensorik</p>
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Observasi Klinis</p>
                </div>
            </button>
        </div>
    </div>

    <!-- Main Results Section -->
    <div class="space-y-6">
        <h4 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
            <i data-lucide="history" class="w-4 h-4 text-blue-500"></i> Rangkuman Hasil & Observasi Kualitatif
        </h4>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 space-y-8">
                <!-- Log Pemeriksaan -->
                @php
                    $allLogs = [];
                    foreach($hasil as $h) {
                        if($h->jenis === 'Anthropometri') continue;
                        $kesimpulan = '';
                        if ($h->jenis === 'ATEC Kuesioner') {
                            $kesimpulan = $h->total_skor > 50 
                                ? 'Menunjukkan bahwa anak masih perlu untuk di-treatment secara berkelanjutan.' 
                                : 'Menunjukkan perkembangan positif. Lanjutkan observasi dan stimulasi sesuai porsi terapi.';
                        }
                        $allLogs[] = [
                            'id' => $h->id,
                            'waktu' => $h->created_at,
                            'jenis' => $h->jenis,
                            'hasil' => $h->hasil,
                            'interpretasi' => $h->interpretasi,
                            'kesimpulan' => $kesimpulan,
                            'total_skor' => $h->total_skor ?? 0,
                            'jenis_model' => 'HasilPemeriksaan',
                            'is_atec' => $h->jenis == 'ATEC',
                            'image_url' => $h->jenis == 'ATEC' ? asset('storage/atec/' . $h->hasil) : null,
                            'original_hasil' => $h->hasil
                        ];
                    }
                    foreach($hpperilaku as $h) {
                        $allLogs[] = [
                            'id' => $h->id,
                            'waktu' => $h->created_at,
                            'jenis' => 'OBS. PERILAKU',
                            'hasil' => strip_tags($h->deskripsi),
                            'interpretasi' => '',
                            'kesimpulan' => '',
                            'total_skor' => 0,
                            'jenis_model' => 'HpPerilaku',
                            'is_atec' => false,
                            'image_url' => null,
                            'original_hasil' => $h->deskripsi
                        ];
                    }
                    foreach($hpsensorik as $h) {
                        $allLogs[] = [
                            'id' => $h->id,
                            'waktu' => $h->created_at,
                            'jenis' => 'OBS. SENSORIK',
                            'hasil' => strip_tags($h->deskripsi),
                            'interpretasi' => '',
                            'kesimpulan' => '',
                            'total_skor' => 0,
                            'jenis_model' => 'HpSensorik',
                            'is_atec' => false,
                            'image_url' => null,
                            'original_hasil' => $h->deskripsi
                        ];
                    }
                    usort($allLogs, function($a, $b) {
                        return strtotime($b['waktu']) - strtotime($a['waktu']);
                    });
                @endphp
                <div class="card-premium overflow-hidden bg-white shadow-xl shadow-slate-200/50">
                    <div class="p-6 border-b border-slate-50 bg-white">
                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                            <i data-lucide="clipboard-check" class="w-4 h-4 text-emerald-500"></i> LOG PEMERIKSAAN MEDIK
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Jenis Assessment</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($allLogs as $h)
                                <tr class="hover:bg-slate-50 transition-colors group">
                                    <td class="px-6 py-4 text-xs font-bold text-slate-500 tracking-tight">{{ \Carbon\Carbon::parse($h['waktu'])->format('d M Y') }}</td>
                                    <td class="px-6 py-4 font-black text-xs text-slate-700 uppercase tracking-tighter italic">{{ $h['jenis'] }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2 transition-opacity">
                                            @if (!in_array($h['jenis'], ['Wawancara', 'OBS. PERILAKU', 'OBS. SENSORIK']))
                                                <button class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all border border-blue-100"
                                                        @click="openModal('result', { 
                                                            id: '{{ $h['id'] }}', 
                                                            jenis: '{{ $h['jenis'] }}', 
                                                            hasil: '{{ $h['original_hasil'] }}', 
                                                            interpretasi: '{{ $h['interpretasi'] }}',
                                                            kesimpulan: '{{ $h['kesimpulan'] }}',
                                                            total_skor: {{ $h['total_skor'] }},
                                                            created_at: '{{ \Carbon\Carbon::parse($h['waktu'])->translatedFormat('d F Y') }}',
                                                            is_atec: {{ $h['is_atec'] ? 'true' : 'false' }},
                                                            image_url: '{{ $h['image_url'] }}'
                                                        })">
                                                    <i data-lucide="eye" class="w-3.5 h-3.5 inline md:mr-1"></i> <span class="hidden md:inline">Result</span>
                                                </button>
                                            @endif
                                            @if (!in_array($h['jenis'], ['Penyimpangan Penglihatan', 'ATEC', 'OBS. PERILAKU', 'OBS. SENSORIK']))
                                                <a href="{{ route('observasi.detail', ['hasil' => $h['id']]) }}"
                                                   class="px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition-all border border-emerald-100">
                                                    <i data-lucide="list" class="w-3.5 h-3.5 inline md:mr-1"></i> <span class="hidden md:inline">Responses</span>
                                                </a>
                                            @endif
                                            
                                            <!-- Tombol Edit -->
                                            @if (in_array($h['jenis_model'], ['HpPerilaku', 'HpSensorik']))
                                                <button type="button" @click="openModal('edit_qualitative', { id: '{{ $h['id'] }}', jenis: '{{ $h['jenis_model'] }}', deskripsi: '{{ base64_encode($h['original_hasil']) }}' })" class="p-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-600 hover:text-white transition-colors ml-2" title="Edit">
                                                    <i data-lucide="edit-2" class="w-3.5 h-3.5"></i>
                                                </button>
                                            @endif
                                            
                                            <form action="{{ route('observasi.destroy_hasil', $h['id']) }}" method="POST" onsubmit="confirmDelete(event)" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="jenis_model" value="{{ $h['jenis_model'] }}">
                                                <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-colors btn-hapus" title="Hapus">
                                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center gap-2 text-slate-300">
                                            <i data-lucide="database" class="w-8 h-8 opacity-20"></i>
                                            <p class="text-[10px] font-black uppercase tracking-widest">Belum ada data pemeriksaan</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>



                <!-- Riwayat Anthropometri -->
                <div class="card-premium overflow-hidden bg-white shadow-xl shadow-slate-200/50">
                    <div class="p-6 border-b border-slate-50 bg-white">
                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                            <i data-lucide="ruler" class="w-4 h-4 text-cyan-500"></i> RIWAYAT ANTHROPOMETRI (PERTUMBUHAN FISIK)
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal / Usia</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">BB (kg)</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">TB (cm)</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">LK (cm)</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status / Catatan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($anthropometris as $anthro)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 text-xs">
                                        <p class="font-bold text-slate-700 tracking-tight">{{ \Carbon\Carbon::parse($anthro->tanggal_pengukuran)->format('d M Y') }}</p>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $anthro->usia_bulan }} Bulan</p>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-black text-slate-700 text-center">{{ $anthro->berat_badan }}</td>
                                    <td class="px-6 py-4 text-xs font-black text-slate-700 text-center">{{ $anthro->tinggi_badan }}</td>
                                    <td class="px-6 py-4 text-xs font-black text-slate-700 text-center">{{ $anthro->lingkar_kepala ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        @if($anthro->status_bb_u)
                                            <span class="px-2 py-1 bg-cyan-50 text-cyan-600 rounded text-[9px] font-black uppercase tracking-widest block w-max mb-1">BB/U: {{ $anthro->status_bb_u }}</span>
                                        @endif
                                        @if($anthro->status_tb_u)
                                            <span class="px-2 py-1 bg-emerald-50 text-emerald-600 rounded text-[9px] font-black uppercase tracking-widest block w-max mb-1">TB/U: {{ $anthro->status_tb_u }}</span>
                                        @endif
                                        @if($anthro->catatan)
                                            <p class="text-[10px] text-slate-500 mt-2 italic">{{ Str::limit($anthro->catatan, 30) }}</p>
                                        @endif
                                        <div class="flex gap-2 mt-3">
                                            <button @click="openModal('edit_anthropometri', {{ $anthro->toJson() }})" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-colors">
                                                <i data-lucide="edit-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                            <form action="{{ route('observasi.anthropometri.destroy', $anthro->id) }}" method="POST" onsubmit="confirmDelete(event)" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-colors btn-hapus">
                                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center gap-2 text-slate-300">
                                            <i data-lucide="scale" class="w-8 h-8 opacity-20"></i>
                                            <p class="text-[10px] font-black uppercase tracking-widest">Belum ada data Anthropometri</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sidebar Export -->
            <div class="lg:col-span-4">
                <div class="card-premium p-8 bg-slate-900 text-white relative overflow-hidden sticky top-8" id="form-cetak">
                    <i data-lucide="file-text" class="absolute -right-8 -bottom-8 w-48 h-48 text-white/5"></i>
                    <div class="relative z-10 space-y-6">
                        <div class="space-y-3">
                            <h4 class="text-xl font-black tracking-tight italic uppercase text-red-500">Export Report</h4>
                            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest leading-relaxed">Generated PDF berkas rekam medik observasi untuk arsip klinik atau rujukan.</p>
                        </div>
                        <form action="{{ route('observasi.cetak') }}" method="POST" target="_blank" class="space-y-4">
                            @csrf
                            <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Tanggal Assessment</label>
                                <input type="date" name="tanggal" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 text-white font-black text-xs outline-none focus:ring-4 focus:ring-red-500/20 transition-all">
                            </div>
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl transition-all flex items-center justify-center gap-2">
                                <i data-lucide="download-cloud" class="w-4 h-4"></i> Generate PDF Audit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Centered Alpine Modals -->
    <div x-show="modalOpen" x-cloak 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        
        <!-- Backdrop with Blur -->
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>         <!-- Modal Content Container -->
        <div class="bg-white rounded-[2rem] md:rounded-[2.5rem] shadow-2xl w-full max-h-[95vh] md:max-h-[90vh] flex flex-col relative z-10 border border-slate-100"
             :class="modalType === 'result' ? 'max-w-2xl' : 'max-w-4xl'"
             x-show="modalOpen"
             x-effect="if(modalOpen) { 
                $nextTick(() => { 
                    if(typeof lucide !== 'undefined') lucide.createIcons();                     if(['hpperilaku', 'hpsensorik', 'edit_qualitative'].includes(modalType)) {
                        if (typeof initSummernote === 'function') {
                            initSummernote();
                            if (modalType === 'edit_qualitative') {
                                setTimeout(() => {
                                    let decoded = '';
                                    try {
                                        decoded = decodeURIComponent(escape(window.atob(modalData.deskripsi)));
                                    } catch(e) {
                                        decoded = window.atob(modalData.deskripsi);
                                    }
                                    const $editor = window.jQuery || window.$;
                                    if ($editor) $editor('#summernote-editor').summernote('code', decoded);
                                    
                                    // Trigger sync for checkboxes
                                    window.dispatchEvent(new CustomEvent('sync-qualitative', { 
                                        detail: { html: decoded, jenis: modalData.jenis, mType: modalType, mData: modalData } 
                                    }));
                                }, 150);
                            } else {
                                const $editor = window.jQuery || window.$;
                                  if ($editor) $editor('#summernote-editor').summernote('code', '');
                                // Reset checkboxes for new
                                window.dispatchEvent(new CustomEvent('sync-qualitative', { 
                                    detail: { html: '', jenis: modalType === 'hpperilaku' ? 'HpPerilaku' : 'HpSensorik', mType: modalType, mData: modalData } 
                                }));
                            }
                        }
                    }
                }); 
             }"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <div class="sticky top-0 bg-white/80 backdrop-blur-md border-b border-slate-50 p-4 md:p-6 flex items-center justify-between z-20 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-red-50 text-red-500 rounded-xl">
                        <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-xs font-black uppercase tracking-widest text-slate-800" x-text="modalType.toUpperCase()"></h3>
                </div>
                <button @click="closeModal()" class="w-10 h-10 flex items-center justify-center bg-slate-50 text-slate-400 rounded-full hover:bg-slate-100 hover:text-red-500 transition-all">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto p-4 md:p-8">
                <!-- KMME Form -->
                <template x-if="modalType === 'perilaku'">
                    <form action="{{ route('observasi.perilaku') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                        
                        <div class="p-6 bg-slate-800 rounded-[2rem] flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-white">
                                <i data-lucide="brain-circuit" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="text-xs font-black text-white uppercase tracking-widest">Kuesioner Masalah Mental Emosional (KMME)</h3>
                                <p class="text-[10px] text-slate-400 mt-1">12 Pertanyaan Deteksi Dini Kemenkes</p>
                            </div>
                        </div>

                        <div class="space-y-3 max-h-[55vh] md:max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                            @foreach ($qperilaku as $index => $q)
                            <div class="p-4 md:p-5 bg-slate-50 border border-slate-100 rounded-2xl">
                                <div class="flex gap-3 md:gap-4">
                                    <span class="w-6 h-6 rounded-full bg-slate-200 text-slate-600 text-[10px] font-black flex items-center justify-center flex-shrink-0">{{ $index + 1 }}</span>
                                    <p class="text-xs font-bold text-slate-700 leading-relaxed">{{ $q->question_text }}</p>
                                </div>
                                <div class="flex justify-end gap-2 mt-4">
                                    <label class="cursor-pointer flex-1 md:flex-none">
                                        <input type="radio" name="answers[{{ $q->id }}]" value="ya" class="hidden peer" required>
                                        <div class="px-4 md:px-6 py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition-all text-center">Ya</div>
                                    </label>
                                    <label class="cursor-pointer flex-1 md:flex-none">
                                        <input type="radio" name="answers[{{ $q->id }}]" value="tidak" class="hidden peer">
                                        <div class="px-4 md:px-6 py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 transition-all text-center">Tidak</div>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="sticky bottom-0 bg-white/95 backdrop-blur-sm -mx-4 md:-mx-8 px-4 md:px-8 py-4 border-t border-slate-50 flex justify-end z-30 mt-6 shrink-0">
                            <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl hover:bg-black transition-colors">Simpan Hasil KMME</button>
                        </div>
                    </form>
                </template>

                <!-- CHAT Form -->
                <template x-if="modalType === 'autis'">
                    <div x-data="{
                        autisStep: 1,
                        autisAnswers: JSON.parse(localStorage.getItem('chat_draft_{{ $anak->id }}')) || {},
                        init() {
                            this.$watch('autisAnswers', value => {
                                localStorage.setItem('chat_draft_{{ $anak->id }}', JSON.stringify(value));
                            }, { deep: true });
                        },
                        clearDraft() {
                            this.autisAnswers = {};
                            localStorage.removeItem('chat_draft_{{ $anak->id }}');
                        },
                        submitForm(e) {
                            let allKeys = [{{ $qautis->pluck('id')->implode(', ') }}];
                            let answeredKeys = Object.keys(this.autisAnswers).map(Number);
                            let missing = allKeys.filter(k => !answeredKeys.includes(k));
                            
                            if (missing.length > 0) {
                                Swal.fire({
                                    icon: 'warning', 
                                    title: 'Belum Lengkap', 
                                    text: 'Terdapat ' + missing.length + ' pertanyaan yang belum dijawab. Mohon periksa kembali Section A & B.',
                                    confirmButtonColor: '#3b82f6'
                                });
                                // Pindah ke step 1 jika ada yang kosong di section A
                                let sectionAKeys = [{{ $qautis->where('section', 'A')->pluck('id')->implode(', ') }}];
                                let missingInA = sectionAKeys.filter(k => !answeredKeys.includes(k));
                                if(missingInA.length > 0) {
                                    this.autisStep = 1;
                                } else {
                                    this.autisStep = 2;
                                }
                                return;
                            }
                            
                            this.clearDraft();
                            e.target.submit();
                        }
                    }">
                        <form id="form-autis" action="{{ route('observasi.autis') }}" method="POST" class="space-y-6" @submit.prevent="submitForm">
                            @csrf
                            <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                            
                            <div class="p-6 bg-slate-800 rounded-[2rem] flex items-center justify-between gap-4 mb-6 relative overflow-hidden">
                                <div class="relative z-10 flex items-center gap-4">
                                    <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-white">
                                        <i data-lucide="puzzle" class="w-6 h-6"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xs font-black text-white uppercase tracking-widest">Checklist for Autism (CHAT)</h3>
                                        <p class="text-[10px] text-slate-400 mt-1">
                                            <span x-show="autisStep === 1">Tahap 1: Wawancara Orang Tua</span>
                                            <span x-show="autisStep === 2">Tahap 2: Observasi Langsung</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="relative z-10 hidden md:flex items-center gap-2 text-[10px] font-black uppercase">
                                    <span class="px-3 py-1.5 rounded-lg transition-colors" :class="autisStep === 1 ? 'bg-indigo-500 text-white' : 'bg-slate-700 text-slate-400'">Section A</span>
                                    <i data-lucide="arrow-right" class="w-3 h-3 text-slate-500"></i>
                                    <span class="px-3 py-1.5 rounded-lg transition-colors" :class="autisStep === 2 ? 'bg-indigo-500 text-white' : 'bg-slate-700 text-slate-400'">Section B</span>
                                </div>
                            </div>

                            <div class="bg-indigo-50 border border-indigo-100 p-4 rounded-2xl mb-4 flex gap-3">
                                <i data-lucide="save" class="w-5 h-5 text-indigo-500 shrink-0"></i>
                                <p class="text-[10px] font-bold text-indigo-700 leading-relaxed">
                                    Progress Anda disimpan otomatis. Anda dapat menutup layar ini, melakukan observasi ke anak, dan kembali ke menu ini tanpa kehilangan data wawancara.
                                </p>
                            </div>

                            <div class="space-y-6 max-h-[50vh] md:max-h-[55vh] overflow-y-auto pr-2 custom-scrollbar">
                                
                                <!-- Section A -->
                                <div x-show="autisStep === 1" x-transition.opacity.duration.300ms>
                                    <h4 class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 bg-slate-100 py-2 px-4 rounded-lg inline-block">Section A: Pertanyaan untuk Orang Tua/Pengasuh</h4>
                                    <div class="space-y-3">
                                        @foreach ($qautis->where('section', 'A') as $q)
                                        <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                                            <div class="flex gap-3">
                                                <span class="w-6 h-6 rounded-full bg-slate-200 text-slate-600 text-[10px] font-black flex items-center justify-center flex-shrink-0">A{{ $q->no_urut }}</span>
                                                <div class="flex-1">
                                                    <p class="text-xs font-bold text-slate-700 mb-3">{{ $q->question_text }}</p>
                                                    <div class="flex gap-2">
                                                        <label class="cursor-pointer flex-1">
                                                            <input type="radio" name="answers[{{ $q->id }}]" value="ya" class="hidden peer" x-model="autisAnswers[{{ $q->id }}]">
                                                            <div class="py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 transition-all text-center">Ya</div>
                                                        </label>
                                                        <label class="cursor-pointer flex-1">
                                                            <input type="radio" name="answers[{{ $q->id }}]" value="tidak" class="hidden peer" x-model="autisAnswers[{{ $q->id }}]">
                                                            <div class="py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition-all text-center">Tidak</div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="sticky bottom-0 bg-white/95 backdrop-blur-sm -mx-4 md:-mx-8 px-4 md:px-8 py-4 border-t border-slate-50 flex justify-end z-30 mt-6 shrink-0">
                                        <button type="button" @click="autisStep = 2; document.querySelector('.flex-1.overflow-y-auto').scrollTop = 0;" class="bg-slate-900 text-white px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-black transition-all shadow-lg flex items-center gap-2 w-full md:w-auto justify-center">
                                            Lanjut ke Section B <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Section B -->
                                <div x-show="autisStep === 2" x-transition.opacity.duration.300ms style="display: none;">
                                    <h4 class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 bg-slate-100 py-2 px-4 rounded-lg inline-block">Section B: Observasi Langsung oleh Terapis</h4>
                                    <div class="space-y-3">
                                        @foreach ($qautis->where('section', 'B') as $q)
                                        <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                                            <div class="flex gap-3">
                                                <span class="w-6 h-6 rounded-full bg-slate-200 text-slate-600 text-[10px] font-black flex items-center justify-center flex-shrink-0">B{{ $q->no_urut - 9 }}</span>
                                                <div class="flex-1">
                                                    <p class="text-xs font-bold text-slate-700 mb-3">{{ $q->question_text }}</p>
                                                    <div class="flex gap-2">
                                                        <label class="cursor-pointer flex-1">
                                                            <input type="radio" name="answers[{{ $q->id }}]" value="ya" class="hidden peer" x-model="autisAnswers[{{ $q->id }}]">
                                                            <div class="py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 transition-all text-center">Ya</div>
                                                        </label>
                                                        <label class="cursor-pointer flex-1">
                                                            <input type="radio" name="answers[{{ $q->id }}]" value="tidak" class="hidden peer" x-model="autisAnswers[{{ $q->id }}]">
                                                            <div class="py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition-all text-center">Tidak</div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-6 flex justify-between">
                                        <button type="button" @click="autisStep = 1; document.querySelector('.custom-scrollbar').scrollTop = 0;" class="bg-slate-100 text-slate-500 px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-200 transition-all flex items-center gap-2">
                                            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div x-show="autisStep === 2" x-transition.opacity class="sticky bottom-0 bg-white/95 backdrop-blur-sm -mx-4 md:-mx-8 px-4 md:px-8 py-4 border-t border-slate-50 flex justify-end z-30 mt-6 shrink-0">
                                <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl hover:bg-black transition-colors flex items-center justify-center gap-2">
                                    <i data-lucide="check-circle" class="w-4 h-4"></i> Simpan Hasil Akhir CHAT
                                </button>
                            </div>
                        </form>
                    </div>
                </template>

                <!-- GPPH Form -->
                <template x-if="modalType === 'gpph'">
                    <form action="{{ route('observasi.gpph') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                        
                        <div class="p-6 bg-slate-800 rounded-[2rem] flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-white">
                                <i data-lucide="zap" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="text-xs font-black text-white uppercase tracking-widest">Gangguan Pemusatan Perhatian (GPPH)</h3>
                                <p class="text-[10px] text-slate-400 mt-1">10 Item SDIDTK Kemenkes</p>
                            </div>
                        </div>

                        <style>
                            /* Fallback CSS for guaranteed coloring when Tailwind classes are purged */
                            .peer-checked-blue:checked + div {
                                background-color: #3b82f6 !important;
                                color: white !important;
                                border-color: #3b82f6 !important;
                            }
                            .peer-checked-purple:checked + div {
                                background-color: #a855f7 !important;
                                color: white !important;
                                border-color: #a855f7 !important;
                            }
                        </style>
                        <div class="space-y-4 max-h-[55vh] md:max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                            @foreach ($qgpph as $index => $q)
                            <div class="p-4 md:p-5 bg-slate-50 border border-slate-100 rounded-2xl">
                                <div class="flex gap-3 md:gap-4">
                                    <span class="w-6 h-6 rounded-full bg-slate-200 text-slate-600 text-[10px] font-black flex items-center justify-center flex-shrink-0">{{ $index + 1 }}</span>
                                    <p class="text-xs font-bold text-slate-700 leading-relaxed">{{ $q->question_text }}</p>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-4">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="answers[{{ $q->id }}]" value="0" class="hidden peer" required>
                                        <div class="px-2 md:px-3 py-2 rounded-xl border border-slate-200 text-[9px] font-black uppercase text-slate-400 peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 transition-all text-center">0 - Tdk Pernah</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="answers[{{ $q->id }}]" value="1" class="hidden peer peer-checked-blue">
                                        <div class="px-2 md:px-3 py-2 rounded-xl border border-slate-200 text-[9px] font-black uppercase text-slate-400 transition-all text-center">1 - Kadang</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="answers[{{ $q->id }}]" value="2" class="hidden peer peer-checked-purple">
                                        <div class="px-2 md:px-3 py-2 rounded-xl border border-slate-200 text-[9px] font-black uppercase text-slate-400 transition-all text-center">2 - Sering</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="answers[{{ $q->id }}]" value="3" class="hidden peer">
                                        <div class="px-2 md:px-3 py-2 rounded-xl border border-slate-200 text-[9px] font-black uppercase text-slate-400 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition-all text-center">3 - Selalu</div>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                         <div class="sticky bottom-0 bg-white/95 backdrop-blur-sm -mx-4 md:-mx-8 px-4 md:px-8 py-4 border-t border-slate-50 flex justify-end z-30 mt-6 shrink-0">
                            <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl hover:bg-black transition-colors">Simpan Hasil GPPH</button>
                        </div>
                    </form>
                </template>

                <!-- Pendengaran Form -->
                <template x-if="modalType === 'pendengaran'">
                    <form action="{{ route('obpendengaran.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                        
                        <!-- Child Age Info Card -->
                        <div class="p-6 bg-purple-50 rounded-[2rem] border border-purple-100 flex items-center justify-between mb-8">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-purple-600 shadow-sm">
                                    <i data-lucide="calendar-days" class="w-6 h-6"></i>
                                </div>
                                <div class="space-y-0.5">
                                    <p class="text-[10px] font-black text-purple-400 uppercase tracking-widest">Umur Kronologis Anak</p>
                                    <p class="text-sm font-black text-purple-900 uppercase italic">{{ $umur }}</p>
                                </div>
                            </div>
                            <div class="px-4 py-2 bg-white/50 rounded-xl text-[9px] font-bold text-purple-600 uppercase tracking-tight">
                                Pilih Kelompok Umur di Bawah
                            </div>
                        </div>

                        <div class="space-y-4">
                            @foreach ($ageGroups as $group)
                            <div class="border border-slate-100 rounded-3xl overflow-hidden" x-data="{ open: false }">
                                <button type="button" @click="open = !open" class="w-full px-8 py-4 bg-slate-50 flex items-center justify-between">
                                    <h4 class="text-xs font-black text-slate-700 uppercase tracking-widest">{{ $group->nama }}</h4>
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-300" :class="open ? 'rotate-180' : ''"></i>
                                </button>
                                <div x-show="open" class="p-6 space-y-4 bg-white border-t border-slate-50">
                                    <!-- Inner Category Heading -->
                                    <div class="py-3 px-6 bg-purple-600 rounded-2xl mb-6 shadow-lg shadow-purple-100">
                                        <p class="text-[10px] font-black text-purple-100 uppercase tracking-widest leading-none mb-1">KATEGORI EVALUASI</p>
                                        <p class="text-sm font-black text-white uppercase italic">{{ $group->nama }}</p>
                                    </div>

                                    @foreach ($group->questions as $q)
                                        @if (Str::contains($q->question_text, ['Kemampuan Ekspresif', 'Kemampuan Reseptif', 'Kemampuan Visual']))
                                            <div class="py-2 px-4 bg-slate-900 rounded-xl text-center"><span class="text-[9px] font-black text-white uppercase tracking-widest italic">{{ $q->question_text }}</span></div>
                                        @else
                                            <div class="flex items-center justify-between gap-4 p-4 border-b border-slate-50 last:border-0 italic">
                                                <p class="text-xs font-bold text-slate-600 uppercase tracking-tight">{{ $q->question_text }}</p>
                                                <div class="flex gap-2">
                                                    <label class="cursor-pointer">
                                                        <input type="radio" name="answers[{{ $q->id }}]" value="ya" class="hidden peer">
                                                        <div class="px-5 py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 transition-all text-center min-w-[70px]">Ya</div>
                                                    </label>
                                                    <label class="cursor-pointer">
                                                        <input type="radio" name="answers[{{ $q->id }}]" value="tidak" class="hidden peer">
                                                        <div class="px-5 py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition-all text-center min-w-[70px]">Tidak</div>
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                         <div class="sticky bottom-0 bg-white/95 backdrop-blur-sm -mx-4 md:-mx-8 px-4 md:px-8 py-4 border-t border-slate-50 flex justify-end z-30 mt-6 shrink-0">
                            <button type="submit" class="w-full bg-purple-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest">Simpan Laporan Pendengaran</button>
                        </div>
                    </form>
                </template>

                <!-- TDL / Penglihatan Form -->
                <template x-if="modalType === 'penglihatan'">
                    <form action="{{ route('observasi.penglihatan') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                        
                        <div class="p-6 bg-amber-50 rounded-[2rem] border border-amber-100 flex items-start gap-4 mb-8">
                            <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-amber-600 shadow-sm flex-shrink-0">
                                <i data-lucide="eye" class="w-6 h-6"></i>
                            </div>
                            <div class="space-y-2">
                                <p class="text-[10px] font-black text-amber-500 uppercase tracking-widest">Tes Daya Lihat (TDL)</p>
                                <div class="text-xs text-amber-900 leading-relaxed space-y-1">
                                    <p><strong>Prosedur:</strong></p>
                                    <ul class="list-disc pl-4 opacity-80">
                                        <li>Gunakan Kartu E, letakkan setinggi mata anak pada jarak 3 meter.</li>
                                        <li>Anak diminta menunjuk arah kaki huruf E.</li>
                                        <li>Tes tiap mata bergantian (tutup satu mata).</li>
                                        <li>Mulai dari baris atas hingga baris ketiga.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="relative block cursor-pointer group">
                                <input type="radio" name="hasil" value="normal" class="hidden peer" required>
                                <div class="p-6 md:p-8 bg-slate-50 border-2 border-slate-100 rounded-[2rem] transition-all duration-300 peer-checked:bg-white peer-checked:border-emerald-500 peer-checked:shadow-xl group-hover:bg-white">
                                    <div class="space-y-2 text-center">
                                        <div class="w-12 h-12 bg-slate-200 rounded-full mx-auto flex items-center justify-center peer-checked:bg-emerald-100 peer-checked:text-emerald-600 transition-colors">
                                            <i data-lucide="check" class="w-6 h-6"></i>
                                        </div>
                                        <p class="text-sm font-black text-slate-700 uppercase tracking-tight">Normal</p>
                                        <p class="text-[10px] text-slate-400">Bisa menjawab sampai baris ke-3</p>
                                    </div>
                                </div>
                            </label>

                            <label class="relative block cursor-pointer group">
                                <input type="radio" name="hasil" value="gangguan" class="hidden peer">
                                <div class="p-6 md:p-8 bg-slate-50 border-2 border-slate-100 rounded-[2rem] transition-all duration-300 peer-checked:bg-white peer-checked:border-red-500 peer-checked:shadow-xl group-hover:bg-white">
                                    <div class="space-y-2 text-center">
                                        <div class="w-12 h-12 bg-slate-200 rounded-full mx-auto flex items-center justify-center peer-checked:bg-red-100 peer-checked:text-red-600 transition-colors">
                                            <i data-lucide="x" class="w-6 h-6"></i>
                                        </div>
                                        <p class="text-sm font-black text-slate-700 uppercase tracking-tight">Curiga Gangguan</p>
                                        <p class="text-[10px] text-slate-400">Tidak bisa pada baris ke-3</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-[2rem] text-xs font-black uppercase tracking-widest shadow-2xl">Simpan Hasil TDL</button>
                    </form>
                </template>

                <!-- KPSP Form -->
                <template x-if="modalType === 'kpsp'">
                    <form action="{{ route('observasi.kpsp') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                        
                        <!-- Child Age Info Card -->
                        <div class="p-6 bg-pink-50 rounded-[2rem] border border-pink-100 flex items-center justify-between mb-8">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-pink-600 shadow-sm">
                                    <i data-lucide="calendar-heart" class="w-6 h-6"></i>
                                </div>
                                <div class="space-y-0.5">
                                    <p class="text-[10px] font-black text-pink-400 uppercase tracking-widest">Umur Kronologis Anak</p>
                                    <p class="text-sm font-black text-pink-900 uppercase italic">{{ $umur }}</p>
                                </div>
                            </div>
                            <div class="px-4 py-2 bg-white/50 rounded-xl text-[9px] font-bold text-pink-600 uppercase tracking-tight">
                                Pilih Kelompok Umur KPSP
                            </div>
                        </div>

                        <div class="space-y-4" x-data="{ selectedGroup: null }">
                            @foreach ($kpspKelompokUsias as $group)
                            <div class="border border-slate-100 rounded-3xl overflow-hidden" x-data="{ open: false }" x-effect="open = (selectedGroup === {{ $group->id }})">
                                <button type="button" @click="selectedGroup = (selectedGroup === {{ $group->id }} ? null : {{ $group->id }})" class="w-full px-8 py-4 bg-slate-50 flex items-center justify-between transition-colors hover:bg-slate-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded-full border-2 border-pink-300 flex items-center justify-center" :class="selectedGroup === {{ $group->id }} ? 'bg-pink-500 border-pink-500' : 'bg-white'">
                                            <div class="w-2 h-2 rounded-full bg-white opacity-0" :class="selectedGroup === {{ $group->id }} ? 'opacity-100' : ''"></div>
                                        </div>
                                        <h4 class="text-xs font-black text-slate-700 uppercase tracking-widest">Usia {{ $group->nama }}</h4>
                                    </div>
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-300 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                                </button>
                                
                                <div x-show="open" x-collapse>
                                    <div class="p-6 space-y-6 bg-white border-t border-slate-50">
                                        <input type="radio" name="kpsp_kelompok_usia_id" value="{{ $group->id }}" x-model="selectedGroup" class="hidden">
                                        
                                        @foreach ($group->pertanyaans as $index => $q)
                                            <div class="flex flex-col gap-3 p-5 bg-slate-50 border border-slate-100 rounded-2xl">
                                                <div class="flex items-start gap-3">
                                                    <span class="w-6 h-6 rounded-full bg-pink-100 text-pink-600 text-[10px] font-black flex items-center justify-center flex-shrink-0">{{ $index + 1 }}</span>
                                                    <div class="space-y-1">
                                                        <span class="px-2 py-0.5 rounded text-[8px] font-black uppercase tracking-widest bg-white border border-slate-200 text-slate-500">{{ $q->bidang }}</span>
                                                        <p class="text-xs font-bold text-slate-700 leading-relaxed">{{ $q->pertanyaan }}</p>
                                                    </div>
                                                </div>
                                                <div class="flex justify-end gap-2 mt-2">
                                                    <label class="cursor-pointer">
                                                        <input type="radio" name="answers[{{ $q->id }}]" value="ya" class="hidden peer" :required="selectedGroup === {{ $group->id }}">
                                                        <div class="px-6 py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 transition-all text-center min-w-[80px]">Ya</div>
                                                    </label>
                                                    <label class="cursor-pointer">
                                                        <input type="radio" name="answers[{{ $q->id }}]" value="tidak" class="hidden peer">
                                                        <div class="px-6 py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition-all text-center min-w-[80px]">Tidak</div>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                         <div class="sticky bottom-0 bg-white/95 backdrop-blur-sm -mx-4 md:-mx-8 px-4 md:px-8 py-4 border-t border-slate-50 flex justify-end z-30 mt-6 shrink-0">
                            <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl hover:bg-black transition-colors">Simpan Hasil KPSP</button>
                        </div>
                    </form>
                </template>

                <!-- Anthropometri Form -->
                <template x-if="modalType === 'anthropometri'">
                    <form action="{{ route('observasi.anthropometri') }}" method="POST" class="flex flex-col space-y-6" x-data="{
                        bb: '',
                        tb: '',
                        lk: '',
                        bmi: 0,
                        status_bb: '',
                        status_tb: '',
                        status_lk: '',
                        catatan: '',
                        age_m: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffInMonths(now()) }},
                        calculate() {
                            if(this.bb && this.tb) {
                                let w = parseFloat(this.bb);
                                let h = parseFloat(this.tb) / 100;
                                this.bmi = w / (h * h);
                                
                                // IMT / BB/U Mock
                                if (this.bmi < 15) { this.status_bb = 'Gizi Buruk'; }
                                else if (this.bmi < 18.5) { this.status_bb = 'Gizi Kurang'; }
                                else if (this.bmi > 25) { this.status_bb = 'Gizi Lebih'; }
                                else { this.status_bb = 'Normal'; }

                                // TB/U Mock
                                let expected_tb = 50 + (this.age_m * 1.5);
                                if (this.age_m > 12) expected_tb = 75 + ((this.age_m - 12) * 0.8);
                                let tb_val = parseFloat(this.tb);
                                if (tb_val < expected_tb * 0.9) this.status_tb = 'Sangat Pendek';
                                else if (tb_val < expected_tb * 0.95) this.status_tb = 'Pendek';
                                else if (tb_val > expected_tb * 1.1) this.status_tb = 'Tinggi';
                                else this.status_tb = 'Normal';

                                // LK/U Mock
                                if(this.lk) {
                                    let lk_val = parseFloat(this.lk);
                                    let expected_lk = 35 + (this.age_m * 0.5);
                                    if (this.age_m > 12) expected_lk = 41 + ((this.age_m - 12) * 0.15);
                                    
                                    if (lk_val < expected_lk * 0.95) this.status_lk = 'Mikrosefali';
                                    else if (lk_val > expected_lk * 1.05) this.status_lk = 'Makrosefali';
                                    else this.status_lk = 'Normal';
                                } else {
                                    this.status_lk = '';
                                }

                                // Auto Catatan
                                this.catatan = `Berdasarkan pengukuran fisik (Mock):\n- IMT: ${this.bmi.toFixed(1)} (Status: ${this.status_bb})\n- Tinggi Badan: ${this.status_tb}`;
                                if(this.lk) this.catatan += `\n- Lingkar Kepala: ${this.status_lk}`;
                                this.catatan += `\n\nRekomendasi: Lanjutkan stimulasi gizi dan tumbuh kembang sesuai usia.`;
                            }
                        }
                    }">
                        @csrf
                        <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                        
                        <div class="p-6 bg-cyan-50 rounded-[2rem] border border-cyan-100 flex items-center justify-between mb-2">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-cyan-600 shadow-sm">
                                    <i data-lucide="ruler" class="w-6 h-6"></i>
                                </div>
                                <div class="space-y-0.5">
                                    <p class="text-[10px] font-black text-cyan-400 uppercase tracking-widest">Pemeriksaan Fisik</p>
                                    <p class="text-sm font-black text-cyan-900 uppercase italic">Anthropometri</p>
                                </div>
                            </div>
                            <div class="px-4 py-2 bg-white/50 rounded-xl text-[9px] font-bold text-cyan-600 uppercase tracking-tight text-right">
                                <p>Standar SDIDTK</p>
                                <p class="text-[7px] opacity-70">Auto-Calculate Z-Score (Mock)</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Berat Badan (BB) - kg</label>
                                <input type="number" step="0.01" name="berat_badan" x-model="bb" @input="calculate()" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-700 font-bold text-xs outline-none focus:ring-4 focus:ring-cyan-500/20 transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tinggi Badan (TB) - cm</label>
                                <input type="number" step="0.01" name="tinggi_badan" x-model="tb" @input="calculate()" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-700 font-bold text-xs outline-none focus:ring-4 focus:ring-cyan-500/20 transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Lingkar Kepala (LK) - cm</label>
                                <input type="number" step="0.01" name="lingkar_kepala" x-model="lk" @input="calculate()" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-700 font-bold text-xs outline-none focus:ring-4 focus:ring-cyan-500/20 transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Lingkar Lengan (LLA) - cm</label>
                                <input type="number" step="0.01" name="lingkar_lengan_atas" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-700 font-bold text-xs outline-none focus:ring-4 focus:ring-cyan-500/20 transition-all">
                            </div>
                        </div>

                        <!-- Visual Skala IMT -->
                        <div x-show="bmi > 0" class="mt-4 p-6 bg-white border border-slate-200 rounded-2xl transition-all shadow-sm" style="display: none;">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Estimasi Skala IMT (Mock)</span>
                                <span class="text-2xl font-black tracking-tighter" :class="{
                                    'text-blue-500': bmi < 18.5,
                                    'text-emerald-500': bmi >= 18.5 && bmi < 25,
                                    'text-amber-500': bmi >= 25 && bmi < 30,
                                    'text-red-500': bmi >= 30
                                }" x-text="bmi.toFixed(1)"></span>
                            </div>
                            <div class="relative h-4 rounded-full flex overflow-hidden">
                                <div class="h-full bg-blue-400" style="width: 46.25%"></div> <!-- Kurus <18.5 -->
                                <div class="h-full bg-emerald-400" style="width: 16.25%"></div> <!-- Normal 18.5-24.9 -->
                                <div class="h-full bg-amber-400" style="width: 12.5%"></div> <!-- Gemuk 25-29.9 -->
                                <div class="h-full bg-red-500" style="width: 25%"></div> <!-- Obesitas >=30 -->
                                <!-- Marker -->
                                <div class="absolute top-0 bottom-0 w-1.5 bg-slate-900 z-10 transition-all duration-500 shadow-[0_0_0_2px_white] rounded-full" :style="`left: ${Math.min((bmi / 40) * 100, 99)}%`"></div>
                            </div>
                            <div class="flex justify-between text-[8px] font-black uppercase text-slate-400 mt-2 px-1">
                                <span>Kurus</span>
                                <span>Normal</span>
                                <span>Gemuk</span>
                                <span>Obesitas</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-100 mt-4">
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status BB/U</label>
                                <select name="status_bb_u" x-model="status_bb" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-600 outline-none transition-colors" :class="status_bb ? 'bg-cyan-50 border-cyan-200 font-bold text-cyan-700' : ''">
                                    <option value="">Pilih Status...</option>
                                    <option value="Gizi Buruk">Gizi Buruk</option>
                                    <option value="Gizi Kurang">Gizi Kurang</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Gizi Lebih">Gizi Lebih</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status TB/U</label>
                                <select name="status_tb_u" x-model="status_tb" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-600 outline-none transition-colors" :class="status_tb ? 'bg-cyan-50 border-cyan-200 font-bold text-cyan-700' : ''">
                                    <option value="">Pilih Status...</option>
                                    <option value="Sangat Pendek">Sangat Pendek</option>
                                    <option value="Pendek">Pendek</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Tinggi">Tinggi</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status LK/U</label>
                                <select name="status_lk_u" x-model="status_lk" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-600 outline-none transition-colors" :class="status_lk ? 'bg-cyan-50 border-cyan-200 font-bold text-cyan-700' : ''">
                                    <option value="">Pilih Status...</option>
                                    <option value="Mikrosefali">Mikrosefali</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Makrosefali">Makrosefali</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Catatan Tambahan</label>
                            <textarea name="catatan" x-model="catatan" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-700 font-bold text-xs outline-none focus:ring-4 focus:ring-cyan-500/20 transition-all leading-relaxed"></textarea>
                        </div>

                        <div class="flex justify-end p-2">
                            <button type="submit" class="w-full md:w-max px-12 bg-slate-900 text-white py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl hover:bg-black transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3">
                                <i data-lucide="save" class="w-4 h-4"></i> Simpan Pengukuran Anthropometri
                            </button>
                        </div>
                    </form>
                </template>

                <!-- Edit Anthropometri Form -->
                <template x-if="modalType === 'edit_anthropometri'">
                    <form :action="`/observasi-anthropometri/update/${modalData.id}`" method="POST" class="flex flex-col space-y-6" x-data="{
                        bb: modalData.berat_badan,
                        tb: modalData.tinggi_badan,
                        lk: modalData.lingkar_kepala,
                        bmi: 0,
                        status_bb: modalData.status_bb_u,
                        status_tb: modalData.status_tb_u,
                        status_lk: modalData.status_lk_u,
                        catatan: modalData.catatan,
                        age_m: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->diffInMonths(now()) }},
                        calculate() {
                            if(this.bb && this.tb) {
                                let w = parseFloat(this.bb);
                                let h = parseFloat(this.tb) / 100;
                                this.bmi = w / (h * h);
                                
                                if (this.bmi < 15) { this.status_bb = 'Gizi Buruk'; }
                                else if (this.bmi < 18.5) { this.status_bb = 'Gizi Kurang'; }
                                else if (this.bmi > 25) { this.status_bb = 'Gizi Lebih'; }
                                else { this.status_bb = 'Normal'; }

                                let expected_tb = 50 + (this.age_m * 1.5);
                                if (this.age_m > 12) expected_tb = 75 + ((this.age_m - 12) * 0.8);
                                let tb_val = parseFloat(this.tb);
                                if (tb_val < expected_tb * 0.9) this.status_tb = 'Sangat Pendek';
                                else if (tb_val < expected_tb * 0.95) this.status_tb = 'Pendek';
                                else if (tb_val > expected_tb * 1.1) this.status_tb = 'Tinggi';
                                else this.status_tb = 'Normal';

                                if(this.lk) {
                                    let lk_val = parseFloat(this.lk);
                                    let expected_lk = 35 + (this.age_m * 0.5);
                                    if (this.age_m > 12) expected_lk = 41 + ((this.age_m - 12) * 0.15);
                                    
                                    if (lk_val < expected_lk * 0.95) this.status_lk = 'Mikrosefali';
                                    else if (lk_val > expected_lk * 1.05) this.status_lk = 'Makrosefali';
                                    else this.status_lk = 'Normal';
                                }

                                this.catatan = `Berdasarkan pengukuran fisik (Mock):\n- IMT: ${this.bmi.toFixed(1)} (Status: ${this.status_bb})\n- Tinggi Badan: ${this.status_tb}`;
                                if(this.lk) this.catatan += `\n- Lingkar Kepala: ${this.status_lk}`;
                                this.catatan += `\n\nRekomendasi: Lanjutkan stimulasi gizi dan tumbuh kembang sesuai usia.`;
                            }
                        },
                        init() {
                            // Init BMI on load for the visual bar
                            if(this.bb && this.tb) {
                                let w = parseFloat(this.bb);
                                let h = parseFloat(this.tb) / 100;
                                this.bmi = w / (h * h);
                            }
                        }
                    }">
                        @csrf
                        <div class="p-4 md:p-6 bg-blue-50 rounded-[1.5rem] md:rounded-[2rem] border border-blue-100 flex items-center justify-between mb-2">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 md:w-12 md:h-12 bg-white rounded-2xl flex items-center justify-center text-blue-600 shadow-sm flex-shrink-0">
                                    <i data-lucide="edit" class="w-5 h-5 md:w-6 md:h-6"></i>
                                </div>
                                <div class="space-y-0.5">
                                    <p class="text-[9px] md:text-[10px] font-black text-blue-400 uppercase tracking-widest leading-tight">Edit Data</p>
                                    <p class="text-xs md:text-sm font-black text-blue-900 uppercase italic">Anthropometri</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Berat Badan (BB) - kg</label>
                                <input type="number" step="0.01" name="berat_badan" x-model="bb" @input="calculate()" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 md:px-6 py-3 md:py-4 text-slate-700 font-bold text-xs outline-none focus:ring-4 focus:ring-blue-500/20 transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tinggi Badan (TB) - cm</label>
                                <input type="number" step="0.01" name="tinggi_badan" x-model="tb" @input="calculate()" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 md:px-6 py-3 md:py-4 text-slate-700 font-bold text-xs outline-none focus:ring-4 focus:ring-blue-500/20 transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Lingkar Kepala (LK) - cm</label>
                                <input type="number" step="0.01" name="lingkar_kepala" x-model="lk" @input="calculate()" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 md:px-6 py-3 md:py-4 text-slate-700 font-bold text-xs outline-none focus:ring-4 focus:ring-blue-500/20 transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Lingkar Lengan (LLA) - cm</label>
                                <input type="number" step="0.01" name="lingkar_lengan_atas" :value="modalData.lingkar_lengan_atas" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 md:px-6 py-3 md:py-4 text-slate-700 font-bold text-xs outline-none focus:ring-4 focus:ring-blue-500/20 transition-all">
                            </div>
                        </div>

                        <!-- Visual Skala IMT -->
                        <div x-show="bmi > 0" class="mt-4 p-4 md:p-6 bg-white border border-slate-200 rounded-2xl transition-all shadow-sm" style="display: none;">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Estimasi Skala IMT (Mock)</span>
                                <span class="text-2xl font-black tracking-tighter" :class="{
                                    'text-blue-500': bmi < 18.5,
                                    'text-emerald-500': bmi >= 18.5 && bmi < 25,
                                    'text-amber-500': bmi >= 25 && bmi < 30,
                                    'text-red-500': bmi >= 30
                                }" x-text="bmi.toFixed(1)"></span>
                            </div>
                            <div class="relative h-4 rounded-full flex overflow-hidden">
                                <div class="h-full bg-blue-400" style="width: 46.25%"></div> <!-- Kurus <18.5 -->
                                <div class="h-full bg-emerald-400" style="width: 16.25%"></div> <!-- Normal 18.5-24.9 -->
                                <div class="h-full bg-amber-400" style="width: 12.5%"></div> <!-- Gemuk 25-29.9 -->
                                <div class="h-full bg-red-500" style="width: 25%"></div> <!-- Obesitas >=30 -->
                                <!-- Marker -->
                                <div class="absolute top-0 bottom-0 w-1.5 bg-slate-900 z-10 transition-all duration-500 shadow-[0_0_0_2px_white] rounded-full" :style="`left: ${Math.min((bmi / 40) * 100, 99)}%`"></div>
                            </div>
                            <div class="flex justify-between text-[8px] font-black uppercase text-slate-400 mt-2 px-1">
                                <span>Kurus</span>
                                <span>Normal</span>
                                <span>Gemuk</span>
                                <span>Obesitas</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-5 bg-slate-50 rounded-2xl border border-slate-100 mt-4">
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status BB/U</label>
                                <select name="status_bb_u" x-model="status_bb" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-600 outline-none transition-colors" :class="status_bb ? 'bg-blue-50 border-blue-200 font-bold text-blue-700' : ''">
                                    <option value="">Pilih Status...</option>
                                    <option value="Gizi Buruk">Gizi Buruk</option>
                                    <option value="Gizi Kurang">Gizi Kurang</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Gizi Lebih">Gizi Lebih</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status TB/U</label>
                                <select name="status_tb_u" x-model="status_tb" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-600 outline-none transition-colors" :class="status_tb ? 'bg-blue-50 border-blue-200 font-bold text-blue-700' : ''">
                                    <option value="">Pilih Status...</option>
                                    <option value="Sangat Pendek">Sangat Pendek</option>
                                    <option value="Pendek">Pendek</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Tinggi">Tinggi</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status LK/U</label>
                                <select name="status_lk_u" x-model="status_lk" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs text-slate-600 outline-none transition-colors" :class="status_lk ? 'bg-blue-50 border-blue-200 font-bold text-blue-700' : ''">
                                    <option value="">Pilih Status...</option>
                                    <option value="Mikrosefali">Mikrosefali</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Makrosefali">Makrosefali</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Catatan Tambahan</label>
                            <textarea name="catatan" x-model="catatan" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-6 py-4 text-slate-700 font-bold text-xs outline-none focus:ring-4 focus:ring-blue-500/20 transition-all leading-relaxed"></textarea>
                        </div>

                         <div class="sticky bottom-0 bg-white/95 backdrop-blur-sm -mx-4 md:-mx-8 px-4 md:px-8 py-4 border-t border-slate-50 flex justify-end z-30 mt-6 shrink-0">
                            <button type="submit" class="w-full md:w-max px-12 bg-slate-900 text-white py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl hover:bg-black transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3">
                                <i data-lucide="check-circle" class="w-4 h-4"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </template>

                <!-- ATEC / Wawancara / Kualitatif -->
                <template x-if="modalType === 'atec'">
                    <div class="space-y-8">
                        <div x-data="{ atecStep: 'I' }" class="p-4 md:p-8 border-2 border-dashed border-slate-100 rounded-[2rem] md:rounded-[2.5rem] space-y-6">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-red-50 rounded-2xl text-red-500"><i data-lucide="bar-chart-3" class="w-6 h-6"></i></div>
                                <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest italic">Kuesioner ATEC Digital</h3>
                            </div>
                            
                            <!-- Steps Navigation -->
                            <div class="flex flex-wrap gap-1.5 md:gap-2 border-b border-slate-100 pb-4">
                                <button type="button" @click="atecStep = 'I'" :class="atecStep === 'I' ? 'bg-slate-900 text-white shadow-md' : 'bg-slate-50 text-slate-400 hover:bg-slate-100'" class="px-3 md:px-4 py-2 rounded-xl text-[9px] md:text-[10px] font-black uppercase transition-all">I. Wicara</button>
                                <button type="button" @click="atecStep = 'II'" :class="atecStep === 'II' ? 'bg-slate-900 text-white shadow-md' : 'bg-slate-50 text-slate-400 hover:bg-slate-100'" class="px-3 md:px-4 py-2 rounded-xl text-[9px] md:text-[10px] font-black uppercase transition-all">II. Sosial</button>
                                <button type="button" @click="atecStep = 'III'" :class="atecStep === 'III' ? 'bg-slate-900 text-white shadow-md' : 'bg-slate-50 text-slate-400 hover:bg-slate-100'" class="px-3 md:px-4 py-2 rounded-xl text-[9px] md:text-[10px] font-black uppercase transition-all">III. Sensorik</button>
                                <button type="button" @click="atecStep = 'IV'" :class="atecStep === 'IV' ? 'bg-slate-900 text-white shadow-md' : 'bg-slate-50 text-slate-400 hover:bg-slate-100'" class="px-3 md:px-4 py-2 rounded-xl text-[9px] md:text-[10px] font-black uppercase transition-all">IV. Fisik</button>
                            </div>

                            <form action="{{ route('observasi.atec_digital') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                                
                                @foreach(['I' => 'Bagian I: Wicara / Bahasa / Komunikasi', 'II' => 'Bagian II: Kesadaran Sosial', 'III' => 'Bagian III: Kesadaran Sensorik / Kognitif', 'IV' => 'Bagian IV: Kesehatan / Fisik / Perilaku'] as $sec => $secTitle)
                                    <div x-show="atecStep === '{{ $sec }}'" class="space-y-4 max-h-[45vh] md:max-h-[50vh] overflow-y-auto pr-2 custom-scrollbar pb-4" style="display: none;">
                                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest sticky top-0 bg-white py-2 z-10">{{ $secTitle }}</h4>
                                        @foreach($qatec->where('section', $sec) as $q)
                                        <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100 space-y-3 hover:border-slate-200 transition-colors">
                                            <p class="text-[11px] font-bold text-slate-700 uppercase tracking-tight">{{ $q->no_urut }}. {{ $q->question_text }}</p>
                                            <div class="flex flex-wrap gap-2">
                                                @if(in_array($sec, ['I', 'II', 'III']))
                                                    <label class="cursor-pointer flex-1 md:flex-none">
                                                        <input type="radio" name="answers[{{ $q->id }}]" value="2" class="hidden peer">
                                                        <div class="px-3 md:px-4 py-2 rounded-xl border border-slate-200 text-[9px] font-black uppercase text-slate-400 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition-all text-center">Tidak Benar</div>
                                                    </label>
                                                    <label class="cursor-pointer flex-1 md:flex-none">
                                                        <input type="radio" name="answers[{{ $q->id }}]" value="1" class="hidden peer">
                                                        <div class="px-3 md:px-4 py-2 rounded-xl border border-slate-200 text-[9px] font-black uppercase text-slate-400 peer-checked:bg-amber-500 peer-checked:text-white peer-checked:border-amber-500 transition-all text-center">Agak Benar</div>
                                                    </label>
                                                    <label class="cursor-pointer flex-1 md:flex-none">
                                                        <input type="radio" name="answers[{{ $q->id }}]" value="0" class="hidden peer">
                                                        <div class="px-3 md:px-4 py-2 rounded-xl border border-slate-200 text-[9px] font-black uppercase text-slate-400 peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 transition-all text-center">Sangat Benar</div>
                                                    </label>
                                                @else
                                                    <label class="cursor-pointer flex-1 md:flex-none">
                                                        <input type="radio" name="answers[{{ $q->id }}]" value="0" class="hidden peer">
                                                        <div class="px-3 md:px-4 py-2 rounded-xl border border-slate-200 text-[9px] font-black uppercase text-slate-400 peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:border-emerald-500 transition-all text-center">Tidak Masalah</div>
                                                    </label>
                                                    <label class="cursor-pointer flex-1 md:flex-none">
                                                        <input type="radio" name="answers[{{ $q->id }}]" value="1" class="hidden peer">
                                                        <div class="px-3 md:px-4 py-2 rounded-xl border border-slate-200 text-[9px] font-black uppercase text-slate-400 peer-checked:bg-amber-500 peer-checked:text-white peer-checked:border-amber-500 transition-all text-center">Ringan</div>
                                                    </label>
                                                    <label class="cursor-pointer flex-1 md:flex-none">
                                                        <input type="radio" name="answers[{{ $q->id }}]" value="2" class="hidden peer">
                                                        <div class="px-3 md:px-4 py-2 rounded-xl border border-slate-200 text-[9px] font-black uppercase text-slate-400 peer-checked:bg-orange-500 peer-checked:text-white peer-checked:border-orange-500 transition-all text-center">Sedang</div>
                                                    </label>
                                                    <label class="cursor-pointer flex-1 md:flex-none">
                                                        <input type="radio" name="answers[{{ $q->id }}]" value="3" class="hidden peer">
                                                        <div class="px-3 md:px-4 py-2 rounded-xl border border-slate-200 text-[9px] font-black uppercase text-slate-400 peer-checked:bg-red-600 peer-checked:text-white peer-checked:border-red-600 transition-all text-center">Berat</div>
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                         <div class="sticky bottom-0 bg-white/95 backdrop-blur-sm -mx-4 md:-mx-8 px-4 md:px-8 py-4 border-t border-slate-50 flex flex-col md:flex-row gap-3 justify-end z-30 mt-6 shrink-0">
                                            @if($sec !== 'IV')
                                                <button type="button" @click="atecStep = '{{ $sec == 'I' ? 'II' : ($sec == 'II' ? 'III' : 'IV') }}'; $el.closest('.flex-1.overflow-y-auto').scrollTop = 0;" class="w-full md:w-auto bg-slate-900 text-white px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-black transition-all shadow-lg flex items-center justify-center gap-2">
                                                    Lanjut ke Bagian {{ $sec == 'I' ? 'II' : ($sec == 'II' ? 'III' : 'IV') }} <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                                </button>
                                            @else
                                                <button type="submit" class="w-full md:w-auto bg-slate-900 text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-black shadow-lg transform active:scale-95 transition-transform flex items-center justify-center">
                                                    Simpan & Hitung Skor ATEC
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </template>

                <!-- Wawancara -->
                <template x-if="modalType === 'wawancara'">
                    <div class="p-4 md:p-8 bg-slate-50 rounded-[2rem] md:rounded-[2.5rem] space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-slate-900 rounded-2xl text-white"><i data-lucide="mic-2" class="w-6 h-6"></i></div>
                            <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest italic">Wawancara & Anamnesis</h3>
                        </div>
                        <form action="{{ route('observasi.wawancara') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                            <div class="space-y-4 max-h-[45vh] md:max-h-[50vh] overflow-y-auto pr-2 custom-scrollbar pb-4">
                                @foreach ($qwawancara as $index => $q)
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $q->question_text }}</label>
                                    <textarea name="answers[{{ $q->id }}]" class="w-full border border-slate-200 rounded-2xl p-4 text-xs" rows="2" placeholder="Intisari jawaban..."></textarea>
                                </div>
                                @endforeach
                            </div>
                             <div class="sticky bottom-0 bg-white/95 backdrop-blur-sm -mx-4 md:-mx-8 px-4 md:px-8 py-4 border-t border-slate-50 flex justify-end z-30 mt-6 shrink-0">
                                <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-black shadow-lg transform active:scale-95 transition-transform">Simpan Wawancara</button>
                            </div>
                        </form>
                    </div>
                </template>

                <!-- Qualitative Notes (Perilaku/Sensorik) -->
                <style>
                    /* Fallback for Qualitative Forms when Tailwind JIT purges dynamic classes */
                    .qual-baik-active { border-color: #10b981 !important; background-color: #ecfdf5 !important; color: #064e3b !important; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
                    .qual-baik-icon { background-color: #10b981 !important; color: white !important; transform: scale(1.1); }
                    .qual-kurang-active { border-color: #f43f5e !important; background-color: #fff1f2 !important; color: #881337 !important; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
                    .qual-kurang-icon { background-color: #f43f5e !important; color: white !important; transform: scale(1.1); }
                </style>
                <div x-data="qualitativeData()" 
                     @sync-qualitative.window="handleSync($event.detail)"
                     x-show="['hpperilaku', 'hpsensorik', 'edit_qualitative'].includes(modalType)" 
                     style="display: none;">
                    <div class="mt-4">
                        <form :action="modalType === 'edit_qualitative' ? (modalData.jenis === 'HpPerilaku' ? `/observasi/hpperilaku/${modalData.id}` : `/observasi/hpsensorik/${modalData.id}`) : (modalType === 'hpperilaku' ? '{{ route('observasi.hpperilaku') }}' : '{{ route('observasi.hpsensorik') }}')" method="POST" class="flex flex-col space-y-6">
                            @csrf
                            <template x-if="modalType === 'edit_qualitative'">
                                <input type="hidden" name="_method" value="PATCH">
                            </template>
                            <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                            
                            <!-- Checklist Observasi -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-h-[50vh] md:max-h-[55vh] overflow-y-auto pr-3 custom-scrollbar mb-4">
                                <template x-for="(items, key) in ((modalType === 'hpperilaku' || (modalType === 'edit_qualitative' && modalData.jenis === 'HpPerilaku')) ? perilaku : sensorik)" :key="key">
                                    <div class="p-4 md:p-5 bg-white border border-slate-200 shadow-sm rounded-[1.5rem] md:rounded-3xl h-max">
                                        <h4 class="text-[10px] md:text-[11px] font-black text-slate-800 uppercase tracking-widest mb-3 flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                            <span x-text="key.replace(/_/g, ' ')"></span>
                                        </h4>
                                        <div class="flex flex-col gap-2 mt-4">
                                            <template x-for="(item, index) in items" :key="index">
                                                <label class="relative cursor-pointer group">
                                                    <input type="checkbox" x-model="item.checked" @change="generate(modalType, modalData)" class="peer sr-only">
                                                    <div class="px-4 py-3 rounded-2xl border-2 transition-all duration-300 flex items-center gap-3"
                                                         :class="item.checked ? (item.val === 'baik' ? 'qual-baik-active' : 'qual-kurang-active') : 'border-slate-100 bg-slate-50 text-slate-500 hover:bg-slate-100 hover:border-slate-200'">
                                                         <div class="w-5 h-5 shrink-0 rounded-lg flex items-center justify-center transition-all duration-300 transform"
                                                              :class="item.checked ? (item.val === 'baik' ? 'qual-baik-icon' : 'qual-kurang-icon') : 'bg-slate-200 text-transparent scale-100'">
                                                             <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                                         </div>
                                                        <span class="text-[11px] font-bold leading-relaxed" x-text="item.text"></span>
                                                    </div>
                                                </label>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <div class="rounded-[2rem] overflow-hidden border border-slate-200 bg-white summernote-wrapper">
                                <textarea id="summernote-editor" name="deskripsi" class="summernote w-full min-h-[400px] p-6 outline-none text-slate-700"></textarea>
                            </div>
                             <div class="sticky bottom-0 bg-white/95 backdrop-blur-sm -mx-4 md:-mx-8 px-4 md:px-8 py-4 border-t border-slate-50 flex justify-end z-30 mt-6 shrink-0">
                                <button type="submit" class="w-full md:w-max px-12 bg-slate-900 text-white py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl hover:bg-black transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3">
                                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Assessment Kualitatif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Clinical Result Display (Refactored) -->
                <template x-if="modalType === 'result'">
                    <div class="space-y-6 md:space-y-8">
                        <div class="bg-slate-900 text-white p-6 md:p-8 rounded-[1.5rem] md:rounded-[2rem] -mt-4 mx-1 md:mx-2">
                             <div class="flex items-center justify-between gap-4">
                                <div class="space-y-1">
                                    <h5 class="text-xs md:text-sm font-black uppercase tracking-widest text-emerald-400 italic">Clinical Examination Result</h5>
                                    <p class="text-[9px] md:text-[10px] font-bold text-slate-400 uppercase tracking-widest" x-text="modalData.jenis + ' • ' + modalData.created_at"></p>
                                </div>
                                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="shield-check" class="text-emerald-400"></i>
                                </div>
                             </div>
                        </div>

                        <div class="p-2 md:p-4">
                            <template x-if="modalData.is_atec">
                                <div class="card-premium p-1 md:p-2 bg-slate-50 border border-slate-100 rounded-3xl overflow-hidden">
                                    <img :src="modalData.image_url" class="w-full rounded-2xl shadow-sm">
                                </div>
                            </template>

                            <template x-if="!modalData.is_atec">
                                <div class="flex flex-col items-center text-center space-y-6 md:space-y-8 py-4 md:py-8">
                                    <div class="w-16 h-16 md:w-20 md:h-20 bg-emerald-50 rounded-2xl md:rounded-[2rem] flex items-center justify-center text-emerald-500 shadow-sm animate-bounce">
                                        <i data-lucide="check-circle" class="w-8 h-8 md:w-10 md:h-10"></i>
                                    </div>

                                    <div class="space-y-4 md:space-y-6 w-full">
                                        <div>
                                            <h6 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Interpretasi Diagnostik</h6>
                                            <p class="text-xl md:text-3xl font-black uppercase italic tracking-tighter leading-tight" 
                                               :class="(modalData.jenis === 'ATEC Kuesioner' && modalData.total_skor > 50) || ['Penyimpangan', 'Curiga Gangguan Penglihatan', 'Risiko Autisme', 'Kemungkinan GPPH'].includes(modalData.hasil) ? 'text-red-500' : 'text-slate-800'"
                                               x-text="modalData.hasil"></p>
                                        </div>
                                        <div class="p-5 md:p-8 bg-slate-50 rounded-[1.5rem] md:rounded-[2.5rem] border border-slate-100 max-w-lg mx-auto">
                                            <h6 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3" x-text="modalData.jenis === 'ATEC Kuesioner' ? 'Kesimpulan ATEC' : 'Rekomendasi Klinis'"></h6>
                                            <p class="text-xs font-bold leading-relaxed" 
                                               :class="(modalData.jenis === 'ATEC Kuesioner' && modalData.total_skor > 50) || ['Penyimpangan', 'Curiga Gangguan Penglihatan', 'Risiko Autisme', 'Kemungkinan GPPH'].includes(modalData.hasil) ? 'text-red-500' : 'text-emerald-600 uppercase tracking-tight'">
                                                
                                                <template x-if="modalData.jenis === 'ATEC Kuesioner'">
                                                    <div class="space-y-4">
                                                        <div class="p-4 bg-white border border-slate-200 shadow-sm rounded-2xl text-slate-600 font-bold text-[10px]" x-text="modalData.interpretasi"></div>
                                                        <div class="font-black text-xs uppercase" x-text="modalData.kesimpulan"></div>
                                                    </div>
                                                </template>

                                                <template x-if="modalData.jenis !== 'ATEC Kuesioner'">
                                                    <span>
                                                        <template x-if="modalData.interpretasi">
                                                            <span x-text="modalData.interpretasi"></span>
                                                        </template>
                                                        <template x-if="!modalData.interpretasi">
                                                            <span>
                                                                <template x-if="['Penyimpangan', 'Curiga Gangguan Penglihatan', 'Risiko Autisme', 'Kemungkinan GPPH'].includes(modalData.hasil)">
                                                                    <span>{{ $penyimpangan }}</span>
                                                                </template>
                                                                <template x-if="!['Penyimpangan', 'Curiga Gangguan Penglihatan', 'Risiko Autisme', 'Kemungkinan GPPH'].includes(modalData.hasil)">
                                                                    <span>{{ $sesuaiUmur }}</span>
                                                                </template>
                                                            </span>
                                                        </template>
                                                    </span>
                                                </template>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- Legacy Modals Removed - Unified via Alpine.js --}}
</div>
@endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<style>
    .summernote-wrapper .note-editor.note-frame { 
        border: none !important; 
        border-radius: 2rem !important; 
        overflow: hidden; 
        background: #f8fafc;
        box-shadow: inset 0 2px 4px 0 rgba(0,0,0,0.02);
    }
    
    /* Responsive Summernote Fix */
    .note-editor.note-frame {
        width: 100% !important;
        max-width: 100% !important;
        border: none !important;
        border-radius: 2rem !important;
        overflow: hidden !important;
    }
    .note-editable {
        background: white !important;
        font-size: 15px !important;
        font-family: inherit !important;
        min-height: 400px !important;
        padding: 2rem !important;
    }
    .note-toolbar {
        background: #f8fafc !important;
        border-bottom: 1px solid #f1f5f9 !important;
        padding: 1rem !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') lucide.createIcons();
    });

    $(document).ready(function() {
        // Summernote initialization for modals
        window.initSummernote = function() {
            const $target = $('#summernote-editor, .summernote');
            
            // Check if it already has an editor attached
            if ($target.next('.note-editor').length) return;
            
            $target.summernote({
                height: 450,
                placeholder: 'Tuliskan hasil observasi secara mendalam di sini agar terekam dalam resume medik...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'table']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                callbacks: {
                    onInit: function() {
                        $('.note-editor').addClass('rounded-[2rem] border-0');
                        if (typeof lucide !== 'undefined') lucide.createIcons();
                    }
                }
            });
        };

        // Mutation observer remains as fallback for non-Alpine triggered changes if any
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if ($('#summernote-editor').length && !$('.note-editor').length) {
                    initSummernote();
                }
            });
        });

        observer.observe(document.body, { childList: true, subtree: true });
    });

    function confirmDelete(e) {
        e.preventDefault();
        const form = e.target.closest('form');
        
        // Ensure SweetAlert2 is available
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: window.primaryColor,
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'rounded-xl shadow-lg font-black tracking-widest',
                    cancelButton: 'rounded-xl font-black tracking-widest',
                    popup: 'rounded-[2rem] border-0'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        } else {
            // Fallback
            if(confirm('Yakin ingin menghapus data ini?')) form.submit();
        }
    }

    function qualitativeData() {
        return {
            handleSync(detail) {
                const html = detail.html || '';
                const cleanText = html.replace(/<[^>]*>?/gm, ' ').replace(/\s+/g, ' ').toLowerCase();
                const datasetName = detail.jenis === 'HpPerilaku' ? 'perilaku' : 'sensorik';
                const dataset = this[datasetName];
                
                // Reset all
                Object.values(this.perilaku).forEach(cat => cat.forEach(i => i.checked = false));
                Object.values(this.sensorik).forEach(cat => cat.forEach(i => i.checked = false));
                
                if (cleanText) {
                    Object.values(dataset).forEach(cat => {
                        cat.forEach(i => {
                            if (cleanText.includes(i.text.toLowerCase())) {
                                i.checked = true;
                            }
                        });
                    });
                }
                // Call generate after sync
                this.generate(detail.mType, detail.mData);
            },
            init() {
                // Initial generation logic moved to handleSync and checkbox events for better stability
            },
            perilaku: {
                motorik_kasar: [
                    { text: 'Bisa duduk sendiri', checked: false, val: 'baik' },
                    { text: 'Bisa berdiri tanpa bantuan', checked: false, val: 'baik' },
                    { text: 'Bisa berjalan dengan stabil', checked: false, val: 'baik' },
                    { text: 'Bisa berlari, melompat', checked: false, val: 'baik' },
                    { text: 'Belum bisa lempar tangkap bola', checked: false, val: 'kurang' },
                    { text: 'Anak mampu melempar bola namun belum bisa menangkap bola', checked: false, val: 'kurang' }
                ],
                motorik_halus: [
                    { text: 'Bisa memegang pensil dengan baik', checked: false, val: 'baik' },
                    { text: 'Bisa mencoret/menggambar sederhana', checked: false, val: 'baik' },
                    { text: 'Bisa memasukkan benda kedalam lubang', checked: false, val: 'baik' },
                    { text: 'Belum bisa membuka dan menutup tutup botol', checked: false, val: 'kurang' }
                ],
                kemampuan_bicara_dan_bahasa: [
                    { text: 'Bisa memahami instruksi sederhana', checked: false, val: 'baik' },
                    { text: 'Bisa mengucapkan kata-kata', checked: false, val: 'baik' },
                    { text: 'Mau berkomunikasi dua arah', checked: false, val: 'baik' },
                    { text: 'Belum bisa merangkai kalimat sederhana', checked: false, val: 'kurang' }
                ],
                kognitif_dan_problem_solving: [
                    { text: 'Bisa mengenal warna, bentuk, atau angka', checked: false, val: 'baik' },
                    { text: 'Belum bisa mencocokkan benda', checked: false, val: 'kurang' },
                    { text: 'Bisa memecahkan masalah sederhana (menyelesaikan puzzle)', checked: false, val: 'baik' },
                    { text: 'Belum bisa memahami sebab akibat', checked: false, val: 'kurang' }
                ],
                perilaku_dan_sosial_emosional: [
                    { text: 'Bisa kontak mata saat berinteraksi', checked: false, val: 'baik' },
                    { text: 'Menunjukkan minat pada orang lain', checked: false, val: 'baik' },
                    { text: 'Bisa bermain bersama', checked: false, val: 'baik' },
                    { text: 'Ada perilaku khusus (menyanyi/ bicara sendiri)', checked: false, val: 'kurang' },
                    { text: 'Menunjukkan emosi (senang) dengan sesuai', checked: false, val: 'baik' }
                ],
                sensory: [
                    { text: 'Anak tidak sensitif terhadap suara cahaya atau sentuhan', checked: false, val: 'baik' },
                    { text: 'Anak tidak mencari rangsangan berlebihan (berputar, lompat-lompat, menggigit)', checked: false, val: 'baik' },
                    { text: 'Anak tidak menghindari atau tidak suka di sentuh', checked: false, val: 'baik' },
                    { text: 'Tidak ada perilaku mengendus, menjilati, atau mengecap benda berlebihan', checked: false, val: 'baik' }
                ],
                pemeriksaan_perilaku_khusus_dan_rutinitas: [
                    { text: 'Anak stiming', checked: false, val: 'kurang' },
                    { text: 'Anak tidak mengepakkan tangan (flapping)', checked: false, val: 'baik' },
                    { text: 'Anak tidak mengayun tubuh', checked: false, val: 'baik' },
                    { text: 'Anak tidak berputar-putar', checked: false, val: 'baik' },
                    { text: 'Anak tidak menggigit benda atau diri sendiri', checked: false, val: 'baik' },
                    { text: 'Anak tidak memutar benda secara berulang', checked: false, val: 'baik' },
                    { text: 'Anak tidak melihat benda berputar (kipas, roda)', checked: false, val: 'baik' },
                    { text: 'Anak terfokus pada satu jenis mainanan (menara donat)', checked: false, val: 'kurang' },
                    { text: 'Anak sering menyusun benda secara berulang', checked: false, val: 'kurang' },
                    { text: 'Anak tidak mengulangi topik atau kata yang sama terus menerus', checked: false, val: 'baik' },
                    { text: 'Anak tidak marah atau tantrum jika rutinitas berubah', checked: false, val: 'baik' },
                    { text: 'Anak tidak sulit beradaptasi dengan lingkungan baru', checked: false, val: 'baik' },
                    { text: 'Anak tidak kaku terhadap urutan kegiatan', checked: false, val: 'baik' },
                    { text: 'Anak pilih-pilih makanan (tidak makan buah-buahan dan nasi jika basah)', checked: false, val: 'kurang' }
                ]
            },
            sensorik: {
                sensory_visual: [
                    { text: 'Anak dapat melakukan kontak mata namun dengan durasi yang singkat kurang dari 10 detik', checked: false, val: 'kurang' },
                    { text: 'Anak dapat fokus pada satu objek tertentu', checked: false, val: 'baik' },
                    { text: 'Anak sudah mengenal huruf abjad A-Z, warna, angka dan hewan', checked: false, val: 'baik' }
                ],
                sensory_taktil: [
                    { text: 'Anak dapat memegang tekstur kasar seperti spons kasar, beras dan kacang ijo', checked: false, val: 'baik' },
                    { text: 'Anak merasa nyaman saat berjalan di karpet rumput', checked: false, val: 'baik' }
                ],
                sensory_vestibular: [
                    { text: 'Anak mampu menjaga keseimbangannya saat berjalan di papan titian dan gymball', checked: false, val: 'baik' }
                ],
                sensory_propioceptif: [
                    { text: 'Posisi tubuh anak baik dalam melompat, berjalan lurus tanpa mudah terjatuh', checked: false, val: 'baik' },
                    { text: 'Sering menabrak benda atau terlihat canggung', checked: false, val: 'kurang' }
                ],
                sensory_olfactory_gustatory: [
                    { text: 'Anak tidak suka makan nasi dengan tekstur berair atau berkuah', checked: false, val: 'kurang' },
                    { text: 'Mencium aroma benda bukan makanan secara berlebihan', checked: false, val: 'kurang' }
                ],
                postur_anak: [
                    { text: 'Flat foot pada kaki kanan', checked: false, val: 'kurang' },
                    { text: 'Tangan anak tremor saat memegang benda (donat)', checked: false, val: 'kurang' },
                    { text: 'Pola jalan normal', checked: false, val: 'baik' }
                ]
            },
            generate(mType, mData = {}) {
                const isPerilaku = (mType === 'hpperilaku' || (mType === 'edit_qualitative' && mData.jenis === 'HpPerilaku'));
                const dataset = isPerilaku ? this.perilaku : this.sensorik;
                const judul = isPerilaku ? 'Perilaku' : 'Sensorik';
                
                if (!dataset) return;
                
                let baikGroups = {};
                let kurangGroups = {};

                const categoryMap = {
                    motorik_kasar: 'Motorik Kasar',
                    motorik_halus: 'Motorik Halus',
                    kemampuan_bicara_dan_bahasa: 'Bicara & Bahasa',
                    kognitif_dan_problem_solving: 'Kognitif & Problem Solving',
                    perilaku_dan_sosial_emosional: 'Perilaku & Sosial Emosional',
                    sensory: 'Sensori',
                    sensory_visual: 'Sensori Visual',
                    sensory_auditory: 'Sensori Auditori',
                    sensory_taktil: 'Sensori Taktil',
                    sensory_vestibular: 'Sensori Vestibular',
                    sensory_propioceptif: 'Sensori Proprioseptif',
                    sensory_olfactory_gustatory: 'Sensori Olfaktori & Gustatori',
                    postur_anak: 'Postur & Fisik'
                };

                for (const [key, items] of Object.entries(dataset)) {
                    let sectionChecked = items.filter(i => i.checked);
                    if(sectionChecked.length > 0) {
                        let catName = categoryMap[key] || key.replace(/_/g, ' ').toUpperCase();
                        sectionChecked.forEach(i => {
                            if(i.val === 'baik') {
                                if(!baikGroups[catName]) baikGroups[catName] = [];
                                baikGroups[catName].push(i.text);
                            } else {
                                if(!kurangGroups[catName]) kurangGroups[catName] = [];
                                kurangGroups[catName].push(i.text);
                            }
                        });
                    }
                }


                let kesimpulan = `<p style="text-align: justify; font-size: 14px; margin-bottom: 12px; color: #475569;">Berdasarkan evaluasi klinis yang dilakukan secara komprehensif, berikut adalah ringkasan temuan perkembangan ananda yang dikelompokkan berdasarkan area fungsional:</p>`;
                
                if (Object.keys(baikGroups).length > 0 || Object.keys(kurangGroups).length > 0) {
                    // SEKSI POSITIF
                    if (Object.keys(baikGroups).length > 0) {
                        kesimpulan += `<div style="margin-bottom: 16px; background-color: #f8fafc; padding: 12px; border-radius: 4px;">`;
                        kesimpulan += `<p style="font-size: 14px; margin-bottom: 8px; color: #065f46;"><b>TEMUAN POSITIF & POTENSI FUNGSIONAL:</b></p>`;
                        
                        for (const [cat, items] of Object.entries(baikGroups)) {
                            kesimpulan += `<p style="font-size: 13px; margin-bottom: 4px; color: #334155; text-decoration: underline;"><b>${cat}:</b></p>`;
                            kesimpulan += `<ul style="font-size: 13px; margin-bottom: 10px; list-style-type: square; padding-left: 20px;">`;
                            items.forEach(item => kesimpulan += `<li style="margin-bottom: 2px;">${item.charAt(0).toUpperCase() + item.slice(1)}</li>`);
                            kesimpulan += `</ul>`;
                        }
                        kesimpulan += `</div>`;
                    }
                    
                    // SEKSI HAMBATAN
                    if (Object.keys(kurangGroups).length > 0) {
                        kesimpulan += `<div style="margin-bottom: 16px; background-color: #fffafb; padding: 12px; border-radius: 4px;">`;
                        kesimpulan += `<p style="font-size: 14px; margin-bottom: 8px; color: #991b1b;"><b>INDIKASI HAMBATAN & RENCANA INTERVENSI:</b></p>`;
                        
                        for (const [cat, items] of Object.entries(kurangGroups)) {
                            kesimpulan += `<p style="font-size: 13px; margin-bottom: 4px; color: #7f1d1d; text-decoration: underline;"><b>${cat}:</b></p>`;
                            kesimpulan += `<ul style="font-size: 13px; margin-bottom: 10px; list-style-type: square; padding-left: 20px;">`;
                            items.forEach(item => kesimpulan += `<li style="margin-bottom: 2px;">${item.charAt(0).toUpperCase() + item.slice(1)}</li>`);
                            kesimpulan += `</ul>`;
                        }
                        kesimpulan += `</div>`;
                    }

                    kesimpulan += `<p style="font-size: 13px; color: #64748b; margin-top: 10px;"><i>Catatan: Hasil ini merupakan bagian dari evaluasi klinis awal dan akan ditinjau kembali sesuai dengan respon intervensi.</i></p>`;
                } else {
                    kesimpulan += `<p style="font-size: 14px; color: #64748b; font-style: italic;">(Belum ada data observasi klinis yang dicatat untuk periode ini.)</p>`;
                }
                
                const $editor = window.jQuery || window.$;
                if ($editor) $editor('#summernote-editor').summernote('code', kesimpulan);
            }
        }
    }
</script>
@endsection
