<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Observasi Klinis - Bright Star of Child</title>
    <style>
        /* Modern CSS for DomPDF - Optimized to prevent infinite loops */
        @page {
            margin: 1.5cm 1.5cm 2.5cm 1.5cm; /* Large bottom margin */
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            color: #1f2937;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        /* Fixed Footer - TABLE BASED (Most stable for DomPDF) */
        footer {
            position: fixed;
            bottom: -1.5cm;
            left: 0px;
            right: 0px;
            height: 15px;
            width: 100%;
        }

        /* Kop Surat & Layout */
        .logo-img {
            width: 70px;
            height: auto;
        }

        .logo-lg {
            width: 85px;
            height: auto;
        }

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
            font-size: 10pt;
            font-weight: bold;
            color: #111827;
            margin: 15px 0 8px 0;
            text-transform: uppercase;
            background-color: #f3f4f6;
            padding: 5px 10px;
            border-radius: 4px;
        }

        /* Results Table */
        .result-table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        .result-table th { background-color: #1a1a2e; color: white; text-align: left; padding: 6px 10px; font-size: 8.5pt; }
        .result-table td { padding: 7px 10px; border-bottom: 1px solid #e5e7eb; font-size: 9pt; vertical-align: top; }
        .result-table tr:nth-child(even) { background-color: #fdfdfd; }

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

        .badge { padding: 2px 8px; border-radius: 10px; font-size: 7.5pt; font-weight: bold; display: inline-block; }
        .badge-normal { background-color: #d1fae5; color: #065f46; }
        .badge-abnormal { background-color: #fee2e2; color: #991b1b; }
        .badge-warning { background-color: #fef3c7; color: #92400e; }

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

        .sig-block { text-align: center; width: 220px; float: right; margin-top: 20px; }
        .sig-name { font-weight: bold; text-decoration: underline; font-size: 10pt; }

        .footnote { font-size: 8pt; color: #9ca3af; font-style: italic; }

        /* Utilities */
        .page-break { page-break-before: always; }
        .clearfix::after { content: ""; clear: both; display: table; }
    </style>
</head>
<body>
    <header>
        <div class="confidential-box">RAHASIA</div>
    </header>

    <!-- STABLE FOOTER (TABLE BASED) -->
    <footer>
        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
            <tr>
                <td width="85%" height="10" style="background-color: #0d7377;"></td>
                <td width="15%" height="10" style="background-color: #f59e0b;"></td>
            </tr>
        </table>
    </footer>

    <!-- KOP SURAT (LOGO KIRI & KANAN) -->
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

    <div class="doc-title">Laporan Hasil Observasi</div>

    <!-- IDENTITAS -->
    <div class="info-card">
        <div class="info-title">Identitas Anak</div>
        <table class="info-table">
            <tr>
                <td class="label">Nama Anak</td>
                <td width="10">:</td>
                <td class="value">{{ ucwords(strtolower($anak->nama)) }}</td>
                <td class="label">No. Rekam Medis</td>
                <td width="10">:</td>
                <td class="value" style="color:#0d7377;">{{ $anak->nomor_induk_baru ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Lahir</td>
                <td>:</td>
                <td class="value">{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }}</td>
                <td class="label">Tgl. Pemeriksaan</td>
                <td>:</td>
                <td class="value">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Usia</td>
                <td>:</td>
                <td class="value">{{ $anak->usia }} Tahun</td>
                <td class="label">Pemeriksa</td>
                <td>:</td>
                <td class="value">Inne Pusvitasari, S.Psi.</td>
            </tr>
        </table>
    </div>

    <!-- I. PEMERIKSAAN OBJEKTIF -->
    <div class="section-title">I. Pemeriksaan Objektif (Kuantitatif)</div>
    <table class="result-table">
        <thead>
            <tr>
                <th>Jenis Pemeriksaan</th>
                <th width="70" align="center">Hasil</th>
                <th width="140">Nilai Rujukan</th>
                <th>Interpretasi / Rekomendasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasil as $jenis => $items)
                @if ($jenis == 'Penyimpangan Perilaku')
                    <tr>
                        <td><strong>{{ $penyimpangan_perilaku }}</strong><br><small style="color:#6b7280;">KMME</small></td>
                        <td align="center"><span style="color: {{ $jumlahJawabanYaPerilaku >= 2 ? '#dc2626' : '#059669' }}; font-weight:bold;">{{ $jumlahJawabanYaPerilaku }}{{ $jumlahJawabanYaPerilaku >= 2 ? ' *' : '' }}</span></td>
                        <td>&lt; 2 (Jawaban "YA")</td>
                        <td>
                            <span class="badge {{ $jumlahJawabanYaPerilaku >= 2 ? 'badge-abnormal' : 'badge-normal' }}">
                                {{ $jumlahJawabanYaPerilaku >= 2 ? 'Ada Masalah Mental Emosional' : 'Normal' }}
                            </span>
                        </td>
                    </tr>
                @elseif ($jenis == 'Penyimpangan Pendengaran')
                    <tr>
                        <td><strong>{{ $penyimpangan_pendengaran }}</strong><br><small style="color:#6b7280;">TDD</small></td>
                        <td align="center"><span style="color: {{ $jumlahJawabanTidakPendengaran >= 1 ? '#dc2626' : '#059669' }}; font-weight:bold;">{{ $jumlahJawabanTidakPendengaran }}{{ $jumlahJawabanTidakPendengaran >= 1 ? ' *' : '' }}</span></td>
                        <td>= 0 (Jawaban "TIDAK")</td>
                        <td>
                            <span class="badge {{ $jumlahJawabanTidakPendengaran >= 1 ? 'badge-abnormal' : 'badge-normal' }}">
                                {{ $jumlahJawabanTidakPendengaran >= 1 ? 'Curiga Gangguan Pendengaran' : 'Pendengaran Normal' }}
                            </span>
                        </td>
                    </tr>
                @elseif ($jenis == 'Penyimpangan Penglihatan')
                    @php $hasilLihat = optional($jawabanPenglihatan)->hasil; @endphp
                    <tr>
                        <td><strong>{{ $penyimpangan_penglihatan }}</strong><br><small style="color:#6b7280;">TDL — E-Chart</small></td>
                        <td align="center"><span style="color: {{ $hasilLihat == 'Curiga Gangguan Penglihatan' ? '#dc2626' : '#059669' }}; font-weight:bold;">{{ $hasilLihat == 'Curiga Gangguan Penglihatan' ? 'Gagal *' : 'Lulus' }}</span></td>
                        <td>Baris 3 (Lulus)</td>
                        <td>
                            <span class="badge {{ $hasilLihat == 'Curiga Gangguan Penglihatan' ? 'badge-warning' : 'badge-normal' }}">
                                {{ $hasilLihat == 'Curiga Gangguan Penglihatan' ? 'Curiga Gangguan Penglihatan' : 'Penglihatan Normal' }}
                            </span>
                        </td>
                    </tr>
                @elseif ($Autis ?? $jenis == 'Autisme')
                    <tr>
                        <td><strong>{{ $autis }}</strong><br><small style="color:#6b7280;">M-CHAT</small></td>
                        <td align="center"><span style="color: {{ $jumlahJawabanTidakAutis >= 2 ? '#dc2626' : '#059669' }}; font-weight:bold;">{{ $jumlahJawabanTidakAutis }}{{ $jumlahJawabanTidakAutis >= 2 ? ' *' : '' }}</span></td>
                        <td>&lt; 2 (Resiko Rendah)</td>
                        <td>
                            <span class="badge {{ $jumlahJawabanTidakAutis >= 2 ? 'badge-abnormal' : 'badge-normal' }}">
                                {{ $jumlahJawabanTidakAutis >= 2 ? 'Risiko Tinggi Autisme' : 'Risiko Rendah Autisme' }}
                            </span>
                        </td>
                    </tr>
                @elseif ($jenis == 'GPPH')
                    <tr>
                        <td><strong>{{ $gpph }}</strong><br><small style="color:#6b7280;">GPPH</small></td>
                        <td align="center"><span style="color: {{ $totalNilaiGpph >= 13 ? '#dc2626' : '#059669' }}; font-weight:bold;">{{ $totalNilaiGpph }}{{ $totalNilaiGpph >= 13 ? ' *' : '' }}</span></td>
                        <td>&lt; 13 (Normal)</td>
                        <td>
                            <span class="badge {{ $totalNilaiGpph >= 13 ? 'badge-abnormal' : 'badge-normal' }}">
                                {{ $totalNilaiGpph >= 13 ? 'Kemungkinan GPPH' : 'Normal (Bukan GPPH)' }}
                            </span>
                        </td>
                    </tr>
                @elseif ($jenis == 'ATEC Kuesioner' || $jenis == 'ATEC')
                    @php 
                        $atecSkor = optional($atec)->total_skor ?? 0; 
                        $atecInterp = optional($atec)->interpretasi ?? '-'; 
                    @endphp
                    <tr>
                        <td><strong>ATEC</strong><br><small style="color:#6b7280;">Autism Evaluation</small></td>
                        <td align="center"><span style="color: {{ $atecSkor > 50 ? '#dc2626' : '#059669' }}; font-weight:bold;">{{ $atecSkor }}{{ $atecSkor > 50 ? ' *' : '' }}</span></td>
                        <td>&lt; 50 (Hambatan Ringan)</td>
                        <td>
                            <div style="font-size:8.5pt; line-height:1.4;">
                                @if(str_contains($atecInterp, 'I.Wicara'))
                                    @php
                                        // Bersihkan string dan pecah berdasarkan koma atau titik
                                        $cleanInterp = str_replace(['. Total ATEC:', ' (Makin rendah makin baik).'], [', Total ATEC:', ''], $atecInterp);
                                        $points = explode(',', $cleanInterp);
                                    @endphp
                                    @foreach($points as $point)
                                        <div style="margin-bottom:1px;">&bull; {{ trim($point) }}</div>
                                    @endforeach
                                    <div style="font-size:7pt; color:#6b7280; margin-top:2px;">(Makin rendah makin baik)</div>
                                @else
                                    {{ $atecInterp }}
                                @endif
                            </div>
                            <div style="margin-top:5px;">
                                <span class="badge {{ $atecSkor > 50 ? 'badge-abnormal' : 'badge-normal' }}">
                                    {{ $atecSkor > 50 ? 'Saran: Intervensi Intensif' : 'Saran: Pemantauan Rutin' }}
                                </span>
                            </div>
                        </td>
                    </tr>
                @elseif ($jenis == 'KPSP' && !empty($kpsp))
                    <tr>
                        <td><strong>KPSP</strong><br><small style="color:#6b7280;">Pra Skrining</small></td>
                        <td align="center"><span style="color: {{ $kpsp->total_skor < 9 ? '#dc2626' : '#059669' }}; font-weight:bold;">{{ $kpsp->total_skor }}{{ $kpsp->total_skor < 9 ? ' *' : '' }}</span></td>
                        <td>9 - 10 (Sesuai)</td>
                        <td><span class="badge {{ $kpsp->total_skor < 9 ? 'badge-abnormal' : 'badge-normal' }}">{{ ucwords(strtolower($kpsp->interpretasi)) }}</span></td>
                    </tr>
                @elseif ($jenis == 'Anthropometri' && !empty($anthropometris))
                    @foreach ($anthropometris as $anthro)
                    <tr>
                        <td><strong>Pertumbuhan Fisik</strong><br><small style="color:#6b7280;">BB & TB</small></td>
                        <td align="center"><strong>{{ (float)$anthro->berat_badan }}kg / {{ (float)$anthro->tinggi_badan }}cm</strong></td>
                        <td>Standar WHO</td>
                        <td>
                            @php 
                                $bbStatus = $anthro->status_bb_u ?? '-';
                                $tbStatus = $anthro->status_tb_u ?? '-';
                                $isOk = (strpos(strtolower($bbStatus), 'baik') !== false) && (strpos(strtolower($tbStatus), 'normal') !== false);
                            @endphp
                            <div style="font-size:8pt; margin-bottom:2px;">BB/U: {{ $bbStatus }} | TB/U: {{ $tbStatus }}</div>
                            <span class="badge {{ $isOk ? 'badge-normal' : 'badge-warning' }}">
                                {{ $isOk ? 'Pertumbuhan Normal' : 'Perlu Konsultasi Gizi' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>
    <div class="footnote">(*) Nilai di luar rujukan normal.</div>

    <!-- PAGE BREAK -->
    <div class="page-break"></div>

    <!-- II. OBSERVASI PERILAKU -->
    @if (!empty($hpperilaku))
        <div class="section-title">II. Hasil Observasi Perilaku (Kualitatif)</div>
        <div class="content-box">
            {!! str_replace(['border-left: 4px solid #10b981;', 'border-left: 4px solid #f43f5e;'], '', $hpperilaku->deskripsi) !!}
        </div>
    @endif

    <!-- III. OBSERVASI SENSORIK -->
    @if (!empty($hpsensorik))
        <div class="section-title">III. Hasil Observasi Sensorik (Kualitatif)</div>
        <div class="content-box">
            {!! str_replace(['border-left: 4px solid #10b981;', 'border-left: 4px solid #f43f5e;'], '', $hpsensorik->deskripsi) !!}
        </div>
    @endif

    <!-- IV. HASIL WAWANCARA -->
    @if ($wawancara->isNotEmpty())
        <div class="section-title">IV. Hasil Wawancara Orang Tua / Pengasuh</div>
        <table class="result-table" style="margin-top: 5px;">
            <thead>
                <tr>
                    <th width="30">No</th>
                    <th>Pertanyaan</th>
                    <th width="80" align="center">Jawaban</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wawancara as $index => $w)
                    <tr>
                        <td align="center">{{ $index + 1 }}</td>
                        <td>{{ $w->question_wawancara->question_text ?? '-' }}</td>
                        <td align="center"><strong>{{ strtoupper($w->answer) }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <p style="margin-top: 10px; font-size: 9.5pt;">Demikian laporan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>

    <!-- SIGNATURE -->
    <div class="clearfix">
        <div class="sig-block">
            <p>Unaaha, {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</p>
            <p style="font-weight:bold; margin: 2px 0;">Terapis Penanggung Jawab,</p>
            <div style="margin: 8px 0;">
                <img src="data:image/png;base64,{{ $barcode }}" width="100" height="100">
            </div>
            <p class="sig-name">Inne Pusvitasari, S.Psi.</p>
        </div>
    </div>

</body>
</html>