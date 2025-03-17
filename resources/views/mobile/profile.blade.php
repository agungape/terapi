@extends('mobile.master')
@section('mobileProfile', 'active')
@section('style')
    <style>
        .container {
            width: 100%;
            max-width: 350px;
            text-align: center;
        }

        h2 {
            color: #d84315;
            font-size: 1.3rem;
            margin-bottom: 12px;
        }

        .card-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
            padding: 8px 12px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 8px;
            transition: transform 0.2s ease;
            font-size: 0.85rem;
        }

        .card-label:hover {
            transform: translateY(-2px);
        }

        .icon {
            font-size: 1.2rem;
            color: #ff9800;
        }

        .card-text {
            text-align: right;
            flex-grow: 1;
            margin-left: 10px;
        }

        .card-text label {
            font-size: 0.8rem;
            color: #666;
            font-weight: bold;
            display: block;
        }

        .card-text .number {
            font-size: 1rem;
            font-weight: bold;
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
                                src=" {{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/avatar/1.png') }}"
                                alt="">
                        </div>
                        <h6 class="mb-0 font-13">Hello’ {{ $anak->nama }}</h6>
                    </div>
                </a>
            </div>
            <div class="mid-content"></div>
        </div>
    </header>
    <main class="page-content space-top p-b50 ">
        <div class="container">
            <h2>📊 Data Kehadiran Anak</h2>

            <div class="card-label">
                <span class="icon">✅</span>
                <div class="card-text">
                    <label>Total Kehadiran</label>
                    <p class="number">12</p>
                </div>
            </div>

            <div class="card-label">
                <span class="icon">📄</span>
                <div class="card-text">
                    <label>Total Izin</label>
                    <p class="number">3</p>
                </div>
            </div>

            <div class="card-label">
                <span class="icon">❌</span>
                <div class="card-text">
                    <label>Total Absen</label>
                    <p class="number">2</p>
                </div>
            </div>

            <div class="card-label">
                <span class="icon">🎓</span>
                <div class="card-text">
                    <label>Sisa Pertemuan Kelas</label>
                    <p class="number">5</p>
                </div>
            </div>
        </div>
    </main>
@endsection
