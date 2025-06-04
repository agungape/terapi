@extends('website.master')
@section('menuAbout', 'active')
@section('content')

    <!-- Page Header -->
    <section class="page-header py-5 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">Tentang Kami</h1>
                    <nav aria-label="breadcrumb" class="d-flex justify-content-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/" class="text-white">Beranda</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Tentang Kami</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('assets/website/images/kepala-yayasan.png') }}" alt="Tentang Kami"
                        class="img-fluid rounded shadow-lg">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Visi & Misi Kami</h2>
                    <p>Bright Star Of Child didirikan pada tahun 2022 dengan tujuan memberikan layanan terapi yang
                        komprehensif untuk anak-anak berkebutuhan khusus di Sulawesi Tenggara Khususnya Kab. Konawe.</p>

                    <div class="mb-4">
                        <h5 class="fw-bold">Visi Kami</h5>
                        <p>Menjadi pusat terapi anak berkebutuhan khusus terdepan yang memberikan layanan holistik
                            berbasis bukti untuk membantu setiap anak mencapai potensi maksimal mereka.</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-bold">Misi Kami</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Memberikan layanan
                                terapi yang berkualitas dengan pendekatan individual</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Meningkatkan
                                kesadaran masyarakat tentang kebutuhan khusus anak</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Melibatkan keluarga
                                dalam proses terapi untuk hasil yang optimal</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Mengembangkan
                                metode
                                terapi yang inovatif berbasis penelitian</li>
                            <li><i class="fas fa-check-circle text-primary me-2"></i> Menyediakan lingkungan yang aman
                                dan nyaman untuk perkembangan anak</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Tim Ahli Kami</h2>
                <p class="text-muted">Bertemu dengan tim profesional kami yang berdedikasi</p>
            </div>
            <div class="row g-4">
                @foreach ($psikolog as $p)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 p-4">
                            @if ($p->nama == 'Wisnu Catur Bayu, P. M.Psi.,Psikolog')
                                <img src="{{ asset('assets/website/images/default-man.png') }}" class="card-img-top"
                                    alt="Team Member">
                            @else
                                <img src="{{ asset('assets/website/images/default-woman.png') }}" class="card-img-top"
                                    alt="Team Member">
                            @endif
                            <div class="card-body text-center">
                                <h5 class="fw-bold mb-1">{{ $p->nama }}</h5>
                                <p class="text-muted mb-3">Psikolog</p>
                                <p class="card-text">Spesialis dalam assesmen psikologis dan terapi perilaku untuk anak
                                    dengan kebutuhan khusus.</p>
                                <div class="social-links">
                                    <a href="#" class="text-primary me-2"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="text-primary"><i class="fas fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- @foreach ($terapis as $t)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 p-4">
                            <img src="{{ $t->foto ? asset('storage/terapis/' . $t->foto) : asset('assets/website/images/default-woman.png') }}"
                                class="card-img-top" alt="Team Member">
                            <div class="card-body text-center">
                                <h5 class="fw-bold mb-1">{{ $t->nama }}</h5>
                                <p class="text-muted mb-3">{{ $t->role }}</p>
                                <p class="card-text">Ahli dalam terapi perilaku untuk anak dengan gangguan autis dan
                                    hiperaktif.
                                </p>
                                <div class="social-links">
                                    <a href="#" class="text-primary me-2"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="text-primary"><i class="fas fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}


            </div>
            <div class="text-center mt-5">
                <a href="/therapists" class="btn btn-primary">Lihat Semua Terapis</a>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Nilai-nilai Kami</h2>
                <p class="text-muted">Prinsip yang memandu setiap aspek layanan kami</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-primary-light text-primary mb-4">
                                <i class="fas fa-heart fa-2x"></i>
                            </div>
                            <h5 class="fw-bold">Kasih Sayang</h5>
                            <p class="text-muted">Kami memperlakukan setiap anak dengan kasih sayang dan pengertian,
                                menciptakan lingkungan yang hangat dan mendukung.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-success-light text-success mb-4">
                                <i class="fas fa-graduation-cap fa-2x"></i>
                            </div>
                            <h5 class="fw-bold">Profesionalisme</h5>
                            <p class="text-muted">Tim kami terdiri dari profesional bersertifikat yang terus
                                mengembangkan keahlian melalui pelatihan berkala.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="icon-box bg-warning-light text-warning mb-4">
                                <i class="fas fa-lightbulb fa-2x"></i>
                            </div>
                            <h5 class="fw-bold">Inovasi</h5>
                            <p class="text-muted">Kami terus mengembangkan metode terapi berbasis penelitian terbaru
                                untuk hasil yang optimal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
