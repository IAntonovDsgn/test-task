@if ($paginator->hasPages())
    <ul class="pages">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <img src="{{ asset('image/arrow-today.svg') }}" alt="prev-page-arrow">
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><img src="{{ asset('image/arrow-today.svg') }}" alt="prev-page-arrow"></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active page" aria-current="page"><span>{{ $page }}</span></li>
                    @else
                        <li class="page"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><img src="{{ asset('image/arrow-today-right.svg') }}" alt="next-page-arrow"></a>
        @else
            <img src="{{ asset('image/arrow-today-right.svg') }}" alt="next-page-arrow">
        @endif
    </ul>
@endif
