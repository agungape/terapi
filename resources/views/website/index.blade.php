@extends('website.master')
@section('menuIndex', 'active')
@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInUp">Pendampingan Khusus untuk
                        Anak Berkebutuhan Khusus</h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">Kami memberikan terapi
                        profesional dan pendampingan holistik untuk membantu perkembangan optimal anak Anda.</p>
                    <div class="d-flex gap-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="https://wa.me/6285123238404" class="btn btn-primary btn-lg">Konsultasi Gratis</a>
                        <a href="/services" class="btn btn-outline-primary btn-lg">Layanan Kami</a>
                    </div>
                </div>
                <div class="col-lg-6 animate__animated animate__fadeIn">
                    <img src="{{ asset('assets') }}/website/images/hero-image.png" alt="Terapi Anak"
                        class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Unggulan -->
    <section class="services-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Layanan Unggulan Kami</h2>
                <p class="text-muted">Berbagai jenis terapi yang kami tawarkan untuk kebutuhan khusus anak Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm service-card">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-primary-light text-primary mb-4">
                                <i class="fas fa-comment-medical fa-2x"></i>
                            </div>
                            <h5 class="fw-bold">Terapi Wicara</h5>
                            <p class="text-muted">Membantu anak dengan kesulitan berbicara, berkomunikasi, dan
                                mengekspresikan diri.</p>
                            <a href="/services" class="btn btn-link text-primary stretched-link">Selengkapnya <i
                                    class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm service-card">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-success-light text-success mb-4">
                                <i class="fas fa-hands-helping fa-2x"></i>
                            </div>
                            <h5 class="fw-bold">Fisioterapi dan Sensor Intgerasi</h5>
                            <p class="text-muted">Meningkatkan kemampuan motorik halus dan aktivitas kehidupan
                                sehari-hari.</p>
                            <a href="/services" class="btn btn-link text-primary stretched-link">Selengkapnya <i
                                    class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm service-card">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-warning-light text-warning mb-4">
                                <i class="fas fa-brain fa-2x"></i>
                            </div>
                            <h5 class="fw-bold">Terapi Perilaku</h5>
                            <p class="text-muted">Membantu anak mengelola emosi dan perilaku dengan pendekatan ilmiah.
                            </p>
                            <a href="/services" class="btn btn-link text-primary stretched-link">Selengkapnya <i
                                    class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="/services" class="btn btn-outline-primary">Lihat Semua Layanan</a>
            </div>
        </div>
    </section>

    <!-- Statistik -->
    <section class="stats-section py-5 bg-primary text-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="counter" data-target="500">{{ $anak }}</div>
                    <p class="mb-0">Anak Terbantu</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="counter" data-target="15">{{ count($terapis) }}</div>
                    <p class="mb-0">Terapis Ahli</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="counter" data-target="10">3</div>
                    <p class="mb-0">Jenis Terapi</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section class="about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="assets/images/about.jpg" alt="Tentang Kami" class="img-fluid rounded shadow-lg">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Tentang <span class="text-primary">Bright Star </span><span
                            class="text-warning"> Of Child</span></h2>


                    <p>Kami adalah pusat terapi anak berkebutuhan khusus yang berkomitmen untuk memberikan layanan
                        terbaik dengan pendekatan holistik dan berbasis bukti.</p>

                    <div class="d-flex mb-3">
                        <div class="me-4">
                            <div class="icon-box-sm bg-primary-light text-primary mb-2">
                                <i class="fas fa-user-md"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold">Tenaga Ahli Berpengalaman</h5>
                            <p class="text-muted">Terapis kami memiliki sertifikasi dan pengalaman luas di bidangnya.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="me-4">
                            <div class="icon-box-sm bg-success-light text-success mb-2">
                                <i class="fas fa-child"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold">Pendekatan Individual</h5>
                            <p class="text-muted">Setiap anak mendapatkan program terapi yang disesuaikan dengan
                                kebutuhannya.</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="me-4">
                            <div class="icon-box-sm bg-warning-light text-warning mb-2">
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="fw-bold">Dukungan Orang Tua</h5>
                            <p class="text-muted">Kami melibatkan orang tua dalam proses terapi untuk hasil yang
                                optimal.</p>
                        </div>
                    </div>

                    <a href="/about" class="btn btn-primary mt-4">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section class="testimonial-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Apa Kata Orang Tua</h2>
                <p class="text-muted">Testimoni dari orang tua yang telah mempercayakan anaknya kepada kami</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex mb-3">
                                <img src="assets/images/testimonial-1.jpg" alt="Testimoni" class="rounded-circle me-3"
                                    width="60" height="60">
                                <div>
                                    <h6 class="fw-bold mb-0">Ibu Siti</h6>
                                    <small class="text-muted">Orang Tua dari Ahmad</small>
                                </div>
                            </div>
                            <div class="rating mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="mb-0">" Setelah 6 bulan terapi wicara di sini, anak saya sekarang sudah
                                bisa mengucapkan banyak kata dengan jelas. Terima kasih untuk kesabaran terapisnya."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex mb-3">
                                <img src="assets/images/testimonial-2.jpg" alt="Testimoni" class="rounded-circle me-3"
                                    width="60" height="60">
                                <div>
                                    <h6 class="fw-bold mb-0">Budi Santoso</h6>
                                    <small class="text-muted">Orang Tua dari Dinda</small>
                                </div>
                            </div>
                            <div class="rating mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="mb-0">"Pendekatan terapisnya sangat baik. Anak saya yang dulunya sulit fokus
                                sekarang sudah bisa duduk tenang dan mengikuti instruksi."</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex mb-3">
                                <img src="assets/images/testimonial-3.jpg" alt="Testimoni" class="rounded-circle me-3"
                                    width="60" height="60">
                                <div>
                                    <h6 class="fw-bold mb-0">Dewi Anggraeni</h6>
                                    <small class="text-muted">Orang Tua dari Raka</small>
                                </div>
                            </div>
                            <div class="rating mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star-half-alt text-warning"></i>
                            </div>
                            <p class="mb-0">"Fasilitasnya lengkap dan nyaman. Terapisnya juga memberikan laporan
                                perkembangan anak setiap bulannya sehingga kami bisa memantau perkembangannya."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Artikel Terbaru</h2>
                <p class="text-muted">Informasi dan tips tentang terapi anak berkebutuhan khusus</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="assets/images/blog-1.jpg" class="card-img-top" alt="Blog Post">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> 15 Juni
                                    2023</small>
                                <small class="text-muted"><i class="far fa-comment me-1"></i> 5 Komentar</small>
                            </div>
                            <h5 class="card-title">Mengenal Tanda-tanda Anak Berkebutuhan Khusus</h5>
                            <p class="card-text text-muted">Beberapa tanda awal yang perlu diperhatikan orang tua untuk
                                mendeteksi kebutuhan khusus pada anak.</p>
                            <a href="blog-single.html" class="btn btn-link text-primary p-0">Baca Selengkapnya <i
                                    class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="assets/images/blog-2.jpg" class="card-img-top" alt="Blog Post">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> 10 Juni
                                    2023</small>
                                <small class="text-muted"><i class="far fa-comment me-1"></i> 8 Komentar</small>
                            </div>
                            <h5 class="card-title">Peran Orang Tua dalam Terapi Anak</h5>
                            <p class="card-text text-muted">Bagaimana orang tua dapat mendukung proses terapi anak di
                                rumah untuk hasil yang lebih optimal.</p>
                            <a href="blog-single.html" class="btn btn-link text-primary p-0">Baca Selengkapnya <i
                                    class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="assets/images/blog-3.jpg" class="card-img-top" alt="Blog Post">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> 5 Juni 2023</small>
                                <small class="text-muted"><i class="far fa-comment me-1"></i> 12 Komentar</small>
                            </div>
                            <h5 class="card-title">Teknik Terapi Wicara untuk Anak di Rumah</h5>
                            <p class="card-text text-muted">Beberapa latihan sederhana yang bisa dilakukan orang tua
                                untuk membantu perkembangan bicara anak.</p>
                            <a href="blog-single.html" class="btn btn-link text-primary p-0">Baca Selengkapnya <i
                                    class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="/blog" class="btn btn-outline-primary">Lihat Semua Artikel</a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-3">Siap Membantu Perkembangan Anak Anda</h2>
                    <p class="mb-0">Jangan ragu untuk berkonsultasi dengan kami. Tim profesional kami siap memberikan
                        solusi terbaik untuk kebutuhan khusus anak Anda.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="https://wa.me/6285123238404" class="btn btn-light btn-lg">Hubungi Kami Sekarang</a>
                </div>
            </div>
        </div>
    </section>

@endsection
