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
            --primary-light: #eef2ff;
            --success: #10b981;
            --success-light: #ecfdf5;
            --danger: #ef4444;
            --danger-light: #fff1f2;
            --warning: #f59e0b;
            --warning-light: #fffbeb;
            --bg: #f8fafc;
            --surface: #ffffff;
            --surface-2: #f1f5f9;
            --text: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
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
            padding: 20px 16px 48px;
            position: relative;
        }

        /* Subtle background pattern */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 50% at 0% 0%, rgba(99,102,241,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 60% 40% at 100% 100%, rgba(16,185,129,0.05) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        .page-wrapper {
            width: 100%;
            max-width: 520px;
            position: relative;
            z-index: 1;
            animation: slideUp 0.65s cubic-bezier(0.16, 1, 0.3, 1) both;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ─── Clinic Header ─── */
        .clinic-header {
            display: flex;
            align-items: center;
            gap: 14px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 16px 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .logo-wrap {
            width: 52px; height: 52px;
            flex-shrink: 0;
            background: var(--surface-2);
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .logo-wrap img { width: 100%; height: 100%; object-fit: contain; }

        .clinic-text h1 {
            font-size: 0.85rem;
            font-weight: 900;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.04em;
            line-height: 1.2;
        }

        .clinic-text p {
            font-size: 0.63rem;
            color: var(--text-muted);
            margin-top: 4px;
            line-height: 1.6;
        }

        /* ─── Verified Hero ─── */
        .verified-hero {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #4338ca 100%);
            border-radius: 24px;
            padding: 32px 24px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px -8px rgba(99,102,241,0.35);
        }

        .verified-hero::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 70%);
            pointer-events: none;
        }

        .verified-hero::after {
            content: '';
            position: absolute;
            bottom: -50px; left: -30px;
            width: 180px; height: 180px;
            background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .verified-icon {
            width: 72px; height: 72px;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(8px);
            border: 2px solid rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
            animation: pulse-icon 2.5s ease-in-out infinite;
        }

        @keyframes pulse-icon {
            0%, 100% { box-shadow: 0 0 0 0 rgba(255,255,255,0.15), 0 0 0 0 rgba(255,255,255,0.08); }
            50% { box-shadow: 0 0 0 10px rgba(255,255,255,0.08), 0 0 0 20px rgba(255,255,255,0.03); }
        }

        .verified-icon svg { width: 30px; height: 30px; color: white; }

        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.25);
            color: white;
            font-size: 0.6rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            padding: 5px 14px;
            border-radius: 100px;
            margin-bottom: 14px;
            position: relative;
            z-index: 1;
        }

        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #6ee7b7;
            animation: blink 1.4s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .verified-title {
            font-size: 1.5rem;
            font-weight: 900;
            color: white;
            letter-spacing: -0.02em;
            line-height: 1.2;
            position: relative;
            z-index: 1;
        }

        .verified-subtitle {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.7);
            margin-top: 8px;
            line-height: 1.5;
            position: relative;
            z-index: 1;
        }

        .scan-time {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.9);
            font-size: 0.65rem;
            font-weight: 700;
            padding: 7px 16px;
            border-radius: 100px;
            margin-top: 18px;
            position: relative;
            z-index: 1;
        }

        /* ─── Card Base ─── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }

        .card-header {
            padding: 13px 20px;
            border-bottom: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--surface-2);
        }

        .card-header .icon-wrap {
            width: 30px; height: 30px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
        }

        .card-header h2 {
            font-size: 0.68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-muted);
            flex: 1;
        }

        /* ─── Info Grid ─── */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .info-item {
            padding: 16px 20px;
            border-right: 1px solid var(--border-light);
            border-bottom: 1px solid var(--border-light);
        }

        .info-item:nth-child(even) { border-right: none; }
        .info-item:last-child, .info-item:nth-last-child(2):nth-child(odd) { border-bottom: none; }
        .info-item.full { grid-column: 1 / -1; border-right: none; }
        .info-item.full:last-child { border-bottom: none; }

        .info-label {
            font-size: 0.6rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-muted);
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1.3;
        }

        /* ─── Results ─── */
        .results-count {
            font-size: 0.6rem;
            font-weight: 800;
            background: var(--primary-light);
            color: var(--primary);
            border: 1px solid #c7d2fe;
            border-radius: 100px;
            padding: 2px 10px;
        }

        .result-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 20px;
            border-bottom: 1px solid var(--border-light);
            gap: 12px;
            transition: background 0.15s;
        }

        .result-row:last-child { border-bottom: none; }
        .result-row:hover { background: #fafbfd; }

        .result-jenis {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text);
            flex: 1;
        }

        .result-badge {
            font-size: 0.6rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            padding: 4px 12px;
            border-radius: 100px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .badge-normal    { background: var(--success-light); border: 1px solid #a7f3d0; color: #059669; }
        .badge-penyimpangan { background: var(--danger-light); border: 1px solid #fecaca; color: #dc2626; }
        .badge-meragukan { background: var(--warning-light); border: 1px solid #fde68a; color: #d97706; }
        .badge-default   { background: var(--primary-light); border: 1px solid #c7d2fe; color: var(--primary); }

        /* ─── Tanda Tangan ─── */
        .signature-section {
            padding: 24px 20px;
            text-align: center;
        }

        .signature-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .signature-divider span {
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .signature-divider::before,
        .signature-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .signature-img-wrap {
            display: inline-block;
            padding: 12px 24px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 16px;
            margin-bottom: 14px;
        }

        .signature-img-wrap img {
            max-width: 160px;
            max-height: 80px;
            width: auto;
            height: auto;
            object-fit: contain;
            display: block;
            filter: grayscale(20%);
        }

        .signature-name {
            font-size: 0.82rem;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -0.01em;
        }

        .signature-role {
            font-size: 0.65rem;
            color: var(--text-muted);
            margin-top: 3px;
            font-weight: 500;
        }

        .signature-unit {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 10px;
            background: var(--primary-light);
            border: 1px solid #c7d2fe;
            border-radius: 100px;
            padding: 4px 12px;
            font-size: 0.6rem;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* ─── Footer ─── */
        .page-footer {
            text-align: center;
            padding: 18px 20px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        .footer-logo {
            width: 38px; height: 38px;
            background: var(--surface-2);
            border-radius: 11px;
            overflow: hidden;
            margin: 0 auto 10px;
            border: 1px solid var(--border);
        }

        .footer-logo img { width: 100%; height: 100%; object-fit: contain; }

        .footer-clinic {
            font-size: 0.72rem;
            font-weight: 900;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .footer-disclaimer {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px dashed var(--border);
            font-size: 0.6rem;
            color: var(--text-muted);
            line-height: 1.7;
        }

        /* ─── Responsive ─── */
        @media (max-width: 400px) {
            .verified-hero { padding: 24px 16px 22px; }
            .info-grid { grid-template-columns: 1fr; }
            .info-item { border-right: none; }
        }
    </style>
</head>

<body>
<div class="page-wrapper">

    {{-- ── Clinic Header ── --}}
    <div class="clinic-header">
        <div class="logo-wrap">
            <img src="{{ asset('assets/images/logo_bright_star.jpg') }}" alt="Logo Bright Star of Child">
        </div>
        <div class="clinic-text">
            <h1>Bright Star of Child</h1>
            <p>Jln. Mokodompit, Kec. Wawotobi, Kab. Konawe<br>
               Sulawesi Tenggara · 0851-2323-8404</p>
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
        <p class="verified-subtitle">Data diperoleh dari sistem rekam medik terpadu<br>Bright Star of Child</p>

        <div class="scan-time">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
            </svg>
            Dipindai: {{ now()->translatedFormat('d M Y, H:i:s') }} WIB
        </div>
    </div>

    {{-- ── Identitas Anak ── --}}
    <div class="card">
        <div class="card-header">
            <div class="icon-wrap" style="background: #eef2ff;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <h2>Identitas Pasien</h2>
        </div>
        <div class="info-grid">
            <div class="info-item full">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value" style="font-size:1.05rem; font-weight:900; text-transform:uppercase; letter-spacing:-0.01em; color:#1e293b;">
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
    <div class="card">
        <div class="card-header">
            <div class="icon-wrap" style="background: #ecfdf5;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                </svg>
            </div>
            <h2>Hasil Pemeriksaan</h2>
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
    <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 16px; padding: 18px 20px; text-align:center;">
        <p style="font-size:0.75rem; font-weight:700; color:#d97706;">Belum ada data pemeriksaan tercatat pada sesi ini.</p>
    </div>
    @endif

    {{-- ── Tanda Tangan Terapis ── --}}
    <div class="card">
        <div class="card-header">
            <div class="icon-wrap" style="background: #f0fdf4;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22C6.5 22 2 17.5 2 12S6.5 2 12 2s10 4.5 10 10-4.5 10-10 10z"/>
                    <path d="M9 12l2 2 4-4"/>
                </svg>
            </div>
            <h2>Pengesahan Terapis</h2>
        </div>
        <div class="signature-section">
            <div class="signature-divider"><span>Tanda Tangan</span></div>

            @if(file_exists(public_path('assets/images/signature.png')))
                <div class="signature-img-wrap">
                    <img src="{{ asset('assets/images/signature.png') }}" alt="Tanda Tangan Terapis">
                </div>
            @else
                <div style="width:160px; height:64px; border:2px dashed #cbd5e1; border-radius:12px; display:flex; align-items:center; justify-content:center; margin:0 auto 14px;">
                    <span style="font-size:0.65rem; color:#94a3b8; font-weight:600;">Tanda Tangan</span>
                </div>
            @endif

            <div class="signature-name">Petugas Observasi</div>
            <div class="signature-role">Terapis Klinis Terdaftar</div>
            <div class="signature-unit">
                <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                Unit Verifikasi Bright Star of Child
            </div>
        </div>
    </div>

    {{-- ── Page Footer ── --}}
    <div class="page-footer">
        <div class="footer-logo">
            <img src="{{ asset('assets/images/logo_bright_star.jpg') }}" alt="Logo">
        </div>
        <div class="footer-clinic">Bright Star of Child</div>
        <div class="footer-disclaimer">
            Dokumen ini dibuat otomatis oleh sistem dan sah secara digital tanpa tanda tangan fisik tambahan.<br>
            Halaman diperbarui setiap 30 detik. Scan QR untuk verifikasi ulang.
        </div>
    </div>

</div>
</body>
</html>
