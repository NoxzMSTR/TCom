<nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">
    <div class="text-center text-md-left mb-3 mb-md-0">Showing {{ $paginator->firstItem() }}{{ $paginator->lastItem() }}
        of {{ $paginator->total() }} results</div>
    <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">

        @foreach ($elements as $element)
            <!-- "Three Dots" Separator -->
            @if (is_string($element))
                <li class="page-item disabled">
                    <button href="#" class="page-link">{{ $element }}</button>
                </li>
            @endif

            <!-- Array Of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item"><a class="page-link current" wire:click="setPage({{ $page }})"
                                wire:loading.attr="disabled">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" wire:click="setPage({{ $page }})"
                                wire:loading.attr="disabled">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
</nav>
