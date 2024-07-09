@extends('layouts.master')
@section('menuPaslon', 'active')
@section('content')
    <form action="{{ route('anak.store') }}" method="POST" enctype="multipart/form-data">
        @include('anak.form', ['tombol' => 'Tambah'])
    </form>
@endsection
@section('scripts')
    @include('anak.ajax')
@endsection
