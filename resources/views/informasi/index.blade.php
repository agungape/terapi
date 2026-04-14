@extends('layouts.master')
@section('title', 'Informasi Klinik')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span>Informasi</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Informasi Profil Klinik</h2>
        </div>
    </div>

    <div class="card-premium overflow-hidden">
        <div class="p-6 border-b border-slate-50 flex items-center justify-between">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                <i data-lucide="file-text" class="w-4 h-4 text-red-500"></i> KONTEN INFORMASI WEBSITE
            </h3>
            @can('update informasi')
            <span class="text-[10px] font-bold text-slate-400 italic">Sunting konten lalu tekan Simpan</span>
            @endcan
        </div>

        <form action="{{ route('informasi.update', ['informasi' => $informasi->id]) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="p-8 space-y-6">
                <textarea id="summernote" name="informasi">{{ $informasi->informasi }}</textarea>

                @can('update informasi')
                <div class="flex justify-end gap-3 pt-6 border-t border-slate-50">
                    <button type="submit" class="px-12 py-3 bg-red-500 hover:bg-red-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-red-100 transition-all italic">
                        Simpan Informasi
                    </button>
                </div>
                @endcan
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() { lucide.createIcons(); });
    $(function() {
        $('#summernote').summernote({
            height: 400,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['fontname', 'fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endsection
