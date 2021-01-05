<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    {{-- Col 1 --}}
    <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">
        <div class="text-xl font-bold flex items-center justify-between">
            <h5>Request ID: {{$request->id}}</h5>
            @if ($request->completed_date)
                <div
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-400">
                    Complete
                </div>
            @else
                <div
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 text-teal-400">
                    Open
                </div>
            @endif
        </div>
        
        <div class="mt-4"
             x-data="{ showModal: false }">

            <div class="my-3">
                <span class="font-bold">Request Created:</span> 
                <div class="text-sm font-light mt-1">
                    {{\Carbon\Carbon::parse($request->created_at)->toFormattedDateString()}}
                </div>
            </div>
            <div class="my-3">
                <span class="font-bold">Tenant Name:</span> 
                <div class="flex items-center mt-1">
                    <div class="text-sm font-light">
                        {{$request->tenant->first_name}} {{$request->tenant->last_name}}
                    </div>
                    <i class="text-sm far fa-question-circle text-orange-300 transition duration-200
                             hover:text-orange-400 ml-1 cursor-pointer"
                       @click="showModal = true">
                    </i>
                </div>
            </div>
            <div class="my-3">
                <span class="font-bold">Tenant Phone Number:</span> 
                <div class="text-sm font-light mt-1">
                    {{$request->tenant->phone}}
                </div>
            </div>
            <div>
                <span class="font-bold">Lease ID:</span> 
                <div class="text-sm font-light mt-1">
                    {{$request->tenant->lease->id}}
                </div>
            </div>
            <div class="my-3">
                <span class="font-bold">Category:</span> 
                <div class="text-sm font-light mt-1">
                    {{$request->requestCategory->name}}
                </div>
            </div>
            <div class="my-3">
                <span class="font-bold">Issue:</span> 
                <div class="text-sm font-light mt-1">
                    {{$request->issue}}
                </div>
            </div>
            <div class="my-3">
                <span class="font-bold">Description:</span> 
                <div class="text-sm font-light mt-1">
                    {{$request->description}}
                </div>
            </div>
            <div class="my-3">
                <span class="font-bold">Tenant Charges:</span> 
                <div class="text-sm font-light mt-1">
                    {{$request->tenant_charges ? '$'.$request->tenant_charges : 'N/A'}}
                </div>
            </div>

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
                <div class="w-11/12 md:max-w-lg mx-auto rounded-md shadow-lg text-gray-700 whitespace-normal"
                        @click.away="showModal = false">
                    <div class="text-left bg-white px-6 py-2 rounded-b-md rounded-t-md">
                        <div class="flex items-center justify-between mt-4">
                            <h5 class="text-xl font-bold">Tenant Information</h5>
                            <div>
                                <i class="fas fa-times text-lg cursor-pointer"
                                    @click="showModal = false">
                                </i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="my-3">
                                <span class="font-bold">Tenant Name:</span> 
                                <div class="text-sm font-light mt-1">
                                    {{$request->tenant->first_name}} {{$request->tenant->last_name}}
                                </div>
                            </div>
                            <div class="my-3">
                                <span class="font-bold">Email:</span> 
                                <div class="text-sm font-light mt-1">
                                    {{$request->tenant->email}}
                                </div>
                            </div>
                            <div class="my-3">
                                <span class="font-bold">Phone Number:</span> 
                                <div class="text-sm font-light mt-1">
                                    {{$request->tenant->phone}}
                                </div>
                            </div>
                            <div class="my-3">
                                <span class="font-bold">Tenant Address:</span> 
                                <div class="text-sm font-light mt-1">
                                    {{$request->tenant->lease->property->street}}
                                </div>
                                @if ($request->tenant->lease->unit)
                                    <div class="text-sm font-light mt-1">
                                        Unit: {{$request->tenant->lease->unit}}
                                    </div>
                                @endif
                                @if ($request->tenant->lease->building)
                                    <div class="text-sm font-light mt-1">
                                        Building: {{$request->tenant->lease->building}}
                                    </div>
                                @endif
                                <div class="text-sm font-light mt-1">
                                    {{$request->tenant->lease->property->city}}, {{$request->tenant->lease->property->state}} {{$request->tenant->lease->property->zipcode}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- Col 2 --}}
    <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-2 shadow-sm">
        <div class="text-center mb-10">
            <h6 class="font-bold text-sm mb-2">Work Orders for this Service Request:</h6>
            @if ($workOrders->isNotEmpty())
                @foreach ($workOrders as $workOrder)
                    <div class="my-3 font-light">
                        <div>Work Order ID: {{$workOrder->id}}</div>
                        <div>Assigned To: {{$workOrder->employee->first_name}} {{$workOrder->employee->last_name}}</div>
                    </div>
                @endforeach
            @else 
                <div class="my-3 font-light">
                    No work orders associated.
                </div>
            @endif

        </div>
        <div class="text-center">
            <h6 class="font-bold text-sm mb-2">Open or close the Service Request:</h6>
            <button class="bg-orange-400 p-2 rounded-md text-white text-sm hover:bg-orange-500
                           transition duration-200"
                    wire:click="toggleComplete">
                {{$request->completed_date ? 'Reopen Request' : 'Complete Request'}}
            </button>
        </div>
    </div>

</div>