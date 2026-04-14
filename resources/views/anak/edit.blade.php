@extends('layouts.master')
@section('title', 'Edit Biodata Pasien')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="{{ route('anak.index') }}" class="hover:text-red-500 transition-colors">Data Pasien</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Update Biodata</span>
        </div>
    </div>

    <form method="POST" action="{{ route('anak.update', ['anak' => $anak->id]) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('anak.form', ['tombol' => 'Update Data Pasien'])
    </form>
</div>
@endsection
