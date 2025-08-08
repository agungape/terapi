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
<div class="row" id="form-fisioterapi">
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Program</label>
            <div class="col-sm-6">
                <select class="form-control select2" style="width:100%" name="program_id[0]">
                    @foreach ($program_fisioterapi as $f)
                        <option value="{{ $f->id }}">{{ $f->deskripsi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4"> <button type="button" id="add-button-fisioterapi" class="btn btn-sm btn-primary"><i
                        class="fa fa-plus"></i></button></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Aktivitas Terapi</label>
            <div class="col-sm-6">
                <textarea class="form-control @error('aktivitas_terapi') is-invalid @enderror" name="aktivitas_terapi[0]" autofocus
                    placeholder="aktivitas_terapi" rows="3"></textarea>
                @error('aktivitas_terapi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Evaluasi</label>
            <div class="col-sm-10">
                <textarea class="form-control @error('evaluasi') is-invalid @enderror" name="evaluasi" autofocus placeholder="evaluasi"
                    rows="3"></textarea>
                @error('evaluasi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Catatan Khusus</label>
            <div class="col-sm-10">
                <textarea class="form-control @error('catatan_khusus') is-invalid @enderror" name="catatan_khusus" autofocus
                    placeholder="catatan_khusus" rows="3"></textarea>
                @error('catatan_khusus')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

        </div>
    </div>
</div>



<button type="submit" class="btn btn-sm btn-primary me-2">{{ $tombol }}</button>
