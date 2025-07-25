<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Scan Barcode Assessment</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #6b7280;
            --accent-color: #10b981;
            --light-color: #f9fafb;
            --dark-color: #111827;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', Arial, sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
            background-color: #f5f7fa;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .header h1 {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .header .subtitle {
            color: var(--secondary-color);
            font-size: 1rem;
        }

        .kop {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary-color);
        }

        .kop-logo {
            width: 80px;
            height: auto;
        }

        .kop-text {
            text-align: center;
            flex-grow: 1;
        }

        .kop-text h2,
        h4 {
            color: var(--primary-color);
            font-size: 1.4rem;
            margin-bottom: 5px;
        }

        .kop-text p {
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        .child-info {
            margin: 30px 0;
            padding: 20px;
            background-color: var(--light-color);
            border-radius: 8px;
        }

        .child-info h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.3rem;
            padding-bottom: 8px;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-item {
            display: flex;
            margin-bottom: 12px;
        }

        .info-label {
            font-weight: 500;
            min-width: 150px;
            color: var(--secondary-color);
        }

        .info-value {
            font-weight: 400;
        }

        .signature {
            margin-top: 30px;
            text-align: center;
        }

        .signature h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .signature-img {
            max-width: 200px;
            height: auto;
            /* border: 1px solid #e5e7eb; */
            border-radius: 4px;
        }

        .signature-info {
            /* margin-top: 10px; */
            font-style: italic;
            color: var(--secondary-color);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
                margin: 10px;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .kop {
                flex-direction: column;
                text-align: center;
            }

            .kop-logo {
                margin-bottom: 15px;
            }

            .kop-text h2 {
                font-size: 1.2rem;
            }

            .info-item {
                flex-direction: column;
            }

            .info-label {
                min-width: 100%;
                margin-bottom: 5px;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 1.3rem;
            }

            .child-info {
                padding: 15px;
            }

            .signature-img {
                max-width: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Kop Surat/Header Institusi -->
        <div class="kop">
            <img src="{{ asset('assets') }}/images/logo_bright_star.jpg" alt="Logo Institusi" class="kop-logo">
            <div class="kop-text">
                <h2>BRIGHT STAR OF CHILD</h2>
                <p> Jln. Mokodompit, Kel.Inolobu, Kec.Wawotobi, Kab.Konawe, Prov.Sulawesi
                    Tenggara 93462</p>
                <p>Telp:085123238404 | Email: brightstarofchild12@gmail.com | Website: www.brightchild.id
                </p>
            </div>
        </div>

        <div class="header">
            <h1>HASIL SCAN ASSESSMENT ANAK</h1>
            <p class="subtitle">Data hasil assessment anak</p>
        </div>

        <div class="child-info">
            <h3>Data Anak</h3>
            <div class="info-item">
                <span class="info-label">Nama Lengkap :</span>
                <span class="info-value">{{ $data['nama'] }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Alamat :</span>
                <span class="info-value">{{ $data['alamat'] }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Tanggal Lahir :</span>
                <span
                    class="info-value">{{ \Carbon\Carbon::parse($data['tanggal_lahir'])->translatedFormat('d F Y') }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Tanggal Pemeriksaan :</span>
                <span
                    class="info-value">{{ \Carbon\Carbon::parse($data['tanggal_assessment'])->translatedFormat('d M Y') }}</span>
            </div>
        </div>

        <div class="signature">
            <h3>Verifikasi Assessment</h3>
            <img src="{{ asset('assets') }}/images/signature-psikolog-ori.png" alt="Tanda Tangan" class="signature-img">
            <p style="font-weight: bold; margin-bottom: 5px; border-bottom: 1px solid #000;">Astri Yunita,
                S.Psi.,M.Psi.,Psikolog
            </p>
            <p style="margin-bottom: 5px;">STR. XP00001068698759</p>
            <p style="margin-bottom: 0;">SIPP. 20130221-2023-03-0807</p>
        </div>
    </div>
</body>

</html>
