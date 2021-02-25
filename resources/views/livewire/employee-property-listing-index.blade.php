<div class="flex flex-col mt-12"
     x-data="{ filterOpen: false }">

    <div class="flex items-end justify-between">
        {{-- Search --}}
        <div class="max-w-lg w-full lg:max-w-xs mb-0">
            <h5 class="font-bold text-xs mb-2 ml-2 text-gray-600">Search by...</h5>
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
                        rounded-lg hover:border-gray-200 hover:bg-gray-200"
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
            <div class="absolute right-0 top-12 bg-white z-10 w-72 sm:w-80 rounded-lg shadow-2xl
                        p-4"
                 x-show.transition="filterOpen"
                 x-cloak
                 @click.away="filterOpen = false">
                TEST
            </div>

        </div>
    </div>
    
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
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
                                    <a href=""
                                       class="text-teal-400 hover:text-teal-600 cursor-pointer">Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="flex justify-between items-center">
        <div class="my-4">
            {{ $properties->links('vendor.livewire.pagination') }}
        </div>
    </div>

</div>

