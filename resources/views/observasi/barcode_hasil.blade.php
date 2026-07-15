<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Hasil Observasi — {{ $data['nama'] }}</title>
    <meta http-equiv="refresh" content="30">
    <meta name="description" content="Halaman verifikasi digital hasil observasi anak dari Bright Star of Child.">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --bg: #0f172a;
            --surface: #1e293b;
            --surface-2: #334155;
            --text: #f1f5f9;
            --text-muted: #94a3b8;
            --border: rgba(255,255,255,0.08);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 16px 16px 40px;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 10% -10%, rgba(99,102,241,0.25) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 90% 100%, rgba(16,185,129,0.15) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        .page-wrapper {
            width: 100%;
            max-width: 520px;
            position: relative;
            z-index: 1;
            animation: slideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(32px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ─── Header ─── */
        .clinic-header {
            display: flex;
            align-items: center;
            gap: 14px;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 16px 20px;
            margin-bottom: 16px;
            backdrop-filter: blur(12px);
        }

        .logo-wrap {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            background: white;
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(0,0,0,0.4);
        }

        .logo-wrap img { width: 100%; height: 100%; object-fit: contain; }

        .clinic-text h1 {
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            line-height: 1.2;
        }

        .clinic-text p {
            font-size: 0.65rem;
            color: var(--text-muted);
            margin-top: 3px;
            line-height: 1.5;
        }

        /* ─── Verified Hero ─── */
        .verified-hero {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 32px 24px 24px;
            margin-bottom: 16px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .verified-hero::before {
            content: '';
            position: absolute;
            top: -60px; left: -60px;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%);
            pointer-events: none;
        }

        .verified-hero::after {
            content: '';
            position: absolute;
            bottom: -40px; right: -40px;
            width: 160px; height: 160px;
            background: radial-gradient(circle, rgba(16,185,129,0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .verified-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10b981, #059669);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 8px rgba(16,185,129,0.12), 0 0 0 16px rgba(16,185,129,0.06);
            animation: pulse-glow 2.5s ease-in-out infinite;
            position: relative;
            z-index: 1;
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 0 8px rgba(16,185,129,0.12), 0 0 0 16px rgba(16,185,129,0.06); }
            50% { box-shadow: 0 0 0 12px rgba(16,185,129,0.18), 0 0 0 24px rgba(16,185,129,0.08); }
        }

        .verified-icon svg { width: 32px; height: 32px; color: white; }

        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(16,185,129,0.15);
            border: 1px solid rgba(16,185,129,0.3);
            color: #34d399;
            font-size: 0.6rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            padding: 5px 14px;
            border-radius: 100px;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #34d399;
            animation: blink 1.4s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .verified-title {
            font-size: 1.35rem;
            font-weight: 900;
            color: var(--text);
            letter-spacing: -0.02em;
            line-height: 1.2;
            position: relative;
            z-index: 1;
        }

        .verified-subtitle {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 6px;
            position: relative;
            z-index: 1;
        }

        .scan-time {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(99,102,241,0.12);
            border: 1px solid rgba(99,102,241,0.2);
            color: #a5b4fc;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 100px;
            margin-top: 16px;
            position: relative;
            z-index: 1;
        }

        /* ─── Info Card ─── */
        .info-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 16px;
            backdrop-filter: blur(8px);
        }

        .info-card-header {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-card-header .icon-wrap {
            width: 32px; height: 32px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }

        .info-card-header h2 {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-muted);
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }

        .info-item {
            padding: 16px 20px;
            border-right: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .info-item:nth-child(even) { border-right: none; }
        .info-item:last-child, .info-item:nth-last-child(2):nth-child(odd) { border-bottom: none; }
        .info-item.full { grid-column: 1 / -1; border-right: none; }

        .info-label {
            font-size: 0.6rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1.3;
        }

        /* ─── Results Card ─── */
        .results-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .results-header {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .results-header-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .results-header h2 {
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-muted);
        }

        .results-count {
            font-size: 0.6rem;
            font-weight: 800;
            background: rgba(99,102,241,0.2);
            color: #a5b4fc;
            border: 1px solid rgba(99,102,241,0.3);
            border-radius: 100px;
            padding: 2px 10px;
        }

        .result-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            gap: 12px;
            transition: background 0.2s;
        }

        .result-row:last-child { border-bottom: none; }
        .result-row:hover { background: rgba(255,255,255,0.03); }

        .result-jenis {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text);
            flex: 1;
        }

        .result-badge {
            font-size: 0.62rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 5px 12px;
            border-radius: 100px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .badge-normal {
            background: rgba(16,185,129,0.15);
            border: 1px solid rgba(16,185,129,0.3);
            color: #34d399;
        }

        .badge-penyimpangan {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            color: #f87171;
        }

        .badge-meragukan {
            background: rgba(245,158,11,0.15);
            border: 1px solid rgba(245,158,11,0.3);
            color: #fbbf24;
        }

        .badge-default {
            background: rgba(99,102,241,0.15);
            border: 1px solid rgba(99,102,241,0.3);
            color: #a5b4fc;
        }

        /* ─── Footer ─── */
        .page-footer {
            text-align: center;
            padding: 20px;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            border-radius: 20px;
        }

        .footer-logo {
            width: 40px; height: 40px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            margin: 0 auto 10px;
            display: flex; align-items: center; justify-content: center;
        }

        .footer-logo img { width: 100%; object-fit: contain; }

        .footer-clinic {
            font-size: 0.72rem;
            font-weight: 800;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .footer-unit {
            font-size: 0.6rem;
            color: var(--text-muted);
            margin-top: 3px;
        }

        .footer-disclaimer {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid var(--border);
            font-size: 0.6rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* ─── Responsive ─── */
        @media (max-width: 400px) {
            .verified-hero { padding: 24px 16px 20px; }
            .info-grid { grid-template-columns: 1fr; }
            .info-item { border-right: none; }
            .info-item:last-child { border-bottom: none; }
        }
    </style>
</head>

<body>
<div class="page-wrapper">

    {{-- ── Clinic Header ── --}}
    <div class="clinic-header">
        <div class="logo-wrap">
            <img src="{{ asset('assets/images/logo_bright_star.jpg') }}" alt="Logo">
        </div>
        <div class="clinic-text">
            <h1>Bright Star of Child</h1>
            <p>Jln. Mokodompit, Kec. Wawotobi, Kab. Konawe, Sulawesi Tenggara<br>
               0851-2323-8404 · brightstarofchild12@gmail.com</p>
        </div>
    </div>

    {{-- ── Verified Hero ── --}}
    <div class="verified-hero">
        <div class="verified-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </div>

        <div class="verified-badge">
            <span class="badge-dot"></span>
            Terverifikasi Digital
        </div>

        <h2 class="verified-title">Hasil Observasi Anak</h2>
        <p class="verified-subtitle">Data diperoleh dari sistem rekam medik terpadu Bright Star of Child</p>

        <div class="scan-time">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            Dipindai: {{ now()->translatedFormat('d M Y, H:i:s') }} WIB
        </div>
    </div>

    {{-- ── Identitas Anak ── --}}
    <div class="info-card">
        <div class="info-card-header">
            <div class="icon-wrap" style="background: rgba(99,102,241,0.15);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#a5b4fc" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <h2>Identitas Pasien</h2>
        </div>

        <div class="info-grid">
            <div class="info-item full">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value" style="font-size:1rem; font-weight:900; text-transform:uppercase; letter-spacing:-0.01em;">
                    {{ $data['nama'] }}
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Tanggal Lahir</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($data['tanggal_lahir'])->translatedFormat('d F Y') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Tanggal Observasi</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($data['tanggal_observasi'])->translatedFormat('d M Y') }}</div>
            </div>
        </div>
    </div>

    {{-- ── Hasil Pemeriksaan ── --}}
    @if(isset($data['results']) && count($data['results']) > 0)
    <div class="results-card">
        <div class="results-header">
            <div class="results-header-left">
                <div class="icon-wrap" style="background: rgba(16,185,129,0.15); width:32px; height:32px; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#34d399" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                    </svg>
                </div>
                <h2>Hasil Pemeriksaan</h2>
            </div>
            <span class="results-count">{{ count($data['results']) }} tes</span>
        </div>

        @foreach($data['results'] as $res)
        @php
            $hasil = strtolower($res['hasil'] ?? '');
            $isPenyimpangan = str_contains($hasil, 'penyimpangan') || str_contains($hasil, 'risiko') || str_contains($hasil, 'kemungkinan') || str_contains($hasil, 'curiga') || str_contains($hasil, 'gangguan');
            $isMeragukan    = str_contains($hasil, 'meragukan');
            $isNormal       = str_contains($hasil, 'normal') || str_contains($hasil, 'sesuai') || str_contains($hasil, 'tidak berisiko') || str_contains($hasil, 'tidak ada');
            $badgeClass     = $isPenyimpangan ? 'badge-penyimpangan' : ($isMeragukan ? 'badge-meragukan' : ($isNormal ? 'badge-normal' : 'badge-default'));
        @endphp
        <div class="result-row">
            <span class="result-jenis">{{ $res['jenis'] }}</span>
            <span class="result-badge {{ $badgeClass }}">{{ $res['hasil'] }}</span>
        </div>
        @endforeach
    </div>
    @else
    <div style="background: rgba(245,158,11,0.08); border: 1px solid rgba(245,158,11,0.2); border-radius: 16px; padding: 20px; text-align: center; margin-bottom: 16px;">
        <p style="font-size: 0.75rem; font-weight: 700; color: #fbbf24;">Belum ada data pemeriksaan tercatat pada sesi ini.</p>
    </div>
    @endif

    {{-- ── Footer ── --}}
    <div class="page-footer">
        <div class="footer-logo">
            <img src="{{ asset('assets/images/logo_bright_star.jpg') }}" alt="Logo">
        </div>
        <div class="footer-clinic">Bright Star of Child</div>
        <div class="footer-unit">Unit Verifikasi Rekam Medik Observasi</div>
        <div class="footer-disclaimer">
            Dokumen ini dibuat secara otomatis oleh sistem dan sah tanpa tanda tangan fisik.<br>
            Halaman akan diperbarui setiap 30 detik secara otomatis.
        </div>
    </div>

</div>
</body>
</html>
