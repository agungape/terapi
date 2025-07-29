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
    <main class="page-content p-t50 p-b50">
        <div class="container">
            <div class="default-tab style-2 mt-1">
                <div class="tab-content">

                    @foreach ($groupedBySesi as $sesi => $pertemuan)
                        <div class="accordion dz-accordion" id="accordionExample">
                            <div class="accordion-item">
                                <div class="accordion-header acco-select" id="heading{{ $sesi }}">
                                    <button class="accordion-button {{ $sesiTerakhir === $sesi ? '' : 'collapsed' }}"
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
                                    aria-labelledby="heading{{ $sesi }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @foreach ($pertemuan as $kunjungan)
                                            <div class="dz-card list list-style-3">
                                                <div class="dz-media media-75">
                                                    <img
                                                        src="{{ $kunjungan->anak->foto ? asset('storage/anak/' . $kunjungan->anak->foto) : asset('assets/mobile/pixio/images/banner/pic1.png') }}">
                                                </div>
                                                <div class="dz-content d-flex flex-column">
                                                    <h6 class="title">
                                                        <a
                                                            href="{{ route('kunjunganmobile.detail', ['id' => $kunjungan->id]) }}">
                                                            {{ $kunjungan->created_at }}
                                                        </a>
                                                    </h6>
                                                    @if ($kunjungan->status == 'hadir')
                                                        <ul class="dz-meta">
                                                            <li class="dz-price">Pertemuan {{ $kunjungan->pertemuan }}</li>
                                                            <li class="dz-review">
                                                                <i class="feather icon-star-on"></i>
                                                                <span>({{ $kunjungan->status == 'sakit' ? 'absen' : $kunjungan->status }})</span>
                                                            </li>
                                                        </ul>
                                                        <div class="dz-quantity">Terapis :
                                                            {{ $kunjungan->terapis->nama ?? '-' }}
                                                        </div>
                                                        <div class="dz-quantity">
                                                            <a href="{{ route('kunjunganmobile.detail', ['id' => $kunjungan->id]) }}"
                                                                class="btn btn-primary rounded-xl btn-xs font-13 mt-3">
                                                                <i class="fi fi-rr-eye"></i>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <ul class="dz-meta">
                                                            <li class="dz-review">
                                                                <span>({{ $kunjungan->status == 'sakit' ? 'absen' : $kunjungan->status }})</span>
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
                </div>
            </div>
    </main>
@endsection
