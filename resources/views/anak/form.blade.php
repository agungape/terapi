@csrf
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            {{-- data anak --}}
            <p class="card-description"> Data Anak </p>
            <div class="row">
                <div class="col-sm-9">
                    <input type="text" id="nib" class="form-control @error('nib') is-invalid @enderror"
                        name="nib" value="{{ old('nib') ?? ($anak->nib ?? '') }}" hidden>
                </div>
                {{-- nama --}}
                <div class="col-md-6">
                    <div class="form-group row">

                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                name="nama" autofocus value="{{ old('nama') ?? ($anak->nama ?? '') }}"
                                placeholder="Inputkan nama">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- gender --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleSelectGender" class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-9">
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="jenis_kelamin"
                                                id="membershipRadios1" value="L"
                                                {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                                            Laki-Laki </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="jenis_kelamin"
                                                id="membershipRadios2" value="P"
                                                {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                                            Perempuan </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- tempat lahir --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="exampleInputConfirmPassword2" name="tempat_lahir"
                                value="{{ old('tempat_lahir') ?? ($anak->tempat_lahir ?? '') }}">
                            @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- tanggal lahir --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-9">
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
                </div>

                {{-- pendidikan --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Pendidikan</label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single" style="width:100%" name="pendidikan">
                                @foreach ($pendidikan as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ $value == old('pendidikan', $anak->pendidikan) ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>

                            @error('pendidikan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- alamat --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('alamat') is-invalid @enderror" rows="4" name="alamat" autofocus>{{ old('alamat') ?? ($anak->alamat ?? '') }}</textarea>
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- anak ke --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Anak ke</label>
                        <div class="col-sm-9">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="anak_ke"
                                        value="{{ old('anak_ke') ?? ($anak->anak_ke ?? '') }}">
                                </div>
                                @error('anak_ke')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">
                                    Dari</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="total_saudara"
                                        value="{{ old('total_saudara') ?? ($anak->total_saudara ?? '') }}">
                                </div>
                                @error('total_saudara')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- diagnosa --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Diagnosa</label>
                        <div class="col-sm-9">
                            <input type="text" name="diagnosa" class="form-control"
                                id="exampleInputConfirmPassword2"
                                value="{{ old('diagnosa') ?? ($anak->diagnosa ?? '') }}"
                                placeholder="kosongkan jika tidak ada">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            {{-- data anak --}}

            {{-- data orang tua --}}
            <p class="card-description"> Data Orang Tua </p>
            <div class="row">
                <div class="col-sm-9">
                    <input type="text" id="nib" class="form-control @error('nib') is-invalid @enderror"
                        name="nib" value="{{ old('nib') ?? ($anak->nib ?? '') }}" hidden>
                </div>

                {{-- nama --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nama Ibu</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror"
                                name="nama_ibu" autofocus value="{{ old('nama_ibu') ?? ($anak->nama_ibu ?? '') }}"
                                placeholder="Inputkan nama">
                            @error('nama_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Nama Ayah</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror"
                                name="nama_ayah" autofocus value="{{ old('nama_ayah') ?? ($anak->nama_ayah ?? '') }}"
                                placeholder="Inputkan nama">
                            @error('nama_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- telpon --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Telp. Ibu</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('telepon_ibu') is-invalid @enderror"
                                name="telepon_ibu" autofocus
                                value="{{ old('telepon_ibu') ?? ($anak->telepon_ibu ?? '') }}"
                                placeholder="08xx-xxxx-xxxx">
                            @error('telepon_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Telp. Ayah</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control @error('telepon_ayah') is-invalid @enderror"
                                name="telepon_ayah" autofocus
                                value="{{ old('telepon_ayah') ?? ($anak->telepon_ayah ?? '') }}"
                                placeholder="08xx-xxxx-xxxx">
                            @error('telepon_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- umur --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Umur Ibu</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('umur_ibu') is-invalid @enderror"
                                name="umur_ibu" autofocus value="{{ old('umur_ibu') ?? ($anak->umur_ibu ?? '') }}"
                                placeholder="XX Tahun">
                            @error('umur_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Umur Ayah</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('umur_ayah') is-invalid @enderror"
                                name="umur_ayah" autofocus value="{{ old('umur_ayah') ?? ($anak->umur_ayah ?? '') }}"
                                placeholder="XX Tahun">
                            @error('umur_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- pendidikan --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Pend. Ibu</label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single" style="width:100%" name="pendidikan_ibu">
                                @foreach ($pendidikan_orangtua as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ $value == old('pendidikan_ibu', $anak->pendidikan_ibu) ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pendidikan_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Pend. Ayah</label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single" style="width:100%" name="pendidikan_ayah">
                                @foreach ($pendidikan_orangtua as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ $value == old('pendidikan_ayah', $anak->pendidikan_ayah) ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pendidikan_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- pekerjaan --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Pekerjaan Ibu</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                name="pekerjaan_ibu" autofocus
                                value="{{ old('pekerjaan_ibu') ?? ($anak->pekerjaan_ibu ?? '') }}">
                            @error('pekerjaan_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Pekerjaan Ayah</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                name="pekerjaan_ayah" autofocus
                                value="{{ old('pekerjaan_ayah') ?? ($anak->pekerjaan_ayah ?? '') }}">
                            @error('pekerjaan_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- agama --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Agama Ibu</label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single" style="width:100%" name="agama_ibu">
                                @foreach ($agama as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ $value == old('agama_ibu', $anak->agama_ibu) ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('agama_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Agama Ayah</label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single" style="width:100%" name="agama_ayah">
                                @foreach ($agama as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ $value == old('agama_ayah', $anak->agama_ayah) ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('agama_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- alamat --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Alamat Ibu</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('alamat_ibu') is-invalid @enderror" rows="4" name="alamat_ibu" autofocus>{{ old('alamat_ibu') ?? ($anak->alamat_ibu ?? '') }}</textarea>
                            @error('alamat_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Alamat Ayah</label>
                        <div class="col-sm-9">
                            <textarea class="form-control @error('alamat_ayah') is-invalid @enderror" rows="4" name="alamat_ayah"
                                autofocus>{{ old('alamat_ayah') ?? ($anak->alamat_ayah ?? '') }}</textarea>
                            @error('alamat_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- suku --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Suku Ibu</label>
                        <div class="col-sm-9">
                            <input type="text" name="suku_ibu" class="form-control"
                                id="exampleInputConfirmPassword2"
                                value="{{ old('suku_ibu') ?? ($anak->suku_ibu ?? '') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Suku Ayah</label>
                        <div class="col-sm-9">
                            <input type="text" name="suku_ayah" class="form-control"
                                id="exampleInputConfirmPassword2"
                                value="{{ old('suku_ayah') ?? ($anak->suku_ayah ?? '') }}">
                        </div>
                    </div>
                </div>

                {{-- pernikahan --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Pernikahan
                            Ke</label>
                        <div class="col-sm-4">
                            <input type="number" name="pernikahan_ibu" class="form-control"
                                id="exampleInputConfirmPassword2"
                                value="{{ old('pernikahan_ibu') ?? ($anak->pernikahan_ibu ?? '') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Pernikahan
                            Ke</label>
                        <div class="col-sm-4">
                            <input type="number" name="pernikahan_ayah" class="form-control"
                                id="exampleInputConfirmPassword2"
                                value="{{ old('pernikahan_ayah') ?? ($anak->pernikahan_ayah ?? '') }}">
                        </div>
                    </div>
                </div>

                {{-- umur saat hamil --}}
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Umur Ibu Saat Hamil</label>
                        <div class="col-sm-9">
                            <input type="text"
                                class="form-control @error('usia_saat_hamil_ibu') is-invalid @enderror"
                                name="usia_saat_hamil_ibu" autofocus
                                value="{{ old('usia_saat_hamil_ibu') ?? ($anak->usia_saat_hamil_ibu ?? '') }}"
                                placeholder="XX Tahun">
                            @error('usia_saat_hamil_ibu')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Umur Ayah Saat Ibu
                            Hamil</label>
                        <div class="col-sm-9">
                            <input type="text"
                                class="form-control @error('usia_saat_hamil_ayah') is-invalid @enderror"
                                name="usia_saat_hamil_ayah" autofocus
                                value="{{ old('usia_saat_hamil_ayah') ?? ($anak->usia_saat_hamil_ayah ?? '') }}"
                                placeholder="XX Tahun">
                            @error('usia_saat_hamil_ayah')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            {{-- data orang tua --}}

            @isset($anak)
                <input type="hidden" name="url_asal"
                    value="{{ old('url_asal') ?? url()->previous() . '#row-' . $anak->id }}">
            @else
                <input type="hidden" name="url_asal" value="{{ old('url_asal') ?? url()->previous() }}">
            @endisset
            <button type="submit" class="btn btn-gradient-primary me-2">{{ $tombol }}</button>
            <a href="{{ url()->previous() }}" class="btn btn-gradient-danger">Cancel</a>
        </div>
    </div>
