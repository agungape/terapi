<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 20px;
            position: relative;
        }

        .watermark {
            position: fixed;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.05;
            z-index: 0;
        }

        .watermark img {
            width: 300px;
        }

        .kop-laporan {
            text-align: center;
            margin-bottom: 20px;
            z-index: 2;
            position: relative;
        }

        .kop-laporan h1 {
            margin: 5px 0;
        }

        .kop-laporan p {
            margin: 0;
            font-size: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            z-index: 2;
            position: relative;
        }

        .table th,
        .table td {
            border: 1px solid #999;
            padding: 6px;
            text-align: left;
            background-color: #fff;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .amount {
            text-align: right;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 30px;
            color: #777;
            position: relative;
            z-index: 2;
        }
    </style>
</head>

<body>
    <!-- Watermark -->
    <div class="watermark">
        {{-- <img src="{{ public_path('assets/mobile/pixio/images/app-logo/bsc.png') }}" alt="Watermark"> --}}
    </div>

    <!-- Header -->
    <div class="kop-laporan">
        <h1>Laporan Keuangan</h1>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
    </div>

    <!-- Tabel -->
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Saldo Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($financialReport as $report)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($report->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($report->jenis) }}</td>
                    <td class="amount">Rp {{ number_format($report->jumlah, 0, ',', '.') }}</td>
                    <td>{{ $report->deskripsi }}</td>
                    <td class="amount">Rp {{ number_format($report->current_balance, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
    </div>
</body>

</html>
