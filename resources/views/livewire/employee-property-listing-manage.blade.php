<div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm 
                    sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">

            <div class="pb-4">
                @include('inc.livewire-success')
            </div>
            
            <div class="relative">
                <h3 class="font-bold text-lg">Manage Listing</h3>
                <div class="absolute top-0 right-0"
                     wire:loading>
                    <i class="fas fa-spinner fa-spin text-xl text-teal-500"></i>
                </div>
            </div>
            <div class="mt-2"
                 x-data="{ showModal: false }">
                <button class="bg-red-400 text-white text-xs font-bold px-3 py-1 rounded-md 
                               hover:bg-red-500 transition duration-200 focus:outline-none"
                        @click="showModal = true">
                    Delete Listing
                </button>
                {{-- Modal --}}
                <div class="tenant-index-modal-background overflow-auto absolute inset-0 z-30 flex 
                            items-center justify-center whitespace-normal"
                        x-show="showModal"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform"
                        x-transition:enter-end="opacity-100 transform"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform"
                        x-transition:leave-end="opacity-0 transform"
                        x-cloak>
                    <div class="w-3/4 md:max-w-lg mx-auto rounded-md shadow-lg text-gray-700 whitespace-normal"
                            @click.away="showModal = false">
                        <div class="px-4 py-2 bg-white rounded-md text-center">
                            <h2 class="text-xl font-bold font-prompt my-4">Delete This Listing?</h2>
                            <button class="bg-red-400 py-2 px-4 rounded-md text-white text-sm hover:bg-red-500 
                                            transition duration-200 my-4" 
                                    wire:click="deleteListing"
                                    @click="showModal = false"
                            >
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>

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
                    @error('property')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="w-full mt-1">
                        <select name="property" required
                                class="text-sm pl-2 w-full border rounded py-2 bg-white focus:outline-none
                                      @error('property') border-orange-400 @enderror"
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
                        <input type="text" id="unit" name="unit" placeholder="Unit or Location"
                            class="px-4 w-full border rounded-lg py-2 text-gray-700 focus:outline-none
                                @error('unit') border-orange-400 @enderror" required 
                            wire:model.lazy="unit"/>
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
                    <div class="font-prompt text-lg -mr-4 z-10 input-icon-padding-6px">$</div>
                    <input type="number" id="rent" name="rent" min="1" max="100000" step="1" placeholder="Amount"
                        class="px-4 w-full border rounded-lg py-2 text-gray-700 focus:outline-none text-right
                            @error('rent') border-orange-400 @enderror" required 
                        wire:model.lazy="rent"/>
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
                        <input type="text" id="bedrooms" name="bedrooms" placeholder="Beds"
                            class="px-4 w-full border rounded-lg py-2 text-gray-700 focus:outline-none
                                @error('bedrooms') border-orange-400 @enderror" required 
                            wire:model.lazy="bedrooms"/>
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
                        <input type="text" id="bathrooms" name="bathrooms" placeholder="Baths"
                            class="pl-4 pr-4 w-full border rounded-lg py-2 text-gray-700 focus:outline-none
                                @error('bathrooms') border-orange-400 @enderror" required 
                            wire:model.lazy="bathrooms"/>
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
                        <input type="text" id="sqft" name="sqft" placeholder="Sqft"
                            class="pl-4 pr-4 w-full border rounded-lg py-2 text-gray-700 focus:outline-none
                                @error('sqft') border-orange-400 @enderror" required 
                            wire:model.lazy="sqft"/>
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
                    <textarea name="description" rows="7" placeholder="Description"
                        class="px-4 w-full border rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('description') border-orange-400 @enderror" required 
                        wire:model.lazy="description">
                    </textarea>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <div class="mt-6 mb-2 text-center">
                    <button class="bg-teal-300 py-2 px-4 rounded-md text-white hover:bg-teal-400
                                transition duration-200"
                            wire:click="updatePropertyListing">
                        Update Listing
                    </button>
                </div>
                <div class="flex flex-col items-center justify-center mt-3">
                    <div class="px-4 py-2 border border-teal-300 text-teal-300 rounded-md text-sm font-bold
                                cursor-pointer text-center"
                            @click="$refs.fileInput.click()">
                        Choose Images...
                    </div>
                    <input type="file" 
                            multiple 
                            class="hidden"
                            wire:model="images"
                            x-ref="fileInput">
                </div>
            </div>
                    
        </div>

        <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm max-height-property-image-upload
                    sm:rounded-md mb-4 py-6 px-4 shadow-sm flex flex-col">

            <div>
                <h4 class="font-bold text-lg text-center">Listing Images</h4>
            </div>

            <div class="my-2">
                @include('inc.livewire-error')
            </div>

            <div class="overflow-y-auto max-h-full">
                <div class="flex flex-wrap">
                    @foreach ($currentImages as $currentImage)
                    <div class="w-32 h-32 m-2 relative">
                        <img src="/storage/{{$currentImage->image}}"
                            class="h-full w-full object-cover rounded-md">
                        <i class="bg-white px-2 py-1 rounded-lg text-red-500 fas fa-times 
                                    absolute top-2 right-2 cursor-pointer"
                           wire:click="deleteCurrentImage({{$currentImage->id}})">
                        </i>
                    </div>
                    @endforeach
                    @if ($images)
                        @foreach ($images as $image)
                            <div class="w-32 h-32 m-2 relative"
                                    wire:key="{{$loop->index}}">
                                <img src="{{ $image->temporaryUrl() }}"
                                    class="h-full w-full object-cover rounded-md">
                                <i class="bg-white px-2 py-1 rounded-lg text-red-500 fas fa-times 
                                            absolute top-2 right-2 cursor-pointer"
                                    wire:click="removeImage({{$loop->index}})"></i>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>

    </div>

</div>

