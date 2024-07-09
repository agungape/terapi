@extends('layouts.master')
@section('menuUpload', 'collapsed')
@section('content')

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ asset('assets') }}/images/faces/face1.jpg" alt="Profile" class="rounded-circle">
                        <h2>{{ $kunjungan->anak->nama }}</h2>
                        <h5>{{ $kunjungan->usia }} Tahun</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-edit">Pemeriksaan</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-settings">Riwayat</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">

                            {{-- pemeriksaan --}}
                            <div class="tab-pane fade show active profile-overview" id="profile-edit">
                                <form action="{{ route('pemeriksaan.store') }}" method="POST">
                                    @include('kunjungan.form', ['tombol' => 'Submit'])
                                </form>
                            </div>

                            {{-- garfik --}}
                            <div class="tab-pane fade pt-3" id="profile-settings">
                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
