<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Observasi Zahira</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            height: 80px;
            margin-bottom: 10px;
        }

        .header h1 {
            color: #2c3e50;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .header h2 {
            color: #3498db;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .header h3 {
            font-size: 14px;
            margin-top: 15px;
        }

        .contact-info {
            font-size: 11px;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .contact-info p {
            margin-bottom: 3px;
        }

        .section-title {
            background-color: #f8f9fa;
            padding: 6px 12px;
            margin: 20px 0 12px 0;
            border-left: 4px solid #3498db;
            font-weight: bold;
            font-size: 13px;
        }

        .observation-table {
            width: 100%;
            margin-bottom: 15px;
            font-size: 11px;
        }

        .observation-table th {
            background-color: #f8f9fa;
            text-align: left;
            padding: 8px;
            border: 1px solid #dee2e6;
            font-size: 11px;
        }

        .observation-table td {
            padding: 8px;
            border: 1px solid #dee2e6;
            font-size: 11px;
        }

        .therapy-plan {
            margin-bottom: 12px;
        }

        .therapy-plan h5 {
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 12px;
        }

        .therapy-plan ul {
            padding-left: 18px;
            font-size: 11px;
        }

        .therapy-plan p {
            font-size: 11px;
            margin-bottom: 5px;
        }

        ol,
        ul {
            font-size: 11px;
            padding-left: 20px;
        }

        li {
            margin-bottom: 5px;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
            font-size: 11px;
        }

        @media print {
            body {
                padding: 15px;
                font-size: 11px;
            }

            .no-print {
                display: none;
            }

            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Section with Logo -->
        <div class="header">
            <!-- Replace with your actual logo path -->
            <img src="{{ asset('images/logo_bright_star.jpg') }}" alt="Bright Star Logo" class="logo">
            <h1>BRIGHT STAR OF CHILD</h1>
            <h2>Pusat Layanan Terapi Anak Istimewa</h2>
            <div class="contact-info">
                <p>Jl. Mokodompit, Kel.Inolobu, Kec.Wawotobi, Kab.Konave, Prov.Sulawesi Tenggara 93462</p>
                <p>Contact: 082191084139 | Email: brightstarofchild12@gmail.com</p>
            </div>
            <h3>LAPORAN HASIL OBSERVASI ZAHIRA</h3>
        </div>

        <!-- Early Detection Results -->
        <div class="section-title">HASIL DETEKSI DINI</div>
        <table class="observation-table table-bordered">
            <thead>
                <tr>
                    <th>Alat Observasi</th>
                    <th>Hasil Observasi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Deteksi dini penyimpangan perilaku dan emosional algoritma pemeriksaan KMPE</td>
                    <td>Dari 14 indikator dimana terdapat 7 jawaban "YA", dimana ketentuannya jika terdapat 2 atau lebih
                        jawaban "YA" pada indikator penentuan, maka terdapat kemungkinan anak mengalami permasalahan
                        mental emosional yang berikutnya dapat di rujuk untuk konsultasi lebih lanjut ke dokter atau
                        psikolog dan terapi perilaku.</td>
                </tr>
                <tr>
                    <td>Deteksi dini Autis pada anak algoritma pemeriksaan M-CHAT</td>
                    <td>Dari 23 indikator dimana terdapat 15 jawaban "TIDAK", dimana ketentuannya jika terdapat 2 atau
                        lebih jawaban "TIDAK" pada indikator penentuan, maka beresiko tinggi anak mengalami hambatan
                        dalam komunikasi dan keterlambatan dalam berbicara yang berikutnya dapat di rujuk untuk
                        mendapatkan penanganan dokter atau psikolog dan terapi perilaku.</td>
                </tr>
                <tr>
                    <td>Deteksi dini gangguan pemusatan perhatian dan hiperaktif (GPPH) pada anak prasekolah algoritma
                        pemeriksaan GPPH</td>
                    <td>Total nilai yang diperoleh dari 10 indikator pengukuran yakni berjumlah 19. Dimana ketentuannya
                        jika total nilai 13 atau lebih maka kemungkinan anak mengalami kesulitan dalam pemusatan
                        perhatian dan hiperaktifitas.</td>
                </tr>
            </tbody>
        </table>

        <!-- Behavioral Observation -->
        <div class="section-title">HASIL OBSERVASI PERILAKU</div>
        <ol>
            <li><strong>Kontak mata:</strong> Anak belum mampu melakukan kontak mata saat terapis berkomunikasi dengan
                anak. <strong>Fokus:</strong> Anak bisa fokus pada satu aktivitas atau mainan namun mudah terdistrak
                dengan mainan atau hal lain di sekitarnya.</li>
            <li><strong>Duduk tenang:</strong> anak mau duduk saat melakukan aktivitas namun setelah itu anak kembali
                berjalan di dalam ruangan.</li>
            <li>Anak cukup aktif saat di dalam ruangan seperti berjalan jalan memutari ruangan.</li>
            <li><strong>Motorik halus:</strong> Anak mau memegang benda bertekstur seperti playddough, biji-bijian
                (jangung, kacang hijau dan beras).</li>
            <li><strong>Motorik kasar:</strong> Anak mau melompat di trampolin, berjalan di karpet sensory.</li>
            <li><strong>Verbal:</strong> anak dapat menyebutkan nama warna, mengucapkan "tidak", melafalkan salah satu
                ayat dari surah Ar Rahman " Fabi ayyi aalaaa i rabbikumaa tukazzibaan" berhitung 1 sampai 20,
                menyebutkan nama hewan dan buah.</li>
            <li><strong>Posisi duduk W sitting.</strong></li>
            <li>Anak dapat mengidentifikasi warna, hewan, buah dan angka.</li>
            <li>Anak cukup sering melakukan ekolalia.</li>
            <li>Anak mampu menyusun donat sesuai urutan.</li>
            <li>Anak mau mengikuti beberapa instruksi terapis.</li>
        </ol>

        <!-- Sensory Observation -->
        <div class="section-title">HASIL OBSERVASI SENSORIK</div>
        <h5>OBSERVASI PROFIL SENSORY</h5>
        <p>Pada awal datang An. Zahira tampak berjalan kesana kemari bermain dengan permainan yang ada disekitarnya.
            Tampak anak ketika dipanggil tidak menoleh atau merespon. Ketika diajak berbicara anak tampak tidak menatap
            mata terapis (kontak mata kurang) dan Pada saat diajak berbicara cendurung anak mengulangi kata terapis.
            Anak hanya fokus pada permainan yang ada didepannya. Anak dapat memisahkan pola dan warna yang sesuai dan
            membuat hewan menggunakan playdogh dengan menempelkan mata, mulu, dan telinga menggunakan biji-bijian. Anak
            tidak sabaran ketika meminta permainan.</p>

        <h5>Gangguan sensory yang bermasalah:</h5>
        <ul>
            <li><strong>Sensor Visual</strong>
                <ul>
                    <li>Menghindari kontak mata</li>
                </ul>
            </li>
            <li><strong>Sensory Auditory</strong>
                <ul>
                    <li>Tidak fokus pada satu suara</li>
                    <li>Tidak ada respon jika dipanggil</li>
                </ul>
            </li>
            <li><strong>Sensory Proprioseptif</strong>
                <ul>
                    <li>Terus bergerak mencari input sensory nya</li>
                </ul>
            </li>
        </ul>

        <!-- Therapy Plan -->
        <div class="section-title">RENCANA TERAPI SENSORY INTEGRASI</div>

        <div class="therapy-plan">
            <h5>1. Latihan Sensory Proprioseptif</h5>
            <p><strong>Tujuan:</strong> Menstimulasi kesadaran tubuh & kesiapan motorik untuk aktivitas agar hiperaktif
                anak berkurang</p>
            <ul>
                <li>Menarik bola besar atau mainan berat dari ujung ke ujung ruangan.</li>
                <li>Berguling di atas matras.</li>
                <li>Melompat diatas trampolin dengan hitungan yang lambat.</li>
                <li>Naik turun bangku kecil dengan membawa benda dari ujung ke ujung.</li>
            </ul>
        </div>

        <div class="therapy-plan">
            <h5>2. Latihan Sensory Visual</h5>
            <p><strong>Tujuan:</strong> Menstimulasi respon kontak mata agar bisa fokus</p>
            <ul>
                <li>Latihan lempar tangkap bola.</li>
                <li>Menyusun puzzle.</li>
            </ul>
        </div>

        <div class="therapy-plan">
            <h5>3. Latihan Oral Motor</h5>
            <p><strong>Tujuan:</strong> Melatih otot mulut, lidah, bihir, dan koordinasi oral untuk bicara.</p>
            <ul>
                <li>Massage Deep Pressure area wajah, pipi dan mulut.</li>
                <li>Sikat oral motor : gosok lidah, langit-langit, dan otot-otot dalam pipi.</li>
                <li>Meniup gelembung sabun, peluit, atau sedotan panjang.</li>
            </ul>
        </div>

        <div class="therapy-plan">
            <h5>4. Stimulasi Auditori</h5>
            <p><strong>Tujuan:</strong> Membantu anak peka dan fokus pada suara serta membedakan suara sekitar.</p>
            <ul>
                <li>Main tebak suara: suara binatang, bel, atau alat musik dari speaker.</li>
                <li>Menyanyi lagu sederhana dan ajak anak mengisi bagian kosong (misal: "Balonku ada ___").</li>
                <li>Gunakan mainan bersuara (drum kecil, marakas) sambil ajak anak menirukan suara.</li>
            </ul>
        </div>

        <!-- Signature -->
        <div class="signature">
            <p>Inolobu, 22 April 2025</p>
            <br><br>
            <p>Inne Pusvitasari, S.Psi</p>
        </div>

        <!-- Print Button (hidden when printing) -->
        <div class="no-print text-center mt-4">
            <button onclick="window.print()" class="btn btn-primary btn-sm">Cetak Laporan</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
