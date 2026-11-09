<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran - {{ $pemasukkan->id }}</title>
    <style>
        @page { 
            margin: 5mm;
            size: 80mm 250mm;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 0;
            width: 70mm;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        
        .header {
            margin-bottom: 10px;
        }
        .brand {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
            letter-spacing: 1px;
        }
        .address {
            font-size: 8px;
            margin-top: 2px;
            line-height: 1.2;
        }
        
        .divider {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
            font-size: 9px;
        }
        
        .service-section {
            margin: 12px 0;
        }
        .package-name {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            display: block;
            margin-bottom: 3px;
        }
        .service-detail {
            font-size: 9px;
            display: block;
        }
        
        .amount-section {
            margin: 12px 0;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 6px 0;
        }
        .total-label {
            font-size: 10px;
        }
        .total-amount {
            font-size: 16px;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 15px;
            font-size: 8px;
            line-height: 1.4;
        }
        .thanks {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>
    <div class="text-center header">
        <div class="brand">BRIGHT STAR OF CHILD</div>
        <div class="address">
            Pusat Terapi & Tumbuh Kembang Anak<br>
            Bukti Pembayaran Resmi
        </div>
    </div>

    @if($pemasukkan->perusahaan_csr_id && $pemasukkan->perusahaanCsr)
    @php
        $logoBase64 = null;
        if ($pemasukkan->perusahaanCsr->logo) {
            $relLogo = ltrim(str_replace(['..', '\\'], ['', '/'], $pemasukkan->perusahaanCsr->logo), '/');
            $logoPath = null;
            foreach ([
                storage_path('app/public/' . $relLogo),
                storage_path('app/public/public/' . $relLogo),
                public_path('storage/' . $relLogo),
            ] as $candidate) {
                if (file_exists($candidate) && is_file($candidate)) {
                    $logoPath = $candidate;
                    break;
                }
            }
            if ($logoPath) {
                $ext = strtolower(pathinfo($logoPath, PATHINFO_EXTENSION));
                $logoData = file_get_contents($logoPath);
                $logoBase64 = 'data:image/' . ($ext === 'svg' ? 'svg+xml' : $ext) . ';base64,' . base64_encode($logoData);
            }
        }

        $pjiLogoBase64 = null;
        $pjiPath = public_path('assets/website/images/pji-removebg-preview.png');
        if (file_exists($pjiPath)) {
            $pjiData = file_get_contents($pjiPath);
            $pjiLogoBase64 = 'data:image/png;base64,' . base64_encode($pjiData);
        }
    @endphp
    <div style="text-align: center; margin: 8px 0; padding: 6px 4px; border: 1px dashed #000; background-color: #fafafa;">
        <div style="text-align: center; margin-bottom: 5px; line-height: 1;">
            @if($pjiLogoBase64 && $logoBase64)
                <img src="{{ $pjiLogoBase64 }}" height="46" alt="Plester Jiwa" style="max-width: 32mm; max-height: 46px; object-fit: contain; vertical-align: middle; margin: 0 2px;">
                <img src="{{ $logoBase64 }}" height="38" alt="Logo CSR" style="max-width: 30mm; max-height: 38px; object-fit: contain; vertical-align: middle; margin: 0 2px;">
            @elseif($pjiLogoBase64)
                <img src="{{ $pjiLogoBase64 }}" height="46" alt="Plester Jiwa" style="max-width: 50mm; max-height: 46px; object-fit: contain; vertical-align: middle;">
            @elseif($logoBase64)
                <img src="{{ $logoBase64 }}" height="40" alt="Logo CSR" style="max-width: 50mm; max-height: 40px; object-fit: contain; vertical-align: middle;">
            @endif
        </div>
        
        <div style="font-size: 8px; font-weight: bold; color: #555; letter-spacing: 0.5px;">PROGRAM KERJASAMA CSR</div>
        <div style="font-size: 10px; font-weight: bold; letter-spacing: 0.5px; text-transform: uppercase; margin-top: 1px;">{{ $pemasukkan->perusahaanCsr->nama_perusahaan }}</div>
        @if($pemasukkan->perusahaanCsr->deskripsi_program)
        <div style="font-size: 8px; font-style: italic; color: #333; margin-top: 2px;">{{ $pemasukkan->perusahaanCsr->deskripsi_program }}</div>
        @endif
    </div>
    @endif

    <div class="divider"></div>

    <div class="info-row">
        <span>No. Struk:</span>
        <span class="bold">#{{ str_pad($pemasukkan->id, 5, '0', STR_PAD_LEFT) }}</span>
    </div>
    <div class="info-row">
        <span>Tanggal:</span>
        <span>{{ \Carbon\Carbon::parse($pemasukkan->tanggal)->format('d/m/Y H:i') }}</span>
    </div>
    <div class="info-row">
        <span>Anak:</span>
        <span class="bold">{{ $pemasukkan->anak->nama ?? 'Umum' }}</span>
    </div>

    <div class="divider"></div>

    <div class="service-section">
        <span class="package-name">
            @if($pemasukkan->Tarif)
                {{ $pemasukkan->Tarif->nama }}
            @else
                {{ $pemasukkan->deskripsi }}
            @endif
        </span>
        <span class="service-detail bold">
            @if($pemasukkan->Tarif)
                TOTAL: {{ $pemasukkan->Tarif->jumlah_pertemuan }} PERTEMUAN
            @else
                Layanan: {{ ucfirst(str_replace('_', ' ', $pemasukkan->jenis_layanan)) }}
            @endif
        </span>
        @if($pemasukkan->Tarif)
        <span class="service-detail">
            Jenis: {{ ucfirst(str_replace('_', ' ', $pemasukkan->jenis_layanan)) }}
        </span>
        @endif
    </div>

    <div class="amount-section text-center">
        <div class="total-label">TOTAL PEMBAYARAN</div>
        <div class="total-amount">Rp {{ number_format($pemasukkan->jumlah, 0, ',', '.') }}</div>
    </div>

    <div class="info-row">
        <span>Metode:</span>
        <span class="bold" style="text-transform: uppercase;">{{ $pemasukkan->metode_bayar }}</span>
    </div>

    <div class="divider"></div>

    <div class="text-center" style="font-size: 8px; line-height: 1.5; margin: 8px 0; padding: 6px 4px;">
        <div style="font-weight: bold; font-size: 8.5px; margin-bottom: 3px;">[ KEBIJAKAN PEMBAYARAN ]</div>
        Pembayaran yang telah dilakukan bersifat<br>
        <strong>final dan tidak dapat dikembalikan / Refund</strong><br>
        dalam bentuk apapun. Dana yang masuk<br>
        sepenuhnya dialokasikan untuk keberlangsungan<br>
        program terapi yang telah disepakati bersama.<br><br>
        Terima kasih atas kepercayaan Bapak/Ibu<br>
        kepada layanan kami.
    </div>

    <div class="divider"></div>

    @php
        $dns2d = new \Milon\Barcode\DNS2D();
        $qrUrl = route('kwitansi.verify.public', ['token' => $pemasukkan->verification_token]);
        $qrCode = $dns2d->getBarcodePNG($qrUrl, 'QRCODE', 3, 3);
    @endphp
    <div class="text-center" style="margin: 8px 0;">
        <img src="data:image/png;base64,{{ $qrCode }}" width="65" height="65" alt="QR Verifikasi" style="display: block; margin: 0 auto;">
        <div style="font-size: 7.5px; font-weight: bold; color: #444; margin-top: 4px; letter-spacing: 0.5px;">
            VERIFIKASI KEASLIAN STRUK
        </div>
        <div style="font-size: 7px; color: #888; letter-spacing: 1px; margin-top: 1px;">
            TRX-{{ str_pad($pemasukkan->id, 6, '0', STR_PAD_LEFT) }}-{{ \Carbon\Carbon::parse($pemasukkan->tanggal)->format('Ymd') }}
        </div>
    </div>

    <div class="divider"></div>

    <div class="text-center footer">
        <div class="thanks">TERIMA KASIH</div>
        Semoga ananda tercinta terus tumbuh<br>
        dan berkembang dengan optimal.<br><br>
        *** Sahabat Tumbuh Kembang Buah Hati ***<br>
        {{ date('Y') }} &copy; BRIGHT STAR OF CHILD
    </div>
</body>
</html>
