@extends('layouts.master')
@section('title', 'Data Assessment Anak')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Top Bar / Breadcrumb -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Assessment Anak</span>
        </div>
        
        @can('create assessment')
        <a href="{{ route('assessment.create') }}" class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
            <i data-lucide="plus-circle" class="w-4 h-4"></i> Upload Hasil Assessment
        </a>
        @endcan
    </div>

    <!-- Header Section -->
    <div class="card-premium p-8 relative overflow-hidden">
        <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-red-50/50 rounded-full -z-0 pointer-events-none"></div>
        <div class="relative z-10 space-y-6">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-red-50 text-red-600 rounded-2xl shadow-sm border border-red-100">
                    <i data-lucide="clipboard-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-lg font-extrabold text-slate-800 tracking-tight">Hasil Assessment</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Data lengkap hasil assessment psikologi anak</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card-premium overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-white flex items-center justify-between">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                <i data-lucide="file-text" class="w-4 h-4 text-red-500"></i> LIST HASIL ASSESSMENT
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest min-w-[150px]">Aksi</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Anak</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Psikolog</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">File Assessment</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($assessment as $a)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                @if ($a->file_assessment == null)
                                    @can('update assessment')
                                    <a href="{{ route('assessment.edit', ['assessment' => $a->id]) }}" class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition-all shadow-sm border border-amber-100" title="Edit">
                                        <i data-lucide="edit-2" class="w-3.5 h-3.5"></i>
                                    </a>
                                    @endcan
                                @endif

                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^\d]/', '', $a->anak->telepon_ibu)) }}?text={{ urlencode('Hasil Assessment ' . $a->anak->nama . ': ' . route('assessment.cetak', ['assessment' => $a->id])) }}"
                                   target="_blank" class="p-2 bg-emerald-50 text-emerald-600 rounded-xl hover:bg-emerald-600 hover:text-white transition-all shadow-sm border border-emerald-100" title="Bagikan via WhatsApp">
                                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                </a>

                                @can('delete assessment')
                                <form action="{{ route('assessment.destroy', ['assessment' => $a->id]) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus" data-name="assessment" data-table="assessment" title="Hapus Data">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center text-red-600 font-extrabold text-[10px] shrink-0 border border-red-100">
                                    {{ strtoupper(substr($a->anak->nama, 0, 1)) }}
                                </div>
                                <span class="text-sm font-extrabold text-slate-700 tracking-tight">{{ $a->anak->nama }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest border border-blue-100">
                                <i data-lucide="user" class="w-3 h-3"></i> {{ $a->psikolog->nama }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if ($a->file_assessment == null)
                                <a href="{{ route('assessment.cetak', ['assessment' => $a->id]) }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-red-500 transition-colors group">
                                    <div class="p-2 bg-slate-50 rounded-lg group-hover:bg-red-50 transition-colors border border-slate-100 group-hover:border-red-100">
                                        <i data-lucide="file-text" class="w-4 h-4 text-slate-400 group-hover:text-red-500"></i>
                                    </div>
                                    <span>hasil-assessment-{{ $a->anak->nama }}.pdf</span>
                                </a>
                            @else
                                <a href="{{ asset('storage/hasil-assessment/' . $a->file_assessment) }}" target="_blank" onclick="window.open(this.href).print(); return false;" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-emerald-500 transition-colors group">
                                    <div class="p-2 bg-slate-50 rounded-lg group-hover:bg-emerald-50 transition-colors border border-slate-100 group-hover:border-emerald-100">
                                        <i data-lucide="file" class="w-4 h-4 text-slate-400 group-hover:text-emerald-500"></i>
                                    </div>
                                    <span>{{ $a->file_assessment }}</span>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-3xl flex items-center justify-center mb-4 border border-slate-100">
                                    <i data-lucide="folder-open" class="w-8 h-8 text-slate-300"></i>
                                </div>
                                <h5 class="text-sm font-extrabold text-slate-700 mb-1">Belum ada data assessment</h5>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Upload hasil assessment psikologi anak terlebih dahulu</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-center">
            {{ $assessment->fragment('judul')->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection
