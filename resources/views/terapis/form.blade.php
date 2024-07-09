@csrf
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Anak</h4>
                <div class="col-sm-9">
                    <input type="text" id="nib" class="form-control @error('nib') is-invalid @enderror"
                        name="nib" value="{{ old('nib') ?? ($anak->nib ?? '') }}" hidden>
                </div>

                <div class="form-group row">
                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            autofocus value="{{ old('nama') ?? ($anak->nama ?? '') }}" placeholder="Inputkan nama">
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Wali Anak</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('wali') is-invalid @enderror" name="wali"
                            autofocus value="{{ old('wali') ?? ($anak->wali ?? '') }}" placeholder="wali anak">
                        @error('wali')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" autofocus>{{ old('alamat') ?? ($anak->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Diagnosa</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="diagnosa"
                            value="{{ old('diagnosa') ?? ($anak->diagnosa ?? '') }}" placeholder="diagnosa">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            id="exampleInputConfirmPassword2" name="tanggal_lahir"
                            value="{{ old('tanggal_lahir') ?? ($anak->tanggal_lahir ?? '') }}">
                        @error('tanggal_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleSelectGender" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-4">
                        <select name="jenis_kelamin" class="form-select">
                            <option value="L"
                                {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                Laki-Laki</option>
                            <option value="P"
                                {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Telepon</label>
                    <div class="col-sm-9">
                        <input type="number" name="telepon" class="form-control" id="exampleInputConfirmPassword2"
                            value="{{ old('telepon') ?? ($anak->telepon ?? '') }}" placeholder="08xxxxxxxxxx">
                    </div>
                </div>

                @isset($anak)
                    <input type="hidden" name="url_asal"
                        value="{{ old('url_asal') ?? url()->previous() . '#row-' . $anak->id }}">
                @else
                    <input type="hidden" name="url_asal" value="{{ old('url_asal') ?? url()->previous() }}">
                @endisset

                <button type="submit" class="btn btn-gradient-primary me-2">{{ $tombol }}</button>
                <a href="{{ route('anak.index') }}" class="btn btn-light">Cancel</a>
            </div>
        </div>
    </div>
</div>

{{-- Trik agar bisa kembali ke halaman yang klik --}}
