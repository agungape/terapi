@extends('mobile.master')
@section('mobileTerapi', 'active')
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
    <main class="page-content p-t50 p-b50">
        <div class="container">
            <div class="default-tab style-2 mt-1">
                <div class="tab-content">
                    <a href="javascript:void(0);" class="dz-media d-inline-block p-b15 p-t10">
                        <video style="border-radius: 12px;" width="100%" autoplay muted loop playsinline>
                            <source src="{{ asset('assets/mobile/pixio/videos/banner/video3.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </a>
                    <div class="dz-list m-b20">
                        <ul class="dz-list-group radio style-2">
                            <li class="list-group-items">
                                <label class="radio-label">
                                    <span class="checkmark">
                                        <div class="dz-icon style-2 icon-fill"><i class="fi fi-rr-document font-20"></i>
                                        </div>
                                        <div class="list-content">
                                            <h5 class="title">Riwayat Terapi Perilaku</h5>
                                        </div>
                                    </span>
                                </label>
                            </li>
                            <br>
                            @foreach ($groupedBySesi as $sesi => $pertemuan)
                                <div class="accordion dz-accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <div class="accordion-header acco-select" id="heading{{ $sesi }}">
                                            <button
                                                class="accordion-button {{ $sesiTerakhir === $sesi ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $sesi }}"
                                                aria-expanded="{{ $sesiTerakhir === $sesi ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $sesi }}">
                                                <div class="dz-icon">
                                                    <i class="fi fi-rr-document"></i>
                                                </div>
                                                <h6 class="acco-title">Season {{ $sesi }}</h6>
                                                <div class="checkmark"></div>
                                            </button>
                                        </div>
                                        <div id="collapse{{ $sesi }}"
                                            class="accordion-collapse collapse {{ $sesiTerakhir === $sesi ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $sesi }}"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                @foreach ($pertemuan as $kunjungan)
                                                    <div class="dz-card list list-style-3">
                                                        <div class="dz-content d-flex flex-column">
                                                            <h6 class="title">
                                                                <a
                                                                    href="{{ route('kunjunganmobile.detail', ['id' => $kunjungan->id]) }}">
                                                                    {{ $kunjungan->created_at }}
                                                                </a>
                                                            </h6>
                                                            @if ($kunjungan->status == 'hadir')
                                                                <ul class="dz-meta">
                                                                    <li class="dz-price">Pertemuan
                                                                        {{ $kunjungan->pertemuan }}</li>
                                                                    <li class="dz-review">
                                                                        <i class="feather icon-star-on"></i>
                                                                        <span>({{ $kunjungan->status == 'izin_hangus' ? 'izin hangus' : $kunjungan->status }})</span>
                                                                    </li>
                                                                </ul>
                                                                <div class="dz-quantity">Terapis :
                                                                    {{ $kunjungan->terapis->nama ?? '-' }} @if ($kunjungan->terapis_id_pendamping)
                                                                        - {{ $kunjungan->terapisPendamping->nama }}
                                                                    @endif
                                                                </div>
                                                                <div class="dz-quantity">
                                                                    <a href="{{ route('kunjunganmobile.detail', ['id' => $kunjungan->id]) }}"
                                                                        class="btn btn-primary btn-xs font-13 mt-3">
                                                                        Lihat
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <ul class="dz-meta">
                                                                    <li class="dz-review">
                                                                        <span>({{ $kunjungan->status == 'izin_hangus' ? 'izin hangus' : $kunjungan->status }})</span>
                                                                    </li>
                                                                </ul>
                                                            @endif
                                                        </div> 
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            <li class="list-group-items">
                                <label class="radio-label">
                                    <span class="checkmark">
                                        <div class="dz-icon style-2 icon-fill"><i class="fi fi-rr-document font-20"></i></i>
                                        </div>
                                        <div class="list-content">
                                            <h5 class="title">Riwayat Fisioterapi & Sensori Integrasi</h5>
                                        </div>

                                    </span>
                                </label>
                            </li>
                            <br>
                            @foreach ($groupedBySesi_fisio as $sesi_fisio => $pertemuan_fisio)
                                <div class="accordion dz-accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <div class="accordion-header acco-select" id="heading{{ $sesi_fisio }}">
                                            <button
                                                class="accordion-button {{ $sesiTerakhir_fisio === $sesi_fisio ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $sesi_fisio }}"
                                                aria-expanded="{{ $sesiTerakhir_fisio === $sesi_fisio ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $sesi_fisio }}">
                                                <div class="dz-icon">
                                                    <i class="fi fi-rr-document"></i>
                                                </div>
                                                <h6 class="acco-title">Season {{ $sesi_fisio }}</h6>
                                                <div class="checkmark"></div>
                                            </button>
                                        </div>
                                        <div id="collapse{{ $sesi_fisio }}"
                                            class="accordion-collapse collapse {{ $sesiTerakhir_fisio === $sesi_fisio ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $sesi_fisio }}"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                @foreach ($pertemuan_fisio as $kunjungan_fisioterapi)
                                                    <div class="dz-card list list-style-3">
                                                        <div class="dz-content d-flex flex-column">
                                                            <h6 class="title">
                                                                <a
                                                                    href="{{ route('kunjunganmobile.detail', ['id' => $kunjungan_fisioterapi->id]) }}">
                                                                    {{ $kunjungan_fisioterapi->created_at }}
                                                                </a>
                                                            </h6>
                                                            @if ($kunjungan_fisioterapi->status == 'hadir')
                                                                <ul class="dz-meta">
                                                                    <li class="dz-price">Pertemuan
                                                                        {{ $kunjungan_fisioterapi->pertemuan }}</li>
                                                                    <li class="dz-review">
                                                                        <i class="feather icon-star-on"></i>
                                                                        <span>({{ $kunjungan_fisioterapi->status == 'izin_hangus' ? 'izin hangus' : $kunjungan_fisioterapi->status }})</span>
                                                                    </li>
                                                                </ul>
                                                                <div class="dz-quantity">Terapis :
                                                                    {{ $kunjungan_fisioterapi->terapis->nama ?? '-' }}
                                                                </div>
                                                                <div class="dz-quantity">
                                                                    <a href="{{ route('kunjunganmobile.detail', ['id' => $kunjungan_fisioterapi->id]) }}"
                                                                        class="btn btn-primary btn-xs font-13 mt-3">
                                                                        Lihat
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <ul class="dz-meta">
                                                                    <li class="dz-review">
                                                                        <span>({{ $kunjungan_fisioterapi->status == 'izin_hangus' ? 'izin hangus' : $kunjungan_fisioterapi->status }})</span>
                                                                    </li>
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
