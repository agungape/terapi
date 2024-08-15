@extends('layouts.master')
@section('menuObservasi', 'active')
@section('content')
    <div class="row">
        <div class="col-lg-5 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Observasi </h4>
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Anak</label>
                            <div class="col-sm-9">

                                <input type="text" class="form-control" name="anak_id" value="{{ $anak->nama }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $jenis }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <a href="{{ route('observasi.index') }}" class="btn btn-sm btn-gradient-warning">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Traffic Sources</h4>

                    <div id="observations"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
