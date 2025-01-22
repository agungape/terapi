@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('menuPelatihan', 'active')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pelatihan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Pelatihan</li>
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
                            @can('create pelatihan')
                                <div class="card-header">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#pelatihanModal"><i class="fa fa-plus"></i> Tambah Data
                                    </a>
                                </div>
                            @endcan

                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Pelatihan</th>
                                            <th>Instansi/Penyedia</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($pelatihan as $p)
                                            <tr>
                                                <td scope="row">{{ $pelatihan->firstItem() + $loop->iteration - 1 }}</td>
                                                <td>{{ $p->nama }}</td>
                                                <td>{{ $p->instansi }}</td>
                                                <td>
                                                    @can('delete pelatihan')
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            {{-- <a href="{{ route('program.edit', ['program' => $p->id]) }}"
                                                class="btn btn-gradient-warning btn-sm">
                                                <i class="fa fa-edit"></i></a> --}}
                                                            <form
                                                                action="{{ route('pelatihan.destroy', ['pelatihan' => $p->id]) }}"
                                                                method="POST">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                                    title="Hapus Data" data-name="{{ $p->nama }}"
                                                                    data-table="pelatihan">
                                                                    <i class="fa fa-trash fa-fw"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="mx-4 mt-3">
                                    {{ $pelatihan->fragment('judul')->links() }}
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

    <div class="modal fade" id="pelatihanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{ route('pelatihan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pelatihan</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Nama Pelatihan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Instansi / Penyedia</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="instansi">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary me-2">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
