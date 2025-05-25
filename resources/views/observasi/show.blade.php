@extends('layouts.master')
@section('menuObservasi', 'active')
@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">

                {{-- FORM UTAMA --}}

                <div class="row">
                    {{-- Kolom Form --}}
                    <div class="col-12 col-md-4">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4 class="card-title">Observasi Anak</h4>
                            </div>
                            <div class="card-body">
                                {{-- Data Anak --}}
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                                    <input type="text" class="form-control" disabled value="{{ $anak->nama }}">
                                </div>

                                <div class="form-group">
                                    <label>Umur</label>
                                    <input type="text" class="form-control" disabled value="{{ $umur }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <div class="row">
                                    <div class="col-md-11">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#hasil"
                                                    data-toggle="tab">Hasil Observasi</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#hpperilaku"
                                                    data-toggle="tab">Hasil Observasi Perilaku</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#hpsensorik"
                                                    data-toggle="tab">Hasil Observasi Sensorik</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#atec"
                                                    data-toggle="tab">Atec</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#pendengaran"
                                                    data-toggle="tab">Penyimpangan Pendengaran</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#penglihatan"
                                                    data-toggle="tab">Penyimpangan Penglihatan</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#perilaku"
                                                    data-toggle="tab">Penyimpangan Perilaku dan Emosional </a></li>
                                            <li class="nav-item"><a class="nav-link" href="#autis"
                                                    data-toggle="tab">AUTIS</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#gpph"
                                                    data-toggle="tab">GPPH</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#wawancara"
                                                    data-toggle="tab">Wawancara</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{ route('observasi.index') }}" class="btn btn-warning btn-sm">
                                            Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="tab-content">

                                    {{-- hasil observasi --}}
                                    <div class="active tab-pane" id="hasil">
                                        <div class="card-body table-responsive p-0">

                                            {{-- Tabel 1: Hasil Observasi Umum --}}
                                            <div class="mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 font-weight-bold">Hasil Observasi</h5>
                                                <table class="table table-hover text-nowrap table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Tanggal</th>
                                                            <th>Jenis Observasi</th>
                                                            <th>Hasil</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($hasil as $h)
                                                            <tr>
                                                                <td>{{ \Carbon\Carbon::parse($h->created_at)->format('d M Y') }}
                                                                </td>
                                                                <td>{{ $h->jenis }}</td>
                                                                <td>
                                                                    @if ($h->jenis !== 'Wawancara')
                                                                        <button class="btn btn-outline-primary btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="#modalGambar{{ $h->id }}">
                                                                            <i class="fa fa-eye"></i> Lihat Hasil
                                                                        </button>
                                                                    @endif
                                                                    @if ($h->jenis !== 'Penyimpangan Penglihatan' && $h->jenis !== 'ATEC')
                                                                        <a href="{{ route('observasi.detail', ['hasil' => $h->id]) }}"
                                                                            class="btn btn-outline-success btn-sm">
                                                                            <i class="fa fa-eye"></i> Lihat Jawaban
                                                                        </a>
                                                                    @endif


                                                                    {{-- Modal --}}
                                                                    <div class="modal fade"
                                                                        id="modalGambar{{ $h->id }}" tabindex="-1"
                                                                        aria-labelledby="modalLabel{{ $h->id }}"
                                                                        aria-hidden="true">
                                                                        <div
                                                                            class="modal-dialog modal-dialog-centered modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="modalLabel{{ $h->id }}">
                                                                                        Detail Hasil Pemeriksaan</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    @if ($h->jenis == 'ATEC')
                                                                                        <img src="{{ asset('storage/atec/' . $h->hasil) }}"
                                                                                            class="img-fluid w-100 rounded"
                                                                                            style="max-height: 500px; object-fit: contain;"
                                                                                            alt="Hasil ATEC">
                                                                                    @else
                                                                                        <div class="text-left">
                                                                                            <h6 class="mt-3">
                                                                                                Interpretasi:</h6>
                                                                                            <h5 class="font-weight-bold">
                                                                                                {{ $h->hasil }}</h5>
                                                                                            <h6 class="mt-3">Tindakan:
                                                                                            </h6>
                                                                                            <p
                                                                                                class="{{ in_array($h->hasil, ['Penyimpangan', 'Curiga Gangguan Penglihatan', 'Risiko Autisme', 'Kemungkinan GPPH']) ? 'text-danger' : 'text-success' }}">
                                                                                                {{ in_array($h->hasil, ['Penyimpangan', 'Curiga Gangguan Penglihatan', 'Risiko Autisme', 'Kemungkinan GPPH']) ? $penyimpangan : $sesuaiUmur }}
                                                                                            </p>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            {{-- Tabel 2: Hasil Observasi Perilaku --}}
                                            <div class="mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 font-weight-bold">Hasil Observasi
                                                    Perilaku</h5>
                                                <table class="table table-hover text-nowrap table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Tanggal</th>
                                                            <th>Hasil</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($hpperilaku as $perilaku)
                                                            <tr>
                                                                <td>{{ \Carbon\Carbon::parse($perilaku->created_at)->format('d M Y') }}
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-outline-primary btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#modalGambar{{ $perilaku->id }}">
                                                                        <i class="fa fa-eye"></i> Lihat
                                                                        Hasil
                                                                    </button>

                                                                    {{-- Modal --}}
                                                                    <div class="modal fade"
                                                                        id="modalGambar{{ $perilaku->id }}"
                                                                        tabindex="-1"
                                                                        aria-labelledby="modalLabel{{ $perilaku->id }}"
                                                                        aria-hidden="true">
                                                                        <div
                                                                            class="modal-dialog modal-dialog-centered modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="modalLabel{{ $perilaku->id }}">
                                                                                        Detail Hasil Observasi Perilaku</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form
                                                                                        action="{{ route('hpperilaku.update', ['id' => $perilaku->id]) }}"
                                                                                        method="POST"
                                                                                        enctype="multipart/form-data">
                                                                                        @method('PATCH')
                                                                                        @csrf
                                                                                        <div class="row">
                                                                                            <!-- Nested row for proper form layout -->
                                                                                            <div class="col-12">
                                                                                                <!-- Full width column -->
                                                                                                <textarea class="summernote" name="deskripsi">{{ $perilaku->deskripsi }}</textarea>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="text-center mt-4">
                                                                                            <button type="submit"
                                                                                                class="btn btn-success btn-sm">
                                                                                                <i
                                                                                                    class="fa fa-save mr-1"></i>Update
                                                                                                Hasil</button>
                                                                                        </div>

                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            {{-- Tabel 2: Hasil Observasi Sensorik --}}
                                            <div class="mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 font-weight-bold">Hasil Observasi
                                                    Sensorik</h5>
                                                <table class="table table-hover text-nowrap table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Tanggal</th>
                                                            <th>Hasil</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($hpsensorik as $sensorik)
                                                            <tr>
                                                                <td>{{ \Carbon\Carbon::parse($sensorik->created_at)->format('d M Y') }}
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-outline-primary btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#modalGambarSensorik{{ $sensorik->id }}">
                                                                        <i class="fa fa-eye"></i> Lihat Hasil
                                                                    </button>

                                                                    {{-- Modal --}}
                                                                    <div class="modal fade"
                                                                        id="modalGambarSensorik{{ $sensorik->id }}"
                                                                        tabindex="-1"
                                                                        aria-labelledby="modalLabelSensorik{{ $sensorik->id }}"
                                                                        aria-hidden="true">
                                                                        <div
                                                                            class="modal-dialog modal-dialog-centered modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="modalLabelSensorik                                      {{ $sensorik->id }}">
                                                                                        Detail Hasil Observasi Sensorik</h5>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form
                                                                                        action="{{ route('hpsensorik.update', ['id' => $sensorik->id]) }}"
                                                                                        method="POST"
                                                                                        enctype="multipart/form-data">
                                                                                        @method('PATCH')
                                                                                        @csrf
                                                                                        <div class="row">
                                                                                            <!-- Nested row for proper form layout -->
                                                                                            <div class="col-12">
                                                                                                <!-- Full width column -->
                                                                                                <textarea class="summernote" name="deskripsi">{{ $sensorik->deskripsi }}</textarea>

                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="text-center mt-4">
                                                                                            <button type="submit"
                                                                                                class="btn btn-success btn-sm">
                                                                                                <i
                                                                                                    class="fa fa-save mr-1"></i>Update
                                                                                                Hasil</button>
                                                                                        </div>

                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            {{-- Form Cetak PDF --}}
                                            <div class="border-top pt-3">
                                                <form action="{{ route('observasi.cetak') }}" method="POST"
                                                    class="form-inline" target="_blank">
                                                    @csrf
                                                    <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                                                    <div class="input-group" style="max-width: 300px;">
                                                        <input type="date" name="tanggal" class="form-control"
                                                            required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-primary" type="submit">
                                                                <i class="fa fa-print"></i> Cetak PDF
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                    </div>

                                    {{-- hasil observasi perilaku --}}
                                    <div class="tab-pane" id="hpperilaku">
                                        <div class="row justify-content-center mt-2"> <!-- Added justify-content-center -->
                                            <div class="col-lg-10"> <!-- Changed to col-lg-10 -->
                                                <div class="card"> <!-- Added card for better visual grouping -->
                                                    <div class="card-body">
                                                        <form action="{{ route('observasi.hpperilaku') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row"> <!-- Nested row for proper form layout -->
                                                                <div class="col-12"> <!-- Full width column -->
                                                                    <textarea id="summernote-perilaku" name="deskripsi"></textarea>
                                                                    <input type="text" name="anak_id"
                                                                        class="form-control" hidden
                                                                        value="{{ $anak->id }}">
                                                                </div>
                                                            </div>

                                                            <div class="text-center mt-4">
                                                                <button type="submit" class="btn btn-success btn-sm"> <i
                                                                        class="fa fa-save mr-1"></i>Simpan
                                                                    Hasil</button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- hasil observasi sensorik --}}
                                    <div class="tab-pane" id="hpsensorik">
                                        <div class="row justify-content-center mt-2"> <!-- Added justify-content-center -->
                                            <div class="col-lg-10"> <!-- Changed to col-lg-10 -->
                                                <div class="card"> <!-- Added card for better visual grouping -->
                                                    <div class="card-body">
                                                        <form action="{{ route('observasi.hpsensorik') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row"> <!-- Nested row for proper form layout -->
                                                                <div class="col-12"> <!-- Full width column -->
                                                                    <textarea id="summernote-sensorik" name="deskripsi"></textarea>
                                                                    <input type="text" name="anak_id"
                                                                        class="form-control" hidden
                                                                        value="{{ $anak->id }}">
                                                                </div>
                                                            </div>
                                                            <div class="text-center mt-4">
                                                                <button type="submit" class="btn btn-success btn-sm"> <i
                                                                        class="fa fa-save mr-1"></i>Simpan
                                                                    Hasil</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- observasi atec --}}
                                    <div class="tab-pane" id="atec">
                                        <div class="row justify-content-center mt-2"> <!-- Added justify-content-center -->
                                            <div class="col-lg-10"> <!-- Changed to col-lg-10 -->
                                                <div class="card"> <!-- Added card for better visual grouping -->
                                                    <div class="card-body">
                                                        <form action="{{ route('observasi.atec') }}" method="POST"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row"> <!-- Nested row for proper form layout -->
                                                                <div class="col-12"> <!-- Full width column -->
                                                                    <div class="form-group row">
                                                                        <label for="inputPassword3"
                                                                            class="col-sm-3 col-form-label">Upload
                                                                            Hasil</label>
                                                                        <input type="text" name="anak_id"
                                                                            class="form-control" hidden
                                                                            value="{{ $anak->id }}">
                                                                        <div class="col-sm-9">
                                                                            <div class="input-group">
                                                                                <div class="custom-file">
                                                                                    <input type="file"
                                                                                        class="custom-file-input @error('hasil') is-invalid @enderror"
                                                                                        name="hasil" id="gambar_atec"
                                                                                        accept="image/*" required
                                                                                        autofocus>
                                                                                    <label class="custom-file-label"
                                                                                        for="exampleInputFile">Pilih
                                                                                        file</label>
                                                                                </div>
                                                                                @error('hasil')
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-9 offset-sm-3">
                                                                            <!-- Added offset for alignment -->
                                                                            <button type="submit"
                                                                                class="btn btn-success btn-sm">
                                                                                <i class="fa fa-save mr-1"></i> Simpan
                                                                                Hasil
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <a href="https://atec.jatmika.com/" target="_blank"
                                                            class="btn btn-primary btn-block">
                                                            <i class="fas fa-external-link-alt mr-2"></i> Buka ATEC di
                                                            Jendela Baru
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- observasi pendengaran --}}
                                    <div class="tab-pane" id="pendengaran">
                                        <form action="{{ route('obpendengaran.store') }}" method="POST">
                                            @csrf

                                            <input type="text" name="anak_id" class="form-control" hidden
                                                value="{{ $anak->id }}">
                                            {{-- DAFTAR PERTANYAAN --}}
                                            <div class="row justify-content-center">
                                                <div class="col-lg-10">
                                                    <div id="accordion">
                                                        @foreach ($ageGroups as $group)
                                                            <div class="card card-primary card-outline">
                                                                <a class="d-block w-100" data-toggle="collapse"
                                                                    href="#collapse{{ $group->id }}">
                                                                    <div class="card-header">
                                                                        <h4 class="card-title w-100 mb-0">
                                                                            {{ $group->nama }}
                                                                        </h4>
                                                                    </div>
                                                                </a>
                                                                <div id="collapse{{ $group->id }}" class="collapse"
                                                                    data-parent="#accordion">
                                                                    <div class="card-body p-2">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered table-sm">
                                                                                <thead class="thead-light">
                                                                                    <tr>
                                                                                        <th style="width: 5%;">No</th>
                                                                                        <th>Pertanyaan</th>
                                                                                        <th style="width: 35%;">Jawaban
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($group->questions as $index => $q)
                                                                                        <tr>
                                                                                            <td>{{ $index + 1 }}</td>
                                                                                            <td>{{ $q->question_text }}
                                                                                            </td>
                                                                                            <td>
                                                                                                <div
                                                                                                    class="form-check form-check-inline">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="answers[{{ $q->id }}]"
                                                                                                        id="ya{{ $q->id }}"
                                                                                                        value="ya">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="ya{{ $q->id }}">Ya</label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="form-check form-check-inline">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="answers[{{ $q->id }}]"
                                                                                                        id="tidak{{ $q->id }}"
                                                                                                        value="tidak">
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="tidak{{ $q->id }}">Tidak</label>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                        <button type="button"
                                                                            class="btn btn-warning btn-sm mt-2"
                                                                            onclick="resetRadioGroup('{{ $group->id }}')">
                                                                            Reset Jawaban
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="text-center mt-4 mb-5">
                                                        <button type="submit" class="btn btn-success btn-sm"> <i
                                                                class="fa fa-save mr-1"></i>Simpan
                                                            Hasil</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    {{-- observasi penglihatan --}}
                                    <div class="tab-pane" id="penglihatan">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card">
                                                    <div class="card-header bg-primary text-white">
                                                        <h6 class="mb-0 text-center">PEMERIKSAAN PENYIMPANGAN PENGLIHATAN
                                                        </h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="{{ route('observasi.penglihatan') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="text" name="anak_id" class="form-control"
                                                                hidden value="{{ $anak->id }}">

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Hasil
                                                                    Pemeriksaan</label>
                                                                <div class="col-sm-10">
                                                                    <select class="form-control select2"
                                                                        style="width:100%" name="hasil">
                                                                        @forelse ($qpenglihatan as $p)
                                                                            <option value="{{ $p->interpretasi }}">
                                                                                {{ $p->question_text }}</option>
                                                                        @empty
                                                                            <option>tidak ada data</option>
                                                                        @endforelse
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row mb-0">
                                                                <div class="col-sm-10 offset-sm-2">
                                                                    <button type="submit" class="btn btn-success btn-sm">
                                                                        <i class="fa fa-save mr-1"></i> Simpan Hasil
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- observasi perilaku --}}
                                    <div class="tab-pane" id="perilaku">
                                        <form action="{{ route('observasi.perilaku') }}" method="POST">
                                            @csrf
                                            <input type="text" name="anak_id" class="form-control" hidden
                                                value="{{ $anak->id }}">
                                            {{-- DAFTAR PERTANYAAN --}}
                                            <div class="row justify-content-center">
                                                <div class="col-lg-10">
                                                    <div class="card shadow-sm">
                                                        <div class="card-header bg-primary text-white text-center">
                                                            <h6 class="mb-0">INSTRUMEN KUESIONER MASALAH PERILAKU DAN
                                                                EMOSIONAL</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover table-sm">
                                                                    <thead class="thead-light">
                                                                        <tr class="text-center">
                                                                            <th style="width: 5%;">No</th>
                                                                            <th>Pertanyaan</th>
                                                                            <th style="width: 30%;">Jawaban</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($qperilaku as $index => $q)
                                                                            <tr>
                                                                                <td class="text-center align-middle">
                                                                                    {{ $index + 1 }}</td>
                                                                                <td class="align-middle">
                                                                                    {{ $q->question_text }}</td>
                                                                                <td class="text-center">
                                                                                    <div
                                                                                        class="form-check form-check-inline">
                                                                                        <input class="form-check-input"
                                                                                            type="radio"
                                                                                            name="answers[{{ $q->id }}]"
                                                                                            id="ya{{ $q->id }}"
                                                                                            value="ya">
                                                                                        <label class="form-check-label"
                                                                                            for="ya{{ $q->id }}">Ya</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="form-check form-check-inline">
                                                                                        <input class="form-check-input"
                                                                                            type="radio"
                                                                                            name="answers[{{ $q->id }}]"
                                                                                            id="tidak{{ $q->id }}"
                                                                                            value="tidak">
                                                                                        <label class="form-check-label"
                                                                                            for="tidak{{ $q->id }}">Tidak</label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div
                                                                class="d-flex justify-content-between align-items-center mt-3">
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    <i class="fa fa-save mr-1"></i>Simpan Hasil
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    {{-- observasi autis --}}
                                    <div class="tab-pane" id="autis">
                                        <form action="{{ route('observasi.autis') }}" method="POST">
                                            @csrf
                                            <input type="text" name="anak_id" class="form-control" hidden
                                                value="{{ $anak->id }}">
                                            {{-- DAFTAR PERTANYAAN --}}
                                            <div class="row justify-content-center">
                                                <div class="col-lg-10">
                                                    <div class="card shadow-sm">
                                                        <div class="card-header bg-primary text-white text-center">
                                                            <h6 class="mb-0">INSTRUMEN PEMERIKSAAN MODIFIED CHECKLIST FOR
                                                                AUTISM IN TOODLER (M-CHAT)</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover table-sm">
                                                                    <thead class="thead-light">
                                                                        <tr class="text-center">
                                                                            <th style="width: 5%;">No</th>
                                                                            <th>Pertanyaan</th>
                                                                            <th style="width: 30%;">Jawaban</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($qautis as $index => $q)
                                                                            <tr>
                                                                                <td class="text-center align-middle">
                                                                                    {{ $index + 1 }}</td>
                                                                                <td class="align-middle">
                                                                                    {{ $q->question_text }}</td>
                                                                                <td class="text-center">
                                                                                    <div
                                                                                        class="form-check form-check-inline">
                                                                                        <input class="form-check-input"
                                                                                            type="radio"
                                                                                            name="answers[{{ $q->id }}]"
                                                                                            id="ya{{ $q->id }}"
                                                                                            value="ya">
                                                                                        <label class="form-check-label"
                                                                                            for="ya{{ $q->id }}">Ya</label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="form-check form-check-inline">
                                                                                        <input class="form-check-input"
                                                                                            type="radio"
                                                                                            name="answers[{{ $q->id }}]"
                                                                                            id="tidak{{ $q->id }}"
                                                                                            value="tidak">
                                                                                        <label class="form-check-label"
                                                                                            for="tidak{{ $q->id }}">Tidak</label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div
                                                                class="d-flex justify-content-between align-items-center mt-3">
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    <i class="fa fa-save mr-1"></i>Simpan Hasil
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    {{-- observasi GPPH --}}
                                    <div class="tab-pane" id="gpph">
                                        <form action="{{ route('observasi.gpph') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="anak_id" value="{{ $anak->id }}">

                                            <div class="row justify-content-center">
                                                <div class="col-lg-10">
                                                    <div class="card shadow-sm">
                                                        <div class="card-header bg-primary text-white text-center">
                                                            <h6 class="mb-0">INSTRUMEN PEMERIKSAAN GANGGUAN PEMUSATAN
                                                                PERHATIAN DAN HIPERAKTIVITAS (GPPH)</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover">
                                                                    <thead class="thead-light">
                                                                        <tr class="text-center">
                                                                            <th style="width: 5%;">No</th>
                                                                            <th style="width: 55%;">Kegiatan yang Diamati
                                                                            </th>
                                                                            <th style="width: 10%;">0</th>
                                                                            <th style="width: 10%;">1</th>
                                                                            <th style="width: 10%;">2</th>
                                                                            <th style="width: 10%;">3</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($qgpph as $index => $q)
                                                                            <tr>
                                                                                <td class="text-center align-middle">
                                                                                    {{ $index + 1 }}</td>
                                                                                <td class="align-middle">
                                                                                    {{ $q->question_text }}</td>

                                                                                <!-- Radio Button for 0 -->
                                                                                <td class="text-center align-middle radio-cell"
                                                                                    onclick="selectRadio(this, '{{ $q->id }}', 0)">
                                                                                    <input type="radio"
                                                                                        name="answers[{{ $q->id }}]"
                                                                                        value="0" required
                                                                                        class="form-check-input">
                                                                                </td>

                                                                                <!-- Radio Button for 1 -->
                                                                                <td class="text-center align-middle radio-cell"
                                                                                    onclick="selectRadio(this, '{{ $q->id }}', 1)">
                                                                                    <input type="radio"
                                                                                        name="answers[{{ $q->id }}]"
                                                                                        value="1"
                                                                                        class="form-check-input">
                                                                                </td>

                                                                                <!-- Radio Button for 2 -->
                                                                                <td class="text-center align-middle radio-cell"
                                                                                    onclick="selectRadio(this, '{{ $q->id }}', 2)">
                                                                                    <input type="radio"
                                                                                        name="answers[{{ $q->id }}]"
                                                                                        value="2"
                                                                                        class="form-check-input">
                                                                                </td>

                                                                                <!-- Radio Button for 3 -->
                                                                                <td class="text-center align-middle radio-cell"
                                                                                    onclick="selectRadio(this, '{{ $q->id }}', 3)">
                                                                                    <input type="radio"
                                                                                        name="answers[{{ $q->id }}]"
                                                                                        value="3"
                                                                                        class="form-check-input">
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                        <tr class="table-secondary">
                                                                            <td colspan="2"
                                                                                class="text-right font-weight-bold">Total
                                                                                Skor</td>
                                                                            <td colspan="4"
                                                                                class="text-center font-weight-bold"
                                                                                id="totalScore">0</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div
                                                                class="d-flex justify-content-between align-items-center mt-3">
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    <i class="fa fa-save mr-1"></i> Simpan Hasil
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    {{-- observasi wawancara --}}
                                    <div class="tab-pane" id="wawancara">
                                        <form action="{{ route('observasi.wawancara') }}" method="POST">
                                            @csrf
                                            <input type="text" name="anak_id" class="form-control" hidden
                                                value="{{ $anak->id }}">
                                            {{-- DAFTAR PERTANYAAN --}}
                                            <div class="row justify-content-center">
                                                <div class="col-lg-10">
                                                    <div class="card shadow-sm">
                                                        <div class="card-header bg-primary text-white text-center">
                                                            <h6 class="mb-0">INSTRUMEN WAWANCARA</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-hover table-sm">
                                                                    <thead class="thead-light">
                                                                        <tr class="text-center">
                                                                            <th style="width: 5%;">No</th>
                                                                            <th>Pertanyaan</th>
                                                                            <th style="width: 65%;">Jawaban</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($qwawancara as $index => $q)
                                                                            <tr>
                                                                                <td class="text-center align-middle">
                                                                                    {{ $index + 1 }}</td>
                                                                                <td class="align-middle">
                                                                                    {{ $q->question_text }}</td>
                                                                                <td class="text-center">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="answers[{{ $q->id }}]"
                                                                                        placeholder="isikan jawaban">
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <div
                                                                class="d-flex justify-content-between align-items-center mt-3">
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    <i class="fa fa-save mr-1"></i>Simpan Hasil
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // 1. Script untuk file upload
            $('input[type="file"]').on('change', function() {
                let filenames = [];
                let files = this.files;

                for (let i in files) {
                    if (files.hasOwnProperty(i)) {
                        filenames.push(files[i].name);
                    }
                }

                $(this).next('.custom-file-label').addClass("selected").html(filenames.join(', '));
            });

            // 2. Script untuk reset radio group (VERSI PERBAIKAN)
            window.resetRadioGroup = function(groupId) {
                const selector = '#collapse' + groupId;
                const $collapse = $(selector);

                if ($collapse.length) {
                    // Reset semua radio button dalam group
                    $collapse.find('input[type="radio"]').prop('checked', false);

                    // Trigger change event untuk update kalkulasi jika diperlukan
                    $collapse.find('input[type="radio"]').trigger('change');

                    // Feedback visual (opsional)
                    $collapse.css('background-color', '#fff8e1')
                        .animate({
                            backgroundColor: '#fff'
                        }, 500);
                } else {
                    console.error('Element tidak ditemukan:', selector);
                }
            };

            // 3. Script untuk kalkulasi GPPH
            $('input[type="radio"][name^="answers"]').change(function() {
                let total = 0;
                $('input[type="radio"][name^="answers"]:checked').each(function() {
                    total += parseInt($(this).val());
                });
                $('#totalScore').text(total);
            });

            // 4. Script baru untuk cell-clickable radio buttons
            $('.radio-cell').click(function(e) {
                // Skip if click was directly on the radio button
                if ($(e.target).is('input[type="radio"]')) return;

                const radio = $(this).find('input[type="radio"]');
                radio.prop('checked', true).trigger('change');

                // Visual feedback
                $(this).css('background-color', '#e6f7ff').delay(200).queue(function(next) {
                    $(this).css('background-color', '');
                    next();
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Inisialisasi semua Summernote sekaligus
            $('.summernote').each(function() {
                $(this).summernote({
                    height: 200, // Tinggi editor
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                    ]
                });
            });
        });
    </script>
@endsection
