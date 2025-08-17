@extends('layouts.master')
@section('title', 'Analisis Kinerja Terapis')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-chart-line mr-2"></i>Analisis Kinerja Terapis</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Kinerja Terapis</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <!-- Filter Tanggal -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-filter mr-2"></i>Filter Periode</h3>
                    </div>
                    <form method="GET" action="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control"
                                            value="{{ request('tanggal_mulai', now()->startOfMonth()->format('Y-m-d')) }}"
                                            max="{{ now()->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <input type="date" name="tanggal_selesai" class="form-control"
                                            value="{{ request('tanggal_selesai', now()->endOfMonth()->format('Y-m-d')) }}"
                                            max="{{ now()->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-search mr-1"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Info Boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1">
                                <i class="fas fa-user-md"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Terapis</span>
                                <span class="info-box-number">{{ $totalTerapis }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Kunjungan</span>
                                <span class="info-box-number">{{ $totalKunjungan }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1">
                                <i class="fas fa-user-clock"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Rata-rata/Terapis</span>
                                <span
                                    class="info-box-number">{{ $totalTerapis > 0 ? round($totalKunjungan / $totalTerapis, 1) : 0 }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1">
                                <i class="fas fa-star"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Terapis Terbaik</span>
                                <span class="info-box-number">{{ $terapisTerbaik->nama ?? '-' }}
                                    ({{ $terapisTerbaik->total_kunjungan ?? 0 }})</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Distribusi Kunjungan per Terapis</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Persentase Beban Kerja</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Terapis -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Terapis</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 200px;">
                                        <input type="text" id="searchInput" class="form-control float-right"
                                            placeholder="Cari...">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-default" id="searchBtn">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Terapis</th>
                                            <th>Spesialisasi</th>
                                            <th>Total Kunjungan</th>
                                            <th>Progress</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($daftarTerapis as $index => $terapis)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $terapis->nama }}</td>
                                                <td>{{ $terapis->spesialisasi }}</td>
                                                <td>{{ $terapis->total_kunjungan }}</td>
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar
                                                    @if ($terapis->total_kunjungan > $maxKunjungan * 0.7) bg-danger
                                                    @elseif($terapis->total_kunjungan > $maxKunjungan * 0.4) bg-warning
                                                    @else bg-success @endif"
                                                            style="width: {{ ($terapis->total_kunjungan / $maxKunjungan) * 100 }}%">
                                                        </div>
                                                    </div>
                                                    <small>{{ round(($terapis->total_kunjungan / $maxKunjungan) * 100, 1) }}%</small>
                                                </td>
                                                <td>
                                                    <a href="{{ route('terapis.show', $terapis->id) }}"
                                                        class="btn btn-sm btn-info" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                {{ $daftarTerapis->appends(request()->query())->links() }}
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
        $(function() {
            // Bar Chart
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = {
                labels: {!! json_encode($namaTerapis) !!},
                datasets: [{
                    label: 'Total Kunjungan',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    data: {!! json_encode($totalKunjunganPerTerapis) !!}
                }]
            }

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

            // Pie Chart
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = {
                labels: {!! json_encode($namaTerapis) !!},
                datasets: [{
                    data: {!! json_encode($totalKunjunganPerTerapis) !!},
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de',
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                    ],
                }]
            }

            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var total = dataset.data.reduce(function(previousValue, currentValue) {
                                    return previousValue + currentValue;
                                });
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                                return data.labels[tooltipItem.index] + ': ' + currentValue + ' (' +
                                    percentage + '%)';
                            }
                        }
                    }
                }
            });

            // Pencarian client-side
            $('#searchBtn').click(function() {
                var value = $('#searchInput').val().toLowerCase();
                $('table tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
