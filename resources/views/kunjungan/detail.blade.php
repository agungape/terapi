@extends('layouts.master')
@section('title', 'E-Book Rekam Medis Anak')

@section('content')
<div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">

    {{-- Breadcrumb & Actions --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="{{ route('kunjungan.data') }}" class="hover:text-red-500 transition-colors">Rekam Medis</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Detail E-Book</span>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('kunjungan.data') }}" class="flex items-center gap-2 px-6 py-3 bg-white border-2 border-slate-100 hover:border-slate-200 text-slate-600 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
            <button class="flex items-center gap-2 px-6 py-3 bg-slate-900 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg hover:bg-black group">
                <i data-lucide="printer" class="w-4 h-4 group-hover:scale-110 transition-transform"></i> Cetak Laporan
            </button>
        </div>
    </div>

    {{-- Top Grid: Patient Identity --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- Left: Patient Card --}}
        <div class="lg:col-span-4 space-y-6">
            {{-- Profile Card --}}
            <div class="card-premium relative overflow-hidden border-none shadow-2xl shadow-red-100/50">
                <div class="h-32 bg-gradient-to-br from-red-500 via-red-600 to-rose-700 relative">
                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;"></div>
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
                </div>
                <div class="p-8 -mt-16 text-center relative z-10">
                    <div class="w-32 h-32 rounded-[2.5rem] border-8 border-white shadow-2xl mx-auto overflow-hidden bg-slate-100 group transition-transform hover:scale-105 duration-500">
                        <img src="{{ $kunjungan->anak->foto ? asset('storage/anak/' . $kunjungan->anak->foto) : asset('assets/images/faces/face1.jpg') }}"
                             alt="Photo" class="w-full h-full object-cover">
                    </div>
                    <div class="mt-6 space-y-2">
                        <h3 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter leading-none">{{ $kunjungan->anak->nama }}</h3>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                            NIB: {{ $kunjungan->anak->nib }} &bull; {{ $kunjungan->anak->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                        </p>
                    </div>

                    @if ($isCurrentSessionCompleted)
                    <div class="mt-6 inline-flex items-center gap-2 px-5 py-2 bg-emerald-50 text-emerald-600 border-2 border-emerald-100 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] italic">
                        <i data-lucide="check-circle-2" class="w-4 h-4"></i> Season Selesai
                    </div>
                    @endif
                </div>
                
                <div class="p-8 bg-slate-50/50 border-t border-slate-100 grid grid-cols-2 gap-4">
                    <div class="text-center p-4 bg-white rounded-2xl shadow-sm border border-slate-100">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Usia</p>
                        <p class="text-lg font-black text-slate-800 italic">{{ $kunjungan->usia }} <span class="text-[10px] uppercase text-slate-400 not-italic ml-1">Thn</span></p>
                    </div>
                    <div class="text-center p-4 bg-white rounded-2xl shadow-sm border border-slate-100">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Sesi Ke</p>
                        <p class="text-lg font-black text-red-500 italic">#{{ $kunjungan->sesi }}</p>
                    </div>
                </div>
            </div>

            {{-- Biodata Detail --}}
            <div class="card-premium overflow-hidden border-none shadow-xl shadow-slate-200/50">
                <div class="px-8 py-5 border-b border-slate-100 bg-white flex items-center justify-between">
                    <h4 class="text-[10px] font-black text-slate-800 uppercase tracking-[0.2em] flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center text-blue-500">
                            <i data-lucide="fingerprint" class="w-4 h-4"></i>
                        </div>
                        Informasi Dasar
                    </h4>
                </div>
                <div class="p-8 space-y-6 bg-white">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 shrink-0">
                            <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Pendidikan</p>
                            <p class="text-sm font-bold text-slate-700 mt-1 leading-tight">{{ $kunjungan->anak->pendidikan ?? 'Belum Sekolah' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 shrink-0">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Alamat Domisili</p>
                            <p class="text-sm font-bold text-slate-600 mt-1 leading-relaxed">{{ $kunjungan->anak->alamat }}</p>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-slate-50">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                            <i data-lucide="activity" class="w-3.5 h-3.5"></i> Diagnosa Klinis
                        </p>
                        <div class="p-5 bg-red-50 rounded-[1.5rem] border border-red-100/50 relative group">
                            <i data-lucide="quote" class="w-8 h-8 text-red-200 absolute right-4 top-4 opacity-50"></i>
                            <p class="text-xs font-bold text-red-700 italic leading-relaxed relative z-10">{{ $kunjungan->anak->diagnosa ?? 'Belum ada diagnosa terdaftar' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Content Book --}}
        <div class="lg:col-span-8">
            <div class="card-premium overflow-hidden border-none shadow-2xl shadow-slate-200/50" x-data="{ tab: 'riwayat' }">
                {{-- Tabs Navigation --}}
                <div class="flex p-3 bg-slate-900 border-b border-slate-800 gap-2">
                    <button @click="tab = 'riwayat'"
                            :class="tab === 'riwayat' ? 'bg-white text-slate-900' : 'text-white/60 hover:bg-white/10 hover:text-white'"
                            class="flex-1 flex items-center justify-center gap-3 px-6 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all duration-300">
                        <i data-lucide="book" class="w-4 h-4"></i> Riwayat Digital
                    </button>
                    <button @click="tab = 'pemeriksaan'"
                            :class="tab === 'pemeriksaan' ? 'bg-red-600 text-white shadow-lg shadow-red-500/20' : 'text-white/60 hover:bg-white/10 hover:text-white'"
                            class="flex-1 flex items-center justify-center gap-3 px-6 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all duration-300">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i> Input Baru
                    </button>
                </div>

                {{-- Tab: Riwayat Digital (The Book) --}}
                <div x-show="tab === 'riwayat'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" class="bg-white">
                    <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                        <div class="space-y-1">
                            <h4 class="text-sm font-black text-slate-800 uppercase italic tracking-tight">Timeline Perkembangan</h4>
                            <p class="text-[10px] font-bold text-slate-400">Menampilkan seluruh catatan pertemuan secara berurutan.</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                            <span class="text-[10px] font-black text-slate-700 uppercase tracking-widest">LIVE RECORD</span>
                        </div>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @php $is_perilaku = ($kunjungan->jenis_terapi == 'terapi_perilaku'); @endphp
                        @php $records = $is_perilaku ? $riwayat : $riwayat_fisioterapi; @endphp

                        @forelse ($records as $r)
                        <div class="group">
                            {{-- Meeting Header --}}
                            <div class="px-8 py-6 bg-white group-hover:bg-slate-50/50 transition-colors flex flex-col md:flex-row md:items-center justify-between gap-6">
                                <div class="flex items-center gap-5">
                                    <div class="w-14 h-14 bg-slate-900 rounded-2xl flex flex-col items-center justify-center text-white shadow-xl shadow-slate-200">
                                        <span class="text-[8px] font-black uppercase opacity-60">Sesi</span>
                                        <span class="text-lg font-black italic mt-[-2px]">#{{ $r->pertemuan }}</span>
                                    </div>
                                    <div>
                                        <h5 class="text-xs font-black text-slate-800 uppercase tracking-widest mb-1">
                                            {{ \Carbon\Carbon::parse($r->created_at)->translatedFormat('d F Y') }}
                                        </h5>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase flex items-center gap-2">
                                            <i data-lucide="clock" class="w-3 h-3"></i> {{ \Carbon\Carbon::parse($r->created_at)->format('H:i') }} WIB &bull; 
                                            <span class="text-red-500 font-black">{{ $r->terapis->nama }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    @php
                                        $statusCls = [
                                            'hadir' => 'bg-emerald-500 text-white shadow-emerald-100',
                                            'izin' => 'bg-amber-500 text-white shadow-amber-100',
                                            'sakit' => 'bg-blue-500 text-white shadow-blue-100',
                                            'izin_hangus' => 'bg-rose-500 text-white shadow-rose-100'
                                        ][$r->status] ?? 'bg-slate-400 text-white';
                                    @endphp
                                    <span class="px-5 py-2 rounded-full text-[9px] font-black uppercase tracking-[0.2em] shadow-lg italic {{ $statusCls }}">
                                        {{ str_replace('_', ' ', $r->status) }}
                                    </span>
                                </div>
                            </div>

                            {{-- Meeting Details (The Table-less Card) --}}
                            <div class="px-8 pb-10">
                                <div class="bg-slate-50/80 rounded-[2rem] border border-slate-100 p-6 md:p-8 space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        {{-- Column 1: Programs --}}
                                        <div class="space-y-4">
                                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-200 pb-2">Program yang Dijalankan</p>
                                            <div class="space-y-3">
                                                @php $pems = $is_perilaku ? $r->pemeriksaans : $r->fisioterapis; @endphp
                                                @forelse ($pems as $p)
                                                <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between group/item hover:border-red-200 transition-all">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-2 h-2 rounded-full bg-red-400"></div>
                                                        <span class="text-xs font-bold text-slate-700">{{ $p->program->deskripsi }}</span>
                                                    </div>
                                                    @if($is_perilaku)
                                                    <span class="px-3 py-1 bg-slate-900 text-white rounded-lg text-[9px] font-black uppercase italic">{{ $p->status }}</span>
                                                    @endif
                                                </div>
                                                @if(!$is_perilaku && $p->aktivitas_terapi)
                                                <div class="pl-6 py-2">
                                                    <p class="text-[10px] font-medium text-slate-500 leading-relaxed"><i data-lucide="corner-down-right" class="w-3 h-3 inline mr-1 text-slate-300"></i> {{ $p->aktivitas_terapi }}</p>
                                                </div>
                                                @endif
                                                @empty
                                                <p class="text-xs text-slate-300 italic">Tidak ada data program</p>
                                                @endforelse
                                            </div>
                                        </div>

                                        {{-- Column 2: Observations & Notes --}}
                                        <div class="space-y-4">
                                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-200 pb-2">Catatan & Evaluasi</p>
                                            <div class="space-y-4">
                                                @if($is_perilaku)
                                                <div class="p-5 bg-white rounded-2xl border border-slate-100 shadow-sm">
                                                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                                                        <i data-lucide="message-square" class="w-3 h-3"></i> Keterangan Terapis
                                                    </p>
                                                    <p class="text-xs font-bold text-slate-600 leading-relaxed">{{ $r->pemeriksaans->first()->keterangan ?? '-' }}</p>
                                                </div>
                                                @else
                                                <div class="space-y-3">
                                                    <div class="p-5 bg-white rounded-2xl border border-slate-100 shadow-sm">
                                                        <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-2">Evaluasi Sesi</p>
                                                        <p class="text-xs font-bold text-slate-600 leading-relaxed">{{ $r->fisioterapis->first()->evaluasi ?? '-' }}</p>
                                                    </div>
                                                    <div class="p-5 bg-white rounded-2xl border border-slate-100 shadow-sm">
                                                        <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-2 text-red-500">Catatan Khusus</p>
                                                        <p class="text-xs font-bold text-slate-600 leading-relaxed italic">{{ $r->fisioterapis->first()->catatan_khusus ?? '-' }}</p>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="py-32 text-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i data-lucide="book-open" class="w-10 h-10 text-slate-200"></i>
                            </div>
                            <h5 class="text-sm font-black text-slate-400 uppercase tracking-[0.3em]">Halaman Masih Kosong</h5>
                            <p class="text-xs font-bold text-slate-300 mt-2">Belum ada catatan riwayat pertemuan digital untuk anak ini.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- Tab: Input Baru --}}
                <div x-show="tab === 'pemeriksaan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-x-4" x-cloak class="p-8 md:p-12">
                    <div class="mb-10 text-center">
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-red-50 text-red-500 rounded-full text-[9px] font-black uppercase tracking-[0.2em] mb-4">
                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i> Form Input Data
                        </div>
                        <h4 class="text-2xl font-black text-slate-800 uppercase italic tracking-tighter">Catat Hasil Pertemuan Baru</h4>
                        <p class="text-xs font-bold text-slate-400 mt-2">Pastikan seluruh data yang diinput sudah sesuai dengan observasi sesi.</p>
                    </div>

                    @if ($is_perilaku)
                    <form action="{{ route('pemeriksaan.store') }}" method="POST" class="space-y-8 max-w-2xl mx-auto">
                        @include('kunjungan.form', ['tombol' => 'Simpan & Publikasi E-Book'])
                    </form>
                    @else
                    <form action="{{ route('fisioterapi.store') }}" method="POST" class="space-y-8 max-w-2xl mx-auto">
                        @include('kunjungan.form_fisioterapi', ['tombol' => 'Simpan & Publikasi E-Book'])
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        let formIndex = 1;
        $('#add-button').click(function() {
            let newSection = $(`
            <div class="container-form space-y-6 pt-8 border-t-2 border-dashed border-slate-100 animate-in fade-in duration-300">
                <div class="flex items-start justify-between gap-6">
                    <div class="flex-1 space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Program Terapi #${formIndex + 1}</label>
                        <select class="w-full bg-slate-50 border-2 border-slate-100 rounded-[1.5rem] px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:border-red-200 transition-all outline-none appearance-none select2" name="program_id[${formIndex}]">
                            @foreach ($program as $p)
                                <option value="{{ $p->id }}">{{ $p->deskripsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="remove-button mt-7 w-12 h-12 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-2xl transition-all border-2 border-red-100 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    </button>
                </div>
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Skala Kemampuan</label>
                    <div class="flex flex-wrap gap-3">
                        <label class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-slate-50 border-2 border-transparent rounded-2xl cursor-pointer has-[:checked]:border-red-500 has-[:checked]:bg-red-500 has-[:checked]:text-white transition-all shadow-sm group">
                            <input type="radio" name="status[${formIndex}]" value="dp" required class="sr-only">
                            <span class="text-xs font-black uppercase tracking-widest">DP</span>
                        </label>
                        <label class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-slate-50 border-2 border-transparent rounded-2xl cursor-pointer has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-500 has-[:checked]:text-white transition-all shadow-sm group">
                            <input type="radio" name="status[${formIndex}]" value="ds" required class="sr-only">
                            <span class="text-xs font-black uppercase tracking-widest">DS</span>
                        </label>
                        <label class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-slate-50 border-2 border-transparent rounded-2xl cursor-pointer has-[:checked]:border-amber-500 has-[:checked]:bg-amber-500 has-[:checked]:text-white transition-all shadow-sm group">
                            <input type="radio" name="status[${formIndex}]" value="tb" required class="sr-only">
                            <span class="text-xs font-black uppercase tracking-widest">TB</span>
                        </label>
                    </div>
                </div>
            </div>`);
            $('#form-wrapper').append(newSection);
            formIndex++;
            $('.select2').select2({ width: '100%' });
            lucide.createIcons();
        });

        let fisioIndex = 1;
        $('#add-button-fisioterapi').click(function() {
            let newSection = $(`
            <div class="container-form space-y-6 pt-8 border-t-2 border-dashed border-slate-100 animate-in fade-in duration-300">
                <div class="flex items-start justify-between gap-6">
                    <div class="flex-1 space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Program #${fisioIndex + 1}</label>
                        <select class="w-full bg-slate-50 border-2 border-slate-100 rounded-[1.5rem] px-6 py-4 text-sm font-bold focus:ring-4 focus:ring-red-50 focus:border-red-200 transition-all outline-none appearance-none select2" name="program_id[${fisioIndex}]">
                            @foreach ($program_fisioterapi as $f)
                                <option value="{{ $f->id }}">{{ $f->deskripsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="remove-button mt-7 w-12 h-12 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-2xl transition-all border-2 border-red-100 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    </button>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block px-1">Aktivitas Terapi</label>
                    <textarea class="w-full bg-slate-50 border-2 border-slate-100 rounded-[1.5rem] px-6 py-4 text-sm font-bold outline-none resize-none focus:ring-4 focus:ring-red-50 focus:border-red-200 transition-all" name="aktivitas_terapi[${fisioIndex}]" rows="2" placeholder="Detail aktivitas yang dilakukan..."></textarea>
                </div>
            </div>`);
            $('#form-fisioterapi').append(newSection);
            fisioIndex++;
            $('.select2').select2({ width: '100%' });
            lucide.createIcons();
        });

        $(document).on('click', '.remove-button', function() {
            $(this).closest('.container-form').fadeOut(300, function() { $(this).remove(); });
        });
    });
</script>
@endsection
