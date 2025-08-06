@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('menuTarif', 'active')
@section('content')

    <form method="POST" action="{{ route('tarif.update', ['tarif' => $tarif->id]) }}" id="tarifForm">
        @method('PATCH')
        @csrf

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Edit Paket tarif</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Nama Paket</label>
                                            <div class="col-sm-10">

                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror" name="nama"
                                                    autofocus value="{{ old('nama') ?? ($tarif->nama ?? '') }}">
                                                @error('nama')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Deskripsi</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" autofocus>{{ old('deskripsi') ?? ($tarif->deskripsi ?? '') }}</textarea>
                                                @error('deskripsi')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Tarif</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="tarif"
                                                    class="form-control @error('tarif') is-invalid @enderror"
                                                    value="{{ old('tarif') ?? ($tarif->tarif ?? '') }}" id="tarif">
                                                @error('tarif')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                                <a href="{{ route('tarif.index') }}" class="btn btn-danger">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        {{-- Trik agar bisa kembali ke halaman yang klik --}}

    </form>

@endsection

@section('scripts')
    <script>
        function formatHarga(input) {
            let value = input.value.replace(/[^\d]/g, '');
            if (value.length > 15) {
                value = value.substring(0, 15);
            }
            if (value.length > 3) {
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            input.value = value;
        }
        document.getElementById('tarif').addEventListener('input', function(event) {
            formatHarga(event.target);
        });

        document.getElementById('tarifForm').addEventListener('submit', function(event) {
            var hargaInput = document.getElementById('tarif');
            hargaInput.value = hargaInput.value.replace(/\./g, '');
        });
    </script>
@endsection
