@extends('layouts.master')
@section('menuUpload', 'collapsed')
@section('content')

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Anak</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <h2>{{ $anak->nama }}</h2>
                        <h3>{{ $anak->usia }} Tahun</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <div class="card-body">
                            <h5 class="card-title">General Form Elements</h5>

                            <!-- General Form Elements -->

                            <form>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Program</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="program_id"
                                            id="program_id">
                                            @foreach ($program as $p)
                                                @if ($p->id == (old('program_id') ?? ($p->kategori_id ?? '')))
                                                    <option value="{{ $p->id }}" selected>{{ $p->deskripsi }}
                                                    </option>
                                                @else
                                                    <option value="{{ $p->id }}">{{ $p->deskripsi }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Sub Program</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="program_id"
                                            id="program_id">
                                            @foreach ($program as $p)
                                                @if ($p->id == (old('program_id') ?? ($p->kategori_id ?? '')))
                                                    <option value="{{ $p->id }}" selected>{{ $p->deskripsi }}
                                                    </option>
                                                @else
                                                    <option value="{{ $p->id }}">{{ $p->deskripsi }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                            </form>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
