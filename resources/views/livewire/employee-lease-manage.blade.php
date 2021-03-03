<div>
    
    <div class="my-4 flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <h3 class="text-2xl font-bold text-gray-500">Property Leases</h3>
        <div class="mt-2 sm:mt-0">
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input wire:model="search"
                    id="search"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white 
                         placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 
                           focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out"
                    placeholder="Search by id, address, city" 
                    type="search">
            </div>
        </div>
    </div>

    <section class="text-gray-700 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">

        @foreach ($leases as $lease)
        <div>
            <div class="h-full flex flex-col justify-between shadow-md rounded-lg py-4 px-6 bg-white">
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <div class="text-lg font-bold font-prompt">
                            ID: {{$lease->id}}
                        </div>
                        <div class="mb-2 text-right">
                            @if ($lease->leaseIsActive())
                                <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs 
                                            font-medium leading-4 bg-green-100 text-green-400">
                                    Active
                                </div>
                            @else
                                <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        bg-red-100 text-red-400">
                                    Ended
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="font-bold text-xs mb-1">Property:</div>
                        <div class="font-light text-sm">{{$lease->property->street}}</div>
                        <div class="font-light text-sm">{{$lease->property->city}}, {{$lease->property->state}}</div>
                    </div>
                    <div class="mb-2">
                        <div class="font-bold text-xs mb-1">Start Date:</div>
                        <div class="font-light text-md">{{\Carbon\Carbon::parse($lease->start_date)->toFormattedDateString()}}</div>
                    </div>
                    <div class="mb-2">
                        <div class="font-bold text-xs mb-1">End Date:</div>
                            <div class="font-light text-md">{{\Carbon\Carbon::parse($lease->end_date)->toFormattedDateString()}}</div>
                    </div>
                </div>
                <a href="#" class="text-teal-300 font-bold flex items-center justify-end">
                    <i class="fas fa-link text-sm mr-1"></i>
                    <div class="font-prompt text-sm">Lease</div>
                </a>
            </div>
        </div>
        @endforeach

    </section>

    <div class="flex justify-between items-center">
        <div class="my-4">
            {{ $leases->links('vendor.livewire.pagination') }}
        </div>
    </div>

</div>
