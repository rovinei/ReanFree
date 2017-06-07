@if ($paginator->hasPages())
<div class="pagination">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="page gradient"><i class="fa fa-angle-double-left"></i> Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page gradient"><i class="fa fa-angle-double-left"></i> Previous</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="page active">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page gradient">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page gradient">Next <i class="fa fa-angle-double-right"></i></a>
        @else
            <span class="page gradient">Next <i class="fa fa-angle-double-right"></i></span>
        @endif

</div>
@endif

