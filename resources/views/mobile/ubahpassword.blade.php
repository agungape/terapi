@extends('mobile.master')
@section('mobileProfile', 'active')
@section('content')
    <main class="page-content">
        <div class="container px-0 pt-0">
            <div class="dz-authentication-area">
                <div class="dz-media">
                    <img src="{{ asset('assets') }}/mobile/pixio/images/authentication/pic5.png" alt="">
                    <a href="javascript:void(0);" class="back-btn">
                        <i class="icon feather icon-chevron-left"></i>
                    </a>
                </div>
                <div class="section-head">
                    <h3 class="title">Masukkan Password Baru</h3>
                    <p>Kata sandi baru Anda harus berbeda dari kata sandi yang digunakan sebelumnya.</p>
                </div>
                <div class="account-section">
                    <form method="POST" action="{{ route('mobile.updatepassword', ['user' => $user->id]) }}"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success solid alert-dismissible fade show" id="success-alert">
                                <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor"
                                    stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    class="me-2">
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
                        <div class="alert alert-danger alert-dismissible alert-alt fade show">
                            <strong>perhatian!</strong>
                            <ul>
                                <li> Kata sandi harus memiliki minimal 8 karakter, mengandung huruf besar, huruf kecil.
                                </li>
                            </ul>
                        </div>
                        <div>
                            <label class="form-label" for="dz-password">Kata Sandi Baru*</label>
                            <div class="mb-3 input-group input-group-icon">
                                <input type="password" id="dz-password" class="form-control dz-password" name="password"
                                    placeholder="ketik untuk buat ulang kata sandi">
                                <span class="input-group-text show-pass">
                                    <i class="icon feather icon-eye-off eye-close"></i>
                                    <i class="icon feather icon-eye eye-open"></i>
                                </span>
                            </div>
                        </div>
                        <div>
                            <label class="form-label" for="dz-password2">Inputkan Ulang Kata Sandi*</label>
                            <div class="input-group input-group-icon mb-3">
                                <input type="password" id="dz-password" class="form-control dz-password"
                                    name="password_confirmation">
                                <span class="input-group-text show-pass">
                                    <i class="icon feather icon-eye-off eye-close"></i>
                                    <i class="icon feather icon-eye eye-open"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit"
                                class="btn btn-thin btn-lg w-100 btn-primary rounded-xl btn-icon icon-start"> Update
                                Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
