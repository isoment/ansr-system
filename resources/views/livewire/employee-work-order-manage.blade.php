<div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        {{-- Col 1 --}}
        <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">
            <h5 class="text-xl font-bold text-center">Manage Work Order</h5>
            <h6 class="font-bold text-xs text-center mt-1">Search below using name or ID</h6>
    
            <form wire:submit.prevent="submitForm">
                <div class="md:px-12">
                    {{-- Assigned --}}
                    <div class="w-full mt-4 sm:mt-8">
                        <div class="flex justify-between items-center w-full">
                            <label for="assignment" class="text-xs text-gray-700 font-bold">Assigned To:</label>
                            @error('assignment')
                                <div class="text-orange-400 text-xs font-bold italic">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="flex items-center mt-1">
                            <input list="employees" name="assignment" id="assignment"
                                    class="px-4 w-full border bg-white rounded py-2 text-gray-700 focus:outline-none
                                        @error('assignment') border-orange-400 @enderror" 
                                    value="{{$assignment}}"
                                    wire:model.debounce.500ms="assignment">
                            <datalist id="employees">
                                @foreach ($employees as $employee)
                                    <option value="{{$employee->employee_id_number}}">
                                        {{$employee->last_name}}, {{$employee->first_name}}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    {{-- Start Date --}}
                    <div class="w-full mt-4 sm:mt-8">
                        <div class="flex justify-between items-center w-full">
                            <label for="startdate" class="text-xs text-gray-700 font-bold">Start Date:</label>
                            @error('startdate')
                                <div class="text-orange-400 text-xs font-bold italic">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="flex items-center mt-1">
                            <input type="date" id="startdate" name="startdate"
                                class="px-4 w-full border bg-white rounded py-2 text-gray-700 focus:outline-none
                                    @error('startdate') border-orange-400 @enderror" value="{{ old('startdate') }}" 
                                wire:model.debounce.500ms="startdate"/>
                        </div>
                    </div>
                    <div class="mt-6 text-center">
                        <button class="bg-teal-300 py-2 px-4 rounded-md text-white hover:bg-teal-400
                                    transition duration-200"
                                type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    
        {{-- Col 2 --}}
        <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-4 
                   shadow-sm flex flex-col">
            <h5 class="font-bold text-center mb-6">Work Order Information</h5>
            <div>
                <div class="my-2">
                    <span class="font-bold text-sm">Work Order ID:</span> 
                    <div class="text-sm font-light mt-1">
                        {{$workOrder->id}}
                    </div>
                </div>
                <div>
                    <span class="font-bold text-sm">Belongs to service request:</span> 
                    <a href="{{route('employee.manage-request', $workOrder->service_request_id)}}">
                        <div class="text-sm font-bold mt-1 text-teal-300">
                            {{$workOrder->service_request_id}} <span class="text-xs">(LINK)</span>
                        </div>
                    </a>
                </div>
                <div class="my-2">
                    <span class="font-bold text-sm">Assigned To:</span> 
                    <div class="text-sm font-light mt-1">
                        @if ($workOrder->employee_id)
                            {{$workOrder->employee->first_name}} {{$workOrder->employee->last_name}}
                        @else 
                            Nobody
                        @endif
                    </div>
                </div>
                <div class="my-3">
                    <span class="font-bold">Start Date:</span>
                    <div class="text-sm font-light mt-1">
                        @if ($workOrder->start_date)
                            {{\Carbon\Carbon::parse($workOrder->start_date)->toFormattedDateString()}}
                        @else
                            Not Started
                        @endif
                        
                    </div>
                </div>
                <div class="my-3">
                    <span class="font-bold">End Date:</span>
                    <div class="text-sm font-light mt-1">
                        @if ($workOrder->end_date)
                            {{\Carbon\Carbon::parse($workOrder->end_date)->toFormattedDateString()}}
                        @else
                            Not Complete
                        @endif
                    </div>
                </div>
            </div>
            <div class="my-2 text-center">
                <button class="bg-orange-400 p-2 rounded-md text-white text-sm hover:bg-orange-500
                               transition duration-200"
                        wire:click="toggleEndDate">
                    {{$workOrder->end_date ? 'Reopen Work Order' : 'Complete Work Order'}}
                </button>
            </div>
        </div>
    
    </div>
    
    <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-4 
               shadow-sm relative">
        <h5 class="text-xl font-bold text-center">Work Order Details</h5>
        <button class="bg-teal-300 py-1 px-2 rounded-md text-white hover:bg-teal-400
                        transition duration-200 absolute top-3 right-3"
                wire:click="newDetail">
            <span class="font-bold text-xl">+</span>
        </button>
        <h6 class="font-bold text-xs text-center mt-1">Manage Details here</h6>
            @if ($details->isNotEmpty())
                @foreach ($details as $detail)
                    <div class="{{$loop->last ? '' : 'border-b'}} border-gray-200">
                        <div class="my-3">
                            <div class="text-xs font-bold">Details:</div>
                            <div>{{$detail->details}}</div>
                        </div>
                        <div class="my-3">
                            <div class="text-xs font-bold">Tenant Notes:</div>
                            <div>{{$detail->tenant_notes}}</div>
                        </div>
                        <div class="my-3">
                            <div class="text-xs font-bold">Start Date:</div>
                            <div>{{\Carbon\Carbon::parse($detail->start_date)->toFormattedDateString()}}</div>
                        </div>
                        <div class="my-3">
                            <div class="text-xs font-bold">End Date:</div>
                            <div>{{\Carbon\Carbon::parse($detail->end_date)->toFormattedDateString()}}</div>
                            
                        </div>
                    </div>
                @endforeach
            @else
                <div class="my-4">
                    No details for this work order yet.
                </div>
            @endif
    </div>

</div>
