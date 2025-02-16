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
                                    </div>
                                </div>
                                <div
                                    class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center mt-2 mt-sm-0">
                                    <button type="submit" class="btn btn-primary mb-2 mb-sm-0">Filter</button>
                                    <a href="#" id="export-pdf" class="btn btn-success ml-sm-3" target="_blank">Export
                                        PDF</a>
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
                                                <td>{{ number_format($report->jumlah, 2) }}</td>
                                                <td>{{ $report->deskripsi }}</td>
                                                <td>{{ number_format($report->current_balance, 2) }}</td>
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
            // Inisialisasi daterangepicker
            $('#reservation').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD', // Format tanggal
                    separator: ' - ', // Pemisah antara tanggal mulai dan selesai
                    applyLabel: 'Pilih',
                    cancelLabel: 'Batal',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                    monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                        'September', 'Oktober', 'November', 'Desember'
                    ],
                    firstDay: 1
                }
            });

            // Set nilai awal date range picker dari input tersembunyi
            @if (request('date_range'))
                $('#reservation').val('{{ request('date_range') }}');
            @endif

            // Update link Export PDF saat date range berubah
            $('#reservation').on('apply.daterangepicker', function(ev, picker) {
                var startDate = picker.startDate.format('YYYY-MM-DD');
                var endDate = picker.endDate.format('YYYY-MM-DD');
                var exportUrl =
                    "{{ route('laporan.pdf', ['start_date' => ':start_date', 'end_date' => ':end_date']) }}";
                exportUrl = exportUrl.replace(':start_date', startDate).replace(':end_date', endDate);
                $('#export-pdf').attr('href', exportUrl);
            });

            // Set link Export PDF saat halaman dimuat
            @if (request('date_range'))
                var dates = '{{ request('date_range') }}'.split(' - ');
                var startDate = dates[0];
                var endDate = dates[1];
                var exportUrl =
                    "{{ route('laporan.pdf', ['start_date' => ':start_date', 'end_date' => ':end_date']) }}";
                exportUrl = exportUrl.replace(':start_date', startDate).replace(':end_date', endDate);
                $('#export-pdf').attr('href', exportUrl);
            @endif
        });
    </script>
@endsection
