@csrf

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
                                <div class="step-progress mb-4">
                                    <ul class="nav nav-pills nav-fill">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#data-umum" data-toggle="tab">
                                                <span class="step-icon"><i class="fas fa-user"></i></span>
                                                <span>Data Umum</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#observasi" data-toggle="tab">
                                                <span class="step-icon"><i class="fas fa-eye"></i></span>
                                                <span>Observasi</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#hasil-diagnosa" data-toggle="tab">
                                                <span class="step-icon"><i class="fas fa-stethoscope"></i></span>
                                                <span>Hasil & Diagnosa</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#rekomendasi" data-toggle="tab">
                                                <span class="step-icon"><i
                                                        class="fas fa-hand-holding-medical"></i></span>
                                                <span>Rekomendasi</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#dokumen" data-toggle="tab">
                                                <span class="step-icon"><i class="fas fa-file-signature"></i></span>
                                                <span>Persetujuan</span>
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
                                                                    value="{{ $psikologs->id }}">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $psikologs->nama }}" readonly>
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
                                                            <label for="tanggal_assessment" class="form-label">
                                                                <i class="far fa-calendar-check mr-1"></i> Tanggal
                                                                Pemeriksaan <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="date"
                                                                class="form-control @error('tanggal_assessment') is-invalid @enderror"
                                                                name="tanggal_assessment" id="tanggal_assessment"
                                                                value="{{ old('tanggal_assessment', date('Y-m-d')) }}"
                                                                required>
                                                            @error('tanggal_assessment')
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
                                                    <label class="form-label">
                                                        <i class="fas fa-clipboard-list mr-1"></i> Sumber Asesmen <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div id="sumber-asesmen-container">
                                                        <!-- Input fields will be added here -->
                                                        <div class="mb-3 position-relative">
                                                            <input type="text"
                                                                class="form-control input-sumber-asesmen @error('sumber_asesmen') is-invalid @enderror"
                                                                name="sumber_asesmen[]"
                                                                placeholder="Contoh: Observasi anak" required
                                                                value="{{ old('sumber_asesmen.0') }}">
                                                            <button
                                                                class="btn btn-sm btn-outline-danger btn-remove-sumber position-absolute"
                                                                style="right: 5px; top: 5px;" type="button" disabled>
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <button type="button" id="btn-tambah-sumber"
                                                        class="btn btn-sm btn-primary mt-2">
                                                        <i class="fas fa-plus mr-1"></i> Tambah Sumber
                                                    </button>
                                                    <small class="form-text text-muted">
                                                        Contoh: Observasi anak, wawancara orang tua, dokumen medis, dll.
                                                    </small>

                                                    <!-- Hidden field for combined results -->
                                                    <input type="hidden" id="sumber_asesmen_combined"
                                                        name="sumber_asesmen_combined">

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
                                                    <label class="form-label">
                                                        <i class="fas fa-comment-medical mr-1"></i>
                                                        Observasi Awal Anak <span class="text-danger">*</span>
                                                    </label>
                                                    <div id="perilaku-container">
                                                        <!-- Input fields will be added here -->
                                                        <div class="mb-3 position-relative">
                                                            <input type="text"
                                                                class="form-control input-perilaku @error('perilaku') is-invalid @enderror"
                                                                name="perilaku[]" placeholder="Masukkan perilaku khas"
                                                                required value="{{ old('perilaku.0') }}">
                                                            <button
                                                                class="btn btn-sm btn-outline-danger btn-remove position-absolute"
                                                                style="right: 5px; top: 5px;" type="button" disabled>
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <button type="button" id="btn-tambah-perilaku"
                                                        class="btn btn-sm btn-primary mt-2">
                                                        <i class="fas fa-plus mr-1"></i> Tambah Perilaku
                                                    </button>
                                                    <small class="form-text text-muted">
                                                        Contoh: Penolakan, cemas, kurang fokus, menghindar saat
                                                        diberikan tugas, dll.
                                                    </small>

                                                    <!-- Hidden field for combined results -->
                                                    <input type="hidden" id="perilaku_combined"
                                                        name="perilaku_combined">

                                                    @error('perilaku')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="kesimpulan_observasi" class="form-label">
                                                        <i class="fas fa-comment-medical mr-1"></i> Kesimpulan
                                                        Observasi
                                                        Awal
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control @error('kesimpulan_observasi') is-invalid @enderror" id="kesimpulan_observasi"
                                                        name="kesimpulan_observasi" rows="3" placeholder="Kesimpulan perilaku yang diamati selama assessment..."
                                                        required>{{ old('kesimpulan_observasi') }}</textarea>
                                                    @error('kesimpulan_observasi')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
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
                                                    <label class="form-label">
                                                        <i class="fas fa-clipboard-check mr-1"></i> Hasil Pemeriksaan
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div id="hasil-pemeriksaan-container">
                                                        <!-- Textarea fields will be added here -->
                                                        <div class="mb-3 position-relative">
                                                            <textarea class="form-control input-hasil-pemeriksaan @error('hasil_pemeriksaan') is-invalid @enderror"
                                                                name="hasil_pemeriksaan[]" rows="2" placeholder="Analisis hasil observasi dan pemeriksaan..." required>{{ old('hasil_pemeriksaan.0') }}</textarea>
                                                            <button
                                                                class="btn btn-sm btn-outline-danger btn-remove-hasil position-absolute"
                                                                style="right: 5px; top: 5px;" type="button" disabled>
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>




                                                    <button type="button" id="btn-tambah-hasil"
                                                        class="btn btn-sm btn-primary mt-2">
                                                        <i class="fas fa-plus mr-1"></i> Tambah Analisis
                                                    </button>
                                                    <small class="form-text text-muted">
                                                        Contoh: Penolakan yang sering ditunjukkan anak kemungkinan besar
                                                        merupakan bentuk pertahanan diri terhadap aktivitas yang dirasa
                                                        sulit...
                                                    </small>

                                                    <!-- Hidden field for combined results -->
                                                    <textarea class="d-none" id="hasil_pemeriksaan_combined" name="hasil_pemeriksaan_combined"></textarea>

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
                                                <!-- Rekomendasi untuk Orang Tua/Keluarga -->
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        <i class="fas fa-home mr-1"></i> Rekomendasi untuk Orang
                                                        Tua/Keluarga
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div id="rekomendasi-orangtua-container">
                                                        <!-- Textarea fields will be added here -->
                                                        <div class="mb-3 position-relative">
                                                            <textarea class="form-control input-rekomendasi @error('rekomendasi_orangtua') is-invalid @enderror"
                                                                name="rekomendasi_orangtua[]" rows="2" placeholder="Contoh: Bangun rutinitas yang tetap..." required>{{ old('rekomendasi_orangtua.0') }}</textarea>
                                                            <button
                                                                class="btn btn-sm btn-outline-danger btn-remove-rekomendasi position-absolute"
                                                                style="right: 5px; top: 5px;" type="button" disabled>
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <button type="button" id="btn-tambah-orangtua"
                                                        class="btn btn-sm btn-primary mt-2">
                                                        <i class="fas fa-plus mr-1"></i> Tambah Rekomendasi
                                                    </button>
                                                    <small class="form-text text-muted">
                                                        Contoh: Bangun rutinitas yang tetap, saat anak mulai menyakiti
                                                        diri alihkan perhatian.
                                                    </small>

                                                    <!-- Hidden field for combined results -->
                                                    <textarea class="d-none" id="rekomendasi_orangtua_combined" name="rekomendasi_orangtua_combined"></textarea>

                                                    @error('rekomendasi_orangtua')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <!-- Rekomendasi Terapi/Intervensi -->
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        <i class="fas fa-user-md mr-1"></i> Rekomendasi
                                                        Terapi/Intervensi
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div id="rekomendasi-terapi-container">
                                                        <!-- Textarea fields will be added here -->
                                                        <div class="mb-3 position-relative">
                                                            <textarea class="form-control input-rekomendasi @error('rekomendasi_terapi') is-invalid @enderror"
                                                                name="rekomendasi_terapi[]" rows="2"
                                                                placeholder="Contoh: Terapkan pendekatan sensory integration therapy..." required>{{ old('rekomendasi_terapi.0') }}</textarea>
                                                            <button
                                                                class="btn btn-sm btn-outline-danger btn-remove-rekomendasi position-absolute"
                                                                style="right: 5px; top: 5px;" type="button" disabled>
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <button type="button" id="btn-tambah-terapi"
                                                        class="btn btn-sm btn-primary mt-2">
                                                        <i class="fas fa-plus mr-1"></i> Tambah Rekomendasi
                                                    </button>
                                                    <small class="form-text text-muted">
                                                        Contoh: Terapkan pendekatan sensory integration therapy, latihan
                                                        regulasi diri.
                                                    </small>

                                                    <!-- Hidden field for combined results -->
                                                    <textarea class="d-none" id="rekomendasi_terapi_combined" name="rekomendasi_terapi_combined"></textarea>

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
                                    <!-- Tab 5: Persetujuan Psikolog -->
                                    <div class="tab-pane" id="dokumen">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0"><i class="fas fa-check-circle mr-2"></i>Persetujuan
                                                    Psikolog</h5>
                                            </div>
                                            <div class="card-body">
                                                <!-- Form Persetujuan Psikolog -->
                                                <div class="form-group">
                                                    <label class="form-label d-block">
                                                        <i class="fas fa-user-md mr-1"></i> Apakah Anda sebagai
                                                        psikolog menyetujui penandatanganan dokumen assessment ini?
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="persetujuan_ya"
                                                            name="persetujuan_psikolog"
                                                            class="custom-control-input @error('persetujuan_psikolog') is-invalid @enderror"
                                                            value="1" required>
                                                        <label class="custom-control-label" for="persetujuan_ya">Ya,
                                                            Saya Setuju</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="persetujuan_tidak"
                                                            name="persetujuan_psikolog"
                                                            class="custom-control-input @error('persetujuan_psikolog') is-invalid @enderror"
                                                            value="0">
                                                        <label class="custom-control-label"
                                                            for="persetujuan_tidak">Tidak, Saya Tidak Setuju</label>
                                                    </div>
                                                    @error('persetujuan_psikolog')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <small class="form-text text-muted">
                                                        Dengan memilih "Ya", Anda menyetujui seluruh hasil assessment
                                                        dan rekomendasi yang diberikan.
                                                    </small>
                                                </div>

                                                <!-- Alasan Jika Tidak Setuju (akan muncul dinamis) -->
                                                <div class="form-group" id="alasan-tidak-setuju-group"
                                                    style="display: none;">
                                                    <label for="alasan_tidak_setuju" class="form-label">
                                                        <i class="fas fa-comment-dots mr-1"></i> Alasan Tidak
                                                        Menyetujui
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea class="form-control @error('alasan_tidak_setuju') is-invalid @enderror" id="alasan_tidak_setuju"
                                                        name="alasan_tidak_setuju" rows="3"
                                                        placeholder="Jelaskan alasan Anda tidak menyetujui dokumen assessment ini..."></textarea>
                                                    @error('alasan_tidak_setuju')
                                                        <span class="invalid-feedback" role="alert">
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
