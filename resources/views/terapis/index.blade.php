@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'show')
@section('menuTerapis', 'active')
@section('content')



    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Database Terapis</h4>
                @auth
                    <a href="{{ route('terapis.create') }}" class="btn btn-gradient-success btn-sm"><i class="fa fa-plus"></i>
                    </a>
                @endauth

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th> No. Induk</th>
                                <th> Nama </th>
                                <th> Usia </th>
                                <th> Alamat </th>
                                <th> status </th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($t as $terapis)
                                <tr>
                                    <td>{{ $terapis->nib }}</td>
                                    <td>
                                        <img src="assets/images/faces/face6.jpg" class="me-2"
                                            alt="image">{{ $terapis->nama }}
                                    </td>
                                    <td> {{ $terapis->usia }} Tahun </td>
                                    <td> {{ $terapis->alamat }} </td>
                                    <td> {{ $terapis->status }} </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('terapis.show', ['terapi' => $terapis->id]) }}"
                                                class="btn btn-gradient-info btn-sm">
                                                <i class="fa fa-address-card-o"></i>
                                            </a>
                                            <a href="{{ route('terapis.edit', ['terapi' => $terapis->id]) }}"
                                                class="btn btn-gradient-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('terapis.destroy', ['terapi' => $terapis->id]) }}"
                                                method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-gradient-danger btn-sm btn-hapus"
                                                    title="Hapus Data" data-name="{{ $terapis->nama }}"
                                                    data-table="terapis">
                                                    <i class="fa fa-trash fa-fw"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center"> Data Terapis tidak ada</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
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
