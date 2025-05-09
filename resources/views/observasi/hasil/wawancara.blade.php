@extends('layouts.master')
@section('menuObservasi', 'active')
@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">

                {{-- FORM UTAMA --}}

                <div class="row">
                    {{-- Kolom Form --}}
                    <div class="col-12 col-md-4">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4 class="card-title">Observasi Anak</h4>
                            </div>
                            <div class="card-body">
                                {{-- Data Anak --}}
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="hidden" name="anak_id" value="{{ $anak->id }}">
                                    <input type="text" class="form-control" disabled value="{{ $anak->nama }}">
                                </div>

                                <div class="form-group">
                                    <label>Umur</label>
                                    <input type="text" class="form-control" disabled value="{{ $umur }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <div class="row">
                                    <div class="col-md-11">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#wawancara"
                                                    data-toggle="tab">Wawancara</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{ route('observasi.show', ['anak' => $anak->id]) }}"
                                            class="btn btn-warning btn-sm">
                                            Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="tab-content">

                                    {{-- observasi autis --}}
                                    <div class="active tab-pane" id="wawancara">

                                        {{-- DAFTAR PERTANYAAN --}}
                                        <div class="row justify-content-center">
                                            <div class="col-lg-10">
                                                <div class="card shadow-sm">
                                                    <div class="card-header bg-success text-white text-center">
                                                        <h6 class="mb-0">HASIL INSTRUMEN JAWABAN PERTANYAAN WAWANCARA</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-hover table-sm">
                                                                <thead class="thead-light">
                                                                    <tr class="text-center">
                                                                        <th style="width: 5%;">No</th>
                                                                        <th>Pertanyaan</th>
                                                                        <th style="width: 30%;">Jawaban</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($qrwawancara as $index => $q)
                                                                        <tr>
                                                                            <td class="text-center align-middle">
                                                                                {{ $index + 1 }}</td>
                                                                            <td class="align-middle">
                                                                                {{ $q->question_wawancara->question_text }}
                                                                            </td>
                                                                            <td class="text-center">
                                                                                {{ $q->answer }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
