@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'show')
@section('menuProgram', 'active')
@section('content')

    <div class="row">
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Program</h4>
                    @auth
                        <a href="#" class="btn btn-gradient-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"><i class="fa fa-plus"></i>
                        </a>
                    @endauth
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Program</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($program as $p)
                                <tr>
                                    <td scope="row">{{ $program->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $p->deskripsi }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            {{-- <a href="{{ route('program.edit', ['program' => $p->id]) }}"
                                                class="btn btn-gradient-warning btn-sm">
                                                <i class="fa fa-edit"></i></a> --}}
                                            <form action="{{ route('program.destroy', ['program' => $p->id]) }}"
                                                method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-gradient-danger btn-sm btn-hapus"
                                                    title="Hapus Data" data-name="{{ $p->nama }}" data-table="program">
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
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Traffic Sources</h4>
                    <div class="doughnutjs-wrapper d-flex justify-content-center">
                        <canvas id="traffic-chart"></canvas>
                    </div>
                    <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('program.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Program</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Nama Program</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="deskripsi">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-gradient-primary me-2">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
