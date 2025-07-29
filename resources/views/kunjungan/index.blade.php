@extends('layouts.master')
@section('menuLayananterapi', 'active')
@section('masterLayananterapi', 'menu-is-opening menu-open')
@section('menuKunjungan', 'active')
@section('style')
    <style>
        /* Modern Minimalist Styling */
        body {
            background-color: #f8fafc;
        }

        .card {
            border: none;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .bg-light {
            background-color: #f5f7fa !important;
        }

        .bg-primary-light {
            background-color: rgba(59, 125, 221, 0.1) !important;
        }

        .bg-danger-light {
            background-color: rgba(220, 53, 69, 0.1) !important;
        }

        .form-control {
            transition: all 0.3s;
        }

        .form-control:focus {
            box-shadow: none;
            background-color: #fff;
            border-color: rgba(59, 125, 221, 0.3);
        }

        .input-focused {
            box-shadow: 0 0 0 2px rgba(59, 125, 221, 0.2);
            border-radius: 4px;
        }

        .btn-outline-primary {
            border-width: 1.5px;
        }

        .table {
            --table-accent-bg: transparent;
        }

        .table thead th {
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.2s;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.015);
        }

        .badge-pill {
            padding: 0.35em 0.65em;
        }

        .rounded-lg {
            border-radius: 12px !important;
        }

        hr {
            opacity: 0.15;
        }

        .content-header h1 {
            font-weight: 700;
            color: #333;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Modern Minimalist Header -->
        <section class="content-header py-4">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1><i class="fas fa-clipboard-check text-primary mr-2"></i> Pendaftaran Kunjungan</h1>
                        <p class="text-muted mt-2">Halaman Pendaftaran Anak</p>
                    </div>
                    <div class="col-md-6">
                        <div class="float-md-right">
                            <ol class="breadcrumb bg-transparent mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i>
                                        Home</a>
                                </li>
                                <li class="breadcrumb-item active">Kunjungan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <!-- Search Card -->
                <div class="card border-0 shadow-sm rounded-lg">
                    <div class="card-body">
                        <div class="row">
                            <!-- Search Section -->
                            <div class="col-lg-5 pr-lg-4">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-light rounded-circle p-2 mr-3">
                                        <i class="far fa-calendar text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 text-muted small">Tanggal Kunjungan</p>
                                        <h5 class="mb-0">{{ Carbon\Carbon::now()->format('d F Y') }}</h5>
                                    </div>
                                </div>

                                <form class="form-sample" action="{{ url('/pencarian/proses') }}" method="GET">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label class="font-weight-normal text-muted">Cari Pasien</label>
                                        <div class="input-group input-group-lg">
                                            <input type="text" class="form-control border-0 bg-light"
                                                placeholder="Nama/NIB anak..." name="s" id="s"
                                                value="{{ $s ?? '' }}" autofocus>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary px-4" type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <small class="text-muted">Tekan Enter untuk memulai pencarian</small>
                                    </div>
                                </form>
                            </div>

                            <!-- Results Section -->
                            <div class="col-lg-7 pl-lg-4 border-left">
                                <h5 class="d-flex align-items-center mb-3">
                                    <span
                                        class="badge badge-pill bg-white text-primary border border-primary mr-2">{{ isset($result) ? count($result) : 0 }}</span>
                                    Hasil Pencarian
                                </h5>

                                <div class="table-responsive rounded" style="max-height: 350px; overflow-y: auto;">
                                    <table class="table table-hover table-borderless" id="tabelHasilPencarian">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="border-0">NIB</th>
                                                <th class="border-0">Nama</th>
                                                <th class="border-0">TTL</th>
                                                <th class="border-0 text-right">Aksi</th>
                                            </tr>
                                        </thead>
                                        @isset($result)
                                            @if (count($result) == 0)
                                                <tbody>
                                                    <tr>
                                                        <td colspan="4" class="text-center py-4 text-muted">
                                                            <i class="fas fa-search-minus fa-2x mb-2"></i>
                                                            <p class="mb-0">Data tidak ditemukan</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            @else
                                                <tbody id="hasilPencarianBody">
                                                    @foreach ($result as $anak)
                                                        <tr class="border-bottom">
                                                            <td><span
                                                                    class="badge badge-pill bg-primary-light text-primary">{{ $anak->nib }}</span>
                                                            </td>
                                                            <td>{{ $anak->nama }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d/m/Y') }}
                                                            </td>
                                                            <td class="text-right">
                                                                @if ($anak->status == 'aktif')
                                                                    <button data-id="{{ $anak->id }}"
                                                                        data-nama="{{ $anak->nama }}"
                                                                        class="btn btn-sm btn-outline-primary rounded-pill kirim-data px-3">
                                                                        Pilih <i class="fas fa-chevron-right ml-1"></i>
                                                                    </button>
                                                                @else
                                                                    <span
                                                                        class="badge badge-pill bg-danger-light text-danger">Nonaktif</span>
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
                </div>

                <!-- Registration Form (Initially Hidden) -->
                <div class="card border-0 shadow-sm rounded-lg mt-4 animated fadeIn" id="registrationForm"
                    style="display: none;">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="mb-0">
                            <i class="fas fa-user-circle text-primary mr-2"></i>
                            Form Kunjungan Anak
                        </h5>
                    </div>

                    <form action="{{ route('kunjungan.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Nama Anak</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-child"></i></span>
                                            </div>
                                            <input type="hidden" readonly name="anak_id" id="anak_id">
                                            <input type="text" class="form-control" readonly name="nama"
                                                id="namaAnak">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label text-muted">Jenis Terapi</label>
                                        <select name="jenis_terapi" id="jenis_terapi"
                                            class="form-control select2 border-0 bg-light">
                                            @foreach ($jenisTerapi as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>

                                <!-- Right Column -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label text-muted">Terapis</label>
                                        <select class="form-control select2 border-0 bg-light" name="terapis_id">
                                            @forelse ($terapis as $terapi)
                                                <option value="{{ $terapi->id }}">{{ $terapi->nama }}</option>
                                            @empty
                                                <option disabled selected>Tidak ada data terapis</option>
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label text-muted">Status Kunjungan</label>
                                        <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                            <label class="btn btn-outline-success active rounded mr-2">
                                                <input type="radio" name="status" value="hadir" checked>
                                                <i class="fas fa-check-circle mr-1"></i> Hadir
                                            </label>
                                            <label class="btn btn-outline-warning rounded mr-2">
                                                <input type="radio" name="status" value="izin">
                                                <i class="fas fa-envelope mr-1"></i> Izin
                                            </label>
                                            <label class="btn btn-outline-danger rounded">
                                                <input type="radio" name="status" value="sakit">
                                                <i class="fas fa-procedures mr-1"></i> Izin Hangus
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-0 text-right pt-0 pb-4">
                            <button type="reset" class="btn btn-outline-secondary rounded-pill px-4 mr-2">
                                <i class="fas fa-redo mr-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                                <i class="fas fa-save mr-1"></i> Simpan Kunjungan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    @include('kunjungan.ajax')
    <script>
        $(document).ready(function() {
            // Show registration form with animation when patient is selected
            $('.kirim-data').click(function() {
                $('#registrationForm').slideDown('fast', function() {
                    $(this).addClass('show');
                    $('html, body').animate({
                        scrollTop: $(this).offset().top - 20
                    }, 300);
                });
            });

            // Initialize enhanced select2
            $('.select2').select2({
                theme: 'bootstrap4',
                minimumResultsForSearch: 5,
                placeholder: "Pilih terapis",
                width: '100%'
            });

            // Add focus effect to form inputs
            $('.form-control').focus(function() {
                $(this).parent().addClass('input-focused');
            }).blur(function() {
                $(this).parent().removeClass('input-focused');
            });
        });
    </script>
@endsection
