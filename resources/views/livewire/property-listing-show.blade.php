<div>

    <div class="flex justify-between">
        <a href="{{route('property-listings')}}"
            class="flex items-center text-teal-500">
            <i class="fas fa-arrow-left text-sm"></i>
            <span class="font-bold text-sm ml-1">Back to Listing</span>
        </a>
        <div class="hidden sm:flex items-center text-sm ml-12">
            <div>For Rent</div>
            <div class="font-bold text-teal-500 mx-2">/</div>
            <div>{{$propertyListing->property->region->region_name}}</div>
        </div>
    </div>

    {{-- Images --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-4 my-4">
        <div class="col-span-2 p-4 bg-white shadow-md rounded-md max-height-property-image-box 
                    flex items-center justify-center">
            <img src="/storage/{{$currentImage}}"
                 class="max-w-full max-height-property-image">
        </div>
        <div class="col-span-1 mt-4 lg:mt-0 p-4 text-center bg-white shadow-md rounded-md max-height-property-images
                    justify-center">
            <div class="overflow-y-auto max-h-full">
                <div class="flex flex-wrap">
                    @foreach ($photos as $photo)
                        <div class="image-thumbnail-property-gallery m-2 cursor-pointer"
                             wire:click="selectImage({{$photo->id}})">
                            <img src="/storage/{{$photo->image}}"
                                class="h-full w-full object-cover rounded-md">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-4 my-4">
        <div class="col-span-2 p-4 lg:ml-2">
            <div class="flex flex-col lg:flex-row justify-between">
                <div>
                    <div class="text-lg md:text-2xl font-bold">
                        {{$propertyListing->property->street}}
                    </div>
                    @if ($propertyListing->unit)
                        <div class="font-thin mt-1">
                            Unit {{$propertyListing->unit}}
                        </div>
                    @endif
                    <div class="font-thin mt-1">
                        {{$propertyListing->property->city}}, {{$propertyListing->property->state}} {{$propertyListing->property->zipcode}}
                    </div>
                    <div class="my-4 flex flex-col md:flex-row md:items-center">
                        <div class="flex items-center">
                            <div>
                                <svg class="svg w-5 h-5" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.196 14.603h15.523v.027h1.995v10.64h-3.99v-4.017H9.196v4.017h-3.99V6.65h3.99v7.953zm2.109-1.968v-2.66h4.655v2.66h-4.655z" fill="#869099"></path>
                                </svg>
                            </div>
                            <div class="ml-1">{{$propertyListing->bedrooms}} {{$propertyListing->isPlural($propertyListing->bedrooms) ? 'Beds' : 'Bed'}}</div>
                        </div>
                        <div class="flex items-center md:ml-2">
                            <div>
                                <svg class="svg w-5 h-5" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.981 15.947H26.6v1.33a9.31 9.31 0 0 1-9.31 9.31h-2.66a9.31 9.31 0 0 1-9.31-9.31v-1.33h16.001V9.995a2.015 2.015 0 0 0-2.016-2.015h-.67c-.61 0-1.126.407-1.29.965a2.698 2.698 0 0 1 1.356 2.342H13.3a2.7 2.7 0 0 1 1.347-2.337 4.006 4.006 0 0 1 3.989-3.63h.67a4.675 4.675 0 0 1 4.675 4.675v5.952z" fill="#869099"></path>
                                </svg>
                            </div>
                            <div class="ml-1">{{$propertyListing->bathrooms}} {{$propertyListing->isPlural($propertyListing->bathrooms) ? 'Beds' : 'Bed'}}</div>
                        </div>
                        <div class="flex items-center md:ml-2">
                            <div>
                                <svg class="svg w-5 h-5" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.748 21.276l-3.093-3.097v3.097h3.093zm12.852 5.32H10.655v.004h-5.32v-.004H5.32v-5.32h.015V5.32L26.6 26.596z" fill="#869099"></path>
                                </svg>
                            </div>
                            <div class="ml-1">{{$propertyListing->sqft}} sqft</div>
                        </div>
                    </div>
                </div>
                <div class="lg:text-right flex items-center justify-between mt-4 lg:mt-0 lg:block">
                    <div>
                        <div class="text-lg md:text-2xl font-bold">
                            ${{number_format($propertyListing->rent)}}/mo
                        </div>
                        <div class="font-thin mt-1 capitalize">{{$propertyListing->type}}</div>
                    </div>
                    <div class="lg:mt-6">
                        <a href="{{route('lease-application', $propertyListing->id)}}" 
                           class="bg-teal-500 hover:bg-gray-50 border border-teal-500 font-bold
                                  hover:text-teal-500 text-white rounded-lg px-2 py-1 md:px-4 md:py-2 transition duration-200">
                            Lease Application
                        </a>
                    </div>
                </div>
            </div>
            <div class="font-thin tracking-wide mt-8">
                {{$propertyListing->description}}
            </div>
        </div>

        {{-- Contact Form --}}
        <div class="col-span-1 mt-4 lg:mt-0 p-4 bg-white shadow-lg rounded-lg">
            <h4 class="text-teal-500 font-bold text-lg">Request Info</h4>
            <div class="w-full mt-4 flex flex-col sm:flex-row">
                <div class="w-full sm:w-1/2">
                    <div class="w-full">
                        @error('name')
                            <div class="text-orange-400 text-xs font-bold italic mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-1">
                        <input type="text" name="name" placeholder="Name"
                               class="px-2 w-full text-sm border rounded-lg py-2 text-gray-700 focus:outline-none
                               @error('name') border-orange-400 @enderror" required>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 mt-1 sm:mt-0 sm:ml-2">
                    <div class="w-full">
                        @error('phone')
                            <div class="text-orange-400 text-xs font-bold italic mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-1">
                        <input type="text" name="phone" placeholder="Phone"
                               class="px-2 w-full text-sm border rounded-lg py-2 text-gray-700 focus:outline-none
                               @error('phone') border-orange-400 @enderror" required>
                    </div>
                </div>
            </div>
            <div class="w-full mt-2">
                <div class="w-full">
                    @error('email')
                        <div class="text-orange-400 text-xs font-bold italic mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-1">
                    <input type="text" name="email" placeholder="Email"
                           class="px-2 w-full text-sm border rounded-lg py-2 text-gray-700 focus:outline-none
                           @error('email') border-orange-400 @enderror" required>
                </div>
            </div>
            <div class="w-full mt-2">
                <div class="w-full">
                    @error('message')
                        <div class="text-orange-400 text-xs font-bold italic mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mt-1">
                    <textarea name="message" rows="5" 
                              class="px-2 w-full text-sm border rounded-lg py-2 text-gray-700 focus:outline-none resize-none
                              @error('message') border-orange-400 @enderror" required
                              >I am interested in {{$propertyListing->property->street}} {{$propertyListing->unit ? 'Unit ' . $propertyListing->unit : ''}}, {{$propertyListing->property->city}}, {{$propertyListing->property->state}} {{$propertyListing->property->zipcode}}</textarea>
                </div>
            </div>
            <button class="w-full bg-orange-500 hover:bg-orange-600 transition 
                           duration-200 text-white rounded-lg py-2 mt-3">
                Request Info
            </button>
        </div>
    </div>

</div>
