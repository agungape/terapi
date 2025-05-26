@extends('website.master')
@section('menuTherapists', 'active')
@section('content')

    <section class="page-header py-5 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">Terapis Kami</h1>
                    <nav aria-label="breadcrumb" class="d-flex justify-content-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html" class="text-white">Beranda</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Terapis</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Therapists Content -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6">
                    <h2 class="fw-bold">Tim Terapis Profesional</h2>
                    <p class="text-muted">Bertemu dengan tim ahli kami yang berdedikasi untuk membantu perkembangan anak
                        Anda</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="dropdown d-inline-block me-2">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="therapistFilter"
                            data-bs-toggle="dropdown">
                            Filter Spesialisasi
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-value="all">Semua Spesialisasi</a></li>
                            <li><a class="dropdown-item" href="#" data-value="speech">Terapi Wicara</a></li>
                            <li><a class="dropdown-item" href="#" data-value="occupational">Terapi Okupasi</a>
                            </li>
                            <li><a class="dropdown-item" href="#" data-value="behavior">Terapi Perilaku</a></li>
                            <li><a class="dropdown-item" href="#" data-value="sensory">Terapi Sensori</a></li>
                        </ul>
                    </div>
                    <a href="/contact" class="btn btn-primary">Konsultasi dengan Terapis</a>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($terapis as $t)
                    @if ($t->role === 'Terapi Perilaku')
                        <div class="col-md-6 col-lg-4 therapist-card" data-specialty="speech">
                            <div class="card border-0 shadow-sm h-100">
                                <img src="{{ $t->foto ? asset('storage/terapis/' . $t->foto) : asset('assets/website/images/default-woman.png') }}"
                                    class="card-img-top" alt="Therapist">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-1">{{ $t->nama }}</h5>
                                    <p class="text-muted mb-3">{{ $t->role }}</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-box-sm bg-primary-light text-primary me-3">
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted">Pendidikan</small>
                                            <p class="mb-0 small">Sarjana Psikologi Universitas Halu Oleo</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-box-sm bg-primary-light text-primary me-3">
                                            <i class="fas fa-certificate"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted">Sertifikasi</small>
                                            <p class="mb-0 small">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box-sm bg-primary-light text-primary me-3">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted">Pengalaman</small>
                                            <p class="mb-0 small">2 tahun menangani anak berkebutuhan khusus
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @else
                        <div class="col-md-6 col-lg-4 therapist-card" data-specialty="occupational">
                            <div class="card border-0 shadow-sm h-100">
                                <img src="{{ $t->foto ? asset('storage/terapis/' . $t->foto) : asset('assets/website/images/default-woman.png') }}"
                                    class="card-img-top" alt="Therapist">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-1">{{ $t->nama }}</h5>
                                    <p class="text-muted mb-3">{{ $t->role }}</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-box-sm bg-success-light text-success me-3">
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted">Pendidikan</small>
                                            <p class="mb-0 small">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-box-sm bg-success-light text-success me-3">
                                            <i class="fas fa-certificate"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted">Sertifikasi</small>
                                            <p class="mb-0 small">Sensory Integration Certified, Handwriting Without Tears
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="icon-box-sm bg-success-light text-success me-3">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted">Pengalaman</small>
                                            <p class="mb-0 small">6 tahun menangani anak dengan gangguan motorik dan sensori
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach




            </div>

            <nav aria-label="Page navigation" class="mt-5">
                {{ $terapis->fragment('judul')->links() }}
            </nav>
        </div>
    </section>

    <!-- Appointment Section -->
    {{-- <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-4">Jadwalkan Sesi Terapi</h2>
                    <p class="mb-4">Kami siap membantu Anda menemukan terapis yang sesuai dengan kebutuhan anak. Tim
                        kami akan menghubungi Anda dalam 24 jam untuk mengkonfirmasi janji temu.</p>
                    <div class="d-flex mb-3">
                        <div class="icon-box-sm bg-primary-light text-primary me-4">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Telepon Kami</h5>
                            <p class="text-muted mb-0">(021) 1234-5678</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="icon-box-sm bg-primary-light text-primary me-4">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Email Kami</h5>
                            <p class="text-muted mb-0">info@terapianakku.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Formulir Janji Temu</h5>
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="phone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="service" class="form-label">Jenis Layanan</label>
                                    <select class="form-select" id="service">
                                        <option selected>Pilih Layanan</option>
                                        <option>Terapi Wicara</option>
                                        <option>Terapi Okupasi</option>
                                        <option>Terapi Perilaku</option>
                                        <option>Assesmen Psikologis</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Pesan</label>
                                    <textarea class="form-control" id="message" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Kirim Permohonan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

@endsection
