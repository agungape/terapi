@extends('layouts.master')
@section('menuLogin', 'active')
@section('masterLogin', 'menu-is-opening menu-open')
@section('menuRoles', 'active')
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
                            <div class="card-header">

                                @can('create role')
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                                        Tambah Role</a>
                                @endcan

                            </div>
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

                                                    @can('update role')
                                                        <button type="button" class="btn btn-outline-warning btn-sm"
                                                            onclick="openEditModal({{ $role->id }}, '{{ $role->name }}')">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </button>
                                                    @endcan

                                                    @can('delete role')
                                                        <form action="{{ route('roles.destroy', ['id' => $role->id]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm btn-hapus"
                                                                title="Hapus Data" data-name="{{ $role->name }}"
                                                                data-table="user">
                                                                <i class="fa fa-trash fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
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


    <form action="{{ url('roles') }}" method="POST">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Role</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Nama Role</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary me-2">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <!-- Modal Edit -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editRoleForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="editRoleName" class="col-sm-4 col-form-label">Nama Role</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editRoleName" name="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        function openEditModal(roleId, roleName) {
            // Set the action URL for the form
            document.getElementById('editRoleForm').action = `/roles/${roleId}`;

            // Set the input value for the role name
            document.getElementById('editRoleName').value = roleName;

            // Open the modal
            $('#editRoleModal').modal('show');
        }
    </script>


@endsection
