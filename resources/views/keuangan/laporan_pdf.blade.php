<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        /* Reset margin & padding */
        body,
        h1,
        h2,
        p,
        table {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        /* Body styling */
        body {
            padding: 20px;
            background-color: white;
            font-size: 12px;
            /* Mengurangi ukuran font */
        }

        /* Watermark styling */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            z-index: -10;
            /* Membuat watermark di belakang */
            opacity: 0.1;
            font-size: 80px;
            /* Diperkecil agar tidak mendominasi */
            color: #000;
            font-weight: bold;
            pointer-events: none;
        }

        /* Header kop laporan */
        .kop-laporan {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-laporan img {
            max-width: 100px;
            /* Diperkecil */
            margin-bottom: 5px;
        }

        .kop-laporan h1 {
            font-size: 20px;
            /* Ukuran font lebih kecil */
            color: #333;
            margin-bottom: 3px;
        }

        .kop-laporan p {
            font-size: 14px;
            /* Diperkecil */
            color: #555;
        }

        /* Main content */
        .content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .content h2 {
            font-size: 18px;
            text-align: center;
            margin-bottom: 15px;
            color: #333;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            /* Mengurangi ukuran font */
        }

        table th,
        table td {
            padding: 8px 10px;
            /* Diperkecil */
            text-align: left;
        }

        table th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        table td {
            background-color: #fff;
        }

        /* Zebra stripes for rows */
        table tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        /* Borders for table and cells */
        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        /* Styling for amount columns */
        td:nth-child(3),
        td:nth-child(5) {
            text-align: right;
            font-weight: bold;
        }

        /* Footer styling */
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <!-- Watermark -->
    <div class="watermark">Laporan Keuangan</div>

    <!-- Kop Laporan -->
    <div class="kop-laporan">
        <img src="{{ asset('assets') }}/mobile/pixio/images/app-logo/bsc.png" alt="Logo Perusahaan">
        <!-- Ganti dengan path logo yang benar -->
        <h1>Laporan Keuangan</h1>
        <p>Periode: {{ $startDate }} hingga {{ $endDate }}</p>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h2>Detail Laporan Keuangan</h2>

        <!-- Laporan Table -->
        <table>
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
                        <td>{{ $report->tanggal }}</td>
                        <td>{{ $report->jenis }}</td>
                        <td>{{ number_format($report->jumlah, 2) }}</td>
                        <td>{{ $report->deskripsi }}</td>
                        <td>{{ number_format($report->current_balance, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Dibuat oleh: Nama Perusahaan Anda</p>
        <p>Tanggal Cetak: {{ now()->format('d F Y H:i:s') }}</p>
    </div>
</body>

</html>
