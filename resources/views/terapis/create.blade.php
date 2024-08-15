@extends('layouts.master')
@section('menuMaster', 'active')
@section('masterShow', 'show')
@section('menuTerapis', 'active')
@section('content')
    <form action="{{ route('terapis.store') }}" method="POST">
        @include('terapis.form', ['tombol' => 'Tambah'])
    </form>
@endsection
