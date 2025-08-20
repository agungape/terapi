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
                                    src=" {{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/foto-anak/avatar.png') }}"
                                    alt="">
                            </div>
                            <h6 class="mb-0 font-13">Hello’ {{ $anak->nama }}</h6>
                        </div>
                    </a>
                </div>
                <div class="content-box">
                    <div class="col-12">
                        <div class="card text-center">
                            <div class="card-body row g-0">
                                <h6>Absensi Anak</h6>
                                <table>
                                    <thead>
                                        <tr>
                                            <td width="30%"></td>
                                            <td>Terapi Perilaku</td>
                                            <td>Fisioterapi & SI</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    Hadir
                                                </li>
                                            </td>
                                            <td class="text-green">
                                                {{ $hadir_terapi_perilaku }}
                                            <td class="text-green">
                                                {{ $hadir_fisioterapi }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    Izin
                                                </li>
                                            </td>
                                            <td class="text-yellow">
                                                {{ $izin_terapi_perilaku }}
                                            <td class="text-yellow">
                                                {{ $izin_fisioterapi }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    Sakit
                                                </li>
                                            </td>
                                            <td class="text-blue">
                                                {{ $sakit_terapi_perilaku }}
                                            <td class="text-blue">
                                                {{ $sakit_fisioterapi }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    Izin Hangus
                                                </li>
                                            </td>
                                            <td class="text-red">
                                                {{ $izin_hangus_terapi_perilaku }}
                                            <td class="text-red">
                                                {{ $izin_hangus_fisioterapi }}
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>



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
