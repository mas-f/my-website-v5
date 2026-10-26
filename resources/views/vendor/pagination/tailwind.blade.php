@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navigasi halaman" class="pagination">
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="Halaman sebelumnya">Sebelumnya</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Halaman sebelumnya" class="cursor-pointer">Sebelumnya</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span aria-disabled="true">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="active" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="cursor-pointer">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Halaman berikutnya" class="cursor-pointer">Berikutnya</a>
        @else
            <span aria-disabled="true" aria-label="Halaman berikutnya">Berikutnya</span>
        @endif
    </nav>
@endif
