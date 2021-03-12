<div>
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
        <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-2 
                    shadow-sm flex flex-col justify-between">
            <div class="mx-2">
                <h3 class="font-bold font-prompt text-lg text-center">Service Request</h3>
                <div class="my-3">
                    <span class="font-bold">Address:</span> 
                    <div class="text-sm font-light mt-1">
                        {{$serviceRequest->lease->property->street}}
                    </div>
                    <div class="text-sm font-light">
                        {{$serviceRequest->lease->property->city}}, {{$serviceRequest->lease->property->state}} {{$serviceRequest->lease->property->zipcode}}
                    </div>
                </div>
                <div class="my-3">
                    <span class="font-bold">Request Created:</span> 
                    <div class="text-sm font-light mt-1">
                        {{\Carbon\Carbon::parse($serviceRequest->created_at)->toFormattedDateString()}}
                    </div>
                </div>
                <div class="my-3">
                    <span class="font-bold">Issue:</span> 
                    <div class="text-sm font-light mt-1">
                        {{$serviceRequest->issue}}
                    </div>
                </div>
                <div class="my-3">
                    <span class="font-bold">Description:</span> 
                    <div class="text-sm font-light mt-1">
                        {{$serviceRequest->description}}
                    </div>
                </div>
                <div class="my-3">
                    <span class="font-bold">Completed:</span> 
                    <div class="text-sm font-light mt-1">
                        {{$serviceRequest->completed_date ? \Carbon\Carbon::parse($serviceRequest->completed_at)->toFormattedDateString() : 'Not Completed'}}
                    </div>
                </div>
            </div>
            <div class="text-center">
                <div class="bg-white rounded shadow-md text-center px-8 py-6 mb-3 sm:mb-0 w-auto">
                    <h4 class="font-bold text-lg font-prompt mb-2">Tenant Charges</h4>
                    <h6 class="text-orange-300 font-bold font-prompt text-5xl">${{$serviceRequest->tenant_charges ? $serviceRequest->tenant_charges : 'N/A'}}</h6>
                </div>
            </div>
        </div>
        <div class="break-words xl:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm 
                    sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">
            <div>
                <h3 class="font-bold font-prompt text-lg text-center">Activity</h3>
                <div class="flex flex-col sm:flex-row justify-around items-center my-4">
                    <div class="bg-white rounded shadow-md text-center px-8 py-6 mb-3 sm:mb-0 w-2/3 sm:w-auto">
                        <h3 class="text-teal-300 font-prompt font-bold text-3xl mb-4">{{$workOrders->count()}}</h3>
                        <h6 class="text-uppercase font-thin text-sm">Work Orders</h6>
                    </div>
                    <div class="bg-white rounded shadow-md text-center px-8 py-6 mb-3 sm:mb-0 w-2/3 sm:w-auto">
                        <h3 class="text-teal-300 font-prompt font-bold text-3xl mb-4">{{$workDetailsOpen}}</h3>
                        <h6 class="text-uppercase font-thin text-sm">Tasks (Open)</h6>
                    </div>
                    <div class="bg-white rounded shadow-md text-center px-8 py-6 mb-3 sm:mb-0 w-2/3 sm:w-auto">
                        <h3 class="text-teal-300 font-prompt font-bold text-3xl mb-4">{{$workDetailsClosed}}</h3>
                        <h6 class="text-uppercase font-thin text-sm">Tasks (Ended)</h6>
                    </div>
                </div>
            </div>
            <div class="mt-10">
                <div>
                    <h3 class="font-bold font-prompt">Click Work Order for Activity</h3>
                    <div class="flex flex-wrap items-center">
                        @if ($workOrders->isNotEmpty())
                            @foreach ($workOrders as $workOrder)
                                <div class="mr-2 my-2 p-2 border border-teal-500 rounded-md text-teal-500 text-sm
                                            cursor-pointer"
                                    wire:click="selectWorkOrder({{$workOrder->id}})">
                                    {{$workOrder->title}}
                                </div>
                            @endforeach
                        @else
                            <div class="my-2 font-thin">No Work Orders</div>
                        @endif
                    </div>
                </div>
                @if (!is_null($currentWorkOrder))
                    <div class="my-8">
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold">Work Order</h4>
                            <div>
                                @if ($currentWorkOrder->end_date)
                                <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        bg-teal-100 text-teal-400">
                                    Complete
                                </div>
                                @else
                                <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs 
                                            font-medium leading-4 bg-red-100 text-red-400">
                                    Incomplete
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="mt-3 sm:mt-1">
                            {{$currentWorkOrder->title}}
                        </div>
                        <div class="mt-4 overflow-y-auto max-h-80 pr-2">
                            @foreach ($workDetails as $workDetail)
                                <div class="border border-gray-400 rounded-lg p-2 my-2">
                                    <div class="my-1">
                                        <span class="font-bold">Activity:</span> 
                                        <div class="text-sm font-light mt-1">
                                            {{$workDetail->tenant_notes}}
                                        </div>
                                    </div>
                                    <div class="my-1">
                                        <span class="font-bold">Completed:</span> 
                                        <div class="text-sm font-light mt-1">
                                            {{$serviceRequest->end_date ? \Carbon\Carbon::parse($serviceRequest->end_date)->toFormattedDateString() : 'Not Completed'}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

