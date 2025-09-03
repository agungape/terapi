@extends('layouts.master')
@section('menuLayananterapi', 'active')
@section('masterLayananterapi', 'menu-is-opening menu-open')
@section('menuRekammedis', 'active')
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle fixed-size"
                                        src="{{ $kunjungan->anak->foto ? asset('storage/anak/' . $kunjungan->anak->foto) : asset('assets/images/faces/face1.jpg') }}"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $kunjungan->anak->nama }}
                                </h3>
                                @if ($kunjungan->anak->jenis_kelamin == 'L')
                                    <p class="text-muted text-center">Laki - Laki</p>
                                @else
                                    <p class="text-muted text-center">Perempuan</p>
                                @endif
                                <p class="text-muted text-center">{{ $kunjungan->usia }} Tahun</p>
                                <div class="text-center">
                                    @if ($isCurrentSessionCompleted == false)
                                        <form id="selesaiSesiForm" action="{{ route('kunjungan.selesai-sesi') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="anak_id" value="{{ $kunjungan->anak->id }}">
                                            <input type="hidden" name="jenis_terapi"
                                                value="{{ $kunjungan->jenis_terapi }}">

                                            <button type="submit" id="selesaiSesiBtn"
                                                class="btn btn-sm btn-success">Selesaikan
                                                Season</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Biodata Anak</h3>
                            </div>

                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Pendidikan</strong>

                                <p class="text-muted">
                                    {{ $kunjungan->anak->pendidikan }}
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                                <p class="text-muted">{{ $kunjungan->anak->alamat }}</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Diagnosa</strong>

                                <p class="text-muted">
                                    {{ $kunjungan->anak->diagnosa }}
                                </p>

                                <hr>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            @if ($kunjungan->jenis_terapi == 'terapi_perilaku')
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                                        data-toggle="tab">Riwayat</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#timeline"
                                                        data-toggle="tab">Pemeriksaaan</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('kunjungan.data') }}"
                                                class="btn btn-sm btn-warning float-right">
                                                Kembali</a>
                                        </div>
                                    </div>


                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        {{-- riwayat --}}
                                        <div class="active tab-pane" id="activity">
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    @foreach ($riwayat as $r)
                                                        <thead>
                                                            <tr style="background-color: lavender">
                                                                <th>Pertemuan</th>
                                                                <th colspan="2">{{ $r->pertemuan }}
                                                                    @if ($r->status == 'hadir')
                                                                        <label
                                                                            class="badge badge-success">{{ $r->status }}</label>
                                                                    @elseif ($r->status == 'izin')
                                                                        <label
                                                                            class="badge badge-warning">{{ $r->status }}</label>
                                                                    @elseif ($r->status == 'sakit')
                                                                        <label
                                                                            class="badge badge-danger">{{ $r->status }}</label>
                                                                    @endif
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Tanggal</th>
                                                                <th colspan="2"> {{ $r->created_at }} </th>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-center"> Program </th>
                                                                <th class="text-center"> Skala </th>
                                                                <th class="text-center"> Keterangan </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $rows = $r->pemeriksaans->count();
                                                            @endphp

                                                            @forelse ($r->pemeriksaans as $p)
                                                                @php
                                                                    $time = strtotime($p->created_at);
                                                                @endphp
                                                                <tr class="text-center">
                                                                    <td>{{ $p->program->deskripsi }}
                                                                    </td>
                                                                    <td>{{ $p->status }}</td>
                                                                    @if ($loop->first)
                                                                        <td rowspan="{{ $rows }}"
                                                                            style="vertical-align: middle; text-align:left">
                                                                            @foreach (explode("\n", $p->keterangan) as $paragraph)
                                                                                <p
                                                                                    style="margin-bottom: 1px; line-height: 1.5;">
                                                                                    {{ $paragraph }}
                                                                                </p>
                                                                            @endforeach
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="3" class="text-center"> data program
                                                                        belum
                                                                        ada</td>
                                                                </tr>
                                                            @endforelse

                                                        </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        <!-- pemeriksaan -->
                                        <div class="tab-pane" id="timeline">
                                            <form action="{{ route('pemeriksaan.store') }}" method="POST">
                                                @include('kunjungan.form', ['tombol' => 'Submit'])
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            @else
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                                        data-toggle="tab">Riwayat Fisioterapi</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#timeline"
                                                        data-toggle="tab">Pemeriksaaan</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="{{ route('kunjungan.data') }}"
                                                class="btn btn-sm btn-warning float-right">
                                                Kembali</a>
                                        </div>
                                    </div>


                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        {{-- riwayat --}}
                                        <div class="active tab-pane" id="activity">
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    @foreach ($riwayat_fisioterapi as $f)
                                                        <thead>
                                                            <tr style="background-color: lavender">
                                                                <th>Pertemuan</th>
                                                                <th colspan="3">{{ $f->pertemuan }}
                                                                    @if ($f->status == 'hadir')
                                                                        <label
                                                                            class="badge badge-success">{{ $f->status }}</label>
                                                                    @elseif ($f->status == 'izin')
                                                                        <label
                                                                            class="badge badge-warning">{{ $f->status }}</label>
                                                                    @elseif ($f->status == 'sakit')
                                                                        <label
                                                                            class="badge badge-danger">{{ $f->status }}</label>
                                                                    @endif
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Tanggal</th>
                                                                <th colspan="3"> {{ $f->created_at }} </th>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-center"> Program </th>
                                                                <th class="text-center"> Aktivitas Terapi </th>
                                                                <th class="text-center"> Evaluasi </th>
                                                                <th class="text-center"> Catatan Khusus </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $rows = $f->fisioterapis->count();
                                                            @endphp

                                                            @forelse ($f->fisioterapis as $fisio)
                                                                @php
                                                                    $time = strtotime($fisio->created_at);
                                                                @endphp
                                                                <tr class="text-center">
                                                                    <td>{{ $fisio->program->deskripsi }}
                                                                    </td>
                                                                    <td>
                                                                        @foreach (explode("\n", $fisio->aktivitas_terapi) as $paragraph)
                                                                            <p
                                                                                style="margin-bottom: 1px; line-height: 1.5;">
                                                                                {{ $paragraph }}
                                                                            </p>
                                                                        @endforeach
                                                                    </td>
                                                                    @if ($loop->first)
                                                                        <td rowspan="{{ $rows }}"
                                                                            style="vertical-align: middle; text-align:left">
                                                                            @foreach (explode("\n", $fisio->evaluasi) as $paragraph)
                                                                                <p
                                                                                    style="margin-bottom: 1px; line-height: 1.5;">
                                                                                    {{ $paragraph }}
                                                                                </p>
                                                                            @endforeach
                                                                        </td>
                                                                        <td rowspan="{{ $rows }}"
                                                                            style="vertical-align: middle; text-align:left">
                                                                            @foreach (explode("\n", $fisio->catatan_khusus) as $paragraph)
                                                                                <p
                                                                                    style="margin-bottom: 1px; line-height: 1.5;">
                                                                                    {{ $paragraph }}
                                                                                </p>
                                                                            @endforeach
                                                                        </td>
                                                                    @endif
                                                                </tr>


                                                            @empty
                                                                <tr>
                                                                    <td colspan="4" class="text-center"> data program
                                                                        belum
                                                                        ada</td>
                                                                </tr>
                                                            @endforelse

                                                        </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        <!-- pemeriksaan -->
                                        <div class="tab-pane" id="timeline">
                                            <form action="{{ route('fisioterapi.store') }}" method="POST">
                                                @include('kunjungan.form_fisioterapi', [
                                                    'tombol' => 'Simpan Data',
                                                ])
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
            let formIndex = 1;

            $('#add-button').click(function() {
                $('#form-wrapper').append(`

                <div class="container-form row col-md-12">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Program</label>
                            <div class="col-sm-6">
                                <select class="form-control select2" style="width:100%" name="program_id[${formIndex}]">
                                    @foreach ($program as $p)
                                        <option value="{{ $p->id }}">{{ $p->deskripsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4"> <button type="button" id="add-button" class="btn btn-sm btn-danger remove-button"><i class="fa fa-minus"></i></button></div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Skala</label>
                            <div class="col-sm-3">
                                <div class="icheck-primary">
                                    <input type="radio" id="radioPrimary1${formIndex}" name="status[${formIndex}]" value="dp" required>
                                        <label for="radioPrimary1${formIndex}"> DP
                                        </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="icheck-primary">
                                    <input type="radio" id="radioPrimary2${formIndex}" name="status[${formIndex}]" value="ds" required>
                                        <label for="radioPrimary2${formIndex}"> DS
                                        </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="icheck-primary">
                                    <input type="radio" id="radioPrimary3${formIndex}" name="status[${formIndex}]" value="tb" required>
                                        <label for="radioPrimary3${formIndex}"> TB
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                `);

                formIndex++;

                $('.select2').select2();
            });

            $(document).on('click', '.remove-button', function() {
                $(this).closest('.container-form').remove();

            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let formIndex = 1;
            $('#add-button-fisioterapi').click(function() {
                $('#form-fisioterapi').append(`

                <div class="container-form row col-md-12">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Program ${formIndex + 1}</label>
                            <div class="col-sm-6">
                                <select class="form-control select2" style="width:100%" name="program_id[${formIndex}]">
                                    @foreach ($program_fisioterapi as $f)
                                        <option value="{{ $f->id }}">{{ $f->deskripsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4"> <button type="button" id="add-button-fisioterapi" class="btn btn-sm btn-danger remove-button"><i class="fa fa-minus"></i></button></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Aktivitas Terapi ${formIndex + 1}</label>
                            <div class="col-sm-6">
                                <textarea class="form-control @error('aktivitas_terapi[${formIndex}]') is-invalid @enderror" name="aktivitas_terapi[${formIndex}]" autofocus
                                    placeholder="aktivitas_terapi" rows="3"></textarea>
                                @error('aktivitas_terapi[${formIndex}]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                `);

                formIndex++;

                $('.select2').select2();
            });

            $(document).on('click', '.remove-button', function() {
                $(this).closest('.container-form').remove();

            });
        });
    </script>
    <script>
        document.getElementById('selesaiSesiBtn').addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi Selesai Sesi',
                text: "Apakah Anda yakin ingin menyelesaikan sesi ini? jika ya, sesi akan berakhir dan beralih ke sesi selanjutnya",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Selesaikan!',
                cancelButtonText: 'Batal',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('selesaiSesiForm').submit();
                }
            });
        });
    </script>
@endsection
