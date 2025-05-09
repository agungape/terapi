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
                                <!-- Pilih Anak -->
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Pilih Anak</label>
                                    <div class="col-sm-6">
                                        <select class="form-control @error('anak_id') is-invalid @enderror select2"
                                            style="width:100%" name="anak_id">
                                            @forelse ($anaks as $anak)
                                                <option value="{{ $anak->id }}"
                                                    {{ old('anak_id') == $anak->id || (!old('anak_id') && isset($assessment) && $assessment->anak_id == $anak->id) ? 'selected' : '' }}>
                                                    {{ $anak->nama }}
                                                </option>
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

                                <!-- Pilih Psikolog -->
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Pilih Psikolog</label>
                                    <div class="col-sm-6">
                                        @if ($roles->contains('psikolog'))
                                            <input type="hidden" class="form-control" name="psikolog_id"
                                                value="{{ $psikologs->id }}">
                                            <input type="text" class="form-control" value="{{ $psikologs->nama }}"
                                                disabled>
                                        @else
                                            <select
                                                class="form-control @error('psikolog_id') is-invalid @enderror select2"
                                                style="width:100%" name="psikolog_id">
                                                @forelse ($psikologs as $psikolog)
                                                    <option value="{{ $psikolog->id }}"
                                                        {{ old('psikolog_id') == $psikolog->id || (!old('psikolog_id') && isset($assessment) && $assessment->psikolog_id == $psikolog->id) ? 'selected' : '' }}>
                                                        {{ $psikolog->nama }}
                                                    </option>
                                                @empty
                                                    <option>tidak ada data</option>
                                                @endforelse
                                            </select>
                                            @error('psikolog_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endif

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="file_assessment" class="col-sm-2 col-form-label">Upload Hasil</label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('file_assessment') is-invalid @enderror"
                                                    name="file_assessment" id="file_assessment"
                                                    accept="application/pdf">
                                                <label class="custom-file-label" for="file_assessment">Pilih
                                                    file</label>
                                            </div>
                                        </div>
                                        @error('file_assessment')
                                            <span class="text-danger small d-block mt-1">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        @if (!empty($assessment->file_assessment))
                                            <div class="mt-3">
                                                <a href="{{ asset('storage/hasil-assessment/' . $assessment->file_assessment) }}"
                                                    target="_blank" class="btn btn-sm btn-primary">
                                                    Lihat File: {{ basename($assessment->file_assessment) }}
                                                </a>
                                            </div>
                                        @endif
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
