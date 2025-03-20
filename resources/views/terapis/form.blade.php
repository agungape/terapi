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
                        <li class="breadcrumb-item active">Tambah Terapis</li>
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
                                    <label for="inputName" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-10">

                                        {{-- hidden --}}
                                        <input type="text" id="nib"
                                            class="form-control @error('nib') is-invalid @enderror" name="nib"
                                            value="{{ old('nib') ?? ($terapi->nib ?? '') }}" hidden>
                                        <input type="text" id="status"
                                            class="form-control @error('status') is-invalid @enderror" name="status"
                                            value="{{ old('status') ?? ($terapi->status ?? '') }}" hidden>
                                        {{-- hidden --}}


                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" autofocus value="{{ old('nama') ?? ($terapi->nama ?? '') }}"
                                            placeholder="termasuk title">
                                        @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" autofocus>{{ old('alamat') ?? ($terapi->alamat ?? '') }}</textarea>
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"
                                            data-mask name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir') ?? ($terapi->tanggal_lahir ?? '') }}">

                                        @error('tanggal_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Telepon</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="telepon"
                                            class="form-control @error('telepon') is-invalid @enderror"
                                            value="{{ old('telepon') ?? ($terapi->telepon ?? '') }}"
                                            placeholder="08xx-xxxx-xxxx">
                                        @error('telepon')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit"
                                            class="btn btn-primary me-2">{{ $tombol }}</button>
                                        <a href="{{ route('terapis.index') }}" class="btn btn-danger">Cancel</a>
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
