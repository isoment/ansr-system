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
        
        <div class="mt-4">
            <div class="my-3">
                <span class="font-bold">Request Created:</span> 
                <div class="text-sm font-light mt-1">
                    {{\Carbon\Carbon::parse($request->created_at)->toFormattedDateString()}}
                </div>
            </div>
            <div class="my-3">
                <span class="font-bold">Tenant Name:</span> 
                <div class="text-sm font-light mt-1">
                    {{$request->tenant->first_name}} {{$request->tenant->last_name}}
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
            <button class="bg-orange-400 p-2 rounded-md text-white text-sm hover:bg-orange-500"
                    wire:click="toggleComplete">
                {{$request->completed_date ? 'Open Request' : 'Complete Request'}}
            </button>
        </div>
    </div>

</div>
