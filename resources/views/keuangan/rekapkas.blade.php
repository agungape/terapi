@extends('layouts.master')
@section('menuKeuangan', 'active')
@section('masterKeuangan', 'menu-is-opening menu-open')
@section('menuRekap', 'active')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Keuangan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Rekap Saldo KAS</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                @if ($saldoKas)
                                    {
                                    <h3>{{ $saldoKas->saldo_awal }}</h3>
                                }@else{
                                    <h3>0</h3>

                                    }
                                @endif

                                <p>Saldo Kas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-card"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                @if ($formattedPemasukan)
                                    <h3>{{ $formattedPemasukan }}</h3>
                                @else
                                    <h3>0</h3>
                                @endif
                                <p>Pemasukkan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>

                                <p>Keuntungan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                @if ($formattedPengeluaran)
                                    <h3>{{ $formattedPengeluaran }}</h3>
                                @else
                                    <h3>0</h3>
                                @endif
                                <p>Pengeluaran</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <div class="row">
                    <section class="col-lg-7">
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Rincian Pemasukkan</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body px-3">
                                <table class="table table-bordered table-hover" id="data-tables">
                                    <thead>
                                        <tr>
                                            <th> No</th>
                                            <th> Deskripsi </th>
                                            <th> Kategori </th>
                                            <th> Jumlah </th>
                                            <th> Tanggal </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </section>
                    <section class="col-lg-5">
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-chart-bar"></i>
                                    Grafik Pemasukkan
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <select name="year_pemasukkan" id="yearFilter_pemasukkan" class="form-control float-right"
                                    style="width: auto;">
                                    @foreach ($years_pemasukkan as $year)
                                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                                <canvas id="pemasukanChart"></canvas>
                            </div>
                            <!-- /.card-body-->
                        </div>
                    </section>
                </div>
                <div class="row">
                    <section class="col-lg-5">
                        <div class="card card-danger card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-chart-bar"></i>
                                    Grafik Pengeluaran
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <select name="year_pengeluaran" id="yearFilter_pengeluaran" class="form-control float-right"
                                    style="width: auto;">
                                    @foreach ($years_pengeluaran as $year)
                                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                                <canvas id="pengeluaranChart"></canvas>
                            </div>
                            <!-- /.card-body-->
                        </div>
                    </section>
                    <section class="col-lg-7">
                        <div class="card card-danger card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Rincian Pengeluaran</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body px-3">
                                <table class="table table-bordered table-hover" id="data-tables2">
                                    <thead>
                                        <tr>
                                            <th> No</th>
                                            <th> Deskripsi </th>
                                            <th> Kategori </th>
                                            <th> Jumlah </th>
                                            <th> Tanggal </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
@include('keuangan.script2')
