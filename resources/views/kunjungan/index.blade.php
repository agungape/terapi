@extends('layouts.master')
@section('menuUpload', 'collapsed')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pendaftaran Anak Terapi</h4>

                    {{-- cari anak --}}
                    <div class="row">
                        <div class="col-md-6">
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
                                                    placeholder="ENTER untuk cari data Anak" name="s" id="s"
                                                    value="{{ $s ?? '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-responsive" id="tabelHasilPencarian">
                                        <thead>
                                            <tr class="text-center">
                                                <td>NIB</td>
                                                <td>Nama</td>
                                                <td>Tanggal Lahir</td>
                                                <td>Aksi </td>
                                            </tr>
                                        </thead>
                                        @isset($result)
                                            @if (count($result) == 0)
                                                {{-- Artinya pencarian tidak ditemukan --}}
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center" colspan="4">Maaf, hasil tidak ditemukan...
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
                                                            <td>
                                                                @if ($anak->status == 'aktif')
                                                                    <a href="#" data-id="{{ $anak->id }}"
                                                                        data-nama="{{ $anak->nama }}"
                                                                        class="btn btn-gradient-primary btn-sm kirim-data">
                                                                        <i class="fa fa-address-card-o"></i>
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
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Anak</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" readonly name="anak_id">
                                        <input type="text" class="form-control" readonly name="nama" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Terapis</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single" style="width:100%" name="terapis_id">

                                            @foreach ($terapis as $terapi)
                                                <option value="{{ $terapi->id }}">{{ $terapi->nama }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="status"
                                                    id="membershipRadios1" value="hadir" checked> Hadir </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="status"
                                                    id="membershipRadios2" value="izin"> Izin </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="status"
                                                    id="membershipRadios3" value="sakit"> Sakit </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Catatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="catatan" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2"> Daftar</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('kunjungan.ajax')
@endsection
