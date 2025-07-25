@extends('layouts.master')
@section('menuLayananterapi', 'active')
@section('masterLayananterapi', 'menu-is-opening menu-open')
@section('menuRekammedis', 'active')
@section('style')
    <style>
        .rounded-4 {
            border-radius: 1rem !important;
        }

        .btn-circle {
            border-radius: 50% !important;
            padding: 6px 10px !important;
            font-size: 0.875rem;
        }

        .pagination {
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
        }

        .page-item:first-child .page-link {
            margin-left: 0;
            border-top-left-radius: 50px;
            border-bottom-left-radius: 50px;
        }

        .page-item:last-child .page-link {
            border-top-right-radius: 50px;
            border-bottom-right-radius: 50px;
        }

        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: #dee2e6;
        }

        .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6;
            transition: all 0.2s ease;
        }

        .page-link:hover {
            z-index: 2;
            color: #0056b3;
            text-decoration: none;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .badge {
            display: inline-block;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 50px;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .info-box {
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            display: flex;
            min-height: 80px;
            padding: 0.5rem;
            position: relative;
            width: 100%;
            margin-bottom: 1rem;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .info-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .content-header h1 {
            font-weight: 700;
            color: #333;
        }

        .info-box-icon {
            align-items: center;
            display: flex;
            font-size: 1.875rem;
            justify-content: center;
            text-align: center;
            width: 70px;
            border-radius: 0.25rem;
            color: #fff;
        }

        .info-box-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            line-height: 1.8;
            flex: 1;
            padding: 0 10px;
        }

        .info-box-number {
            display: block;
            font-weight: 700;
            font-size: 1.25rem;
        }

        .info-box-text {
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .bg-gradient-primary {
            background: linear-gradient(to right, #007bff, #0056b3);
        }

        .bg-gradient-info {
            background: linear-gradient(to right, #17a2b8, #117a8b);
        }

        .bg-gradient-success {
            background: linear-gradient(to right, #28a745, #1e7e34);
        }

        .bg-gradient-warning {
            background: linear-gradient(to right, #ffc107, #d39e00);
        }

        .bg-gradient-danger {
            background: linear-gradient(to right, #dc3545, #bd2130);
        }

        .table td,
        .table th {
            padding: 1rem;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
        }

        /* Media queries untuk responsivitas */
        @media (max-width: 768px) {
            .content-header h1 {
                font-size: 1.5rem;
            }

            .badge-pill {
                font-size: 0.7rem;
            }

            .table td,
            .table th {
                padding: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .d-flex {
                flex-direction: column;
            }

            .rounded-circle {
                margin-bottom: 0.5rem;
            }
        }
    </style>
@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header dengan tampilan modern -->

        <section class="content-header py-4">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h1 class="fw-bold"><i class="fas fa-notes-medical text-primary mr-2"></i>Rekam Medik Anak</h4>
                            <p class="text-muted mt-2">Pencatatan dan pemantauan perkembangan pasien</p>
                    </div>
                    <div>
                        <ol class="breadcrumb bg-transparent mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">Rekam Medik</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content py-4">
            <div class="container-fluid">
                <!-- Card statistik -->
                <div class="row mb-4">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box bg-gradient-info shadow-sm">
                            <span class="info-box-icon"><i class="fas fa-child"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Pasien</span>
                                <span class="info-box-number">{{ $kunjungan->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box bg-gradient-success shadow-sm">
                            <span class="info-box-icon"><i class="fas fa-check-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Hadir</span>
                                <span class="info-box-number">{{ $kunjungan->where('status', 'hadir')->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box bg-gradient-warning shadow-sm">
                            <span class="info-box-icon"><i class="fas fa-exclamation-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Izin</span>
                                <span class="info-box-number">{{ $kunjungan->where('status', 'izin')->count() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box bg-gradient-danger shadow-sm">
                            <span class="info-box-icon"><i class="fas fa-procedures"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Sakit</span>
                                <span class="info-box-number">{{ $kunjungan->where('status', 'sakit')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm border-0 rounded-lg">
                            <div class="card-header bg-white py-3">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h5 class="mb-0 text-primary"><i class="fas fa-list-alt mr-2"></i>Daftar Kunjungan
                                        </h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="table_search" class="form-control"
                                                placeholder="Cari berdasarkan nama/id..." aria-label="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="py-3">No. Induk</th>
                                                <th class="py-3">Nama</th>
                                                <th class="py-3">Terapis</th>
                                                <th class="py-3">Pertemuan</th>
                                                <th class="py-3">Tanggal</th>
                                                <th class="py-3">Status</th>
                                                <th class="py-3 text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kunjungan as $kun)
                                                <tr class="align-middle">
                                                    <td>
                                                        <span class="font-weight-bold">{{ $kun->anak->nib }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-3"
                                                                style="width:42px;height:42px;">
                                                                <i class="fas fa-user text-primary"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0">{{ $kun->anak->nama }}</h6>
                                                                <small class="text-muted">Anak</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if ($kun->status == 'hadir')
                                                            <div class="d-flex align-items-center">
                                                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-2"
                                                                    style="width:32px;height:32px;">
                                                                    <i class="fas fa-user-md text-info"></i>
                                                                </div>
                                                                <span>{{ $kun->terapis->nama }}</span>
                                                            </div>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($kun->status == 'hadir')
                                                            <span
                                                                class="badge badge-pill badge-light px-3 py-2 font-weight-normal">Pertemuan
                                                                {{ $kun->pertemuan }}</span>
                                                        @elseif ($kun->status == 'sakit')
                                                            <span
                                                                class="badge badge-pill badge-light px-3 py-2 font-weight-normal">Pertemuan
                                                                {{ $kun->pertemuan }}</span>
                                                            <span
                                                                class="badge badge-pill badge-danger px-3 py-2 font-weight-normal ml-1">Hangus</span>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <i class="far fa-calendar-alt text-muted mr-1"></i>
                                                            {{ $kun->created_at }}
                                                        </div>

                                                    </td>
                                                    <td>
                                                        @if ($kun->status == 'hadir')
                                                            <span class="badge badge-pill badge-success px-3 py-2">
                                                                <i class="fas fa-check-circle mr-1"></i>{{ $kun->status }}
                                                            </span>
                                                        @elseif ($kun->status == 'izin')
                                                            <span class="badge badge-pill badge-warning px-3 py-2">
                                                                <i
                                                                    class="fas fa-exclamation-circle mr-1"></i>{{ $kun->status }}
                                                            </span>
                                                        @elseif ($kun->status == 'sakit')
                                                            <span class="badge badge-pill badge-danger px-3 py-2">
                                                                <i class="fas fa-times-circle mr-1"></i>Absen
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @can('show rekammedis')
                                                            @if ($kun->status == 'hadir')
                                                                <a href="{{ route('kunjungan.show', ['kunjungan' => $kun->id]) }}"
                                                                    class="btn btn-primary btn-sm rounded-pill px-3">
                                                                    <i class="fa fa-address-card mr-1"></i> Detail
                                                                </a>
                                                            @endif
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination dengan tampilan lebih modern -->
                                <div class="px-4 py-3 d-flex justify-content-center">
                                    <div class="pagination-wrapper">
                                        {{ $kunjungan->fragment('judul')->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Tambahkan stylesheet kustom untuk komponen pagination -->
@endsection
