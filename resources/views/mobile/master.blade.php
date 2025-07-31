<!DOCTYPE html>
<html lang="en">

<head>

    <title>Bright Star Of Child</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">

    <meta name="keywords"
        content="app, clothing, e-shop, ecommerce, ecommerce android app, ecommerce app, eCommerce Website, minimal shop, online shop, shop app, store, ui kit, woocommerce, mobile application, mobile app, mobile, android application, online shopping, pixio, user interface, user experience, App Design, Design Elements, Fashion App, fashion, Trendy, Stylish, User-Friendly, Navigation, Product Display, Branding, Development, Visual Design, Mobile UI Elements, Stylish Mobile Design, Mobile App Development, Fashion App Templates, Fashion App Prototypes, UI Kit for Online Store, Trendy Fashion App, Fashion App UX/UI, UI/UX, Website, Web Design">

    <meta
        name="Pixio offers a cutting-edge eCommerce Fashion Bootstrap Mobile App Template designed to revolutionize your online shopping experience. With a comprehensive range of meticulously crafted design elements, our kit empowers you to create a visually stunning and intuitively navigable fashion app. Immerse your users in a seamless journey through the latest trends and collections, all presented with a touch of sophistication and flair.">

    <meta property="og:title" content="Bright Star Of Child App Template ( Bootstrap + PWA ) | DexignZone">
    <meta property="og:description"
        content="Pixio offers a cutting-edge eCommerce Fashion Bootstrap Mobile App Template designed to revolutionize your online shopping experience. With a comprehensive range of meticulously crafted design elements, our kit empowers you to create a visually stunning and intuitively navigable fashion app. Immerse your users in a seamless journey through the latest trends and collections, all presented with a touch of sophistication and flair.">
    <meta property="og:image" content="social-image.html">

    <meta name="format-detection" content="telephone=no">

    <meta name="twitter:title" content="Bright Star Of Child App Template ( Bootstrap + PWA ) | DexignZone">
    <meta name="twitter:description"
        content="Pixio offers a cutting-edge eCommerce Fashion Bootstrap Mobile App Template designed to revolutionize your online shopping experience. With a comprehensive range of meticulously crafted design elements, our kit empowers you to create a visually stunning and intuitively navigable fashion app. Immerse your users in a seamless journey through the latest trends and collections, all presented with a touch of sophistication and flair.">
    <meta name="twitter:image" content="social-image.html">
    <meta name="twitter:card" content="summary_large_image">

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets') }}/mobile/pixio/images/app-logo/bsc.png">

    <!-- PWA Version -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0d6efd">
    <link rel="manifest" href="{{ asset('assets') }}/mobile/manifest.json">
    <link rel="apple-touch-icon" href="{{ asset('assets') }}/mobile/pixio/images/app-logo/bsc.png">

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
    <script src="{{ asset('assets') }}/mobile/index.js"></script>
    @yield('scripts')

    {{-- <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/sw.js')
                .then(reg => console.log('Service Worker registered:', reg))
                .catch(err => console.error('Service Worker error:', err));
        }
    </script>
    <script>
        let deferredPrompt;

        window.addEventListener('beforeinstallprompt', (e) => {
            // Simpan event
            e.preventDefault();
            deferredPrompt = e;

            // Tampilkan tombol install
            const installBtn = document.getElementById('install-btn');
            installBtn.style.display = 'inline-block';

            installBtn.addEventListener('click', async () => {
                installBtn.style.display = 'none';
                deferredPrompt.prompt();

                const {
                    outcome
                } = await deferredPrompt.userChoice;
                console.log(`User response to install prompt: ${outcome}`);
                deferredPrompt = null;
            });
        });
    </script> --}}

</body>

</html>
