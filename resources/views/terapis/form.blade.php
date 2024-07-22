@csrf
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Terapis</h4>
                <div class="col-sm-9">
                    <input type="text" id="nib" class="form-control @error('nib') is-invalid @enderror"
                        name="nib" value="{{ old('nib') ?? ($terapi->nib ?? '') }}" hidden>
                    <input type="text" id="status" class="form-control @error('status') is-invalid @enderror"
                        name="status" value="{{ old('status') ?? ($terapi->status ?? '') }}" hidden>
                </div>
                <div class="form-group row">
                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            autofocus value="{{ old('nama') ?? ($terapi->nama ?? '') }}" placeholder="Inputkan nama">
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" autofocus>{{ old('alamat') ?? ($terapi->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            id="exampleInputConfirmPassword2" name="tanggal_lahir"
                            value="{{ old('tanggal_lahir') ?? ($terapi->tanggal_lahir ?? '') }}">
                        @error('tanggal_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Telepon</label>
                    <div class="col-sm-9">
                        <input type="number" name="telepon" class="form-control" id="exampleInputConfirmPassword2"
                            value="{{ old('telepon') ?? ($terapi->telepon ?? '') }}" placeholder="08xxxxxxxxxx">
                    </div>
                </div>
                @isset($terapi)
                    <input type="hidden" name="url_asal"
                        value="{{ old('url_asal') ?? url()->previous() . '#row-' . $terapi->id }}">
                @else
                    <input type="hidden" name="url_asal" value="{{ old('url_asal') ?? url()->previous() }}">
                @endisset
                <button type="submit" class="btn btn-gradient-primary me-2">{{ $tombol }}</button>
                <a href="{{ route('terapis.index') }}" class="btn btn-light">Cancel</a>
            </div>
        </div>
    </div>
</div>

{{-- Trik agar bisa kembali ke halaman yang klik --}}
