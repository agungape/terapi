<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Hasil Observasi</title>
    <style>
        @page {
            margin: 50px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 18pt;
            margin: 5px 0;
            color: #1a5f9c;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header h2 {
            font-size: 14pt;
            margin: 0;
            color: #333;
            font-weight: normal;
        }

        .header-address {
            font-size: 10pt;
            margin-top: 10px;
            line-height: 1.3;
        }

        .divider {
            border-top: 1px solid #000;
            margin: 15px 0;
        }

        .report-title {
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            margin: 20px 0;
            text-decoration: underline;
        }

        .child-name {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .observation-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .observation-table th {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            font-weight: bold;
        }

        .observation-table td {
            padding: 10px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        .footer {
            margin-top: 30px;
            font-size: 10pt;
            text-align: right;
        }
    </style>
</head>

<body>
    <!-- Kop Surat -->
    <div class="header">
        <img src="{{ public_path('assets/images/kop-surat.png') }}" alt="Kop Surat">
    </div>


    <!-- Judul Laporan -->
    <div class="report-title">LAPORAN HASIL OBSERVASI</div>
    <div class="child-name">ZAHIRA</div>

    <!-- Tabel Hasil Observasi -->
    <table class="observation-table">
        <thead>
            <tr>
                <th width="40%">Alat Observasi</th>
                <th width="60%">Hasil Observasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasil as $jenis => $items)
                <tr>
                    <td>
                        @if ($jenis === 'Penyimpangan Perilaku')
                            {{ $penyimpangan_perilaku }}
                        @elseif ($jenis === 'Autisme')
                            {{ $autis }}
                        @elseif ($jenis === 'GPPH')
                            {{ $gpph }}
                        @else
                            {{ $jenis }}
                        @endif
                    </td>
                    <td>
                        @if ($jenis === 'Penyimpangan Perilaku')
                            Dari 14 indikator, terdapat {{ $jumlahJawabanYaPerilaku }} jawaban "YA".
                            @if ($jumlahJawabanYaPerilaku >= 2)
                                dimana ketentuannya jika terdapat 2 atau lebih jawaban "YA" pada indikator penentuan,
                                Maka terdapat kemungkinan anak mengalami permasalahan mental emosional dan disarankan
                                konsultasi lebih lanjut ke dokter atau psikolog dan terapi perilaku.
                            @else
                                Anak tidak menunjukkan tanda permasalahan mental emosional yang signifikan.
                            @endif
                        @elseif ($jenis === 'Autisme')
                            Dari 23 indikator, terdapat {{ $jumlahJawabanTidakAutis }} jawaban "TIDAK".
                            @if ($jumlahJawabanTidakAutis >= 2)
                                dimana ketentuannya jika terdapat 2 atau lebih jawaban “TIDAK” pada indikator
                                penentuan,Maka anak berisiko tinggi mengalami hambatan dalam komunikasi dan
                                keterlambatan berbicara. Disarankan untuk mendapatkan penanganan dari dokter atau
                                psikolog serta terapi perilaku.
                            @else
                                Anak tidak menunjukkan tanda hambatan komunikasi atau keterlambatan berbicara yang
                                signifikan.
                            @endif
                        @elseif ($jenis === 'GPPH')
                            Total nilai yang diperoleh dari 10 indikator pengukuran adalah {{ $totalNilaiGpph }}.
                            @if ($totalNilaiGpph >= 13)
                                Dimana ketentuannya jika total nilai 13 atau lebih Maka kemungkinan anak mengalami
                                kesulitan dalam pemusatan perhatian dan hiperaktifitas. Disarankan untuk evaluasi lebih
                                lanjut ke dokter atau psikolog serta terapi perilaku.
                            @else
                                Anak tidak menunjukkan kesulitan signifikan dalam pemusatan perhatian dan
                                hiperaktifitas.
                            @endif
                        @else
                            hasil belum dibuat
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <!-- Footer -->
    <div class="footer">
        <div>Dicetak pada: {{ date('d F Y') }}</div>
    </div>
</body>

</html>
