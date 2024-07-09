@extends('layouts.master')
@section('menuPaslon', 'active')
@section('content')
    <form action="{{ route('anak.store') }}" method="POST" enctype="multipart/form-data">
        @include('anak.form', ['tombol' => 'Tambah'])
    </form>
@endsection
@section('scripts')
    <script>
        $('input[type="file"]').on('change', function() {
            let filenames = [];
            let files = document.getElementById('foto').files;

            for (let i in files) {
                if (files.hasOwnProperty(i)) {
                    filenames.push(files[i].name);
                }
            }

            $(this).next('.custom-file-label').addClass("selected").html(filenames.join(', '));
        });
    </script>
@endsection
