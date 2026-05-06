<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Verifikasi Assessment - {{ $data['nama'] }}</title>
    <meta http-equiv="refresh" content="20">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #eef2ff;
            --secondary: #64748b;
            --success: #10b981;
            --success-light: #ecfdf5;
            --warning: #f59e0b;
            --warning-light: #fffbeb;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            line-height: 1.6;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .report-card {
            width: 100%;
            max-width: 700px;
            background: var(--card-bg);
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid var(--border);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Medical Header / Kop */
        .kop-section {
            padding: 40px;
            background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
            border-bottom: 1px solid var(--border);
            position: relative;
        }

        .kop-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, var(--primary-light) 0%, transparent 70%);
            opacity: 0.5;
            pointer-events: none;
        }

        .kop-header {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .logo-box {
            width: 80px;
            height: 80px;
            background: white;
            padding: 10px;
            border-radius: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-box img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .clinic-info h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -0.025em;
            font-size: 1.5rem;
            text-transform: uppercase;
        }

        .clinic-info p {
            font-size: 0.85rem;
            color: var(--text-muted);
            max-width: 400px;
            margin-top: 4px;
        }

        /* Content Body */
        .content-body {
            padding: 40px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 1rem;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 25px;
        }

        .status-verified {
            background: var(--success-light);
            color: var(--success);
        }

        .status-pending {
            background: var(--warning-light);
            color: var(--warning);
        }

        .main-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 8px;
            letter-spacing: -0.01em;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 35px;
        }

        /* Data Grid */
        .data-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 40px;
        }

        .data-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 15px 20px;
            background: #fcfcfd;
            border: 1px solid #f1f5f9;
            border-radius: 1.25rem;
            transition: all 0.3s ease;
        }

        .data-item:hover {
            background: white;
            border-color: var(--primary-light);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .label {
            font-size: 0.7rem;
            font-weight: 800;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-main);
        }

        /* Signature Section */
        .footer-verification {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px dashed var(--border);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .signature-box {
            position: relative;
            margin-bottom: 15px;
        }

        .signature-box img {
            max-width: 220px;
            height: auto;
            filter: grayscale(0.2) contrast(1.1);
        }

        .verifier-name {
            font-weight: 700;
            color: var(--text-main);
            font-size: 0.95rem;
        }

        .verifier-title {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .unverified-message {
            background: #fff1f2;
            color: #e11d48;
            padding: 20px;
            border-radius: 1.25rem;
            font-weight: 600;
            font-size: 0.85rem;
            border: 1px solid #ffe4e6;
        }

        /* Responsive */
        @media (max-width: 640px) {
            body { padding: 10px; }
            .report-card { border-radius: 1.5rem; }
            .kop-section { padding: 25px; }
            .kop-header { flex-direction: column; text-align: center; gap: 15px; }
            .content-body { padding: 25px; }
            .main-title { font-size: 1.4rem; }
        }

        @media print {
            body { background: white; padding: 0; }
            .report-card { box-shadow: none; border: none; }
        }
    </style>
</head>

<body>
    <article class="report-card">
        <header class="kop-section">
            <div class="kop-header">
                <div class="logo-box">
                    <img src="{{ asset('assets/images/logo_bright_star.jpg') }}" alt="Logo Bright Star">
                </div>
                <div class="clinic-info">
                    <h2>Bright Star of Child</h2>
                    <p>Jln. Mokodompit, Kec. Wawotobi, Kab. Konawe, Sulawesi Tenggara. <br>
                       Hub: 0851-2323-8404 | brightstarofchild12@gmail.com</p>
                </div>
            </div>
        </header>

        <main class="content-body">
            @if ($data['persetujuan_psikolog'] == 1)
                <div class="status-badge status-verified">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    Assessment Disetujui
                </div>
            @else
                <div class="status-badge status-pending">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    Belum Disetujui
                </div>
            @endif

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <div>
                    <h1 class="main-title">Hasil Assessment Anak</h1>
                    <p class="subtitle" style="margin-bottom: 0;">Verifikasi dokumen rekam medis hasil assessment.</p>
                </div>
                <div style="text-align: right;">
                    <span style="font-size: 0.7rem; font-weight: 800; color: var(--text-muted); text-transform: uppercase;">Waktu Scan</span>
                    <p style="font-size: 0.85rem; font-weight: 700; color: var(--primary);">{{ now()->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>

            <div class="data-grid">
                <div class="data-item">
                    <span class="label">Identitas Anak</span>
                    <span class="value">{{ $data['nama'] }}</span>
                </div>
                
                <div class="data-item">
                    <span class="label">Domisili</span>
                    <span class="value">{{ $data['alamat'] }}</span>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="data-item">
                        <span class="label">Tanggal Lahir</span>
                        <span class="value">{{ \Carbon\Carbon::parse($data['tanggal_lahir'])->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="data-item">
                        <span class="label">Waktu Pemeriksaan</span>
                        <span class="value">{{ $data['tanggal_assessment'] }}</span>
                    </div>
                </div>

                @if(isset($data['diagnosa']))
                <div class="data-item" style="border-left: 4px solid var(--primary); background: var(--primary-light);">
                    <span class="label" style="color: var(--primary);">Diagnosa Utama</span>
                    <span class="value" style="font-size: 1.1rem; color: var(--text-main);">{{ $data['diagnosa'] }}</span>
                </div>
                @endif
            </div>

            <footer class="footer-verification">
                @if ($data['persetujuan_psikolog'] == 1)
                    <div class="signature-box">
                        <img src="{{ asset('assets/images/signature-psikolog-barcode.png') }}" alt="Psikolog Signature">
                    </div>
                    <p class="verifier-name">Astri Yunita, S.Psi., M.Psi., Psikolog</p>
                    <p class="verifier-title">Psikolog Klinis Bright Star of Child</p>
                    <p class="verifier-title" style="font-size: 0.7rem; margin-top: 4px;">SIPP. 20130221-2023-03-0807</p>
                @else
                    <div class="unverified-message">
                        <p>Dokumen ini belum ditandatangani.</p>
                        <p style="font-size: 0.75rem; margin-top: 5px; opacity: 0.8;">Alasan: {{ $data['alasan_tidak_setuju'] }}</p>
                    </div>
                @endif
            </footer>
        </main>
    </article>
</body>

</html>
