@extends('layouts.master')
@section('menuKeuangan', 'active')
@section('masterKeuangan', 'menu-is-opening menu-open')
@section('menuLaporanKeuangan', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Laporan Keuangan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Laporan</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-lg">
                            <!-- Form with Date Picker and Filter Button -->
                            <form action="{{ route('keuangan.laporan') }}" method="GET"
                                class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded flex-wrap">
                                <div class="form-group d-flex align-items-center mb-2 mb-sm-0">
                                    <label for="reservation" class="mr-3">Pilih Tanggal:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="reservation" name="date_range">
                                        <button type="submit" class="btn btn-primary ml-2 mb-2 mb-sm-0">Filter</button>
                                        <a href="#" id="export-pdf" class="btn btn-success ml-sm-3"
                                            target="_blank">Export
                                            PDF</a>
                                    </div>
                                </div>
                            </form>

                            <!-- Financial Report Table -->
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-bordered text-nowrap">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jenis</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th>Saldo Akhir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($financialReport as $report)
                                            <tr>
                                                <td>{{ $report->tanggal }}</td>
                                                <td>{{ $report->jenis }}</td>
                                                <td>
                                                    @if ($report->jenis == 'pemasukkan')
                                                        <span
                                                            class="badge bg-success">{{ number_format($report->jumlah, 2) }}</span>
                                                    @else<span
                                                            class="badge bg-danger">{{ number_format($report->jumlah, 2) }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $report->deskripsi }}</td>
                                                <td><span
                                                        class="badge bg-primary">{{ number_format($report->current_balance, 2) }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi Date Range Picker
            $('#reservation').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD',
                    separator: ' - ',
                    applyLabel: 'Pilih',
                    cancelLabel: 'Batal',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                    monthNames: [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ],
                    firstDay: 1
                }
            });

            // Set nilai awal jika ada dari request
            @if (request('date_range'))
                $('#reservation').val('{{ request('date_range') }}');
            @endif

            // Event saat klik tombol Export PDF
            $('#export-pdf').on('click', function(e) {
                e.preventDefault();

                let dateRange = $('#reservation').val();
                if (dateRange) {
                    let dates = dateRange.split(' - ');
                    let start = dates[0].trim();
                    let end = dates[1].trim();

                    // Ganti URL ke route yang sesuai manual
                    let url = `/keuangan/laporan/pdf/${start}/${end}`;
                    window.open(url, '_blank');
                } else {
                    alert('Silakan pilih rentang tanggal terlebih dahulu.');
                }
            });
        });
    </script>
@endsection
