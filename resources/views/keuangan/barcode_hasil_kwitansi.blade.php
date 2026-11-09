<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Kwitansi Pembayaran — Bright Star of Child</title>
    <meta name="description" content="Halaman verifikasi resmi keaslian kwitansi pembayaran Bright Star of Child.">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary: #0f172a;
            --primary-accent: #0284c7;
            --success: #10b981;
            --success-light: #ecfdf5;
            --success-border: #a7f3d0;
            --bg: #f8fafc;
            --surface: #ffffff;
            --surface-alt: #f1f5f9;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 24px 16px 48px;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: 
                radial-gradient(ellipse 80% 50% at 0% 0%, rgba(2, 132, 199, 0.08) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 100% 100%, rgba(16, 185, 129, 0.06) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        .container {
            width: 100%;
            max-width: 520px;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 16px;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ─── Clinic Header ─── */
        .clinic-header {
            display: flex;
            align-items: center;
            gap: 14px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 16px 20px;
            box-shadow: 0 4px 20px -4px rgba(0, 0, 0, 0.04);
        }

        .logo-box {
            width: 50px;
            height: 50px;
            flex-shrink: 0;
            background: var(--surface-alt);
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            padding: 4px;
        }

        .logo-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .clinic-info h1 {
            font-size: 14px;
            font-weight: 900;
            letter-spacing: -0.2px;
            text-transform: uppercase;
            color: var(--text-main);
        }

        .clinic-info p {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 600;
            margin-top: 2px;
        }

        /* ─── Verification Banner ─── */
        .verified-card {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: #ffffff;
            border-radius: 24px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.35);
            position: relative;
            overflow: hidden;
        }

        .verified-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            pointer-events: none;
        }

        .shield-icon {
            width: 56px;
            height: 56px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 24px;
            border: 2px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .verified-card h2 {
            font-size: 16px;
            font-weight: 900;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .verified-card p {
            font-size: 11px;
            font-weight: 500;
            opacity: 0.9;
            margin-top: 4px;
        }

        .trx-pill {
            display: inline-block;
            background: rgba(0, 0, 0, 0.15);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-top: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* ─── Main Details Card ─── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 4px 20px -4px rgba(0, 0, 0, 0.04);
        }

        .section-title {
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--text-muted);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-grid {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 12px;
            border-bottom: 1px dashed var(--border);
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-label {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 600;
        }

        .info-value {
            font-size: 13px;
            font-weight: 800;
            color: var(--text-main);
            text-align: right;
        }

        /* ─── Amount Highlight Box ─── */
        .amount-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 16px 20px;
            margin-top: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .amount-label {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
        }

        .amount-val {
            font-size: 20px;
            font-weight: 900;
            color: #059669;
        }

        /* ─── CSR Banner ─── */
        .csr-badge-box {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 20px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .csr-badge-logo {
            width: 48px;
            height: 48px;
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #fef3c7;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            flex-shrink: 0;
        }

        .csr-badge-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .csr-badge-text h4 {
            font-size: 12px;
            font-weight: 900;
            color: #92400e;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .csr-badge-text p {
            font-size: 10px;
            font-weight: 700;
            color: #b45309;
            margin-top: 2px;
        }

        /* ─── Security Footer Note ─── */
        .footer-note {
            text-align: center;
            font-size: 10px;
            color: var(--text-muted);
            line-height: 1.6;
            padding: 8px 16px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--primary);
            color: #ffffff;
            text-decoration: none;
            padding: 14px 20px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.2);
            transition: all 0.2s;
        }

        .action-btn:hover {
            background: #1e293b;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <div class="container">
        
        <!-- Header Lembaga -->
        <div class="clinic-header">
            <div class="logo-box">
                @if(file_exists(public_path('assets/website/images/pji-removebg-preview.png')))
                    <img src="{{ asset('assets/website/images/pji-removebg-preview.png') }}" alt="Plester Jiwa">
                @else
                    <i class="fa-solid fa-hospital text-slate-400"></i>
                @endif
            </div>
            <div class="clinic-info">
                <h1>Bright Star of Child</h1>
                <p>Pusat Terapi & Tumbuh Kembang Anak</p>
            </div>
        </div>

        <!-- Banner Keaslian Kwitansi -->
        <div class="verified-card">
            <div class="shield-icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <h2>Kwitansi Resmi Terverifikasi</h2>
            <p>Dokumen pembayaran elektronik ini sah dan terdaftar pada database sistem.</p>
            <div class="trx-pill">
                #{{ str_pad($pemasukkan->id, 6, '0', STR_PAD_LEFT) }} &bull; {{ \Carbon\Carbon::parse($pemasukkan->tanggal)->format('d/m/Y') }}
            </div>
        </div>

        @if($pemasukkan->perusahaan_csr_id && $pemasukkan->perusahaanCsr)
        <!-- Kartu Kerjasama CSR -->
        <div class="csr-badge-box">
            <div class="csr-badge-logo">
                @if($pemasukkan->perusahaanCsr->logo)
                    <img src="{{ route('perusahaan-csr.logo', $pemasukkan->perusahaanCsr->id) }}?v={{ optional($pemasukkan->perusahaanCsr->updated_at)->timestamp ?? time() }}" alt="Logo CSR">
                @else
                    <i class="fa-solid fa-building text-amber-500"></i>
                @endif
            </div>
            <div class="csr-badge-text">
                <h4>Program Kerjasama CSR</h4>
                <p>{{ $pemasukkan->perusahaanCsr->nama_perusahaan }}</p>
                @if($pemasukkan->perusahaanCsr->deskripsi_program)
                    <span style="font-size: 9px; opacity: 0.85; font-style: italic;">{{ $pemasukkan->perusahaanCsr->deskripsi_program }}</span>
                @endif
            </div>
        </div>
        @endif

        <!-- Rincian Kwitansi -->
        <div class="card">
            <div class="section-title">
                <i class="fa-solid fa-receipt text-sky-600"></i> Detail Pembayaran
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Nama Pasien / Anak</span>
                    <span class="info-value">{{ $pemasukkan->anak->nama ?? 'Umum' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Layanan / Paket</span>
                    <span class="info-value">
                        @if($pemasukkan->Tarif)
                            {{ $pemasukkan->Tarif->nama }}
                        @else
                            {{ $pemasukkan->deskripsi }}
                        @endif
                    </span>
                </div>
                @if($pemasukkan->Tarif)
                <div class="info-item">
                    <span class="info-label">Jumlah Pertemuan</span>
                    <span class="info-value">{{ $pemasukkan->Tarif->jumlah_pertemuan }} Sesi Terapi</span>
                </div>
                @endif
                <div class="info-item">
                    <span class="info-label">Kategori</span>
                    <span class="info-value">{{ ucfirst(str_replace('_', ' ', $pemasukkan->jenis_layanan ?? 'Paket Terapi')) }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Metode Pembayaran</span>
                    <span class="info-value" style="text-transform: uppercase;">{{ $pemasukkan->metode_bayar }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status Pembayaran</span>
                    <span class="info-value" style="color: #059669; font-weight: 900;">
                        <i class="fa-solid fa-circle-check mr-1"></i> LUNAS
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal Transaksi</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($pemasukkan->tanggal)->translatedFormat('d F Y, H:i') }} WITA</span>
                </div>
            </div>

            <div class="amount-box">
                <span class="amount-label">Total Dibayar</span>
                <span class="amount-val">Rp {{ number_format($pemasukkan->jumlah, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Tombol Cetak / PDF Struk -->
        <a href="{{ route('pemasukkan.kwitansi', $pemasukkan->id) }}" target="_blank" class="action-btn">
            <i class="fa-solid fa-file-pdf"></i>
            <span>Buka Versi Cetak / PDF</span>
        </a>

        <!-- Footer Catatan -->
        <div class="footer-note">
            <p>Dokumen ini diterbitkan secara otomatis oleh sistem digital <strong>Bright Star of Child</strong> dibawah naungan <strong>Yayasan Plester Jiwa Indonesia</strong>.</p>
            <p style="margin-top: 4px; font-weight: 700;">&copy; {{ date('Y') }} BRIGHT STAR OF CHILD. All rights reserved.</p>
        </div>

    </div>

</body>
</html>
