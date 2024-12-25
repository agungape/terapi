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
                <div class="card-body row">
                    <div class="col-5 text-center d-flex align-items-center justify-content-center">
                        @if ($profile)
                            <div class="image-container">
                                <div class="col-md-12">
                                    <img src="{{ asset('storage/logo/' . $profile->logo) }}">
                                </div>
                            </div>
                        @else
                            <div class="">
                                <h2>Admin<strong>LTE</strong></h2>
                                <p class="lead mb-5">123 Testing Ave, Testtown, 9876 NA<br>
                                    Phone: +1 234 56789012
                                </p>
                            </div>
                        @endif
                    </div>
                    <div class="col-7">
                        @if ($profile)
                            <form action="{{ route('profile.update', ['profile' => $profile->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label for="inputName">Nama</label>
                                    <input type="text" id="inputName" name="nama" class="form-control"
                                        value="{{ $profile->nama ?? '' }}" />
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nama Aplikasi</label>
                                    <input type="text" id="inputName" name="nama_apk" class="form-control"
                                        value="{{ $profile->nama_apk ?? '' }}" />
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">E-Mail</label>
                                    <input type="email" id="inputEmail" name="email" class="form-control"
                                        value="{{ $profile->email ?? '' }}" />
                                </div>
                                <div class="form-group">
                                    <label for="inputSubject">Telepon</label>
                                    <input type="text" id="inputSubject" name="telepon" class="form-control"
                                        value="{{ $profile->telepon ?? '' }}" />
                                </div>
                                <div class="form-group">
                                    <label for="inputMessage">Alamat</label>
                                    <textarea id="inputMessage" class="form-control" name="alamat" rows="4">{{ $profile->alamat }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="inputSubject">Ketua</label>
                                    <input type="text" id="inputSubject" name="ketua" class="form-control"
                                        value="{{ $profile->ketua ?? '' }}" />
                                </div>
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
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right"> Update</button>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="inputName">Nama</label>
                                    <input type="text" id="inputName" name="nama" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nama Aplikasi</label>
                                    <input type="text" id="inputName" name="nama_apk" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">E-Mail</label>
                                    <input type="email" id="inputEmail" name="email" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="inputSubject">Telepon</label>
                                    <input type="text" id="inputSubject" name="telepon" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="inputMessage">Alamat</label>
                                    <textarea id="inputMessage" class="form-control" name="alamat" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="inputSubject">Ketua</label>
                                    <input type="text" id="inputSubject" name="ketua" class="form-control" />
                                </div>
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
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right"> Simpan</button>
                                </div>
                            </form>
                        @endif

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
