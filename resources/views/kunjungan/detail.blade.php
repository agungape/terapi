@extends('layouts.master')
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
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('assets') }}/adminlte/dist/img/user4-128x128.jpg"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $kunjungan->anak->nama }}
                                </h3>
                                @if ($kunjungan->anak->jenis_kelamin == 'L')
                                    <p class="text-muted text-center">Laki - Laki</p>
                                @else
                                    <p class="text-muted text-center">Perempuan</p>
                                @endif

                                <h4> {{ $kunjungan->usia }} Tahun</h4>
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
                                        <a href="{{ route('kunjungan.data') }}" class="btn btn-sm btn-warning float-right">
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
                                                        {{-- @php
                                                            $date = null;
                                                        @endphp --}}
                                                        @forelse ($r->pemeriksaans as $p)
                                                            @php
                                                                $time = strtotime($p->created_at);
                                                            @endphp
                                                            <tr class="text-center">
                                                                <td>{{ $p->program->deskripsi }}
                                                                </td>
                                                                <td>{{ $p->status }}</td>
                                                                {{-- @if ($date != $p->created_at)
                                                                    @php
                                                                        $date = $p->created_at;
                                                                    @endphp
                                                                    <td rowspan="{{ $jumlah_pemeriksaan[$time] }}"
                                                                        style="vertical-align: middle">
                                                                        {{ $p->keterangan }}
                                                                    </td>
                                                                @endif --}}
                                                                @if ($loop->first)
                                                                    <td rowspan="3" style="vertical-align: middle">
                                                                        {{ $p->keterangan }}</td>
                                                                @endif
                                                            </tr>


                                                        @empty
                                                            <tr>
                                                                <td colspan="3" class="text-center"> data program belum
                                                                    ada</td>
                                                            </tr>
                                                        @endforelse

                                                    </tbody>
                                                @endforeach
                                            </table>

                                            {{-- <div class="row">
                                                <div class="mx-auto mt-3">
                                                    {{ $riwayat->fragment('judul')->links() }}
                                                </div>
                                            </div> --}}
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
                                    <input type="radio" id="radioPrimary1${formIndex}" name="status[${formIndex}]" value="dp">
                                        <label for="radioPrimary1${formIndex}"> DP
                                        </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="icheck-primary">
                                    <input type="radio" id="radioPrimary2${formIndex}" name="status[${formIndex}]" value="ds">
                                        <label for="radioPrimary2${formIndex}"> DS
                                        </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="icheck-primary">
                                    <input type="radio" id="radioPrimary3${formIndex}" name="status[${formIndex}]" value="tb">
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
@endsection
