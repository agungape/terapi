@extends('website.master')
@section('menuServices', 'active')
@section('content')

    <!-- Page Header -->
    <section class="page-header py-5 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-4 fw-bold">Layanan Kami</h1>
                    <nav aria-label="breadcrumb" class="d-flex justify-content-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/index" class="text-white">Beranda</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Layanan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                        <div class="card-header bg-white border-0">
                            <h5 class="fw-bold mb-0">Daftar Layanan</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <a href="#speech-therapy" class="list-group-item list-group-item-action active">Terapi
                                    Wicara</a>
                                <a href="#occupational-therapy" class="list-group-item list-group-item-action">Terapi
                                    Okupasi</a>
                                <a href="#behavior-therapy" class="list-group-item list-group-item-action">Terapi
                                    Perilaku</a>
                                <a href="#sensory-therapy" class="list-group-item list-group-item-action">Terapi Sensori
                                    Integrasi</a>
                                <a href="#psych-assessment" class="list-group-item list-group-item-action">Assesmen
                                    Psikologis</a>
                                <a href="#parent-training" class="list-group-item list-group-item-action">Pelatihan
                                    Orang Tua</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="service-detail mb-5" id="speech-therapy">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box bg-primary-light text-primary me-4">
                                <i class="fas fa-comment-medical fa-2x"></i>
                            </div>
                            <h3 class="fw-bold mb-0">Terapi Wicara</h3>
                        </div>
                        <p>Terapi wicara adalah layanan yang ditujukan untuk membantu anak-anak dengan kesulitan dalam
                            berkomunikasi, baik secara verbal maupun non-verbal. Layanan ini mencakup berbagai gangguan
                            bicara dan bahasa.</p>

                        <h5 class="fw-bold mt-4">Manfaat Terapi Wicara:</h5>
                        <ul class="mb-4">
                            <li>Meningkatkan kemampuan artikulasi dan pengucapan kata</li>
                            <li>Mengembangkan kosakata dan pemahaman bahasa</li>
                            <li>Meningkatkan kemampuan berkomunikasi secara fungsional</li>
                            <li>Mengatasi gangguan kelancaran bicara (gagap)</li>
                            <li>Membantu anak dengan gangguan pendengaran</li>
                        </ul>

                        <h5 class="fw-bold">Indikasi Anak Membutuhkan Terapi Wicara:</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <ul>
                                    <li>Anak usia 2 tahun belum mengucapkan kata</li>
                                    <li>Ucapan tidak jelas setelah usia 3 tahun</li>
                                    <li>Kosakata sangat terbatas</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li>Sulit menyusun kalimat</li>
                                    <li>Gagap atau bicara tidak lancar</li>
                                    <li>Anak dengan diagnosis tertentu (autisme, down syndrome)</li>
                                </ul>
                            </div>
                        </div>

                        <div class="bg-light p-4 rounded">
                            <h5 class="fw-bold">Proses Terapi:</h5>
                            <p>Setiap anak akan melalui proses assesmen awal untuk menentukan program terapi yang
                                sesuai. Terapi dilakukan 1-2 kali seminggu dengan durasi 45-60 menit per sesi. Orang tua
                                akan mendapatkan laporan perkembangan dan panduan latihan di rumah.</p>
                            <a href="https://wa.me/6285123238404" class="btn btn-primary mt-2">Jadwalkan Assesmen</a>
                        </div>
                    </div>

                    <div class="service-detail mb-5" id="occupational-therapy">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box bg-success-light text-success me-4">
                                <i class="fas fa-hands-helping fa-2x"></i>
                            </div>
                            <h3 class="fw-bold mb-0">Terapi Okupasi</h3>
                        </div>
                        <p>Terapi okupasi membantu anak-anak dengan kesulitan dalam aktivitas kehidupan sehari-hari,
                            terutama yang berkaitan dengan keterampilan motorik halus dan koordinasi.</p>

                        <h5 class="fw-bold mt-4">Manfaat Terapi Okupasi:</h5>
                        <ul class="mb-4">
                            <li>Meningkatkan keterampilan motorik halus (memegang pensil, menggunting)</li>
                            <li>Mengembangkan kemandirian dalam aktivitas sehari-hari</li>
                            <li>Meningkatkan koordinasi mata-tangan</li>
                            <li>Memperbaiki postur dan keseimbangan</li>
                            <li>Mengatasi kesulitan sensori</li>
                        </ul>

                        <div class="bg-light p-4 rounded">
                            <h5 class="fw-bold">Proses Terapi:</h5>
                            <p>Terapis akan melakukan evaluasi menyeluruh terhadap kemampuan anak dan menetapkan tujuan
                                terapi. Sesi terapi biasanya berlangsung 45-60 menit dengan frekuensi 1-3 kali seminggu,
                                tergantung kebutuhan anak.</p>
                            <a href="https://wa.me/6285123238404" class="btn btn-success mt-2">Konsultasi Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
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
                                    Berapa lama anak perlu mengikuti terapi?
                                </button>
                            </h3>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Durasi terapi bervariasi tergantung kondisi anak dan respons terhadap terapi.
                                    Rata-rata anak membutuhkan 6-12 bulan terapi intensif sebelum menunjukkan
                                    perkembangan signifikan. Terapis akan melakukan evaluasi berkala untuk menyesuaikan
                                    program.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h3 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo">
                                    Apakah orang tua boleh mengikuti sesi terapi?
                                </button>
                            </h3>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Kami sangat menganjurkan orang tua untuk mengamati sesi terapi agar dapat
                                    melanjutkan latihan di rumah. Beberapa sesi bahkan dirancang khusus untuk melibatkan
                                    orang tua secara aktif dalam proses terapi.
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
