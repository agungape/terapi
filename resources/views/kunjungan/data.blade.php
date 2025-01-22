@extends('layouts.master')
@section('menuRekammedis', 'active')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Rekam Medik Anak</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Rekam Medik Anak</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools">
                                    <div class="input-group input-group-sm w-100">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No. Induk</th>
                                            <th>Nama</th>
                                            <th>Terapis</th>
                                            <th>Pertemuan</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kunjungan as $kun)
                                            <tr>
                                                <td>{{ $kun->anak->nib }}</td>
                                                <td>{{ $kun->anak->nama }}</td>
                                                <td>{{ $kun->terapis->nama }}</td>
                                                <td>
                                                    @if ($kun->pertemuan == 'null')
                                                        -
                                                    @else
                                                        Pertemuan {{ $kun->pertemuan }}
                                                    @endif
                                                </td>
                                                <td>{{ $kun->created_at }}</td>
                                                <td>
                                                    @if ($kun->status == 'hadir')
                                                        <label class="badge badge-success">{{ $kun->status }}</label>
                                                    @elseif ($kun->status == 'izin')
                                                        <label class="badge badge-warning">{{ $kun->status }}</label>
                                                    @elseif ($kun->status == 'sakit')
                                                        <label class="badge badge-danger">{{ $kun->status }}</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    @can('show rekammedis')
                                                        @if ($kun->status == 'hadir')
                                                            <a href="{{ route('kunjungan.show', ['kunjungan' => $kun->id]) }}"
                                                                class="btn btn-primary btn-sm">
                                                                <i class="fa fa-address-card"></i>
                                                            </a>
                                                        @endif
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="mx-4 mt-3">
                                    {{ $kunjungan->fragment('judul')->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
