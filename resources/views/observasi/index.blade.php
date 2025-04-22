@extends('layouts.master')
@section('menuObservasi', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Observasi Anak</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Observasi</li>
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
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th> Observasi</th>
                                            <th> Nama </th>
                                            <th> Alamat </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($anaks as  $anak)
                                            <tr>
                                                <td style="vertical-align: middle;">
                                                    @can('create observasi')
                                                        <a href="{{ route('observasi.show', ['anak' => $anak->id]) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-book"></i>
                                                        </a>
                                                    @endcan
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    {{ $anak->nama }}
                                                </td>
                                                <td style="vertical-align: middle;"> {{ $anak->alamat }} </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center"> data tidak ada...</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="mx-4 mt-3">
                                    {{ $anaks->fragment('judul')->links() }}
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
