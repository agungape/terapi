@extends('mobile.master')
@section('mobileJadwal', 'active')
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
            <div class="right-content d-flex align-items-center gap-3">
                <a href="notification.html" class="notification-badge font-20">
                    <i class="icon feather icon-bell"></i>
                    <span class="badge badge-danger">14</span>
                </a>
                <a href="search.html" class="icon font-20">
                    <i class="icon feather icon-search"></i>
                </a>
            </div>
        </div>
    </header>
    <main class="page-content space-top">
        <div class="container pt-0">
            <div class="dz-card list list-style-3 mb-4">
                <div class="dz-media">
                    <img src="assets/images/product/product1/pic3.png" alt="">
                </div>
                <div class="dz-content">
                    <h6 class="title"><a href="product-detail.html">bluebell hand block tiered</a></h6>
                    <ul class="dz-meta gap-4">
                        <li class="dz-price">$80<del>$95</del></li>
                        <li class="dz-qty font-12"><small>Qty:</small><span class="font-w500">2</span></li>
                    </ul>
                    <span class="dz-status text-success d-inline-block">In Delivery</span>
                    <span class="dz-off">40% Off</span>
                </div>
            </div>

            <div class="order-status">
                <h5 class="title">Track order</h5>
                <ul class="dz-timeline style-2">
                    <li class="timeline-item active">
                        <h6 class="timeline-tilte"><span class="title">order placed</span> <span class="timeline-date">27
                                Dec 2023</span></h6>
                        <p class="timeline-text">We have received your order</p>
                    </li>
                    <li class="timeline-item active">
                        <h6 class="timeline-tilte"><span class="title">order Confirm</span> <span class="timeline-date">27
                                Dec 2023</span></h6>
                        <p class="timeline-text">We has been confirmed</p>
                    </li>
                    <li class="timeline-item">
                        <h6 class="timeline-tilte"><span class="title">Ready To ship</span> <span class="timeline-date">28
                                Dec 2023</span></h6>
                        <p class="timeline-text">We are preparing your order</p>
                    </li>
                    <li class="timeline-item">
                        <h6 class="timeline-tilte"><span class="title">order placed</span> <span class="timeline-date">29
                                Dec 2023</span></h6>
                        <p class="timeline-text">Your order is ready for shipping </p>
                    </li>
                    <li class="timeline-item">
                        <h6 class="timeline-tilte"><span class="title">Out for delivery</span> <span
                                class="timeline-date">31 Dec 2023</span></h6>
                        <p class="timeline-text">Your order is out for delivery</p>
                    </li>
                </ul>
            </div>
        </div>
    </main>
@endsection
