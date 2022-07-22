@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled btn btn-sm"><a href="#!"><i class="material-icons text-white">chevron_left</i></a></li>
        @else
            <li class="btn btn-sm btn-info"><a href="{{ $paginator->previousPageUrl() }}"><i class="material-icons text-white">chevron_left</i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled btn btn-sm btn-info">{{ $element }}</li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active btn btn-sm"><a href="#!" class="text-white">{{$page}}</a></li>
                    @else
                        <li class="btn btn-sm btn-info"><a href="{{$url}}" class="text-white">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="btn btn-sm btn-info"><a href="{{ $paginator->nextPageUrl() }}"><i class="material-icons text-white">chevron_right</i></a></li>

        @else
            <li class="disabled btn btn-sm"><a href="#!"><i class="material-icons text-white">chevron_right</i></a></li>
        @endif
    </ul>
@endif
