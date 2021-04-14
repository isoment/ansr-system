<div class="flex flex-col mt-12"
     x-data="{ filterOpen: false }">

    <div class="flex items-end justify-between">
        {{-- Search --}}
        <div class="max-w-lg w-full lg:max-w-xs mb-0">
            <h5 class="font-bold text-xs mb-2 ml-2 text-gray-600">Search Address</h5>
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
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 
                          bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 
                           focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out"
                    placeholder="Search" 
                    type="search">
            </div>
        </div>

        {{-- Filter --}}
        <div class="relative">

            <button class="flex items-center border border-gray-300 px-3 py-2 focus:outline-none
                        rounded-lg hover:border-gray-200 hover:bg-gray-200 ml-2"
                    @click="filterOpen = !filterOpen">
                <div>
                    <svg class="svg w-5 h-5" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.755 11.883a3.327 3.327 0 0 1 0 6.1v8.034h-2.66v-8.035a3.327 3.327 0 0 1 0-6.1V5.997h2.66v5.887zm-9.31 5.36a3.327 3.327 0 0 1 0 6.1v2.674h-2.66v-2.674a3.327 3.327 0 0 1 0-6.1V5.996h2.66v11.247zm-9.31-7.98a3.327 3.327 0 0 1 0 6.1v10.654h-2.66V15.363a3.327 3.327 0 0 1 0-6.1V5.996h2.66v3.267z" fill="#0694a2"></path>
                    </svg>
                </div>
                <div class="font-bold text-md ml-1 text-gray-700">
                    Filter
                </div>
            </button>

            {{-- Filter Menu --}}
            <div class="absolute right-2 top-12 bg-white z-10 w-72 sm:w-80 rounded-lg shadow-2xl
                        p-4"
                 x-show.transition="filterOpen"
                 x-cloak
                 @click.away="filterOpen = false">

                @can('isManagement')
                    {{-- Region --}}
                    <div class="my-4">
                    <h4 class="text-gray-400 font-md text">Region:</h4>
                    <div class="py-2 px-2 max-w-sm">
                        <div class="flex items-center flex-wrap justify-center">
                            <button class="border border-teal-500 hover:bg-teal-500 text-sm font-semibold
                                            hover:border-teal-500 hover:text-white transition duration-200 
                                            p-1 rounded-md m-1 focus:outline-none
                                            {{$regionToFilter === 'All' ? 'bg-teal-500 text-white' : 'text-teal-500'}}
                                            "
                                    wire:click="regionFilter('All')">
                                All
                            </button>
                            @foreach ($regions as $region)
                                <button class="border border-teal-500 hover:bg-teal-500 text-sm font-semibold
                                                hover:border-teal-500 hover:text-white transition duration-200 
                                                p-1 rounded-md m-1 focus:outline-none
                                                {{$regionToFilter === $region ? 'bg-teal-500 text-white' : 'text-teal-500'}}
                                                "
                                        wire:click="regionFilter('{{$region}}')">
                                    {{$region}}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endcan

                {{-- Bedrooms --}}
                <div class="my-4">
                    <h4 class="text-gray-400 font-md text">Bedrooms:</h4>
                    <div class="py-2 px-2 flex items-center justify-center">
                        <button class="px-4 py-3 border rounded-tl-lg 
                                        rounded-bl-lg font-bold focus:outline-none
                                        {{$bedCount === 1 ? 'border-teal-500 bg-teal-500 text-white' : 'border-gray-300'}}
                                        "
                                wire:click="filterBeds(1)">
                            1+
                        </button>
                        <button class="px-3 py-3 border-t border-b font-bold focus:outline-none
                                        {{($bedCount === 2) ? 'border-teal-500 bg-teal-500 text-white' : 'border-gray-300'}}
                                        "
                                wire:click="filterBeds(2)">
                            2+
                        </button>
                        <button class="px-3 py-3 border-t border-b border-l font-bold focus:outline-none
                                        {{($bedCount === 3) ? 'border-teal-500 bg-teal-500 text-white' : 'border-gray-300'}}
                                        "
                                wire:click="filterBeds(3)">
                            3+
                        </button>
                        <button class="px-3 py-3 border-t border-b border-l border-r rounded-r-lg border-gray-300 
                                        font-bold focus:outline-none
                                        {{($bedCount === 4) ? 'border-teal-500 bg-teal-500 text-white' : 'border-gray-300'}}
                                        "
                                wire:click="filterBeds(4)">
                            4+
                        </button>
                    </div>
                </div>

                {{-- Bathrooms --}}
                <div class="my-4">
                    <h4 class="text-gray-400 font-md text">Bathrooms:</h4>
                    <div class="py-2 px-2 flex items-center justify-center">
                        <button class="px-4 py-3 border rounded-tl-lg rounded-bl-lg font-bold focus:outline-none
                                        {{$bathCount === 1 ? 'border-teal-500 bg-teal-500 text-white' : 'border-gray-300'}}
                                        "
                                wire:click="filterBaths(1)">
                            1+
                        </button>
                        <button class="px-3 py-3 border-t border-b font-bold focus:outline-none
                                        {{($bathCount === 2) ? 'border-teal-500 bg-teal-500 text-white' : 'border-gray-300'}}
                                        "
                                wire:click="filterBaths(2)">
                            2+
                        </button>
                        <button class="px-3 py-3 border-t border-b border-l border-r rounded-r-lg border-gray-300 
                                        font-bold focus:outline-none
                                        {{($bathCount === 3) ? 'border-teal-500 bg-teal-500 text-white' : 'border-gray-300'}}
                                        "
                                wire:click="filterBaths(3)">
                            3+
                        </button>
                    </div>
                </div>

                {{-- Rental Type --}}
                <div class="my-4">
                    <h4 class="text-gray-400 font-md text">Rental Type:</h4>
                    <div>
                        <div class="flex items-center my-3">
                            <input type="checkbox" name="apartment"
                                    class="form-checkbox text-teal-300 h-5 w-5 mr-1"
                                    wire:model="types.apartment">
                            <label for="apartment">Apartment</label>
                        </div>
                        <div class="flex items-center my-3">
                            <input type="checkbox" name="house"
                                    class="form-checkbox h-5 w-5 text-teal-300 mr-1"
                                    wire:model="types.house">
                            <label for="house">House</label>
                        </div>
                        <div class="flex items-center my-3">
                            <input type="checkbox" name="townhouse"
                                    class="form-checkbox h-5 w-5 text-teal-300 mr-1"
                                    wire:model="types.townhouse">
                            <label for="town-house">Townhouse</label>
                        </div>
                    </div>
                </div>

                {{-- Availability --}}
                <div class="mb-4 mt-6">
                    <h4 class="text-gray-400 font-md text">Rental Type:</h4>
                    <select class="bg-white px-3 py-2 rounded-lg mt-1 border border-gray-300
                                    focus:outline-none w-full" 
                            name="availability"
                            wire:model="availabilityInput">
                        <option value="all">All</option>
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>

            </div>
        </div>
    </div>

    {{-- <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mt-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left">
                                <div class="flex items-center">
                                    <div class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Property</div>
                                </div>
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left">
                                <div class="flex items-center">
                                    <div class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Type</div>
                                </div>
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left">
                                <div class="flex items-center">
                                    <div class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Bed/Bath</div>
                                </div>
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left">
                                <div class="flex items-center">
                                    <div class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Rent</div>
                                </div>
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Available
                            </th>
                            <th class="px-6 py-3 bg-gray-50"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($properties as $property)
                            <tr>
                                <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                    <div class="flex flex-col">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                {{$property->property->street}} {{$property->unit ? 'Unit ' . $property->unit : ''}}
                                            </div>
                                            <div class="text-xs font-thin">
                                                {{$property->property->city}}, {{$property->property->state}} {{$property->property->zipcode}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                            <div class="text-sm leading-5 font-medium text-gray-900 capitalize">
                                                {{$property->type}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                {{$property->bedrooms}}bed / {{$property->bathrooms}}bath
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">
                                        ${{number_format($property->rent)}}/mo
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    @if ($property->available)
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 text-teal-400">
                                            Available
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-red-100 text-red-400">
                                            Unavailable
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <a href="{{route('employee.property-listing-manage', $property->id)}}"
                                       class="text-teal-400 hover:text-teal-600 cursor-pointer">Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    <div class="w-full overflow-hidden rounded-lg shadow-xs my-4">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase 
                              border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">
                            Property
                        </th>
                        <th class="px-4 py-3">
                            Type
                        </th>
                        <th class="px-4 py-3">
                            Bed/Bath
                        </th>
                        <th class="px-4 py-3">
                            Available
                        </th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($properties as $property)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                <div class="flex flex-col">
                                    <div class="text-sm leading-5 font-medium text-gray-900">
                                        {{Str::limit($property->property->street, 20, '...')}} {{$property->unit ? 'Unit ' . $property->unit : ''}}
                                    </div>
                                    <div class="text-xs font-thin">
                                        {{$property->property->city}}, {{$property->property->state}} {{$property->property->zipcode}}
                                    </div>
                                </div>
                            </div>
                            </td>
                            <td class="px-2 py-3 text-sm capitalize">
                                {{$property->type}}
                            </td>
                            <td class="px-2 py-3">
                                {{$property->bedrooms}}bed / {{$property->bathrooms}}bath
                            </td>
                            <td class="px-2 py-3">
                                @if ($property->available)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 text-teal-400">
                                        Available
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-red-100 text-red-400">
                                        Unavailable
                                    </span>
                                @endif
                            </td>
                            <td class="px-2 py-3 text-sm">
                                <a href="{{route('employee.property-listing-manage', $property->id)}}"
                                    class="text-teal-400 hover:text-teal-600 cursor-pointer">Details</a>
                            </td>
                        </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-between items-center">
        <div class="my-4">
            {{ $properties->links('vendor.livewire.pagination') }}
        </div>
    </div>

</div>

