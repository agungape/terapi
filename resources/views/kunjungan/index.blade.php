@extends('layouts.master')
@section('menuKunjungan', 'active')
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
                            <li class="breadcrumb-item active">Pendaftaran Anak</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 px-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Tanggal / Waktu</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control"
                                                    value="{{ Carbon\Carbon::now()->format('d/m/Y') }}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form class="form-sample" action="{{ url('/pencarian/proses') }}" method="GET">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Anak</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"
                                                        placeholder="ENTER untuk cari data Anak" name="s"
                                                        id="s" value="{{ $s ?? '' }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 px-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-hover text-nowrap" id="tabelHasilPencarian">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>NIB</th>
                                                    <th>Nama</th>
                                                    <th>Tanggal Lahir</th>
                                                    <th>Aksi </th>
                                                </tr>
                                            </thead>
                                            @isset($result)
                                                @if (count($result) == 0)
                                                    {{-- Artinya pencarian tidak ditemukan --}}
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center" colspan="4">Maaf, hasil tidak
                                                                ditemukan...
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                @else
                                                    <tbody id="hasilPencarianBody">

                                                        @foreach ($result as $anak)
                                                            <tr>
                                                                <th>{{ $anak->nib }}</th>
                                                                <td>{{ $anak->nama }}</td>
                                                                <td>{{ $anak->tanggal_lahir }}</td>
                                                                <td class="text-center">
                                                                    @if ($anak->status == 'aktif')
                                                                        <a href="#" data-id="{{ $anak->id }}"
                                                                            data-nama="{{ $anak->nama }}"
                                                                            class="btn btn-success btn-sm kirim-data">
                                                                            <i class="fa fa-user-plus"></i>
                                                                        </a>
                                                                    @else
                                                                        <b>Nonaktif</b>
                                                                    @endif

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                @endif
                                            @endisset
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <form action="{{ route('kunjungan.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 px-5 py-4">
                                    <div class="form-group row pb-4">
                                        <label class="col-sm-3 col-form-label">Nama Anak</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" readonly name="anak_id">
                                            <input type="text" class="form-control" readonly name="nama" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-3">
                                            <div class="icheck-primary">
                                                <input type="radio" id="radioPrimary1" name="status" value="hadir">
                                                <label for="radioPrimary1"> Hadir
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="icheck-primary">
                                                <input type="radio" id="radioPrimary2" name="status" value="izin">
                                                <label for="radioPrimary2"> Izin
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="icheck-primary">
                                                <input type="radio" id="radioPrimary3" name="status" value="sakit">
                                                <label for="radioPrimary3"> Sakit
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 px-5 py-4">
                                    <div class="form-group row pb-4">
                                        <label class="col-sm-3 col-form-label">Terapis</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2" style="width:100%" name="terapis_id">
                                                @forelse ($terapis as $terapi)
                                                    <option value="{{ $terapi->id }}">{{ $terapi->nama }}</option>
                                                @empty
                                                    <option>tidak ada data</option>
                                                @endforelse


                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Catatan</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="catatan" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2"> Daftar</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    @include('kunjungan.ajax')
@endsection
