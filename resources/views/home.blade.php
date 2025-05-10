@extends('layouts.dashboard')
@section('menuDashboard', 'active')
@section('menuHome', 'collapsed')

@section('content')
    <!-- Video Background -->
    <div class="video-container">
        <video autoplay muted loop id="myVideo" class="video-background">
            <source src="{{ asset('storage/videos/background.mp4') }}" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
    </div>
@endsection
