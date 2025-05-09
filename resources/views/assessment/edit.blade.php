@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('menuAssessment', 'active')
@section('content')

    <form method="POST" action="{{ route('assessment.update', ['assessment' => $assessment->id]) }}"
        enctype="multipart/form-data">
        @method('PATCH')
        @include('assessment.form', ['tombol' => 'Update'])
    </form>

@endsection

@section('scripts')
    <script>
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("file_assessment").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>
@endsection
