@extends('layouts.master')
@section('title', 'Registrasi Pasien Baru')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="{{ route('anak.index') }}" class="hover:text-red-500 transition-colors">Data Pasien</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Registrasi Baru</span>
        </div>
    </div>

    <form action="{{ route('anak.store') }}" method="POST" enctype="multipart/form-data">
        @include('anak.form', ['tombol' => 'Simpan Data Pasien'])
    </form>
</div>
@endsection
