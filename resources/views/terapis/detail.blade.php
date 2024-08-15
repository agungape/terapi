@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'show')
@section('menuTerapis', 'active')
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
                        <p class="text-muted text-center">{{ $tanggal_lahir }} Tahun</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#pelatihan"
                                    data-toggle="tab">Pelatihan</a></li>
                            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a>
                            </li>
                        </ul>

                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="pelatihan">
                                <a href="{{ route('terapis.pelatihan', ['terapi' => $terapi->id]) }}"
                                    class="btn btn-sm btn-gradient-info btn-block"><i class="fa fa-plus"></i></a>
                                <a href="{{ route('terapis.index') }}" class="btn btn-sm btn-gradient-warning"><i
                                        class="fa fa-mail-reply-all"></i></a>
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
                                                    <td> <a href="{{ route('sertifikat.show', ['sertifikat' => $t->pivot->id]) }}"
                                                            target="_blank">
                                                            {{ $t->pivot->sertifikat }} </a> </td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="activity">
                                <table class="table table-hover">
                                    @php
                                        $tanggal = 0;
                                    @endphp
                                    @foreach ($activity as $a)
                                        @if ($a->status == 'hadir')
                                            @if ($tanggal != $a->created_at->format('Y-m-d'))
                                                <thead>
                                                    <tr>
                                                        <th colspan="2" class="text-center table-info">
                                                            {{ $a->created_at->format('Y-m-d') }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                            @endif
                                            @php
                                                $tanggal = $a->created_at->format('Y-m-d');
                                            @endphp
                                            <tbody>
                                                <tr>
                                                    <td>{{ $a->created_at->format('H:i:s') }}</td>
                                                    <td>{{ $a->anak->nama }}</td>
                                                </tr>
                                            </tbody>
                                        @endif
                                    @endforeach
                                </table>
                                <div class="row">
                                    <div class="mx-auto mt-3">
                                        {{ $activity->fragment('judul')->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
