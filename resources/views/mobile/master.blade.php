<!DOCTYPE html>
<html lang="en">

<head>

    <title>Bright Star Of Child</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta name="keywords" content="Layanan Terapi Anak Berkebutuhan Khusus">

    <meta name="Layanan Terapi Anak Berkebutuhan Khusus">

    <meta property="og:title" content="Bright Star Of Child">
    <meta property="og:description" content="Layanan Terapi Anak Berkebutuhan Khusus">
    <meta property="og:image" content="social-image.html">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Bright Star Of Child">
    <meta name="twitter:description" content="Layanan Terapi Anak Berkebutuhan Khusus">
    <meta name="twitter:image" content="social-image.html">
    <meta name="twitter:card" content="summary_large_image">

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets') }}/mobile/pixio/images/app-logo/bsc.png">

    <!-- PWA Version -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#fff7da">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Bright">
    <link rel="apple-touch-icon" href="{{ asset('assets') }}/mobile/pixio/images/app-logo/bsc.png">
    <meta name="msapplication-TileImage" content="{{ asset('assets') }}/mobile/pixio/images/app-logo/bsc.png">
    <meta name="msapplication-TileColor" content="#fff7da">

    <!-- Global CSS -->
    <link href="{{ asset('assets') }}/mobile/pixio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css"
        rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/mobile/pixio/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/mobile/pixio/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/mobile/pixio/vendor/grouploop-master/examples/css/styles.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/mobile/pixio/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;800;900&amp;family=Roboto:wght@500;700&amp;display=swap"
        rel="stylesheet">
    @yield('style')
</head>

<body>
    <div class="page-wrapper">
        <!-- Preloader -->
        <div id="preloader">
            <div class="loader">
                <div class="load-circle">
                    <div class="circle-2">
                        <img src="{{ asset('assets') }}/mobile/pixio/images/preloader/bsc.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Preloader end-->

        <!-- Sidebar -->
        <div class="dark-overlay"></div>
        @include('mobile.menu')

        <!-- Sidebar End -->

        <!-- Main Content Start -->
        @yield('content')
        <!-- Main Content End -->

        <!-- Menubar -->
        @include('mobile.menubar')
        <!-- Menubar -->
        @yield('canvas')

    </div>
    <!--**********************************
    Scripts
***********************************-->

    <script>
        document.getElementById('confirm-logout').addEventListener('click', function() {
            document.getElementById('logout-form').submit();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/js/jquery.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js">
    </script>
    <script src="{{ asset('assets') }}/mobile/pixio/vendor/grouploop-master/dist/grouploop-1.0.3.min.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/js/dz.carousel.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/js/settings.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/js/custom.js"></script>
    <script src="{{ asset('index.js') }}"></script>
    @yield('scripts')


</body>

</html>
