@extends('layouts.master')
@section('menuPaslon', 'active')
@section('content')
    <form action="{{ route('terapis.store') }}" method="POST">
        @include('terapis.form', ['tombol' => 'Tambah'])
    </form>
@endsection
