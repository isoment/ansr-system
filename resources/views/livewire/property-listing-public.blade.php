<div class="pt-6 pb-12"
     x-data="{
         rentalTypeOpen: false,
         bathCountOpen: false,
         bedCountOpen: false,
         regionOpen: false,
         mobileFilterMenu: false,
     }">

    <div class="relative">
        {{-- Filter Bar --}}
        <div class="flex items-center justify-between mt-2">
            <h2 class="font-bold text-xl tracking tracking-widest text-gray-600">Available Properties</h2>
            
            {{-- Mobile Filter --}}
            <div class="md:hidden relative">
                <button class="flex items-center border border-gray-300 px-3 py-2 focus:outline-none
                               rounded-lg hover:border-gray-200 hover:bg-gray-200"
                        @click="mobileFilterMenu = !mobileFilterMenu">
                    <div>
                        <svg class="svg w-5 h-5" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <path d="M26.755 11.883a3.327 3.327 0 0 1 0 6.1v8.034h-2.66v-8.035a3.327 3.327 0 0 1 0-6.1V5.997h2.66v5.887zm-9.31 5.36a3.327 3.327 0 0 1 0 6.1v2.674h-2.66v-2.674a3.327 3.327 0 0 1 0-6.1V5.996h2.66v11.247zm-9.31-7.98a3.327 3.327 0 0 1 0 6.1v10.654h-2.66V15.363a3.327 3.327 0 0 1 0-6.1V5.996h2.66v3.267z" fill="#0694a2"></path>
                        </svg>
                    </div>
                    <div class="font-bold text-md ml-1">
                        Filter
                    </div>
                </button>

                {{-- Mobile filter menu --}}
                <div class="absolute right-0 top-12 bg-white z-10 w-72 sm:w-80 rounded-lg shadow-2xl
                            p-4"
                     x-show.transition="mobileFilterMenu"
                     x-cloak
                     @click.away="mobileFilterMenu = false">
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
                </div>
            </div>

            {{-- Desktop Filter --}}
            <div class="hidden md:block">
                <button class="border border-grey-600 text-gray-600 font-bold px-6 py-3 rounded-lg focus:outline-none
                            hover:bg-gray-200 hover:border-gray-200 transition duration-200 mr-2"
                        @click="regionOpen = !regionOpen">
                    Region
                </button>
                <button class="border border-grey-600 text-gray-600 font-bold px-6 py-3 rounded-lg focus:outline-none
                            hover:bg-gray-200 hover:border-gray-200 transition duration-200 mr-2"
                        @click="bedCountOpen = !bedCountOpen">
                    Beds
                </button>
                <button class="border border-grey-600 text-gray-600 font-bold px-6 py-3 rounded-lg focus:outline-none
                            hover:bg-gray-200 hover:border-gray-200 transition duration-200 mr-2"
                        @click="bathCountOpen = !bathCountOpen">
                    Baths
                </button>
                <button class="border border-grey-600 text-gray-600 font-bold px-6 py-3 rounded-lg focus:outline-none
                            hover:bg-gray-200 hover:border-gray-200 transition duration-200"
                        @click="rentalTypeOpen = !rentalTypeOpen">
                    Rental Type
                </button>
            </div>

        </div>

        {{-- Rental Type --}}
        <div class="px-6 py-4 rounded-lg absolute right-0 top-12 shadow-lg bg-white z-10"
             x-show.transition="rentalTypeOpen"
             x-cloak
             @click.away="rentalTypeOpen = false">
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

        {{-- Baths --}}
        <div class="rounded-lg absolute shadow-lg bg-white z-10 right-24 top-12"
             x-show.transition="bathCountOpen"
             x-cloak
             @click.away="bathCountOpen = false">
            <div class="py-2 px-2 flex items-center">
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

        {{-- Beds --}}
        <div class="rounded-lg absolute shadow-lg bg-white z-10 right-40 top-12"
             x-show.transition="bedCountOpen"
             x-cloak
             @click.away="bedCountOpen = false">
            <div class="py-2 px-2 flex items-center">
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

        {{-- Region --}}
        <div class="rounded-lg absolute shadow-lg bg-white z-10 right-0 top-12"
             x-show.transition="regionOpen"
             x-cloak
             @click.away="regionOpen = false">
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

    </div>

    <div class="flex justify-between items-center mt-6">
        <div>{{$properties->total()}} Rental Properties</div>
        <div class="flex items-center">
            <span class="mr-1 font-light tracking-wider">Sort:</span>
            <select name="sort" class="border bg-gray-50 border-gray-200 text-teal-600 rounded-md px-2"
                    wire:model="sortSelect">
                <option value="newest">Newest</option>
                <option value="price-lo-hi">Price (Lo-Hi)</option>
                <option value="price-hi-lo">Price (Hi-Lo)</option>
                <option value="square-feet">Square Feet</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">

        @foreach ($properties as $property)
        {{-- Property Card --}}
        <a href="{{route('property-listing-show', $property->id)}}">
            {{-- Background Image --}}
            <div class="h-48 rounded-lg relative"
                style="background-image: url('https://www.trulia.com/pictures/thumbs_3/zillowstatic/fp/23e98bb7154ed7532d6a1cc925b598a6-full.webp');
                    background-size: cover;
                    background-position: 50% 50%;">
                <div class="bg-white text-xs font-bold px-1 py-1 absolute top-2 left-2 rounded-lg">NEW</div>
            </div>
            {{-- Details --}}
            <div class="mt-3">
                <div class="flex items-center justify-between">
                    <h4 class="font-bold text-lg tracking-wider">${{$property->rent}}/mo</h4>
                    <h6 class="text-sm capitalize">{{$property->type}}</h6>
                </div>
                <div class="flex mt-1">
                    <div class="flex items-center mr-2">
                        <svg class="svg h-5 w-5" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.196 14.603h15.523v.027h1.995v10.64h-3.99v-4.017H9.196v4.017h-3.99V6.65h3.99v7.953zm2.109-1.968v-2.66h4.655v2.66h-4.655z" fill="#869099"></path>
                        </svg>
                        <span class="font-light">{{$property->bedrooms}}bd</span>
                    </div>
                    <div class="flex items-center mr-2">
                        <svg class="svg h-5 w-5" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.981 15.947H26.6v1.33a9.31 9.31 0 0 1-9.31 9.31h-2.66a9.31 9.31 0 0 1-9.31-9.31v-1.33h16.001V9.995a2.015 2.015 0 0 0-2.016-2.015h-.67c-.61 0-1.126.407-1.29.965a2.698 2.698 0 0 1 1.356 2.342H13.3a2.7 2.7 0 0 1 1.347-2.337 4.006 4.006 0 0 1 3.989-3.63h.67a4.675 4.675 0 0 1 4.675 4.675v5.952z" fill="#869099"></path>
                        </svg>
                        <span class="font-light">{{$property->bathrooms}}ba</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="svg h-5 w-5" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.748 21.276l-3.093-3.097v3.097h3.093zm12.852 5.32H10.655v.004h-5.32v-.004H5.32v-5.32h.015V5.32L26.6 26.596z" fill="#869099"></path>
                        </svg>
                        <span class="font-light">{{$property->sqft}} sqft</span>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="mb-1">{{$property->property->street}}</div>
                    @if ($property->unit)
                        <div class="mb-1">Unit {{$property->unit}}</div>
                    @endif
                    <div><span>{{$property->property->city}}, </span><span>{{$property->property->state}}</span></div>
                </div>
            </div>
        </a>
        @endforeach

    </div>

    <div class="mt-8">
        {{ $properties->links('vendor.livewire.pagination') }}
    </div>

</div>