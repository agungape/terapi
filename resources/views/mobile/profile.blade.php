@extends('mobile.master')
@section('mobileProfile', 'active')
@section('content')
    <main class="page-content dz-gradient-shape">
        <div class="container">
            <div class="profile-area">
                <div class="left-content">
                    <a href="javascript:void(0);" class="menu-toggler pe-2 rounded-xl">
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
                <div class="content-box">
                    <div class="col-12">
                        <div class="card text-center">

                            <div class="card-body">
                                <h6>Progres Terapi
                                    <span class="pull-end text-info">{{ $progress }}%</span>
                                </h6>
                                <div class="progress">
                                    <div class="progress-bar bg-info progress-animated border-0"
                                        style="width: {{ $progress }}%;" role="progressbar">
                                        <span class="sr-only">60% Complete</span>
                                    </div>
                                </div>

                                <div class="card-body mt-2">
                                    <h6>Kehadiran</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Hadir</p>
                                            <span class="badge bg-success rounded-pill">{{ $hadir }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Izin
                                            <span class="badge bg-warning rounded-pill">{{ $izin }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Izin Hangus
                                            <span class="badge bg-danger rounded-pill">{{ $absen }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Sisa Pertemuan
                                            <span class="badge bg-info rounded-pill">{{ $sisaPertemuan }}</span>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="title-bar">
                    <h4 class="title mb-0 font-w500">Pengaturan Akun</h4>
                </div>
                <div class="dz-list style-1 m-b20">
                    <ul>
                        <li>
                            <a href="{{ route('mobile.editprofile') }}" class="item-content item-link">
                                <div class="list-icon">
                                    <i class="fi fi-rr-user"></i>
                                </div>
                                <div class="dz-inner">
                                    <span class="title">Edit Profile</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('mobile.ubahpassword') }}" class="item-content item-link">
                                <div class="list-icon">
                                    <i class="fi fi-rr-unlock text-dark"></i>
                                </div>
                                <div class="dz-inner">
                                    <span class="title">Ubah Kata Sandi</span>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
