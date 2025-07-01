<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Observasi_{{ $anak->nama }}</title>
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
            text-align: center;
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
        <div class="row align-items-center">
            <table border="0">
                <tr>
                    <td>
                        <div class="col-2">
                            <img src="{{ public_path('assets/images/logo_bright_star.jpg') }}" alt="Logo"
                                class="logo">
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="col-10">
                            <h5 style="font-weight: bold; margin: 0;">BRIGHT STAR OF CHILD</h5>
                            <h5 style="font-weight: bold; margin: 0;">Pusat Layanan Terapi Anak Spesial
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
        <h6 class="text-decoration-underline" style="font-weight: bold">LAPORAN OBSERVASI</h6>
    </div>

    <!-- ISI SESUAI PERMINTAAN -->
    <div class="info-box mb-4">
        <table class="table table-borderless">
            <tr>
                <td width="20%"><strong>Nama Anak</strong></td>
                <td width="40%">: {{ $anak->nama }}</td>
                <td width="20%"><strong>Tanggal Lahir</strong></td>
                <td width="20%">: {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Observasi</strong></td>
                <td>: {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</td>
                <td><strong>Usia</strong></td>
                <td>: {{ $anak->usia }} tahun</td>
            </tr>
        </table>
    </div>

    <div class="section mb-4" style="page-break-after: always;">
        <div class="section-title">HASIL OBSERVASI</div>
        <div class="section-content">
            <table width="100%" style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 15px;">
                <thead>
                    <tr style="background-color: #8ccedf; color: #fff;">
                        <th style="padding: 10px; border: 1px solid #dee2e6;" width="40%" class="text-center">Alat
                            Observasi</th>
                        <th style="padding: 10px; border: 1px solid #dee2e6;" width="60%" class="text-center">Hasil
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hasil as $jenis => $items)
                        @if ($jenis == 'Penyimpangan Perilaku')
                            <tr>
                                <td style="padding: 10px; border: 1px solid #dee2e6; vertical-align: top;">
                                    {{ $penyimpangan_perilaku }}
                                </td>
                                <td style="padding: 10px; border: 1px solid #dee2e6;">
                                    <div style="padding: 6px; color: #333;">
                                        <b>Hasil Deteksi:</b><br>
                                        Dari 14 indikator, terdapat <b>{{ $jumlahJawabanYaPerilaku }}</b> jawaban
                                        <b>"YA"</b>.<br>
                                        @if ($jumlahJawabanYaPerilaku >= 2)
                                            Berdasarkan ketentuan, jika terdapat 2 atau lebih jawaban "YA",
                                            maka:<br><br>
                                            <b>➡ Kemungkinan anak mengalami permasalahan mental emosional</b><br>
                                            Disarankan untuk konsultasi lebih lanjut ke dokter atau psikolog dan
                                            melakukan terapi perilaku.
                                        @else
                                            <b>✅ Tidak terdeteksi</b> masalah mental emosional pada anak.
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @elseif ($jenis == 'Autisme')
                            <tr>
                                <td style="padding: 10px; border: 1px solid #dee2e6; vertical-align: top;">
                                    {{ $autis }}
                                </td>
                                <td style="padding: 10px; border: 1px solid #dee2e6;">
                                    <div style="padding: 6px; color: #333;">
                                        <b>Hasil Deteksi:</b><br>
                                        Dari 23 indikator, terdapat <b>{{ $jumlahJawabanTidakAutis }}</b> jawaban
                                        <b>"TIDAK"</b>.<br>
                                        @if ($jumlahJawabanTidakAutis >= 2)
                                            Jika terdapat 2 atau lebih jawaban "TIDAK",Pada Indikator Penentuan
                                            maka:<br><br>
                                            <b>➡ Beresiko tinggi</b> anak mengalami hambatan dalam komunikasi dan
                                            keterlambatan dalam berbicara.<br>
                                            Disarankan untuk konsultasi dengan dokter/psikolog dan melakukan
                                            terapi perilaku.
                                        @else
                                            <b>✅ Tidak terdeteksi</b> hambatan komunikasi dan keterlambatan bicara.
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @elseif ($jenis == 'GPPH')
                            <tr>
                                <td style="padding: 10px; border: 1px solid #dee2e6; vertical-align: top;">
                                    {{ $gpph }}
                                </td>
                                <td style="padding: 10px; border: 1px solid #dee2e6;">
                                    <div style="padding: 6px; color: #333;">
                                        <b>Hasil Deteksi:</b><br>
                                        Total nilai dari 10 indikator adalah <b>{{ $totalNilaiGpph }}</b>.<br>
                                        @if ($totalNilaiGpph >= 13)
                                            Jika total nilai 13 atau lebih, maka:<br><br>
                                            <b>➡ Anak kemungkinan mengalami kesulitan dalam pemusatan perhatian dan
                                                hiperaktifitas.</b>
                                        @else
                                            <b>✅ Tidak terdeteksi</b> kesulitan dalam pemusatan perhatian dan
                                            hiperaktifitas.
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @elseif ($jenis == 'ATEC')
                            <tr>
                                <td style="padding: 10px; border: 1px solid #dee2e6; vertical-align: top;">
                                    Autism Treatment Evaluation Checklist (ATEC)
                                </td>
                                <td style="padding: 10px; border: 1px solid #dee2e6;">
                                    <img src="{{ asset('storage/atec/' . $atec->hasil) }}"
                                        style="width: 61%; height: auto; max-height: 400px; object-fit: scale-down; border-radius: 6px;"
                                        alt="Hasil ATEC">
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>

    {{-- @if (!empty($wawancara))
        <div class="section mb-4">
            <div class="section-title">HASIL WAWANCARA</div>
            <div class="section-content">
                <table width="100%"
                    style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 15px;">
                    <thead>
                        <tr style="background-color: #8ccedf; color: #fff;">
                            <th style="padding: 10px; border: 1px solid #dee2e6;" width="40%" class="text-center">
                                Pertanyaan</th>
                            <th style="padding: 10px; border: 1px solid #dee2e6;" width="60%" class="text-center">
                                jawaban
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wawancara as $w)
                            <tr>
                                <td style="padding: 10px; border: 1px solid #dee2e6; vertical-align: top;">
                                    {{ $w->question_wawancara->question_text }}
                                </td>
                                <td style="padding: 10px; border: 1px solid #dee2e6;">
                                    {{ $w->answer }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    @endif --}}

    @if (!empty($hpperilaku))
        <div class="section mb-4" style="page-break-after: always;">
            <div class="section-title">HASIL OBSERVASI PERILAKU</div>
            <div class="section-content">

                {!! $hpperilaku->deskripsi !!}
            </div>
        </div>
    @endif

    @if (!empty($hpsensorik))
        <div class="section mb-4">
            <div class="section-title">HASIL OBSERVASI SENSORIK</div>
            <div class="section-content">
                {!! $hpsensorik->deskripsi !!}

            </div>
        </div>
    @endif

    <!-- Tanda Tangan dan QR Code -->
    <div class="row mt-5">
        <div class="col-6"></div>
        <div class="col-6 text-center" style="page-break-inside: avoid;">
            <p>Unaaha, {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}<br>
                Terapis</p>

            {{-- QR code --}}
            <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode" class="barcode"><br><br>

            <p style="font-weight: bold; margin: 0;">Inne Pusvitasari, S.Psi.</p>
        </div>
    </div>
</body>

</html>
