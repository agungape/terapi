@extends('layouts.master')
@section('menuAssessment', 'active')
@section('content')
    <form action="{{ route('assessment.store') }}" method="POST" enctype="multipart/form-data">
        @include('assessment.form', ['tombol' => 'Upload Hasil'])
    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // 1. Script untuk file upload
            $('input[type="file"]').on('change', function() {
                let filenames = [];
                let files = this.files;

                for (let i in files) {
                    if (files.hasOwnProperty(i)) {
                        filenames.push(files[i].name);
                    }
                }

                $(this).next('.custom-file-label').addClass("selected").html(filenames.join(', '));
            });
        });
    </script>


@endsection
