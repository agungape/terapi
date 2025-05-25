<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terapi Anak Berkebutuhan Khusus | Pusat Layanan Terpadu</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets') }}/website/images/logo.png" type="image/png">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/website/css/style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets') }}/website/images/logo.jpg" alt="Logo" height="50" id="logo">
                <span class="ms-2 fw-bold">Bright Star Of Child</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link @yield('menuIndex')" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menuAbout')" href="/about">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menuServices')" href="/services">Layanan</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @yield('menuTherapists')" href="/therapists">Terapis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menuBlog')" href="/blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menuContact')" href="/contact">Kontak</a>
                    </li>
                </ul>
                <a href="/contact" class="btn btn-primary ms-lg-3">Janji Temu</a>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <img src="{{ asset('assets') }}/website/images/logo-white.png" alt="Logo" height="50"
                        class="mb-3">
                    <p>Pusat Terapi Anak Berkebutuhan Khusus yang menyediakan layanan terpadu </p>
                    <div class="social-icons">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/brightstarofchild" class="text-white me-3" target="_blank"
                            rel="noopener noreferrer" aria-label="Facebook kami">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <!-- Instagram -->
                        <a href="https://www.instagram.com/brightstarofchild" class="text-white me-3" target="_blank"
                            rel="noopener noreferrer" aria-label="Instagram kami">
                            <i class="fab fa-instagram"></i>
                        </a>



                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5 class="fw-bold mb-4">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/index" class="text-white text-decoration-none">Beranda</a>
                        </li>
                        <li class="mb-2"><a href="/about" class="text-white text-decoration-none">Tentang
                                Kami</a>
                        </li>
                        <li class="mb-2"><a href="/services" class="text-white text-decoration-none">Layanan</a>
                        </li>
                        <li class="mb-2"><a href="/therapists" class="text-white text-decoration-none">Terapis</a>
                        </li>
                        <li class="mb-2"><a href="/blog" class="text-white text-decoration-none">Blog</a></li>
                        <li><a href="/contact" class="text-white text-decoration-none">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-4">
                    <h5 class="fw-bold mb-4">Kontak Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span>{{ $profile->alamat }}</span>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone-alt me-2"></i>
                            <span>{{ $profile->telepon }}8</span>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope me-2"></i>
                            <span>{{ $profile->email }}</span>
                        </li>
                        <li>
                            <i class="fas fa-clock me-2"></i>
                            <span>Senin-Jumat: 09.00-17.00</span>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2024 Pusat Terapi Anak. <b>Bright Star Of Child</b>. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white text-decoration-none me-3">Kebijakan Privasi</a>
                    <a href="#" class="text-white text-decoration-none">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="btn btn-primary back-to-top shadow"><i class="fas fa-arrow-up"></i></a>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets') }}/website/js/main.js"></script>
</body>

</html>
