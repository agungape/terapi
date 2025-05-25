<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Kesehatan Jiwa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        .logo {
            width: 80px;
        }

        .kop-border {
            border-top: 3px double black;
            margin-bottom: 15px;
        }

        .qr {
            width: 120px;
        }

        .section-title {
            background-color: #2c7be5;
            color: white;
            padding: 8px 15px;
            font-weight: bold;
            border-radius: 6px 6px 0 0;
            margin-bottom: 0;
        }

        .section-content {
            border: 1px solid #e3ebf6;
            border-top: none;
            padding: 15px;
            border-radius: 0 0 6px 6px;
        }

        .result-table {
            width: 100%;
            border-collapse: collapse;
        }

        .result-table th,
        .result-table td {
            border: 1px solid #e3ebf6;
            padding: 10px;
        }

        .result-table th {
            background-color: #f0f5ff;
        }
    </style>
</head>

<body class="px-4 py-3">

    <!-- Kop Surat -->
    <div class="text-center">
        <div class="row align-items-center mb-2">
            <table border="0">
                <tr class="text-center">
                    <td>
                        <div class="col-2">
                            <img src="{{ public_path('assets/images/logo_bright_star.jpg') }}" alt="Logo"
                                class="logo">
                        </div>
                    </td>
                    <td>
                        <div class="col-10">
                            <h5 class="mb-0 fw-bold">BRIGHT STAR OF CHILD </h5>
                            <h5 class="mb-0 fw-bold">Pusat Layanan Terapi Anak Istimewa
                            </h5>
                            <p class="mb-0" style="font-size: 10pt;">
                                Jln. Mokodompit, Kel.Inolobu, Kec.Wawotobi, Kab.Konawe, Prov.Sulawesi
                                Tenggara 93462<br>Telp 085123238404 | Website : https://brightchild.id | Email :
                                brightstarofchild12@gmail.com

                            </p>
                        </div>
                    </td>
                </tr>
            </table>


        </div>
        <div class="kop-border"></div>
        <h6 class="fw-bold text-decoration-underline">LAPORAN OBSERVASI</h6>
    </div>

    <!-- ISI SESUAI PERMINTAAN -->
    <div class="info-box mb-4">
        <table class="table table-borderless">
            <tr>
                <td width="20%"><strong>Nama Anak</strong></td>
                <td width="30%">: {{ $anak->nama }}</td>
                <td width="20%"><strong>Tanggal Lahir</strong></td>
                <td width="30%">: {{ $anak->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Observasi</strong></td>
                <td>: {{ date('d/m/Y', strtotime($tanggal)) }}</td>
                <td><strong>Usia Saat Observasi</strong></td>
                <td>: {{ $anak->usia }} tahun</td>
            </tr>
        </table>
    </div>

    <div class="section mb-4">
        <div class="section-title">HASIL OBSERVASI</div>
        <div class="section-content">
            <table class="result-table">
                <thead>
                    <tr>
                        <th width="40%">Jenis Pemeriksaan</th>
                        <th width="60%">Hasil</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hasil as $jenis => $items)
                        @if ($jenis == 'Penyimpangan Perilaku')
                            <tr>
                                <td> {{ $penyimpangan_perilaku }}</td>
                                <td>
                                    @if ($jumlahJawabanYaPerilaku >= 2)
                                        Dari 14 indikator dimana terdapat {{ $jumlahJawabanYaPerilaku }} jawaban "YA",
                                        dimana
                                        ketentuannya
                                        jika terdapat 2 atau lebih jawaban "YA" pada indikator penentuan, maka
                                        terdapat kemungkinan anak mengalami permasalahan mental emosional
                                        yang berikutnya dapat di rujuk untuk konsultasi lebih lanjut ke dokter
                                        atau psikolog dan terapi perilaku.
                                    @else
                                        Dari 14 indikator dimana terdapat {{ $jumlahJawabanYaPerilaku }} jawaban "YA".
                                        Maka
                                        tidak
                                        terdeteksi masalah mental emosional pada anak
                                    @endif
                                </td>
                            </tr>
                        @elseif ($jenis == 'Autisme')
                            <tr>
                                <td>{{ $autis }}</td>

                                <td>
                                    @if ($jumlahJawabanTidakAutis >= 2)
                                        Dari 23 indikator dimana terdapat {{ $jumlahJawabanTidakAutis }} jawaban
                                        "TIDAK",
                                        dimana
                                        ketentuannya jika terdapat 2 atau lebih jawaban "TIDAK" pada indikator
                                        penentuan, maka <strong>beresiko tinggi</strong> anak mengalami hambatan dalam
                                        komunikasi dan keterlambatan dalam berbicara yang berikutnya dapat di
                                        rujuk untuk mendapatkan penanganan dokter atau psikolog dan terapi
                                        perilaku.
                                    @else
                                        Dari 23 indikator dimana terdapat {{ $jumlahJawabanTidakAutis }} jawaban
                                        "TIDAK".
                                        Maka
                                        <strong> tidak terdeteksi</strong> anak mengalami hambatan dalam
                                        komunikasi dan keterlambatan dalam berbicara
                                    @endif
                                </td>
                            </tr>
                        @elseif ($jenis == 'GPPH')
                            <tr>
                                <td>{{ $gpph }}</td>
                                <td>
                                    @if ($totalNilaiGpph >= 13)
                                        Total nilai yang diperoleh dari 10 indikator pengukuran yakni berjumlah
                                        {{ $totalNilaiGpph }} . Dimana ketentuannya jika total nilai 13 atau lebih maka
                                        kemungkinan
                                        anak mengalami kesulitan dalam pemusatan perhatian dan hiperaktifitas.
                                    @else
                                        Total nilai yang diperoleh dari 10 indikator pengukuran yakni berjumlah
                                        {{ $totalNilaiGpph }} . Maka
                                        <strong> tidak terdeteksi</strong> anak mengalami kesulitan dalam pemusatan
                                        perhatian dan
                                        hiperaktifitas.
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="section mb-4">
        <div class="section-title">HASIL OBSERVASI PERILAKU</div>
        <div class="section-content">
            @if (!empty($hpperilaku))
                {!! $hpperilaku->deskripsi !!}
            @else
                <div class="text-muted text-center py-3">
                    <i class="fas fa-info-circle"></i> Tidak ada data observasi perilaku yang tercatat
                </div>
            @endif
        </div>
    </div>

    <div class="section mb-5">
        <div class="section-title">HASIL OBSERVASI SENSORIK</div>
        <div class="section-content">
            @if (!empty($hpsensorik))
                {!! $hpsensorik->deskripsi !!}
            @else
                <div class="text-muted text-center py-3">
                    <i class="fas fa-info-circle"></i> Tidak ada data observasi sensorik yang tercatat
                </div>
            @endif
        </div>
    </div>

    <!-- Tanda Tangan dan QR Code -->
    <div class="row mt-5">
        <div class="col-6"></div>
        <div class="col-6 text-center">
            <p>Unaaha, {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}<br>
                Terapis</p>

            {{-- QR code --}}
            <img src="data:image/png;base64, {!! base64_encode(
                QrCode::format('png')->size(150)->generate(route('laporan.ttd', ['id' => $anak->id])),
            ) !!} " alt="QR Code" class="qr my-2"><br>

            <p class="fw-bold mb-0">INNE PUSVITASARI. S.Psi.</p>
        </div>
    </div>
</body>

</html>
