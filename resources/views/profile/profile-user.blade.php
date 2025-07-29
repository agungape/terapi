@extends('layouts.master')
@section('menuInformasiprofile', 'active')
@section('masterInformasiprofile', 'menu-is-opening menu-open')
@section('menuProfileuser', 'active')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-body">
                    @if ($terapis == null)
                        <p>Tampilan Khusus Terapis</p>
                    @else
                        <div class="row">
                            <!-- Bagian Logo -->

                            <div class="col-md-5 col-12 text-center d-flex align-items-center justify-content-center mb-3">
                                <form method="POST" action="{{ route('terapis.update', ['terapi' => $terapis->id]) }}"
                                    enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    <div class="form-group row">
                                        <div class="card card-primary card-outline shadow-sm p-4">
                                            <h4 class="text-center">Upload Foto</h4>

                                            <div class="mb-2 text-center">
                                                <img id="previewImage"
                                                    src="{{ asset($terapis->foto ? 'storage/terapis/' . $terapis->foto : 'assets/images/faces/face1.jpg') }}"
                                                    class="rounded-circle img-thumbnail"
                                                    style="width: 150px; height: 150px; object-fit: cover;">
                                            </div>


                                            <div class="mb-3 text-center">
                                                <input type="file" name="foto" id="photoInput"
                                                    class="form-control d-none" accept="image/*">
                                                <button type="button" id="uploadButton" class="btn btn-primary">
                                                    <i class="bi bi-upload"></i>
                                                    {{ $terapis->foto ? 'Ubah Foto' : 'Upload Gambar' }}
                                                </button>
                                            </div>

                                            <div class="text-center">
                                                @if ($terapis->foto)
                                                    <a href="{{ route('delete.fototerapis', $terapis->id) }}"
                                                        class="btn btn-danger">Hapus
                                                        Foto</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <!-- Bagian Form -->
                            <div class="col-md-7 col-12">

                                <!-- Nama -->
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-8">


                                        {{-- hidden --}}
                                        <input type="text" id="nib"
                                            class="form-control @error('nib') is-invalid @enderror" name="nib"
                                            value="{{ old('nib') ?? ($terapis->nib ?? '') }}" hidden>
                                        <input type="text" id="status"
                                            class="form-control @error('status') is-invalid @enderror" name="status"
                                            value="{{ old('status') ?? ($terapis->status ?? '') }}" hidden>
                                        {{-- hidden --}}

                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" autofocus value="{{ old('nama') ?? ($terapis->nama ?? '') }}"
                                            readonly>
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Nama Aplikasi -->
                                <div class="form-group row">
                                    <label for="tanggal_lahir" class="col-sm-4 col-form-label">Taggal Lahir</label>
                                    <div class="col-sm-8">
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                            data-mask name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir') ?? ($terapis->tanggal_lahir ?? '') }}">

                                        @error('tanggal_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Telepon -->
                                <div class="form-group row">
                                    <label for="inputSubject" class="col-sm-4 col-form-label">Telepon</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="inputSubject" name="telepon"
                                            class="form-control @error('telepon') is-invalid @enderror"
                                            value="{{ $terapis->telepon ?? '' }}" />
                                    </div>
                                    @error('telepon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Alamat -->
                                <div class="form-group row">
                                    <label for="inputMessage" class="col-sm-4 col-form-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <textarea id="inputMessage" class="form-control" name="alamat" rows="4">{{ $terapis->alamat }}</textarea>
                                    </div>
                                </div>
                                <!-- Ketua -->
                                <!-- Submit Button -->
                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>

                            </div>
                            </form>
                        </div>

                    @endif
                </div>
            </div>
        </section>

        <!-- /.content -->
    </div>

@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        document.getElementById('uploadButton').addEventListener('click', function() {
            document.getElementById('photoInput').click();
        });

        document.getElementById('photoInput').addEventListener('change', function(event) {
            let reader = new FileReader();
            reader.onload = function() {
                document.getElementById('previewImage').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>

@endsection
