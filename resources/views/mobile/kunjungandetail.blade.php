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
                        <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/avatar/small/2.png') }}"
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
                                    class="dz-status text-primary d-inline-block">{{ $kunjungan->terapis->nama }}</span>
                            </li>
                        </ul>
                        <ul class="dz-meta gap-4">
                            <li class="dz-qty font-12"><small>Waktu:</small><span
                                    class="dz-status text-primary d-inline-block">{{ $kunjungan->created_at }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
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
                                            <div style="white-space: pre-line;">
                                                @foreach (explode("\n", $p->keterangan) as $paragraph)
                                                    <p style="margin-bottom: 1px; line-height: 1.5;">{{ $paragraph }}
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
            </div>
        </main>
    </div>

@endsection
