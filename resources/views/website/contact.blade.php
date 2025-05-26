@extends('website.master')
@section('menuContact', 'active')
@section('content')

    <!-- Page Header -->
    <section class="page-header py-5 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">Kontak Kami</h1>
                    <nav aria-label="breadcrumb" class="d-flex justify-content-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/index" class="text-white">Beranda</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Kontak</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <h2 class="fw-bold mb-4">Hubungi Kami</h2>
                    <p class="mb-4">Kami siap membantu menjawab pertanyaan Anda tentang layanan terapi kami. Silakan
                        hubungi melalui informasi kontak berikut</p>

                    <div class="d-flex mb-4">
                        <div class="icon-box bg-primary-light text-primary me-4">
                            <i class="fas fa-map-marker-alt fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Alamat Kami</h5>
                            <p class="text-muted mb-0">{{ $profile->alamat }}</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="icon-box bg-primary-light text-primary me-4">
                            <i class="fas fa-phone-alt fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Telepon</h5>
                            <p class="text-muted mb-0">{{ $profile->telepon }} (WhatsApp)</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="icon-box bg-primary-light text-primary me-4">
                            <i class="fas fa-envelope fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Email</h5>
                            <p class="text-muted mb-0">{{ $profile->email }}</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="icon-box bg-primary-light text-primary me-4">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Jam Operasional</h5>
                            <p class="text-muted mb-0">Senin-Jumat: 09.00-17.00 WIB</p>
                        </div>
                    </div>

                    <div class="social-icons mt-5">
                        <h5 class="fw-bold mb-3">Ikuti Kami</h5>
                        <a href="#" class="icon-box bg-primary-light text-primary me-2">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="icon-box bg-primary-light text-primary me-2">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="icon-box bg-primary-light text-primary me-2">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="icon-box bg-primary-light text-primary">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-4">Formulir Kontak</h3>
                            <form id="contactForm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" required>
                                        <div class="invalid-feedback">
                                            Harap isi nama lengkap Anda.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" required>
                                        <div class="invalid-feedback">
                                            Harap isi email yang valid.
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="subject" class="form-label">Subjek</label>
                                        <input type="text" class="form-control" id="subject" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="message" class="form-label">Pesan</label>
                                        <textarea class="form-control" id="message" rows="5" required></textarea>
                                        <div class="invalid-feedback">
                                            Harap isi pesan Anda.
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="consent" required>
                                            <label class="form-check-label" for="consent">
                                                Saya setuju dengan <a href="#">kebijakan privasi</a> dan <a
                                                    href="#">syarat & ketentuan</a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-0">
        <div class="container-fluid p-0">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2092.6676644627596!2d122.11412577453203!3d-3.8650925503181672!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d984f00566d4c67%3A0xc374c04b7f4c6d23!2sTerapi%20Anak%20Berkebutuhan%20Khusus!5e1!3m2!1sen!2sid!4v1748236403190!5m2!1sen!2sid"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Pertanyaan Umum</h2>
                <p class="text-muted">Temukan jawaban atas pertanyaan yang sering diajukan</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h3 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne">
                                    Bagaimana cara membuat janji temu untuk terapi?
                                </button>
                            </h3>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Anda dapat menghubungi kami melalui telepon, WhatsApp, atau mengisi formulir kontak
                                    di website. Tim kami akan menjawab dalam 1x24 jam untuk mengkonfirmasi jadwal
                                    terapi.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h3 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo">
                                    Apakah tersedia layanan terapi di rumah?
                                </button>
                            </h3>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, kami menyediakan layanan terapi di rumah untuk area Jakarta dan sekitarnya
                                    dengan biaya tambahan untuk transportasi terapis. Silakan hubungi kami untuk
                                    informasi lebih lanjut.
                                </div>
                            </div>
                        </div>
                        <!-- Item FAQ lainnya -->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
