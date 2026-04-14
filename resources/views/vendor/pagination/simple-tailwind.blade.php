@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between p-4 bg-slate-50/50 rounded-2xl border border-slate-100 shadow-sm">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-6 py-2.5 text-[10px] font-black uppercase tracking-widest text-slate-300 bg-white border border-slate-100 cursor-default leading-5 rounded-xl shadow-sm italic">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-6 py-2.5 text-[10px] font-black uppercase tracking-widest text-slate-700 bg-white border border-slate-100 leading-5 rounded-xl hover:text-red-500 hover:border-red-200 transition-all duration-300 shadow-sm hover:shadow-lg italic">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-6 py-2.5 text-[10px] font-black uppercase tracking-widest text-slate-700 bg-white border border-slate-100 leading-5 rounded-xl hover:text-red-500 hover:border-red-200 transition-all duration-300 shadow-sm hover:shadow-lg italic">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-6 py-2.5 text-[10px] font-black uppercase tracking-widest text-slate-300 bg-white border border-slate-100 cursor-default leading-5 rounded-xl shadow-sm italic">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
