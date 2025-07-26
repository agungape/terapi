@extends('layouts.master')
@section('menuLayananterapi', 'active')
@section('masterLayananterapi', 'menu-is-opening menu-open')
@section('menuAssessment', 'active')

@section('content')


    @include('assessment.form-edit', ['tombol' => 'Update'])

@endsection

@section('styles')
    @include('assessment.styles')
@endsection

@section('scripts')
    @include('assessment.scripts')
@endsection
