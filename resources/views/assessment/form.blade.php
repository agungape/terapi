@csrf

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-primary"><i class="fas fa-clipboard-check mr-2"></i>Assessment Anak</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active">Form Assessment Anak</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-file-medical mr-2"></i>Form Assessment Anak</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Multi-step form navigation -->
                            <div class="mb-4">
                                <ul class="nav nav-pills nav-fill step-progress">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#data-assessment" data-toggle="tab">
                                            <span class="step-icon"><i class="fas fa-user-md"></i></span>
                                            <span class="d-none d-sm-inline">Data Assessment</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#diagnosa-rekomendasi" data-toggle="tab">
                                            <span class="step-icon"><i class="fas fa-stethoscope"></i></span>
                                            <span class="d-none d-sm-inline">Diagnosa & Rekomendasi</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tindak-lanjut" data-toggle="tab">
                                            <span class="step-icon"><i class="fas fa-clipboard-list"></i></span>
                                            <span class="d-none d-sm-inline">Catatan & Tindak Lanjut</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#dokumen" data-toggle="tab">
                                            <span class="step-icon"><i class="fas fa-file-upload"></i></span>
                                            <span class="d-none d-sm-inline">Dokumen</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <!-- Tab 1: Data Assessment -->
                                <div class="tab-pane active" id="data-assessment">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-user-circle mr-2"></i>Data Anak &
                                                Psikolog</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="anak_id" class="form-label">
                                                            <i class="fas fa-child mr-1"></i> Nama Anak <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select
                                                            class="form-control select2 @error('anak_id') is-invalid @enderror"
                                                            style="width:100%" name="anak_id" id="anak_id" required>
                                                            <option value="">-- Pilih Anak --</option>
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="psikolog_id" class="form-label">
                                                            <i class="fas fa-user-md mr-1"></i> Psikolog <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        @if ($roles->contains('psikolog'))
                                                            <input type="hidden" name="psikolog_id"
                                                                value="{{ $psikologs->id }}">
                                                            <input type="text" class="form-control"
                                                                value="{{ $psikologs->nama }}" disabled>
                                                        @else
                                                            <select
                                                                class="form-control select2 @error('psikolog_id') is-invalid @enderror"
                                                                style="width:100%" name="psikolog_id" id="psikolog_id"
                                                                required>
                                                                <option value="">-- Pilih Psikolog --</option>
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
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="tanggal_assessment" class="form-label">
                                                            <i class="far fa-calendar-alt mr-1"></i> Tanggal Assessment
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="input-group date" id="reservationdate"
                                                            data-target-input="nearest">
                                                            <input type="date"
                                                                class="form-control @error('tanggal_assessment') is-invalid @enderror"
                                                                name="tanggal_assessment" id="tanggal_assessment"
                                                                value="{{ old('tanggal_assessment', isset($assessment) ? date('Y-m-d', strtotime($assessment->tanggal_assessment)) : '') }}">
                                                            @error('tanggal_assessment')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="assessment_awal" class="form-label">
                                                    <i class="fas fa-comment-medical mr-1"></i> Assessment Awal
                                                    (Keluhan/Kondisi) <span class="text-danger">*</span>
                                                </label>
                                                <textarea class="form-control @error('assessment_awal') is-invalid @enderror" id="assessment_awal"
                                                    name="assessment_awal" rows="4" placeholder="Deskripsikan keluhan atau kondisi awal anak..." required>{{ old('assessment_awal') ?? (isset($assessment) ? $assessment->assessment_awal : '') }}</textarea>
                                                @error('assessment_awal')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="text-right mt-3">
                                                <button type="button" class="btn btn-primary next-tab"
                                                    data-next="diagnosa-rekomendasi">
                                                    Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab 2: Diagnosa & Rekomendasi -->
                                <div class="tab-pane" id="diagnosa-rekomendasi">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-stethoscope mr-2"></i>Diagnosa &
                                                Rekomendasi</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="diagnosa" class="form-label">
                                                    <i class="fas fa-heartbeat mr-1"></i> Diagnosa
                                                </label>
                                                <textarea class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" name="diagnosa" rows="4"
                                                    placeholder="Masukkan diagnosa hasil assessment...">{{ old('diagnosa') ?? (isset($assessment) ? $assessment->diagnosa : '') }}</textarea>
                                                @error('diagnosa')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="rekomendasi" class="form-label">
                                                    <i class="fas fa-hand-holding-medical mr-1"></i> Rekomendasi
                                                </label>
                                                <textarea class="form-control @error('rekomendasi') is-invalid @enderror" id="rekomendasi" name="rekomendasi"
                                                    rows="4" placeholder="Berikan rekomendasi terapi atau penanganan...">{{ old('rekomendasi') ?? (isset($assessment) ? $assessment->rekomendasi : '') }}</textarea>
                                                @error('rekomendasi')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="text-right mt-3">
                                                <button type="button" class="btn btn-secondary prev-tab"
                                                    data-prev="data-assessment">
                                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                                </button>
                                                <button type="button" class="btn btn-primary next-tab"
                                                    data-next="tindak-lanjut">
                                                    Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab 3: Catatan & Tindak Lanjut -->
                                <div class="tab-pane" id="tindak-lanjut">
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-clipboard-list mr-2"></i>Catatan &
                                                Tindak Lanjut</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="catatan_tambahan" class="form-label">
                                                    <i class="fas fa-sticky-note mr-1"></i> Catatan Tambahan
                                                </label>
                                                <textarea class="form-control @error('catatan_tambahan') is-invalid @enderror" id="catatan_tambahan"
                                                    name="catatan_tambahan" rows="4" placeholder="Tambahkan catatan atau observasi tambahan...">{{ old('catatan_tambahan') ?? (isset($assessment) ? $assessment->catatan_tambahan : '') }}</textarea>
                                                @error('catatan_tambahan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="tindak_lanjut" class="form-label">
                                                    <i class="fas fa-tasks mr-1"></i> Rencana Tindak Lanjut
                                                </label>
                                                <textarea class="form-control @error('tindak_lanjut') is-invalid @enderror" id="tindak_lanjut" name="tindak_lanjut"
                                                    rows="4" placeholder="Jelaskan rencana tindak lanjut atau follow-up...">{{ old('tindak_lanjut') ?? (isset($assessment) ? $assessment->tindak_lanjut : '') }}</textarea>
                                                @error('tindak_lanjut')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="text-right mt-3">
                                                <button type="button" class="btn btn-secondary prev-tab"
                                                    data-prev="diagnosa-rekomendasi">
                                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                                </button>
                                                <button type="button" class="btn btn-primary next-tab"
                                                    data-next="dokumen">
                                                    Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab 4: Dokumen -->
                                <div class="tab-pane" id="dokumen">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-file-upload mr-2"></i>Unggah Dokumen
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="file_assessment" class="form-label">
                                                    <i class="fas fa-file-pdf mr-1"></i> Upload Hasil Assessment <small
                                                        class="text-muted">(Format PDF)</small>
                                                </label>
                                                <div class="custom-file">
                                                    <input type="file"
                                                        class="custom-file-input @error('file_assessment') is-invalid @enderror"
                                                        name="file_assessment" id="file_assessment"
                                                        accept="application/pdf">
                                                    <label class="custom-file-label" for="file_assessment">Pilih
                                                        file</label>
                                                </div>
                                                <small class="form-text text-muted">File maksimal 5MB</small>
                                                @error('file_assessment')
                                                    <span class="text-danger small d-block mt-1">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                @if (!empty($assessment->file_assessment))
                                                    <div class="mt-3">
                                                        <div class="document-preview p-3 bg-light rounded">
                                                            <div class="d-flex align-items-center">
                                                                <i class="far fa-file-pdf text-danger fa-2x mr-3"></i>
                                                                <div>
                                                                    <p class="mb-0">
                                                                        <strong>{{ basename($assessment->file_assessment) }}</strong>
                                                                    </p>
                                                                    <small class="text-muted">Diunggah pada:
                                                                        {{ $assessment->updated_at->format('d M Y H:i') }}</small>
                                                                </div>
                                                                <div class="ml-auto">
                                                                    <a href="{{ asset('storage/hasil-assessment/' . $assessment->file_assessment) }}"
                                                                        target="_blank"
                                                                        class="btn btn-sm btn-outline-primary">
                                                                        <i class="fas fa-eye mr-1"></i> Lihat
                                                                    </a>
                                                                    <a href="{{ asset('storage/hasil-assessment/' . $assessment->file_assessment) }}"
                                                                        download
                                                                        class="btn btn-sm btn-outline-success ml-1">
                                                                        <i class="fas fa-download mr-1"></i> Unduh
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="text-right mt-4">
                                                <button type="button" class="btn btn-secondary prev-tab"
                                                    data-prev="tindak-lanjut">
                                                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                                                </button>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-save mr-1"></i> {{ $tombol }}
                                                </button>
                                                <a href="{{ route('assessment.index') }}" class="btn btn-danger">
                                                    <i class="fas fa-times mr-1"></i> Batal
                                                </a>
                                            </div>
                                        </div>
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
