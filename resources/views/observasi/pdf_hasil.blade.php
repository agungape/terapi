<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Observasi Zahira | Bright Star</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        body {
            font-family: 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #4a5568;
            background-color: #f7fafc;
        }

        .report-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: var(--card-shadow);
            border-radius: 12px;
            overflow: hidden;
        }

        .report-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .report-header::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .logo-container {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .logo {
            height: 60px;
            margin-right: 15px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .header-text h1 {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0.25rem;
        }

        .header-text p {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .patient-info {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            margin-top: 1.5rem;
            box-shadow: var(--card-shadow);
        }

        .patient-info h3 {
            color: var(--primary);
            font-size: 1.25rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .patient-info h3 i {
            margin-right: 10px;
            color: var(--accent);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
        }

        .info-item i {
            color: var(--accent);
            margin-right: 10px;
            margin-top: 3px;
        }

        .section-title {
            color: var(--primary);
            font-weight: 600;
            font-size: 1.25rem;
            margin: 2rem 0 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--accent);
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--accent);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            color: var(--secondary);
            border-radius: 10px 10px 0 0 !important;
        }

        .observation-item {
            display: flex;
            margin-bottom: 1rem;
            align-items: flex-start;
        }

        .observation-icon {
            background: #e3f2fd;
            color: var(--accent);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .therapy-plan {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .therapy-plan h5 {
            color: var(--secondary);
            font-size: 1rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .therapy-plan h5 i {
            margin-right: 8px;
            color: var(--accent);
        }

        .signature-section {
            margin-top: 3rem;
            text-align: right;
        }

        .signature {
            display: inline-block;
            border-top: 1px solid #e2e8f0;
            padding-top: 1rem;
            margin-top: 4rem;
        }

        .print-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 100;
            background: var(--primary);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
            border: none;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .report-container {
                box-shadow: none;
                border-radius: 0;
            }

            .print-button {
                display: none;
            }

            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="report-container">
            <!-- Modern Header with Logo -->
            <div class="report-header">
                <div class="logo-container">
                    <img src="{{ asset('images/logo_bright_star_white.png') }}" alt="Bright Star Logo" class="logo">
                    <div class="header-text">
                        <h1>BRIGHT STAR OF CHILD</h1>
                        <p>Pusat Layanan Terapi Anak Istimewa</p>
                    </div>
                </div>

                <!-- Patient Info Card -->
                <div class="patient-info">
                    <h3><i class="fas fa-user-circle"></i> Informasi Pasien</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <i class="fas fa-id-card"></i>
                            <div>
                                <strong>Nama:</strong><br>
                                Zahira
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-calendar-alt"></i>
                            <div>
                                <strong>Tanggal Observasi:</strong><br>
                                22 April 2025
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-stethoscope"></i>
                            <div>
                                <strong>Terapis:</strong><br>
                                Inne Pusvitasari, S.Psi
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-file-alt"></i>
                            <div>
                                <strong>No. Laporan:</strong><br>
                                BSOC-2025-0422-001
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Content -->
            <div class="p-4">
                <h2 class="text-center mb-4" style="color: var(--primary);">LAPORAN HASIL OBSERVASI</h2>

                <!-- Page break before first section -->
                <div class="page-break"></div>

                <!-- Early Detection Section -->
                <div class="section-title"><i class="fas fa-clipboard-check"></i> HASIL DETEKSI DINI</div>

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-2"></i> Ringkasan Hasil Deteksi
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 40%;">Alat Observasi</th>
                                        <th>Hasil</th>
                                        <th>Interpretasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Deteksi Penyimpangan Perilaku (KMPE)</td>
                                        <td><span class="badge bg-warning">7/14 YA</span></td>
                                        <td>Indikasi masalah mental emosional</td>
                                    </tr>
                                    <tr>
                                        <td>Deteksi Autis (M-CHAT)</td>
                                        <td><span class="badge bg-danger">15/23 TIDAK</span></td>
                                        <td>Risiko tinggi gangguan komunikasi</td>
                                    </tr>
                                    <tr>
                                        <td>Deteksi GPPH</td>
                                        <td><span class="badge bg-danger">Nilai 19</span></td>
                                        <td>Kesulitan pemusatan perhatian & hiperaktif</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Page break before next section -->
                <div class="page-break"></div>

                <!-- Behavioral Observation -->
                <div class="section-title"><i class="fas fa-notes-medical"></i> HASIL OBSERVASI PERILAKU</div>

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-list-ul me-2"></i> Detail Observasi
                    </div>
                    <div class="card-body">
                        <div class="observation-item">
                            <div class="observation-icon">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div>
                                <strong>Kontak Mata:</strong> Anak belum mampu melakukan kontak mata saat terapis
                                berkomunikasi.
                            </div>
                        </div>

                        <div class="observation-item">
                            <div class="observation-icon">
                                <i class="fas fa-brain"></i>
                            </div>
                            <div>
                                <strong>Fokus:</strong> Anak bisa fokus pada satu aktivitas namun mudah terdistraksi.
                            </div>
                        </div>

                        <div class="observation-item">
                            <div class="observation-icon">
                                <i class="fas fa-chair"></i>
                            </div>
                            <div>
                                <strong>Duduk Tenang:</strong> Mau duduk saat aktivitas namun kemudian berjalan di
                                ruangan.
                            </div>
                        </div>

                        <!-- Add all other observation items in the same format -->

                        <div class="observation-item">
                            <div class="observation-icon">
                                <i class="fas fa-running"></i>
                            </div>
                            <div>
                                <strong>Aktivitas Motorik:</strong> Cukup aktif berjalan memutari ruangan.
                            </div>
                        </div>

                        <div class="observation-item">
                            <div class="observation-icon">
                                <i class="fas fa-hands"></i>
                            </div>
                            <div>
                                <strong>Motorik Halus:</strong> Mau memegang benda bertekstur seperti playdough.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page break before next section -->
                <div class="page-break"></div>

                <!-- Sensory Observation -->
                <div class="section-title"><i class="fas fa-heartbeat"></i> HASIL OBSERVASI SENSORIK</div>

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-procedures me-2"></i> Profil Sensory
                    </div>
                    <div class="card-body">
                        <p>Pada awal datang, Zahira tampak berjalan kesana kemari bermain dengan permainan yang ada
                            disekitarnya. Ketika dipanggil tidak menoleh atau merespon. Kontak mata kurang dan cenderung
                            mengulangi kata terapis (ekolalia).</p>

                        <h5 class="mt-4"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Gangguan Sensory
                            yang Teridentifikasi:</h5>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="alert alert-light">
                                    <h6><i class="fas fa-eye text-primary me-2"></i> Sensor Visual</h6>
                                    <ul class="mb-0">
                                        <li>Menghindari kontak mata</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="alert alert-light">
                                    <h6><i class="fas fa-assistive-listening-systems text-primary me-2"></i> Sensory
                                        Auditory</h6>
                                    <ul class="mb-0">
                                        <li>Tidak fokus pada satu suara</li>
                                        <li>Tidak merespon panggilan</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="alert alert-light">
                                    <h6><i class="fas fa-walking text-primary me-2"></i> Proprioseptif</h6>
                                    <ul class="mb-0">
                                        <li>Terus bergerak mencari input sensory</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page break before next section -->
                <div class="page-break"></div>

                <!-- Therapy Plan -->
                <div class="section-title"><i class="fas fa-hand-holding-medical"></i> RENCANA TERAPI SENSORY INTEGRASI
                </div>

                <div class="therapy-plan">
                    <h5><i class="fas fa-dumbbell text-success me-2"></i> 1. Latihan Sensory Proprioseptif</h5>
                    <p class="text-muted"><small>Tujuan: Menstimulasi kesadaran tubuh & mengurangi hiperaktif</small>
                    </p>
                    <ul>
                        <li>Menarik bola besar atau mainan berat</li>
                        <li>Berguling di atas matras</li>
                        <li>Melompat di trampolin dengan hitungan lambat</li>
                        <li>Naik turun bangku kecil sambil membawa benda</li>
                    </ul>
                </div>

                <div class="therapy-plan">
                    <h5><i class="fas fa-eye text-success me-2"></i> 2. Latihan Sensory Visual</h5>
                    <p class="text-muted"><small>Tujuan: Meningkatkan kontak mata dan fokus</small></p>
                    <ul>
                        <li>Latihan lempar tangkap bola</li>
                        <li>Menyusun puzzle</li>
                    </ul>
                </div>

                <div class="therapy-plan">
                    <h5><i class="fas fa-comment-medical text-success me-2"></i> 3. Latihan Oral Motor</h5>
                    <p class="text-muted"><small>Tujuan: Melatih otot mulut dan koordinasi bicara</small></p>
                    <ul>
                        <li>Massage Deep Pressure area wajah</li>
                        <li>Sikat oral motor</li>
                        <li>Meniup gelembung sabun/peluit</li>
                    </ul>
                </div>

                <div class="therapy-plan">
                    <h5><i class="fas fa-assistive-listening-systems text-success me-2"></i> 4. Stimulasi Auditori</h5>
                    <p class="text-muted"><small>Tujuan: Meningkatkan fokus pada suara</small></p>
                    <ul>
                        <li>Main tebak suara binatang/alat musik</li>
                        <li>Menyanyi lagu sederhana dengan bagian kosong</li>
                        <li>Menggunakan mainan bersuara (drum, marakas)</li>
                    </ul>
                </div>

                <!-- Signature -->
                <div class="signature-section">
                    <div class="signature">
                        <p>Inolobu, 22 April 2025</p>
                        <img src="{{ asset('images/signature.png') }}" alt="Tanda Tangan"
                            style="height: 60px; margin-top: 15px;">
                        <p class="mt-2"><strong>Inne Pusvitasari, S.Psi</strong><br>
                            Terapis Bright Star of Child</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Print Button -->
    <button class="print-button no-print" onclick="window.print()">
        <i class="fas fa-print"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
