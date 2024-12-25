@extends('layouts.master')
@section('menuJadwal', 'active')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Jadwal Anak</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Jadwal Anak</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <form action="{{ route('jadwal.update', ['jadwal' => $jadwal->id]) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group row mb-3">
                                            <label for="tambahInputMobile" class="col-sm-4 col-form-label">Anak</label>
                                            <div class="col-sm-8">
                                                <input type="text"
                                                    class="form-control @error('anak_id') is-invalid @enderror" autofocus
                                                    value="{{ old('anak_id') ?? ($jadwal->anak->nama ?? '') }}" readonly>
                                                @error('anak_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="tambahInputMobile" class="col-sm-4 col-form-label">Terapis</label>
                                            <div class="col-sm-8">
                                                <select
                                                    class="form-control @error('terapis_id') is-invalid @enderror select2"
                                                    style="width:100%" name="terapis_id">

                                                    @forelse ($terapis as $terapi)
                                                        @if ($terapi->id == (old('terapis_id') ?? ($jadwal->terapis_id ?? '')))
                                                            <option value="{{ $terapi->id }}" selected>{{ $terapi->nama }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $terapi->id }}">{{ $terapi->nama }}
                                                            </option>
                                                        @endif
                                                    @empty
                                                        <option>tidak ada data</option>
                                                    @endforelse
                                                </select>
                                                @error('terapis_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="tambahInputMobile" class="col-sm-4 col-form-label">Tanggal</label>
                                            <div class="col-sm-8">
                                                <div class="input-group date" id="reservationdate"
                                                    data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        data-target="#reservationdate" name="tanggal"
                                                        value="{{ old('tanggal', $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->format('Y-m-d') : '') }}" />
                                                    <div class="input-group-append" data-target="#reservationdate"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="email" class="col-sm-4 col-form-label">Waktu (*wita)</label>
                                            <div class="col-sm-8">
                                                <select name="waktu"
                                                    class="form-control @error('waktu') is-invalid @enderror select2">
                                                    @foreach ($waktu as $value => $label)
                                                        <option value="{{ $value }}"
                                                            {{ $value == old('waktu', $jadwal->waktu) ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('waktu')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('jadwal.index') }}" class="btn btn-success btn-sm"><i
                                                class="fa fa-arrow-alt-circle-left"></i>
                                            Kembali</a>
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Update Jadwal</button>

                                    </div>
                                </form>

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">

                                <div class="card-tools">

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th> Hari & Tanggal</th>
                                            <th> Waktu</th>
                                            <th> Nama Anak</th>
                                            <th> Terapis </th>
                                            <th> Pertemuan </th>
                                            <th> Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse  ($jadwals as $jadwal)
                                            <tr>
                                                <td>{{ $jadwal->hari }}, {{ $jadwal->tanggal }}</td>
                                                <td>{{ $jadwal->waktu }} Wita</td>
                                                <td>{{ $jadwal->anak->nama }}</td>
                                                <td>{{ $jadwal->terapis->nama }}</td>
                                                <td> Pertemuan {{ $jadwal->pertemuan }}</td>
                                                <td>
                                                    <form action="{{ route('jadwal.destroy', ['jadwal' => $jadwal->id]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                            title="Hapus Data" data-table="jadwal"
                                                            data-name="{{ $jadwal->anak->nama }}">
                                                            <i class="fa fa-trash fa-fw"></i>
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('jadwal.edit', ['jadwal' => $jadwal->id]) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">data jadwal hari ini belum ada</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="mx-4 mt-3">
                                    {{ $jadwals->fragment('judul')->links() }}
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