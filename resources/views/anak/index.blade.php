@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('menuAnak', 'active')
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
                            <li class="breadcrumb-item active">Data Anak</li>
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
                            @can('create anak')
                                <div class="card-header">
                                    <a href="{{ route('anak.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus">
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
                                            <th> Foto</th>
                                            <th> Nama </th>
                                            <th> Usia </th>
                                            <th> Progres </th>
                                            <th> Alamat </th>
                                            <th> status </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($anaks as  $anak)
                                            <tr>
                                                <td style="vertical-align: middle;">
                                                    @can('delete anak')
                                                        <form action="{{ route('anak.destroy', ['anak' => $anak->id]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                                title="Hapus Data" data-name="{{ $anak->nama }}"
                                                                data-table="anak">
                                                                <i class="fa fa-trash fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                    @can('edit anak')
                                                        <a href="{{ route('anak.edit', ['anak' => $anak->id]) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i></a>
                                                    @endcan
                                                    @can('show anak')
                                                        <a href="{{ route('anak.show', ['anak' => $anak->id]) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-address-card"></i>
                                                        </a>
                                                    @endcan
                                                </td>
                                                <td style="vertical-align: middle;"> <img
                                                        class="profile-user-img img-circle"
                                                        src="assets/images/faces/face1.jpg" alt="User profile picture">
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    {{ $anak->nama }}
                                                </td>
                                                <td style="vertical-align: middle;"> {{ $anak->usia }} Tahun </td>

                                                <td class="project_progress" style="vertical-align: middle;">
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-green" role="progressbar"
                                                            aria-valuenow="{{ $anak->progresnilai }}" aria-valuemin="0"
                                                            aria-valuemax="100" style="width:  {{ $anak->progresnilai }}%">
                                                        </div>
                                                    </div>
                                                    <small>
                                                        {{ $anak->progresnilai }}% Selesai
                                                    </small>
                                                </td>

                                                <td style="vertical-align: middle;"> {{ $anak->alamat }} </td>


                                                <td style="vertical-align: middle;">
                                                    <form action="{{ route('anak.status') }}" method="POST">
                                                        @csrf
                                                        <input type="checkbox" class="status-checkbox"
                                                            id="status-checkbox-{{ $anak->id }}"
                                                            data-id="{{ $anak->id }}"
                                                            {{ $anak->status === 'aktif' ? 'checked' : '' }}
                                                            data-bootstrap-switch data-off-color="danger"
                                                            data-on-color="success">
                                                    </form>
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

@section('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi Bootstrap Switch
            $("input[data-bootstrap-switch]").bootstrapSwitch();

            // Ketika checkbox diubah
            $('.status-checkbox').on('switchChange.bootstrapSwitch', function(event, state) {
                var anakId = $(this).data('id'); // Ambil ID anak dari atribut data-id

                // Kirim request AJAX untuk mengubah status anak
                $.ajax({
                    url: "{{ route('anak.status') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: anakId,
                        status: state ? 'aktif' : 'nonaktif'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Tampilkan SweetAlert jika sukses
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            // Tampilkan SweetAlert jika terjadi kesalahan
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat mengubah status anak.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr) {
                        // Tampilkan SweetAlert untuk error
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan: ' + xhr.responseText,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
@endsection
