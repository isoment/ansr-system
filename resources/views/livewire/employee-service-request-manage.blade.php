<div>
    
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
                 x-data="{ 
                     showModal: false,
                     showChargesForm: false,
                    }">
    
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
                                 hover:text-orange-400 ml-2 cursor-pointer"
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
                    <div class="flex items-center mt-1">
                        <div class="text-sm font-light mt-1">
                            {{$request->tenant_charges ? '$'.$request->tenant_charges : 'N/A'}}
                        </div>
                        <i class="text-sm far fa-edit text-orange-300 transition duration-200
                                hover:text-orange-400 ml-2 cursor-pointer"
                           @click="showChargesForm = true">
                        </i>
                    </div>
                </div>
    
                {{-- Tenant Modal --}}
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

                {{-- Charges Modal --}}
                <div class="tenant-index-modal-background overflow-auto absolute inset-0 z-30 flex 
                            items-center justify-center whitespace-normal"
                        x-show="showChargesForm"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform"
                        x-transition:enter-end="opacity-100 transform"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform"
                        x-transition:leave-end="opacity-0 transform"
                        x-cloak>
                    <div class="w-11/12 md:max-w-lg mx-auto rounded-md shadow-lg text-gray-700 whitespace-normal"
                            @click.away="showChargesForm = false">
                        <div class="text-left bg-white px-6 py-2 rounded-b-md rounded-t-md">
                            <div class="flex items-center justify-between mt-4">
                                <h5 class="text-xl font-bold">Tenant Charges</h5>
                                <div>
                                    <i class="fas fa-times text-lg cursor-pointer"
                                        @click="showChargesForm = false">
                                    </i>
                                </div>
                            </div>
                            <div class="my-4">
                                <form wire:submit.prevent="editTenantCharges">
                                    <div class="w-full mt-4 sm:mt-8">
                                        <div class="flex justify-between items-center w-full">
                                            <label for="tenantCharges" class="text-xs text-gray-700 font-bold">Amount:</label>
                                            @error('tenantCharges')
                                                <div class="text-orange-400 text-xs font-bold italic">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="flex items-center mt-1">
                                            <span class="font-bold text-lg mr-2">$</span>
                                            <input name="tenantCharges" type="number" min="1" max="10000" step=".01"
                                                class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                                    @error('tenantCharges') border-orange-400 @enderror"
                                                wire:model.debounce.1000="tenantCharges"/>
                                        </div>
                                    </div>
                                    <div class="text-center my-4">
                                        <button class="bg-orange-400 p-2 rounded-md text-white text-sm hover:bg-orange-500
                                                        transition duration-200"
                                                type="submit"
                                                @click="showChargesForm = false">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    
        {{-- Col 2 --}}
        <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-2 
                   shadow-sm flex flex-col justify-between">
            <div class="text-center mb-6">
                <h6 class="font-bold text-sm mb-2 text-teal-300">Work Orders for this Service Request:</h6>
                <div class="overflow-y-auto max-h-72">
                    @if ($workOrders->isNotEmpty())
                    @foreach ($workOrders as $workOrder)
                        <div class="my-3">
                            <div class="font-light">
                                <div class="flex items-center justify-center">
                                    <div class="font-bold text-sm">
                                        Work Order ID: 
                                        <a href="{{route('employee.manage-workorder', $workOrder->id)}}"
                                            class="text-teal-300 bold">{{$workOrder->id}}</a>
                                    </div>
                                    @if (! $workOrder->hasWorkDetails())
                                        <button type="button"
                                                class="text-red-500 hover:text-red-700 rounded overflow-hidden 
                                                        p-1 focus:outline-none"
                                                wire:click="deleteWorkOrder({{$workOrder->id}})">
                                            <svg
                                                class="h-3 w-3"
                                                fill="currentColor"
                                                viewBox="0 0 20 20"
                                            >
                                                <path
                                                fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                                ></path>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                                <div>
                                    @if ($workOrder->employee_id)
                                        Assigned To: {{$workOrder->employee->first_name}} {{$workOrder->employee->last_name}}
                                    @else 
                                        No assignment yet
                                    @endif
                                </div>
                                <div class="text-xs {{$workOrder->end_date === NULL ? 'text-orange-400 font-bold' : ''}}">
                                    @if ($workOrder->end_date === NULL)
                                        Not Complete
                                    @else
                                        Completed
                                    @endif
                                </div>
                            </div>
                            @if ($workOrder->hasWorkDetails())
                                <a class="cursor-pointer font-bold text-xs text-teal-400"
                                wire:click="getWorkOrderDetails({{$workOrder->id}})">Click for Details</a>
                            @endif
                        </div>
                    @endforeach
                    @else 
                        <div class="my-3 font-light">
                            No work orders associated.
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-center">
                @if (! $request->completed_date)
                    <div class="my-2">
                        <h6 class="font-bold text-sm mb-2">Create New Work Order:</h6>
                        <button class="bg-teal-300 p-2 rounded-md text-white text-sm hover:bg-teal-400
                                    transition duration-200"
                                wire:click="newWorkOrder">
                            New Work Order
                        </button>
                    </div>
                @endif
                @if ($request->allWorkOrdersComplete())
                    <div class="my-2">
                        <h6 class="font-bold text-sm mb-2">Open or Close the Request:</h6>
                        <button class="bg-orange-400 p-2 rounded-md text-white text-sm hover:bg-orange-500
                                    transition duration-200"
                                wire:click="toggleComplete">
                            {{$request->completed_date ? 'Reopen Request' : 'Complete Request'}}
                        </button>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <div class="mt-2 mb-4">
        @include('inc.livewire-error')
    </div>

    <div class="mt-2 mb-4">
        @include('inc.livewire-success')
    </div>
    
    <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-6 
                shadow-sm">
        <h3 class="text-lg text-center font-bold mb-6">Work Order Details...</h3>
        <div>
            @if ($workOrderDetails->isNotEmpty())
                @foreach ($workOrderDetails as $detail)
                    <div class="{{$loop->last ? '' : 'border-b'}} border-gray-200">
                        <div class="my-3">
                            <span class="font-bold">Detail description:</span>
                            <div class="text-sm font-light mt-1">
                                {{$detail->details}}
                            </div>
                        </div>
                        <div class="my-3">
                            <span class="font-bold">Belongs to Work Order:</span>
                            <div class="text-sm font-bold mt-1 text-teal-400">
                                <a href="{{route('employee.manage-workorder', $detail->work_order_id)}}">{{$detail->work_order_id}}</a>
                            </div>
                        </div>
                        <div class="my-3">
                            <span class="font-bold">Start Date:</span>
                            <div class="text-sm font-light mt-1">
                                {{\Carbon\Carbon::parse($detail->start_date)->toFormattedDateString()}}
                            </div>
                        </div>
                        <div class="my-3">
                            <span class="font-bold">End Date:</span> 
                            <div class="text-sm font-light mt-1">
                                {{\Carbon\Carbon::parse($detail->end_date)->toFormattedDateString()}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h5 class="text-orange-400 text-sm font-bold">Please select a work order above</h5>
            @endif
            <div class="my-4">
                {{ $workOrderDetails->links('vendor.livewire.pagination') }}
            </div>
        </div>
    </div>

</div>


