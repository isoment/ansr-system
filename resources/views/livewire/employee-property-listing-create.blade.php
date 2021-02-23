<div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm 
                    sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">
            
            <h3 class="font-bold text-lg">New Rental Listing</h3>

            {{-- Region and Property --}}
            <div class="flex flex-col sm:flex-row items-center">
                <div class="w-full sm:w-1/2 mt-4 sm:mt-6">
                    <label for="region" class="text-xs text-gray-700 font-bold">Region:</label>
                    <div class="w-full mt-1">
                        <select name="region" required
                                class="text-sm pl-2 w-full border rounded py-2 bg-white focus:outline-none"
                                wire:model="region">
                            @foreach ($regions as $region)
                                <option value="{{$region}}">{{$region}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-6">
                    <label for="property" class="text-xs text-gray-700 font-bold">Property:</label>
                    <div class="w-full mt-1">
                        <select name="property" required
                                class="text-sm pl-2 w-full border rounded py-2 bg-white focus:outline-none"
                                wire:model="property">
                            @foreach ($properties as $property)
                                <option value="{{$property}}">{{$property}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Type and Availability --}}
            <div class="flex flex-col sm:flex-row items-center">
                <div class="w-full sm:w-1/2 mt-4 sm:mt-6">
                    <label for="type" class="text-xs text-gray-700 font-bold">Property Type:</label>
                    <div class="w-full mt-1">
                        <select name="type" required
                                class="text-sm pl-2 w-full border rounded py-2 bg-white focus:outline-none"
                                wire:model="type">
                            <option value="apartment">Apartment</option>
                            <option value="house">House</option>
                            <option value="townhouse">Townhouse</option>
                        </select>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-6">
                    <label for="available" class="text-xs text-gray-700 font-bold">Available:</label>
                    <div class="w-full mt-1">
                        <select name="available" required
                                class="text-sm pl-2 w-full border rounded py-2 bg-white focus:outline-none"
                                wire:model="available">
                            <option value="1">Available</option>
                            <option value="0">Unavailable</option>
                        </select>
                    </div>
                </div>
            </div>

            @if ($type === 'apartment' || $type === 'townhouse')
                {{-- Unit --}}
                <div class="w-full mt-4 sm:mt-6">
                    <div class="flex justify-between items-center w-full">
                        <label for="unit" class="text-xs text-gray-700 font-bold">Unit:</label>
                        @error('unit')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="text" id="unit" name="unit"
                            class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('unit') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="unit"/>
                    </div>
                </div>
            @endif

            {{-- Rent --}}
            <div class="w-full mt-4 sm:mt-6">
                <div class="flex justify-between items-center w-full">
                    <label for="rent" class="text-xs text-gray-700 font-bold">Rent:</label>
                    @error('rent')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <div class="font-prompt text-lg mr-2 z-10 input-icon-padding-6px">$</div>
                    <input type="number" id="rent" name="rent" min="1" max="100000" step="1"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none text-right
                            @error('rent') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="rent"/>
                </div>
            </div>

            {{-- Bd Ba Sqft --}}
            <div class="flex flex-col sm:flex-row items-center">
                <div class="w-full sm:w-1/3 mt-4 sm:mt-6">
                    <div class="flex flex-col w-full">
                        <label for="bedrooms" class="text-xs text-gray-700 font-bold">Bedrooms:</label>
                        @error('bedrooms')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="text" id="bedrooms" name="bedrooms"
                            class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('bedrooms') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="bedrooms"/>
                    </div>
                </div>
                <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-6">
                    <div class="flex flex-col w-full">
                        <label for="bathrooms" class="text-xs text-gray-700 font-bold">Bathrooms:</label>
                        @error('bathrooms')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }} 
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="text" id="bathrooms" name="bathrooms"
                            class="pl-4 pr-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('bathrooms') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="bathrooms"/>
                    </div>
                </div>
                <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-6">
                    <div class="flex flex-col w-full">
                        <label for="sqft" class="text-xs text-gray-700 font-bold">Squarefeet:</label>
                        @error('sqft')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }} 
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="text" id="sqft" name="sqft"
                            class="pl-4 pr-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('sqft') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="sqft"/>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div class="w-full mt-4 sm:mt-6">
                <div class="flex justify-between items-center w-full">
                    <label for="description" class="text-xs text-gray-700 font-bold">Description:</label>
                    @error('description')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <textarea name="description" rows="5"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('description') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="description">
                    </textarea>
                </div>
            </div>

            <div class="mt-6 mb-2 text-center">
                <button class="bg-teal-300 py-2 px-4 rounded-md text-white hover:bg-teal-400
                            transition duration-200"
                        wire:click="createListing">
                    Create Listing
                </button>
            </div>
                    
        </div>

        <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm 
                    sm:rounded-md mb-4 py-6 px-4 shadow-sm">
            <h3 class="font-bold text-lg text-center">Photos</h3>

        </div>

    </div>

</div>
