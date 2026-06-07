@extends('layouts.master')

@section('title', 'Super Admin — Monitoring Center')

@section('style')
<style>
/* ── Base Reset ─────────────────────────── */
*{box-sizing:border-box}

/* ── Hero ───────────────────────────────── */
.sa-hero{background:linear-gradient(135deg,#0f172a 0%,#1e293b 40%,#0f172a 100%);position:relative;overflow:hidden}
.sa-hero::before{content:'';position:absolute;top:-80px;right:-80px;width:350px;height:350px;background:radial-gradient(circle,rgba(var(--primary-color-rgb),.18) 0%,transparent 70%);border-radius:50%;pointer-events:none}
.sa-hero::after{content:'';position:absolute;bottom:-100px;left:25%;width:400px;height:400px;background:radial-gradient(circle,rgba(59,130,246,.1) 0%,transparent 70%);border-radius:50%;pointer-events:none}

/* ── KPI Cards ──────────────────────────── */
.kpi-card{background:#fff;border-radius:1.5rem;border:1px solid rgba(226,232,240,.7);padding:1.25rem;transition:all .3s ease;position:relative;overflow:hidden;cursor:default}
.kpi-card:hover{transform:translateY(-4px);box-shadow:0 20px 50px rgba(0,0,0,.07)}
.kpi-icon{width:2.75rem;height:2.75rem;border-radius:.875rem;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.kpi-glow{position:absolute;top:-25px;right:-25px;width:110px;height:110px;border-radius:50%;opacity:.06;pointer-events:none}
.kpi-green .kpi-icon{background:#dcfce7;color:#16a34a} .kpi-green .kpi-glow{background:#16a34a}
.kpi-red   .kpi-icon{background:#fee2e2;color:#dc2626} .kpi-red   .kpi-glow{background:#dc2626}
.kpi-blue  .kpi-icon{background:#dbeafe;color:#2563eb} .kpi-blue  .kpi-glow{background:#2563eb}
.kpi-purple.kpi-icon{background:#ede9fe;color:#7c3aed} .kpi-purple .kpi-glow{background:#7c3aed}
.kpi-amber .kpi-icon{background:#fef3c7;color:#d97706} .kpi-amber .kpi-glow{background:#d97706}
.kpi-teal  .kpi-icon{background:#ccfbf1;color:#0d9488} .kpi-teal  .kpi-glow{background:#0d9488}
.kpi-indigo.kpi-icon{background:#e0e7ff;color:#4338ca} .kpi-indigo .kpi-glow{background:#4338ca}
.kpi-pink  .kpi-icon{background:#fce7f3;color:#be185d} .kpi-pink  .kpi-glow{background:#be185d}
.kpi-purple .kpi-icon{background:#ede9fe;color:#7c3aed}

/* ── Section ────────────────────────────── */
.sa-section-label{font-size:.65rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:#94a3b8;margin-bottom:.25rem}
.sa-section-title{font-size:1.05rem;font-weight:800;color:#0f172a;margin-bottom:1rem}
.sa-divider{border:none;border-top:1px solid #f1f5f9;margin:2rem 0}

/* ── Panel ──────────────────────────────── */
.sa-panel{background:#fff;border-radius:1.5rem;border:1px solid rgba(226,232,240,.7);overflow:hidden}
.sa-panel-header{padding:.875rem 1.25rem;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;gap:.75rem}
.sa-panel-header h3{font-size:.8rem;font-weight:800;color:#0f172a}

/* ── Table ──────────────────────────────── */
.sa-table{width:100%;border-collapse:collapse}
.sa-table th{font-size:.6rem;font-weight:800;text-transform:uppercase;letter-spacing:.12em;color:#94a3b8;padding:.625rem 1rem;background:#f8fafc;border-bottom:1px solid #e2e8f0;text-align:left;white-space:nowrap}
.sa-table td{padding:.75rem 1rem;font-size:.78rem;font-weight:600;color:#334155;border-bottom:1px solid #f8fafc;vertical-align:middle}
.sa-table tr:last-child td{border-bottom:none}
.sa-table tr:hover td{background:#fafbfc}

/* ── Badges ─────────────────────────────── */
.badge{display:inline-flex;align-items:center;gap:.3rem;padding:.2rem .65rem;border-radius:9999px;font-size:.6rem;font-weight:800;text-transform:uppercase;letter-spacing:.06em;white-space:nowrap}
.badge-hadir  {background:#dcfce7;color:#166534}
.badge-sakit  {background:#fee2e2;color:#991b1b}
.badge-izin   {background:#fef3c7;color:#92400e}
.badge-hangus {background:#f3f4f6;color:#374151}
.badge-belum  {background:#fce7f3;color:#9d174d}
.badge-lunas  {background:#dcfce7;color:#14532d}
.badge-tunggak{background:#fee2e2;color:#7f1d1d}
.badge-info   {background:#dbeafe;color:#1e40af}

/* ── Progress ───────────────────────────── */
.prog-track{background:#f1f5f9;border-radius:9999px;height:7px;overflow:hidden}
.prog-fill{height:100%;border-radius:9999px;transition:width .7s ease}
.prog-green {background:linear-gradient(90deg,#22c55e,#16a34a)}
.prog-amber {background:linear-gradient(90deg,#f59e0b,#d97706)}
.prog-red   {background:linear-gradient(90deg,#ef4444,#dc2626)}
.prog-blue  {background:linear-gradient(90deg,#3b82f6,#2563eb)}
.prog-purple{background:linear-gradient(90deg,#8b5cf6,#7c3aed)}

/* ── Alert ──────────────────────────────── */
.alert-pulse{animation:pulse-ring 2s ease-in-out infinite}
@keyframes pulse-ring{0%{box-shadow:0 0 0 0 rgba(239,68,68,.4)}70%{box-shadow:0 0 0 12px rgba(239,68,68,0)}100%{box-shadow:0 0 0 0 rgba(239,68,68,0)}}

/* ── Tab ────────────────────────────────── */
.tab-btn{padding:.4rem 1rem;font-size:.65rem;font-weight:800;text-transform:uppercase;letter-spacing:.07em;border-radius:.625rem;transition:all .2s;cursor:pointer;border:none;background:transparent;color:#94a3b8}
.tab-btn.active{background:#0f172a;color:#fff}

/* ── Mini stat ──────────────────────────── */
.mini-stat{background:#f8fafc;border-radius:1rem;padding:.75rem 1rem;border:1px solid #f1f5f9}

/* ── Avatar circle ──────────────────────── */
.av{width:2rem;height:2rem;border-radius:9999px;display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:900;flex-shrink:0}

/* ── Medal ──────────────────────────────── */
.medal-1{background:linear-gradient(135deg,#fbbf24,#f59e0b);color:#fff}
.medal-2{background:linear-gradient(135deg,#94a3b8,#64748b);color:#fff}
.medal-3{background:linear-gradient(135deg,#cd7c3d,#b45309);color:#fff}

/* ── Scrollbar ──────────────────────────── */
.overflow-x-auto::-webkit-scrollbar{height:4px}
.overflow-x-auto::-webkit-scrollbar-thumb{background:#e2e8f0;border-radius:9999px}
</style>
@endsection

@section('content')
@php
    $profile = \App\Models\Profile::first();
    function saRp($n){
        if($n>=1_000_000_000) return 'Rp '.number_format($n/1_000_000_000,1,',','.').'M';
        if($n>=1_000_000)     return 'Rp '.number_format($n/1_000_000,1,',','.').'Jt';
        if($n>=1_000)         return 'Rp '.number_format($n/1_000,0,',','.').'Rb';
        return 'Rp '.number_format($n,0,',','.');
    }
    $donutColors=['#3b82f6','#10b981','#f59e0b','#8b5cf6','#ef4444','#06b6d4','#ec4899','#84cc16'];
@endphp

{{-- ══ HERO ══════════════════════════════════════════════════════ --}}
<div class="sa-hero rounded-[2rem] p-7 mb-6 text-white relative z-10">
    <div class="flex flex-wrap items-start justify-between gap-4 relative z-10">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-11 h-11 rounded-2xl bg-white/10 backdrop-blur flex items-center justify-center border border-white/20 shrink-0">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="text-[9px] font-black uppercase tracking-[.2em] text-white/40">Super Admin · Monitoring Center</p>
                    <h1 class="text-xl font-black tracking-tight leading-none">Command Dashboard</h1>
                </div>
            </div>
            <p class="text-[11px] text-white/50 font-semibold ml-0.5">{{ now()->translatedFormat('l, d F Y — H:i') }} WIB</p>
        </div>

        {{-- Quick Stats --}}
        <div class="flex flex-wrap gap-2">
            @php
                $heroStats = [
                    ['label'=>'Total Anak',   'val'=>number_format($totalAnak),   'icon'=>'users'],
                    ['label'=>'Aktif',        'val'=>number_format($anakAktif),   'icon'=>'user-check'],
                    ['label'=>'Terapis',      'val'=>number_format($totalTerapis),'icon'=>'user-cog'],
                    ['label'=>'Kunjungan Hari Ini','val'=>$totalKunjunganHariIni,'icon'=>'calendar-check'],
                    ['label'=>'Saldo Kas',    'val'=>saRp($saldoKasRaw),          'icon'=>'landmark'],
                ];
            @endphp
            @foreach($heroStats as $hs)
            <div class="bg-white/8 backdrop-blur border border-white/15 rounded-xl px-4 py-2.5 text-center min-w-[90px]">
                <p class="text-[8px] font-black uppercase tracking-widest text-white/40 flex items-center justify-center gap-1 mb-0.5">
                    <i data-lucide="{{ $hs['icon'] }}" class="w-2.5 h-2.5"></i>{{ $hs['label'] }}
                </p>
                <p class="text-lg font-black text-white leading-none">{{ $hs['val'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ══ SECTION 1: KEHADIRAN HARI INI ══════════════════════════════ --}}
<p class="sa-section-label">📋 Kehadiran Realtime</p>
<h2 class="sa-section-title">Monitoring Kunjungan Hari Ini</h2>

<div class="grid grid-cols-2 gap-3 mb-5">
    @php
        $cardData = [
            ['label'=>'Total Kunjungan', 'val'=>$totalKunjunganHariIni,'icon'=>'calendar-days',   'cls'=>'kpi-blue'],
            ['label'=>'Hadir',           'val'=>$hadirHariIni,         'icon'=>'user-check',      'cls'=>'kpi-green'],
            ['label'=>'Sakit',           'val'=>$sakitHariIni,         'icon'=>'thermometer',     'cls'=>'kpi-red'],
            ['label'=>'Izin',            'val'=>$izinHariIni,          'icon'=>'file-clock',      'cls'=>'kpi-amber'],
            ['label'=>'Izin Hangus',     'val'=>$izinHangusHariIni,    'icon'=>'file-x-2',        'cls'=>'kpi-purple'],
            ['label'=>'Belum Periksa',   'val'=>$belumPemeriksaan->count(),'icon'=>'clipboard-x','cls'=>$belumPemeriksaan->count()>0?'kpi-red':'kpi-green'],
        ];
    @endphp
    @foreach($cardData as $c)
    <div class="kpi-card {{ $c['cls'] }}">
        <div class="kpi-glow"></div>
        <div class="kpi-icon mb-2"><i data-lucide="{{ $c['icon'] }}" class="w-4.5 h-4.5"></i></div>
        <p class="text-[10px] font-black uppercase tracking-wider text-slate-400 leading-tight">{{ $c['label'] }}</p>
        <p class="text-3xl font-black text-slate-800 leading-none mt-1">{{ $c['val'] }}</p>
    </div>
    @endforeach
</div>

{{-- Kunjungan per Jenis Terapi Hari Ini --}}
@if($totalKunjunganHariIni > 0)
<div class="grid grid-cols-1 xl:grid-cols-5 gap-4 mb-5">
    {{-- Tabel Kunjungan --}}
    <div class="xl:col-span-3 sa-panel">
        <div class="sa-panel-header">
            <div class="flex items-center gap-2"><i data-lucide="list-ordered" class="w-4 h-4 text-blue-500"></i><h3>Detail Kunjungan Hari Ini</h3></div>
            <span class="badge badge-info">{{ $semuaKunjunganHariIni->count() }} sesi</span>
        </div>
        <div class="overflow-x-auto">
            <table class="sa-table">
                <thead><tr><th>Anak</th><th>Terapis</th><th>Jenis</th><th>#</th><th>Status</th><th>Waktu</th></tr></thead>
                <tbody>
                @foreach($semuaKunjunganHariIni as $k)
                @php
                    $stClass = match($k->status){
                        'hadir'=>'badge-hadir','sakit'=>'badge-sakit','izin'=>'badge-izin','izin_hangus'=>'badge-hangus',default=>'badge-info'
                    };
                    $stLabel = match($k->status){
                        'hadir'=>'Hadir','sakit'=>'Sakit','izin'=>'Izin','izin_hangus'=>'Hangus',default=>$k->status
                    };
                @endphp
                <tr>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="av bg-blue-50 border border-blue-100 text-blue-700">{{ strtoupper(substr($k->anak->nama??'A',0,1)) }}</div>
                            <div><p class="font-bold text-slate-800 text-xs leading-tight">{{ $k->anak->nama??'-' }}</p>
                            @if($k->tarif)<p class="text-[9px] text-slate-400">{{ $k->tarif->nama }}</p>@endif</div>
                        </div>
                    </td>
                    <td class="text-xs">{{ $k->terapis->nama??'-' }}</td>
                    <td><span class="text-[10px] font-bold">{{ str_replace('_',' ',ucfirst($k->jenis_terapi??'-')) }}</span></td>
                    <td class="font-mono font-black text-center">{{ $k->pertemuan??'-' }}</td>
                    <td><span class="badge {{ $stClass }}">{{ $stLabel }}</span></td>
                    <td class="text-[10px] text-slate-400 font-bold">{{ $k->created_at->format('H:i') }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mini Stats: Per Jenis + Terapis Hari Ini --}}
    <div class="xl:col-span-2 flex flex-col gap-4">
        {{-- Kunjungan per Jenis Terapi --}}
        <div class="sa-panel flex-1">
            <div class="sa-panel-header"><div class="flex items-center gap-2"><i data-lucide="pie-chart" class="w-4 h-4 text-purple-500"></i><h3>Per Jenis Terapi (Hari Ini)</h3></div></div>
            <div class="p-4 space-y-3">
                @php
                    $jenisColors = ['terapi_perilaku'=>'prog-blue','fisioterapi'=>'prog-green','gabungan'=>'prog-purple'];
                    $totalJenis  = array_sum($kunjunganPerJenis);
                @endphp
                @forelse($kunjunganPerJenis as $jenis => $cnt)
                @php $pct = $totalJenis > 0 ? round($cnt/$totalJenis*100) : 0; @endphp
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-xs font-bold text-slate-700">{{ str_replace('_',' ',ucwords($jenis)) }}</span>
                        <span class="text-xs font-black text-slate-800">{{ $cnt }} <span class="text-slate-400 font-bold">({{ $pct }}%)</span></span>
                    </div>
                    <div class="prog-track"><div class="prog-fill {{ $jenisColors[$jenis]??'prog-blue' }}" style="width:{{ $pct }}%"></div></div>
                </div>
                @empty
                <p class="text-xs text-slate-400 text-center py-4">Belum ada data</p>
                @endforelse
            </div>
        </div>

        {{-- Terapis yang bertugas hari ini --}}
        <div class="sa-panel flex-1">
            <div class="sa-panel-header"><div class="flex items-center gap-2"><i data-lucide="user-cog" class="w-4 h-4 text-teal-500"></i><h3>Terapis Bertugas Hari Ini</h3></div></div>
            <div class="divide-y divide-slate-50">
                @forelse($kunjunganPerTerapisHariIni as $tj)
                <div class="flex items-center gap-3 px-4 py-3">
                    <div class="av bg-teal-50 border border-teal-100 text-teal-700">{{ strtoupper(substr($tj->terapis->nama??'T',0,1)) }}</div>
                    <div class="flex-1 min-w-0"><p class="text-xs font-bold text-slate-800 truncate">{{ $tj->terapis->nama??'-' }}</p></div>
                    <span class="text-lg font-black text-teal-600">{{ $tj->total }}</span>
                    <span class="text-[9px] text-slate-400 font-bold">sesi</span>
                </div>
                @empty
                <p class="text-xs text-slate-400 text-center py-6">Belum ada terapis bertugas</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endif

{{-- ══ ALERT: BELUM PEMERIKSAAN ═══════════════════════════════════ --}}
@if($belumPemeriksaan->isNotEmpty())
<div class="sa-panel border-2 border-rose-200 mb-5">
    <div class="bg-gradient-to-r from-rose-500 to-pink-500 px-5 py-3.5 flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center alert-pulse shrink-0">
            <i data-lucide="alert-triangle" class="w-4.5 h-4.5 text-white"></i>
        </div>
        <div>
            <p class="text-[9px] font-black uppercase tracking-widest text-white/60">Perlu Tindakan Segera</p>
            <h3 class="font-black text-white text-sm">{{ $belumPemeriksaan->count() }} anak hadir tapi belum diisi pemeriksaan</h3>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="sa-table">
            <thead><tr><th>Anak</th><th>Terapis</th><th>Jenis Terapi</th><th>Pertemuan</th><th>Waktu Masuk</th><th>Aksi</th></tr></thead>
            <tbody>
            @foreach($belumPemeriksaan as $k)
            <tr>
                <td>
                    <div class="flex items-center gap-2">
                        <div class="av bg-rose-50 border border-rose-200 text-rose-600">{{ strtoupper(substr($k->anak->nama??'A',0,1)) }}</div>
                        <div><p class="font-bold text-slate-800 text-xs">{{ $k->anak->nama??'-' }}</p>
                        @if($k->tarif)<p class="text-[9px] text-slate-400">{{ $k->tarif->nama }}</p>@endif</div>
                    </div>
                </td>
                <td class="text-xs">{{ $k->terapis->nama??'-' }}</td>
                <td class="text-xs">
                    {{ str_replace('_',' ',ucwords($k->jenis_terapi??'-')) }}
                    @if(isset($k->kekurangan_pemeriksaan))
                        <div class="mt-1"><span class="inline-block px-2 py-0.5 bg-rose-100 text-rose-600 rounded text-[9px] font-bold">Kurang: {{ $k->kekurangan_pemeriksaan }}</span></div>
                    @endif
                </td>
                <td class="font-mono font-black text-center">#{{ $k->pertemuan }}</td>
                <td class="text-[10px] text-slate-400 font-bold">{{ $k->created_at->format('H:i') }} WIB</td>
                <td>
                    <a href="{{ route('kunjungan.detail',$k->id) }}"
                       class="inline-flex items-center gap-1 px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl text-[10px] font-black uppercase tracking-wider transition-all">
                        <i data-lucide="clipboard-pen" class="w-3 h-3"></i> Isi Sekarang
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl border border-emerald-200 p-5 flex items-center gap-4 mb-5">
    <div class="w-11 h-11 rounded-2xl bg-emerald-100 flex items-center justify-center shrink-0">
        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600"></i>
    </div>
    <div>
        <p class="font-black text-emerald-800 text-sm">Semua pemeriksaan sudah diisi 🎉</p>
        <p class="text-xs text-emerald-600">Semua anak yang hadir hari ini sudah tercatat pemeriksaannya.</p>
    </div>
</div>
@endif

{{-- ══ JADWAL HARI INI vs KEHADIRAN ════════════════════════════════ --}}
@if($jadwalHariIni->isNotEmpty())
<div class="mb-5">
    <p class="sa-section-label">📅 Jadwal</p>
    <h2 class="sa-section-title">Jadwal vs Kehadiran Hari Ini</h2>
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
        {{-- Summary --}}
        <div class="grid grid-cols-3 gap-3">
            <div class="kpi-card kpi-blue"><div class="kpi-glow"></div><div class="kpi-icon mb-2"><i data-lucide="calendar-days" class="w-4 h-4"></i></div><p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Dijadwalkan</p><p class="text-3xl font-black text-slate-800">{{ $jadwalHariIni->count() }}</p></div>
            <div class="kpi-card kpi-green"><div class="kpi-glow"></div><div class="kpi-icon mb-2"><i data-lucide="user-check" class="w-4 h-4"></i></div><p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Sudah Hadir</p><p class="text-3xl font-black text-slate-800">{{ $jadwalHariIni->count() - $jadwalBelumHadir->count() }}</p></div>
            <div class="kpi-card {{ $jadwalBelumHadir->count() > 0 ? 'kpi-amber' : 'kpi-green' }}"><div class="kpi-glow"></div><div class="kpi-icon mb-2"><i data-lucide="user-x" class="w-4 h-4"></i></div><p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Belum Hadir</p><p class="text-3xl font-black text-slate-800">{{ $jadwalBelumHadir->count() }}</p></div>
        </div>

        {{-- Tabel belum hadir --}}
        @if($jadwalBelumHadir->isNotEmpty())
        <div class="sa-panel border-amber-200 border">
            <div class="sa-panel-header bg-amber-50">
                <div class="flex items-center gap-2"><i data-lucide="user-x" class="w-4 h-4 text-amber-600"></i><h3 class="text-amber-800">Dijadwalkan Belum Hadir</h3></div>
                <span class="badge badge-hangus">{{ $jadwalBelumHadir->count() }}</span>
            </div>
            <div class="overflow-x-auto">
                <table class="sa-table">
                    <thead><tr><th>Anak</th><th>Terapis</th><th>Jam</th></tr></thead>
                    <tbody>
                    @foreach($jadwalBelumHadir as $j)
                    <tr>
                        <td><div class="flex items-center gap-2"><div class="av bg-amber-50 border border-amber-200 text-amber-700">{{ strtoupper(substr($j->anak->nama??'A',0,1)) }}</div><span class="text-xs font-bold text-slate-800">{{ $j->anak->nama??'-' }}</span></div></td>
                        <td class="text-xs">{{ $j->terapis->nama??'-' }}</td>
                        <td class="text-[10px] text-slate-400 font-bold">{{ $j->waktu??'-' }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="bg-emerald-50 rounded-2xl border border-emerald-200 p-6 flex items-center gap-3">
            <i data-lucide="party-popper" class="w-8 h-8 text-emerald-500 shrink-0"></i>
            <p class="text-sm font-bold text-emerald-700">Semua anak yang dijadwalkan sudah hadir!</p>
        </div>
        @endif
    </div>
</div>
@endif

<hr class="sa-divider">

{{-- ══ SECTION 2: KEUANGAN ═════════════════════════════════════════ --}}
<p class="sa-section-label">💰 Keuangan & Kas</p>
<h2 class="sa-section-title">Ringkasan Keuangan</h2>

{{-- KPI Row --}}
<div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-3 gap-3 mb-5">
    <div class="kpi-card kpi-green">
        <div class="kpi-glow"></div>
        <div class="flex items-start justify-between mb-2">
            <div class="kpi-icon"><i data-lucide="trending-up" class="w-4 h-4"></i></div>
            <span class="text-[9px] font-black px-2 py-0.5 rounded-full {{ $growthPemasukkan>=0?'bg-emerald-50 text-emerald-700':'bg-red-50 text-red-700' }}">
                {{ $growthPemasukkan>=0?'+':'' }}{{ $growthPemasukkan }}%
            </span>
        </div>
        <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Pemasukkan Bulan Ini</p>
        <p class="text-xl font-black text-slate-800 mt-0.5">{{ saRp($pemasukkanBulanIni) }}</p>
        <p class="text-[9px] text-slate-400 font-bold mt-1">Bulan lalu: {{ saRp($pemasukkanBulanLalu) }}</p>
    </div>

    <div class="kpi-card kpi-red">
        <div class="kpi-glow"></div>
        <div class="flex items-start justify-between mb-2">
            <div class="kpi-icon"><i data-lucide="trending-down" class="w-4 h-4"></i></div>
            <span class="text-[9px] font-black px-2 py-0.5 rounded-full {{ $growthPengeluaran<=0?'bg-emerald-50 text-emerald-700':'bg-red-50 text-red-700' }}">
                {{ $growthPengeluaran>=0?'+':'' }}{{ $growthPengeluaran }}%
            </span>
        </div>
        <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Pengeluaran Bulan Ini</p>
        <p class="text-xl font-black text-slate-800 mt-0.5">{{ saRp($pengeluaranBulanIni) }}</p>
        <p class="text-[9px] text-slate-400 font-bold mt-1">Bulan lalu: {{ saRp($pengeluaranBulanLalu) }}</p>
    </div>

    <div class="kpi-card {{ $saldoBulanIni>=0?'kpi-teal':'kpi-red' }}">
        <div class="kpi-glow"></div>
        <div class="kpi-icon mb-2"><i data-lucide="{{ $saldoBulanIni>=0?'coins':'circle-dollar-sign' }}" class="w-4 h-4"></i></div>
        <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Laba / Rugi Bulan Ini</p>
        <p class="text-xl font-black {{ $saldoBulanIni>=0?'text-teal-700':'text-red-600' }} mt-0.5">{{ saRp(abs($saldoBulanIni)) }}</p>
        <p class="text-[9px] text-slate-400 font-bold mt-1">{{ $saldoBulanIni>=0?'▲ Surplus':'▼ Defisit' }}</p>
    </div>

    <div class="kpi-card kpi-green">
        <div class="kpi-glow"></div>
        <div class="kpi-icon mb-2"><i data-lucide="wallet" class="w-4 h-4"></i></div>
        <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Masuk Minggu Ini</p>
        <p class="text-lg font-black text-slate-800 mt-0.5">{{ saRp($pemasukkanMingguIni) }}</p>
    </div>

    <div class="kpi-card kpi-red">
        <div class="kpi-glow"></div>
        <div class="kpi-icon mb-2"><i data-lucide="receipt" class="w-4 h-4"></i></div>
        <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Keluar Minggu Ini</p>
        <p class="text-lg font-black text-slate-800 mt-0.5">{{ saRp($pengeluaranMingguIni) }}</p>
    </div>

    <div class="kpi-card kpi-blue">
        <div class="kpi-glow"></div>
        <div class="kpi-icon mb-2"><i data-lucide="landmark" class="w-4 h-4"></i></div>
        <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Saldo Kas Real</p>
        <p class="text-lg font-black text-slate-800 mt-0.5">{{ saRp($saldoKasRaw) }}</p>
    </div>

    <div class="kpi-card kpi-teal">
        <div class="kpi-glow"></div>
        <div class="kpi-icon mb-2"><i data-lucide="banknote" class="w-4 h-4"></i></div>
        <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Masuk Hari Ini</p>
        <p class="text-lg font-black text-slate-800 mt-0.5">{{ saRp($pemasukkanHariIni) }}</p>
    </div>

    <div class="kpi-card kpi-amber">
        <div class="kpi-glow"></div>
        <div class="kpi-icon mb-2"><i data-lucide="credit-card" class="w-4 h-4"></i></div>
        <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Assessment Belum Bayar</p>
        <p class="text-xl font-black text-slate-800 mt-0.5">{{ $assessmentBelumBayarCount }} <span class="text-sm text-slate-400">kasus</span></p>
        <p class="text-[9px] text-slate-400 font-bold mt-1">Lunas: {{ $assessmentLunas }}</p>
    </div>
</div>

{{-- Charts Row --}}
<div class="mb-5">
    {{-- Main Chart: Pemasukkan vs Pengeluaran --}}
    <div class="sa-panel">
        <div class="sa-panel-header">
            <div><p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Tren Keuangan</p><h3>Pemasukkan & Pengeluaran</h3></div>
            <div class="flex gap-1 bg-slate-100 rounded-xl p-1">
                <button id="tab-bulanan"  class="tab-btn active" onclick="switchKeuangan('bulanan')">Bulanan</button>
                <button id="tab-mingguan" class="tab-btn"        onclick="switchKeuangan('mingguan')">Mingguan</button>
            </div>
        </div>
        <div class="p-4"><canvas id="chartKeuangan" style="height:270px;max-height:270px"></canvas></div>
    </div>
</div>

<hr class="sa-divider">

{{-- ══ SECTION 3: KINERJA TERAPIS ══════════════════════════════════ --}}
<p class="sa-section-label">🏆 Kinerja SDM</p>
<h2 class="sa-section-title">Analisis Kinerja Terapis — Bulan {{ now()->translatedFormat('F Y') }}</h2>

<div class="grid grid-cols-1 gap-4 mb-5">
    {{-- Top 3 Podium --}}
    <div class="sa-panel">
        <div class="sa-panel-header"><div class="flex items-center gap-2"><i data-lucide="trophy" class="w-4 h-4 text-amber-500"></i><h3>Top 3 Terapis</h3></div></div>
        <div class="p-4 space-y-3">
            @foreach($topTerapis as $idx => $t)
            @php
                $medals = ['medal-1','medal-2','medal-3'];
                $medalIcon = ['🥇','🥈','🥉'];
                $maxKj = $topTerapis->max('total_kunjungan') ?: 1;
                $pctT  = round($t->total_kunjungan / $maxKj * 100);
            @endphp
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full {{ $medals[$idx] }} flex items-center justify-center text-sm font-black shrink-0">{{ $medalIcon[$idx] }}</div>
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-center mb-0.5">
                        <p class="text-xs font-black text-slate-800 truncate">{{ $t->nama }}</p>
                        <span class="text-xs font-black text-slate-600 shrink-0">{{ $t->total_kunjungan }}</span>
                    </div>
                    <div class="prog-track"><div class="prog-fill {{ $idx===0?'prog-amber':($idx===1?'prog-purple':'prog-blue') }}" style="width:{{ $pctT }}%"></div></div>
                </div>
            </div>
            @endforeach
            @if($topTerapis->isEmpty())<p class="text-xs text-slate-400 text-center py-4">Belum ada data</p>@endif
        </div>
    </div>

    {{-- Tabel Kinerja Lengkap --}}
    <div class="sa-panel">
        <div class="sa-panel-header">
            <div class="flex items-center gap-2"><i data-lucide="bar-chart-2" class="w-4 h-4 text-blue-500"></i><h3>Semua Terapis</h3></div>
            <span class="badge badge-info">{{ $kinerjaTermapis->count() }} terapis</span>
        </div>
        <div class="overflow-x-auto">
            <table class="sa-table">
                <thead><tr><th>#</th><th>Nama Terapis</th><th>Role / Spesialisasi</th><th>Kunjungan Bulan Ini</th><th>Hari Ini</th><th>Performa</th></tr></thead>
                <tbody>
                @php $maxKinerja = $kinerjaTermapis->max('total_kunjungan') ?: 1; @endphp
                @foreach($kinerjaTermapis as $idx => $t)
                @php
                    $pct = round($t->total_kunjungan/$maxKinerja*100);
                    $hadirHariIniT = $kunjunganPerTerapisHariIni[$t->id]->total ?? 0;
                @endphp
                <tr>
                    <td class="font-black text-slate-400 text-center">{{ $idx+1 }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="av bg-blue-50 border border-blue-100 text-blue-700">{{ strtoupper(substr($t->nama,0,1)) }}</div>
                            <span class="text-xs font-bold text-slate-800">{{ $t->nama }}</span>
                        </div>
                    </td>
                    <td><span class="badge badge-info">{{ str_replace('_',' ',ucwords($t->role??'terapis')) }}</span></td>
                    <td class="font-black text-center text-blue-600">{{ $t->total_kunjungan }}</td>
                    <td class="font-black text-center {{ $hadirHariIniT>0?'text-emerald-600':'text-slate-300' }}">{{ $hadirHariIniT }}</td>
                    <td style="min-width:120px">
                        <div class="prog-track"><div class="prog-fill {{ $pct>=60?'prog-green':($pct>=30?'prog-blue':'prog-amber') }}" style="width:{{ $pct }}%"></div></div>
                        <p class="text-[9px] text-slate-400 mt-0.5 font-bold">{{ $pct }}% dari maks</p>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<hr class="sa-divider">

{{-- ══ SECTION 4: CHART KUNJUNGAN 14 HARI ═════════════════════════ --}}
<p class="sa-section-label">📈 Tren Kunjungan</p>
<h2 class="sa-section-title">Grafik Kunjungan 14 Hari Terakhir</h2>

<div class="grid grid-cols-1 gap-4 mb-5">
    <div class="sa-panel">
        <div class="sa-panel-header">
            <div class="flex items-center gap-2"><i data-lucide="activity" class="w-4 h-4 text-violet-500"></i><h3>Total & Hadir Harian</h3></div>
            <div class="flex gap-3 text-[10px] font-bold">
                <span class="flex items-center gap-1"><span class="w-3 h-1 rounded bg-violet-500 inline-block"></span>Total</span>
                <span class="flex items-center gap-1"><span class="w-3 h-1 rounded bg-emerald-500 inline-block"></span>Hadir</span>
            </div>
        </div>
        <div class="p-4"><canvas id="chartKunjungan" style="height:230px;max-height:230px"></canvas></div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="kpi-card kpi-blue">
            <div class="kpi-glow"></div>
            <div class="kpi-icon mb-2"><i data-lucide="calendar-check" class="w-4 h-4"></i></div>
            <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Kunjungan Bulan Ini</p>
            <p class="text-2xl font-black text-slate-800">{{ number_format($totalKunjunganBulanIni) }}</p>
            @php $growthKj = $totalKunjunganBulanLalu > 0 ? round(($totalKunjunganBulanIni-$totalKunjunganBulanLalu)/$totalKunjunganBulanLalu*100,1) : 0; @endphp
            <span class="text-[9px] font-black {{ $growthKj>=0?'text-emerald-600':'text-red-500' }}">{{ $growthKj>=0?'+':'' }}{{ $growthKj }}% vs bulan lalu</span>
        </div>
        <div class="kpi-card kpi-green">
            <div class="kpi-glow"></div>
            <div class="kpi-icon mb-2"><i data-lucide="check-circle" class="w-4 h-4"></i></div>
            <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Sesi Selesai Bulan Ini</p>
            <p class="text-2xl font-black text-slate-800">{{ number_format($sesiSelesaiBulanIni) }}</p>
        </div>
        <div class="kpi-card kpi-purple">
            <div class="kpi-glow"></div>
            <div class="kpi-icon mb-2"><i data-lucide="users" class="w-4 h-4"></i></div>
            <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Pasien Baru Bulan Ini</p>
            <p class="text-2xl font-black text-slate-800">{{ $anakBulanIni }}</p>
            <span class="text-[9px] text-slate-400">Bulan lalu: {{ $anakBulanLalu }}</span>
        </div>
    </div>
</div>

<hr class="sa-divider">

{{-- ══ SECTION 5: MONITORING SISA PERTEMUAN ═══════════════════════ --}}
<p class="sa-section-label">📦 Paket Terapi</p>
<h2 class="sa-section-title">Monitoring Sisa Pertemuan</h2>

{{-- Paket Kritis (≤2) --}}
@if($paketKritis->isNotEmpty())
<div class="sa-panel border-2 border-red-300 mb-4">
    <div class="bg-gradient-to-r from-red-500 to-rose-500 px-5 py-3.5 flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center alert-pulse shrink-0">
            <i data-lucide="zap" class="w-4.5 h-4.5 text-white"></i>
        </div>
        <div>
            <p class="text-[9px] font-black uppercase tracking-widest text-white/60">⚡ KRITIS</p>
            <h3 class="font-black text-white text-sm">{{ $paketKritis->count() }} paket hampir habis (sisa ≤ 2 sesi) — Segera hubungi orang tua!</h3>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="sa-table">
            <thead><tr><th>Anak</th><th>Paket</th><th>Jenis</th><th>Total</th><th>Terpakai</th><th>Sisa</th><th>Progress</th><th>Aksi</th></tr></thead>
            <tbody>
            @foreach($paketKritis->sortBy(fn($p)=>is_array($p->sisa_pertemuan)?min($p->sisa_pertemuan):$p->sisa_pertemuan) as $p)
            @php
                $tarif=$p->tarif; $sisa=$p->sisa_pertemuan;
                if(is_array($sisa)) {
                    $totP = $tarif->pertemuan_perilaku??0;
                    $totF = $tarif->pertemuan_fisioterapi??0;
                    $sisaP = $sisa['perilaku']??0;
                    $sisaF = $sisa['fisioterapi']??0;
                    $terpP = max(0, $totP - $sisaP);
                    $terpF = max(0, $totF - $sisaF);
                    $totalD = "<div class='text-[9px] leading-tight text-slate-500 font-medium'>P: $totP<br>F: $totF</div>";
                    $terpD  = "<div class='text-[9px] leading-tight text-slate-500 font-medium'>P: $terpP<br>F: $terpF</div>";
                    $sisaD  = "<div class='flex flex-col gap-1 items-start'><span class='badge badge-info px-1.5 py-0.5 text-[9px]'>Perilaku: $sisaP</span><span class='badge badge-info px-1.5 py-0.5 text-[9px]'>Fisio: $sisaF</span></div>";
                    $sisaN  = min($sisaP, $sisaF);
                    $total  = $totP + $totF;
                    $pct    = $total > 0 ? min(100, round(($sisaP+$sisaF)/$total*100)) : 0;
                } else {
                    $total  = $tarif->jumlah_pertemuan??20;
                    $sisaVal= is_numeric($sisa)?$sisa:0;
                    $terpD  = max(0, $total - $sisaVal);
                    $totalD = $total;
                    $sisaD  = $sisa ?? '-';
                    $sisaN  = (int)($sisa??0);
                    $pct    = $total > 0 ? min(100, round($sisaVal/$total*100)) : 0;
                }
                $pc=$pct>40?'prog-green':($pct>15?'prog-amber':'prog-red');
            @endphp
            <tr>
                <td><div class="flex items-center gap-2"><div class="av bg-red-50 border border-red-200 text-red-700">{{ strtoupper(substr($p->anak->nama??'A',0,1)) }}</div><div><p class="text-xs font-bold text-slate-800">{{ $p->anak->nama??'-' }}</p><p class="text-[9px] text-slate-400">Bayar: {{ $p->tanggal_formatted??'-' }}</p></div></div></td>
                <td class="text-xs font-bold">{{ $tarif->nama??'-' }}</td>
                <td class="text-xs">{{ str_replace('_',' ',ucwords($tarif->jenis_terapi??'-')) }}</td>
                <td class="font-mono font-black text-center text-xs">{!! $totalD !!}</td>
                <td class="font-mono font-black text-center text-xs">{!! $terpD !!}</td>
                <td>@if(is_array($sisa)) {!! $sisaD !!} @else <span class="text-lg font-black text-red-600">{{ $sisaD }}</span> @endif</td>
                <td style="min-width:100px">
                    <div class="prog-track"><div class="prog-fill {{ $pc }}" style="width:{{ $pct }}%"></div></div>
                    <p class="text-[9px] text-slate-400 mt-0.5 font-bold">{{ $pct }}%</p>
                </td>
                <td>
                    <a href="{{ route('kunjungan.data') }}?nama={{ urlencode($p->anak->nama??'') }}" class="text-[9px] font-black text-red-600 hover:text-red-700">Lihat →</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Paket Menipis (≤5) --}}
@if($paketMenipis->isNotEmpty())
<div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mb-3 flex items-center gap-3">
    <div class="w-9 h-9 rounded-xl bg-amber-100 flex items-center justify-center shrink-0"><i data-lucide="alert-circle" class="w-4.5 h-4.5 text-amber-600"></i></div>
    <div>
        <p class="font-black text-amber-800 text-sm">⚠️ {{ $paketMenipis->count() }} paket hampir habis (sisa ≤ 5 sesi)</p>
        <p class="text-xs text-amber-700">Segera rencanakan perpanjangan bersama orang tua.</p>
    </div>
</div>
<div class="sa-panel border-amber-200 border mb-4">
    <div class="sa-panel-header bg-amber-50">
        <div class="flex items-center gap-2"><i data-lucide="timer" class="w-4 h-4 text-amber-600"></i><h3 class="text-amber-800">Paket Akan Habis (≤ 5 Sesi)</h3></div>
        <span class="badge badge-izin">{{ $paketMenipis->count() }}</span>
    </div>
    <div class="overflow-x-auto">
        <table class="sa-table">
            <thead><tr><th>Anak</th><th>Paket</th><th>Jenis</th><th>Total</th><th>Terpakai</th><th>Sisa</th><th>Progress</th></tr></thead>
            <tbody>
            @foreach($paketMenipis->sortBy(fn($p)=>is_array($p->sisa_pertemuan)?min($p->sisa_pertemuan):$p->sisa_pertemuan) as $p)
            @php
                $tarif=$p->tarif; $sisa=$p->sisa_pertemuan;
                if(is_array($sisa)) {
                    $totP = $tarif->pertemuan_perilaku??0;
                    $totF = $tarif->pertemuan_fisioterapi??0;
                    $sisaP = $sisa['perilaku']??0;
                    $sisaF = $sisa['fisioterapi']??0;
                    $terpP = max(0, $totP - $sisaP);
                    $terpF = max(0, $totF - $sisaF);
                    $totalD = "<div class='text-[9px] leading-tight text-slate-500 font-medium'>P: $totP<br>F: $totF</div>";
                    $terpD  = "<div class='text-[9px] leading-tight text-slate-500 font-medium'>P: $terpP<br>F: $terpF</div>";
                    $sisaD  = "<div class='flex flex-col gap-1 items-start'><span class='badge badge-info px-1.5 py-0.5 text-[9px]'>Perilaku: $sisaP</span><span class='badge badge-info px-1.5 py-0.5 text-[9px]'>Fisio: $sisaF</span></div>";
                    $sisaN  = min($sisaP, $sisaF);
                    $total  = $totP + $totF;
                    $pct    = $total > 0 ? min(100, round(($sisaP+$sisaF)/$total*100)) : 0;
                } else {
                    $total  = $tarif->jumlah_pertemuan??20;
                    $sisaVal= is_numeric($sisa)?$sisa:0;
                    $terpD  = max(0, $total - $sisaVal);
                    $totalD = $total;
                    $sisaD  = $sisa ?? '-';
                    $sisaN  = (int)($sisa??0);
                    $pct    = $total > 0 ? min(100, round($sisaVal/$total*100)) : 0;
                }
                $pc=$pct>40?'prog-green':($pct>15?'prog-amber':'prog-red');
                $tc=$sisaN<=2?'text-red-600':($sisaN<=5?'text-amber-600':'text-emerald-600');
            @endphp
            <tr>
                <td><div class="flex items-center gap-2"><div class="av bg-amber-50 border border-amber-200 text-amber-700">{{ strtoupper(substr($p->anak->nama??'A',0,1)) }}</div><div><p class="text-xs font-bold text-slate-800">{{ $p->anak->nama??'-' }}</p><p class="text-[9px] text-slate-400">{{ $p->tanggal_formatted??'-' }}</p></div></div></td>
                <td class="text-xs font-bold">{{ $tarif->nama??'-' }}</td>
                <td class="text-xs">{{ str_replace('_',' ',ucwords($tarif->jenis_terapi??'-')) }}</td>
                <td class="font-mono font-black text-center text-xs">{!! $totalD !!}</td>
                <td class="font-mono font-black text-center text-xs">{!! $terpD !!}</td>
                <td>@if(is_array($sisa)) {!! $sisaD !!} @else <span class="font-black text-base {{ $tc }}">{{ $sisaD }}</span> @endif</td>
                <td style="min-width:110px">
                    <div class="prog-track"><div class="prog-fill {{ $pc }}" style="width:{{ $pct }}%"></div></div>
                    <p class="text-[9px] text-slate-400 mt-0.5 font-bold">{{ $pct }}% tersisa</p>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Semua Paket Aktif --}}
<div class="sa-panel mb-5">
    <div class="sa-panel-header">
        <div class="flex items-center gap-2"><i data-lucide="package" class="w-4 h-4 text-blue-500"></i><h3>Semua Paket Aktif</h3></div>
        <span class="badge badge-info">{{ $paketAktifSemua->count() }} paket</span>
    </div>
    @if($paketAktifSemua->isNotEmpty())
    <div class="overflow-x-auto">
        <table class="sa-table">
            <thead><tr><th>Anak</th><th>Paket</th><th>Jenis</th><th>Total</th><th>Terpakai</th><th>Sisa</th><th>Progress</th></tr></thead>
            <tbody>
            @foreach($paketAktifSemua as $p)
            @php
                $tarif=$p->tarif; $sisa=$p->sisa_pertemuan;
                if(is_array($sisa)) {
                    $totP = $tarif->pertemuan_perilaku??0;
                    $totF = $tarif->pertemuan_fisioterapi??0;
                    $sisaP = $sisa['perilaku']??0;
                    $sisaF = $sisa['fisioterapi']??0;
                    $terpP = max(0, $totP - $sisaP);
                    $terpF = max(0, $totF - $sisaF);
                    $totalD = "<div class='text-[9px] leading-tight text-slate-500 font-medium'>P: $totP<br>F: $totF</div>";
                    $terpD  = "<div class='text-[9px] leading-tight text-slate-500 font-medium'>P: $terpP<br>F: $terpF</div>";
                    $sisaD  = "<div class='flex flex-col gap-1 items-start'><span class='badge badge-info px-1.5 py-0.5 text-[9px]'>Perilaku: $sisaP</span><span class='badge badge-info px-1.5 py-0.5 text-[9px]'>Fisio: $sisaF</span></div>";
                    $sisaN  = min($sisaP, $sisaF);
                    $total  = $totP + $totF;
                    $pct    = $total > 0 ? min(100, round(($sisaP+$sisaF)/$total*100)) : 0;
                } else {
                    $total  = $tarif->jumlah_pertemuan??20;
                    $sisaVal= is_numeric($sisa)?$sisa:0;
                    $terpD  = max(0, $total - $sisaVal);
                    $totalD = $total;
                    $sisaD  = $sisa ?? '-';
                    $sisaN  = (int)($sisa??0);
                    $pct    = $total > 0 ? min(100, round($sisaVal/$total*100)) : 0;
                }
                $pc=$pct>40?'prog-green':($pct>15?'prog-amber':'prog-red');
                $tc=$sisaN<=2?'text-red-600':($sisaN<=5?'text-amber-600':'text-emerald-600');
            @endphp
            <tr>
                <td><div class="flex items-center gap-2"><div class="av bg-blue-50 border border-blue-100 text-blue-700 text-[10px]">{{ strtoupper(substr($p->anak->nama??'A',0,1)) }}</div><span class="text-xs font-bold text-slate-800">{{ $p->anak->nama??'-' }}</span></div></td>
                <td class="text-xs font-bold">{{ $tarif->nama??'-' }}</td>
                <td class="text-xs">{{ str_replace('_',' ',ucwords($tarif->jenis_terapi??'-')) }}</td>
                <td class="font-mono font-black text-center text-xs">{!! $totalD !!}</td>
                <td class="font-mono font-black text-center text-xs">{!! $terpD !!}</td>
                <td>@if(is_array($sisa)) {!! $sisaD !!} @else <span class="font-black {{ $tc }}">{{ $sisaD }}</span> @endif</td>
                <td style="min-width:100px">
                    <div class="prog-track"><div class="prog-fill {{ $pc }}" style="width:{{ $pct }}%"></div></div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="p-12 text-center"><i data-lucide="package-x" class="w-10 h-10 text-slate-200 mx-auto mb-3"></i><p class="text-slate-400 font-bold text-sm">Belum ada paket terapi aktif</p></div>
    @endif
</div>

<hr class="sa-divider">

{{-- ══ SECTION 6: STATISTIK ANAK ══════════════════════════════════ --}}
<p class="sa-section-label">🧒 Demografi Anak</p>
<h2 class="sa-section-title">Statistik Pasien</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-5">
    {{-- Gender --}}
    <div class="sa-panel">
        <div class="sa-panel-header"><div class="flex items-center gap-2"><i data-lucide="users-2" class="w-4 h-4 text-pink-500"></i><h3>Distribusi Gender</h3></div></div>
        <div class="p-4">
            <canvas id="chartGender" style="height:130px;max-height:130px"></canvas>
            <div class="flex justify-around mt-3">
                <div class="text-center"><p class="text-[9px] font-black uppercase text-slate-400">Laki-laki</p><p class="text-xl font-black text-blue-600">{{ $genderStats['L'] }}</p></div>
                <div class="text-center"><p class="text-[9px] font-black uppercase text-slate-400">Perempuan</p><p class="text-xl font-black text-pink-500">{{ $genderStats['P'] }}</p></div>
            </div>
        </div>
    </div>

    {{-- Anak Baru per Bulan --}}
    <div class="sa-panel xl:col-span-2">
        <div class="sa-panel-header"><div class="flex items-center gap-2"><i data-lucide="user-plus" class="w-4 h-4 text-emerald-500"></i><h3>Pasien Baru (6 Bulan)</h3></div></div>
        <div class="p-4"><canvas id="chartAnakBaru" style="height:130px;max-height:130px"></canvas></div>
    </div>

    {{-- Diagnosa Terbanyak --}}
    <div class="sa-panel">
        <div class="sa-panel-header"><div class="flex items-center gap-2"><i data-lucide="brain" class="w-4 h-4 text-violet-500"></i><h3>Top 5 Diagnosa</h3></div></div>
        <div class="p-4 space-y-2">
            @php $maxDx = $diagnosaTerbanyak->max('total') ?: 1; @endphp
            @forelse($diagnosaTerbanyak as $dx)
            @php $pctDx = round($dx->total/$maxDx*100); @endphp
            <div>
                <div class="flex justify-between mb-0.5">
                    <span class="text-[10px] font-bold text-slate-700 truncate pr-2">{{ $dx->diagnosa }}</span>
                    <span class="text-[10px] font-black text-slate-800 shrink-0">{{ $dx->total }}</span>
                </div>
                <div class="prog-track"><div class="prog-fill prog-purple" style="width:{{ $pctDx }}%"></div></div>
            </div>
            @empty
            <p class="text-[10px] text-slate-400 text-center py-4">Belum ada data diagnosa</p>
            @endforelse
        </div>
    </div>
</div>

<hr class="sa-divider">

{{-- ══ SECTION 7: TRANSAKSI TERBARU ═══════════════════════════════ --}}
<p class="sa-section-label">🧾 Log Transaksi</p>
<h2 class="sa-section-title">Riwayat Transaksi Terbaru</h2>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-4 mb-4">
    <div class="sa-panel">
        <div class="sa-panel-header"><div class="flex items-center gap-2"><i data-lucide="arrow-up-right" class="w-4 h-4 text-emerald-500"></i><h3>10 Pemasukkan Terakhir</h3></div><a href="{{ route('keuangan.pemasukkan') }}" class="text-[9px] font-black text-slate-400 hover:text-blue-500">Lihat semua →</a></div>
        <div class="divide-y divide-slate-50">
            @forelse($pemasukkanTerbaru as $pm)
            <div class="flex items-center gap-3 px-5 py-3">
                <div class="w-8 h-8 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0"><i data-lucide="arrow-up-right" class="w-3.5 h-3.5 text-emerald-600"></i></div>
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-slate-800 text-xs truncate">{{ $pm->anak->nama??$pm->deskripsi??'Pemasukkan' }}</p>
                    <p class="text-[9px] text-slate-400 font-bold">{{ $pm->kategori->nama??'-' }} · {{ $pm->tanggal_formatted??'-' }} @if($pm->metode_bayar)· <span class="capitalize">{{ $pm->metode_bayar }}</span>@endif</p>
                </div>
                <p class="font-black text-emerald-700 text-xs shrink-0">{{ saRp($pm->jumlah) }}</p>
            </div>
            @empty
            <div class="p-8 text-center text-slate-400 text-xs font-medium">Belum ada data</div>
            @endforelse
        </div>
    </div>

    <div class="sa-panel">
        <div class="sa-panel-header"><div class="flex items-center gap-2"><i data-lucide="arrow-down-right" class="w-4 h-4 text-rose-500"></i><h3>10 Pengeluaran Terakhir</h3></div><a href="{{ route('keuangan.pengeluaran') }}" class="text-[9px] font-black text-slate-400 hover:text-blue-500">Lihat semua →</a></div>
        <div class="divide-y divide-slate-50">
            @forelse($pengeluaranTerbaru as $pg)
            <div class="flex items-center gap-3 px-5 py-3">
                <div class="w-8 h-8 rounded-xl bg-rose-50 flex items-center justify-center shrink-0"><i data-lucide="arrow-down-right" class="w-3.5 h-3.5 text-rose-600"></i></div>
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-slate-800 text-xs truncate">{{ $pg->deskripsi??'Pengeluaran' }}</p>
                    <p class="text-[9px] text-slate-400 font-bold">{{ $pg->kategori->nama??'-' }} · {{ $pg->tanggal_formatted??'-' }}</p>
                </div>
                <p class="font-black text-rose-600 text-xs shrink-0">{{ saRp($pg->jumlah) }}</p>
            </div>
            @empty
            <div class="p-8 text-center text-slate-400 text-xs font-medium">Belum ada data</div>
            @endforelse
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
// ── Data ──────────────────────────────────────────────────────────────────────
const DB = {
    bulanan:   { labels:@json($chartBulananLabels),   pm:@json($chartBulananPemasukkan),   pg:@json($chartBulananPengeluaran) },
    mingguan:  { labels:@json($chartMingguanLabels),  pm:@json($chartMingguanPemasukkan),  pg:@json($chartMingguanPengeluaran) },
    kunjungan: { labels:@json($chartKunjunganLabels), total:@json($chartKunjunganData),     hadir:@json($chartKunjunganHadir) },
    donut:     @json($rincianPemasukkanJenisPaket),
    gender:    { L:{{ $genderStats['L'] }}, P:{{ $genderStats['P'] }} },
    anakBaru:  { labels:@json($anakPerBulanLabels), data:@json($anakPerBulanData) },
};
const COLORS = ['#3b82f6','#10b981','#f59e0b','#8b5cf6','#ef4444','#06b6d4','#ec4899','#84cc16'];

// ── Helper ────────────────────────────────────────────────────────────────────
const saRp = v => {
    if(v>=1e9) return 'Rp '+(v/1e9).toFixed(1).replace('.',',')+'M';
    if(v>=1e6) return 'Rp '+(v/1e6).toFixed(1).replace('.',',')+'Jt';
    if(v>=1e3) return 'Rp '+(v/1e3).toFixed(0)+'Rb';
    return 'Rp '+v;
};
const fontBase = { family:"'Plus Jakarta Sans',sans-serif", weight:'800', size:10 };

// ── Chart: Keuangan (Bar) ─────────────────────────────────────────────────────
const ctxK = document.getElementById('chartKeuangan').getContext('2d');
let chartK = new Chart(ctxK,{
    type:'bar',
    data:{
        labels:DB.bulanan.labels,
        datasets:[
            {label:'Pemasukkan',data:DB.bulanan.pm,backgroundColor:'rgba(16,185,129,.15)',borderColor:'#10b981',borderWidth:2,borderRadius:6,borderSkipped:false},
            {label:'Pengeluaran',data:DB.bulanan.pg,backgroundColor:'rgba(239,68,68,.12)',borderColor:'#ef4444',borderWidth:2,borderRadius:6,borderSkipped:false},
        ]
    },
    options:{
        responsive:true,maintainAspectRatio:false,
        interaction:{mode:'index',intersect:false},
        plugins:{
            legend:{labels:{font:fontBase,padding:16}},
            tooltip:{callbacks:{label:c=>` ${c.dataset.label}: ${saRp(c.parsed.y)}`}}
        },
        scales:{
            x:{grid:{display:false},ticks:{font:fontBase}},
            y:{grid:{color:'#f1f5f9'},ticks:{font:fontBase,callback:v=>saRp(v)}}
        }
    }
});

function switchKeuangan(mode){
    const d=DB[mode];
    chartK.data.labels=d.labels;
    chartK.data.datasets[0].data=d.pm;
    chartK.data.datasets[1].data=d.pg;
    chartK.update('active');
    document.getElementById('tab-bulanan').classList.toggle('active',mode==='bulanan');
    document.getElementById('tab-mingguan').classList.toggle('active',mode==='mingguan');
}

// ── Chart: Donut (Removed) ────────────────────────────────────────────────────

// ── Chart: Kunjungan 14 hari ──────────────────────────────────────────────────
new Chart(document.getElementById('chartKunjungan').getContext('2d'),{
    type:'line',
    data:{
        labels:DB.kunjungan.labels,
        datasets:[
            {label:'Total',data:DB.kunjungan.total,borderColor:'#8b5cf6',backgroundColor:'rgba(139,92,246,.08)',borderWidth:2.5,pointRadius:4,pointBackgroundColor:'#8b5cf6',tension:.4,fill:true},
            {label:'Hadir',data:DB.kunjungan.hadir,borderColor:'#10b981',backgroundColor:'rgba(16,185,129,.05)',borderWidth:2,pointRadius:3,pointBackgroundColor:'#10b981',tension:.4,fill:true},
        ]
    },
    options:{
        responsive:true,maintainAspectRatio:false,
        interaction:{mode:'index',intersect:false},
        plugins:{legend:{labels:{font:fontBase,padding:16}}},
        scales:{
            x:{grid:{display:false},ticks:{font:fontBase}},
            y:{grid:{color:'#f1f5f9'},ticks:{font:fontBase,stepSize:1},min:0}
        }
    }
});

// ── Chart: Gender ─────────────────────────────────────────────────────────────
new Chart(document.getElementById('chartGender').getContext('2d'),{
    type:'doughnut',
    data:{
        labels:['Laki-laki','Perempuan'],
        datasets:[{data:[DB.gender.L,DB.gender.P],backgroundColor:['#3b82f6','#ec4899'],borderWidth:0,hoverOffset:6}]
    },
    options:{responsive:true,maintainAspectRatio:false,cutout:'68%',plugins:{legend:{display:false}}}
});

// ── Chart: Anak Baru per Bulan ────────────────────────────────────────────────
new Chart(document.getElementById('chartAnakBaru').getContext('2d'),{
    type:'bar',
    data:{
        labels:DB.anakBaru.labels,
        datasets:[{label:'Pasien Baru',data:DB.anakBaru.data,backgroundColor:'rgba(16,185,129,.2)',borderColor:'#10b981',borderWidth:2,borderRadius:8,borderSkipped:false}]
    },
    options:{
        responsive:true,maintainAspectRatio:false,
        plugins:{legend:{display:false}},
        scales:{
            x:{grid:{display:false},ticks:{font:fontBase}},
            y:{grid:{color:'#f1f5f9'},ticks:{font:fontBase,stepSize:1},min:0}
        }
    }
});

lucide.createIcons();
</script>
@endsection
