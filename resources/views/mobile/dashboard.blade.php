@extends('mobile.master')
@section('mobileDashboard', 'active')
@section('content')
    <main class="page-content space-top p-b40">
        <div class="container">

            <!-- profile anak -->
            <div class="dz-banner">
                <div class="swiper banner-swiper">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="inner-banner">
                                {{-- <div class="vector-icon">
                                    <svg width="32" height="36" viewBox="0 0 32 36" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16 0L17.638 15.1629L31.5885 9L19.276 18L31.5885 27L17.638 20.8371L16 36L14.362 20.8371L0.411543 27L12.724 18L0.411543 9L14.362 15.1629L16 0Z"
                                            fill="var(--primary)" />
                                    </svg>
                                </div> --}}
                                <div class="left-content">
                                    <h4 class="title font-w500 text-capitalize mb-3" data-swiper-parallax="-100">
                                        {{ $anak->nama }}</h4>
                                    <div class="meta-items">
                                        <div class="dz-prize" data-swiper-parallax="-200">
                                            <span class="d-block mb-1 font-12">Usia</span>
                                            <span class="badge badge-sm badge-success">{{ $anak->usia }}
                                                Tahun</span>
                                        </div>

                                    </div>
                                    <div class="product-size" data-swiper-parallax="-300">
                                        <span class="d-block mb-1 font-12">Alamat</span>
                                        <span class="d-block mb-1 font-12">{{ $anak->alamat }}</span>
                                    </div>

                                </div>
                                <div class="right-content">
                                    <div class="dz-media">
                                        <img src=" {{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/banner/pic1.png') }}"
                                            alt="">
                                    </div>
                                    {{-- <h2 class="dz-text" data-text="BRIGHT">BRIGHT</h2> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- profile anak --}}

            {{-- banner kelas dan riwayat terapi --}}
            <div class="dz-category style-1">
                <div class="title-bar align-items-start">
                    <h5 class="title mb-0">Riwayat Terapi </h5>
                    <a href="products.html">See All</a>
                </div>
                <div class="swiper dz-featured-swiper mb-4">
                    <div class="swiper-wrapper">
                        @forelse ($kunjungan as $k)
                            <div class="swiper-slide">
                                <div class="dz-card list list-style-2">
                                    <div class="dz-media media-75">
                                        @if ($k->status == 'hadir')
                                            <img
                                                src=" {{ $k->terapis->foto ? asset('storage/terapis/' . $k->terapis->foto) : asset('assets/mobile/pixio/images/banner/pic1.png') }}">
                                        @else
                                            <img src="{{ asset('assets') }}/mobile/pixio/images/product/product1/pic1.png"
                                                alt="">
                                        @endif
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a href="#">{{ $k->created_at }}</a>
                                        </h6>
                                        <ul class="dz-meta">
                                            <li class="dz-price">Pertemuan {{ $k->pertemuan }}</li>
                                            <li class="dz-review">
                                                @if ($k->status == 'hadir')
                                                    <i class="feather icon-star-on"></i><span>({{ $k->status }})</span>
                                                @else
                                                    <span>({{ $k->status }})</span>
                                                @endif
                                            </li>
                                        </ul>
                                        @if ($k->status == 'hadir')
                                            <div class="dz-quantity">Terapis : {{ $k->terapis->nama }}
                                            </div>
                                        @else
                                            <div class="dz-quantity">Terapis : -
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>

                <div class="title-bar align-items-start">
                    <h5 class="title mb-0">Featured offer for you</h5>
                    <a href="products.html">See All</a>
                </div>
                <div class="swiper dz-featured-swiper2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="dz-card style-5">
                                <div class="dz-media">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/banner/offer/banner2.png"
                                        alt="">
                                </div>
                                <div class="dz-content">
                                    <h6 class="font-w500 font-14 mb-1">Paket A</h6>
                                    <span class="dz-status">Terapi Perilaku</span>
                                    <a href="javascript:void(0);" class="btn btn-primary rounded-xl w-100">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-card style-5">
                                <div class="dz-media">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/banner/offer/banner1.png"
                                        alt="">
                                </div>
                                <div class="dz-content">
                                    <h6 class="font-w500 font-14 mb-1">Paket B</h6>
                                    <span class="dz-status">Fisioterapi</span>
                                    <a href="javascript:void(0);" class="btn btn-primary rounded-xl w-100">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-card style-5">
                                <div class="dz-media">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/banner/offer/banner2.png"
                                        alt="">
                                </div>
                                <div class="dz-content">
                                    <h6 class="font-w500 font-14 mb-1">Paket C</h6>
                                    <span class="dz-status">Perilaku & Fisioterapi</span>
                                    <a href="javascript:void(0);" class="btn btn-primary rounded-xl w-100">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- banner kelas dan riwayat terapi --}}

            {{-- terapis view --}}
            <div class="dz-box style-2">
                <div class="title-bar">
                    <h5 class="title mb-0">Add To Your Wishlist</h5>
                    <a href="products.html">See All</a>
                </div>
                <div class="swiper dz-product-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($terapis as $t)
                            <div class="swiper-slide">
                                <div class="dz-card style-2">
                                    <div class="dz-media media-303">
                                        <a href="#">
                                            <img src="{{ $t->foto ? asset('storage/terapis/' . $t->foto) : asset('assets/mobile/pixio/images/product/product1/pic1.png') }}"
                                                alt="image" style="object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a href="product-detail.html">{{ $t->nama }}</a></h6>
                                        <ul class="dz-meta">
                                            <li class="dz-status"><span>Terapis Perilaku</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- terapis view --}}
    </main>
@endsection
