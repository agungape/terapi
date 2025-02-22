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
                        <h3 class="title">Sign in to your account</h3>
                        <p>Welcome Back You've Been Missed!</p>
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
                                <label class="form-label" for="email">Username</label>
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
                                <a href="forgot-password.html" class="btn-link text-end">Forgot password?</a>
                            </div>
                            {{-- <a href="index.html"
                                class="btn btn-thin btn-lg w-100 btn-primary rounded-xl btn-icon icon-start"><i
                                    class="feather icon-arrow-right"></i>Sign In</a> --}}
                            <button type="submit"
                                class="btn btn-thin btn-lg w-100 btn-primary rounded-xl btn-icon icon-start"><i
                                    class="feather icon-arrow-right"></i>Sign In</button>
                            <div class="dz-saprate">
                                <span>Or Continue With</span>
                            </div>
                            <a href="javascript:void(0);"
                                class="btn gap-2 btn-thin btn-lg btn-light w-100 mb-2 rounded-xl">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_54_4200)">
                                        <path
                                            d="M4.43242 12.5863L3.73625 15.1852L1.19176 15.239C0.431328 13.8286 0 12.2149 0 10.5C0 8.84179 0.403281 7.27804 1.11812 5.90112H1.11867L3.38398 6.31644L4.37633 8.56815C4.16863 9.17366 4.05543 9.82366 4.05543 10.5C4.05551 11.2341 4.18848 11.9374 4.43242 12.5863Z"
                                            fill="#FBBB00" />
                                        <path
                                            d="M19.8253 8.63184C19.9401 9.23676 20 9.86148 20 10.5C20 11.2159 19.9247 11.9143 19.7813 12.5879C19.2945 14.8802 18.0225 16.8818 16.2605 18.2983L16.2599 18.2978L13.4066 18.1522L13.0028 15.6313C14.172 14.9456 15.0858 13.8725 15.5671 12.5879H10.2198V8.63184H15.6451H19.8253Z"
                                            fill="#518EF8" />
                                        <path
                                            d="M16.2599 18.2978L16.2604 18.2984C14.5467 19.6758 12.3698 20.5 10 20.5C6.19177 20.5 2.8808 18.3715 1.19177 15.239L4.43244 12.5863C5.27693 14.8401 7.45111 16.4445 10 16.4445C11.0956 16.4445 12.122 16.1484 13.0027 15.6313L16.2599 18.2978Z"
                                            fill="#28B446" />
                                        <path
                                            d="M16.3829 2.80219L13.1434 5.45437C12.2319 4.88461 11.1544 4.55547 9.99998 4.55547C7.39338 4.55547 5.17853 6.23348 4.37635 8.56812L1.11865 5.90109H1.1181C2.7824 2.6923 6.13513 0.5 9.99998 0.5C12.4263 0.5 14.6511 1.3643 16.3829 2.80219Z"
                                            fill="#F14336" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_54_4200">
                                            <rect width="20" height="20" fill="white"
                                                transform="translate(0 0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span>Sign in with google</span>
                            </a>
                            <a href="javascript:void(0);"
                                class="btn gap-2 btn-thin btn-lg btn-light w-100 rounded-xl">
                                <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_54_4189)">
                                        <path
                                            d="M13.8488 0.5C13.8954 0.5 13.9419 0.5 13.9911 0.5C14.1053 1.91044 13.5669 2.96432 12.9126 3.72751C12.2706 4.48542 11.3915 5.2205 9.96967 5.10897C9.87482 3.71872 10.4141 2.74301 11.0675 1.98158C11.6734 1.27197 12.7844 0.640517 13.8488 0.5Z"
                                            fill="black" />
                                        <path
                                            d="M18.1531 15.1805C18.1531 15.1945 18.1531 15.2068 18.1531 15.22C17.7535 16.4302 17.1835 17.4674 16.4879 18.4299C15.853 19.3038 15.0748 20.4797 13.6855 20.4797C12.4849 20.4797 11.6875 19.7078 10.4571 19.6867C9.15555 19.6656 8.4398 20.3322 7.24979 20.4999C7.11366 20.4999 6.97754 20.4999 6.84405 20.4999C5.9702 20.3735 5.26498 19.6814 4.75122 19.0579C3.23626 17.2153 2.06558 14.8353 1.84778 11.7896C1.84778 11.491 1.84778 11.1933 1.84778 10.8947C1.93999 8.71493 2.99914 6.94266 4.40695 6.08374C5.14993 5.62706 6.17132 5.23801 7.30863 5.4119C7.79605 5.48742 8.29401 5.65429 8.73049 5.8194C9.14414 5.97836 9.66142 6.26027 10.1515 6.24534C10.4834 6.23568 10.8137 6.06267 11.1483 5.94059C12.1284 5.58667 13.0892 5.18092 14.3556 5.3715C15.8776 5.60159 16.9578 6.27783 17.6252 7.32118C16.3377 8.14057 15.3199 9.37536 15.4938 11.484C15.6483 13.3994 16.7619 14.5201 18.1531 15.1805Z"
                                            fill="black" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_54_4189">
                                            <rect width="20" height="20" fill="white"
                                                transform="translate(0 0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span>Sign in with apple</span>
                            </a>
                            <div class="text-center mt-3">Not a member? <a href="sign-up.html"
                                    class="text-underline font-w600">Create an account</span></a>
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
