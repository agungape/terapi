@extends('layouts.master')
@section('title', 'Edit Hasil Assessment')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    <!-- Top Bar / Breadcrumb -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="{{ route('assessment.index') }}" class="hover:text-red-500 transition-colors">Assessment</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Edit Hasil</span>
        </div>
        <a href="{{ route('assessment.index') }}" class="bg-white border border-slate-200 hover:border-slate-300 text-slate-600 py-2 px-4 rounded-xl text-xs font-bold flex items-center justify-center gap-2 transition-all shadow-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </a>
    </div>

    <!-- Header Section -->
    <div class="card-premium p-8 relative overflow-hidden">
        <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-amber-50/50 rounded-full -z-0 pointer-events-none"></div>
        <div class="relative z-10">
            <div class="flex items-center gap-4 mb-2">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl shadow-sm border border-amber-100">
                    <i data-lucide="edit-2" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-lg font-extrabold text-slate-800 tracking-tight">Edit Formulir Assessment Psikologis</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Ubah data hasil pemeriksaan anak di bawah ini</p>
                </div>
            </div>
        </div>
    </div>

    @include('assessment.form-edit', ['tombol' => 'Simpan Perubahan'])

</div>
@endsection

@section('styles')
    @include('assessment.styles')
@endsection

@section('scripts')
    @include('assessment.scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
@endsection
