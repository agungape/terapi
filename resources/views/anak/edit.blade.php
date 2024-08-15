@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'show')
@section('menuAnak', 'active')
@section('content')

    <form method="POST" action="{{ route('anak.update', ['anak' => $anak->id]) }}">
        @method('PATCH')
        @include('anak.form', ['tombol' => 'Update'])
    </form>

@endsection
