@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('menuTarif', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Paket Terapi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Data Tarif Harga</li>
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
                            @can('create tarif')
                                <div class="card-header">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data
                                    </a>
                                </div>
                            @endcan
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis terapi</th>
                                            <th>Tarif</th>
                                            <th>Aksi</th>
                                            <th>Hapus Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($tarif as $t)
                                            <tr>
                                                <td scope="row">{{ $tarif->firstItem() + $loop->iteration - 1 }}</td>
                                                <td>{{ $t->nama }}</td>
                                                <td>{{ $t->tarif }}</td>
                                                <td>

                                                    @if ($t->gambar)
                                                        <form action="{{ route('tarif.hapusGambar', $t->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                                data-name="{{ $t->nama }}"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                        <!-- Tombol untuk membuka modal -->
                                                        <button type="button" class="btn btn-info btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#modalGambar{{ $t->id }}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>

                                                        <!-- Modal Bootstrap -->
                                                        <div class="modal fade" id="modalGambar{{ $t->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="modalLabel{{ $t->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="modalLabel{{ $t->id }}">Gambar Paket
                                                                            Terapi</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <img src="{{ asset('storage/tarif/' . $t->gambar) }}"
                                                                            class="img-fluid rounded"
                                                                            alt="Gambar Paket Terapi">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-success btn-sm btn-upload-gambar"
                                                            data-toggle="modal" data-target="#modalUploadGambar"
                                                            data-id="{{ $t->id }}" data-nama="{{ $t->nama }}">
                                                            <i class="fa fa-image"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('tarif.edit', ['tarif' => $t->id]) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i> Edit Data</a>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <form action="{{ route('tarif.destroy', ['tarif' => $t->id]) }}"
                                                            method="POST">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                                title="Hapus Data" data-name="{{ $t->nama }}"
                                                                data-table="tarif"><i class="fa fa-trash"></i>
                                                                Hapus Data
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                <div class="mx-4 mt-3">
                                    {{ $tarif->fragment('judul')->links() }}
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


    <form action="{{ route('tarif.store') }}" method="POST" enctype="multipart/form-data" id="tarifForm">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Paket</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Nama Paket Terapi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Deskripsi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="deskripsi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Tarif</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tarif" id="tarif">
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

    <!-- Modal Upload Gambar -->
    <div class="modal fade" id="modalUploadGambar" tabindex="-1" aria-labelledby="modalUploadGambarLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUploadGambarLabel">Tambah Gambar untuk <span id="namaPaket"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('tarif.uploadGambar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="tarif_id" id="tarif_id_modal">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="unggah-gambar" class="custom-file-input" name="gambar"
                                    accept="image/*" required autofocus>
                                <label class="custom-file-label" for="exampleInputFile">Pilih
                                    file</label>
                            </div>
                        </div>
                        <img id="preview2" src="#" alt="Preview Gambar" style="display: none;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        function formatHarga(input) {
            let value = input.value.replace(/[^\d]/g, '');
            if (value.length > 15) {
                value = value.substring(0, 15);
            }
            if (value.length > 3) {
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            input.value = value;
        }
        document.getElementById('tarif').addEventListener('input', function(event) {
            formatHarga(event.target);
        });

        document.getElementById('tarifForm').addEventListener('submit', function(event) {
            var hargaInput = document.getElementById('tarif');
            hargaInput.value = hargaInput.value.replace(/\./g, '');
        });

        $(document).ready(function() {
            $('.btn-upload-gambar').click(function() {
                var tarifId = $(this).data('id');
                var namaPaket = $(this).data('nama');
                $('#tarif_id_modal').val(tarifId);
                $('#namaPaket').text(namaPaket);
            });
        });

        document.getElementById('unggah-gambar').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview2');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
@endsection
