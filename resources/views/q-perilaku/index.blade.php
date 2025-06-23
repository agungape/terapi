@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('deteksiShow', 'menu-is-opening menu-open')
@section('deteksiPerilaku', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Deteksi Perilaku</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Deteksi</li>
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
                            @can('create deteksi qperilaku')
                                <div class="card-header">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data
                                    </a>
                                </div>
                            @endcan
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <div class="table-responsive mb-4">
                                    <table class="table table-hover text-nowrap">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Pertanyaan</th>
                                                <th class="text-center" style="width: 120px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($perilaku as $q)
                                                <tr>
                                                    <td>{{ $q->question_text }}</td>
                                                    <td class="text-center">
                                                        @can('delete qperilaku')
                                                            <form action="{{ route('qperilaku.destroy', ['id' => $q->id]) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                                    title="Hapus Data" data-table="program"
                                                                    data-name="question">
                                                                    <i class="fa fa-trash fa-fw"></i>
                                                                </button>

                                                            </form>
                                                        @endcan
                                                        @can('update qperilaku')
                                                            <button type="button" class="btn btn-outline-warning btn-sm m-1"
                                                                onclick="openEditModal({{ $q->id }}, '{{ $q->question_text }}')">
                                                                <i class="fa fa-pencil-alt"></i>
                                                            </button>
                                                        @endcan

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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


    <form action="{{ route('qperilaku.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Question</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-2 col-form-label">Pertanyaan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="question_text">
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

    <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Question</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="editName" class="col-sm-2 col-form-label">Question</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="editQuestion" name="question_text" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script>
        function openEditModal(Id, Question) {
            // Set the action URL for the form
            document.getElementById('editForm').action = `/q-perilaku/update/${Id}`;
            // Set the input value for the role name
            document.getElementById('editQuestion').value = Question;

            // Open the modal
            $('#editModal').modal('show');
        }
    </script>


@endsection
