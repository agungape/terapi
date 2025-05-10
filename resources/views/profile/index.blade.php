@extends('layouts.master')
@section('menuProfile', 'active')
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
                            <li class="breadcrumb-item active">Profile Yayasan</li>
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
                    <div class="row">
                        <!-- Bagian Logo -->
                        <div class="col-md-5 col-12 text-center d-flex align-items-center justify-content-center mb-3">
                            @if ($profile)
                                <div class="image-container">
                                    <img src="{{ asset('storage/logo/' . $profile->logo) }}" class="img-fluid"
                                        alt="Logo">
                                </div>
                            @else
                                <div>
                                    <h2>Admin<strong>LTE</strong></h2>
                                    <p class="lead mb-5">123 Testing Ave, Testtown, 9876 NA<br>
                                        Phone: +1 234 56789012
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Bagian Form -->
                        <div class="col-md-7 col-12">
                            @if ($profile)
                                <form action="{{ route('profile.update', ['profile' => $profile->id]) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    <!-- Nama -->
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-4 col-form-label">Nama</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="inputName" name="nama" class="form-control"
                                                value="{{ $profile->nama ?? '' }}" />
                                        </div>
                                    </div>
                                    <!-- Nama Aplikasi -->
                                    <div class="form-group row">
                                        <label for="nama_apk" class="col-sm-4 col-form-label">Nama Aplikasi</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="nama_apk" name="nama_apk" class="form-control"
                                                value="{{ $profile->nama_apk ?? '' }}" />
                                        </div>
                                    </div>
                                    <!-- Email -->
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-4 col-form-label">E-Mail</label>
                                        <div class="col-sm-8">
                                            <input type="email" id="inputEmail" name="email" class="form-control"
                                                value="{{ $profile->email ?? '' }}" />
                                        </div>
                                    </div>
                                    <!-- Telepon -->
                                    <div class="form-group row">
                                        <label for="inputSubject" class="col-sm-4 col-form-label">Telepon</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="inputSubject" name="telepon" class="form-control"
                                                value="{{ $profile->telepon ?? '' }}" />
                                        </div>
                                    </div>
                                    <!-- Alamat -->
                                    <div class="form-group row">
                                        <label for="inputMessage" class="col-sm-4 col-form-label">Alamat</label>
                                        <div class="col-sm-8">
                                            <textarea id="inputMessage" class="form-control" name="alamat" rows="4">{{ $profile->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <!-- Ketua -->
                                    <div class="form-group row">
                                        <label for="ketua" class="col-sm-4 col-form-label">Kepala Yayasan</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="ketua" name="ketua" class="form-control"
                                                value="{{ $profile->ketua ?? '' }}" />
                                        </div>
                                    </div>
                                    <!-- Logo -->
                                    <div class="form-group row">
                                        <label for="logo" class="col-sm-4 col-form-label">Logo (*emblem)</label>
                                        <div class="col-sm-8">
                                            <input type="file" id="logo" name="logo"
                                                class="form-control @error('logo') is-invalid @enderror">
                                            @error('logo')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Submit Button -->
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-right">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <!-- Form Simpan -->
                                <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Nama -->
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-4 col-form-label">Nama</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="inputName" name="nama" class="form-control" />
                                        </div>
                                    </div>
                                    <!-- Nama Aplikasi -->
                                    <div class="form-group row">
                                        <label for="nama_apk" class="col-sm-4 col-form-label">Nama Aplikasi</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="nama_apk" name="nama_apk" class="form-control" />
                                        </div>
                                    </div>
                                    <!-- Email -->
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-4 col-form-label">E-Mail</label>
                                        <div class="col-sm-8">
                                            <input type="email" id="inputEmail" name="email" class="form-control" />
                                        </div>
                                    </div>
                                    <!-- Telepon -->
                                    <div class="form-group row">
                                        <label for="inputSubject" class="col-sm-4 col-form-label">Telepon</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="inputSubject" name="telepon"
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <!-- Alamat -->
                                    <div class="form-group row">
                                        <label for="inputMessage" class="col-sm-4 col-form-label">Alamat</label>
                                        <div class="col-sm-8">
                                            <textarea id="inputMessage" class="form-control" name="alamat" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <!-- Ketua -->
                                    <div class="form-group row">
                                        <label for="ketua" class="col-sm-4 col-form-label">Kepala Yayasan</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="ketua" name="ketua" class="form-control" />
                                        </div>
                                    </div>
                                    <!-- Logo -->
                                    @can('create profile')
                                        <div class="form-group">
                                            <label for="inputSubject">Logo (*emblem)</label>
                                            <img id="preview" src="#" alt="Preview Gambar" style="display: none;">
                                            <button class="container-btn-file">
                                                Upload File
                                                <input class="file @error('logo') is-invalid @enderror" name="logo"
                                                    id="logo" type="file" />
                                            </button>
                                            @error('logo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <!-- Submit Button -->
                                        <div class="form-group row">
                                            <div class="col-sm-12 text-right">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    @endcan
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- /.content -->
    </div>

@endsection
@section('scripts')
    <script>
        document.getElementById('logo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    </script>

@endsection
