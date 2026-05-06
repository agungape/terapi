@if ($paginator->hasPages())
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 p-5 bg-slate-50/50 border border-slate-100 rounded-2xl shadow-sm">
        <div class="text-[10px] font-black uppercase tracking-widest text-slate-400">
            {!! __('Showing') !!} 
            <span class="text-slate-800 italic">{{ $paginator->firstItem() }}</span> 
            {!! __('to') !!} 
            <span class="text-slate-800 italic">{{ $paginator->lastItem() }}</span> 
            {!! __('of') !!} 
            <span class="text-slate-800 italic">{{ $paginator->total() }}</span> 
            {!! __('results') !!}
        </div>

        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-1 w-full md:w-auto overflow-x-auto md:overflow-x-visible justify-center py-2 md:py-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-300 rounded-xl cursor-not-allowed shrink-0">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-600 rounded-xl hover:text-red-500 hover:border-red-100 hover:shadow-md transition-all shrink-0">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="w-10 h-10 flex items-center justify-center text-slate-300">...</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="w-10 h-10 flex items-center justify-center bg-red-500 text-white font-black text-xs rounded-xl shadow-lg shadow-red-100 italic shrink-0">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-600 font-bold text-xs rounded-xl hover:text-red-500 hover:border-red-100 hover:shadow-md transition-all shrink-0">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-600 rounded-xl hover:text-red-500 hover:border-red-100 hover:shadow-md transition-all shrink-0">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </a>
            @else
                <span class="w-10 h-10 flex items-center justify-center bg-white border border-slate-100 text-slate-300 rounded-xl cursor-not-allowed shrink-0">
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </span>
            @endif
        </nav>
    </div>
@endif
