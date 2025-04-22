<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Observasi - {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 5px 0;
            font-size: 12px;
        }

        .title {
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        .table th {
            background-color: #f5f5f5;
        }

        .amount {
            text-align: right;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            color: #777;
            margin-top: 30px;
        }

        .footer p {
            margin: 2px 0;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('assets/mobile/pixio/images/app-logo/bsc.png') }}" alt="Logo">
        <h2>Hasil Observasi</h2>
        <p>Periode: {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</p>
    </div>

    <!-- Judul -->
    <div class="title">
        <p>Hasil Pemeriksaan Observasi</p>
    </div>

    <!-- Table for Results -->
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Observasi</th>
                <th>Hasil Pemeriksaan</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $jenis => $items)
                <tr>
                    <td colspan="4" style="text-align: center; font-weight: bold; background-color: #f0f0f0;">
                        {{ ucfirst($jenis) }}</td>
                </tr>
                @foreach ($items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>{{ $item->hasil }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data hasil observasi pada tanggal ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Dibuat oleh: Nama Perusahaan</p>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</p>
    </div>
</body>

</html>
