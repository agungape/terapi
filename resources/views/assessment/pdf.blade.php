<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Assessment - {{ $assessment->anak->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .logo {
            width: 80px;
        }

        .kop-border {
            border-top: 3px double black;
            margin-bottom: 15px;
        }

        .card {
            border-radius: 5px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            border-radius: 5px 5px 0 0 !important;
            background-color: #2c7be5;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
        }

        .bg-primary {
            background-color: #b5c0cab7;
            color: rgb(10, 10, 10);
            font-weight: bold;
            /* text-align: center; */
            font-size: 12px;
            border: 1;
        }

        .bullet-icon {
            font-size: 1.2rem;
            color: #2c7be5;
            line-height: 1.4;
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
            font-size: 14px;
        }

        .section-content {
            border: 1px solid #e3ebf6;
            border-top: none;
            padding: 15px;
            border-radius: 0 0 6px 6px;
            background-color: #fff;
        }

        .result-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .result-table th,
        .result-table td {
            border: 1px solid #e3ebf6;
            padding: 10px;
            font-size: 12px;
        }

        .result-table th {
            background-color: #f0f5ff;
            font-weight: bold;
        }

        .bullet-list {
            list-style-type: none;
            padding-left: 0;
            margin-bottom: 15px;
        }

        .bullet-list li {
            position: relative;
            padding-left: 25px;
            margin-bottom: 8px;
        }

        .bullet-list li:before {
            content: "•";
            position: absolute;
            left: 10px;
            font-weight: bold;
            color: #2c7be5;
            font-size: 16px;
        }

        .signature-area {
            margin-top: 50px;
            text-align: center;
        }

        .signature-line {
            width: 300px;
            border-top: 1px solid black;
            margin: 0 auto;
            margin-top: 60px;
        }

        .info-box {
            margin-bottom: 20px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }

        .table-borderless {
            width: 100%;
            border-collapse: collapse;
        }

        .table-borderless td {
            padding: 5px 0;
            vertical-align: top;
        }

        .section-container {
            margin-bottom: 20px;
        }

        .bullet-point {
            font-size: 17px;
            color: #07080a;
            font-weight: bold;
        }

        .bullet-point-second {
            font-size: 17px;
            color: #1b51bd;
            font-weight: bold;
        }

        .text-decoration-underline {
            text-decoration: underline;
        }

        /* Tambahan class baru */
        .text-bold {
            font-weight: bold;
        }

        .mt-3 {
            margin-top: 1rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .p-2 {
            padding: 0.5rem !important;
        }

        .me-2 {
            margin-right: 0.5rem !important;
        }

        .px-4 {
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
        }

        .py-3 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }

        .text-center {
            text-align: center !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-2 {
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }

        .col-10 {
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
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
        <h6 class="text-decoration-underline" style="font-weight: bold">HASIL PEMERIKSAAN PSIKOLOGIS</h6>
    </div>

    <!-- Data Anak -->
    <div class="info-box mb-4">
        <table class="table table-borderless">
            <tr>
                <td width="20%"><strong>Nama Anak</strong></td>
                <td width="40%">: {{ $assessment->anak->nama }}</td>
                <td width="20%"><strong>Tanggal Lahir</strong></td>
                <td width="20%">:
                    {{ \Carbon\Carbon::parse($assessment->anak->tanggal_lahir)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal Pemeriksaan</strong></td>
                <td>: {{ \Carbon\Carbon::parse($assessment->tanggal_assessment)->translatedFormat('d F Y') }}</td>
                <td><strong>Usia</strong></td>
                <td>:
                    {{ \Carbon\Carbon::parse($assessment->anak->tanggal_lahir)->diffInYears($assessment->tanggal_assessment) }}
                    tahun</td>
            </tr>
        </table>
    </div>

    <!-- A. TUJUAN PEMERIKSAAN PSIKOLOGIS -->
    <div class="section-container mb-2">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <td width="5%" class="bg-primary p-2 text-center" style="border-right: 0">A.</td>
                    <td colspan="3" class="bg-primary p-2" style="border-left: 0">TUJUAN PEMERIKSAAN PSIKOLOGIS</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="5%"></td>
                    <td width="3%"> <span class="bullet-point">•</span></td>
                    <td colspan="2">{{ $assessment->tujuan_pemeriksaan }}</td>
                </tr>
            </tbody>
        </table>

        <table class="table table-borderless">
            <thead>
                <tr>
                    <td width="5%" class="bg-primary p-2 text-center" style="border-right: 0">B.</td>
                    <td colspan="3" class="bg-primary p-2" style="border-left: 0">OBSERVASI AWAL ANAK</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($observasi_awal as $item)
                    <tr>
                        <td width="5%"></td>
                        <td width="3%"><span class="bullet-point">•</span></td>
                        <td colspan="2">
                            {{ $item }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <td width="5%" class="bg-primary p-2 text-center" style="border-right: 0">C.</td>
                    <td colspan="3" class="bg-primary p-2" style="border-left: 0">SUMBER ASESMEN</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($sumber_asesmen as $item)
                    <tr>
                        <td width="5%"></td>
                        <td width="3%"><span class="bullet-point">•</span></td>
                        <td colspan="2">
                            {{ $item }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <td width="5%" class="bg-primary p-2 text-center" style="border-right: 0">D.</td>
                    <td colspan="3" class="bg-primary p-2" style="border-left: 0">HASIL PEMERIKSAAN</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil_pemeriksaan as $item)
                    <tr>
                        <td width="5%"></td>
                        <td width="3%"><span class="bullet-point">•</span></td>
                        <td colspan="2">
                            {{ $item }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <td width="5%" class="bg-primary p-2 text-center" style="border-right: 0">E.</td>
                    <td colspan="3" class="bg-primary p-2" style="border-left: 0">SARAN</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="5%"></td>
                    <td width="3%"> <span class="bullet-point">•</span></td>
                    <td colspan="2">Bagi Orang Tua</td>
                </tr>
                @foreach ($rekomendasi_orangtua as $item)
                    <tr>
                        <td width="5%"></td>
                        <td width="3%"></td>
                        <td width="3%"><span class="bullet-point-second">•</span></td>
                        <td>
                            {{ $item }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td width="5%"></td>
                    <td width="3%"> <span class="bullet-point">•</span></td>
                    <td colspan="2">Bagi Terapis</td>
                </tr>
                @foreach ($rekomendasi_terapi as $item)
                    <tr>
                        <td width="5%"></td>
                        <td width="3%"></td>
                        <td width="3%"><span class="bullet-point-second">•</span></td>
                        <td>
                            {{ $item }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tanda Tangan -->
    <div class="row mt-5">
        <table class="table table-borderless">
            <tr>
                <td width="60%"></td> <!-- Empty space on the left -->
                <td width="40%">
                    <div style="float: right; text-align: center; width: 100%;">
                        <p style="margin-bottom: 5px;">Unaaha,
                            {{ \Carbon\Carbon::parse($assessment->tanggal_assessment)->translatedFormat('d F Y') }}</p>
                        <p style="margin-bottom: 5px;">Psikolog,</p> <br>
                        <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode"
                            style="margin-bottom: 10px">
                        <p style="font-weight: bold; margin-bottom: 5px; border-bottom: 1px solid #000;">Astri Yunita,
                            S.Psi.,M.Psi.,Psikolog
                        </p>
                        <p style="margin-bottom: 5px;">STR. XP00001068698759</p>
                        <p style="margin-bottom: 0;">SIPP. 20130221-2023-03-0807</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>


</body>

</html>
