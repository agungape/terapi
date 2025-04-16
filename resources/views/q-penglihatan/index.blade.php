@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('deteksiShow', 'menu-is-opening menu-open')
@section('deteksiPenglihatan', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Deteksi Penglihatan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Deteksi</li>
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
                                @can('create deteksi qpenglihatan')
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data
                                    </a>
                                @endcan
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pertanyaan</th>
                                            <th>Interpretasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($penglihatan as $p)
                                            <tr>
                                                <td scope="row">{{ $penglihatan->firstItem() + $loop->iteration - 1 }}
                                                </td>
                                                <td>{{ $p->question_text }}</td>
                                                <td>{{ $p->interpretasi }}</td>
                                                <td>
                                                    @can('delete qpenglihatan')
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <form action="{{ route('qpenglihatan.destroy', ['id' => $p->id]) }}"
                                                                method="POST">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                                    title="Hapus Data" data-name="question"
                                                                    data-table="penglihatan">
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
                                    {{ $penglihatan->fragment('judul')->links() }}
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


    <form action="{{ route('qpenglihatan.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Question</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Pertanyaan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="question_text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Kelompok Umur</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" style="width:100%" name="interpretasi">
                                    @foreach ($interpretasi as $value => $label)
                                        <option value="{{ $value }}">
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
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
