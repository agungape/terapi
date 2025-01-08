@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('menuTerapis', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>General Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">General Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Pelatihan Terapis</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('pelatihans.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Pelatihan</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="terapis_id"
                                                class="form-control @error('terapis_id') is-invalid @enderror"
                                                name="terapis_id" value="{{ old('terapis_id') ?? ($terapi->id ?? '') }}"
                                                hidden>
                                            <select class="form-control select2" style="width: 100%;" name="pelatihan_id">
                                                @forelse ($pelatihan as $p)
                                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                                @empty
                                                    <option value="">data belum ada</option>
                                                @endforelse
                                            </select>
                                            @error('nama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Pelatihan</label>
                                        <div class="col-sm-4">
                                            <input type="date"
                                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                                data-mask name="tanggal"
                                                value="{{ old('tanggal') ?? ($terapispelatihan->tanggal ?? '') }}">
                                            @error('tanggal')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Upload
                                            Sertifikat</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="sertifikat"
                                                        id="sertifikat" accept="application/pdf">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih
                                                        file</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                @isset($terapi)
                                    <input type="hidden" name="url_asal"
                                        value="{{ old('url_asal') ?? url()->previous() . '#row-' . $terapi->id }}">
                                @else
                                    <input type="hidden" name="url_asal" value="{{ old('url_asal') ?? url()->previous() }}">
                                @endisset



                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-warning">Kembali</a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $('input[type="file"]').on('change', function() {
            let filenames = [];
            let files = document.getElementById('sertifikat').files;

            for (let i in files) {
                if (files.hasOwnProperty(i)) {
                    filenames.push(files[i].name);
                }
            }

            $(this).next('.custom-file-label').addClass("selected").html(filenames.join(', '));
        });
    </script>
@endsection




{{-- Trik agar bisa kembali ke halaman yang klik --}}
