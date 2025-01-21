@extends('layouts.master')
@section('menuLogin', 'active')
@section('masterLogin', 'menu-is-opening menu-open')
@section('menuMenu', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Roles</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Roles</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-12 col-lg-6 mb-3">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body table-responsive px-5">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Role/Group</th>
                                            <th width="40%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($roles as $role)
                                            <tr>
                                                <td scope="row">{{ $roles->firstItem() + $loop->iteration - 1 }}
                                                </td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    <a href="{{ url('roles/' . $role->id . '/give-permissions') }}"
                                                        class="btn btn-success btn-sm">
                                                        Add / Edit Role Permission
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mx-4 mt-3">
                                    {{ $roles->fragment('judul')->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
