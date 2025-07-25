@extends('layouts.master')
@section('menuLayananterapi', 'active')
@section('masterLayananterapi', 'menu-is-opening menu-open')
@section('menuAssessment', 'active')

@section('content')
    <form action="{{ route('assessment.store') }}" method="POST" enctype="multipart/form-data">
        @include('assessment.form', ['tombol' => 'Upload Hasil'])
    </form>
@endsection

@section('styles')
    @include('assessment.styles')
@endsection

@section('scripts')
    @include('assessment.scripts')
@endsection
