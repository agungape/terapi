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
<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Program</label>
            <div class="col-sm-6">
                <select class="js-example-basic-single" style="width:100%" name="program_id">
                    @foreach ($program as $p)
                        <option value="{{ $p->id }}">{{ $p->deskripsi }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-sm-12">
                <textarea class="form-control " name="subjek" autofocus placeholder="Subjektif"></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-sm-12">
                <textarea class="form-control " name="objek" autofocus placeholder="Objektif"></textarea>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-sm-12">
                <textarea class="form-control " name="assesment" autofocus placeholder="Assesment"></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <div class="col-sm-12">
                <textarea class="form-control " name="planning" autofocus placeholder="Planning"></textarea>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-sm btn-gradient-primary me-2">{{ $tombol }}</button>
<a href="{{ url()->previous() }}" class="btn btn-sm btn-light">Cancel</a>
