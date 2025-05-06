@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('menuPsikolog', 'active')
@section('content')

    <form method="POST" action="{{ route('psikolog.update', ['psikolog' => $psikolog->id]) }}">
        @method('PATCH')
        @include('psikolog.form', ['tombol' => 'Update'])
    </form>

@endsection
