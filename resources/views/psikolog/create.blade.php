@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'menu-is-opening menu-open')
@section('menuPsikolog', 'active')
@section('content')
    <form action="{{ route('psikolog.store') }}" method="POST">
        @include('psikolog.form', ['tombol' => 'Tambah'])
    </form>
@endsection
