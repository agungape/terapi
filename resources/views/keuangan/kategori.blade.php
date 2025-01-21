@extends('layouts.master')
@section('menuKeuangan', 'active')
@section('masterKeuangan', 'menu-is-opening menu-open')
@section('menuKategori', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kategori Keuangan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Kategori</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @auth
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal"><i class="fa fa-plus pr-2"></i>Tambah Data
                                    </a>
                                @endauth
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>kategori</th>
                                            <th>Jenis</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($kategoris as $kategori)
                                            <tr>
                                                <td scope="row">{{ $kategoris->firstItem() + $loop->iteration - 1 }}</td>
                                                <td>{{ $kategori->nama }}</td>
                                                @if ($kategori->jenis == 'Pemasukkan')
                                                    <td><span class="badge bg-success">
                                                            {{ $kategori->jenis }}</span>
                                                    </td>
                                                @else
                                                    <td><span class="badge bg-danger">
                                                            {{ $kategori->jenis }}</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <form
                                                            action="{{ route('kategori.destroy', ['kategori' => $kategori->id]) }}"
                                                            method="POST">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm btn-hapus"
                                                                title="Hapus Data" data-name="{{ $kategori->nama }}"
                                                                data-table="program">
                                                                <i class="fa fa-trash fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <div class="mx-4 mt-3">
                                    {{ $kategoris->fragment('judul')->links() }}
                                </div>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>


    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama">
                            </div>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Jenis</label>
                            <div class="col-sm-8">
                                <select name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                                    @foreach ($jenis as $value => $label)
                                        @if ($value == old('jenis'))
                                            <option value="{{ $value }}" selected>
                                                {{ $label }}</option>
                                        @else
                                            <option value="{{ $value }}">
                                                {{ $label }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('jenis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
