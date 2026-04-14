@extends('layouts.master')
@section('title', 'Detail Kunjungan Pasien')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">

    {{-- Breadcrumb --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="{{ route('kunjungan.data') }}" class="hover:text-red-500 transition-colors">Rekam Medis</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Detail Kunjungan</span>
        </div>
        <a href="{{ route('kunjungan.data') }}" class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 hover:border-slate-300 text-slate-600 rounded-xl text-xs font-bold transition-all shadow-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    {{-- Top Grid: Patient Identity --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        {{-- Left: Patient Card --}}
        <div class="lg:col-span-3 space-y-6">
            {{-- Profile Card --}}
            <div class="card-premium relative overflow-hidden">
                <div class="h-20 bg-gradient-to-br from-red-500 to-red-600"></div>
                <div class="p-6 -mt-10 text-center">
                    <div class="w-20 h-20 rounded-[1.5rem] border-4 border-white shadow-xl mx-auto overflow-hidden bg-slate-100">
                        <img src="{{ $kunjungan->anak->foto ? asset('storage/anak/' . $kunjungan->anak->foto) : asset('assets/images/faces/face1.jpg') }}"
                             alt="Photo" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-base font-black text-slate-800 uppercase tracking-tight mt-3">{{ $kunjungan->anak->nama }}</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                        {{ $kunjungan->anak->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }} &bull; {{ $kunjungan->usia }} Tahun
                    </p>
                    @if ($isCurrentSessionCompleted)
                    <div class="mt-3 inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-xl text-[9px] font-black uppercase tracking-widest">
                        <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i> Season Selesai
                    </div>
                    @endif
                </div>
            </div>

            {{-- Biodata --}}
            <div class="card-premium overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-50 bg-slate-50">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="info" class="w-3.5 h-3.5 text-red-500"></i> Biodata Anak
                    </h4>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Pendidikan</p>
                        <p class="text-sm font-bold text-slate-700 mt-0.5">{{ $kunjungan->anak->pendidikan ?? '-' }}</p>
                    </div>
                    <div class="h-px bg-slate-50"></div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Alamat</p>
                        <p class="text-sm font-bold text-slate-600 mt-0.5 leading-relaxed">{{ $kunjungan->anak->alamat }}</p>
                    </div>
                    <div class="h-px bg-slate-50"></div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Diagnosa Awal</p>
                        <p class="text-xs font-bold text-slate-600 mt-1 p-3 bg-slate-50 rounded-xl italic">{{ $kunjungan->anak->diagnosa ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Session Info --}}
            <div class="card-premium p-6 bg-slate-900 text-white relative overflow-hidden">
                <i data-lucide="calendar-check" class="w-24 h-24 text-white/5 absolute -right-4 -bottom-4"></i>
                <div class="relative z-10 space-y-3">
                    <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Informasi Sesi</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400">Jenis Terapi</span>
                        <span class="px-2 py-0.5 bg-red-500/20 text-red-400 rounded text-[9px] font-black uppercase tracking-tighter">
                            {{ str_replace('_', ' ', $kunjungan->jenis_terapi) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400">Terapis</span>
                        <span class="text-xs font-black text-white">{{ $kunjungan->terapis->nama }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400">Sesi</span>
                        <span class="text-lg font-black text-red-400">#{{ $kunjungan->sesi }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Tabs --}}
        <div class="lg:col-span-9">
            <div class="card-premium overflow-hidden" x-data="{ tab: 'riwayat' }">
                {{-- Tab Header --}}
                <div class="flex gap-1 p-2 bg-slate-50 border-b border-slate-100">
                    <button @click="tab = 'riwayat'"
                            :class="tab === 'riwayat' ? 'bg-white text-red-600 shadow-sm' : 'text-slate-500 hover:bg-white/50'"
                            class="flex items-center gap-2 px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                        <i data-lucide="history" class="w-4 h-4"></i> Riwayat Pertemuan
                    </button>
                    <button @click="tab = 'pemeriksaan'"
                            :class="tab === 'pemeriksaan' ? 'bg-white text-red-600 shadow-sm' : 'text-slate-500 hover:bg-white/50'"
                            class="flex items-center gap-2 px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                        <i data-lucide="clipboard-list" class="w-4 h-4"></i> Input Pemeriksaan
                    </button>
                </div>

                {{-- Tab: Riwayat --}}
                <div x-show="tab === 'riwayat'" x-transition class="p-0">
                    @if ($kunjungan->jenis_terapi == 'terapi_perilaku')
                        @forelse ($riwayat as $r)
                        <div class="border-b border-slate-50 last:border-0">
                            {{-- Session Header --}}
                            <div class="px-8 py-4 bg-slate-50 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white rounded-xl border border-slate-200 flex items-center justify-center text-xs font-black text-slate-600 shadow-sm">
                                        #{{ $r->pertemuan }}
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Pertemuan</p>
                                        <p class="text-xs font-black text-slate-700 uppercase">
                                            {{ \Carbon\Carbon::parse($r->created_at)->format('d F Y, H:i') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-bold text-slate-500">Terapis: <span class="font-black text-slate-700">{{ $r->terapis->nama }}</span></span>
                                    @php
                                        $badge = ['hadir' => 'bg-emerald-50 text-emerald-600 border-emerald-100', 'izin' => 'bg-amber-50 text-amber-600 border-amber-100', 'sakit' => 'bg-blue-50 text-blue-600 border-blue-100', 'izin_hangus' => 'bg-red-50 text-red-600 border-red-100'][$r->status] ?? 'bg-slate-50 text-slate-400 border-slate-100';
                                    @endphp
                                    <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ $badge }}">{{ str_replace('_', ' ', $r->status) }}</span>
                                </div>
                            </div>

                            {{-- Session Programs --}}
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-white border-b border-slate-50">
                                        <tr>
                                            <th class="px-8 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest">Program Terapi</th>
                                            <th class="px-8 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest w-24 text-center">Skala</th>
                                            <th class="px-8 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        @forelse ($r->pemeriksaans as $p)
                                        <tr class="hover:bg-slate-50/50">
                                            <td class="px-8 py-4 text-xs font-bold text-slate-700">{{ $p->program->deskripsi }}</td>
                                            <td class="px-8 py-4 text-center">
                                                <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-lg text-[10px] font-black uppercase">{{ $p->status }}</span>
                                            </td>
                                            @if ($loop->first)
                                            <td class="px-8 py-4 text-xs font-bold text-slate-600 leading-relaxed" rowspan="{{ $r->pemeriksaans->count() }}">
                                                {{ $p->keterangan }}
                                            </td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="px-8 py-6 text-center text-xs font-bold text-slate-300 italic">Belum ada data program</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @empty
                        <div class="py-20 text-center">
                            <i data-lucide="clipboard-x" class="w-12 h-12 text-slate-100 mx-auto mb-4"></i>
                            <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Belum ada riwayat pertemuan</p>
                        </div>
                        @endforelse
                    @else
                        @forelse ($riwayat_fisioterapi as $f)
                        <div class="border-b border-slate-50 last:border-0">
                            <div class="px-8 py-4 bg-slate-50 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-white rounded-xl border border-slate-200 flex items-center justify-center text-xs font-black text-slate-600 shadow-sm">
                                        #{{ $f->pertemuan }}
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Sesi Fisioterapi</p>
                                        <p class="text-xs font-black text-slate-700">{{ \Carbon\Carbon::parse($f->created_at)->format('d F Y, H:i') }}</p>
                                    </div>
                                </div>
                                @php $badge = ['hadir' => 'bg-emerald-50 text-emerald-600 border-emerald-100', 'izin' => 'bg-amber-50 text-amber-600 border-amber-100', 'sakit' => 'bg-blue-50 text-blue-600 border-blue-100'][$f->status] ?? 'bg-slate-50 text-slate-400 border-slate-100'; @endphp
                                <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ $badge }}">{{ str_replace('_', ' ', $f->status) }}</span>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-white border-b border-slate-50">
                                        <tr>
                                            <th class="px-8 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest">Program</th>
                                            <th class="px-8 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest">Aktivitas Terapi</th>
                                            <th class="px-8 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest">Evaluasi</th>
                                            <th class="px-8 py-3 text-[9px] font-black text-slate-400 uppercase tracking-widest">Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        @forelse ($f->fisioterapis as $fisio)
                                        <tr class="hover:bg-slate-50/50">
                                            <td class="px-8 py-4 text-xs font-bold text-slate-700 align-top">{{ $fisio->program->deskripsi }}</td>
                                            <td class="px-8 py-4 text-xs font-bold text-slate-600 leading-relaxed align-top">{{ $fisio->aktivitas_terapi }}</td>
                                            @if ($loop->first)
                                            <td class="px-8 py-4 text-xs font-bold text-slate-600 leading-relaxed align-top" rowspan="{{ $f->fisioterapis->count() }}">{{ $fisio->evaluasi }}</td>
                                            <td class="px-8 py-4 text-xs font-bold text-slate-600 leading-relaxed align-top" rowspan="{{ $f->fisioterapis->count() }}">{{ $fisio->catatan_khusus }}</td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr><td colspan="4" class="px-8 py-6 text-center text-xs font-bold text-slate-300 italic">Belum ada data program fisio</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @empty
                        <div class="py-20 text-center">
                            <i data-lucide="clipboard-x" class="w-12 h-12 text-slate-100 mx-auto mb-4"></i>
                            <p class="text-xs font-bold text-slate-300 uppercase tracking-widest">Belum ada riwayat fisioterapi</p>
                        </div>
                        @endforelse
                    @endif
                </div>

                {{-- Tab: Input Pemeriksaan --}}
                <div x-show="tab === 'pemeriksaan'" x-transition x-cloak class="p-8">
                    @if ($kunjungan->jenis_terapi == 'terapi_perilaku')
                    <form action="{{ route('pemeriksaan.store') }}" method="POST" class="space-y-6">
                        @include('kunjungan.form', ['tombol' => 'Simpan Pemeriksaan'])
                    </form>
                    @else
                    <form action="{{ route('fisioterapi.store') }}" method="POST" class="space-y-6">
                        @include('kunjungan.form_fisioterapi', ['tombol' => 'Simpan Fisioterapi'])
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
            $('#form-wrapper').append(`
            <div class="container-form space-y-4 pt-4 border-t border-slate-100">
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Program</label>
                        <select class="w-full bg-slate-50 border-slate-100 rounded-2xl px-4 py-3 text-sm font-bold outline-none select2" name="program_id[${formIndex}]">
                            @foreach ($program as $p)
                                <option value="{{ $p->id }}">{{ $p->deskripsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="remove-button mt-5 p-2.5 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-all border border-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
                <div class="flex gap-3">
                    <label class="flex items-center gap-2 px-4 py-2 bg-slate-50 border-2 border-transparent rounded-xl cursor-pointer has-[:checked]:border-red-400 has-[:checked]:bg-red-50 transition-all"><input type="radio" name="status[${formIndex}]" value="dp" required class="sr-only"><span class="text-xs font-black uppercase">DP</span></label>
                    <label class="flex items-center gap-2 px-4 py-2 bg-slate-50 border-2 border-transparent rounded-xl cursor-pointer has-[:checked]:border-emerald-400 has-[:checked]:bg-emerald-50 transition-all"><input type="radio" name="status[${formIndex}]" value="ds" required class="sr-only"><span class="text-xs font-black uppercase">DS</span></label>
                    <label class="flex items-center gap-2 px-4 py-2 bg-slate-50 border-2 border-transparent rounded-xl cursor-pointer has-[:checked]:border-amber-400 has-[:checked]:bg-amber-50 transition-all"><input type="radio" name="status[${formIndex}]" value="tb" required class="sr-only"><span class="text-xs font-black uppercase">TB</span></label>
                </div>
            </div>`);
            formIndex++;
            $('.select2').select2();
        });

        let fisioIndex = 1;
        $('#add-button-fisioterapi').click(function() {
            $('#form-fisioterapi').append(`
            <div class="container-form space-y-4 pt-4 border-t border-slate-100">
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Program ${fisioIndex + 1}</label>
                        <select class="w-full bg-slate-50 border-slate-100 rounded-2xl px-4 py-3 text-sm font-bold outline-none select2" name="program_id[${fisioIndex}]">
                            @foreach ($program_fisioterapi as $f)
                                <option value="{{ $f->id }}">{{ $f->deskripsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="remove-button mt-5 p-2.5 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-all border border-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
                <textarea class="w-full bg-slate-50 border-slate-100 rounded-2xl px-4 py-3 text-sm font-bold outline-none resize-none" name="aktivitas_terapi[${fisioIndex}]" rows="2" placeholder="Aktivitas terapi..."></textarea>
            </div>`);
            fisioIndex++;
            $('.select2').select2();
        });

        $(document).on('click', '.remove-button', function() {
            $(this).closest('.container-form').remove();
        });
    });
</script>
@endsection
