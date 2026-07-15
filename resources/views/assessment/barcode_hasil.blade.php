<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Hasil Assessment — {{ $data['nama'] }}</title>
    <meta http-equiv="refresh" content="30">
    <meta name="description" content="Halaman verifikasi digital hasil assessment psikologi dari Bright Star of Child.">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary: #6366f1;
            --primary-light: #eef2ff;
            --primary-border: #c7d2fe;
            --success: #10b981;
            --success-light: #ecfdf5;
            --success-border: #a7f3d0;
            --danger: #ef4444;
            --danger-light: #fff1f2;
            --danger-border: #fecaca;
            --warning: #f59e0b;
            --warning-light: #fffbeb;
            --warning-border: #fde68a;
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

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 50% at 0% 0%, rgba(99,102,241,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 100% 100%, rgba(16,185,129,0.05) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        .page-wrapper {
            width: 100%;
            max-width: 520px;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 14px;
            animation: slideUp 0.65s cubic-bezier(0.16, 1, 0.3, 1) both;
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
            display: flex; align-items: center; justify-content: center;
            border: 1px solid var(--border);
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

        /* ─── Hero — Conditional Gradient ─── */
        .verified-hero {
            border-radius: 24px;
            padding: 32px 24px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-approved {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #4338ca 100%);
            box-shadow: 0 20px 40px -8px rgba(99,102,241,0.35);
        }

        .hero-rejected {
            background: linear-gradient(135deg, #f43f5e 0%, #e11d48 50%, #be123c 100%);
            box-shadow: 0 20px 40px -8px rgba(244,63,94,0.30);
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
            background: radial-gradient(circle, rgba(255,255,255,0.07) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-icon {
            width: 72px; height: 72px;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            border: 2px solid rgba(255,255,255,0.3);
            display: flex; align-items: center; justify-content: center;
            position: relative; z-index: 1;
            animation: pulse-icon 2.5s ease-in-out infinite;
        }

        @keyframes pulse-icon {
            0%, 100% { box-shadow: 0 0 0 0 rgba(255,255,255,0.15), 0 0 0 0 rgba(255,255,255,0.07); }
            50% { box-shadow: 0 0 0 10px rgba(255,255,255,0.08), 0 0 0 20px rgba(255,255,255,0.03); }
        }

        .hero-icon svg { width: 30px; height: 30px; color: white; }

        .hero-badge {
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
            position: relative; z-index: 1;
        }

        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: white;
            animation: blink 1.4s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .hero-title {
            font-size: 1.45rem;
            font-weight: 900;
            color: white;
            letter-spacing: -0.02em;
            line-height: 1.2;
            position: relative; z-index: 1;
        }

        .hero-subtitle {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.72);
            margin-top: 8px;
            line-height: 1.5;
            position: relative; z-index: 1;
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
            position: relative; z-index: 1;
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

        .icon-wrap {
            width: 30px; height: 30px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
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
            transition: background 0.15s;
        }

        .info-item:hover { background: #fafbfd; }
        .info-item:nth-child(even) { border-right: none; }
        .info-item.full { grid-column: 1 / -1; border-right: none; }
        /* Remove bottom border from last row */
        .info-item:last-child,
        .info-item:nth-last-child(2):nth-child(odd) { border-bottom: none; }
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
            line-height: 1.4;
        }

        /* ─── Diagnosa Highlight ─── */
        .diagnosa-box {
            margin: 0;
            padding: 18px 20px;
            background: var(--primary-light);
            border-left: 4px solid var(--primary);
        }

        .diagnosa-box .info-label { color: var(--primary); }
        .diagnosa-box .info-value { font-size: 1rem; font-weight: 900; color: var(--text); letter-spacing: -0.01em; }

        /* ─── Penolakan Warning ─── */
        .rejection-box {
            padding: 18px 20px;
            background: var(--danger-light);
            border-left: 4px solid var(--danger);
        }

        .rejection-box .info-label { color: var(--danger); }
        .rejection-box .info-value { font-size: 0.85rem; font-weight: 600; color: #7f1d1d; line-height: 1.5; }

        /* ─── Tanda Tangan / Signature ─── */
        .signature-section {
            padding: 24px 20px;
            text-align: center;
        }

        .sig-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
        }

        .sig-divider span {
            font-size: 0.62rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .sig-divider::before, .sig-divider::after {
            content: ''; flex: 1;
            height: 1px;
            background: var(--border);
        }

        .sig-img-wrap {
            display: inline-block;
            padding: 12px 28px;
            background: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 16px;
            margin-bottom: 16px;
        }

        .sig-img-wrap img {
            max-width: 180px;
            max-height: 80px;
            width: auto; height: auto;
            object-fit: contain;
            display: block;
            filter: grayscale(15%) contrast(1.1);
        }

        .sig-name {
            font-size: 0.88rem;
            font-weight: 900;
            color: var(--text);
            letter-spacing: -0.01em;
        }

        .sig-role {
            font-size: 0.68rem;
            color: var(--text-muted);
            margin-top: 3px;
            font-weight: 500;
        }

        .sig-sipp {
            font-size: 0.6rem;
            color: var(--text-muted);
            margin-top: 2px;
            font-weight: 600;
            letter-spacing: 0.04em;
        }

        .sig-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 12px;
            background: var(--primary-light);
            border: 1px solid var(--primary-border);
            border-radius: 100px;
            padding: 5px 14px;
            font-size: 0.6rem;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .sig-badge-rejected {
            background: var(--danger-light);
            border-color: var(--danger-border);
            color: var(--danger);
        }

        .rejection-note {
            background: var(--danger-light);
            border: 1px solid var(--danger-border);
            border-radius: 14px;
            padding: 16px 20px;
            text-align: left;
        }

        .rejection-note p:first-child {
            font-size: 0.72rem;
            font-weight: 800;
            color: var(--danger);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 6px;
        }

        .rejection-note p:last-child {
            font-size: 0.82rem;
            font-weight: 600;
            color: #7f1d1d;
            line-height: 1.5;
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
    @php $approved = $data['persetujuan_psikolog'] == 1; @endphp
    <div class="verified-hero {{ $approved ? 'hero-approved' : 'hero-rejected' }}">
        <div class="hero-icon">
            @if($approved)
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            @else
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
            @endif
        </div>

        <div class="hero-badge">
            <span class="badge-dot"></span>
            {{ $approved ? 'Disetujui Psikolog' : 'Belum Disetujui' }}
        </div>

        <h2 class="hero-title">Hasil Assessment Anak</h2>
        <p class="hero-subtitle">
            {{ $approved
                ? 'Dokumen telah diverifikasi dan disetujui oleh psikolog klinis terdaftar.'
                : 'Dokumen ini belum mendapatkan persetujuan dari psikolog klinis.' }}
        </p>

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
            <div class="icon-wrap" style="background:#eef2ff;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <h2>Identitas Pasien</h2>
        </div>
        <div class="info-grid">
            <div class="info-item full">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value" style="font-size:1.05rem;font-weight:900;text-transform:uppercase;letter-spacing:-0.01em;">
                    {{ $data['nama'] }}
                </div>
            </div>
            <div class="info-item full" style="border-bottom: 1px solid var(--border-light);">
                <div class="info-label">Domisili / Alamat</div>
                <div class="info-value">{{ $data['alamat'] }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Tanggal Lahir</div>
                <div class="info-value">{{ \Carbon\Carbon::parse($data['tanggal_lahir'])->translatedFormat('d F Y') }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Waktu Assessment</div>
                <div class="info-value">{{ $data['tanggal_assessment'] }}</div>
            </div>
        </div>

        @if(isset($data['diagnosa']) && !empty($data['diagnosa']))
        <div class="diagnosa-box">
            <div class="info-label">Diagnosa Utama</div>
            <div class="info-value">{{ $data['diagnosa'] }}</div>
        </div>
        @endif
    </div>

    {{-- ── Pengesahan Psikolog ── --}}
    <div class="card">
        <div class="card-header">
            <div class="icon-wrap" style="background: {{ $approved ? '#f0fdf4' : '#fff1f2' }};">
                @if($approved)
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22C6.5 22 2 17.5 2 12S6.5 2 12 2s10 4.5 10 10-4.5 10-10 10z"/><path d="M9 12l2 2 4-4"/>
                    </svg>
                @else
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                    </svg>
                @endif
            </div>
            <h2>Pengesahan Psikolog</h2>
        </div>

        <div class="signature-section">
            @if($approved)
                {{-- Tanda tangan disetujui --}}
                <div class="sig-divider"><span>Tanda Tangan Digital</span></div>

                @if(file_exists(public_path('assets/images/signature-psikolog-barcode.png')))
                    <div class="sig-img-wrap">
                        <img src="{{ asset('assets/images/signature-psikolog-barcode.png') }}" alt="Tanda Tangan Psikolog">
                    </div>
                @else
                    <div style="width:180px;height:70px;border:2px dashed #cbd5e1;border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                        <span style="font-size:0.65rem;color:#94a3b8;font-weight:600;">Tanda Tangan</span>
                    </div>
                @endif

                <div class="sig-name">Astri Yunita, S.Psi., M.Psi., Psikolog</div>
                <div class="sig-role">Psikolog Klinis Bright Star of Child</div>
                <div class="sig-sipp">SIPP. 20130221-2023-03-0807</div>
                <div class="sig-badge">
                    <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Dokumen Terverifikasi & Disetujui
                </div>
            @else
                {{-- Belum disetujui --}}
                <div class="sig-divider"><span>Status Pengesahan</span></div>

                <div class="rejection-note">
                    <p>Alasan Penolakan</p>
                    <p>{{ $data['alasan_tidak_setuju'] ?? 'Tidak ada keterangan yang diberikan.' }}</p>
                </div>

                <div class="sig-badge sig-badge-rejected" style="margin-top:16px;">
                    <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                    Belum Mendapat Persetujuan Psikolog
                </div>
            @endif
        </div>
    </div>

    {{-- ── Page Footer ── --}}
    <div class="page-footer">
        <div class="footer-logo">
            <img src="{{ asset('assets/images/logo_bright_star.jpg') }}" alt="Logo">
        </div>
        <div class="footer-clinic">Bright Star of Child</div>
        <div class="footer-disclaimer">
            Dokumen ini diterbitkan secara otomatis oleh sistem dan sah secara digital.<br>
            Halaman diperbarui setiap 30 detik. Scan QR untuk verifikasi ulang.
        </div>
    </div>

</div>
</body>
</html>
