@extends('layouts.master')
@section('menuObservasi', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Observasi Anak</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Observasi</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                {{-- <div class="row">
                    <!-- Form Observasi -->
                    <div class="col-12 col-lg-5 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Observasi</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('observasi.mulai') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label">Anak</label>
                                        <div class="col-12 col-sm-9">
                                            <select class="form-control select2" style="width: 100%;" name="anak_id">
                                                @forelse ($anaks as $anak)
                                                    <option value="{{ $anak->id }}">{{ $anak->nama }}</option>
                                                @empty
                                                    <option value="">data belum ada</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 col-sm-3 col-form-label">Jenis</label>
                                        <div class="col-12 col-sm-9">
                                            <select class="form-control select2" style="width: 100%;" name="jenis"
                                                id="jenis">
                                                @forelse ($jenis as $value => $label)
                                                    <option value="{{ $value }}"
                                                        {{ $value == old('jenis') ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @empty
                                                    <option value="">data belum ada</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-sm-3">
                                        </div>
                                        <div class="col-12 col-sm-9">
                                            @if ($anaks)
                                                <button id="startButton" type="submit"
                                                    class="btn btn-sm btn-primary btn-block">
                                                    Mulai
                                                </button>
                                            @else
                                                <button id="startButton" type="submit"
                                                    class="btn btn-sm btn-primary btn-block" disabled>
                                                    Mulai
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Data Observasi -->
                    <div class="col-12 col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Data Observasi Anak</h4>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="data-tables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Anak</th>
                                                <th>Jenis</th>
                                                <th>Tanggal Observasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($observasi as $o)
                                                <tr>
                                                    <td>{{ $observasi->firstItem() + $loop->iteration - 1 }}</td>
                                                    <td>{{ $o->anak->nama }}</td>
                                                    <td>{{ $o->jenis }}</td>
                                                    <td>{{ $o->created_at }}</td>
                                                    <td>
                                                        @if ($o->jenis == 'atec')
                                                            <button class="btn btn-outline-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#modalGambar{{ $o->id }}">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="modalGambar{{ $o->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="modalLabel{{ $o->id }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="modalLabel{{ $o->id }}">
                                                                                Hasil Atec</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <img src="{{ asset('storage/atec/' . $o->gambar_atec) }}"
                                                                                class="img-fluid rounded" alt="Gambar">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">data belum ada</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $observasi->fragment('judul')->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th> Observasi</th>
                                            <th> Nama </th>
                                            <th> Alamat </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($anaks as  $anak)
                                            <tr>
                                                <td style="vertical-align: middle;">
                                                    @can('create observasi')
                                                        <a href="{{ route('observasi.show', ['anak' => $anak->id]) }}"
                                                            class="btn btn-info btn-sm">
                                                            <i class="fas fa-book"></i>
                                                        </a>
                                                    @endcan
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    {{ $anak->nama }}
                                                </td>
                                                <td style="vertical-align: middle;"> {{ $anak->alamat }} </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center"> data tidak ada...</td>
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
