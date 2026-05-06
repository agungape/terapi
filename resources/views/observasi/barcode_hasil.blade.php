<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Verifikasi Observasi - {{ $data['nama'] }}</title>
    <meta http-equiv="refresh" content="20">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #eef2ff;
            --secondary: #64748b;
            --success: #10b981;
            --success-light: #ecfdf5;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

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

        .kop-section {
            padding: 40px;
            background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
            border-bottom: 1px solid var(--border);
        }

        .kop-header { display: flex; align-items: center; gap: 25px; }

        .logo-box {
            width: 80px; height: 80px; background: white; padding: 10px;
            border-radius: 1.5rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            display: flex; align-items: center; justify-content: center;
        }

        .logo-box img { width: 100%; height: auto; object-fit: contain; }

        .clinic-info h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800; color: var(--primary);
            font-size: 1.5rem; text-transform: uppercase;
        }

        .clinic-info p { font-size: 0.85rem; color: var(--text-muted); margin-top: 4px; }

        .content-body { padding: 40px; }

        .status-badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 8px 16px; background: var(--success-light);
            color: var(--success); border-radius: 1rem;
            font-weight: 700; font-size: 0.75rem;
            text-transform: uppercase; margin-bottom: 25px;
        }

        .main-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.75rem; font-weight: 800;
            color: var(--text-main); margin-bottom: 8px;
        }

        .subtitle { color: var(--text-muted); font-size: 0.95rem; }

        .data-grid { display: grid; grid-template-columns: 1fr; gap: 20px; margin-bottom: 40px; }

        .data-item {
            display: flex; flex-direction: column; gap: 6px;
            padding: 15px 20px; background: #fcfcfd;
            border: 1px solid #f1f5f9; border-radius: 1.25rem;
        }

        .label {
            font-size: 0.7rem; font-weight: 800; color: var(--text-muted);
            text-transform: uppercase; letter-spacing: 0.1em;
        }

        .value { font-size: 1rem; font-weight: 600; color: var(--text-main); }

        .footer-verification {
            margin-top: 40px; padding-top: 30px; border-top: 1px dashed var(--border);
            display: flex; flex-direction: column; align-items: center; text-align: center;
        }

        .signature-box img { max-width: 180px; height: auto; }

        @media (max-width: 640px) {
            .kop-section, .content-body { padding: 25px; }
            .kop-header { flex-direction: column; text-align: center; }
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
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <div>
                    <div class="status-badge">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        Terverifikasi Sistem
                    </div>
                    <h1 class="main-title">Hasil Observasi Anak</h1>
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
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="data-item">
                        <span class="label">Tanggal Lahir</span>
                        <span class="value">{{ \Carbon\Carbon::parse($data['tanggal_lahir'])->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="data-item">
                        <span class="label">Waktu Observasi</span>
                        <span class="value">{{ \Carbon\Carbon::parse($data['tanggal_observasi'])->translatedFormat('d M Y') }}</span>
                    </div>
                </div>

                @if(isset($data['results']) && count($data['results']) > 0)
                <div class="data-item" style="border-left: 4px solid var(--success); background: var(--success-light);">
                    <span class="label" style="color: var(--success);">Hasil Pemeriksaan</span>
                    <div style="display: grid; gap: 10px; margin-top: 10px;">
                        @foreach($data['results'] as $res)
                        <div style="display: flex; justify-content: space-between; padding: 8px 12px; background: white; border-radius: 0.75rem; border: 1px solid #eef2ff;">
                            <span style="font-size: 0.8rem; font-weight: 600; color: var(--secondary);">{{ $res['jenis'] }}</span>
                            <span style="font-size: 0.8rem; font-weight: 800; color: var(--primary);">{{ $res['hasil'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <footer class="footer-verification">
                <div class="signature-box">
                    <img src="{{ asset('assets/images/signature.png') }}" alt="Verified Signature">
                </div>
                <p style="font-weight: 700; font-size: 0.95rem;">Petugas Observasi</p>
                <p style="font-size: 0.8rem; color: var(--text-muted);">Bright Star of Child Verification Unit</p>
            </footer>
        </main>
    </article>
</body>

</html>
