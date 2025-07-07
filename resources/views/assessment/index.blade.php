@extends('layouts.master')
@section('menuLayananterapi', 'active')
@section('masterLayananterapi', 'menu-is-opening menu-open')
@section('menuAssessment', 'active')
@section('style')
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 2rem;
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 15px 15px 0 0 !important;
            padding: 1.25rem;
        }

        .btn-primary {
            background-color: #4A86E8;
            border-color: #4A86E8;
            border-radius: 10px;
            font-weight: 500;
            padding: 8px 20px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #3a76d8;
            box-shadow: 0 4px 10px rgba(74, 134, 232, 0.3);
            transform: translateY(-2px);
        }

        .btn-warning {
            background-color: #FFB74D;
            border-color: #FFB74D;
            color: white;
            border-radius: 8px;
        }

        .btn-danger {
            background-color: #FF5252;
            border-color: #FF5252;
            border-radius: 8px;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0 8px;
            margin-top: -8px;
        }

        .table tr {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            transition: all 0.2s;
        }

        .table tr:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .table td {
            background-color: white;
            padding: 18px 15px;
        }

        .table td:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .table td:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: none;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            padding: 12px 15px;
        }

        .file-link {
            color: #4A86E8;
            text-decoration: none;
            position: relative;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s;
            font-weight: 500;
        }

        .file-link:hover {
            color: #3a76d8;
        }

        .file-link:before {
            content: "\f1c1";
            font-family: "Font Awesome 5 Free";
            margin-right: 8px;
            font-size: 16px;
        }

        .badge-assessment {
            background-color: #E8F5E9;
            color: #43A047;
            font-weight: 500;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .content-header h1 {
            font-weight: 700;
            color: #333;
        }

        .pagination {
            border-radius: 30px;
            overflow: hidden;
        }

        .page-link {
            border: none;
            color: #4A86E8;
            margin: 0 3px;
            border-radius: 20px;
            transition: all 0.2s;
        }

        .page-item.active .page-link {
            background-color: #4A86E8;
            border-color: #4A86E8;
        }

        .empty-data {
            padding: 50px 0;
            text-align: center;
            color: #6c757d;
        }

        .empty-data i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #dee2e6;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-clipboard-check text-primary mr-2"></i>Hasil Assessment</h1>
                        <p class="text-muted mt-2">Data lengkap hasil assessment psikologi anak</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active">Assessment Anak</li>
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
                            <div class="card-header d-flex justify-content-between align-items-center">
                                @can('create assessment')
                                    <a href="{{ route('assessment.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus mr-2"></i>Upload Hasil Assessment
                                    </a>
                                @endcan
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 150px;">AKSI</th>
                                                <th>NAMA ANAK</th>
                                                <th>PSIKOLOG</th>
                                                <th>FILE ASSESSMENT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($assessment as $a)
                                                <tr>
                                                    <td style="vertical-align: middle;">
                                                        <div class="btn-group">
                                                            @can('update assessment')
                                                                <a href="{{ route('assessment.edit', ['assessment' => $a->id]) }}"
                                                                    class="btn btn-warning btn-sm mr-1" title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            @endcan
                                                            @can('delete assessment')
                                                                <form
                                                                    action="{{ route('assessment.destroy', ['assessment' => $a->id]) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm btn-hapus"
                                                                        title="Hapus Data" data-name="assessment"
                                                                        data-table="assessment">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <strong>{{ $a->anak->nama }}</strong>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <span class="badge badge-assessment">
                                                            <i class="fas fa-user-md mr-1"></i>
                                                            {{ $a->psikolog->nama }}
                                                        </span>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <a href="{{ asset('storage/hasil-assessment/' . $a->file_assessment) }}"
                                                            target="_blank"
                                                            onclick="window.open(this.href).print(); return false;"
                                                            class="file-link">
                                                            {{ $a->file_assessment }}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="empty-data">
                                                        <i class="fas fa-folder-open"></i>
                                                        <h5>Belum ada data assessment</h5>
                                                        <p>Upload hasil assessment psikologi anak terlebih dahulu</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4">
                                    {{ $assessment->fragment('judul')->links() }}
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

@section('scripts')
    <script>
        $(document).ready(function() {
            // Animasi untuk table rows saat halaman dimuat
            $('.table tbody tr').each(function(index) {
                $(this).css({
                    'opacity': 0,
                    'transform': 'translateY(20px)'
                }).delay(index * 100).animate({
                    'opacity': 1,
                    'transform': 'translateY(0)'
                }, 300);
            });

        });
    </script>
@endsection
