<div>

    <div class="flex justify-between">
        <a href="{{ url()->previous() }}"
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

    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-4 my-4">
        <div class="col-span-2 p-4 bg-white shadow-md rounded-md">
            <img src="https://www.photoartistweb.nl/wp-content/uploads/2014/09/Real-Estate-Interior-030.jpg">
        </div>
        <div class="col-span-1 mt-4 lg:mt-0 p-4 text-center bg-white shadow-md rounded-md
                    grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-2 gap-4 overflow-y-scroll max-height-property-images">

            <div class="rounded-md">
                <img src="https://si.wsj.net/public/resources/images/MN-AM523_WHITE_P_20160718171125.jpg"
                     class="rounded-md">
            </div>
            <div class="rounded-md">
                <img src="https://www.digitalphotomentor.com/photography/2018/09/real-estate-living-room-photo-2.jpg"
                     class="rounded-md">
            </div>
            <div class="rounded-md">
                <img src="https://si.wsj.net/public/resources/images/MN-AM523_WHITE_P_20160718171125.jpg"
                     class="rounded-md">
            </div>
            <div class="rounded-md">
                <img src="https://www.digitalphotomentor.com/photography/2018/09/real-estate-living-room-photo-2.jpg"
                     class="rounded-md">
            </div>
            <div class="rounded-md">
                <img src="https://si.wsj.net/public/resources/images/MN-AM523_WHITE_P_20160718171125.jpg"
                     class="rounded-md">
            </div>
            <div class="rounded-md">
                <img src="https://www.digitalphotomentor.com/photography/2018/09/real-estate-living-room-photo-2.jpg"
                     class="rounded-md">
            </div>
            <div class="rounded-md">
                <img src="https://si.wsj.net/public/resources/images/MN-AM523_WHITE_P_20160718171125.jpg"
                     class="rounded-md">
            </div>
            <div class="rounded-md">
                <img src="https://www.digitalphotomentor.com/photography/2018/09/real-estate-living-room-photo-2.jpg"
                     class="rounded-md">
            </div>
            <div class="rounded-md">
                <img src="https://si.wsj.net/public/resources/images/MN-AM523_WHITE_P_20160718171125.jpg"
                     class="rounded-md">
            </div>
            <div class="rounded-md">
                <img src="https://www.digitalphotomentor.com/photography/2018/09/real-estate-living-room-photo-2.jpg"
                     class="rounded-md">
            </div>

        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-4 my-4">
        <div class="col-span-2 p-4 lg:ml-2 flex flex-col lg:flex-row justify-between">
            <div>
                <div class="text-2xl font-bold">
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
                <div class="my-4 flex items-center">
                    <div class="flex items-center">
                        <div>
                            <svg class="svg w-5 h-5" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.196 14.603h15.523v.027h1.995v10.64h-3.99v-4.017H9.196v4.017h-3.99V6.65h3.99v7.953zm2.109-1.968v-2.66h4.655v2.66h-4.655z" fill="#869099"></path>
                            </svg>
                        </div>
                        <div class="ml-1">{{$propertyListing->bedrooms}} {{$propertyListing->isPlural($propertyListing->bedrooms) ? 'Beds' : 'Bed'}}</div>
                    </div>
                    <div class="flex items-center ml-2">
                        <div>
                            <svg class="svg w-5 h-5" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.981 15.947H26.6v1.33a9.31 9.31 0 0 1-9.31 9.31h-2.66a9.31 9.31 0 0 1-9.31-9.31v-1.33h16.001V9.995a2.015 2.015 0 0 0-2.016-2.015h-.67c-.61 0-1.126.407-1.29.965a2.698 2.698 0 0 1 1.356 2.342H13.3a2.7 2.7 0 0 1 1.347-2.337 4.006 4.006 0 0 1 3.989-3.63h.67a4.675 4.675 0 0 1 4.675 4.675v5.952z" fill="#869099"></path>
                            </svg>
                        </div>
                        <div class="ml-1">{{$propertyListing->bathrooms}} {{$propertyListing->isPlural($propertyListing->bathrooms) ? 'Beds' : 'Bed'}}</div>
                    </div>
                    <div class="flex items-center ml-2">
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
                    <div class="text-2xl font-bold">
                        ${{number_format($propertyListing->rent)}}/mo
                    </div>
                    <div class="font-thin mt-1 capitalize">{{$propertyListing->type}}</div>
                </div>
                <div class="lg:mt-6">
                    <a href="{{route('lease-application', $propertyListing->id)}}" 
                       class="bg-teal-500 hover:bg-gray-50 border border-teal-500 font-bold
                              hover:text-teal-500 text-white rounded-lg px-4 py-2 transition duration-200">
                        Lease Application
                    </a>
                </div>
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
            <button class="w-full bg-orange-500 text-white rounded-lg py-2 mt-3">
                Request Info
            </button>
        </div>
    </div>

    {{-- Related Rentals --}}
    <div class="py-8">
        <h3 class="text-lg font-bold">Similar Rentals You May Like</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
            @foreach ($relatedRentals as $property)
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
    </div>

</div>
