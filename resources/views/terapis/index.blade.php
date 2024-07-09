@extends('layouts.master')
@section('menuUpload', 'collapsed')
@section('content')

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Database Terapis</h4>
                    @auth
                        <a href="{{ route('terapis.create') }}" class="btn btn-gradient-success btn-sm"><i class="fas fa-plus"></i>
                            Tambah
                            Data</a>
                    @endauth

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> No. Induk</th>
                                    <th> Nama </th>
                                    <th> Usia </th>
                                    <th> Alamat </th>
                                    <th> Diagnosa </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($terapis as $terapi)
                                    <tr>
                                        <td>{{ $terapi->nib }}</td>
                                        <td>
                                            <img src="assets/images/faces/face1.jpg" class="me-2"
                                                alt="image">{{ $terapi->nama }}
                                        </td>
                                        <td> {{ $anak->usia }} </td>
                                        <td> {{ $anak->alamat }} </td>
                                        <td> {{ $anak->diagnosa }} </td>
                                        <td><a href="{{ route('anak.show', ['anak' => $anak->id]) }}"
                                                class="btn btn-gradient-primary btn-sm">
                                                <i class="fa fa-address-card-o"></i>
                                            </a>
                                            <a href="{{ route('anak.edit', ['anak' => $anak->id]) }}"
                                                class="btn btn-gradient-warning btn-sm">
                                                <i class="fa fa-pencil-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- <div class="pagetitle">
        <h1>E-Kalim</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Upload Klaim</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Table Data File Upload </h5>
            <div class="row">
                <div class="col-md-9">
                    @if (auth()->check())
                        @if (auth()->user()->is_admin)
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#basicModal" title="upload FIle"><i class="fas fa-plus"></i>
                                </button>
                                <a href="{{ route('upload.index') }}" class="btn btn-warning"><i
                                        class="fas fa-sync-alt"></i> </a>
                                <a href="" class="btn btn-success"><i class="fas fa-download"></i></a>
                            </div>
                        @else
                            <a href="{{ route('upload.index') }}" class="btn btn-warning"><i class="fas fa-sync-alt"></i>
                            </a>
                        @endif
                    @endif
                </div>
                <div class="col-md-3">
                    <form action="{{ route('upload.search') }}" method="GET">
                        <input type="text" name="search" placeholder="Cari..." class="form-control">
                        <button type="submit" hidden>Cari</button>
                    </form>
                </div>
            </div>

            <!-- Table with hoverable rows -->
            <table class="table table-hover table-responsive">
                <thead>

                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Usia</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anaks as $anak)
                        <tr class="text-center">
                            <td scope="row">{{ $anaks->firstItem() + $loop->iteration - 1 }}</td>
                            <td style="text-transform: capitalize;">{{ $anak->nama }}</td>
                            <td style="text-transform: capitalize;">{{ $anak->alamat }}</td>
                            <td style="text-transform: capitalize;">{{ $anak->usia }} Tahun</td>
                            <td> - </td>
                            <td>
                                <div class="row justify-content-center">
                                    <div class="col-md-3 px-0 col-sm-12">
                                        <a href="{{ route('anak.show', ['anak' => $anak->id]) }}"
                                            class="btn btn-primary d-inline-block mt-1">
                                            <i class="fa fa-address-card-o"></i>
                                        </a>
                                    </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="mx-auto mt-3">
                    {{ $anaks->fragment('judul')->links() }}
                </div>
            </div>
        </div>
    </div> --}}

@endsection
