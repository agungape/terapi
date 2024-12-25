@extends('layouts.master')
@section('menuKeuangan', 'active')
@section('masterKeuangan', 'menu-is-opening menu-open')
@section('menuPengeluaran', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pengeluaran Keuangan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Kategori</li>
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
                                @auth
                                    <div class="input-group-prepend pl-4">
                                        <button type="button" class="btn btn-danger btn-sm dropdown-toggle"
                                            data-toggle="dropdown"><i class="fa fa-plus pr-2"></i>
                                            Tambah Data
                                        </button>
                                        <div class="dropdown-menu">
                                            {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal1"><i
                                                    class="fa fa-plus pr-2"></i>Pembayaran Anak
                                            </a> --}}
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal2"><i
                                                    class="fa fa-plus pr-2"></i>Pengeluaran</a>
                                        </div>
                                    </div>

                                @endauth

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-4 pl-5">
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
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
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            @if ($formattedPengeluaran == true)
                                                <h3>{{ $formattedPengeluaran }}</h3>
                                            @else
                                                <h3>0</h3>
                                            @endif
                                            <p>Total Pengeluaran</p>
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

                                        @forelse ($pengeluarans as $pengeluaran)
                                            <tr>
                                                <td scope="row">{{ $pengeluarans->firstItem() + $loop->iteration - 1 }}
                                                </td>
                                                <td>{{ $pengeluaran->tanggal }}</td>
                                                <td>{{ $pengeluaran->deskripsi }}</td>
                                                <td> {{ $pengeluaran->kategori->nama }}</td>
                                                <td><span class="badge bg-danger">
                                                        {{ $pengeluaran->jumlah }}</span>
                                                </td>
                                                <td><span class="badge bg-primary">
                                                        {{ $pengeluaran->saldo_akhir }}</span>
                                                </td>
                                                <td>
                                                    @if ($pengeluaran->gambar == true)
                                                        <button class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                                            data-target="#modalGambar{{ $pengeluaran->id }}">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    @endif
                                                    @if ($pengeluaran->id == $dataTerakhir->id)
                                                        <form
                                                            action="{{ route('pengeluaran.destroy', ['pengeluaran' => $pengeluaran->id]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm btn-hapus"
                                                                title="Hapus Data"
                                                                data-name="{{ $pengeluaran->deskripsi }}"
                                                                data-table="program">
                                                                <i class="fa fa-trash fa-fw"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>

                                                {{-- modal view gambar --}}


                                                <div class="modal fade" id="modalGambar{{ $pengeluaran->id }}"
                                                    tabindex="-1" aria-labelledby="modalLabel{{ $pengeluaran->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="modalLabel{{ $pengeluaran->id }}">
                                                                    Struk Transaksi</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset('storage/sturk-bayar/' . $pengeluaran->gambar) }}"
                                                                    class="img-fluid" alt="Gambar">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">data pengeluaran belum ada</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>

                                <div class="mx-4 mt-3">
                                    {{ $pengeluarans->fragment('judul')->links() }}
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

    {{-- <form action="{{ route('pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
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
                                        data-target="#reservationdate1" name="tanggal" value=" {{ old('tanggal') }}" />
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
                                    <input type="text" name="kategori_id" value="{{ $kategori->id }}" hidden>
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
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </form> --}}

    <form action="{{ route('pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengeluaran</h5>
                    </div>
                    <div class="modal-body">

                        <div class="form-group row mb-3">
                            <label for="tambahInputMobile" class="col-sm-4 col-form-label">Tanggal</label>
                            <div class="col-sm-4">
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text"
                                        class="form-control @error('tanggal') is-invalid @enderror datetimepicker-input"
                                        data-target="#reservationdate" name="tanggal" value=" {{ old('tanggal') }}" />
                                    <div class="input-group-append" data-target="#reservationdate"
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
                            <label for="exampleInputMobile" class="col-sm-4 col-form-label">Jumlah</label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input class="form-control" type="text" id="jumlah" name="jumlah"
                                        placeholder="Masukkan Jumlah" oninput="formatRupiah(this)">
                                </div>
                                @error('jenis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment-method" class="col-sm-4 col-form-label">Upload Struk Pembayaran</label>
                            <div class="col-sm-3">
                                <select id="metode-pembayaran2" class="form-control">
                                    <option value="tunai">Tidak</option>
                                    <option value="transfer">Ya</option>
                                </select>
                            </div>
                        </div>
                        <div id="bukti-transfer2" class="hidden">
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-4 col-form-label">Struk Pembayaran</label>
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
                        @if (empty($saldoKas))
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
@section('scripts')
    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/[^0-9]/g, ''); // Hanya angka

            if (value) {
                value = parseInt(value).toLocaleString(
                    'id-ID'); // Format angka dengan titik pemisah
            }

            input.value = value || ''; // Set nilai input tanpa " Rupiah"
        }


        // modal 2
        document.addEventListener('DOMContentLoaded', () => {
            const metodePembayaran = document.getElementById('metode-pembayaran2');
            const buktiTransfer = document.getElementById('bukti-transfer2');

            // Pastikan form upload bukti transfer tersembunyi pada load awal
            buktiTransfer.style.display = 'none';

            // Tambahkan event listener pada dropdown metode pembayaran
            metodePembayaran.addEventListener('change', () => {
                if (metodePembayaran.value === 'transfer') {
                    buktiTransfer.style.display = 'block';
                } else {
                    buktiTransfer.style.display = 'none';
                }
            });
        });

        document.getElementById('unggah-bukti2').addEventListener('change', function(event) {
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
