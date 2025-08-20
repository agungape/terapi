@extends('mobile.master')
@section('mobileTerapi', 'active')
@section('content')
    <div class="page-wrapper">
        <!-- Header -->
        <header class="header header-fixed shadow bg-white">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="icon feather icon-chevron-left"></i>
                    </a>
                </div>
                <div class="mid-content">
                    <h5 class="title">E-Book Terapi</h5>
                </div>
                <div class="right-content">
                    <a href="{{ route('app') }}" class=""><i class="feather icon-home font-20"></i></a>
                </div>
            </div>
        </header>
        <!-- Header -->

        <main class="page-content space-top p-b80">
            <div class="container p-0">
                <div class="dz-card list list-style-3">
                    <div class="dz-media">
                        <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/foto-anak/small.png') }}"
                            alt="">
                    </div>
                    <div class="dz-content">
                        <h6 class="title"><a href="product-detail.html">{{ $anak->nama }}</a></h6>
                        <ul class="dz-meta gap-4">
                            <li class="dz-qty font-12"><small>Season:</small><span
                                    class="dz-status text-primary d-inline-block">{{ $kunjungan->sesi }}</span></li>
                        </ul>
                        <ul class="dz-meta gap-4">
                            <li class="dz-qty font-12"><small>Pertemuan:</small><span
                                    class="dz-status text-primary d-inline-block">{{ $kunjungan->pertemuan }}</span></li>
                        </ul>
                        <ul class="dz-meta gap-4">
                            <li class="dz-qty font-12"><small>Status:</small><span
                                    class="dz-status text-success d-inline-block">{{ $kunjungan->status }}</span></li>
                        </ul>
                        <ul class="dz-meta gap-4">
                            <li class="dz-qty font-12"><small>Terapis:</small><span
                                    class="dz-status text-primary d-inline-block">{{ $kunjungan->terapis->nama }}
                                    @if ($kunjungan->terapis_id_pendamping)
                                        - {{ $kunjungan->terapisPendamping->nama }}
                                    @endif
                                </span>
                            </li>
                        </ul>
                        <ul class="dz-meta gap-4">
                            <li class="dz-qty font-12"><small>Waktu:</small><span
                                    class="dz-status text-primary d-inline-block">{{ $kunjungan->created_at }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @if ($kunjungan->jenis_terapi == 'terapi_perilaku')
                    <div class="dz-product-detail">
                        <div class="detail-content">
                            <h4 class="title">Program Terapi</h4>
                        </div>
                        @forelse ($pemeriksaan as $p)
                            <div class="dz-offer-coupon">
                                <div class="offer">
                                    <h6>{{ $loop->iteration }}</h6>
                                </div>
                                <div class="offer-content">
                                    <h6>{{ $p->program->deskripsi }}</h6>
                                    <p>Skala : @if ($p->status == 'dp')
                                            Dibantu Penuh (DP)
                                        @elseif ($p->status == 'ds')
                                            Dibantu Sebagian (DS)
                                        @elseif ($p->status == 'tb')
                                            Tidak Dibantu (TD)
                                        @else
                                            Status Tidak Diketahui
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if ($loop->last)
                                <div class="item-wrapper">
                                    <div class="description">
                                        <h6 class="title font-w600">Keterangan:</h6>
                                        <div class="dz-offer-coupon">
                                            <div class="offer-content">
                                                <div>
                                                    @foreach (explode("\n", $p->keterangan) as $paragraph)
                                                        <p style="margin-bottom: 1px;">
                                                            {{ $paragraph }}
                                                        </p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <p class="text-center">data program terapi tidak ada</p>
                        @endforelse
                    </div>
                @else
                    <div class="dz-product-detail">
                        <div class="detail-content">
                            <h4 class="title">Program Fisioterapi & Sensori Integrasi</h4>
                        </div>
                        @forelse ($fisioterapi as $f)
                            <div class="accordion dz-accordion style-2" id="accordionFaq1">
                                <div class="accordion-item wow fadeInUp" data-wow-delay="0.8s">
                                    <h2 class="accordion-header" id="heading{{ $f->id }}">
                                        <a href="javascript:void(0);" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $f->id }}" aria-expanded="false"
                                            aria-controls="collapse{{ $f->id }}">
                                            {{ $f->program->deskripsi }}
                                        </a>
                                    </h2>
                                    <div id="collapse{{ $f->id }}" class="accordion-collapse collapse show"
                                        aria-labelledby="heading{{ $f->id }}" data-bs-parent="#accordionFaq1"
                                        style="">
                                        <div class="accordion-body">
                                            @foreach (explode("\n", $f->aktivitas_terapi) as $paragraph)
                                                <p class="m-b0" style="text-align: justify">
                                                    {{ $paragraph }}
                                                </p>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="item-wrapper">
                                @if ($loop->last)
                                    @if ($f->evaluasi)
                                        <div class="description">
                                            <h6 class="title font-w600">Respons Anak:</h6>
                                            <div class="dz-offer-coupon">
                                                <div class="offer-content">
                                                    <div>
                                                        @foreach (explode("\n", $f->evaluasi) as $paragraph)
                                                            <p style="margin-bottom: 1px; text-align:justify">
                                                                {{ $paragraph }}
                                                            </p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                    @if ($f->catatan_khusus)
                                        <div class="description">
                                            <h6 class="title font-w600">Catatan Khusus:</h6>
                                            <div class="dz-offer-coupon">
                                                <div class="offer-content">
                                                    <div>
                                                        @foreach (explode("\n", $f->catatan_khusus) as $paragraph)
                                                            <p style="margin-bottom: 1px;">
                                                                {{ $paragraph }}
                                                            </p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>

                        @empty
                            <p class="text-center">data program fisioterapi tidak ada</p>
                        @endforelse
                    </div>
                @endif
            </div>
        </main>
    </div>

@endsection
