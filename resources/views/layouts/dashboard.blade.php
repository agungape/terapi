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

    <link rel="stylesheet" href="{{ asset('assets') }}/adminlte/dist/css/adminlte.css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <style>
        /* Video Container - Responsive */
        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            overflow: hidden;
        }

        .video-background {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* Responsive Overlay */
        .content-overlay {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px;
            background-color: rgba(255, 253, 253, 0);
        }

        /* Dark overlay for better visibility */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0);
            z-index: -1;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {

            /* Tablet styles */
            .video-background {
                object-position: 65% center;
                /* Adjust focal point for mobile */
            }

            body::after {
                background: rgba(0, 0, 0, 0);
                /* Darker overlay for mobile */
            }
        }

        @media (max-width: 576px) {

            /* Mobile styles */
            .video-container {
                height: 120vh;
                /* Extra height for mobile scrolling */
            }

            .video-background {
                object-position: 75% center;
                /* Further adjust focal point */
            }
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

        @include('layouts.menu')

        @yield('content')


        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

    <script src="{{ asset('assets') }}/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/dist/js/adminlte.min.js"></script>
    <script src="{{ asset('assets') }}/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    @include('sweetalert::alert')
    @yield('scripts')
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('myVideo');

            // Mobile-friendly video settings
            video.playbackRate = 1.0;
            video.playsInline = true; // Important for iOS
            video.muted = true; // Required for autoplay on mobile

            // Handle mobile orientation changes
            function handleResize() {
                if (window.innerWidth < 768) {
                    video.playbackRate = 0.8; // Slower on mobile
                } else {
                    video.playbackRate = 1.0; // Normal on desktop
                }
            }

            window.addEventListener('resize', handleResize);
            handleResize(); // Initial check

            // Ensure video plays on iOS
            document.body.addEventListener('touchstart', function() {
                video.play().catch(e => console.log(e));
            }, {
                once: true
            });
        });
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
