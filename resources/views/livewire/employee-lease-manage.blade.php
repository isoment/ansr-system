<div>
    
    <div class="mt-4 mb-2 flex flex-col sm:flex-row sm:justify-between sm:items-center"
         x-data="{ leaseCreateModal: @entangle('showCreateModal') }">
        <div class="flex items-center">
            <div class="bg-teal-300 px-1 font-bold text-lg rounded-md mr-2 text-white cursor-pointer"
                 @click="leaseCreateModal = true">
                +
            </div>

                {{-- Modal --}}
                <div class="tenant-index-modal-background overflow-auto absolute inset-0 z-30 flex 
                            items-center justify-center whitespace-normal"
                        x-show="leaseCreateModal"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform"
                        x-transition:enter-end="opacity-100 transform"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform"
                        x-transition:leave-end="opacity-0 transform"
                        x-cloak>
                    <div class="w-3/4 md:max-w-lg mx-auto rounded-md shadow-lg text-gray-700 whitespace-normal"
                            @click.away="leaseCreateModal = false">
                        <div class="px-4 py-2 bg-white rounded-md text-center">
                            <h2 class="text-xl font-bold font-prompt my-4">Create New Lease</h2>
                            <div>
                                <div>
                                    <input type="text" class="border rounded-lg bg-white px-2 py-1 focus:outline-none w-full"
                                           placeholder="Search properties"
                                           wire:model.debounce.500ms="propertySearch">
                                    <div class="text-xs top-10 right-0">
                                        @if ($propertyResult->count() > 0)
                                            <div class="flex flex-wrap justify-center mt-3">
                                                @foreach ($propertyResult as $property)
                                                    <div class="border rounded-md border-orange-300 p-1 my-1 mx-1 cursor-pointer"
                                                         wire:click="setProperty({{$property}})">
                                                        {{$property->street}}, {{$property->city}}
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="mt-3">No Results</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="my-2">
                                    @error('selectedProperty')
                                        <div class="text-orange-400 text-xs font-bold italic sm:text-left mb-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="flex flex-col sm:flex-row items-center text-xs text-gray-700 font-bold">
                                        <div class="mr-1">Selected Property:</div>
                                        <div class="text-orange-400">{{isset($selectedProperty) ? $selectedProperty['street'] . ', ' . $selectedProperty['city'] : 'N/A'}}</div>
                                    </div>
                                </div>
                                <div class="w-full mt-4">
                                    <div class="flex justify-between items-center w-full">
                                        <label for="unit" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Unit:</label>
                                        @error('unit')
                                            <div class="text-orange-400 text-xs font-bold italic">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <input type="text" id="unit" name="unit"
                                            class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                                @error('unit') border-orange-400 @enderror" required 
                                            wire:model.debounce.500ms="unit"/>
                                    </div>
                                </div>
                                <div class="w-full mt-4">
                                    <div class="flex justify-between items-center w-full">
                                        <label for="startDate" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Start Date:</label>
                                        @error('startDate')
                                            <div class="text-orange-400 text-xs font-bold italic">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <input type="date" id="startDate" name="startDate"
                                            class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                                @error('startDate') border-orange-400 @enderror" required 
                                            wire:model.debounce.500ms="startDate"/>
                                    </div>
                                </div>
                                <div class="w-full mt-4">
                                    <div class="flex justify-between items-center w-full">
                                        <label for="endDate" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>End Date:</label>
                                        @error('endDate')
                                            <div class="text-orange-400 text-xs font-bold italic">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <input type="date" id="endDate" name="endDate"
                                            class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                                @error('endDate') border-orange-400 @enderror" required 
                                            wire:model.debounce.500ms="endDate"/>
                                    </div>
                                </div>
                            </div>
                            <button class="bg-red-400 py-2 px-4 rounded-md text-white text-sm hover:bg-red-500 
                                            transition duration-200 my-4" 
                                    wire:click="createLease">
                                Create
                            </button>
                        </div>
                    </div>

                </div>

            <h3 class="text-2xl font-bold font-prompt tracking-wider text-gray-700">Property Leases</h3>
        </div>
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

    <div class="text-sm font-thin">
        To create a new tenant first select a lease
    </div>

    <div class="my-2">
        @include('inc.livewire-success')
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
                        <div class="flex items-center">
                            <div class="font-light text-md">
                                {{\Carbon\Carbon::parse($lease->end_date)->toFormattedDateString()}}
                            </div>
                            <div class="ml-2"
                                 >
                                <i class="far fa-edit text-sm text-orange-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{route('employee.lease-show', $lease->id)}}" class="text-gray-500 font-bold flex items-center justify-end">
                    <i class="fas fa-external-link-alt text-sm mr-1"></i>
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
