@extends('layouts.master')
@section('menuUpload', 'collapsed')
@section('content')

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Database Anak</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> No. Induk</th>
                                    <th> Nama </th>
                                    <th> Terapis </th>
                                    <th> Pertemuan </th>
                                    <th> Tanggal Daftar </th>
                                    <th> Status </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kunjungan as $kun)
                                    <tr>
                                        <td>{{ $kun->anak->nib }}</td>
                                        <td>
                                            <img src="assets/images/faces/face1.jpg" class="me-2"
                                                alt="image">{{ $kun->anak->nama }}
                                        </td>
                                        <td> {{ $kun->terapis->nama }} </td>
                                        <td> Pertemuan {{ $kun->pertemuan }} </td>
                                        <td> {{ $kun->created_at }} </td>
                                        <td>
                                            @if ($kun->status == 'hadir')
                                                <label class="badge badge-success">{{ $kun->status }}</label>
                                            @endif
                                            @if ($kun->status == 'izin')
                                                <label class="badge badge-warning">{{ $kun->status }}</label>
                                            @endif
                                            @if ($kun->status == 'sakit')
                                                <label class="badge badge-danger">{{ $kun->status }}</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($kun->status == 'hadir')
                                                <a href="{{ route('kunjungan.show', ['kunjungan' => $kun->id]) }}"
                                                    class="btn
                                                btn-gradient-primary btn-sm">
                                                    <i class="fa fa-address-card-o"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="row">
                            <div class="mx-auto mt-3">
                                {{ $kunjungan->fragment('judul')->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
