@csrf

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Assessment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Upload Hasil Assessment Anak</li>
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
                                    <label for="inputName" class="col-sm-2 col-form-label">Pilih Anak</label>
                                    <div class="col-sm-6">
                                        <select class="form-control @error('anak_id') is-invalid @enderror select2"
                                            style="width:100%" name="anak_id">
                                            @forelse ($anaks as $anak)
                                                @if ($anak->id == old('anak_id'))
                                                    <option value="{{ $anak->id }}" selected>{{ $anak->nama }}
                                                    </option>
                                                @else
                                                    <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                                                @endif
                                            @empty
                                                <option>tidak ada data</option>
                                            @endforelse
                                        </select>
                                        @error('anak_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Pilih Psikolog</label>
                                    <div class="col-sm-6">
                                        <select class="form-control @error('psikolog_id') is-invalid @enderror select2"
                                            style="width:100%" name="psikolog_id">
                                            @forelse ($psikologs as $psikolog)
                                                @if ($psikolog->id == old('psikolog_id'))
                                                    <option value="{{ $psikolog->id }}" selected>{{ $psikolog->nama }}
                                                    </option>
                                                @else
                                                    <option value="{{ $psikolog->id }}">{{ $psikolog->nama }}</option>
                                                @endif
                                            @empty
                                                <option>tidak ada data</option>
                                            @endforelse
                                        </select>
                                        @error('psikolog_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Upload
                                        Hasil</label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('file_assessment') is-invalid @enderror"
                                                    name="file_assessment" id="gambar_assessment"
                                                    accept="application/pdf" required>
                                                <label class="custom-file-label" for="exampleInputFile">Pilih
                                                    file</label>
                                            </div>
                                            @error('file_assessment')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit"
                                            class="btn btn-primary me-2">{{ $tombol }}</button>
                                        <a href="{{ route('assessment.index') }}" class="btn btn-danger">Cancel</a>
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
