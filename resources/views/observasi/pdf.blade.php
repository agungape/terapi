<!DOCTYPE html>
<html>

<head>
    <title>Hasil Pemeriksaan</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>
    <h2>Hasil Pemeriksaan</h2>
    <p><strong>Nama Anak:</strong> {{ $anak->nama }}</p>
    <p><strong>Tanggal Pemeriksaan:</strong> {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Pemeriksaan</th>
                <th>Hasil</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasilPemeriksaans as $index => $hasil)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ ucfirst($hasil->jenis) }}</td>
                    <td>{{ $hasil->hasil }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
