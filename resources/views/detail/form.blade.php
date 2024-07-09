@csrf
<div class="card-body">
    <div class="form-group">
        <label for="path" class="mb-1">Pilih File</label>
        <div class="col-sm-12">
            <div class="custom-file">
                <input type="file" id="path" name="path" accept="application/pdf"
                    class="custom-file-input form-control @error('path') is-invalid @enderror">
                @error('path')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group mt-2">
        <label for="nama" class="mb-1">Keterangan</label>
        <input type="text" id="nama" class="form-control @error('keterangan') is-invalid @enderror"
            name="nama" placeholder="Isikan Keterangan Bila ada...." value="{{ old('nama') }}">
        @error('keterangan')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
