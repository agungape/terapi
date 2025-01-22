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
                    <!-- Card untuk List Role -->
                    <section class="col-12 col-lg-6 mb-3">
                        <div class="card">
                            <div class="card-body table-responsive px-3">
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
                                                <td scope="row">{{ $roles->firstItem() + $loop->iteration - 1 }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    <a href="{{ url('roles/' . $role->id . '/give-permissions') }}"
                                                        class="btn btn-success btn-sm">
                                                        Add/Edit Permission
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $roles->fragment('judul')->links() }}
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Card untuk Edit Permission -->
                    <section class="col-12 col-lg-6 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Role: {{ $r->name }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('roles/' . $r->id . '/give-permissions') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <ul class="list-group">
                                        @foreach ($menus as $menu)
                                            <li class="list-group-item list-group-item-success">
                                                {{ $menu->name }}
                                            </li>
                                            <div class="row">
                                                @foreach ($menu->permissions as $permission)
                                                    <div class="col-md-6 col-sm-12">
                                                        <li class="list-group-item border-0">
                                                            <div class="d-flex align-items-center">
                                                                <input type="checkbox" class="permission-switch"
                                                                    name="permission[]" value="{{ $permission->name }}"
                                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    data-bootstrap-switch data-off-color="danger"
                                                                    data-on-color="success" data-on-text="Yes"
                                                                    data-off-text="No">
                                                                <label class="ml-2">{{ $permission->name }}</label>
                                                            </div>
                                                        </li>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach

                                        @if ($otherPermissions->isNotEmpty())
                                            <li class="list-group-item list-group-item-success">
                                                Lainnya
                                            </li>
                                            <div class="row">
                                                @foreach ($otherPermissions as $permission)
                                                    <div class="col-md-6 col-sm-12">
                                                        <li class="list-group-item border-0">
                                                            <div class="d-flex align-items-center">
                                                                <input type="checkbox" class="permission-switch"
                                                                    name="permission[]" value="{{ $permission->name }}"
                                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    data-bootstrap-switch data-off-color="danger"
                                                                    data-on-color="success" data-on-text="Yes"
                                                                    data-off-text="No">
                                                                <label class="ml-2">{{ $permission->name }}</label>
                                                            </div>
                                                        </li>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </ul>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi Bootstrap Switch
            $("input[data-bootstrap-switch]").bootstrapSwitch();

        });
    </script>
@endsection
