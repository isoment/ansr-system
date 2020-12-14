<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-start">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-gray-500 
                              bg-white border border-teal-300 cursor-default leading-5 rounded-tl-lg 
                              rounded-bl-lg">
                        Prev
                    </span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" 
                            class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 
                            bg-white border border-teal-300 leading-5 rounded-tl-lg rounded-bl-lg 
                            hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 
                            active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                        Prev
                    </button>
                @endif
            </span>

            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" 
                            class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 
                            bg-white border border-teal-300 leading-5 rounded-tr-lg rounded-br-lg hover:text-gray-500 
                            focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100
                            active:text-gray-700 transition ease-in-out duration-150">
                        Next
                    </button>
                @else
                    <span class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-gray-500 
                               bg-white border border-teal-300 cursor-default leading-5 rounded-tr-lg rounded-br-lg">
                        Next
                    </span>
                @endif
            </span>
        </nav>
    @endif
</div>