<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        /* Reset margin and padding */
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
            padding: 40px;
            position: relative;
            overflow-x: hidden;
            /* Prevent horizontal scroll */
            background-color: white;
            /* Remove the gray background */
        }

        /* Watermark styling */
        .watermark {
            position: fixed;
            /* Fixed position to stay on the page */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            /* Centered and rotated */
            z-index: -1;
            /* Ensures watermark is behind the content */
            opacity: 0.1;
            font-size: 120px;
            color: #000;
            font-weight: bold;
            pointer-events: none;
            /* Ensure watermark does not interfere with user interactions */
        }

        /* Header kop laporan */
        .kop-laporan {
            text-align: center;
            margin-bottom: 30px;
        }

        .kop-laporan img {
            max-width: 120px;
            /* Logo width */
            margin-bottom: 10px;
        }

        .kop-laporan h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 5px;
        }

        .kop-laporan p {
            font-size: 16px;
            color: #555;
        }

        /* Main content */
        .content {
            background-color: #fff;
            /* Ensure clean white background */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            margin-left: -40px;
            /* Shift content to the left */
            margin-right: -40px;
            /* Shift content to the right */
            position: relative;
            z-index: 1;
        }

        .content h2 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            table-layout: auto;
        }

        table th,
        table td {
            padding: 12px 15px;
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
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }

        /* Additional modern touches */
        .content::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            background: linear-gradient(135deg, #4CAF50, #81C784);
            z-index: -1;
            border-radius: 15px;
            opacity: 0.1;
        }
    </style>
</head>

<body>
    <!-- Watermark -->
    <div class="watermark">Laporan Keuangan</div>

    <!-- Kop Laporan -->
    <div class="kop-laporan">
        <img src="path_to_your_logo.png" alt="Logo Perusahaan"> <!-- Replace with actual logo path -->
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
