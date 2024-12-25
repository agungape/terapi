@extends('layouts.master')
@section('menuObservasi', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Anak</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Terapis</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Observasi</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('observasi.mulai') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Anak</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="anak_id"
                                                value="{{ $anak->nama }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Jenis</label>
                                        <div class="col-sm-9">
                                            @if ($jenis)
                                                <input type="text" class="form-control" value="Wawancara" readonly>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <a href="{{ route('observasi.index') }}"
                                                class="btn btn-sm btn-warning">Kembali</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Observasi </h4>
                            </div>
                            <div class="card-body">
                                <div id="observations"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
