@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('deteksiShow', 'menu-is-opening menu-open')
@section('deteksiUmur', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Umur Deteksi Pendengaran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Umur</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            @can('create deteksi umur')
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <i class="fa fa-plus"></i> Tambah Data
                                    </a>
                                </div>
                            @endcan
                            <!-- /.card-header -->

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover text-nowrap mb-0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Data Umur</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ageGroups as $age)
                                                <tr class="text-center">
                                                    <td>{{ $age->nama }}</td>
                                                    <td>
                                                        @can('delete program anak')
                                                            <form action="{{ route('age.destroy', ['id' => $age->id]) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                                    title="Hapus Data" data-name="{{ $age->nama }}"
                                                                    data-table="program">
                                                                    <i class="fa fa-trash fa-fw"></i>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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


    <form action="{{ route('age.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Umur</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary me-2">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
