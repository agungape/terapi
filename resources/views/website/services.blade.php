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
                                <a href="#speech-therapy" class="list-group-item list-group-item-action">Terapi
                                    Wicara</a>
                                <a href="#behavioral-therapy" class="list-group-item list-group-item-action">Terapi
                                    Perilaku</a>
                                <a href="#physiotherapy" class="list-group-item list-group-item-action">Fisioterapi
                                </a>
                                <a href="#sensory-integration" class="list-group-item list-group-item-action">Terapi Sensori
                                    Integrasi</a>
                                <a href="#child-psychology-assessment"
                                    class   ="list-group-item list-group-item-action">Assesmen
                                    Psikologis</a>
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
                            <a href="https://wa.me/6285123238404" class="btn btn-primary mt-2">Konsultasi Sekarang</a>
                        </div>
                    </div>

                    <div class="service-detail mb-5" id="behavioral-therapy">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box bg-primary-light text-primary me-4">
                                <i class="fas fa-user-check fa-2x"></i>
                            </div>
                            <h3 class="fw-bold mb-0">Terapi Perilaku</h3>
                        </div>
                        <p>Terapi perilaku membantu anak-anak yang mengalami tantangan emosional atau perilaku, seperti
                            tantrum, kesulitan mengikuti instruksi, atau gangguan pemusatan perhatian. Terapi ini bertujuan
                            untuk membentuk perilaku positif melalui pendekatan yang terstruktur dan konsisten.</p>

                        <h5 class="fw-bold mt-4">Manfaat Terapi Perilaku:</h5>
                        <ul class="mb-4">
                            <li>Mengurangi perilaku agresif atau destruktif</li>
                            <li>Meningkatkan kemampuan mengikuti aturan dan instruksi</li>
                            <li>Membantu anak mengelola emosi secara sehat</li>
                            <li>Menumbuhkan keterampilan sosial yang positif</li>
                            <li>Memperbaiki fokus dan konsentrasi</li>
                        </ul>

                        <div class="bg-light p-4 rounded">
                            <h5 class="fw-bold">Proses Terapi:</h5>
                            <p>Terapis akan melakukan observasi dan penilaian perilaku anak secara menyeluruh untuk menyusun
                                program intervensi yang sesuai. Sesi terapi berlangsung sekitar 45–60 menit dan dilakukan
                                1–2 kali seminggu, dengan keterlibatan aktif dari orang tua untuk penerapan strategi di
                                rumah.</p>
                            <a href="https://wa.me/6285123238404" class="btn btn-primary mt-2">Konsultasi Sekarang</a>
                        </div>
                    </div>

                    <div class="service-detail mb-5" id="physiotherapy">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box bg-success-light text-success me-4">
                                <i class="fas fa-walking fa-2x"></i>
                            </div>
                            <h3 class="fw-bold mb-0">Fisioterapi</h3>
                        </div>
                        <p>Fisioterapi membantu anak-anak yang mengalami keterlambatan perkembangan motorik kasar, kelemahan
                            otot, atau gangguan gerak. Terapi ini bertujuan untuk meningkatkan kekuatan, koordinasi, dan
                            mobilitas anak.</p>

                        <h5 class="fw-bold mt-4">Manfaat Fisioterapi:</h5>
                        <ul class="mb-4">
                            <li>Meningkatkan kekuatan otot dan stabilitas tubuh</li>
                            <li>Melatih koordinasi dan keseimbangan</li>
                            <li>Mendukung keterampilan berjalan, berdiri, dan duduk</li>
                            <li>Membantu mengatasi gangguan muskuloskeletal</li>
                            <li>Memperbaiki postur dan fleksibilitas tubuh</li>
                        </ul>

                        <div class="bg-light p-4 rounded">
                            <h5 class="fw-bold">Proses Terapi:</h5>
                            <p>Fisioterapis akan melakukan evaluasi fisik untuk menilai kemampuan gerak anak dan menentukan
                                rencana terapi. Sesi berlangsung selama 45–60 menit, dengan frekuensi 1–3 kali seminggu
                                tergantung kondisi anak.</p>
                            <a href="https://wa.me/6285123238404" class="btn btn-success mt-2">Konsultasi Sekarang</a>
                        </div>
                    </div>

                    <div class="service-detail mb-5" id="sensory-integration">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box bg-success-light text-success me-4">
                                <i class="fas fa-brain fa-2x"></i>
                            </div>
                            <h3 class="fw-bold mb-0">Terapi Integrasi Sensori</h3>
                        </div>
                        <p>Terapi integrasi sensori ditujukan untuk anak-anak yang mengalami kesulitan dalam memproses dan
                            merespon rangsangan dari lingkungan, seperti suara, sentuhan, atau gerakan. Tujuannya adalah
                            membantu anak merespon rangsangan secara tepat dan nyaman.</p>

                        <h5 class="fw-bold mt-4">Manfaat Terapi Integrasi Sensori:</h5>
                        <ul class="mb-4">
                            <li>Meningkatkan toleransi terhadap rangsangan sensori</li>
                            <li>Membantu anak lebih fokus dan tenang</li>
                            <li>Memperbaiki keterampilan motorik dan keseimbangan</li>
                            <li>Mengurangi perilaku menghindar atau berlebih terhadap rangsangan</li>
                            <li>Menunjang perkembangan belajar dan sosial</li>
                        </ul>

                        <div class="bg-light p-4 rounded">
                            <h5 class="fw-bold">Proses Terapi:</h5>
                            <p>Terapis akan melakukan asesmen sensori untuk memahami profil sensori anak. Sesi terapi
                                melibatkan aktivitas bermain yang dirancang untuk menstimulasi sistem sensori secara
                                terstruktur. Durasi terapi 45–60 menit, dilakukan 1–3 kali seminggu.</p>
                            <a href="https://wa.me/6285123238404" class="btn btn-success mt-2">Konsultasi Sekarang</a>
                        </div>
                    </div>

                    <div class="service-detail mb-5" id="child-psychology-assessment">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-box bg-warning-light text-warning me-4">
                                <i class="fas fa-child fa-2x"></i>
                            </div>
                            <h3 class="fw-bold mb-0">Assessment Psikologi Anak</h3>
                        </div>
                        <p>Assessment psikologi anak bertujuan untuk memahami kondisi emosional, perilaku, dan perkembangan
                            kognitif anak. Proses ini penting untuk mendeteksi dini hambatan perkembangan dan memberikan
                            rekomendasi penanganan yang sesuai.</p>

                        <h5 class="fw-bold mt-4">Tujuan Assessment Psikologi:</h5>
                        <ul class="mb-4">
                            <li>Mengetahui potensi dan hambatan perkembangan anak</li>
                            <li>Mendiagnosis gangguan tumbuh kembang atau perilaku</li>
                            <li>Memberikan arahan terapi atau intervensi yang tepat</li>
                            <li>Membantu orang tua memahami kebutuhan emosional anak</li>
                            <li>Meningkatkan dukungan di rumah dan sekolah</li>
                        </ul>

                        <div class="bg-light p-4 rounded">
                            <h5 class="fw-bold">Proses Assessment:</h5>
                            <p>Psikolog anak akan melakukan wawancara dengan orang tua, observasi langsung, serta penggunaan
                                alat tes psikologis sesuai usia dan kebutuhan anak. Hasil assessment disampaikan dalam
                                bentuk laporan dan rekomendasi lanjutan.</p>
                            <a href="https://wa.me/6285123238404" class="btn btn-warning mt-2">Konsultasi Sekarang</a>
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
