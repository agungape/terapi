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
                        {{ $umur }} - PASIEN AKTIF
                    </span>
                </div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.3em]">ID PASIEN: {{ $anak->nib }} • TERDAFTAR: {{ \Carbon\Carbon::parse($anak->created_at)->format('d F Y') }}</p>
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
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <!-- M-CHAT -->
            <button @click="openModal('autis')" class="card-premium p-6 bg-white hover:bg-indigo-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600 mx-auto group-hover:scale-110 transition-transform">
                    <i data-lucide="brain-circuit" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">M-CHAT</p>
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

            <!-- KMPE -->
            <button @click="openModal('perilaku')" class="card-premium p-6 bg-white hover:bg-blue-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mx-auto group-hover:scale-110 transition-transform">
                    <i data-lucide="smile" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">KMPE</p>
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
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Pendengaran</p>
                </div>
            </button>

            <!-- Penglihatan -->
            <button @click="openModal('penglihatan')" class="card-premium p-6 bg-white hover:bg-amber-50 border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600 mx-auto group-hover:scale-110 transition-transform">
                    <i data-lucide="eye" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-800">Lihat</p>
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">Penglihatan</p>
                </div>
            </button>

            <!-- ATEC/Wawancara -->
            <button @click="openModal('atec')" class="card-premium p-6 bg-slate-900 hover:bg-black border-none transition-all group text-center space-y-3">
                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-white mx-auto group-hover:scale-110 transition-transform">
                    <i data-lucide="clipboard-list" class="w-6 h-6"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-white">Lainnya</p>
                    <p class="text-[8px] font-bold text-slate-400 uppercase leading-none">ATEC/Talk</p>
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
                                @forelse ($hasil as $h)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 text-xs font-bold text-slate-500 tracking-tight">{{ \Carbon\Carbon::parse($h->created_at)->format('d M Y') }}</td>
                                    <td class="px-6 py-4 font-black text-xs text-slate-700 uppercase tracking-tighter italic">{{ $h->jenis }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            @if ($h->jenis !== 'Wawancara')
                                                <button class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all border border-blue-100"
                                                        @click="openModal('result', { 
                                                            id: '{{ $h->id }}', 
                                                            jenis: '{{ $h->jenis }}', 
                                                            hasil: '{{ $h->hasil }}', 
                                                            created_at: '{{ \Carbon\Carbon::parse($h->created_at)->translatedFormat('d F Y') }}',
                                                            is_atec: {{ $h->jenis == 'ATEC' ? 'true' : 'false' }},
                                                            image_url: '{{ asset('storage/atec/' . $h->hasil) }}'
                                                        })">
                                                    <i data-lucide="eye" class="w-3.5 h-3.5 inline mr-1"></i> Result
                                                </button>
                                            @endif
                                            @if (!In_array($h->jenis, ['Penyimpangan Penglihatan', 'ATEC', 'Wawancara']))
                                                <a href="{{ route('observasi.detail', ['hasil' => $h->id]) }}"
                                                   class="px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition-all border border-emerald-100">
                                                    <i data-lucide="list" class="w-3.5 h-3.5 inline mr-1"></i> Responses
                                                </a>
                                            @endif
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

                <!-- Observasi Kualitatif -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Perilaku -->
                    <div class="card-premium p-8 bg-white shadow-xl shadow-slate-200/50">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                <i data-lucide="activity" class="w-4 h-4 text-blue-500"></i> OBS. PERILAKU
                            </h3>
                            <button @click="openModal('hpperilaku')" class="p-2 bg-slate-50 rounded-xl hover:bg-blue-50 transition-colors text-blue-600">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <div class="space-y-4">
                            @foreach ($hpperilaku as $perilaku)
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:border-blue-400 transition-all cursor-pointer group" 
                                 @click="openModal('result', { 
                                                            id: '{{ $perilaku->id }}', 
                                                            jenis: 'OBSERVASI PERILAKU', 
                                                            hasil: '{{ strip_tags($perilaku->hasil) }}', 
                                                            created_at: '{{ \Carbon\Carbon::parse($perilaku->created_at)->translatedFormat('d F Y') }}',
                                                            is_atec: false
                                                        })">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black text-slate-700 tracking-tight uppercase italic">{{ \Carbon\Carbon::parse($perilaku->created_at)->format('d M Y') }}</span>
                                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:translate-x-1 transition-transform"></i>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sensorik -->
                    <div class="card-premium p-8 bg-white shadow-xl shadow-slate-200/50">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                <i data-lucide="waves" class="w-4 h-4 text-amber-500"></i> OBS. SENSORIK
                            </h3>
                            <button @click="openModal('hpsensorik')" class="p-2 bg-slate-50 rounded-xl hover:bg-amber-50 transition-colors text-amber-600">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <div class="space-y-4">
                            @foreach ($hpsensorik as $sensorik)
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 hover:border-amber-400 transition-all cursor-pointer group" 
                                 @click="openModal('result', { 
                                                            id: '{{ $sensorik->id }}', 
                                                            jenis: 'OBSERVASI SENSORIK', 
                                                            hasil: '{{ strip_tags($sensorik->hasil) }}', 
                                                            created_at: '{{ \Carbon\Carbon::parse($sensorik->created_at)->translatedFormat('d F Y') }}',
                                                            is_atec: false
                                                        })">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black text-slate-700 tracking-tight uppercase italic">{{ \Carbon\Carbon::parse($sensorik->created_at)->format('d M Y') }}</span>
                                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300 group-hover:translate-x-1 transition-transform"></i>
                                </div>
                            </div>
                            @endforeach
                        </div>
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
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>

        <!-- Modal Content Container -->
        <div class="bg-white rounded-[2.5rem] shadow-2xl w-full max-h-[90vh] overflow-y-auto relative z-10 border border-slate-100"
             :class="modalType === 'result' ? 'max-w-2xl' : 'max-w-4xl'"
             x-show="modalOpen"
             x-effect="if(modalOpen) { 
                $nextTick(() => { 
                    if(typeof lucide !== 'undefined') lucide.createIcons(); 
                    if(['hpperilaku', 'hpsensorik'].includes(modalType)) {
                        if (typeof initSummernote === 'function') initSummernote();
                    }
                }); 
             }"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <div class="sticky top-0 bg-white/80 backdrop-blur-md border-b border-slate-50 p-6 flex items-center justify-between z-20">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-red-50 text-red-500 rounded-xl">
                        <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-sm font-black uppercase tracking-widest text-slate-800" x-text="modalType.toUpperCase()"></h3>
                </div>
                <button @click="closeModal()" class="w-10 h-10 flex items-center justify-center bg-slate-50 text-slate-400 rounded-full hover:bg-slate-100 hover:text-red-500 transition-all">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="p-8">
                <!-- M-CHAT / Autis Form -->
                <template x-if="modalType === 'autis'">
                    <form action="{{ route('observasi.autis') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                        <div class="space-y-4">
                            @foreach ($qautis as $index => $q)
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 p-6 bg-slate-50 border border-slate-100 rounded-3xl">
                                <p class="text-sm font-black text-slate-700 leading-relaxed uppercase tracking-tight flex-1">
                                    <span class="text-slate-300 mr-2">#{{ $index + 1 }}</span> {{ $q->question_text }}
                                </p>
                                <div class="flex gap-2 min-w-max">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="answers[{{ $q->id }}]" value="ya" class="hidden peer" required>
                                        <div class="px-6 py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600 transition-all">Sesuai</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="answers[{{ $q->id }}]" value="tidak" class="hidden peer">
                                        <div class="px-6 py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition-all">Tidak</div>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="submit" class="w-full bg-indigo-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl">Simpan Hasil M-CHAT</button>
                    </form>
                </template>

                <!-- GPPH Form -->
                <template x-if="modalType === 'gpph'">
                    <form action="{{ route('observasi.gpph') }}" method="POST">
                        @csrf
                        <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                        <div class="overflow-hidden border border-slate-100 rounded-3xl mb-8">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50 border-b border-slate-100">
                                    <tr class="text-center">
                                        <th class="px-6 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest text-left">Aspek Pengamatan</th>
                                        <th class="px-4 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest w-16 italic">Tidak</th>
                                        <th class="px-4 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest w-16">Kadang</th>
                                        <th class="px-4 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest w-16">Sering</th>
                                        <th class="px-4 py-4 text-[9px] font-black text-slate-400 uppercase tracking-widest w-16">Selalu</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach ($qgpph as $index => $q)
                                    <tr class="hover:bg-slate-50/50">
                                        <td class="px-6 py-4">
                                            <p class="text-xs font-black text-slate-700 uppercase italic tracking-tight leading-relaxed">{{ $q->question_text }}</p>
                                        </td>
                                        @for ($i = 0; $i <= 3; $i++)
                                        <td class="px-4 py-4 text-center">
                                            <input type="radio" name="answers[{{ $q->id }}]" value="{{ $i }}" {{ $i==0 ? 'required' : '' }} class="accent-emerald-600">
                                        </td>
                                        @endfor
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="w-full bg-emerald-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl">Finalisasi Scoring GPPH</button>
                    </form>
                </template>

                <!-- KMPE Form -->
                <template x-if="modalType === 'perilaku'">
                    <form action="{{ route('observasi.perilaku') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                        <div class="space-y-4">
                            @foreach ($qperilaku as $index => $q)
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 p-6 bg-slate-50 border border-slate-100 rounded-3xl">
                                <p class="text-sm font-black text-slate-700 leading-relaxed uppercase tracking-tight flex-1 italic">
                                    <span class="text-slate-300 mr-2">Q:</span> {{ $q->question_text }}
                                </p>
                                <div class="flex gap-2 min-w-max">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="answers[{{ $q->id }}]" value="ya" class="hidden peer" required>
                                        <div class="px-6 py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 transition-all">Ya</div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="answers[{{ $q->id }}]" value="tidak" class="hidden peer">
                                        <div class="px-6 py-2 rounded-xl border border-slate-200 text-[10px] font-black uppercase text-slate-400 peer-checked:bg-slate-200 peer-checked:text-slate-600 peer-checked:border-slate-300 transition-all">Tidak</div>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl">Submit Kuesioner KMPE</button>
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
                                                    <input type="radio" name="answers[{{ $q->id }}]" value="ya" class="accent-purple-600">
                                                    <input type="radio" name="answers[{{ $q->id }}]" value="tidak" class="accent-red-500">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="submit" class="w-full bg-purple-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest">Simpan Laporan Pendengaran</button>
                    </form>
                </template>

                <!-- Penglihatan Form -->
                <template x-if="modalType === 'penglihatan'">
                    <form action="{{ route('observasi.penglihatan') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                        <div class="grid grid-cols-1 gap-4">
                            @foreach ($qpenglihatan as $p)
                            <label class="relative block cursor-pointer group">
                                <input type="radio" name="hasil" value="{{ $p->interpretasi }}" class="hidden peer" required>
                                <div class="p-6 md:p-8 bg-slate-50 border-2 border-slate-100 rounded-[2rem] md:rounded-[2.5rem] transition-all duration-300 peer-checked:bg-white peer-checked:border-amber-500 peer-checked:shadow-xl peer-checked:ring-4 peer-checked:ring-amber-500/10 group-hover:bg-white group-hover:border-slate-200 flex items-center justify-between">
                                    <div class="flex items-center gap-4 md:gap-6">
                                        <div class="w-8 h-8 rounded-2xl border-2 border-slate-200 peer-checked:border-amber-500 flex items-center justify-center transition-all bg-white shadow-sm ring-offset-2 peer-checked:ring-2 peer-checked:ring-amber-500">
                                            <div class="w-4 h-4 rounded-lg bg-amber-500 opacity-0 scale-50 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300"></div>
                                        </div>
                                        <div class="space-y-1">
                                            <p class="text-xs md:text-sm font-black text-slate-700 uppercase tracking-tight italic transition-colors peer-checked:text-amber-600">{{ $p->question_text }}</p>
                                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest opacity-0 peer-checked:opacity-100 transition-all">Selected Category</p>
                                        </div>
                                    </div>
                                    <div class="opacity-0 translate-x-4 peer-checked:opacity-100 peer-checked:translate-x-0 transition-all duration-300 text-amber-500">
                                        <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                                    </div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        <button type="submit" class="w-full bg-slate-900 text-white py-5 rounded-[2rem] text-xs font-black uppercase tracking-widest shadow-2xl">Finalisasi Laporan Penglihatan</button>
                    </form>
                </template>

                <!-- ATEC / Wawancara / Kualitatif -->
                <template x-if="modalType === 'atec'">
                    <div class="space-y-8">
                        <div class="p-8 border-2 border-dashed border-slate-100 rounded-[2.5rem] space-y-6">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-red-50 rounded-2xl text-red-500"><i data-lucide="bar-chart-3" class="w-6 h-6"></i></div>
                                <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest italic">Upload Hasil ATEC (Eksternal)</h3>
                            </div>
                            <form action="{{ route('observasi.atec') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                                <input type="file" name="hasil" class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-xs" required>
                                <button type="submit" class="w-full bg-red-500 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest">Unggah Hasil ATEC</button>
                            </form>
                        </div>

                        <div class="p-8 bg-slate-50 rounded-[2.5rem] space-y-6">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-slate-900 rounded-2xl text-white"><i data-lucide="mic-2" class="w-6 h-6"></i></div>
                                <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest italic">Wawancara & Anamnesis</h3>
                            </div>
                            <form action="{{ route('observasi.wawancara') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                                <div class="space-y-4">
                                    @foreach ($qwawancara as $index => $q)
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $q->question_text }}</label>
                                        <textarea name="answers[{{ $q->id }}]" class="w-full border border-slate-200 rounded-2xl p-4 text-xs" rows="2" placeholder="Intisari jawaban..."></textarea>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl text-xs font-black uppercase tracking-widest">Simpan Wawancara</button>
                            </form>
                        </div>
                    </div>
                </template>

                <!-- Qualitative Notes (Perilaku/Sensorik) -->
                <template x-if="modalType === 'hpperilaku' || modalType === 'hpsensorik'">
                    <div class="mt-4">
                        <form :action="modalType === 'hpperilaku' ? '{{ route('observasi.hpperilaku') }}' : '{{ route('observasi.hpsensorik') }}'" method="POST" class="flex flex-col space-y-6">
                            @csrf
                            <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                            <div class="rounded-[2rem] overflow-hidden border border-slate-200 bg-white">
                                <textarea id="summernote-editor" name="deskripsi" class="summernote w-full min-h-[400px] p-6 outline-none text-slate-700" placeholder="Tuliskan hasil observasi mendalam di sini..."></textarea>
                            </div>
                            <div class="flex justify-end p-2">
                                <button type="submit" class="w-full md:w-max px-12 bg-slate-900 text-white py-5 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl hover:bg-black transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3">
                                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Assessment Kualitatif
                                </button>
                            </div>
                        </form>
                    </div>
                </template>

                <!-- Clinical Result Display (Refactored) -->
                <template x-if="modalType === 'result'">
                    <div class="space-y-8">
                        <div class="bg-slate-900 text-white p-8 rounded-[2rem] -mt-4 mx-2">
                             <div class="flex items-center justify-between">
                                <div class="space-y-1">
                                    <h5 class="text-sm font-black uppercase tracking-widest text-emerald-400 italic">Clinical Examination Result</h5>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest" x-text="modalData.jenis + ' • ' + modalData.created_at"></p>
                                </div>
                                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                                    <i data-lucide="shield-check" class="text-emerald-400"></i>
                                </div>
                             </div>
                        </div>

                        <div class="p-4">
                            <template x-if="modalData.is_atec">
                                <div class="card-premium p-2 bg-slate-50 border border-slate-100 rounded-3xl overflow-hidden">
                                    <img :src="modalData.image_url" class="w-full rounded-2xl shadow-sm">
                                </div>
                            </template>

                            <template x-if="!modalData.is_atec">
                                <div class="flex flex-col items-center text-center space-y-8 py-8">
                                    <div class="w-20 h-20 bg-emerald-50 rounded-[2rem] flex items-center justify-center text-emerald-500 shadow-sm animate-bounce">
                                        <i data-lucide="check-circle" class="w-10 h-10"></i>
                                    </div>
                                    <div class="space-y-6">
                                        <div>
                                            <h6 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Interpretasi Diagnostik</h6>
                                            <p class="text-3xl font-black text-slate-800 uppercase italic tracking-tighter" x-text="modalData.hasil"></p>
                                        </div>
                                        <div class="p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 max-w-lg mx-auto">
                                            <h6 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Rekomendasi Klinis</h6>
                                            <p class="text-xs font-bold leading-relaxed" 
                                               :class="['Penyimpangan', 'Curiga Gangguan Penglihatan', 'Risiko Autisme', 'Kemungkinan GPPH'].includes(modalData.hasil) ? 'text-red-500' : 'text-emerald-600 uppercase tracking-tight'">
                                                <template x-if="['Penyimpangan', 'Curiga Gangguan Penglihatan', 'Risiko Autisme', 'Kemungkinan GPPH'].includes(modalData.hasil)">
                                                    <span>{{ $penyimpangan }}</span>
                                                </template>
                                                <template x-if="!['Penyimpangan', 'Curiga Gangguan Penglihatan', 'Risiko Autisme', 'Kemungkinan GPPH'].includes(modalData.hasil)">
                                                    <span>{{ $sesuaiUmur }}</span>
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

@section('scripts')
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
</script>
@endsection
