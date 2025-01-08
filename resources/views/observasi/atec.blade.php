@extends('layouts.master')
@section('menuObservasi', 'active')
@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Observasi</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('observasi.atec') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Anak</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="anak_id" class="form-control" hidden
                                                value="{{ $anak->id }}">
                                            <input type="text" class="form-control" disabled value="{{ $anak->nama }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Jenis</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="jenis" class="form-control"
                                                value="{{ $jenis }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label">Upload
                                            Hasil</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file"
                                                        class="custom-file-input @error('gambar_atec') is-invalid @enderror"
                                                        name="gambar_atec" id="gambar_atec" accept="image/*" required
                                                        autofocus>
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih
                                                        file</label>
                                                </div>
                                                @error('gambar_atec')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary">Submit</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-5">
                        <iframe src="https://atec.jatmika.com/" width="100%" height="600px"></iframe>
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
            let files = document.getElementById('gambar_atec').files;

            for (let i in files) {
                if (files.hasOwnProperty(i)) {
                    filenames.push(files[i].name);
                }
            }

            $(this).next('.custom-file-label').addClass("selected").html(filenames.join(', '));
        });
    </script>
@endsection
