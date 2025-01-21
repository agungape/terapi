@extends('layouts.master')
@section('menuLogin', 'active')
@section('masterLogin', 'menu-is-opening menu-open')
@section('menuPermissions', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Permission</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Permission</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">

                                @can('create role')
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal" class="btn btn-primary btn-sm"><i
                                            class="fa fa-plus mx-1"></i>
                                        Tambah Permission</a>
                                @endcan

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive pl-5">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Permission</th>
                                            <th>Menu Terkait</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td scope="row">{{ $permissions->firstItem() + $loop->iteration - 1 }}
                                                </td>
                                                <td>{{ $permission->name }}</td>
                                                <td>
                                                    @if ($permission->menu == true)
                                                        {{ $permission->menu->name }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @can('update permission')
                                                        <button type="button" class="btn btn-outline-warning btn-sm"
                                                            onclick="openEditModal({{ $permission->id }}, '{{ $permission->name }}')">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </button>
                                                    @endcan

                                                    @can('delete permission')
                                                        <form
                                                            action="{{ route('permissions.destroy', ['id' => $permission->id]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm btn-hapus"
                                                                title="Hapus Data" data-name="{{ $permission->name }}"
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
                                    {{ $permissions->fragment('judul')->links() }}
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


    <form action="{{ url('permissions') }}" method="POST">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Permission</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row mb-3">
                            <label for="name" class="col-sm-4 col-form-label text-end">Nama Permission</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="" class="col-sm-4 col-form-label text-end"></label>
                            <div class="col-sm-8">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="toggleSelect">
                                    <label class="form-check-label" for="toggleSelect">Aktifkan Pilihan Menu</label>
                                </div>
                            </div>
                        </div>

                        <div id="selectContainer" style="display: none">
                            <div class="form-group row mb-3">
                                <label for="menuSelect" class="col-sm-4 col-form-label text-end">Pilih Menu</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" id="menuSelect" style="width: 100%;">
                                        @forelse ($menus as $menu)
                                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                        @empty
                                            <option>Tidak ada data</option>
                                        @endforelse
                                    </select>
                                </div>
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
    <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-labelledby="editPermissionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="editPermissionForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPermissionModalLabel">Edit Permission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="editPermissionName" class="col-sm-4 col-form-label">Nama Permission</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editPermissionName" name="name"
                                    required>
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
        function openEditModal(permissionId, permissionName) {
            // Set the action URL for the form
            document.getElementById('editPermissionForm').action = `/permissions/${permissionId}`;

            // Set the input value for the Permission name
            document.getElementById('editPermissionName').value = permissionName;

            // Open the modal
            $('#editPermissionModal').modal('show');
        }

        document.getElementById('toggleSelect').addEventListener('change', function() {
            const selectContainer = document.getElementById('selectContainer');
            const menuSelect = document.getElementById('menuSelect');

            if (this.checked) {
                selectContainer.style.display = 'block'; // Tampilkan dropdown
                menuSelect.setAttribute('name', 'menu_id'); // Tambahkan atribut name
            } else {
                selectContainer.style.display = 'none'; // Sembunyikan dropdown
                menuSelect.removeAttribute('name'); // Hapus atribut name
            }
        });
    </script>


@endsection
