@extends('website.master')
@section('menuBlog', 'active')
@section('content')

    <!-- Page Header -->
    <section class="page-header py-5 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">Blog & Artikel</h1>
                    <nav aria-label="breadcrumb" class="d-flex justify-content-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/" class="text-white">Beranda</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="input-group">
                                <input type="text" class="form-control" id="blogSearch" placeholder="Cari artikel...">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 blog-post">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="assets/images/blog-1.jpg" class="img-fluid rounded-start h-100"
                                            alt="Blog Post">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-2">
                                                <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> 15
                                                    Juni 2023</small>
                                                <small class="text-muted"><i class="far fa-comment me-1"></i> 5
                                                    Komentar</small>
                                            </div>
                                            <h3 class="card-title post-title">Mengenal Tanda-tanda Anak Berkebutuhan
                                                Khusus</h3>
                                            <p class="card-text post-excerpt">Beberapa tanda awal yang perlu
                                                diperhatikan orang tua untuk mendeteksi kebutuhan khusus pada anak sejak
                                                dini dan langkah yang dapat diambil.</p>
                                            <a href="blog-single.html" class="btn btn-link text-primary p-0">Baca
                                                Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 blog-post">
                            <div class="card border-0 shadow-sm h-100">
                                <img src="assets/images/blog-2.jpg" class="card-img-top" alt="Blog Post">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> 10 Juni
                                            2023</small>
                                        <small class="text-muted"><i class="far fa-comment me-1"></i> 8 Komentar</small>
                                    </div>
                                    <h5 class="card-title post-title">Peran Orang Tua dalam Terapi Anak</h5>
                                    <p class="card-text post-excerpt">Bagaimana orang tua dapat mendukung proses terapi
                                        anak di rumah untuk hasil yang lebih optimal dan perkembangan yang
                                        berkelanjutan.</p>
                                    <a href="blog-single.html" class="btn btn-link text-primary p-0">Baca Selengkapnya
                                        <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Artikel lainnya dengan struktur serupa -->

                    </div>

                    <nav aria-label="Page navigation" class="mt-5">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0">
                            <h5 class="fw-bold mb-0">Kategori</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <a href="#"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Terapi Wicara
                                    <span class="badge bg-primary rounded-pill">12</span>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Terapi Okupasi
                                    <span class="badge bg-primary rounded-pill">8</span>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Terapi Perilaku
                                    <span class="badge bg-primary rounded-pill">15</span>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Parenting
                                    <span class="badge bg-primary rounded-pill">20</span>
                                </a>
                                <a href="#"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    Penanganan ABK
                                    <span class="badge bg-primary rounded-pill">18</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white border-0">
                            <h5 class="fw-bold mb-0">Artikel Populer</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <img src="assets/images/blog-thumb-1.jpg" alt="Blog Thumbnail" width="80"
                                    class="rounded me-3">
                                <div>
                                    <h6 class="fw-bold mb-1">Teknik Terapi Wicara di Rumah</h6>
                                    <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> 5 Mei
                                        2023</small>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <img src="assets/images/blog-thumb-2.jpg" alt="Blog Thumbnail" width="80"
                                    class="rounded me-3">
                                <div>
                                    <h6 class="fw-bold mb-1">Mengatasi Tantrum pada Anak Autis</h6>
                                    <small class="text-muted"><i class="far fa-calendar-alt me-1"></i> 22 April
                                        2023</small>
                                </div>
                            </div>
                            <!-- Artikel populer lainnya -->
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0">
                            <h5 class="fw-bold mb-0">Tags</h5>
                        </div>
                        <div class="card-body">
                            <div class="tags">
                                <a href="#" class="btn btn-sm btn-outline-secondary me-2 mb-2">Autisme</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary me-2 mb-2">ADHD</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary me-2 mb-2">Down Syndrome</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary me-2 mb-2">Gangguan Bicara</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary me-2 mb-2">Sensori Integrasi</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary me-2 mb-2">Terapi</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary me-2 mb-2">Parenting</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">Berlangganan Newsletter Kami</h2>
                    <p class="text-muted mb-4">Dapatkan artikel terbaru dan tips tentang terapi anak berkebutuhan khusus
                        langsung ke email Anda.</p>
                    <form class="row g-2 justify-content-center">
                        <div class="col-md-8">
                            <input type="email" class="form-control" placeholder="Alamat Email Anda">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">Berlangganan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
