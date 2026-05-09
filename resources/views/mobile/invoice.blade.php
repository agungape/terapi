<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #9333ea; /* purple-600 */
            margin-bottom: 5px;
        }

        .sub-header {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-bottom: 20px;
        }

        hr {
            border: 0;
            border-top: 2px solid #e5e7eb;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #e5e7eb;
            padding: 12px;
            text-align: left;
        }

        .table th {
            background-color: #f9fafb;
            font-weight: bold;
            color: #4b5563;
        }

        .offer-details td {
            padding: 5px;
            vertical-align: top;
            font-size: 14px;
        }

        .offer-details td:first-child {
            white-space: nowrap;
            font-weight: bold;
            color: #4b5563;
            width: 120px;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #15803d;
        }

        .total-section {
            margin-top: 20px;
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            color: #9333ea;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">INVOICE</div>
        <div class="sub-header">#BSC{{ $invoice->id }}{{ \Carbon\Carbon::parse($invoice->tanggal)->format('dmy') }}</div>
        
        <hr>
        
        <table class="offer-details">
            <tr>
                <td>Dari</td>
                <td>: Layanan Terapi Anak Berkebutuhan Khusus</td>
            </tr>
            <tr>
                <td>Kepada</td>
                <td>: Anak {{ $anak->nama }} - {{ $anak->alamat }}</td>
            </tr>
            <tr>
                <td>Tanggal Bayar</td>
                <td>: {{ $invoice->tanggal }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: <span class="badge badge-success">Diterima</span></td>
            </tr>
        </table>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Paket Terapi</th>
                    <th style="text-align: right;">Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if (!empty($invoice->tarif->nama))
                        <td>{{ $invoice->tarif->nama }}</td>
                    @else
                        <td>Terapi Perilaku</td>
                    @endif
                    <td style="text-align: right;">Rp {{ number_format($invoice->jumlah, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
        
        <div class="total-section">
            Total: Rp {{ number_format($invoice->jumlah, 0, ',', '.') }}
        </div>

    </div>
</body>

</html>
