@if ($paginator->hasPages())
<div class="w-100 d-flex justify-content-center">
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{-- <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li> --}}
                <li class="page-item disabled">
                    <a class="page-link shadow" href="#" tabindex="-1" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <i data-acorn-icon="chevron-left" aria-hidden="true">&lsaquo;</i>
                    </a>
                </li>
            @else
                {{-- <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li> --}}
                <li class="page-item">
                    <a class="page-link shadow" href="{{ $paginator->previousPageUrl() }}" rel="prev" tabindex="-1" aria-label="@lang('pagination.previous')">
                        <i data-acorn-icon="chevron-left">&lsaquo;</i>
                    </a>
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
                            <li class="page-item active" aria-current="page">
                                {{-- <span>{{ $page }}</span> --}}
                                <a class="page-link shadow" href="#">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link shadow" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                {{-- <li class="page-item">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li> --}}
                <li class="page-item">
                    <a class="page-link shadow" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i data-acorn-icon="chevron-right">&rsaquo;</i>
                    </a>
                </li>
            @else
                {{-- <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li> --}}
                <li class="page-item disable" >
                    <a class="page-link shadow" href="#" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <i data-acorn-icon="chevron-right" aria-hidden="true">&rsaquo;</i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>
@endif