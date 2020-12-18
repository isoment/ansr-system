<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-start">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-gray-500 
                              bg-gray-100 border border-gray-300 cursor-default leading-5 rounded-tl-lg 
                              rounded-bl-lg mr-1">
                        Prev
                    </span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" 
                            class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-white
                            bg-teal-300 border border-teal-300 leading-5 rounded-tl-lg rounded-bl-lg 
                            hover:bg-teal-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 
                            active:bg-teal-100 active:text-teal-500 transition ease-in-out duration-150 mr-1">
                        Prev
                    </button>
                @endif
            </span>

            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" 
                            class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-white 
                            bg-teal-300 border border-teal-300 leading-5 rounded-tr-lg rounded-br-lg hover:bg-teal-400 
                            focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-teal-100
                            active:text-teal-500 transition ease-in-out duration-150">
                        Next
                    </button>
                @else
                    <span class="relative inline-flex items-center px-2 py-1 text-xs font-medium text-gray-500 
                               bg-gray-100 border border-gray-300 cursor-default leading-5 rounded-tr-lg rounded-br-lg">
                        Next
                    </span>
                @endif
            </span>
        </nav>
    @endif
</div>