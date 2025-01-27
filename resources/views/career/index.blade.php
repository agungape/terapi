@extends('layouts.master')
@section('menuCareer', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Career</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Career</li>
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

                            <div class="card-body p-3">
                                <div class="table-responsive">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Tgl Registrasi</th>
                                                <th>Nama</th>
                                                <th>Pendidikan</th>
                                                <th>Kualifikasi</th>
                                                <th>Pengalaman</th>
                                                <th>Motivasi</th>
                                                <th>Telepon</th>
                                                <th>CV</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($career as $c)
                                                <tr>
                                                    <td>{{ $c->updated_at }}</td>
                                                    <td>{{ $c->nama }}</td>
                                                    <td>{{ $c->pendidikan }}</td>
                                                    <td>{{ $c->kualifikasi }}</td>
                                                    <td>{{ $c->pengalaman }}</td>
                                                    <td>{{ $c->motivasi }}</td>
                                                    <td>{{ $c->telepon }}</td>
                                                    <td>


                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">Data tidak ada...</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $career->fragment('judul')->links() }}
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
