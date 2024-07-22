@extends('layouts.master')
@section('menuUpload', 'collapsed')
@section('content')
    <div class="row">
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Observasi </h4>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Anak</label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single" style="width:100%" name="terapis_id">

                                @foreach ($anaks as $anak)
                                    <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label>Observasi</label>
                        <select class="js-example-basic-single" style="width:100%">
                            <option value="AL">Alabama</option>
                            <option value="WY">Wyoming</option>
                            <option value="AM">America</option>
                            <option value="CA">Canada</option>
                            <option value="RU">Russia</option>
                        </select>
                    </div>

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
