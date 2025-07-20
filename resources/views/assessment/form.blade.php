@csrf

{{-- <div class="content-wrapper">
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
</div> --}}

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-primary"><i class="fas fa-clipboard-check mr-2"></i>Form Assessment Psikologis</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active">Assessment Anak</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-file-medical mr-2"></i>Formulir Pemeriksaan Psikologis</h3>
                </div>
                <form method="POST" action="{{ route('assessment.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Multi-step form navigation -->
                                <div class="mb-4">
                                    <ul class="nav nav-pills nav-fill step-progress">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#data-umum" data-toggle="tab">
                                                <span class="step-icon"><i class="fas fa-user"></i></span>
                                                <span class="d-none d-sm-inline">Data Umum</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#observasi" data-toggle="tab">
                                                <span class="step-icon"><i class="fas fa-eye"></i></span>
                                                <span class="d-none d-sm-inline">Observasi</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#hasil-diagnosa" data-toggle="tab">
                                                <span class="step-icon"><i class="fas fa-stethoscope"></i></span>
                                                <span class="d-none d-sm-inline">Hasil & Diagnosa</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#rekomendasi" data-toggle="tab">
                                                <span class="step-icon"><i
                                                        class="fas fa-hand-holding-medical"></i></span>
                                                <span class="d-none d-sm-inline">Rekomendasi</span>
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
                                    <!-- Tab 1: Data Umum -->
                                    <div class="tab-pane active" id="data-umum">
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0"><i class="fas fa-user-circle mr-2"></i>Data Klien
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nama_anak" class="form-label">
                                                                <i class="fas fa-child mr-1"></i> Nama Anak <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <select
                                                                class="form-control select2 @error('anak_id') is-invalid @enderror"
                                                                name="anak_id" id="nama_anak" required>
                                                                <option value="">-- Pilih Anak --</option>
                                                                @foreach ($anaks as $anak)
                                                                    <option value="{{ $anak->id }}"
                                                                        {{ old('anak_id') == $anak->id ? 'selected' : '' }}>
                                                                        {{ $anak->nama }}
                                                                        {{-- ({{ $anak->tanggal_lahir->age }} tahun) --}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('anak_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="psikolog_id" class="form-label">
                                                                <i class="fas fa-user-md mr-1"></i> Psikolog <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            @if ($roles->contains('psikolog'))
                                                                <input type="hidden" name="psikolog_id"
                                                                    value="{{ auth()->user()->id }}">
                                                                <input type="text" class="form-control"
                                                                    value="{{ auth()->user()->nama }}" readonly>
                                                            @else
                                                                <select
                                                                    class="form-control select2 @error('psikolog_id') is-invalid @enderror"
                                                                    name="psikolog_id" required>
                                                                    <option value="">-- Pilih Psikolog --
                                                                    </option>
                                                                    @foreach ($psikologs as $psikolog)
                                                                        <option value="{{ $psikolog->id }}"
                                                                            {{ old('psikolog_id') == $psikolog->id ? 'selected' : '' }}>
                                                                            {{ $psikolog->nama }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('psikolog_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tanggal_pemeriksaan" class="form-label">
                                                                <i class="far fa-calendar-check mr-1"></i> Tanggal
                                                                Pemeriksaan <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="date"
                                                                class="form-control @error('tanggal_pemeriksaan') is-invalid @enderror"
                                                                name="tanggal_pemeriksaan" id="tanggal_pemeriksaan"
                                                                value="{{ old('tanggal_pemeriksaan', date('Y-m-d')) }}"
                                                                required>
                                                            @error('tanggal_pemeriksaan')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="tujuan_pemeriksaan" class="form-label">
                                                        <i class="fas fa-bullseye mr-1"></i> Tujuan Pemeriksaan <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control @error('tujuan_pemeriksaan') is-invalid @enderror" id="tujuan_pemeriksaan"
                                                        name="tujuan_pemeriksaan" rows="2"
                                                        placeholder="Contoh: Assesmen psikologis/penegakan diagnosis awal anak sebelum pemberian terapi" required>{{ old('tujuan_pemeriksaan') }}</textarea>
                                                    @error('tujuan_pemeriksaan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="sumber_asesmen" class="form-label">
                                                        <i class="fas fa-clipboard-list mr-1"></i> Sumber Asesmen <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control @error('sumber_asesmen') is-invalid @enderror" id="sumber_asesmen"
                                                        name="sumber_asesmen" rows="2" placeholder="Contoh: Observasi anak dan wawancara orang tua" required>{{ old('sumber_asesmen') }}</textarea>
                                                    @error('sumber_asesmen')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="text-right mt-3">
                                                    <button type="button" class="btn btn-primary next-tab"
                                                        data-next="observasi">
                                                        Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tab 2: Observasi -->
                                    <div class="tab-pane" id="observasi">
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0"><i class="fas fa-eye mr-2"></i>Hasil Observasi Awal
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="observasi_awal" class="form-label">
                                                        <i class="fas fa-comment-medical mr-1"></i> Deskripsi Observasi
                                                        Perilaku <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control @error('observasi_awal') is-invalid @enderror" id="observasi_awal"
                                                        name="observasi_awal" rows="6" placeholder="Deskripsikan perilaku yang diamati selama assessment..."
                                                        required>{{ old('observasi_awal') }}</textarea>
                                                    <small class="form-text text-muted">
                                                        Contoh: Anak banyak melakukan penolakan, cemas, kurang fokus,
                                                        menghindar saat diberikan tugas, tidak mampu menyelesaikan
                                                        perhitungan sederhana, dll.
                                                    </small>
                                                    @error('observasi_awal')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label"><i class="fas fa-check-circle mr-1"></i>
                                                        Checklist Perilaku Khas</label>
                                                    <div class="border p-3 rounded bg-light">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="penolakan" name="perilaku[]"
                                                                        value="Penolakan">
                                                                    <label class="form-check-label"
                                                                        for="penolakan">Banyak melakukan
                                                                        penolakan</label>
                                                                </div>
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="cemas" name="perilaku[]"
                                                                        value="Cemas">
                                                                    <label class="form-check-label"
                                                                        for="cemas">Cemas dan penuh
                                                                        ketakutan</label>
                                                                </div>
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="fokus" name="perilaku[]"
                                                                        value="Kurang fokus">
                                                                    <label class="form-check-label"
                                                                        for="fokus">Kurang fokus dan
                                                                        perhatian</label>
                                                                </div>
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="menghindar" name="perilaku[]"
                                                                        value="Menghindar tugas">
                                                                    <label class="form-check-label"
                                                                        for="menghindar">Menghindar saat diberikan
                                                                        tugas</label>
                                                                </div>
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="perhitungan" name="perilaku[]"
                                                                        value="Kesulitan perhitungan">
                                                                    <label class="form-check-label"
                                                                        for="perhitungan">Tidak mampu menyelesaikan
                                                                        perhitungan sederhana</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="sensory" name="perilaku[]"
                                                                        value="Hipersensitivitas sensorik">
                                                                    <label class="form-check-label"
                                                                        for="sensory">Hipersensitivitas sensorik
                                                                        (tekstur, suara, dll)</label>
                                                                </div>
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="menyakiti_diri" name="perilaku[]"
                                                                        value="Menyakiti diri">
                                                                    <label class="form-check-label"
                                                                        for="menyakiti_diri">Perilaku menyakiti diri
                                                                        sendiri</label>
                                                                </div>
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="kemandirian" name="perilaku[]"
                                                                        value="Kemandirian rendah">
                                                                    <label class="form-check-label"
                                                                        for="kemandirian">Kemandirian rendah</label>
                                                                </div>
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="pertumbuhan" name="perilaku[]"
                                                                        value="Pertumbuhan tidak sesuai">
                                                                    <label class="form-check-label"
                                                                        for="pertumbuhan">Pertumbuhan fisik tidak
                                                                        sesuai usia</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="lainnya" name="perilaku[]"
                                                                        value="Lainnya">
                                                                    <label class="form-check-label"
                                                                        for="lainnya">Perilaku lainnya</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="text-right mt-3">
                                                    <button type="button" class="btn btn-secondary prev-tab"
                                                        data-prev="data-umum">
                                                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                                                    </button>
                                                    <button type="button" class="btn btn-primary next-tab"
                                                        data-next="hasil-diagnosa">
                                                        Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tab 3: Hasil & Diagnosa -->
                                    <div class="tab-pane" id="hasil-diagnosa">
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0"><i class="fas fa-stethoscope mr-2"></i>Hasil
                                                    Pemeriksaan & Diagnosa</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="hasil_pemeriksaan" class="form-label">
                                                        <i class="fas fa-clipboard-check mr-1"></i> Hasil Pemeriksaan
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control @error('hasil_pemeriksaan') is-invalid @enderror" id="hasil_pemeriksaan"
                                                        name="hasil_pemeriksaan" rows="6" placeholder="Analisis hasil observasi dan pemeriksaan..." required>{{ old('hasil_pemeriksaan') }}</textarea>
                                                    <small class="form-text text-muted">
                                                        Contoh: Penolakan yang sering ditunjukkan anak kemungkinan besar
                                                        merupakan bentuk pertahanan diri terhadap aktivitas yang dirasa
                                                        sulit...
                                                    </small>
                                                    @error('hasil_pemeriksaan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="diagnosa" class="form-label">
                                                        <i class="fas fa-diagnoses mr-1"></i> Diagnosa Awal <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control @error('diagnosa') is-invalid @enderror" id="diagnosa" name="diagnosa" rows="4"
                                                        placeholder="Tuliskan diagnosa awal berdasarkan hasil pemeriksaan..." required>{{ old('diagnosa') }}</textarea>
                                                    <small class="form-text text-muted">
                                                        Contoh: Anak menunjukkan karakteristik yang konsisten dengan
                                                        Down Syndrome dan Intellectual Disability tingkat sedang-berat.
                                                    </small>
                                                    @error('diagnosa')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="text-right mt-3">
                                                    <button type="button" class="btn btn-secondary prev-tab"
                                                        data-prev="observasi">
                                                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                                                    </button>
                                                    <button type="button" class="btn btn-primary next-tab"
                                                        data-next="rekomendasi">
                                                        Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tab 4: Rekomendasi -->
                                    <div class="tab-pane" id="rekomendasi">
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0"><i
                                                        class="fas fa-hand-holding-medical mr-2"></i>Rekomendasi
                                                    Penanganan</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="rekomendasi_orangtua" class="form-label">
                                                        <i class="fas fa-home mr-1"></i> Rekomendasi untuk Orang
                                                        Tua/Keluarga <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control @error('rekomendasi_orangtua') is-invalid @enderror" id="rekomendasi_orangtua"
                                                        name="rekomendasi_orangtua" rows="4" placeholder="Berikan rekomendasi untuk orang tua/keluarga..."
                                                        required>{{ old('rekomendasi_orangtua') }}</textarea>
                                                    <small class="form-text text-muted">
                                                        Contoh: Bangun rutinitas yang tetap, saat anak mulai menyakiti
                                                        diri alihkan perhatian, latih aktivitas sederhana secara rutin.
                                                    </small>
                                                    @error('rekomendasi_orangtua')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="rekomendasi_terapi" class="form-label">
                                                        <i class="fas fa-user-md mr-1"></i> Rekomendasi
                                                        Terapi/Intervensi <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control @error('rekomendasi_terapi') is-invalid @enderror" id="rekomendasi_terapi"
                                                        name="rekomendasi_terapi" rows="4" placeholder="Berikan rekomendasi terapi atau intervensi..." required>{{ old('rekomendasi_terapi') }}</textarea>
                                                    <small class="form-text text-muted">
                                                        Contoh: Terapkan pendekatan sensory integration therapy, latihan
                                                        regulasi diri, fokus pada ADL.
                                                    </small>
                                                    @error('rekomendasi_terapi')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="catatan_tambahan" class="form-label">
                                                        <i class="fas fa-sticky-note mr-1"></i> Catatan Tambahan
                                                    </label>
                                                    <textarea class="form-control @error('catatan_tambahan') is-invalid @enderror" id="catatan_tambahan"
                                                        name="catatan_tambahan" rows="3" placeholder="Tambahkan catatan lain yang diperlukan...">{{ old('catatan_tambahan') }}</textarea>
                                                    @error('catatan_tambahan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="text-right mt-3">
                                                    <button type="button" class="btn btn-secondary prev-tab"
                                                        data-prev="hasil-diagnosa">
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

                                    <!-- Tab 5: Dokumen -->
                                    <div class="tab-pane" id="dokumen">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0"><i class="fas fa-file-upload mr-2"></i>Unggah
                                                    Dokumen</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="file_assessment" class="form-label">
                                                        <i class="fas fa-file-pdf mr-1"></i> Upload Hasil Assessment
                                                        <small class="text-muted">(Format PDF, maks. 5MB)</small>
                                                    </label>
                                                    <div class="custom-file">
                                                        <input type="file"
                                                            class="custom-file-input @error('file_assessment') is-invalid @enderror"
                                                            name="file_assessment" id="file_assessment"
                                                            accept="application/pdf">
                                                        <label class="custom-file-label" for="file_assessment">Pilih
                                                            file PDF</label>
                                                    </div>
                                                    @error('file_assessment')
                                                        <span class="text-danger small d-block mt-1">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="foto_anak" class="form-label">
                                                        <i class="fas fa-camera mr-1"></i> Upload Foto Anak <small
                                                            class="text-muted">(Opsional, format JPG/PNG, maks.
                                                            2MB)</small>
                                                    </label>
                                                    <div class="custom-file">
                                                        <input type="file"
                                                            class="custom-file-input @error('foto_anak') is-invalid @enderror"
                                                            name="foto_anak" id="foto_anak"
                                                            accept="image/jpeg,image/png">
                                                        <label class="custom-file-label" for="foto_anak">Pilih file
                                                            gambar</label>
                                                    </div>
                                                    @error('foto_anak')
                                                        <span class="text-danger small d-block mt-1">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="text-right mt-4">
                                                    <button type="button" class="btn btn-secondary prev-tab"
                                                        data-prev="rekomendasi">
                                                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                                                    </button>
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fas fa-save mr-1"></i> Simpan Assessment
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
                </form>
            </div>
        </div>
    </section>
</div>
