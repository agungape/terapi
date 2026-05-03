<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Assessment - {{ $assessment->anak->nama }}</title>
    <style>
        /* Modern CSS for DomPDF - Consistent with Observasi */
        @page {
            margin: 1.5cm 1.5cm 2.5cm 1.5cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            color: #1f2937;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        /* Fixed Footer */
        footer {
            position: fixed;
            bottom: -1.5cm;
            left: 0px;
            right: 0px;
            height: 15px;
            width: 100%;
        }

        /* Kop Surat & Layout */
        .logo-img { width: 70px; height: auto; }
        .logo-lg { width: 85px; height: auto; }

    <style>
        /* Modern CSS for DomPDF - Consistent with Observasi */
        @page {
            margin: 1.5cm 1.5cm 2.5cm 1.5cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            color: #1f2937;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        /* Fixed Footer */
        footer {
            position: fixed;
            bottom: -1.5cm;
            left: 0px;
            right: 0px;
            height: 15px;
            width: 100%;
        }

        /* Kop Surat & Layout */
        .logo-img { width: 70px; height: auto; }
        .logo-lg { width: 85px; height: auto; }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #1a1a2e;
            padding-bottom: 10px;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .kop-title { font-size: 16pt; font-weight: 800; color: #1a1a2e; text-transform: uppercase; margin: 0; padding: 0; line-height: 1; }
        .kop-tagline { font-size: 9.5pt; font-weight: 600; color: #0d7377; margin: 0; padding: 0; line-height: 1.2; }
        .kop-address { font-size: 7.5pt; color: #4b5563; line-height: 1.3; margin-top: 3px; }

        .doc-title {
            text-align: center;
            font-size: 12pt;
            font-weight: bold;
            color: #111827;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 8px;
        }

        /* Cards */
        .info-card {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 15px;
        }

        .info-title {
            font-size: 8pt;
            font-weight: bold;
            color: #0d7377;
            text-transform: uppercase;
            margin-bottom: 8px;
            border-left: 3px solid #0d7377;
            padding-left: 8px;
        }

        .info-table { width: 100%; border-collapse: collapse; }
        .info-table td { padding: 3px 0; font-size: 9.5pt; vertical-align: top; }
        .label { color: #6b7280; width: 120px; }
        .value { font-weight: 600; color: #111827; }

        .section-title {
            font-size: 9.5pt;
            font-weight: bold;
            color: #111827;
            margin: 15px 0 8px 0;
            text-transform: uppercase;
            background-color: #f3f4f6;
            padding: 6px 10px;
            border-radius: 4px;
        }

        /* Tables */
        .result-table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        .result-table th { background-color: #1a1a2e; color: white; text-align: left; padding: 6px 10px; font-size: 8pt; }
        .result-table td { padding: 7px 10px; border: 1px solid #e5e7eb; font-size: 9pt; vertical-align: top; }

        .confidential-box {
            border: 1px solid #dc2626;
            color: #dc2626;
            padding: 4px 10px;
            font-size: 8pt;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 10px;
            background-color: #fef2f2;
        }

        header {
            position: fixed;
            top: -1.0cm;
            left: 0px;
            right: 0px;
            height: 25px;
            width: 100%;
            text-align: right;
        }

        .content-box {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-left: 4px solid #0d7377;
            padding: 12px 15px;
            margin-bottom: 10px;
            font-size: 9.5pt;
            color: #374151;
            text-align: justify;
        }

        .bullet-item {
            margin-bottom: 5px;
            position: relative;
            padding-left: 15px;
        }
        .bullet-item::before {
            content: "•";
            position: absolute;
            left: 0;
            color: #0d7377;
            font-weight: bold;
        }

        .sub-section-title {
            font-weight: bold;
            color: #0d7377;
            font-size: 9pt;
            margin: 10px 0 5px 0;
            text-decoration: underline;
        }

        .sig-block { text-align: center; width: 250px; float: right; margin-top: 20px; }
        .sig-name { font-weight: bold; text-decoration: underline; font-size: 10pt; }
        .sig-meta { font-size: 8pt; color: #4b5563; margin-top: 2px; }

        .page-break { page-break-before: always; }
        .clearfix::after { content: ""; clear: both; display: table; }
    </style>
</head>

<body>
    <header>
        <div class="confidential-box">RAHASIA</div>
    </header>

    <footer>
        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
            <tr>
                <td width="85%" height="10" style="background-color: #0d7377;"></td>
                <td width="15%" height="10" style="background-color: #f59e0b;"></td>
            </tr>
        </table>
    </footer>

    <!-- KOP SURAT -->
    <table class="header-table">
        <tr>
            <td width="80" align="left" valign="middle">
                <img src="{{ $logo }}" class="logo-img">
            </td>
            <td align="center" valign="middle">
                <h1 class="kop-title">Bright Star of Child</h1>
                <p class="kop-tagline">Pusat Layanan Terapi Anak Spesial</p>
                <p class="kop-address">
                    Jl. Mokodompit, Kel. Inolobu, Kec. Wawotobi, Kab. Konawe, Prov. Sulawesi Tenggara 93462<br>
                    Telp: 085123238404 | Web: brightchild.id | Email: brightstarofchild12@gmail.com
                </p>
            </td>
            <td width="100" align="right" valign="middle">
                <img src="{{ $logo_pji }}" class="logo-lg">
            </td>
        </tr>
    </table>

    <div class="doc-title">Hasil Pemeriksaan Psikologis</div>

    <!-- IDENTITAS -->
    <div class="info-card">
        <div class="info-title">Identitas Anak & Pemeriksa</div>
        <table class="info-table">
            <tr>
                <td class="label">Nama Anak</td>
                <td width="10">:</td>
                <td class="value">{{ ucwords(strtolower($assessment->anak->nama)) }}</td>
                <td class="label">No. Rekam Medis</td>
                <td width="10">:</td>
                <td class="value" style="color:#0d7377;">{{ $assessment->anak->nomor_induk_baru ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Lahir</td>
                <td>:</td>
                <td class="value">{{ \Carbon\Carbon::parse($assessment->anak->tanggal_lahir)->format('d-m-Y') }}</td>
                <td class="label">Tgl. Pemeriksaan</td>
                <td>:</td>
                <td class="value">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Usia</td>
                <td>:</td>
                <td class="value">{{ \Carbon\Carbon::parse($assessment->anak->tanggal_lahir)->diffInYears($tanggal) }} Tahun</td>
                <td class="label">Psikolog</td>
                <td>:</td>
                <td class="value">{{ $assessment->psikolog->nama ?? 'Astri Yunita, S.Psi.,M.Psi.,Psikolog' }}</td>
            </tr>
            <tr>
                <td class="label">Keluhan Utama</td>
                <td>:</td>
                <td colspan="4" class="value">{{ $assessment->keluhan_utama ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <!-- A. TUJUAN -->
    <div class="section-title">A. Tujuan Pemeriksaan Psikologis</div>
    <div class="content-box">
        {{ $assessment->tujuan_pemeriksaan }}
    </div>

    <!-- B. STATUS KLINIS -->
    <div class="section-title">B. Status Klinis & Observasi Awal</div>
    <table class="result-table">
        <tr>
            <th width="33%">Mood Anak</th>
            <th width="33%">Validitas Hasil</th>
            <th width="33%">Catatan Rapport</th>
        </tr>
        <tr>
            <td>{{ $assessment->mood_anak ?? '-' }}</td>
            <td>{{ $assessment->validitas_hasil ?? '-' }}</td>
            <td>{{ $assessment->catatan_rapport ?? '-' }}</td>
        </tr>
        <tr>
            <th>Kontak Mata</th>
            <th>Komunikasi</th>
            <th>Interaksi Sosial</th>
        </tr>
        <tr>
            <td>{{ $assessment->kontak_mata ?? '-' }}</td>
            <td>{{ $assessment->komunikasi ?? '-' }}</td>
            <td>{{ $assessment->interaksi_sosial ?? '-' }}</td>
        </tr>
    </table>

    <!-- C. HASIL OBSERVASI PERILAKU -->
    <div class="section-title">C. Hasil Observasi Perilaku</div>
    <div class="content-box">
        @foreach ($observasi_awal as $item)
            <div class="bullet-item">{{ $item }}</div>
        @endforeach
        <div style="margin-top: 10px; padding-top: 8px; border-top: 1px dashed #e5e7eb;">
            <strong>Kesimpulan Observasi:</strong><br>
            <span style="font-style: italic; color: #111827;">{{ $assessment->kesimpulan_observasi }}</span>
        </div>
    </div>

    <!-- D. SUMBER ASESMEN -->
    <div class="section-title">D. Sumber Asesmen</div>
    <div class="content-box">
        @foreach ($sumber_asesmen as $item)
            <div class="bullet-item">{{ $item }}</div>
        @endforeach
    </div>

    <!-- E. HASIL PEMERIKSAAN -->
    <div class="section-title">E. Hasil Pemeriksaan</div>
    <div class="content-box">
        @foreach ($hasil_pemeriksaan as $item)
            <div class="bullet-item">{{ $item }}</div>
        @endforeach
        <div style="margin-top: 10px; padding-top: 8px; border-top: 1px dashed #e5e7eb;">
            <strong>Diagnosa:</strong><br>
            <span style="font-style: italic; color: #b91c1c; font-weight: bold;">{{ $assessment->diagnosa }}</span>
            @if($assessment->diagnosa_banding)
                <br><small style="color: #6b7280;">Diagnosa Banding: {{ $assessment->diagnosa_banding }}</small>
            @endif
        </div>
    </div>

    <!-- F. SARAN & REKOMENDASI -->
    <div class="section-title">F. Saran & Rekomendasi</div>
    <div class="content-box">
        <div class="sub-section-title">Bagi Orang Tua / Pengasuh:</div>
        @foreach ($rekomendasi_orangtua as $item)
            <div class="bullet-item">{{ $item }}</div>
        @endforeach

        <div class="sub-section-title" style="margin-top: 15px;">Bagi Terapis / Sekolah:</div>
        @foreach ($rekomendasi_terapi as $item)
            <div class="bullet-item">{{ $item }}</div>
        @endforeach
    </div>

    <p style="margin-top: 15px; font-size: 9pt; font-style: italic; color: #6b7280;">
        Demikian laporan hasil pemeriksaan psikologis ini dibuat untuk dapat dipergunakan sebagaimana mestinya. Segala informasi dalam laporan ini bersifat rahasia.
    </p>

    <!-- SIGNATURE -->
    <div class="clearfix">
        <div class="sig-block">
            <p>Unaaha, {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</p>
            <p style="font-weight:bold; margin: 2px 0;">Psikolog,</p>
            <div style="margin: 10px 0;">
                <img src="data:image/png;base64,{{ $barcode }}" width="80" height="80">
            </div>
            <p class="sig-name">{{ $assessment->psikolog->nama ?? 'Astri Yunita, S.Psi.,M.Psi.,Psikolog' }}</p>
            @if($assessment->psikolog)
                <div class="sig-meta">
                    STR. {{ $assessment->psikolog->str ?? '-' }}<br>
                    SIPP. {{ $assessment->psikolog->sipp ?? '-' }}
                </div>
            @else
                <div class="sig-meta">
                    STR. XP00001068698759<br>
                    SIPP. 20130221-2023-03-0807
                </div>
            @endif
        </div>
    </div>

</body>

</html>
