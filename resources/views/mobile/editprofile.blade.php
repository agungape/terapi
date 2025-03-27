@extends('mobile.master')
@section('mobileProfile', 'active')
@section('style')
    <style>
        /* Custom ukuran input ekstra kecil */
        .form-control-xs {
            height: 25px;
            /* Lebih kecil dari form-control-sm */
            padding: 2px 6px;
            font-size: 12px;
            border-radius: 3px;
        }
    </style>
@endsection
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
    <main class="page-content space-top element-area">
        <div class="container">
            <div class="card dz-card style-1" style="background-image: url('assets/images/bg-shape.png');">
                <div class="card-body">
                    <div class="dz-media dz-flex-box">
                        <img src="assets/images/bootstrap-logo.png" alt="">
                    </div>
                    <div class="dz-content">
                        <h5 class="card-title">Bootstrap Elements</h5>
                        <a href="#contentArea" class="element-name scroll">Tabs style</a>
                    </div>
                    <span class="version">BS - v5.3</span>
                </div>
            </div>

            <div class="row" id="contentArea">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Custom Tab 1</h5>
                        </div>
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <div class="custom-tab-1">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#profile1"
                                            aria-selected="false" role="tab" tabindex="-1"><i
                                                class="icon feather icon-user me-2"></i>Biodata</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#home1" aria-selected="true"
                                            role="tab"><i class="icon feather icon-home me-2"></i>Alamat</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#contact1" aria-selected="false"
                                            role="tab" tabindex="-1"><i class="icon feather icon-phone-call me-2"></i>
                                            Kontak</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#message1" aria-selected="false"
                                            role="tab" tabindex="-1"><i
                                                class="icon feather icon-mail me-2"></i>Message</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="home1" role="tabpanel">
                                        <div class="pt-4">
                                            <div class="form-group row mb-2">
                                                <label for="exampleInputConfirmPassword2"
                                                    class="col-sm-3 col-form-label">Nama</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="exampleInputConfirmPassword2" name="tempat_lahir"
                                                        value="Ki. Jend. Sudirman No. 422, Bandung 21101, Jabar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade active show" id="profile1" role="tabpanel">
                                        <div class="pt-4">
                                            <h6>This is profile title</h6>
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt
                                                tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                            </p>
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt
                                                tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact1" role="tabpanel">
                                        <div class="pt-4">
                                            <h4>This is contact title</h4>
                                            <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                                Consonantia, there live the blind texts. Separated they live in
                                                Bookmarksgrove.
                                            </p>
                                            <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                                Consonantia, there live the blind texts. Separated they live in
                                                Bookmarksgrove.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="message1" role="tabpanel">
                                        <div class="pt-4">
                                            <h4>This is message title</h4>
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt
                                                tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                            </p>
                                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt
                                                tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
