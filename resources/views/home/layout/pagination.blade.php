@if ($paginator->hasPages())
    <div class="pager fr">
        @if ($paginator->onFirstPage())
            <span class="page-numbers">{{ __('pagination.previous') }}</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                <span class="page-numbers">{{ __('pagination.previous') }}</span>
            </a>
        @endif

        @php
        $lastPage = $paginator->lastPage()
        @endphp
        @for ($i = 1; $i <= $lastPage; $i++)
            @if ($i == $paginator->currentPage())
                <span class="page-numbers current">{{ $i }}</span>
            @else
                <a href="{{ $paginator->url($i) }}"><span class="page-numbers">{{ $i }}</span></a>
            @endif
        @endfor

        {{-- next page link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                <span class="page-numbers">{{ __('pagination.next') }}</span>
            </a>
        @else
            <span class="page-numbers">{{ __('pagination.next') }}</span>
        @endif
    </div>
@endif
