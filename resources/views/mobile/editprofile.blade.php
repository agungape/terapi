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
                                src=" {{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/foto-anak/avatar.png') }}"
                                alt="">
                        </div>
                        <h6 class="mb-0 font-13">Hello’ {{ $anak->nama }}</h6>
                    </div>
                </a>
            </div>
            <div class="mid-content"></div>
        </div>
    </header>
    <main class="page-content space-top p-b80">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success solid alert-dismissible fade show" id="success-alert">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2"
                        fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                        <polyline points="9 11 12 14 22 4"></polyline>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                        <span><i class="icon feather icon-x"></i></span>
                    </button>
                </div>

                {{-- Auto hide alert after 3 seconds --}}
                <script>
                    setTimeout(function() {
                        const alert = document.getElementById('success-alert');
                        if (alert) {
                            // Bootstrap fade-out animation
                            alert.classList.remove('show');
                            alert.classList.add('fade');
                            setTimeout(() => alert.remove(), 500); // Remove from DOM after fade
                        }
                    }, 4000); // 3000ms = 3 seconds
                </script>
            @endif

            <div class="edit-profile">
                <form method="POST" action="{{ route('mobile.updateprofile', ['anak' => $anak->id]) }}"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="profile-image">
                        <div class="avatar-upload">
                            <div class="avatar-preview">
                                <div class="text-center">
                                    <img id="previewImage"
                                        src="{{ asset($anak->foto ? 'storage/anak/' . $anak->foto : 'assets/mobile/pixio/images/foto-anak/avatar.png') }}"
                                        class="rounded-circle img-thumbnail"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                                <div class="change-btn">
                                    <input type='file' name="foto" id="imageUpload" class="form-control d-none"
                                        accept="image/*">
                                    <label for="imageUpload">
                                        <i class="fi fi-rr-pencil"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="name">Nama</label>
                        <input type="text" class="form-control" value="{{ old('nama') ?? ($anak->nama ?? '') }}"
                            placeholder="Inputkan nama" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="phone">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" rows="4" name="alamat" autofocus>{{ old('alamat') ?? ($anak->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="form-label" for="address">Telepon</label>
                        <input type="number" class="form-control @error('telepon_ibu') is-invalid @enderror"
                            name="telepon_ibu" autofocus value="{{ old('telepon_ibu') ?? ($anak->telepon_ibu ?? '') }}"
                            placeholder="08xxxxxxxxxx">
                        @error('telepon_ibu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-lg btn-thin rounded-xl btn-primary w-100"> Update
                            Profile</button>
                    </div>
                </form>
            </div>

        </div>
    </main>
    <script>
        document.getElementById('imageUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('previewImage');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
