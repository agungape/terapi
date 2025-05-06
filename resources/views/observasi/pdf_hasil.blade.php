{{-- <!DOCTYPE html>
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

</html> --}}


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Observasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            font-size: 12pt;
        }

        .kop {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .kop img {
            width: 90px;
            height: 90px;
            margin-right: 20px;
        }

        .kop-text {
            text-align: center;
            flex-grow: 1;
        }

        .kop-text h1 {
            font-size: 16pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .kop-text h2 {
            font-size: 14pt;
            margin: 5px 0;
        }

        .kop-text p {
            font-size: 10pt;
            margin: 2px 0;
        }

        hr {
            border: 1px solid black;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .judul-laporan {
            font-weight: bold;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            vertical-align: top;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .section-title {
            margin-top: 20px;
            font-weight: bold;
            font-size: 14pt;
        }

        ol {
            margin-top: 10px;
        }

        .footer {
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <div class="kop">
        <img src="{{ public_path('logo.png') }}" alt="Logo">
        <div class="kop-text">
            <h1>BRIGHT STAR OF CHILD</h1>
            <h2>Pusat Layanan Terapi Anak Istimewa</h2>
            <p>Jl. Mokodompit, Kel. Inolobuno, Kec. Wawotobi, Kab. Konawe, Prov. Sulawesi Tenggara 93462</p>
            <p>Contact: 082191084139</p>
            <p>Email: <a href="mailto:brightstarofchild12@gmail.com">brightstarofchild12@gmail.com</a></p>
        </div>
    </div>

    <hr>

    <div class="content">
        <!-- Judul Umum -->
        <div class="judul-laporan">LAPORAN HASIL OBSERVASI</div>
        <div class="judul-laporan">{{ $anak->nama }}</div>

        <!-- Tabel Hasil Observasi -->
        <table border="1">
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
                                    Ketentuan menunjukkan kemungkinan masalah emosional, rujuk konsultasi lebih lanjut.
                                @else
                                    Tidak ada indikasi masalah emosional signifikan.
                                @endif
                            @elseif ($jenis === 'Autisme')
                                Dari 23 indikator, terdapat {{ $jumlahJawabanTidakAutis }} jawaban "TIDAK".
                                @if ($jumlahJawabanTidakAutis >= 2)
                                    Berisiko hambatan komunikasi dan bicara, disarankan konsultasi lanjut.
                                @else
                                    Tidak ada indikasi hambatan komunikasi.
                                @endif
                            @elseif ($jenis === 'GPPH')
                                Total nilai: {{ $totalNilaiGpph }}.
                                @if ($totalNilaiGpph >= 13)
                                    Kemungkinan mengalami kesulitan fokus dan hiperaktifitas.
                                @else
                                    Tidak ada kesulitan fokus/hiperaktifitas signifikan.
                                @endif
                            @else
                                hasil belum dibuat
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Hasil Observasi Perilaku -->
        <div class="section-title">HASIL OBSERVASI PERILAKU</div>
        <ol>
            {{-- @foreach ($perilaku as $item)
                <li>{{ $item }}</li>
            @endforeach --}}
        </ol>

        <!-- Hasil Observasi Sensorik -->
        <div class="section-title">HASIL OBSERVASI SENSORIK</div>

        <p><b>Observasi Profil Sensory</b></p>
        {{-- <p>{{ $deskripsi_sensorik }}</p> --}}

        <p><b>Gangguan Sensory yang Bermasalah :</b></p>
        <ol>
            {{-- @foreach ($sensorik_gangguan as $item)
                <li>{{ $item }}</li>
            @endforeach --}}
        </ol>

        <p><b>Rencana Terapi Sensory Integrasi :</b></p>
        <ol>
            {{-- @foreach ($rencana_terapi as $item)
                <li>{{ $item }}</li>
            @endforeach --}}
        </ol>

    </div>

    <!-- Footer -->
    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y') }}
    </div>

</body>

</html>
