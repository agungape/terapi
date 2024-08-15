@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'show')
@section('menuPelatihan', 'active')
@section('content')

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pelatihan</h4>
                    @auth
                        <a href="#" class="btn btn-gradient-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#pelatihanModal"><i class="fa fa-plus"></i>
                        </a>
                    @endauth
                    <table class="table table-striped">
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
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            {{-- <a href="{{ route('program.edit', ['program' => $p->id]) }}"
                                                class="btn btn-gradient-warning btn-sm">
                                                <i class="fa fa-edit"></i></a> --}}
                                            <form action="{{ route('pelatihan.destroy', ['pelatihan' => $p->id]) }}"
                                                method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-gradient-danger btn-sm btn-hapus"
                                                    title="Hapus Data" data-name="{{ $p->nama }}"
                                                    data-table="pelatihan">
                                                    <i class="fa fa-trash fa-fw"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-gradient-primary me-2">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
