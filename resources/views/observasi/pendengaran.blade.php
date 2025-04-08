@extends('layouts.master')
@section('menuObservasi', 'active')
@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Observasi</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('observasi.atec') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Anak</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="anak_id" class="form-control" hidden
                                                value="{{ $anak->id }}">
                                            <input type="text" class="form-control" disabled value="{{ $anak->nama }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Jenis</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="jenis" class="form-control"
                                                value="{{ $jenis }}" readonly>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @foreach ($ageGroups as $group)
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Kelompok Umur: {{ $group->nama }}</th>
                                            <th>Ya</th>
                                            <th>Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($group->questions as $q)
                                            <tr>
                                                <td> {{ $q->question_text }} </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input custom-control-input-primary"
                                                            type="radio" id="customRadio4" name="customRadio2"
                                                            checked="">
                                                        <label for="customRadio4" class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input class="custom-control-input custom-control-input-danger"
                                                            type="radio" id="customRadio4" name="customRadio2"
                                                            checked="">
                                                        <label for="customRadio4" class="custom-control-label"></label>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
