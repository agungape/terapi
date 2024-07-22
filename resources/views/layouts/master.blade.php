<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Bright Star</title>

    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/bsc-mini2.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Theme style -->

    {{-- @vite(['resources/sass/app.scss']) --}}
</head>

<body>

    <div class="container-scroller">

        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('assets') }}/images/bsc.png"
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img
                        src="{{ asset('assets') }}/images/bsc-mini.png" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-logout d-none d-lg-block">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-power"></i>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">

            @include('layouts.menu')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024
                            <a href="https://www.bootstrapdash.com/" target="_blank">A.M</a>. All rights
                            reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Bright Start Of Child
                            <i class="mdi mdi-heart text-danger"></i></span>
                    </div>
                </footer>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets') }}/vendors/js/vendor.bundle.base.js"></script>
    <script src="{{ asset('assets') }}/vendors/chart.js/chart.umd.js"></script>
    <script src="{{ asset('assets') }}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('assets') }}/js/off-canvas.js"></script>
    <script src="{{ asset('assets') }}/js/misc.js"></script>
    <script src="{{ asset('assets') }}/js/settings.js"></script>
    <script src="{{ asset('assets') }}/js/todolist.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.cookie.js"></script>
    <script src="{{ asset('assets') }}/js/dashboard.js"></script>
    <script src="{{ asset('assets') }}/vendors/select2/select2.min.js"></script>
    <script src="{{ asset('assets') }}/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/js/file-upload.js"></script>
    <script src="{{ asset('assets') }}/js/typeahead.js"></script>
    <script src="{{ asset('assets') }}/js/select2.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/dist/js/adminlte.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/dist/js/demo.js"></script>

    @yield('scripts')


    @include('sweetalert::alert')
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

</body>

</html>
