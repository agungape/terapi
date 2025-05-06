@extends('layouts.master')
@section('menuAssessment', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Assessment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Assessment Anak</li>
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
                            @can('create assessment')
                                <div class="card-header">
                                    <a href="{{ route('assessment.create') }}" class="btn btn-primary btn-sm"><i
                                            class="fa fa-plus mr-2">
                                        </i>Upload Hasil Assesment
                                    </a>
                                </div>
                            @endcan
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th> Aksi</th>
                                            <th> Nama Anak </th>
                                            <th> Nama Psikolog </th>
                                            <th> File Assessment </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($assessment as $a)
                                            <tr>
                                                <td style="vertical-align: middle;">
                                                    @can('update assessment')
                                                        <a href="{{ route('assessment.edit', ['assessment' => $a->id]) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fa fa-edit"></i></a>
                                                    @endcan
                                                    @can('delete assessment')
                                                        <form
                                                            action="{{ route('assessment.destroy', ['assessment' => $a->id]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                                title="Hapus Data" data-name="assessment"
                                                                data-table="assessment">
                                                                <i class="fa fa-trash fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    {{ $a->anak->nama }}
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    {{ $a->psikolog->nama }}
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <a href="{{ asset('storage/hasil-assessment/' . $a->file_assessment) }}"
                                                        target="_blank">
                                                        {{ $a->file_assessment }}
                                                    </a>
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
                                    {{ $assessment->fragment('judul')->links() }}
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
