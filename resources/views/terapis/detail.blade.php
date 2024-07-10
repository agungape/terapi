@extends('layouts.master')
@section('menuUpload', 'collapsed')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('assets') }}/images/faces/face26.jpg" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center pt-2">{{ $terapi->nama }}</h3>
                        <p class="text-muted text-center">Terapis</p>
                        <a href="#" class="btn btn-gradient-info btn-block"><b>Tambah</b></a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#pelatihan" data-toggle="tab">Pelatihan</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                            </div>
                            <div class="tab-pane" id="pelatihan">

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> Tanggal </th>
                                                <th> Instansi </th>
                                                <th> Nama </th>
                                                <th> Sertifikat </th>
                                                <th> Aksi </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($terapis->pelatihans as $t)
                                                <tr>
                                                    <td> {{ $t->pivot->tanggal }}</td>
                                                    <td> {{ $t->instansi }}</td>
                                                    <td> {{ $t->nama }} </td>
                                                    <td> {{ $t->pivot->sertifikat }} </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- <div class="row">
                                        <div class="mx-auto mt-3">
                                            {{ $pelatihan->fragment('judul')->links() }}
                                        </div>
                                    </div> --}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
