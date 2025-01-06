<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- Bootstrap Switch -->
    <script src="{{ asset('assets') }}/adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/bs-stepper/css/bs-stepper.min.css">

    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/plugins/dropzone/min/dropzone.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

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
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets') }}/adminlte/dist/img/AdminLTELogo.png"
                alt="AdminLTELogo" height="60" width="60">
        </div> --}}

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
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

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('assets') }}/adminlte/dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('assets') }}/adminlte/dist/img/user8-128x128.jpg"
                                    alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('assets') }}/adminlte/dist/img/user3-128x128.jpg"
                                    alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true"
                        href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>Log
                        Out
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </a>

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
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets') }}/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets') }}/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets') }}/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets') }}/adminlte/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets') }}/adminlte/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets') }}/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets') }}/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets') }}/adminlte/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets') }}/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Summernote -->
    <script src="{{ asset('assets') }}/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets') }}/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    {{-- <script src="{{ asset('assets') }}/adminlte/dist/js/adminlte.js"></script> --}}
    <script src="{{ asset('assets') }}/adminlte/dist/js/adminlte.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets') }}/adminlte/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets') }}/adminlte/dist/js/pages/dashboard.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets') }}/adminlte/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('assets') }}/adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js">
    </script>
    <!-- InputMask -->
    <script src="{{ asset('assets') }}/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('assets') }}/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('assets') }}/adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('assets') }}/adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('assets') }}/adminlte/plugins/dropzone/min/dropzone.min.js"></script>

    <!-- DataTables  & Plugins -->
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



    @include('sweetalert::alert')
    @yield('scripts')
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script>
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
