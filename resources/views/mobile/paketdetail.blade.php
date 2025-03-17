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
                    <a href="index.html" class=""><i class="feather icon-home font-20"></i></a>
                </div>
            </div>
        </header>

        <main class="page-content space-top p-b80">
            <div class="container p-0">
                <div class="dz-product-preview">
                    <div class="swiper product-detail-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="dz-media">
                                    <img src="assets/images/product/detail/pic1.png" alt="">
                                    <a href="javascript:void(0);" class="item-bookmark">
                                        <i class="feather icon-heart-on"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="dz-media">
                                    <img src="assets/images/product/detail/pic2.png" alt="">
                                    <a href="javascript:void(0);" class="item-bookmark">
                                        <i class="feather icon-heart-on"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="dz-media">
                                    <img src="assets/images/product/detail/pic3.png" alt="">
                                    <a href="javascript:void(0);" class="item-bookmark">
                                        <i class="feather icon-heart-on"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="dz-media">
                                    <img src="assets/images/product/detail/pic4.png" alt="">
                                    <a href="javascript:void(0);" class="item-bookmark">
                                        <i class="feather icon-heart-on"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-btn">
                            <div class="swiper-pagination style-3"></div>
                        </div>
                    </div>
                </div>
                <div class="dz-product-detail">
                    <div class="detail-content">
                        <ul class="dz-top-meta mb-2">
                            <span class="brand-tag">Jackets</span>
                            <li class="dz-review"><i class="feather icon-star-on"></i><span class="r-rating">4.5</span>
                                <span class="r-status">(470)</span>
                            </li>
                        </ul>
                        <h4 class="title">Men Black Grey Allover Printed Round Neck T-Shirt</h4>
                    </div>
                    <div class="item-wrapper">
                        <div class="dz-meta-items">
                            <div class="dz-price m-r60">
                                <h6 class="dz-name">Price:</h6>
                                <span class="price">$270<del>$310</del></span>
                            </div>
                            <div class="dz-quantity">
                                <h6 class="dz-name">Quantity:</h6>
                                <div class="dz-stepper style-2">
                                    <input readonly class="stepper" type="text" value="2" name="demo3">
                                </div>
                            </div>
                        </div>
                        <div class="product-size">
                            <h6 class="dz-name">Items Size:</h6>
                            <div class="dz-select-btn">
                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio4">
                                <label class="btn" for="btnradio4">S</label>

                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio5" checked>
                                <label class="btn" for="btnradio5">M</label>

                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio6">
                                <label class="btn" for="btnradio6">L</label>

                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio7">
                                <label class="btn" for="btnradio7">XL</label>

                                <input type="radio" class="btn-check" name="btnradio1" id="btnradio8">
                                <label class="btn" for="btnradio8">2Xl</label>
                            </div>
                        </div>
                        <div class="color-filter">
                            <h6 class="dz-name">Items Color:</h6>
                            <div class="dz-color-picker">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioNoLabel"
                                        id="radioNoLabel1" value="#B45E58" aria-label="..." checked="">
                                    <span style="background-color: #B45E58";><i class="feather icon-check"></i></span>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioNoLabel"
                                        id="radioNoLabel2" value="#5F75C5" aria-label="...">
                                    <span style="background-color: #5F75C5;"><i class="feather icon-check"></i></span>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioNoLabel"
                                        id="radioNoLabel3" value="#C58F5E" aria-label="...">
                                    <span style="background-color: #C58F5E;"><i class="feather icon-check"></i></span>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioNoLabel"
                                        id="radioNoLabel4" value="#919191" aria-label="...">
                                    <span style="background-color: #919191;"><i class="feather icon-check"></i></span>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioNoLabel"
                                        id="radioNoLabel5" value="#A872B1" aria-label="...">
                                    <span style="background-color: #A872B1;"><i class="feather icon-check"></i></span>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioNoLabel"
                                        id="radioNoLabel5" value="#699156" aria-label="...">
                                    <span style="background-color: #699156;"><i class="feather icon-check"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="description">
                            <h6 class="title font-w600">Description:</h6>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
