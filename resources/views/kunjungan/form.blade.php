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
<div class="row" id="tambah">
    <div class="col-md-8">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Program</label>
            <div class="col-sm-9">
                <select class="js-example-basic-single" style="width:100%" name="program_id">
                    @foreach ($program as $p)
                        <option value="{{ $p->id }}">{{ $p->deskripsi }}</option>
                    @endforeach
                </select>
            </div>
            <label class="col-sm-3 col-form-label">Skala</label>
            <div class="col-sm-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="membershipRadios1"
                            value="dp" checked> DP </label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="membershipRadios2"
                            value="tb"> DS </label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="membershipRadios3"
                            value="tb"> TB </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-2">
        <button type="button" onclick="addForm()" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <div class="col-sm-12">
                <textarea class="form-control " name="keterangan" autofocus placeholder="keterangan" rows="6"></textarea>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-sm btn-gradient-primary me-2">{{ $tombol }}</button>
<a href="{{ url()->previous() }}" class="btn btn-sm btn-light">Cancel</a>
