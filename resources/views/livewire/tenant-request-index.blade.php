<div x-data="{ filterMenu: false }">
    
    <div class="mt-4 mb-4 flex flex-row justify-between items-center relative">
        <div class="flex items-center">
            <a href="{{route('tenant.service-request')}}">
                <div class="bg-teal-300 px-1 font-bold text-lg rounded-md mr-2 text-white cursor-pointer">
                    +
                </div>
            </a>
            <h3 class="text-lg sm:text-2xl font-bold font-prompt tracking-wider text-gray-700">Service Requests</h3>
        </div>
        <button class="flex items-center border border-gray-300 px-3 py-2 focus:outline-none
                rounded-lg hover:border-gray-200 hover:bg-gray-200"
                @click="filterMenu = !filterMenu">
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
        <div class="absolute right-2 top-12 bg-white z-10 w-44 sm:w-44 rounded-lg shadow-2xl
                    p-4"
                x-show.transition="filterMenu"
                x-cloak
                @click.away="filterMenu = false">

            <div>
                <div class="relative flex items-start">
                    <div class="mx-2 text-sm leading-5">
                        <label for="open" class="font-medium text-gray-700">Open Requests:</label>
                    </div>
                    <div class="flex items-center h-5">
                        <input id="open" type="checkbox"
                            wire:model="open"
                            class="form-checkbox h-4 w-4 text-teal-400 transition duration-150 ease-in-out">
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="my-2">
        @include('inc.livewire-success')
    </div>

    <section class="text-gray-700 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">

        @foreach ($requests as $request)
        <div>
            <div class="h-full flex flex-col justify-between shadow-md rounded-lg py-4 px-6 bg-white">
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <div class="text-lg font-bold font-prompt">
                            ID: {{$request->id}}
                        </div>
                        <div class="mb-2 text-right">
                            @if ($request->completed_date)
                            <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                       bg-teal-100 text-teal-400">
                                Ended
                            </div>
                            @else
                            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs 
                                        font-medium leading-4 bg-green-100 text-green-400">
                                Active
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="font-bold text-xs mb-1">Property:</div>
                        <div class="font-light text-sm">{{$request->lease->property->street}}</div>
                        <div class="font-light text-sm">{{$request->lease->property->city}}, {{$request->lease->property->state}}</div>
                    </div>
                    <div class="mb-2">
                        <div class="font-bold text-xs mb-1">Issue:</div>
                        <div class="font-light text-sm">{{Str::limit($request->issue, 25, '...')}}</div>
                    </div>
                    <div class="mb-2">
                        <div class="font-bold text-xs mb-1">End Date:</div>
                        <div>
                            <div class="font-light text-md">
                                @if ($request->completed_date)
                                    {{\Carbon\Carbon::parse($request->completed_date)->toFormattedDateString()}}
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" class="text-gray-500 font-bold flex items-center justify-end">
                    <i class="fas fa-external-link-alt text-sm mr-1"></i>
                    <div class="font-prompt text-sm">Request</div>
                </a>
            </div>
        </div>
        @endforeach

    </section>

    <div class="flex justify-between items-center">
        <div class="my-4">
            {{ $requests->links('vendor.livewire.pagination') }}
        </div>
    </div>

</div>