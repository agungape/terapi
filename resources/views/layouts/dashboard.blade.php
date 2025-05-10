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
        /* Smaller Video Background */
        .video-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            /* Reduced width */
            height: 100%;
            /* Reduced height */
            z-index: -1;
            overflow: hidden;
            border-radius: 15px;
            /* Optional rounded corners */
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
            /* Optional subtle shadow */
        }

        .video-background {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* Dark overlay for better visibility */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: -2;
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


    @yield('scripts')
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Optional video controls
            const video = document.getElementById('myVideo');
            video.playbackRate = 1.0; // Normal speed
            video.play(); // Ensure autoplay works
        });
    </script>
</body>

</html>
