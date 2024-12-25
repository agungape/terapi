@extends('layouts.master')
@section('menuLogin', 'active')
@section('masterLogin', 'menu-is-opening menu-open')
@section('menuTerapislogin', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Login Terapis</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Login Terapis</li>
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
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahModal"><i
                                            class="fa fa-plus mr-1"></i>Tambah Data
                                    </button>
                                @endauth

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th> #</th>
                                            <th> Nama </th>
                                            <th> Username </th>
                                            <th> Password </th>
                                            <th> Role </th>
                                            <th> Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($users as  $user)
                                            <tr>
                                                <td scope="row">{{ $users->firstItem() + $loop->iteration - 1 }}
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    {{ $user->name }}
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    {{ $user->username }}
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    {{ $user->email }}
                                                </td>
                                                <td>
                                                    {{ $user->role }}
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('userterapis.destroy', ['userterapi' => $user->id]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                            title="Hapus Data" data-name="{{ $user->name }}"
                                                            data-table="user">
                                                            <i class="fa fa-trash fa-fw"></i>
                                                        </button>
                                                    </form>
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        data-toggle="modal" data-target="#editModal"
                                                        data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}"
                                                        data-username="{{ $user->username }}"
                                                        data-role="{{ $user->role }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center"> data tidak ada...</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>

                                <div class="mx-4 mt-3">
                                    {{ $users->fragment('judul')->links() }}
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


    {{-- Modal Tambah --}}
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah User</h5>
                </div>
                <form action="{{ route('userterapis.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group row mb-3">
                            <label for="tambahInputMobile" class="col-sm-4 col-form-label">Terapis</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="form" value="tambah">
                                <select class="form-control @error('name') is-invalid @enderror select2" style="width:100%"
                                    name="name">
                                    @forelse ($terapis as $terapi)
                                        <option value="{{ $terapi->nama }}">{{ $terapi->nama }}
                                        </option>
                                    @empty
                                        <option>tidak ada data</option>
                                    @endforelse
                                </select>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="tambahInputMobile" class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="email" class="col-sm-4 col-form-label">{{ __('Email Address') }}</label>
                            <div class="col-sm-8">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="password" class="col-sm-4 col-form-label">{{ __('Password') }}</label>
                            <div class="col-sm-8">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="password-confirm"
                                class="col-sm-4 col-form-label">{{ __('Confirm Password') }}</label>
                            <div class="col-sm-8">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="role" class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <input id="role" type="text" class="form-control" name="role"
                                    value="{{ 'Terapis' }}" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                </div>
                <form id="editUserForm" action="{{ route('userterapis.update', ':id') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group row mb-3">
                            <label for="editName" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="form" value="edit">
                                <input id="editName" type="text"
                                    class="form-control @error('name_edit') is-invalid @enderror " name="name_edit"
                                    value="{{ old('name_edit') }}" required autocomplete="name_edit" autofocus>
                                @error('name_edit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="editUsername" class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input id="editUsername" type="text"
                                    class="form-control @error('username_edit') is-invalid @enderror" name="username_edit"
                                    value="{{ old('username_edit') }}" required autocomplete="username_edit" autofocus>
                                @error('username_edit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="editEmail" class="col-sm-4 col-form-label">{{ __('Email Address') }}</label>
                            <div class="col-sm-8">
                                <input id="editEmail" type="email"
                                    class="form-control @error('email_edit') is-invalid @enderror" name="email_edit"
                                    value="{{ old('email_edit') }}" required autocomplete="email_edit">
                                @error('email_edit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="editPassword" class="col-sm-4 col-form-label">{{ __('Password') }}</label>
                            <div class="col-sm-8">
                                <input id="editPassword" type="password"
                                    class="form-control @error('password_edit') is-invalid @enderror" name="password_edit"
                                    autocomplete="new-password">
                                @error('password_edit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="password-confirm"
                                class="col-sm-4 col-form-label">{{ __('Confirm Password') }}</label>
                            <div class="col-sm-8">
                                <input id="editPassword_confirmation" type="password" class="form-control"
                                    name="password_confirmation_edit" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="validationCustom04" class="col-sm-4 col-form-label">{{ __('Level') }}</label>
                            <div class="col-sm-8">
                                <input id="role" type="text" class="form-control" name="role_edit"
                                    value="{{ 'Terapis' }}" readonly required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary"> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    <script>
        // Mengisi form modal edit dengan data pengguna
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button yang diklik
            var id = button.data('id');
            var name = button.data('name');
            var email = button.data('email');
            var username = button.data('username');
            var role = button.data('role');

            // Isi form dengan data pengguna
            var modal = $(this);
            modal.find('#editName').val(name);
            modal.find('#editEmail').val(email);
            modal.find('#editUsername').val(username);
            modal.find('#editRole').val(role);

            // Update action form
            var actionUrl = "{{ route('userterapis.update', ':id') }}".replace(':id', id);
            modal.find('#editUserForm').attr('action', actionUrl);
        });

        let iserror_tambah = @json ($errors->any() && old('form') == 'tambah');
        if (iserror_tambah) {
            $('#tambahModal').modal('show');
        }

        let iserror_edit = @json ($errors->any() && old('form') == 'edit');
        if (iserror_edit) {
            $('#editModal').modal('show');
        }
    </script>

@endsection
