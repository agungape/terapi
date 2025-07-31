<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bright Star Of Child</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets') }}/images/logo-1734059476.png">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/dist/css/adminlte.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/bootstrap-switch/css/bootstrap2/bootstrap-switch.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/bs-stepper/css/bs-stepper.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    @yield('style')
    <style>
        .search-container button {
            margin-top: 4px;
            /* Margin atas pada tombol di tampilan ponsel */
        }

        .select2-container--default .select2-selection--single {
            height: 40px;
            /* Ubah sesuai kebutuhan */
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 30px;
            /* Pastikan teks berada di tengah */
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
            /* Sesuaikan dengan tinggi yang ditentukan */
        }

        /* From Uiverse.io by omar49511 */
        .container-btn-file {
            display: flex;
            position: relative;
            justify-content: center;
            align-items: center;
            background-color: #307750;
            color: #fff;
            border-style: none;
            padding: 1em 2em;
            border-radius: 0.5em;
            overflow: hidden;
            z-index: 1;
            box-shadow: 4px 8px 10px -3px rgba(0, 0, 0, 0.356);
            transition: all 250ms;
        }

        .container-btn-file input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .container-btn-file>svg {
            margin-right: 1em;
        }

        .container-btn-file::before {
            content: "";
            position: absolute;
            height: 100%;
            width: 0;
            border-radius: 0.5em;
            background-color: #469b61;
            z-index: -1;
            transition: all 350ms;
        }

        .container-btn-file:hover::before {
            width: 100%;
        }

        /* style preview upload gambar*/
        #preview1 {
            margin-top: 10px;
            max-width: 300px;
            max-height: 300px;
        }

        #preview2 {
            margin-top: 10px;
            max-width: 300px;
            max-height: 300px;
        }

        .list-group-item {
            border: none;
        }

        .fixed-size {
            width: 100px;
            height: 100px;
            object-fit: cover;
            /* Memastikan gambar memenuhi area tanpa distorsi */
            border-radius: 50%;
            /* Membuat gambar menjadi lingkaran */
        }

        /* Video Background Styles */
        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .video-background {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* Card Styling */

        /* Small Box Styling */
        .small-box {
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            color: white !important;
            overflow: hidden;
        }

        .small-box:hover {
            transform: translateY(-5px);
        }

        .small-box .inner h3,
        .small-box .inner p {
            /* color: white !important; */
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .small-box .icon {
            color: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a title="Keluar" class="nav-link" href="#" id="logout-btn">
                        <i class="fa fa-power-off" data-feather="power"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.menu')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="https://adminlte.io">Agung Muhammad</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>

    <script src="{{ asset('assets') }}/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/dist/js/adminlte.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/sparklines/sparkline.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <script src="{{ asset('assets') }}/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js">
    </script>
    <script src="{{ asset('assets') }}/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/dropzone/min/dropzone.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @include('sweetalert::alert')
    @yield('scripts')
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script>
        $(function() {
            $('#summernote').summernote({
                height: 200,
            });

            // Inisialisasi summernote kedua
            $('#summernote-perilaku').summernote({
                height: 200,
                placeholder: 'Masukkan hasil observasi perilaku...'
            });

            $('#summernote-perilaku-edit').summernote({
                height: 200,
                placeholder: 'Masukkan hasil observasi perilaku...'
            });

            // Inisialisasi summernote kedua
            $('#summernote-sensorik').summernote({
                height: 200,
                placeholder: 'Masukkan hasil observasi sensorik...'
            });

            $('#summernote-sensorik-edit').summernote({
                height: 200,
                placeholder: 'Masukkan hasil observasi sensorik...'
            });

            // Inisialisasi CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
    <script>
        document.getElementById("logout-btn").addEventListener("click", function(event) {
            event.preventDefault();
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda akan keluar dari akun ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Keluar",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("logout-form").submit();
                }
            });
        });


        let semuaTombol = document.querySelectorAll('.btn-hapus');
        semuaTombol.forEach(function(item) {
            item.addEventListener('click', konfirmasi);
        })

        function konfirmasi(event) {
            // Buat pesan error untuk setiap tipe tabel
            let tombol = event.currentTarget;
            let judulAlert;
            let teksAlert;
            switch (tombol.getAttribute('data-table')) {
                case 'terapis':
                    judulAlert = 'Apakah anda yakin?';
                    teksAlert = 'Hapus data terapis <b> ' + tombol.getAttribute('data-name') + '</b>';
                    break;
                case 'anak':
                    judulAlert = 'Hapus anak ' + tombol.getAttribute('data-name') + '?';
                    teksAlert = 'Semua data <b>Kunjungan</b> untuk anak ' +
                        'ini juga akan terhapus!';
                    break;
                case 'kunjungan':
                    judulAlert = 'Hapus kunjungan anak ' + tombol.getAttribute('data-name') + '?';
                    teksAlert = 'data pemeriksaan pada <b>Kunjungan</b> anak ' +
                        'ini juga akan terhapus!';
                    break;
                default:
                    judulAlert = 'Apakah anda yakin?';
                    teksAlert = 'Hapus data <b>' + tombol.getAttribute('data-name') + '</b>';
                    break;
            }
            event.preventDefault();
            Swal.fire({
                    title: judulAlert,
                    html: teksAlert,
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#6c757d',
                    confirmButtonColor: '#dc3545',
                    cancelButtonText: 'Tidak jadi',
                    confirmButtonText: 'Ya, hapus!',
                    reverseButtons: true,
                })
                .then((result) => {
                    if (result.value) {
                        tombol.parentElement.submit();
                    }
                })
        }

        function showConfirmation() {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin mengkonfirmasi File?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Konfirmasi!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('confirmationForm').submit();
                }
            });
        }

        function showRejected() {
            Swal.fire({
                title: 'Rejected',
                text: 'Apakah Anda yakin ingin Menolak File?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Reject!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('rejectedForm').submit();
                }
            });
        }
    </script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'YYYY-MM-DD', // Format yang digunakan (misalnya: YYYY-MM-DD)
                locale: 'id', // Opsional: Set locale (misalnya bahasa Indonesia)
            });
            $('#reservationdate1').datetimepicker({
                format: 'YYYY-MM-DD', // Format yang digunakan (misalnya: YYYY-MM-DD)
                locale: 'id', // Opsional: Set locale (misalnya bahasa Indonesia)
            });
            $('#reservationdate2').datetimepicker({
                format: 'YYYY-MM-DD', // Format yang digunakan (misalnya: YYYY-MM-DD)
                locale: 'id', // Opsional: Set locale (misalnya bahasa Indonesia)
            });
            //Date and time picker
            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });

            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
        });
    </script>
</body>

</html>
