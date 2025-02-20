@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('menuAnak', 'active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Anak</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Anak</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('anak.store') }}" method="POST" enctype="multipart/form-data">

                    @include('anak.form', ['tombol' => 'Tambah'])
                </form>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    {{-- @include('anak.ajax') --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        document.getElementById('uploadButton').addEventListener('click', function() {
            document.getElementById('photoInput').click();
        });

        document.getElementById('photoInput').addEventListener('change', function(event) {
            let reader = new FileReader();
            reader.onload = function() {
                document.getElementById('previewImage').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
@endsection
