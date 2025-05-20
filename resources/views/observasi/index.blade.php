@extends('layouts.master')
@section('menuObservasi', 'active')
@section('style')
    <style>
        .card-primary.card-outline {
            border-top: 3px solid #007bff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .table th {
            border-top: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            color: #6c757d;
        }

        .table td {
            vertical-align: middle;
        }

        .img-circle.img-sm {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        .badge-pill {
            padding: 5px 10px;
            font-weight: normal;
        }

        .content-header h1 {
            font-weight: 700;
            color: #333;
        }

        .empty-state {
            text-align: center;
            padding: 40px 0;
        }

        @media (max-width: 576px) {
            .card-header .card-tools {
                width: 100%;
                margin-top: 10px;
            }

            .table-responsive {
                border: none;
            }
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header with modern design -->
        <section class="content-header py-4">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h1 class="fw-bold"> <i class="fas fa-child text-primary mr-2"></i>Observasi Anak</h4>
                            <p class="text-muted mt-2">Pencatatan dan iwayat Observasi Anak</p>
                    </div>
                    <div>
                        <ol class="breadcrumb bg-transparent mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active">Data Observasi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content with card design -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-list-alt mr-2"></i>Daftar Anak
                                </h3>

                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="bg-light">
                                            <tr>
                                                <th style="width: 10%;">Aksi</th>
                                                <th>Nama Anak</th>
                                                <th>Alamat</th>
                                                <th>Usia</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($anaks as $anak)
                                                <tr>
                                                    <td>
                                                        @can('create observasi')
                                                            <div class="btn-group">
                                                                <a href="{{ route('observasi.show', ['anak' => $anak->id]) }}"
                                                                    class="btn btn-sm btn-info" data-toggle="tooltip"
                                                                    title="Lihat Observasi">
                                                                    <i class="fas fa-book-medical"></i>
                                                                </a>
                                                                {{-- <a href="#" class="btn btn-sm btn-success"
                                                                    data-toggle="tooltip" title="Tambah Observasi">
                                                                    <i class="fas fa-plus-circle"></i>
                                                                </a> --}}
                                                            </div>
                                                        @endcan
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-3">
                                                                <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/images/faces/face1.jpg') }}"
                                                                    alt="Child Avatar" class="img-circle img-sm">
                                                            </div>
                                                            <div>
                                                                <strong>{{ $anak->nama }}</strong>
                                                                <div class="text-muted small">ID: {{ $anak->nib }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $anak->alamat }}</td>
                                                    <td>
                                                        <span class="badge badge-pill badge-primary">5 Tahun</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-pill badge-success">Aktif</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-4">
                                                        <i class="fas fa-exclamation-circle fa-2x text-muted mb-3"></i>
                                                        <p class="text-muted">Tidak ada data anak yang tersedia</p>
                                                        <a href="#" class="btn btn-primary">
                                                            <i class="fas fa-plus mr-2"></i>Tambah Anak
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <div class="float-right">
                                    {{ $anaks->fragment('judul')->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();

            // Enable Bootstrap 4 styled pagination
            $('ul.pagination').addClass('pagination-sm m-0 float-right');
        });
    </script>
@endsection
