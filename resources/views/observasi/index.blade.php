@extends('layouts.master')
@section('menuUpload', 'collapsed')
@section('content')
    <div class="row">
        <div class="col-lg-5 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Observasi </h4>
                    <form action="{{ route('observasi.mulai') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Anak</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" style="width:100%" name="anak_id" id="anak_id">

                                    @foreach ($anaks as $anak)
                                        <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis</label>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" style="width:100%" name="jenis" id="jenis">
                                    @foreach ($jenis as $value => $label)
                                        <option value="{{ $value }}" {{ $value == old('jenis') ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <button id="startButton" type="submit" class="btn btn-sm btn-primary">Mulai</button>
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
