@extends('layouts.master')
@section('menuKeuangan', 'active')
@section('masterKeuangan', 'menu-is-opening menu-open')
@section('menuRekap', 'active')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-12 col-md-6">
                        <h1 class="m-0">Keuangan</h1>
                    </div>
                    <div class="col-12 col-md-6">
                        <ol class="breadcrumb float-md-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Rekap Saldo KAS</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row text-center">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $saldoKas ? $saldoKas->saldo_awal : 0 }}</h3>
                                <p>Saldo Kas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-card"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $formattedPemasukan ?? 0 }}</h3>
                                <p>Pemasukkan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-android-arrow-down"></i>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $formattedPengeluaran ?? 0 }}</h3>
                                <p>Pengeluaran</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-android-arrow-up"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <section class="col-12 col-lg-7 mb-3">
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
                                            <th>No</th>
                                            <th>Deskripsi</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    <section class="col-12 col-lg-5 mb-3">
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
                                <select name="year_pemasukkan" id="yearFilter_pemasukkan" class="form-control mb-3">
                                    @foreach ($years_pemasukkan as $year)
                                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                                <canvas id="pemasukanChart"></canvas>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="row">
                    <section class="col-12 col-lg-5 mb-3">
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
                                <select name="year_pengeluaran" id="yearFilter_pengeluaran" class="form-control mb-3">
                                    @foreach ($years_pengeluaran as $year)
                                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                                <canvas id="pengeluaranChart"></canvas>
                            </div>
                        </div>
                    </section>

                    <section class="col-12 col-lg-7 mb-3">
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
                                            <th>No</th>
                                            <th>Deskripsi</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
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
