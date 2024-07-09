@extends('layouts.master')
@section('menuUpload', 'collapsed')
@section('content')

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ asset('assets') }}/images/faces/face1.jpg" alt="Profile" class="rounded-circle">
                        <h2>{{ $kunjungan->anak->nama }}</h2>
                        <h5>{{ $kunjungan->usia }} Tahun</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-settings">Riwayat</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-edit">Pemeriksaan</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">

                            {{-- pemeriksaan --}}
                            <div class="tab-pane fade show active profile-overview" id="profile-settings">
                                @foreach ($riwayat as $r)
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Pertemuan</th>
                                                <th colspan="4">{{ $r->kunjungan->pertemuan }}
                                                    @if ($r->kunjungan->status == 'hadir')
                                                        <label
                                                            class="badge badge-success">{{ $r->kunjungan->status }}</label>
                                                    @endif
                                                    @if ($r->kunjungan->status == 'izin')
                                                        <label
                                                            class="badge badge-warning">{{ $r->kunjungan->status }}</label>
                                                    @endif
                                                    @if ($r->kunjungan->status == 'sakit')
                                                        <label
                                                            class="badge badge-danger">{{ $r->kunjungan->status }}</label>
                                                    @endif

                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Program</th>
                                                <th colspan="4">{{ $r->program->deskripsi }} </th>
                                            </tr>
                                            <tr>
                                                <th width ="30"> Tanggal </th>
                                                <th colspan="4" class="text-center"> Pemeriksaan </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="4" width="30px"> {{ $r->created_at->format('Y-m-d') }}
                                                </td>
                                                <td width="50px"> Subjektif</td>
                                                <td width="5px"> :</td>
                                                <td> {{ $r->subjek }} </td>
                                                <td rowspan="4" width="40px"> {{ $r->kunjungan->terapis->nama }} </td>
                                            </tr>
                                            <tr>
                                                <td width="50px"> Objectif</td>
                                                <td width="5px"> :</td>
                                                <td> {{ $r->objek }} </td>
                                            </tr>
                                            <tr>
                                                <td width="50px"> Assesment</td>
                                                <td width="5px"> :</td>
                                                <td> {{ $r->assesment }} </td>
                                            </tr>
                                            <tr>
                                                <td width="50"> Planning</td>
                                                <td width="5"> :</td>
                                                <td> {{ $r->planning }} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                @endforeach
                                <div class="row">
                                    <div class="mx-auto mt-3">
                                        {{ $riwayat->fragment('judul')->links() }}
                                    </div>
                                </div>

                            </div>

                            {{-- riwayat --}}
                            <div class="tab-pane fade pt-3" id="profile-edit">
                                <form action="{{ route('pemeriksaan.store') }}" method="POST">
                                    @include('kunjungan.form', ['tombol' => 'Submit'])
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
