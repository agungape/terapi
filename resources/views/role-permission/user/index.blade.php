@extends('layouts.master')
@section('menuLogin', 'active')
@section('masterLogin', 'menu-is-opening menu-open')
@section('menuUserlogin', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Login</li>
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
                                @can('create user')
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahModal"><i
                                            class="fa fa-plus mr-1"></i>Tambah User
                                    </button>
                                @endcan

                                @can('create user anak')
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahModalAnak"><i
                                            class="fa fa-plus mr-1"></i>Tambah User Anak
                                    </button>
                                @endcan

                                @can('create user terapis')
                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#tambahModalTerapis"><i class="fa fa-plus mr-1"></i>Tambah User Terapis
                                    </button>
                                @endcan



                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-5">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th> #</th>
                                            <th> Name</th>
                                            <th> Username </th>
                                            <th> Email </th>
                                            <th> Last Login </th>
                                            <th> Role </th>
                                            <th> Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($users as  $user)

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
                                            <td style="vertical-align: middle;">
                                                {{ $user->last_login_duration }}
                                            </td>
                                            <td>
                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $rolename)
                                                        <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @can('update user')
                                                    <button type="button" title="edit" class="btn btn-outline-info btn-sm"
                                                        data-toggle="modal" data-target="#editModal"
                                                        data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}" data-username="{{ $user->username }}"
                                                        data-role="{{ $user->getRoleNames()->implode(',') }}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                @endcan

                                                @can('delete user')
                                                    <form action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm btn-hapus"
                                                            title="Hapus Data" data-name="{{ $user->name }}"
                                                            data-table="user">
                                                            <i class="fa fa-trash fa-fw"></i>
                                                        </button>
                                                    </form>
                                                @endcan

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


    {{-- Modal Tambah user --}}
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white d-flex justify-content-center">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah User</h5>
                </div>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row mb-3">
                            <input type="hidden" name="form" value="tambah">
                            <label for="tambahInputMobile" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
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
                                    value="{{ old('email') }}" autocomplete="email">
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
                            <label class="col-sm-4 col-form-label">{{ __('Roles') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" name="roles[]" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>

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

    {{-- modal tambah user anak --}}
    <div class="modal fade" id="tambahModalAnak" tabindex="-1" aria-labelledby="tambahModalLabelAnak"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white d-flex justify-content-center">
                    <h5 class="modal-title" id="tambahModalLabelAnak">Tambah User Anak</h5>
                </div>
                <form action="{{ route('usersanak.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row mb-3">
                            <label for="tambahInputMobilnama" class="col-sm-4 col-form-label">Anak</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="formanak" value="tambahanak">
                                <select class="form-control @error('name') is-invalid @enderror select2"
                                    style="width:100%" name="name">
                                    @forelse ($anaks as $anak)
                                        <option value="{{ $anak->nama }}">{{ $anak->nama }}
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
                            <label for="usernameanak" class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input id="usernameanak" type="text"
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
                            <label for="passwordanak" class="col-sm-4 col-form-label">{{ __('Password') }}</label>
                            <div class="col-sm-8">
                                <input id="passwordanak" type="password"
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
                            <label for="password-confirmanak"
                                class="col-sm-4 col-form-label">{{ __('Confirm Password') }}</label>
                            <div class="col-sm-8">
                                <input id="password-confirmanak" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="roleanak" class="col-sm-4 col-form-label">{{ __('Roles') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" name="roles[]" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">
                            {{ __('Register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal tambah user Terapis --}}
    <div class="modal fade" id="tambahModalTerapis" tabindex="-1" aria-labelledby="tambahModalLabelTerapis"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white d-flex justify-content-center">
                    <h5 class="modal-title" id="tambahModalLabelTerapis">Tambah User Terapis</h5>
                </div>
                <form action="{{ route('usersterapis.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row mb-3">
                            <label for="tambahInputMobilnama" class="col-sm-4 col-form-label">Terapis</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="formterapis" value="tambahterapis">
                                <select class="form-control @error('name') is-invalid @enderror select2"
                                    style="width:100%" name="name">
                                    @forelse ($terapis as $t)
                                        <option value="{{ $t->nama }}">{{ $t->nama }}
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
                            <label for="usernameterapis" class="col-sm-4 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input id="usernameterapis" type="text"
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
                            <label for="emailterapis" class="col-sm-4 col-form-label">{{ __('Email Address') }}</label>
                            <div class="col-sm-8">
                                <input id="emailterapis" type="email"
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
                            <label for="passwordterapis" class="col-sm-4 col-form-label">{{ __('Password') }}</label>
                            <div class="col-sm-8">
                                <input id="passwordterapis" type="password"
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
                            <label for="password-confirmterapis"
                                class="col-sm-4 col-form-label">{{ __('Confirm Password') }}</label>
                            <div class="col-sm-8">
                                <input id="password-confirmterapis" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="roleterapis" class="col-sm-4 col-form-label">{{ __('Roles') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" name="roles[]" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">
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
                <form id="editUserForm" action="{{ route('users.update', ':id') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group row mb-3">
                            <label for="editName" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="hidden" name="form" value="edit">
                                <input id="editName" type="text"
                                    class="form-control @error('name') is-invalid @enderror " name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
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
                            <label for="editEmail" class="col-sm-4 col-form-label">{{ __('Email Address') }}</label>
                            <div class="col-sm-8">
                                <input id="editEmail" type="email"
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
                            <label for="editPassword" class="col-sm-4 col-form-label">{{ __('Password') }}</label>
                            <div class="col-sm-8">
                                <input id="editPassword" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password" placeholder="ketik untuk mengubah kata sandi">
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
                                <input id="editPassword_confirmation" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="validationCustom04" class="col-sm-4 col-form-label">{{ __('Level') }}</label>
                            <div class="col-sm-8">
                                <select class="form-control select2" id="roles" name="roles[]" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
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
            let roles = button.data('role').split(',');

            // Isi form dengan data pengguna
            var modal = $(this);
            modal.find('#editName').val(name);
            modal.find('#editEmail').val(email);
            modal.find('#editUsername').val(username);

            // Reset dan isi ulang select role
            let rolesSelect = modal.find('#roles');
            rolesSelect.val([]).trigger('change'); // Reset value
            roles.forEach(role => {
                rolesSelect.find(`option[value="${role}"]`).prop('selected', true);
            });
            rolesSelect.trigger('change'); // Refresh tampilan select2

            // Update action form
            var actionUrl = "{{ route('users.update', ':id') }}".replace(':id', id);
            modal.find('#editUserForm').attr('action', actionUrl);
        })

        let isErrorTambah = @json($errors->any() && old('form') == 'tambah');
        if (isErrorTambah) {
            $('#tambahModal').modal('show');
        }

        let isErrorTambahAnak = @json($errors->any() && old('formanak') == 'tambahanak');
        if (isErrorTambahAnak) {
            $('#tambahModalAnak').modal('show');
        }

        let isErrorTambahTerapis = @json($errors->any() && old('formterapis') == 'tambahterapis');
        if (isErrorTambahTerapis) {
            $('#isErrorTambahTerapis').modal('show');
        }

        let iserror_edit = @json ($errors->any() && old('form') == 'edit');
        if (iserror_edit) {
            $('#editModal').modal('show');
        }
    </script>

@endsection
