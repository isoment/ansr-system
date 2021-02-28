<div>
    <a href="{{route('property-listing-show', $property->id)}}">
        {{-- Background Image --}}
        <div class="h-48 rounded-lg relative"
            style="background-image: url('/storage/{{$property->getAnImage()}}');
                background-size: cover;
                background-position: 50% 50%;">
            @if ($property->listingIsNew())
                <div class="bg-white text-xs font-bold px-1 py-1 absolute shadow-lg
                            top-2 left-2 rounded-lg">
                    NEW
                </div>
            @elseif ($property->listingIsUpdated())
            <div class="bg-white text-xs font-bold px-1 py-1 absolute shadow-lg
                        top-2 left-2 rounded-lg">
                UPDATED
            </div>
            @endif
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
</div>