@extends('layouts.master')
@section('menuBarang', 'active')
@section('content')

    <form method="POST" action="{{ route('terapis.update', ['terapi' => $terapi->id]) }}">
        @method('PATCH')
        @include('terapis.form', ['tombol' => 'Update'])
    </form>

@endsection
