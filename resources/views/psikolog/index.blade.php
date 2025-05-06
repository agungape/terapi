@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('menuPsikolog', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Anak</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Psikolog</li>
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
                            @can('create psikolog')
                                <div class="card-header">
                                    <a href="{{ route('psikolog.create') }}" class="btn btn-primary btn-sm"><i
                                            class="fa fa-plus">
                                        </i> Tambah data
                                    </a>
                                </div>
                            @endcan
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th> Aksi</th>
                                            <th> Nama Psikolog </th>
                                            <th> Alamat </th>
                                            <th> Telepon </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($psikolog as $p)
                                            <tr>
                                                <td style="vertical-align: middle;">
                                                    @can('update psikolog')
                                                        <a href="{{ route('psikolog.edit', ['psikolog' => $p->id]) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i></a>
                                                    @endcan
                                                    @can('delete psikolog')
                                                        <form action="{{ route('psikolog.destroy', ['psikolog' => $p->id]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                                title="Hapus Data" data-name="{{ $p->nama }}"
                                                                data-table="psikolog">
                                                                <i class="fa fa-trash fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    {{ $p->nama }}
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    {{ $p->alamat }}
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    {{ $p->telepon }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center"> data tidak ada...</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>

                                <div class="mx-4 mt-3">
                                    {{ $psikolog->fragment('judul')->links() }}
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
@endsection
