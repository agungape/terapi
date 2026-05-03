<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran - {{ $pemasukkan->id }}</title>
    <style>
        @page { 
            margin: 5mm;
            size: 80mm 200mm;
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
        <div class="brand">BRIGHT STAR</div>
        <div class="address">
            Therapy & Development Center<br>
            Bukti Pembayaran Elektronik
        </div>
    </div>

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

    <div class="text-center footer">
        <div class="thanks">TERIMA KASIH</div>
        Semoga lekas menunjukkan perkembangan<br>
        yang luar biasa bagi buah hati.<br><br>
        *** Layanan Terapi Terpercaya ***<br>
        {{ date('Y') }} &copy; BRIGHT STAR SYSTEM
    </div>
</body>
</html>
