@extends('mobile.master')
@section('mobileDashboard', 'active')
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
    <main class="page-content space-top p-b40">
        <div class="container">
            <!-- profile anak -->
            <div class="dz-banner">
                <div class="swiper banner-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="inner-banner">
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
            @if (in_array($sisaPertemuan, [4, 3, 2, 1]))
                <div class="dz-category style-2">
                    <div class="alert alert-info solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <strong>Info!</strong> Pertemuan Kelas Sisa {{ $sisaPertemuan }} Yah!!!.
                    </div>
                </div>
            @elseif (in_array($sisaPertemuan, [0]))
                <div class="dz-category style-2">
                    <div class="alert alert-success solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                        <strong>Success!</strong> Pertemuan Kelas Telah Selesai.
                        <hr>
                        Hubungi <strong>Admin <a href="https://wa.me/+6285123238404"
                                target="_blank">085123238404</a></strong> untuk melanjutkan sesi
                    </div>
                </div>
            @endif
            {{-- @if ($informasi)
                <div class="dz-category style-2">
                    <div class="alert alert-info solid alert-dismissible fade show">
                        <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <strong>Informasi Pelayanan!</strong>
                        <hr> {!! $informasi->informasi !!}
                    </div>
                </div>
            @endif --}}
            {{-- profile anak --}}

            {{-- banner kelas dan riwayat terapi --}}
            <div class="dz-category style-1">
                <div class="title-bar align-items-start">
                    <h5 class="title mb-0">Riwayat Terapi </h5>
                </div>
                <div class="swiper dz-featured-swiper mb-4">
                    <div class="swiper-wrapper">
                        @forelse ($kunjungan as $k)
                            <div class="swiper-slide">
                                <div class="dz-card list list-style-2">
                                    <div class="dz-media media-75">
                                        @if ($k->status == 'hadir')
                                            <img
                                                src=" {{ $k->terapis->foto ? asset('storage/terapis/' . $k->terapis->foto) : asset('assets/mobile/pixio/images/terapis-default.png') }}">
                                        @else
                                            <img src="{{ asset('assets') }}/mobile/pixio/images/product/product1/pic1.png"
                                                alt="">
                                        @endif
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a
                                                href="{{ route('kunjunganmobile.detail', ['id' => $k->id]) }}">{{ $k->created_at }}</a>
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
                            <a href="{{ route('mobile.kunjungan') }}"> <span class="badge bg-success"> <svg
                                        viewBox="0 0 24 24" width="20" height="20" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                        class="me-2">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                    </svg>terapi telah selesai</span></a>
                        @endforelse
                    </div>
                </div>

                <div class="title-bar align-items-start">
                    <h5 class="title mb-0">Paket Terapi Anak</h5>
                </div>
                <div class="swiper dz-featured-swiper2">
                    <div class="swiper-wrapper">
                        @foreach ($tarif as $t)
                            <div class="swiper-slide">
                                <div class="dz-card style-5">
                                    <div class="dz-media media-304">
                                        <img src="  {{ $t->gambar ? asset('storage/tarif/' . $t->gambar) : asset('assets/mobile/pixio/images/fisioterapi.png') }}"
                                            alt="" style="object-fit: cover;">
                                    </div>
                                    <div class="dz-content">
                                        <span style=" padding-bottom: 10px;">{{ $t->nama }}</span>
                                        <button type="button" class="btn btn-info rounded-xl w-100"
                                            data-bs-toggle="modal" data-bs-target="#exampleModalLong"
                                            data-id="{{ $t->id }}" data-name="{{ $t->nama }}"
                                            data-description="{{ $t->deskripsi }}" data-tarif="{{ $t->tarif }}"
                                            data-image="{{ $t->gambar ? asset('storage/tarif/' . $t->gambar) : asset('assets/mobile/pixio/images/banner/offer/banner2.png') }}">
                                            Selengkapnya
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            {{-- banner kelas dan riwayat terapi --}}

            {{-- terapis view --}}
            <div class="dz-box style-2">
                <div class="title-bar">
                    <h5 class="title mb-0">Terapis</h5>
                </div>
                <div class="swiper dz-product-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($terapis as $t)
                            <div class="swiper-slide">
                                <div class="dz-card style-2">
                                    <div class="dz-media media-303">
                                        <a href="#">
                                            <img src="{{ $t->foto ? asset('storage/terapis/' . $t->foto) : asset('assets/mobile/pixio/images/terapis-default.png') }}"
                                                alt="image" style="object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="dz-content">
                                        <h6 class="title"><a href="product-detail.html">{{ $t->nama }}</a></h6>
                                        <ul class="dz-meta">
                                            <li class="dz-status">{{ $t->role }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- terapis view --}}

            <!-- Modal -->
            <div class="modal fade" id="exampleModalLong">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Paket Terapi</h5>
                            <button class="btn-close" data-bs-dismiss="modal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container p-0">
                                <div class="dz-product-preview">
                                    <div class="swiper product-detail-swiper">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="dz-media">
                                                    <img src="" alt="" class="product-image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dz-product-detail">
                                    <div class="detail-content">
                                        <h4 class="title product-name text-center">
                                        </h4>
                                    </div>
                                    <div class="item-wrapper">
                                        <div class="dz-meta-items">
                                            <div class="dz-price m-r60">
                                                <h6 class="dz-name">Tarif:</h6>
                                                <span class="product-tarif badge badge-sm badge-success"></span>
                                            </div>
                                            <div class="dz-price m-r60">
                                                <h6 class="dz-name">Pertemuan:</h6>
                                                <span class="badge badge-sm badge-warning">20x</span>
                                            </div>
                                        </div>
                                        <div class="description">
                                            <h6 class="title font-w600">Deskripsi:</h6>
                                            <p class="product-description" style="text-align: justify"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-danger light"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>


@endsection
{{-- @section('canvas')
    <!-- PWA Offcanvas -->
    <div class="offcanvas offcanvas-bottom pwa-offcanvas">
        <div class="container">
            <div class="offcanvas-body">
                <img class="logo dark" src="{{ asset('assets') }}/mobile/pixio/images/app-logo/bsc.png" alt="">
                <img class="logo light" src="{{ asset('assets') }}/mobile/pixio/images/app-logo/bsc.png" alt="">
                <h5 class="title">Bright Star of Child</h5>
                <p class="pwa-text">Instal aplikasi untuk pengalaman yang lebih baik</p>
                <button type="button" class="btn btn-sm btn-primary rounded-xl pwa-btn me-2">
                    Install Aplikasi
                </button>
                <button type="button" class="btn btn-sm pwa-close rounded-xl btn-secondary">
                    Nanti Saja
                </button>
            </div>
        </div>
    </div>
    <div class="offcanvas-backdrop pwa-backdrop"></div>
    <!-- PWA Offcanvas End -->
@endsection --}}
@section('scripts')
    <script>
        $(document).ready(function() {
            // Ketika tombol "Selengkapnya" diklik
            $('.btn-info').on('click', function() {
                // Ambil data dari atribut data-* pada tombol
                var id = $(this).data('id');
                var name = $(this).data('name');
                var description = $(this).data('description');
                var tarif = $(this).data('tarif');
                var image = $(this).data('image');

                // Isi data ke dalam modal
                $('.product-name').text(name);
                $('.product-description').text(description);
                $('.product-tarif').text('Rp ' + tarif);
                $('.product-image').attr('src', image);

                // Tampilkan modal
                $('#exampleModalLong').modal('show');
            });

            // // PWA Installation Logic
            // let deferredPrompt;
            // const pwaOffcanvas = $('.pwa-offcanvas');
            // const pwaBackdrop = $('.pwa-backdrop');

            // // Check if the app is already installed
            // function isAppInstalled() {
            //     return window.matchMedia('(display-mode: standalone)').matches ||
            //         window.navigator.standalone ||
            //         document.referrer.includes('android-app://');
            // }

            // // Show install prompt
            // function showInstallPromotion() {
            //     if (!isAppInstalled()) {
            //         pwaOffcanvas.addClass('show');
            //         pwaBackdrop.addClass('show');
            //     }
            // }

            // // Hide install prompt
            // function hideInstallPromotion() {
            //     pwaOffcanvas.removeClass('show');
            //     pwaBackdrop.removeClass('show');
            // }

            // // Listen for beforeinstallprompt event
            // window.addEventListener('beforeinstallprompt', (e) => {
            //     // Prevent the mini-infobar from appearing on mobile
            //     e.preventDefault();
            //     // Stash the event so it can be triggered later
            //     deferredPrompt = e;

            //     // Show the install button
            //     showInstallPromotion();

            //     // Log the event for debugging
            //     console.log('beforeinstallprompt event fired');
            // });

            // // Handle install button click
            // $('#installPWA').click(async () => {
            //     if (deferredPrompt) {
            //         // Show the install prompt
            //         deferredPrompt.prompt();

            //         // Wait for the user to respond to the prompt
            //         const {
            //             outcome
            //         } = await deferredPrompt.userChoice;

            //         // Optionally, send analytics event with outcome of user choice
            //         console.log(`User response to the install prompt: ${outcome}`);

            //         // We've used the prompt, and can't use it again, throw it away
            //         deferredPrompt = null;

            //         // Hide the install button
            //         hideInstallPromotion();
            //     }
            // });

            // // Handle defer button click
            // $('#deferInstall').click(() => {
            //     hideInstallPromotion();

            //     // Optionally, set a cookie or localStorage to remember user's choice
            //     localStorage.setItem('pwaInstallDeferred', 'true');

            //     // Show again after 7 days
            //     setTimeout(() => {
            //         if (!isAppInstalled()) {
            //             showInstallPromotion();
            //         }
            //     }, 7 * 24 * 60 * 60 * 1000);
            // });

            // // Check if we should show the prompt on page load
            // if (!localStorage.getItem('pwaInstallDeferred') && !isAppInstalled()) {
            //     // Show after 5 seconds to allow user to see the page first
            //     setTimeout(showInstallPromotion, 5000);
            // }
        });
    </script>

@endsection
