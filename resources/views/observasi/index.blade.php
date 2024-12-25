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
                                            <select class="form-control select2" style="width: 100%;" name="anak_id">
                                                @forelse ($anaks as $anak)
                                                    <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                                                @empty
                                                    <option value="">data belum ada</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Jenis</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2" style="width:100%" name="jenis"
                                                id="jenis">
                                                @forelse ($jenis as $value => $label)
                                                    <option value="{{ $value }}"
                                                        {{ $value == old('jenis') ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @empty
                                                    <option value="">data belum ada</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <button id="startButton" type="submit"
                                                class="btn btn-sm btn-primary">Mulai</button>
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
                                <div id="observations">Silahkan klik mulai!!!</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
