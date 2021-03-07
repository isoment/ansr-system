<div>

    <div class="break-words bg-white text-gray-700 sm:border-1 
                rounded-sm sm:rounded-md mb-4 py-3 px-2 md:px-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
            <h3 class="text-xl font-bold font-prompt tracking-wider text-gray-700">Select Property</h3>
            <div class="mt-3 sm:mt-0">
                <label for="search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input wire:model="propertySearch"
                        id="search"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white 
                             placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 
                               focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out"
                        placeholder="Search street, city or zip" 
                        type="search">
                </div>
            </div>
        </div>
        <div class="flex flex-wrap justify-center my-6 text-xxs sm:text-xs">
            @foreach ($properties as $property)
                <div class="m-2 border border-orange-300 py-1 px-2 rounded-md cursor-pointer"
                     wire:click="setProperty({{$property}})">
                    {{$property->street}}, {{$property->city}} {{$property->zipcode}}
                </div>
            @endforeach
        </div>
    </div>

    @if (!is_null($selectedProperty))
        <div>
            <div class="my-6 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold font-prompt tracking-wider text-gray-700">Service Requests</h3>
                    <div class="text-xs font-bold mt-1 text-gray-500">{{$selectedProperty['street']}}, {{$selectedProperty['city']}} {{$selectedProperty['zipcode']}}</div>
                </div>
                <div class="mt-3 sm:mt-0">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model="unitSearch" name="search"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white 
                                placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 
                                focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out"
                            placeholder="Search unit" 
                            type="search">
                    </div>
                </div>
            </div>

            <div class="text-gray-700 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @if ($serviceRequests->isEmpty())
                    <div class="text-sm">No service requests for this property</div>
                @else
                    @foreach ($serviceRequests as $request)
                    <div>
                        <div class="h-full flex flex-col justify-between shadow-md rounded-lg py-4 px-6 bg-white">
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <div class="text-lg font-bold font-prompt">
                                        ID: {{$request->id}}
                                    </div>
                                    <div class="mb-2 text-right">
                                        @if ($request->completed_date)
                                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs 
                                                        font-medium leading-4 bg-teal-100 text-teal-400">
                                                Active
                                            </div>
                                        @else
                                            <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    bg-green-100 text-green-400">
                                                Completed
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="font-bold text-xs mb-1">Property:</div>
                                    <div class="font-light text-sm">{{$request->lease->property->street}}</div>
                                    <div class="font-light text-sm">{{$request->lease->property->city}}, {{$request->lease->property->state}}</div>
                                </div>
                                <div class="mb-2 flex items-center">
                                    <div class="font-bold text-xs mr-1">Unit:</div>
                                    @if ($request->lease->unit)
                                        <div class="font-light text-xs">{{$request->lease->unit}}</div>
                                    @else
                                        <div class="font-light text-md">N/A</div>
                                    @endif
                                </div>
                                <div class="mb-2">
                                    <div class="font-bold text-xs mb-1">Issue:</div>
                                    <div class="font-light text-md">{{Str::limit($request->issue, 25)}}</div>
                                </div>
                            </div>
                            <a href="{{route('employee.manage-request', $request->id)}}" class="text-gray-500 font-bold flex items-center justify-end">
                                <i class="fas fa-external-link-alt text-sm mr-1"></i>
                                <div class="font-prompt text-sm">Goto Request</div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @endif
                
            </div>

            <div class="flex justify-between items-center">
                <div class="my-4">
                    {{ $serviceRequests->links('vendor.livewire.pagination') }}
                </div>
            </div>

        </div>
    @else
        <div class="my-4 text-lg font-bold text-center">Please Select A Property</div>
    @endif
    

</div>
