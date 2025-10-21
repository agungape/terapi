<!DOCTYPE html>
<html lang="en">

<head>

    <title>Bright Start Of Child</title>

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

    <!-- Globle Stylesheets -->
    <link href="{{ asset('assets') }}/mobile/pixio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css"
        rel="stylesheet">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/mobile/pixio/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/mobile/pixio/vendor/swiper/swiper-bundle.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" class="main-css" type="text/css" href="{{ asset('assets') }}/mobile/pixio/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;800;900&amp;display=swap"
        rel="stylesheet">

</head>

<body>
    <div class="page-wrapper">
        <!-- Preloader -->
        <div id="preloader">
            <div class="loader">
                <div class="load-circle">
                    <div class="circle-2">
                        <img src="{{ asset('assets') }}/mobile/pixio/images/preloader/logo2.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Preloader end-->

        <!-- Main Content Start  -->
        <main class="page-content">
            <div class="container px-0 pt-0">
                <div class="dz-authentication-area">
                    <div class="dz-media">
                        <img src="{{ asset('assets') }}/mobile/pixio/images/authentication/pic5.png" alt="">
                    </div>
                    <div class="section-head">
                        <h3 class="title">Selamat Datang Anak Hebat</h3>
                        <p>Masukkan Username dan Password Kamu</p>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger solid alert-dismissible fade show">
                            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor"
                                stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                class="me-2">
                                <polygon
                                    points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2">
                                </polygon>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                            </svg>
                            <strong></strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span><i class="icon feather icon-x"></i></span>
                            </button>
                        </div>
                    @endif
                    <div class="account-section">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="email">Username*</label>
                                <input id="username" type="text" name="username"
                                    class="form-control validate @error('username') is-invalid @enderror "
                                    value="{{ old('username') }}">
                                <label for="username">Username</label>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Password*</label>
                                <div class="input-group input-group-icon mb-2">
                                    <input id="password" type="password" name="password"
                                        class="form-control dz-password validate @error('password') is-invalid @enderror "
                                        value="{{ old('password') }}">
                                    <span class="input-group-text show-pass">
                                        <i class="icon feather icon-eye-off eye-close"></i>
                                        <i class="icon feather icon-eye eye-open"></i>
                                    </span>
                                </div>
                                {{-- <a href="forgot-password.html" class="btn-link text-end">Forgot password?</a> --}}
                            </div>

                            <button type="submit"
                                class="btn btn-thin btn-lg w-100 btn-primary rounded-xl btn-icon icon-start"><i
                                    class="feather icon-arrow-right"></i>Sign In</button>
                            <div class="dz-saprate">
                                <span>Yayasan Plester Jiwa Indonesia</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!-- Main Content End  -->


    </div>
    <!--**********************************
    Scripts
***********************************-->
    <script src="{{ asset('assets') }}/mobile/pixio/js/jquery.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->
    <script src="{{ asset('assets') }}/mobile/pixio/js/dz.carousel.js"></script><!-- Swiper -->
    <script src="{{ asset('assets') }}/mobile/pixio/js/settings.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/js/custom.js"></script>
    <script src="{{ asset('assets') }}/mobile/pixio/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js">
    </script><!-- Swiper -->

</body>

</html>
