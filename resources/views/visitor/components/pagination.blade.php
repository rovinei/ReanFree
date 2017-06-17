@if ($paginator->hasPages())
<!-- Pagination -->
<div class="pagination">
    <ul class="uk-flex uk-flex-inline uk-flex-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li>
            <a href="" class="paginator__prev disable paginator__item">
                <i class="fa fa-angle-double-left"></i>
                Previous
            </a>
        </li>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" class="paginator__prev paginator__item">
                <i class="fa fa-angle-double-left"></i>
                Previous
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li>
                <a class="paginator__item disable">
                    <i class="fa fa-ellipsis-h"></i>
                </a>
            </li>
            @endif

            {{-- Array Of Links --}}
            @if(is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <li class="current">
                        <a class="paginator__item current">
                            {{ $page }}
                        </a>
                    </li>
                    @else
                    <li>
                        <a href="{{ $url }}" class="paginator__item">
                            {{ $page }}
                        </a>
                    </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" class="paginator__next paginator__item">
                Next
                <i class="fa fa-angle-double-right"></i>
            </a>
        </li>
        @else
        <li>
            <a href="" class="paginator__next disable paginator__item">
                Next
                <i class="fa fa-angle-double-right"></i>
            </a>
        </li>
        @endif
    </ul>
</div>
<!-- /Pagination -->
@endif
