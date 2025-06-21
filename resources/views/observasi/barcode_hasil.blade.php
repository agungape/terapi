<!DOCTYPE html>
<html>

<head>
    <title>Hasil Scan Barcode</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .child-info {
            margin-top: 30px;
        }

        .signature {
            margin-top: 20px;
        }

        .signature-img {
            max-width: 200px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Hasil Scan Barcode Observasi</h2>
        </div>

        <div class="child-info">
            <h3>Data Anak:</h3>
            <p><strong>Nama:</strong> {{ $data['nama'] }}</p>
            <p><strong>Tanggal Observasi:</strong> {{ $data['tanggal_observasi'] }}</p>
        </div>

        <div class="signature">
            <h3>Tanda Tangan:</h3>
            {{-- <img src="{{ asset($data['signature']) }}" alt="Tanda Tangan" class="signature-img"> --}}
        </div>
    </div>
</body>

</html>
