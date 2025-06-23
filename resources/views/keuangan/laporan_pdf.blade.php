<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan</title>
    <style>
        /* Bootstrap 5 CSS for mPDF */
        :root {
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #6f42c1;
            --bs-pink: #d63384;
            --bs-red: #dc3545;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffc107;
            --bs-green: #198754;
            --bs-teal: #20c997;
            --bs-cyan: #0dcaf0;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-primary: #0d6efd;
            --bs-secondary: #6c757d;
            --bs-success: #198754;
            --bs-info: #0dcaf0;
            --bs-warning: #ffc107;
            --bs-danger: #dc3545;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: var(--bs-font-sans-serif);
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        .container {
            width: 100%;
            padding-right: var(--bs-gutter-x, 0.75rem);
            padding-left: var(--bs-gutter-x, 0.75rem);
            margin-right: auto;
            margin-left: auto;
        }

        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-0.5 * var(--bs-gutter-x));
            margin-left: calc(-0.5 * var(--bs-gutter-x));
        }

        .row>* {
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x) * 0.5);
            padding-left: calc(var(--bs-gutter-x) * 0.5);
            margin-top: var(--bs-gutter-y);
        }

        .col {
            flex: 1 0 0%;
        }

        .text-center {
            text-align: center !important;
        }

        .text-end {
            text-align: right !important;
        }

        .text-success {
            color: var(--bs-success) !important;
        }

        .text-danger {
            color: var(--bs-danger) !important;
        }

        .mt-3 {
            margin-top: 1rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .p-3 {
            padding: 1rem !important;
        }

        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }

        .badge.bg-success {
            background-color: var(--bs-success) !important;
        }

        .badge.bg-danger {
            background-color: var(--bs-danger) !important;
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-accent-bg: transparent;
            --bs-table-striped-color: #212529;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: #212529;
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: #212529;
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
        }

        .table> :not(caption)>*>* {
            padding: 0.5rem 0.5rem;
            background-color: var(--bs-table-bg);
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }

        .table>thead {
            vertical-align: bottom;
        }

        .table> :not(:first-child) {
            border-top: 2px solid currentColor;
        }

        .table-bordered> :not(caption)>* {
            border-width: 1px 0;
        }

        .table-bordered> :not(caption)>*>* {
            border-width: 1px;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            --bs-table-accent-bg: var(--bs-table-striped-bg);
            color: var(--bs-table-striped-color);
        }

        .table-hover>tbody>tr:hover>* {
            --bs-table-accent-bg: var(--bs-table-hover-bg);
            color: var(--bs-table-hover-color);
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            z-index: -1;
            font-size: 5rem;
            color: #ccc;
            font-weight: bold;
            pointer-events: none;
        }

        .header {
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .company-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--bs-dark);
        }

        .report-title {
            font-size: 1.25rem;
            font-weight: 500;
            margin: 0.5rem 0;
        }

        .period-info {
            font-size: 0.9rem;
            color: var(--bs-gray);
        }

        .footer {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #dee2e6;
            font-size: 0.75rem;
            color: var(--bs-gray);
        }

        .summary-card {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            background-color: #f8f9fa;
        }

        .summary-title {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--bs-gray-dark);
        }

        .summary-value {
            font-size: 1.1rem;
            font-weight: 700;
        }

        @page {
            margin: 1cm;
        }

        @media print {
            .watermark {
                opacity: 0.05;
            }

            .summary-card {
                page-break-inside: avoid;
            }

            .table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }
    </style>
</head>

<body>
    <!-- Watermark -->
    {{-- <div class="watermark">
        {{ config('app.name', 'Laravel') }}
    </div> --}}

    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="row">
                <div class="col text-center">
                    <div class="company-name">BRIGHT STAR OF CHILD</div>
                    <div class="report-title">Laporan Keuangan</div>
                    <div class="period-info">
                        Periode: {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} -
                        {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col">
                <div class="summary-card">
                    <div class="summary-title">Total Pemasukan</div>
                    <div class="summary-value text-success">Rp
                        {{ number_format($financialReport->where('jenis', 'pemasukkan')->sum('jumlah'), 0, ',', '.') }}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="summary-card">
                    <div class="summary-title">Total Pengeluaran</div>
                    <div class="summary-value text-danger">Rp
                        {{ number_format($financialReport->where('jenis', 'pengeluaran')->sum('jumlah'), 0, ',', '.') }}
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="summary-card">
                    <div class="summary-title">Saldo Akhir</div>
                    <div class="summary-value">
                        Rp {{ number_format(optional($financialReport->last())->current_balance ?? 0, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($financialReport as $report)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($report->tanggal)->translatedFormat('d M Y') }}</td>
                            <td>
                                {{ ucfirst($report->jenis) }}
                            </td>
                            <td class="{{ $report->jenis === 'pengeluaran' ? 'text-danger' : 'text-success' }}">
                                Rp {{ number_format($report->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="text-center">{{ $report->deskripsi }}</td>
                            <td class="text-end">Rp {{ number_format($report->current_balance, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="row">
                <div class="col text-start">
                    Dicetak oleh: {{ Auth::user()->name ?? 'Admin' }}
                </div>
                <div class="col text-end">
                    Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
