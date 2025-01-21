@extends('layouts.master')
@section('menuKeuangan', 'active')
@section('masterKeuangan', 'menu-is-opening menu-open')
@section('menuPemasukkan', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pemasukkan Keuangan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Pemasukkan</li>
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
                            <div class="card-header">
                                <div class="container-fluid">
                                    @auth
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                                data-toggle="dropdown">
                                                <i class="fa fa-plus pr-2"></i> Tambah Data
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-left">
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#modal1">
                                                    <i class="fa fa-plus pr-2"></i>Pembayaran Anak
                                                </a>
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#modal2">
                                                    <i class="fa fa-plus pr-2"></i>Pemasukkan Lain
                                                </a>
                                            </div>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                            <div class="row justify-content-md-start justify-content-center align-items-center p-4">
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="small-box bg-info">
                                        <div class="inner text-center">
                                            @if ($saldoKas == true)
                                                <h3>{{ $saldoKas->saldo_awal }}</h3>
                                            @else
                                                <h3>0</h3>
                                            @endif
                                            <p>Total Saldo</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="small-box bg-success">
                                        <div class="inner text-center">
                                            @if ($formattedPemasukan == true)
                                                <h3>{{ $formattedPemasukan }}</h3>
                                            @else
                                                <h3>0</h3>
                                            @endif
                                            <p>Total Pemasukkan</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card-body table-responsive px-5 pb-5">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Deskripsi</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Saldo Akhir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pemasukkans as $pemasukkan)
                                            <tr>
                                                <td>{{ $pemasukkans->firstItem() + $loop->iteration - 1 }}</td>
                                                <td>{{ $pemasukkan->tanggal }}</td>
                                                <td>{{ $pemasukkan->deskripsi }}</td>
                                                <td>{{ $pemasukkan->kategori->nama }}</td>
                                                <td><span class="badge bg-success">{{ $pemasukkan->jumlah }}</span></td>
                                                <td><span class="badge bg-primary">{{ $pemasukkan->saldo_akhir }}</span>
                                                </td>
                                                <td>
                                                    @if ($pemasukkan->gambar)
                                                        <button class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                                            data-target="#modalGambar{{ $pemasukkan->id }}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    @endif
                                                    @if ($pemasukkan->id == $dataTerakhir->id)
                                                        <form
                                                            action="{{ route('pemasukkan.destroy', ['pemasukkan' => $pemasukkan->id]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm btn-hapus"
                                                                title="Hapus Data" data-name="{{ $pemasukkan->deskripsi }}"
                                                                data-table="program">
                                                                <i class="fa fa-trash fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mx-4 mt-3">
                                    {{ $pemasukkans->fragment('judul')->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <form action="{{ route('pemasukkan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pembayaran Anak</h5>
                    </div>
                    <div class="modal-body">

                        <div class="form-group row mb-3">
                            <label for="tambahInputMobile" class="col-sm-4 col-form-label">Tanggal</label>
                            <div class="col-sm-4">
                                <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                    <input type="text"
                                        class="form-control @error('tanggal') is-invalid @enderror datetimepicker-input"
                                        data-target="#reservationdate1" name="tanggal" value=" {{ old('tanggal') }}"
                                        id="tanggal" />
                                    <div class="input-group-append" data-target="#reservationdate1"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    @error('tanggal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Nama Anak</label>
                            <div class="col-sm-8">
                                <select class="form-control @error('deskripsi') is-invalid @enderror select2"
                                    style="width:100%" name="deskripsi">
                                    @forelse ($anaks as $anak)
                                        <option value="Pembayaran Anak {{ $anak->nama }}">{{ $anak->nama }}
                                        </option>
                                    @empty
                                        <option>tidak ada data</option>
                                    @endforelse
                                    @error('deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Kategori</label>
                            <div class="col-sm-8">
                                @if ($kategori == true)
                                    <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">
                                    <input type="text" class="form-control" value="{{ $kategori->nama }}" disabled>
                                @else
                                    <input type="text" class="form-control" value="Silahkan inputkan data Kategori"
                                        disabled>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Jumlah Bayar</label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input class="form-control" type="text" id="jumlah" name="jumlah"
                                        placeholder="Masukkan jumlah pembayaran" oninput="formatRupiah(this)" required>
                                </div>
                                @error('jenis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment-method" class="col-sm-4 col-form-label">Metode Pembayaran</label>
                            <div class="col-sm-3">
                                <select id="metode-pembayaran1" class="form-control">
                                    <option value="tunai">Tunai</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div id="bukti-transfer1" class="hidden">
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-4 col-form-label">Bukti Pembayaran</label>
                                <div class="col-sm-8">
                                    <button class="container-btn-file">
                                        Upload Gambar
                                        <input type="file" id="unggah-bukti1" name="gambar" accept="image/*">
                                    </button>
                                    <img id="preview1" src="#" alt="Preview Gambar" style="display: none;">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        @if ($kategori == true)
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        @else
                            <button type="submit" class="btn btn-primary me-2" disabled>Simpan</button>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </form>

    <form action="{{ route('pemasukkan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pemasukkan Lainnya</h5>
                    </div>
                    <div class="modal-body">

                        <div class="form-group row mb-3">
                            <label for="tambahInputMobile" class="col-sm-4 col-form-label">Tanggal</label>
                            <div class="col-sm-4">
                                <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                    <input type="text"
                                        class="form-control @error('tanggal') is-invalid @enderror datetimepicker-input"
                                        data-target="#reservationdate2" name="tanggal" value=" {{ old('tanggal') }}" />
                                    <div class="input-group-append" data-target="#reservationdate2"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    @error('tanggal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Deskripsi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror"
                                    name="deskripsi" value=" {{ old('deskripsi') }}" />
                                @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Kategori</label>
                            <div class="col-sm-8">
                                <select class="form-control @error('kategori_id') is-invalid @enderror select2"
                                    style="width:100%" name="kategori_id">
                                    @forelse ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}
                                        </option>
                                    @empty
                                        <option>tidak ada data</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Jumlah Bayar</label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input class="form-control" type="text" id="jumlah" name="jumlah"
                                        placeholder="Masukkan jumlah pembayaran" oninput="formatRupiah(this)">
                                </div>
                                @error('jenis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment-method" class="col-sm-4 col-form-label">Metode Pembayaran</label>
                            <div class="col-sm-3">
                                <select id="metode-pembayaran2" class="form-control">
                                    <option value="tunai">Tunai</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div id="bukti-transfer2" class="hidden">
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-4 col-form-label">Bukti Pembayaran</label>
                                <div class="col-sm-8">
                                    <button class="container-btn-file">
                                        Upload Gambar
                                        <input type="file" id="unggah-bukti2" name="gambar" accept="image/*">
                                    </button>
                                    <img id="preview2" src="#" alt="Preview Gambar" style="display: none;">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        @if ($kategoris->isEmpty())
                            <button type="submit" class="btn btn-primary me-2" disabled>Simpan</button>
                        @else
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection
@include('keuangan.script1')
