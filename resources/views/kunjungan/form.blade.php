@csrf
<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Terapis</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" readonly value="{{ $kunjungan->terapis->nama }}" />
                <input type="hidden" class="form-control" readonly value="{{ $kunjungan->id }}" name="kunjungan_id" />
            </div>
        </div>
    </div>
</div>
<div class="row" id="form-wrapper">
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Program</label>
            <div class="col-sm-6">
                <select class="form-control select2" style="width:100%" name="program_id[0]">
                    @foreach ($program as $p)
                        <option value="{{ $p->id }}">{{ $p->deskripsi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4"> <button type="button" id="add-button" class="btn btn-sm btn-primary"><i
                        class="fa fa-plus"></i></button></div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="form-group row"><label class="col-sm-3 col-form-label">Skala</label>
            <div class="col-sm-3">
                <div class="icheck-primary">
                    <input type="radio" id="radioPrimary1" name="status[0]" value="dp">
                    <label for="radioPrimary1"> DP
                    </label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="icheck-primary">
                    <input type="radio" id="radioPrimary2" name="status[0]" value="ds">
                    <label for="radioPrimary2"> DS
                    </label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="icheck-primary">
                    <input type="radio" id="radioPrimary3" name="status[0]" value="tb">
                    <label for="radioPrimary3"> TB
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="col-sm-12">
                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" autofocus
                    placeholder="keterangan" rows="6"></textarea>
            </div>
            @error('keterangan')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<button type="submit" class="btn btn-sm btn-primary me-2">{{ $tombol }}</button>
<a href="{{ url()->previous() }}" class="btn btn-sm btn-warning">Cancel</a>
