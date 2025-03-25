<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .header {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid black;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
        }

        .total {
            text-align: right;
            font-size: 18px;
            margin-top: 10px;
        }

        .offer-details td {
            padding: 5px;
            vertical-align: top;
        }

        .offer-details td:first-child {
            white-space: nowrap;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">Invoice #BSC{{ $invoice->id }}{{ \Carbon\Carbon::parse($invoice->tanggal)->format('dmy') }}
        </div>
        <hr>
        <table class="offer-details">
            <tr>
                <td><strong>Dari</strong></td>
                <td>: Layanan Terapi Anak Berkebutuhan Khusus</td>
            </tr>
            <tr>
                <td><strong>Kepada</strong></td>
                <td>: Anak {{ $anak->nama }} - {{ $anak->alamat }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Bayar</strong></td>
                <td>: {{ $invoice->tanggal }}</td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td>: <span class="badge badge-sm badge-success">Diterima</span></td>
            </tr>
        </table>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Paket Terapi</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if (!empty($p->tarif->nama))
                        <td>{{ $invoice->tarif->nama }}</td>
                    @else
                        <td>Terapi Perilaku</td>
                    @endif
                    <td>{{ $invoice->jumlah }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>
