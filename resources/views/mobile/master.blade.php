<!DOCTYPE html>
<html lang="en">

<head>

    <title>Pixio - Ecommerce Fashion Mobile App Template ( Bootstrap + PWA ) | DexignZone</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta name="keywords"
        content="app, clothing, e-shop, ecommerce, ecommerce android app, ecommerce app, eCommerce Website, minimal shop, online shop, shop app, store, ui kit, woocommerce, mobile application, mobile app, mobile, android application, online shopping, pixio, user interface, user experience, App Design, Design Elements, Fashion App, fashion, Trendy, Stylish, User-Friendly, Navigation, Product Display, Branding, Development, Visual Design, Mobile UI Elements, Stylish Mobile Design, Mobile App Development, Fashion App Templates, Fashion App Prototypes, UI Kit for Online Store, Trendy Fashion App, Fashion App UX/UI, UI/UX, Website, Web Design">

    <meta
        name="Pixio offers a cutting-edge eCommerce Fashion Bootstrap Mobile App Template designed to revolutionize your online shopping experience. With a comprehensive range of meticulously crafted design elements, our kit empowers you to create a visually stunning and intuitively navigable fashion app. Immerse your users in a seamless journey through the latest trends and collections, all presented with a touch of sophistication and flair.">

    <meta property="og:title" content="Pixio - Ecommerce Fashion Mobile App Template ( Bootstrap + PWA ) | DexignZone">
    <meta property="og:description"
        content="Pixio offers a cutting-edge eCommerce Fashion Bootstrap Mobile App Template designed to revolutionize your online shopping experience. With a comprehensive range of meticulously crafted design elements, our kit empowers you to create a visually stunning and intuitively navigable fashion app. Immerse your users in a seamless journey through the latest trends and collections, all presented with a touch of sophistication and flair.">
    <meta property="og:image" content="social-image.html">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Pixio - Ecommerce Fashion Mobile App Template ( Bootstrap + PWA ) | DexignZone">
    <meta name="twitter:description"
        content="Pixio offers a cutting-edge eCommerce Fashion Bootstrap Mobile App Template designed to revolutionize your online shopping experience. With a comprehensive range of meticulously crafted design elements, our kit empowers you to create a visually stunning and intuitively navigable fashion app. Immerse your users in a seamless journey through the latest trends and collections, all presented with a touch of sophistication and flair.">
    <meta name="twitter:image" content="social-image.html">
    <meta name="twitter:card" content="summary_large_image">

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets') }}/mobile/pixio/images/app-logo/favicon.png">

    <!-- PWA Version -->
    <link rel="manifest" href="{{ asset('assets') }}/mobile/manifest.json">

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

        <!-- Header -->
        <header class="header header-fixed">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="menu-toggler bg-white pe-2 rounded-xl">
                        <div class="media">
                            <div class="media-35 m-r10">

                                <img class="rounded-xl"
                                    src=" {{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/avatar/1.png') }}"
                                    alt="">
                            </div>
                            <h6 class="mb-0 font-13">Hello’ {{ $anak->nama }}</h6>
                        </div>
                    </a>
                </div>
                <div class="mid-content"></div>
                <div class="right-content d-flex align-items-center gap-3">
                    <a href="notification.html" class="notification-badge font-20">
                        <i class="icon feather icon-bell"></i>
                        <span class="badge badge-danger">14</span>
                    </a>
                    <a href="search.html" class="icon font-20">
                        <i class="icon feather icon-search"></i>
                    </a>
                </div>
            </div>
        </header>
        <!-- Header -->

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

        <!-- PWA Offcanvas -->
        <div class="offcanvas offcanvas-bottom pwa-offcanvas">
            <div class="container">
                <div class="offcanvas-body">
                    <img class="logo dark" src="{{ asset('assets') }}/mobile/pixio/images/app-logo/bsc.png"
                        alt="">
                    <img class="logo light" src="{{ asset('assets') }}/mobile/pixio/images/app-logo/bsc.png"
                        alt="">
                    <h5 class="title">Bright Star of Child </h5>
                    <p class="pwa-text">Instal Aplikasi ke layar beranda Anda untuk akses mudah</p>
                    <button type="button" class="btn btn-sm btn-primary rounded-xl pwa-btn me-2">Install
                        Aplikasi</button>
                    <button type="button" class="btn btn-sm pwa-close rounded-xl btn-secondary">Install
                        Nanti</button>
                </div>
            </div>
        </div>
        <div class="offcanvas-backdrop pwa-backdrop"></div>
        <!-- PWA Offcanvas End -->

    </div>
    <!--**********************************
    Scripts
***********************************-->
    <script>
        document.getElementById('confirm-logout').addEventListener('click', function() {
            document.getElementById('logout-form').submit();
        });
    </script>
    <script src="{{ asset('assets') }}/mobile/pixio/js/jquery.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js">
    </script>
    <script src="{{ asset('assets') }}/mobile/pixio/vendor/grouploop-master/dist/grouploop-1.0.3.min.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/js/dz.carousel.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/js/settings.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/js/custom.js"></script>
    <script src="{{ asset('assets') }}/mobile/index.js"></script>

</body>

</html>
