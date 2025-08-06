@extends('mobile.master')
@section('mobilePayment', 'active')
@section('style')
    <style>
        .payment-container {
            width: 100%;
            max-width: 600px;
            display: flex;
            justify-content: center;
        }

        .payment-card {
            width: 100%;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #d84315;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .desc {
            font-size: 1rem;
            color: #333;
            margin-bottom: 15px;
        }

        .card-container {
            background: #ffffff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card-label {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .card-label:last-child {
            border-bottom: none;
        }

        .icon {
            font-size: 1.8rem;
            color: #ff9800;
        }

        .card-text label {
            font-size: 0.9rem;
            color: #666;
            font-weight: bold;
            text-align: center;
        }


        .card-text .small-text {
            font-size: 0.8rem;
            /* Ukuran lebih kecil */
            font-weight: normal;
            color: #333;
            margin-top: 3px;
            text-align: center;
        }

        .warning-card {
            background-color: #ffebee;
            padding: 15px;
            border-left: 5px solid #d32f2f;
            border-radius: 8px;
            text-align: left;
            margin-top: 20px;
        }

        .warning-card h3 {
            color: #d32f2f;
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .warning-card ul {
            padding-left: 20px;
        }

        .warning-card li {
            font-size: 0.95rem;
            margin-bottom: 5px;
        }

        .contact-info {
            font-size: 1rem;
            margin-top: 15px;
            color: #333;
        }
    </style>
@endsection
@section('content')
    <header class="header header-fixed">
        <div class="header-content">
            <div class="left-content">
                <a href="javascript:void(0);" class="menu-toggler bg-white pe-2 rounded-xl">
                    <div class="media">
                        <div class="media-35 m-r10">

                            <img class="rounded-xl"
                                src=" {{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/foto-anak/avatar.png') }}"
                                alt="">
                        </div>
                        <h6 class="mb-0 font-13">Hello’ {{ $anak->nama }}</h6>
                    </div>
                </a>
            </div>
            <div class="mid-content"></div>
        </div>
    </header>

    <main class="page-content space-top p-b80">
        <div class="container p-0">
            <div class="dz-card list list-style-3">
                <div class="payment-card">
                    <h2>📢 PEMBERITAHUAN PEMBAYARAN</h2>
                    <p class="desc">Silakan lakukan pembayaran <strong>hanya</strong> ke rekening berikut:</p>

                    <div class="card-container">
                        <div class="card-label">
                            <span class="icon">🏦</span>
                            <div class="card-text">
                                <label>Bank</label>
                                <p class="small-text">BRI</p>
                            </div>
                        </div>
                        <div class="card-label">
                            <span class="icon">💳</span>
                            <div class="card-text">
                                <label>Nomor Rekening</label>
                                <p class="small-text">493001052151535</p>
                            </div>
                        </div>
                        <div class="card-label">
                            <span class="icon">📝</span>
                            <div class="card-text">
                                <label>Atas Nama</label>
                                <p class="small-text">INNE PUSVITASARI</p>
                            </div>
                        </div>
                    </div>

                    <div class="warning-card">
                        <h3>⚠️ Penting!</h3>
                        <ul>
                            <li>Kami <strong>tidak bertanggung jawab</strong> atas pembayaran ke rekening selain
                                yang tercantum di atas.</li>
                            <li>Mohon <strong>pastikan nama penerima sesuai</strong> sebelum melakukan transfer.
                            </li>
                            <li>Simpan bukti pembayaran dan konfirmasikan kepada kami setelah transaksi selesai.
                            </li>
                        </ul>
                    </div>

                    <p class="contact-info">📞 Jika ada pertanyaan, hubungi admin <strong><a
                                href="https://wa.me/+6285123238404" target="_blank">085123238404</a></strong>.</p>
                </div>
            </div>
            <div class="dz-product-detail">
                <div class="detail-content">
                    <h4 class="title">Riwayat</h4>
                </div>
                @forelse ($pembayaran as $p)
                    <div class="dz-offer-coupon">
                        <div class="offer">
                            <a href="{{ route('invoice.download', $p->id) }}"><i
                                    class="fi fi-rr-receipt icon-large"></i></a>
                            <a href="{{ route('invoice.download', $p->id) }}" class="text-small">
                                Download Invoice
                            </a>
                        </div>
                        <div class="offer-content">
                            @if (!empty($p->tarif->nama))
                                <h6>{{ $p->tarif->nama }}</h6>
                            @else
                                <h6>Terapi Perilaku</h6>
                            @endif

                            <div class="offer-details">
                                <p><span>Jumlah</span>: <span>
                                        {{ $p->jumlah }}</span></p>
                                <p><span>Tanggal</span> : <span> {{ $p->tanggal }}</span></p>
                                <p><span>Status</span> : <span class="badge badge-sm badge-success"> Diterima</span></p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">data belum ada</p>
                @endforelse
            </div>
        </div>
    </main>


@endsection
