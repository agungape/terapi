<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan - {{ $startDate }} s/d {{ $endDate }}</title>
    <style>
        @page {
            margin: 1.5cm 1.5cm 2.5cm 1.5cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 9pt;
            color: #1f2937;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        /* Fixed Footer (Consistent with Assessment) */
        footer {
            position: fixed;
            bottom: -1.5cm;
            left: 0px;
            right: 0px;
            height: 15px;
            width: 100%;
        }

        /* Kop Surat (Consistent with Assessment) */
        .logo-img { width: 70px; height: auto; }
        .logo-lg { width: 85px; height: auto; }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #1a1a2e;
            padding-bottom: 10px;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .kop-title { font-size: 16pt; font-weight: 800; color: #1a1a2e; text-transform: uppercase; margin: 0; padding: 0; line-height: 1; }
        .kop-tagline { font-size: 9.5pt; font-weight: 600; color: #0d7377; margin: 0; padding: 0; line-height: 1.2; }
        .kop-address { font-size: 7.5pt; color: #4b5563; line-height: 1.3; margin-top: 3px; }

        .doc-title {
            text-align: center;
            font-size: 13pt;
            font-weight: bold;
            color: #111827;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 8px;
        }

        /* Summary Info Card */
        .info-card {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
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
        .info-table td { padding: 4px 0; font-size: 9pt; vertical-align: top; }
        .label { color: #6b7280; width: 130px; }
        .value { font-weight: 600; color: #111827; }

        /* Stats Grid - Modern Dashboard Style */
        .stats-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .stat-card { padding: 15px; border: 1px solid #e2e8f0; }
        
        .stat-card-income { border-left: 5px solid #059669; background-color: #f0fdf4; }
        .stat-card-expense { border-left: 5px solid #dc2626; background-color: #fef2f2; }
        .stat-card-balance { border-left: 5px solid #1a1a2e; background-color: #f8fafc; }
        
        .stat-label { font-size: 8pt; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; display: block; }
        .stat-value { font-size: 9.5pt; font-weight: 900; color: #0f172a; }
        
        .text-success { color: #059669 !important; }
        .text-danger { color: #dc2626 !important; }

        /* Transaction Table */
        .result-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .result-table th { background-color: #1a1a2e; color: white; text-align: left; padding: 8px 10px; font-size: 8pt; text-transform: uppercase; letter-spacing: 1px; }
        .result-table td { padding: 10px; border-bottom: 1px solid #f3f4f6; font-size: 8.5pt; vertical-align: top; }
        .result-table tr:nth-child(even) { background-color: #f9fafb; }
        
        .badge {
            display: inline-block;
            padding: 2px 6px;
            font-size: 7pt;
            font-weight: bold;
            border-radius: 4px;
            text-transform: uppercase;
        }
        .bg-success { background-color: #ecfdf5; color: #059669; border: 1px solid #d1fae5; }
        .bg-danger { background-color: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; }
        .bg-slate { background-color: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; }

        .sig-block { text-align: center; width: 200px; float: right; margin-top: 30px; }
        .sig-name { font-weight: bold; text-decoration: underline; font-size: 9.5pt; }
        .sig-meta { font-size: 8pt; color: #4b5563; margin-top: 2px; }

        .clearfix::after { content: ""; clear: both; display: table; }
    </style>
</head>

<body>
    <footer>
        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
            <tr>
                <td width="85%" height="10" style="background-color: #0d7377;"></td>
                <td width="15%" height="10" style="background-color: #f59e0b;"></td>
            </tr>
        </table>
    </footer>

    <!-- KOP SURAT (Identical to Assessment) -->
    <table class="header-table">
        <tr>
            <td width="80" align="left" valign="middle">
                <img src="{{ $logoBase64 }}" class="logo-img">
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
                <img src="{{ $logoPjiBase64 }}" class="logo-lg">
            </td>
        </tr>
    </table>

    <div class="doc-title">Laporan Rekapitulasi Keuangan</div>

    <!-- IDENTITAS LAPORAN -->
    <div class="info-card">
        <div class="info-title">Parameter & Informasi Laporan</div>
        <table class="info-table">
            <tr>
                <td class="label">Periode Laporan</td>
                <td width="10">:</td>
                <td class="value">{{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}</td>
                <td class="label">Tanggal Cetak</td>
                <td width="10">:</td>
                <td class="value">{{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</td>
            </tr>
            <tr>
                <td class="label">Dicetak Oleh</td>
                <td>:</td>
                <td class="value">{{ Auth::user()->name ?? 'Administrator' }}</td>
                <td class="label">Status Saldo</td>
                <td>:</td>
                <td class="value" style="color:#0d7377;">Terverifikasi Sistem</td>
            </tr>
        </table>
    </div>

    <!-- RINGKASAN SALDO -->
    <table class="stats-table">
        <tr>
            <td width="33%" class="stat-card stat-card-income">
                <span class="stat-label">Total Pemasukan</span>
                <span class="stat-value text-success">Rp {{ number_format($financialReport->where('jenis', 'pemasukkan')->sum('jumlah'), 0, ',', '.') }}</span>
            </td>
            <td width="3%" style="border:none;"></td> {{-- Spacer --}}
            <td width="31%" class="stat-card stat-card-expense">
                <span class="stat-label">Total Pengeluaran</span>
                <span class="stat-value text-danger">Rp {{ number_format($financialReport->where('jenis', 'pengeluaran')->sum('jumlah'), 0, ',', '.') }}</span>
            </td>
            <td width="3%" style="border:none;"></td> {{-- Spacer --}}
            <td width="30%" class="stat-card stat-card-balance">
                <span class="stat-label">Saldo Akhir</span>
                <span class="stat-value">Rp {{ number_format(optional($financialReport->last())->current_balance ?? $openingBalance, 0, ',', '.') }}</span>
            </td>
        </tr>
    </table>

    <!-- TABEL TRANSAKSI -->
    <table class="result-table">
        <thead>
            <tr>
                <th width="12%">Tanggal</th>
                <th width="10%">Tipe</th>
                <th width="18%">Jumlah</th>
                <th>Keterangan / Deskripsi Transaksi</th>
                <th width="18%" style="text-align: right;">Saldo</th>
            </tr>
        </thead>
        <tbody>
            {{-- Opening Balance Row --}}
            <tr style="background-color: #f1f5f9;">
                <td style="font-weight: bold;">{{ \Carbon\Carbon::parse($startDate)->format('d/m/y') }}</td>
                <td><span class="badge bg-slate">SALDO</span></td>
                <td style="color: #64748b; font-style: italic;">Saldo Awal</td>
                <td style="font-size: 7.5pt; color: #64748b;">Akumulasi saldo sebelum tanggal {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}</td>
                <td style="text-align: right; font-weight: bold;">Rp {{ number_format($openingBalance, 0, ',', '.') }}</td>
            </tr>

            @forelse ($financialReport as $report)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($report->tanggal)->format('d/m/y') }}</td>
                    <td>
                        <span class="badge {{ $report->jenis === 'pengeluaran' ? 'bg-danger' : 'bg-success' }}">
                            {{ $report->jenis === 'pengeluaran' ? 'KELUAR' : 'MASUK' }}
                        </span>
                    </td>
                    <td class="{{ $report->jenis === 'pengeluaran' ? 'text-danger' : 'text-success' }}" style="font-weight: bold;">
                        {{ $report->jenis === 'pengeluaran' ? '-' : '+' }} Rp {{ number_format($report->jumlah, 0, ',', '.') }}
                    </td>
                    <td>{{ $report->deskripsi }}</td>
                    <td style="text-align: right; font-weight: bold;">Rp {{ number_format($report->current_balance, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: #94a3b8; font-style: italic;">
                        Tidak ada transaksi keuangan yang tercatat pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px; font-size: 8.5pt; color: #4b5563; text-align: justify; line-height: 1.6;">
        <strong>Catatan:</strong> Laporan ini dicetak secara otomatis melalui sistem manajemen Bright Star. Seluruh data transaksi yang tertera di atas bersifat final dan telah melalui validasi sistem kasir pusat. Jika terdapat ketidaksesuaian data, harap segera menghubungi bagian administrasi keuangan.
    </div>

    <!-- SIGNATURE SECTION -->
    <div class="clearfix">
        <div class="sig-block">
            <p style="margin-bottom: 50px;">Unaaha, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p class="sig-name">{{ Auth::user()->name ?? 'Administrator Keuangan' }}</p>
            <p class="sig-meta">Bagian Administrasi & Keuangan<br>Bright Star of Child</p>
        </div>
    </div>

</body>
</html>
