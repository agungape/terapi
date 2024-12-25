@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('menuTerapis', 'active')
@section('content')

    <form method="POST" action="{{ route('terapis.update', ['terapi' => $terapi->id]) }}">
        @method('PATCH')
        @include('terapis.form', ['tombol' => 'Update'])
    </form>

@endsection
