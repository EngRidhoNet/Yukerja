<div class="flex justify-center mt-4">
    <nav aria-label="Pagination">
        <ul class="inline-flex -space-x-px">
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-3 py-2 text-gray-400 bg-gray-100 border border-gray-300 rounded-l-md cursor-not-allowed">Sebelumnya</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">Sebelumnya</a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="px-3 py-2 text-gray-400 bg-gray-100 border border-gray-300">{{ $element }}</span>
                    </li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="px-3 py-2 text-white bg-blue-600 border border-blue-600">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">Selanjutnya</a>
                </li>
            @else
                <li>
                    <span class="px-3 py-2 text-gray-400 bg-gray-100 border border-gray-300 rounded-r-md cursor-not-allowed">Selanjutnya</span>
                </li>
            @endif
        </ul>
    </nav>
</div>