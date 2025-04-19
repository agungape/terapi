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
                                <h4 class="card-title">Deteksi Dini Penyimpangan Pendengaran</h4>
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
                                            <table class="table table-hover text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th> Tanggal </th>
                                                        <th> Jenis Observasi </th>
                                                        <th> Hasil </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($hasil as $h)
                                                        <tr>
                                                            <td>{{ $h->created_at }}</td>
                                                            <td>{{ $h->jenis }}</td>
                                                            <td>
                                                                <!-- Tombol -->
                                                                <button class="btn btn-outline-primary btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#modalGambar{{ $h->id }}">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="modalGambar{{ $h->id }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="modalLabel{{ $h->id }}"
                                                                    aria-hidden="true">
                                                                    <div
                                                                        class="modal-dialog modal-dialog-centered modal-lg">
                                                                        {{-- modal-lg untuk tampilan lebar --}}
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="modalLabel{{ $h->id }}">Hasil
                                                                                    Pemeriksaan</h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal" aria-label="Close">
                                                                                    {{-- untuk Bootstrap 4 --}}
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body text-center">
                                                                                @if ($h->jenis == 'ATEC')
                                                                                    <img src="{{ asset('storage/atec/' . $h->hasil) }}"
                                                                                        class="img-fluid w-100 rounded"
                                                                                        style="max-height: 500px; object-fit: contain;"
                                                                                        alt="Gambar">
                                                                                @elseif ($h->jenis == 'Penyimpangan Pendengaran')
                                                                                    <div class="text-left">
                                                                                        <h6 class="mt-3">Interpretasi:
                                                                                        </h6>
                                                                                        <h5 class="font-weight-bold">
                                                                                            {{ $h->hasil }}</h5>
                                                                                        <h6 class="mt-3">Tindakan:</h6>
                                                                                        @if ($h->hasil == 'Penyimpangan')
                                                                                            <p class="text-danger">Rujuk ke
                                                                                                {{ $penyimpangan }}</p>
                                                                                        @else
                                                                                            <p class="text-success">
                                                                                                {{ $sesuaiUmur }}
                                                                                            </p>
                                                                                        @endif
                                                                                    </div>
                                                                                @elseif ($h->jenis == 'Penyimpangan Penglihatan')
                                                                                    <div class="text-left">
                                                                                        <h6 class="mt-3">Interpretasi:
                                                                                        </h6>
                                                                                        <h5 class="font-weight-bold">
                                                                                            {{ $h->hasil }}</h5>
                                                                                        <h6 class="mt-3">Tindakan:</h6>
                                                                                        @if ($h->hasil == 'Curiga Gangguan Penglihatan')
                                                                                            <p class="text-danger">Rujuk ke
                                                                                                {{ $penyimpangan }}</p>
                                                                                        @else
                                                                                            <p class="text-success">
                                                                                                {{ $sesuaiUmur }}
                                                                                            </p>
                                                                                        @endif
                                                                                    </div>
                                                                                @elseif ($h->jenis == 'Penyimpangan Perilaku')
                                                                                    <div class="text-left">
                                                                                        <h6 class="mt-3">Interpretasi:
                                                                                        </h6>
                                                                                        <h5 class="font-weight-bold">
                                                                                            @if ($h->hasil == 'Penyimpangan')
                                                                                                {{ $interPerilaku }}
                                                                                            @else
                                                                                                {{ $h->hasil }}
                                                                                            @endif
                                                                                        </h5>

                                                                                        <h6 class="mt-3">Tindakan:</h6>
                                                                                        @if ($h->hasil == 'Penyimpangan')
                                                                                            <p class="text-danger">
                                                                                                {{ $penyimpanganPerilaku }}
                                                                                            </p>
                                                                                        @else
                                                                                            <p class="text-success">
                                                                                                {{ $sesuaiUmur }}
                                                                                            </p>
                                                                                        @endif
                                                                                    </div>
                                                                                @elseif ($h->jenis == 'Autisme')
                                                                                    <div class="text-left">
                                                                                        <h6 class="mt-3">Interpretasi:
                                                                                        </h6>
                                                                                        <h5 class="font-weight-bold">
                                                                                            {{ $h->hasil }}
                                                                                        </h5>

                                                                                        <h6 class="mt-3">Tindakan:</h6>
                                                                                        @if ($h->hasil == 'Risiko Autisme')
                                                                                            <p class="text-danger">
                                                                                                {{ $penyimpangan }}
                                                                                            </p>
                                                                                        @else
                                                                                            <p class="text-success">
                                                                                                {{ $sesuaiUmur }}
                                                                                            </p>
                                                                                        @endif
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
                                    </div>

                                    {{-- observasi atec --}}
                                    <div class="tab-pane" id="atec">
                                        <div class="row mt-2">
                                            <div class="col-12 col-md-6">
                                                <form action="{{ route('observasi.atec') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label for="inputPassword3" class="col-sm-3 col-form-label">Upload
                                                            Hasil</label>
                                                        <input type="text" name="anak_id" class="form-control" hidden
                                                            value="{{ $anak->id }}">
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file"
                                                                        class="custom-file-input @error('hasil') is-invalid @enderror"
                                                                        name="hasil" id="gambar_atec" accept="image/*"
                                                                        required autofocus>
                                                                    <label class="custom-file-label"
                                                                        for="exampleInputFile">Pilih
                                                                        file</label>
                                                                </div>
                                                                @error('hasil')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputPassword3"
                                                            class="col-sm-3 col-form-label"></label>
                                                        <div class="col-sm-9">
                                                            <button type="submit" class="btn btn-success btn-sm"> <i
                                                                    class="fa fa-save mr-1"></i>Simpan
                                                                Hasil</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-5">
                                                <iframe src="https://atec.jatmika.com/" width="100%"
                                                    height="600px"></iframe>
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
                                        <div class="row mt-2">
                                            <div class="col-12 col-md-12">
                                                <form action="{{ route('observasi.penglihatan') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="text" name="anak_id" class="form-control" hidden
                                                        value="{{ $anak->id }}">
                                                    <div class="form-group row">
                                                        <label for="exampleInputMobile"
                                                            class="col-sm-2 col-form-label">Hasil Pemeriksaan</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control select2" style="width:100%"
                                                                name="hasil">
                                                                @forelse ($qpenglihatan as $p)
                                                                    <option value="{{ $p->interpretasi }}">
                                                                        {{ $p->question_text }}</option>
                                                                @empty
                                                                    <option>tidak ada data</option>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputPassword3"
                                                            class="col-sm-2 col-form-label"></label>
                                                        <div class="col-sm-10">
                                                            <button type="submit" class="btn btn-success btn-sm"> <i
                                                                    class="fa fa-save mr-1"></i>Simpan
                                                                Hasil</button>
                                                        </div>
                                                    </div>
                                                </form>
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
        $('input[type="file"]').on('change', function() {
            let filenames = [];
            let files = document.getElementById('gambar_atec').files;

            for (let i in files) {
                if (files.hasOwnProperty(i)) {
                    filenames.push(files[i].name);
                }
            }

            $(this).next('.custom-file-label').addClass("selected").html(filenames.join(', '));
        });

        function resetRadioGroup(groupId) {
            const collapseElement = document.getElementById('collapse' + groupId);
            if (collapseElement) {
                const radios = collapseElement.querySelectorAll('input[type="radio"]');
                radios.forEach(radio => {
                    radio.checked = false;
                });
            }
        }
    </script>
@endsection
