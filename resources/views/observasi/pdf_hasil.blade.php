<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Observasi - {{ $anak->nama }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.5;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 18pt;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 12pt;
        }

        .info-box {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .info-box table {
            width: 100%;
        }

        .info-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .section-title {
            background-color: #f0f0f0;
            padding: 5px 10px;
            font-weight: bold;
            border-left: 4px solid #333;
            margin-bottom: 10px;
        }

        table.result-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table.result-table th,
        table.result-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table.result-table th {
            background-color: #f2f2f2;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN HASIL OBSERVASI</h1>
        <p>BRIGHT STAR OF CHILD - Pusat Layanan Terapi Anak Istimewa</p>
    </div>

    <div class="info-box">
        <table>
            <tr>
                <td width="20%">Nama Anak</td>
                <td width="30%">: {{ $anak->nama }}</td>
                <td width="20%">Tanggal Lahir</td>
                <td width="30%">: {{ $anak->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>Tanggal Observasi</td>
                <td>: {{ date('d/m/Y', strtotime($tanggal)) }}</td>
                <td>Usia Saat Observasi</td>
                <td>: {{ $anak->usia }} tahun</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">HASIL DETEKSI DINI</div>
        <table class="result-table">
            <thead>
                <tr>
                    <th width="40%">Jenis Pemeriksaan</th>
                    <th width="30%">Hasil</th>
                    <th width="30%">Interpretasi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $penyimpangan_perilaku }}</td>
                    <td>{{ $jumlahJawabanYaPerilaku }} dari 14 indikator YA</td>
                    <td>
                        @if ($jumlahJawabanYaPerilaku >= 2)
                            <strong>Risiko tinggi:</strong> Kemungkinan masalah mental emosional
                        @else
                            Tidak terdeteksi masalah
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ $autis }}</td>
                    <td>{{ $jumlahJawabanTidakAutis }} dari 23 indikator TIDAK</td>
                    <td>
                        @if ($jumlahJawabanTidakAutis >= 2)
                            <strong>Risiko tinggi:</strong> Hambatan komunikasi dan keterlambatan bicara
                        @else
                            Tidak terdeteksi masalah
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ $gpph }}</td>
                    <td>Total nilai: {{ $totalNilaiGpph }}</td>
                    <td>
                        @if ($totalNilaiGpph >= 13)
                            <strong>Risiko tinggi:</strong> Kesulitan pemusatan perhatian dan hiperaktifitas
                        @else
                            Tidak terdeteksi masalah
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    @foreach ($hasil as $jenis => $items)
        <div class="section">
            <div class="section-title">HASIL OBSERVASI {{ strtoupper($jenis) }}</div>
            <table class="result-table">
                <thead>
                    <tr>
                        <th width="80%">Aspek yang Diamati</th>
                        <th width="20%">Hasil</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->aspek }}</td>
                            <td>{{ $item->hasil }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach

    <div class="signature">
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>Terapis Bright Star</strong></p>
    </div>
</body>

</html>
