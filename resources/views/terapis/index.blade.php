@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('menuTerapis', 'active')
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
                            <li class="breadcrumb-item active">Data Terapis</li>
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
                            @can('create terapis')
                                <div class="card-header">
                                    <a href="{{ route('terapis.create') }}" class="btn btn-primary btn-sm"><i
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
                                            <th> No. Induk</th>
                                            <th> Nama </th>
                                            <th> Usia </th>
                                            <th> Alamat </th>
                                            <th> Status </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($terapis as  $t)
                                            <tr>

                                                <td style="vertical-align: middle;">
                                                    @can('show terapis')
                                                        <a href="{{ route('terapis.show', ['terapi' => $t->id]) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-address-card"></i>
                                                        </a>
                                                    @endcan
                                                    @can('update terapis')
                                                        <a href="{{ route('terapis.edit', ['terapi' => $t->id]) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i></a>
                                                    @endcan
                                                    @can('delete terapis')
                                                        <form action="{{ route('terapis.destroy', ['terapi' => $t->id]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                                title="Hapus Data" data-name="{{ $t->nama }}"
                                                                data-table="terapis">
                                                                <i class="fa fa-trash fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </td>

                                                <td style="vertical-align: middle;"><img
                                                        class="profile-user-img img-circle fixed-size"
                                                        src="{{ $t->foto ? asset('storage/terapis/' . $t->foto) : asset('assets/images/faces/face1.jpg') }}"
                                                        alt="User profile picture">
                                                </td>
                                                <td style="vertical-align: middle;">{{ $t->nib }}</td>
                                                <td style="vertical-align: middle;">
                                                    {{ $t->nama }}
                                                </td>
                                                <td style="vertical-align: middle;"> {{ $t->usia }} Tahun </td>

                                                <td style="vertical-align: middle;"> {{ $t->alamat }} </td>



                                                <td style="vertical-align: middle;">
                                                    @can('update terapis')
                                                        <form action="{{ route('terapis.status') }}" method="POST">
                                                            @csrf
                                                            <input type="checkbox" class="status-checkbox"
                                                                id="status-checkbox-{{ $t->id }}"
                                                                data-id="{{ $t->id }}"
                                                                {{ $t->status === 'aktif' ? 'checked' : '' }}
                                                                data-bootstrap-switch data-off-color="danger"
                                                                data-on-color="success">
                                                        </form>
                                                    @endcan

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
                                    {{ $terapis->fragment('judul')->links() }}
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
                var terapisId = $(this).data('id'); // Ambil ID anak dari atribut data-id

                // Kirim request AJAX untuk mengubah status anak
                $.ajax({
                    url: "{{ route('terapis.status') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: terapisId,
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
