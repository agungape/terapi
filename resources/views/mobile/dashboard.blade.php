@extends('mobile.master')
@section('mobileDashboard', 'active')
@section('content')
    <main class="page-content space-top p-b40">
        <div class="container">
            <!-- Banner Start -->
            <div class="dz-banner">
                <div class="swiper banner-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($terapis as $t)
                            <div class="swiper-slide">
                                <div class="inner-banner">
                                    <div class="vector-icon">
                                        <svg width="32" height="36" viewBox="0 0 32 36" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16 0L17.638 15.1629L31.5885 9L19.276 18L31.5885 27L17.638 20.8371L16 36L14.362 20.8371L0.411543 27L12.724 18L0.411543 9L14.362 15.1629L16 0Z"
                                                fill="var(--primary)" />
                                        </svg>
                                    </div>
                                    <div class="left-content">
                                        <h4 class="title font-w500 text-capitalize mb-3" data-swiper-parallax="-100">
                                            {{ $t->nama }}</h4>
                                        <div class="meta-items">
                                            <div class="dz-prize" data-swiper-parallax="-200">
                                                <span class="d-block mb-1 font-12">Usia</span>
                                                <span class="badge badge-sm badge-success">{{ $t->usia }}
                                                    Tahun</span>
                                            </div>
                                            <div class="product-size" data-swiper-parallax="-300">
                                                <span class="d-block mb-1 font-12">Skill</span>
                                                <span class="badge badge-sm badge-info">Terapis Perilaku</span>

                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary rounded-xl">View
                                            Details</a>
                                    </div>
                                    <div class="right-content">
                                        <div class="dz-media">
                                            <img src=" {{ $t->foto ? asset('storage/terapis/' . $t->foto) : asset('assets/mobile/pixio/images/banner/pic1.png') }}"
                                                alt="" style="width: 140px; height: 230px">
                                        </div>
                                        <h2 class="dz-text" data-text="BRIGHT">BRIGHT</h2>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- <div class="swiper-slide">
                            <div class="inner-banner">
                                <div class="vector-icon">
                                    <svg width="32" height="36" viewBox="0 0 32 36" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16 0L17.638 15.1629L31.5885 9L19.276 18L31.5885 27L17.638 20.8371L16 36L14.362 20.8371L0.411543 27L12.724 18L0.411543 9L14.362 15.1629L16 0Z"
                                            fill="var(--primary)" />
                                    </svg>
                                </div>
                                <div class="left-content">
                                    <h4 class="title font-w500 text-capitalize mb-3" data-swiper-parallax="-100">
                                        Explore Our Latest Collections Here</h4>
                                    <div class="meta-items">
                                        <div class="dz-prize" data-swiper-parallax="-200">
                                            <span class="d-block mb-1 font-12">Price</span>
                                            <h3 class="prize mb-0">$265</h3>
                                        </div>
                                        <div class="product-size" data-swiper-parallax="-300">
                                            <span class="d-block mb-1 font-12">Select Size</span>
                                            <div class="dz-select-btn">
                                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio4">
                                                <label class="btn" for="btnradio4">X</label>

                                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio5">
                                                <label class="btn" for="btnradio5">M</label>

                                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio6">
                                                <label class="btn" for="btnradio6">S</label>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary rounded-xl">View
                                        Details</a>
                                </div>
                                <div class="right-content">
                                    <div class="dz-media">
                                        <img src="{{ asset('assets') }}/mobile/pixio/images/banner/pic2.png" alt="">
                                    </div>
                                    <h2 class="dz-text" data-text="winter">Winter</h2>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="inner-banner">
                                <div class="vector-icon">
                                    <svg width="32" height="36" viewBox="0 0 32 36" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16 0L17.638 15.1629L31.5885 9L19.276 18L31.5885 27L17.638 20.8371L16 36L14.362 20.8371L0.411543 27L12.724 18L0.411543 9L14.362 15.1629L16 0Z"
                                            fill="var(--primary)" />
                                    </svg>
                                </div>
                                <div class="left-content">
                                    <h4 class="title font-w500 text-capitalize mb-3" data-swiper-parallax="-100">
                                        Incorporate Vintage or Unique Pieces</h4>
                                    <div class="meta-items">
                                        <div class="dz-prize" data-swiper-parallax="-200">
                                            <span class="d-block mb-1 font-12">Price</span>
                                            <h3 class="prize mb-0">$550</h3>
                                        </div>
                                        <div class="product-size" data-swiper-parallax="-300">
                                            <span class="d-block mb-1 font-12">Select Size</span>
                                            <div class="dz-select-btn">
                                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio7">
                                                <label class="btn" for="btnradio7">X</label>

                                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio8">
                                                <label class="btn" for="btnradio8">M</label>

                                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio9">
                                                <label class="btn" for="btnradio9">S</label>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary rounded-xl">View
                                        Details</a>
                                </div>
                                <div class="right-content">
                                    <div class="dz-media">
                                        <img src="{{ asset('assets') }}/mobile/pixio/images/banner/pic3.png"
                                            alt="">
                                    </div>
                                    <h2 class="dz-text" data-text="winter">Winter</h2>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- Banner End -->
            <div class="dz-category style-1">
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
                                    <h6 class="font-w500 font-14 mb-1">Get Flat $75 Back</h6>
                                    <span class="dz-status">Up to 40% Off</span>
                                    <a href="javascript:void(0);" class="btn btn-primary rounded-xl w-100">Collect
                                        Now</a>
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
                                    <h6 class="font-w500 font-14 mb-1">Get Flat $75 Back</h6>
                                    <span class="dz-status">Up to 40% Off</span>
                                    <a href="javascript:void(0);" class="btn btn-primary rounded-xl w-100">Collect
                                        Now</a>
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
                                    <h6 class="font-w500 font-14 mb-1">Get Flat $75 Back</h6>
                                    <span class="dz-status">Up to 40% Off</span>
                                    <a href="javascript:void(0);" class="btn btn-primary rounded-xl w-100">Collect
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dz-box bg-white deals-area">
                <div class="title-bar">
                    <h5 class="title mb-0">Blockbuster deals</h5>
                    <a href="cart.html">See All Deals</a>
                </div>
                <div class="swiper dealSwiper2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="dz-media" data-swiper-parallax="-300">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/deals/1.png" />
                            </div>
                            <div class="product-detail">
                                <h6 class="offer" data-swiper-parallax="-200">up to 79% off</h6>
                                <p class="title-text" data-swiper-parallax="-100">Black Friday sales prices live
                                    on man t-shirts form</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-media" data-swiper-parallax="-300">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/deals/2.png" />
                            </div>
                            <div class="product-detail">
                                <h6 class="offer" data-swiper-parallax="-200">up to 79% off</h6>
                                <p class="title-text" data-swiper-parallax="-100">Black Friday sales prices live
                                    on man t-shirts form</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-media" data-swiper-parallax="-300">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/deals/3.png" />
                            </div>
                            <div class="product-detail">
                                <h6 class="offer" data-swiper-parallax="-200">up to 79% off</h6>
                                <p class="title-text" data-swiper-parallax="-100">Black Friday sales prices live
                                    on man t-shirts form</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-media" data-swiper-parallax="-300">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/deals/4.png" />
                            </div>
                            <div class="product-detail">
                                <h6 class="offer" data-swiper-parallax="-200">up to 79% off</h6>
                                <p class="title-text" data-swiper-parallax="-100">Black Friday sales prices live
                                    on man t-shirts form</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-media" data-swiper-parallax="-300">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/deals/5.png" />
                            </div>
                            <div class="product-detail">
                                <h6 class="offer" data-swiper-parallax="-200">up to 79% off</h6>
                                <p class="title-text" data-swiper-parallax="-100">Black Friday sales prices live
                                    on man t-shirts form</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-media" data-swiper-parallax="-300">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/deals/6.png" />
                            </div>
                            <div class="product-detail">
                                <h6 class="offer" data-swiper-parallax="-200">up to 79% off</h6>
                                <p class="title-text" data-swiper-parallax="-100">Black Friday sales prices live
                                    on man t-shirts form</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tag-slider" id="tagSlider">
                    <div class="item-wrap">
                        <div class="item">
                            <span">Bottle</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Ball</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Bottle</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Mate</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Ring</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Bottle</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Ball</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Bottle</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Mate</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Ring</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div thumbsSlider="" class="swiper dealSwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="dz-media media-70">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/deals/1.png" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-media media-70">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/deals/2.png" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-media media-70">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/deals/3.png" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-media media-70">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/deals/4.png" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-media media-70">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/deals/5.png" />
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-media media-70">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/deals/6.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Category Start -->
            <div class="dz-box style-4">
                <div class="title-bar">
                    <h5 class="title mb-0">Riwayat Terapi</h5>
                    <a href="products.html">See All</a>
                </div>
                <div class="swiper dz-product-swiper">
                    <div class="swiper-wrapper">
                        @forelse ($kunjungan as $k)
                            <div class="swiper-slide">
                                <div class="dz-card style-2">
                                    <div class="dz-media">
                                        <a href="products.html">
                                            <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/1.png"
                                                alt="image">
                                        </a>
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a href="products.html">Pertemuan {{ $k->pertemuan }}</a></h6>
                                        <ul class="dz-meta">
                                            <li class="titles">{{ $k->created_at }}</li>
                                            <li class="dz-status"><span>{{ $k->status }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>data riwayat terapi belum ada</p>
                        @endforelse


                    </div>
                </div>
            </div>
            <!-- Category End -->

            <!-- Category2 Start -->
            <div class="dz-category style-2 mb-3">
                <h4 class="title font-w500 mb-3 text-capitalize max-w300">Set your wardrobe with our amazing
                    selection!</h4>
                <div class="swiper dz-category-swiper2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide category-bx">
                            <div class="dz-media">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/category/category2/1.png"
                                    alt="">
                            </div>
                            <a href="category.html" class="category-tag tag-lg">Child</a>
                        </div>
                        <div class="swiper-slide category-bx">
                            <div class="dz-media">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/category/category2/2.png"
                                    alt="">
                            </div>
                            <a href="category.html" class="category-tag tag-lg">Man</a>
                        </div>
                        <div class="swiper-slide category-bx">
                            <div class="dz-media">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/category/category2/3.png"
                                    alt="">
                            </div>
                            <a href="category.html" class="category-tag tag-lg">Woman</a>
                        </div>
                        <div class="swiper-slide category-bx">
                            <div class="dz-media">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/category/category2/1.png"
                                    alt="">
                            </div>
                            <a href="category.html" class="category-tag tag-lg">Child</a>
                        </div>
                    </div>
                </div>
                <div class="tag-slider" id="tagSlider">
                    <div class="item-wrap">
                        <div class="item">
                            <span">Bottle</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Ball</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Bottle</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Mate</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Ring</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Bottle</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Ball</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Bottle</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Mate</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                        <div class="item">
                            <span">Ring</span>
                        </div>
                        <div class="item">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9821 0.959069L10.6395 6.52451L16.5207 8.38153L10.9552 11.039L9.0982 16.9201L6.44076 11.3547L0.559639 9.49763L6.12508 6.84019L7.9821 0.959069Z"
                                    fill="var(--primary)" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Category2 End -->

            <h5 class="title">New Arrival</h5>
            <div class="swiper dz-category-swiper3 mb-3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="category.html" class="category-tag tag-lg active">All</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="category.html" class="category-tag tag-lg">Child</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="category.html" class="category-tag tag-lg">Man</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="category.html" class="category-tag tag-lg">Woman</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="category.html" class="category-tag tag-lg">Dress</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="category.html" class="category-tag tag-lg">Unisex</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="category.html" class="category-tag tag-lg">Woman</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="category.html" class="category-tag tag-lg">Child</a>
                    </div>
                </div>
            </div>

            <!-- Shop Card -->
            <div class="row g-3 mb-3">
                <div class="col-6">
                    <div class="dz-card">
                        <div class="dz-media">
                            <a href="product-detail.html">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product1/pic1.png"
                                    alt="image">
                            </a>
                            <a href="javascript:void(0);" class="item-bookmark">
                                <i class="feather icon-heart-on"></i>
                            </a>
                        </div>
                        <div class="dz-content">
                            <h6 class="title"><a href="product-detail.html">bluebell hand block tiered dress</a>
                            </h6>
                            <ul class="dz-meta">
                                <li class="dz-price">$80<del>$95</del></li>
                                <li class="dz-review"><i class="feather icon-star-on"></i><span>(2k Review)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="dz-card">
                        <div class="dz-media">
                            <a href="product-detail.html">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product1/pic2.png"
                                    alt="image">
                            </a>
                            <a href="javascript:void(0);" class="item-bookmark">
                                <i class="feather icon-heart-on"></i>
                            </a>
                        </div>
                        <div class="dz-content">
                            <h6 class="title"><a href="product-detail.html">bluebell hand block tiered dress</a>
                            </h6>
                            <ul class="dz-meta">
                                <li class="dz-price">$80<del>$95</del></li>
                                <li class="dz-review"><i class="feather icon-star-on"></i><span>(2k Review)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="dz-card">
                        <div class="dz-media">
                            <a href="product-detail.html">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product1/pic3.png"
                                    alt="image">
                            </a>
                            <a href="javascript:void(0);" class="item-bookmark">
                                <i class="feather icon-heart-on"></i>
                            </a>
                        </div>
                        <div class="dz-content">
                            <h6 class="title"><a href="product-detail.html">bluebell hand block tiered dress</a>
                            </h6>
                            <ul class="dz-meta">
                                <li class="dz-price">$80<del>$95</del></li>
                                <li class="dz-review"><i class="feather icon-star-on"></i><span>(2k Review)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="dz-card">
                        <div class="dz-media">
                            <a href="product-detail.html">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product1/pic4.png"
                                    alt="image">
                            </a>
                            <a href="javascript:void(0);" class="item-bookmark">
                                <i class="feather icon-heart-on"></i>
                            </a>
                        </div>
                        <div class="dz-content">
                            <h6 class="title"><a href="product-detail.html">bluebell hand block tiered dress</a>
                            </h6>
                            <ul class="dz-meta">
                                <li class="dz-price">$80<del>$95</del></li>
                                <li class="dz-review"><i class="feather icon-star-on"></i><span>(2k Review)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shop Card -->

            <!-- Shorted Product -->

            <!-- Shorted Product -->

            <!-- Also Viwed -->
            <div class="dz-box bg-white">
                <div class="title-bar">
                    <h5 class="title mb-0">Sponsored</h5>
                    <a href="products.html">See All</a>
                </div>
                <div class="row g-2">
                    <div class="col-4">
                        <a href="products.html">
                            <div class="dz-card style-3">
                                <div class="dz-media">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product3/1.png"
                                        alt="image">
                                </div>
                                <div class="dz-content">
                                    <span class="title">Outdoor Shoes</span>
                                    <span class="offer">Min. 30% Off</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="products.html">
                            <div class="dz-card style-3">
                                <div class="dz-media">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product3/2.png"
                                        alt="image">
                                </div>
                                <div class="dz-content">
                                    <span class="title">Best Cloths</span>
                                    <span class="offer">Up To 20% Off</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="products.html">
                            <div class="dz-card style-3">
                                <div class="dz-media">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product3/3.png"
                                        alt="image">
                                </div>
                                <div class="dz-content">
                                    <span class="title">Child Cloths</span>
                                    <span class="offer">Min. 30% Off</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="products.html">
                            <div class="dz-card style-3">
                                <div class="dz-media">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product3/4.png"
                                        alt="image">
                                </div>
                                <div class="dz-content">
                                    <span class="title">Modern Watch</span>
                                    <span class="offer">up to 30% Off</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="products.html">
                            <div class="dz-card style-3">
                                <div class="dz-media">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product3/5.png"
                                        alt="image">
                                </div>
                                <div class="dz-content">
                                    <span class="title">Modern Jewellery</span>
                                    <span class="offer">70% Off</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="products.html">
                            <div class="dz-card style-3">
                                <div class="dz-media">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product3/6.png"
                                        alt="image">
                                </div>
                                <div class="dz-content">
                                    <span class="title">Sports Shoes</span>
                                    <span class="offer">Min. 30% Off</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Also Viwed -->

            <!-- Sponsored -->
            <div class="dz-box style-2">
                <div class="title-bar">
                    <h5 class="title mb-0">People Also Viewed</h5>
                    <a href="products.html">See All</a>
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="dz-card style-2">
                            <div class="dz-media">
                                <a href="product-detail.html">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product4/pic1.png"
                                        alt="image">
                                </a>
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">bluebell hand block..</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-price">$80<del>$95</del></li>
                                    <li class="dz-status"><span>Free delivery</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dz-card style-2">
                            <div class="dz-media">
                                <a href="product-detail.html">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product4/pic2.png"
                                        alt="image">
                                </a>
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">bluebell hand block..</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-status"><span>Min. 70% Off</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dz-card style-2">
                            <div class="dz-media">
                                <a href="product-detail.html">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product4/pic3.png"
                                        alt="image">
                                </a>
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">bluebell hand block..</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-price">$80<del>$95</del></li>
                                    <li class="dz-status"><span>Free delivery</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dz-card style-2">
                            <div class="dz-media">
                                <a href="product-detail.html">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product4/pic4.png"
                                        alt="image">
                                </a>
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">bluebell hand block..</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-price">$80<del>$95</del></li>
                                    <li class="dz-status"><span>Free delivery</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sponsored -->

            <!-- Cart -->
            <div class="dz-box bg-white style-3">
                <div class="title-bar">
                    <h5 class="title mb-0">Items in your cart</h5>
                    <a href="cart.html" class="font-13 font-w500">View Cart</a>
                </div>
                <div class="row mb-3">
                    <div class="col-12 mb-3">
                        <div class="dz-card list">
                            <div class="dz-media media-75">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product1/pic1.png"
                                    alt="">
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">bluebell hand block tiered
                                        dress</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-price">$80<del>$95</del></li>
                                    <li class="dz-review"><i class="feather icon-star-on"></i><span>(2k
                                            Review)</span></li>
                                </ul>
                                <div class="dz-quantity">Quantity: <span class="quantity">1</span></div>
                            </div>
                            <a href="javascript:void(0);" class="dz-icon icon-sm"><i class="feather icon-x"></i></a>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="dz-card list">
                            <div class="dz-media media-75">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product1/pic2.png"
                                    alt="">
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">bluebell hand block tiered
                                        dress</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-price">$80<del>$95</del></li>
                                    <li class="dz-review"><i class="feather icon-star-on"></i><span>(2k
                                            Review)</span></li>
                                </ul>
                                <div class="dz-quantity">Quantity: <span class="quantity">1</span></div>
                            </div>
                            <a href="javascript:void(0);" class="dz-icon icon-sm"><i class="feather icon-x"></i></a>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="dz-card list">
                            <div class="dz-media media-75">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/product/product1/pic3.png"
                                    alt="">
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">bluebell hand block tiered
                                        dress</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-price">$80<del>$95</del></li>
                                    <li class="dz-review"><i class="feather icon-star-on"></i><span>(2k
                                            Review)</span></li>
                                </ul>
                                <div class="dz-quantity">Quantity: <span class="quantity">1</span></div>
                            </div>
                            <a href="javascript:void(0);" class="dz-icon icon-sm"><i class="feather icon-x"></i></a>
                        </div>
                    </div>
                </div>
                <a href="checkout.html"
                    class="btn font-15 w-100 btn-outline-primary rounded-xl btn-icon icon-start style-2"><i
                        class="feather icon-arrow-right"></i>Proceed to checkout (3)</a>
            </div>
            <!-- Cart -->

            <!-- Offer Banner -->
            <div class="offer-banner">
                <div class="swiper dz-offer-banner">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="dz-media rounded">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/banner/offer/banner1.png"
                                    alt="">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-media rounded">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/banner/offer/banner2.png"
                                    alt="">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-media rounded">
                                <img src="{{ asset('assets') }}/mobile/pixio/images/banner/offer/banner1.png"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Offer Banner -->

            <!-- Nearby -->
            <div class="dz-box style-4">
                <div class="title-bar align-items-start">
                    <div class="left">
                        <h5 class="title mb-0">Popular Nearby</h5>
                        <span>Up to 60% off + up to $107 casHACK</span>
                    </div>
                    <a href="products.html">See All</a>
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="dz-card style-4">
                            <div class="dz-media">
                                <a href="product-detail.html">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product4/pic5.png"
                                        alt="image">
                                </a>
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">bluebell hand block..</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-status"><span>Special Offer</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dz-card style-4">
                            <div class="dz-media">
                                <a href="product-detail.html">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product4/pic6.png"
                                        alt="image">
                                </a>
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">block tiered dress..</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-status"><span>Min. 70% Off</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dz-card style-4">
                            <div class="dz-media">
                                <a href="product-detail.html">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product4/pic7.png"
                                        alt="image">
                                </a>
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">block tiered dress..</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-status"><span>Free delivery</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dz-card style-4">
                            <div class="dz-media">
                                <a href="product-detail.html">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product4/pic8.png"
                                        alt="image">
                                </a>
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">bluebell hand block..</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-status"><span>Up To 90% Off</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Nearby -->

            <!-- Beat Deals -->

            <!-- Beat Deals -->

            <!-- Wishlist Product -->
            <div class="dz-box style-2">
                <div class="title-bar">
                    <h5 class="title mb-0">Add To Your Wishlist</h5>
                    <a href="products.html">See All</a>
                </div>
                <div class="swiper dz-product-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="dz-card style-2">
                                <div class="dz-media">
                                    <a href="product-detail.html">
                                        <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/1.png"
                                            alt="image">
                                    </a>
                                </div>
                                <div class="dz-content">
                                    <h6 class="title"><a href="product-detail.html">bluebell hand block..</a>
                                    </h6>
                                    <ul class="dz-meta">
                                        <li class="dz-price">$80<del>$95</del></li>
                                        <li class="dz-status"><span>Free delivery</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-card style-2">
                                <div class="dz-media">
                                    <a href="product-detail.html">
                                        <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/2.png"
                                            alt="image">
                                    </a>
                                </div>
                                <div class="dz-content">
                                    <h6 class="title"><a href="product-detail.html">bluebell hand block..</a>
                                    </h6>
                                    <ul class="dz-meta">
                                        <li class="dz-price">$80<del>$95</del></li>
                                        <li class="dz-status"><span>Free delivery</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-card style-2">
                                <div class="dz-media">
                                    <a href="product-detail.html">
                                        <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/1.png"
                                            alt="image">
                                    </a>
                                </div>
                                <div class="dz-content">
                                    <h6 class="title"><a href="product-detail.html">bluebell hand block..</a>
                                    </h6>
                                    <ul class="dz-meta">
                                        <li class="dz-price">$80<del>$95</del></li>
                                        <li class="dz-status"><span>Free delivery</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-card style-2">
                                <div class="dz-media">
                                    <a href="product-detail.html">
                                        <img src="{{ asset('assets') }}/mobile/pixio/images/product/product2/2.png"
                                            alt="image">
                                    </a>
                                </div>
                                <div class="dz-content">
                                    <h6 class="title"><a href="product-detail.html">bluebell hand block..</a>
                                    </h6>
                                    <ul class="dz-meta">
                                        <li class="dz-price">$80<del>$95</del></li>
                                        <li class="dz-status"><span>Free delivery</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Wishlist Product -->

            <!-- Featured Product -->

            <!-- Featured Product -->

            <!-- Essentials Product -->
            <div class="dz-box style-2">
                <div class="title-bar align-items-start">
                    <div class="left">
                        <h5 class="title mb-0">Great saving on everyday essentials</h5>
                        <span>Up to 60% off + up to $107 casHACK</span>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="dz-card style-4">
                            <div class="dz-media">
                                <a href="product-detail.html">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product4/pic5.png"
                                        alt="image">
                                </a>
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">bluebell hand block..</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-status"><span>Special Offer</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dz-card style-4">
                            <div class="dz-media">
                                <a href="product-detail.html">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product4/pic6.png"
                                        alt="image">
                                </a>
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">block tiered dress..</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-status"><span>Min. 70% Off</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dz-card style-4">
                            <div class="dz-media">
                                <a href="product-detail.html">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product4/pic7.png"
                                        alt="image">
                                </a>
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">block tiered dress..</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-status"><span>Free delivery</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dz-card style-4">
                            <div class="dz-media">
                                <a href="product-detail.html">
                                    <img src="{{ asset('assets') }}/mobile/pixio/images/product/product4/pic8.png"
                                        alt="image">
                                </a>
                            </div>
                            <div class="dz-content">
                                <h6 class="title"><a href="product-detail.html">bluebell hand block..</a></h6>
                                <ul class="dz-meta">
                                    <li class="dz-status"><span>Up To 90% Off</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Essentials Product -->
        </div>
    </main>
@endsection
