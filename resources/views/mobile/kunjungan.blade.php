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
                    <div class="tab-pane fade active show" id="home" role="tabpanel">
                        @forelse ($kunjungan as $k)
                            <div class="dz-card list list-style-3">
                                <div class="dz-media media-75">
                                    @if ($k->status == 'hadir')
                                        <img
                                            src=" {{ $k->terapis->foto ? asset('storage/terapis/' . $k->terapis->foto) : asset('assets/mobile/pixio/images/banner/pic1.png') }}">
                                    @else
                                        <img src="{{ asset('assets') }}/mobile/pixio/images/product/product1/pic1.png"
                                            alt="">
                                    @endif
                                </div>
                                <div class="dz-content d-flex flex-column">
                                    <h6 class="title"><a
                                            href="{{ route('kunjunganmobile.detail', ['id' => $k->id]) }}">{{ $k->created_at }}</a>
                                    </h6>
                                    @if ($k->status == 'hadir')
                                        <ul class="dz-meta">
                                            <li class="dz-price">Pertemuan {{ $k->pertemuan }}</li>
                                            <li class="dz-review">
                                                <i class="feather icon-star-on"></i><span>({{ $k->status }})</span>
                                            </li>
                                        </ul>
                                        <div class="dz-quantity">Terapis : {{ $k->terapis->nama }}
                                        </div>
                                    @else
                                        <ul class="dz-meta">
                                            <li class="dz-price">Pertemuan -</li>
                                            <li class="dz-review">
                                                @if ($k->status == 'sakit')
                                                    <span>(absen)</span>
                                                @else
                                                    <span>({{ $k->status }})</span>
                                                @endif
                                            </li>
                                        </ul>
                                        <div class="dz-quantity">Terapis : -
                                        </div>
                                    @endif
                                </div>
                                <div class="dz-quantity">
                                    @if ($k->status == 'hadir')
                                        <a href="{{ route('kunjunganmobile.detail', ['id' => $k->id]) }}"
                                            class="btn btn-primary btn-sm rounded-xl btn-xs font-13 mt-3">
                                            Lihat
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
