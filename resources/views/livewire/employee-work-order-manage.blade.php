<div x-data="{ showModal: false }">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        {{-- Col 1 --}}
        <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">
            <h5 class="text-xl font-bold text-center">Manage Work Order</h5>
            <h6 class="font-bold text-xs text-center mt-1">Search below using name or ID</h6>
    
            <div class="my-2">
                @include('inc.livewire-success')
            </div>

            <form wire:submit.prevent="editWorkOrder">
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
                        <div class="text-sm font-bold mt-1 text-teal-400">
                            {{$workOrder->service_request_id}} <span class="text-xs"></span>
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
                @click="showModal = true">
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
                        @if ($detail->start_date)
                            <div>{{\Carbon\Carbon::parse($detail->start_date)->toFormattedDateString()}}</div>
                        @else
                            <div class="text-orange-400 font-bold text-sm">Not Started Yet</div>
                        @endif
                    </div>
                    <div class="my-3">
                        <div class="text-xs font-bold">End Date:</div>
                        @if ($detail->end_date)
                            <div>{{\Carbon\Carbon::parse($detail->end_date)->toFormattedDateString()}}</div>
                        @else
                            <div class="text-orange-400 font-bold text-sm">Not Completed</div>
                        @endif
                    </div>
                    <div class="my-3">
                        <a href="{{route('employee.manage-details', $detail->id)}}" class="font-bold text-sm text-teal-400">
                            Manage this detail
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="my-4">
                No details for this work order yet.
            </div>
        @endif
    </div>

    {{-- New Detail Modal --}}
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
        <div class="w-11/12 md:w-3/4 xl:w-2/3 mx-auto rounded-md shadow-lg text-gray-700 whitespace-normal"
                @click.away="showModal = false">
            <div class="text-left bg-white px-6 py-6 rounded-b-md rounded-t-md">
                <h5 class="text-xl font-bold text-center">Create New Detail</h5>
                <div class="mt-4 lg:mx-20">
                    <form wire:submit.prevent="createWorkDetail">
                        {{-- Details --}}
                        <div class="w-full mt-4 sm:mt-8">
                            <div class="flex justify-between items-center w-full">
                                <label for="formDetails" class="text-xs text-gray-700 font-bold">Details:</label>
                                @error('formDetails')
                                    <div class="text-orange-400 text-xs font-bold italic">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="flex items-center mt-1">
                                <textarea id="formDetails" name="formDetails" rows="8"
                                    class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                        @error('formDetails') border-orange-400 @enderror" required 
                                    wire:model.debounce.500ms="formDetails"/>
                                </textarea>
                            </div>
                        </div>
                        {{-- Tenant Notes --}}
                        <div class="w-full mt-4 sm:mt-8">
                            <div class="flex justify-between items-center w-full">
                                <label for="tenantNotes" class="text-xs text-gray-700 font-bold">Tenant Notes:</label>
                                @error('tenantNotes')
                                    <div class="text-orange-400 text-xs font-bold italic">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="flex items-center mt-1">
                                <textarea id="tenantNotes" name="tenantNotes" rows="4"
                                    class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                        @error('tenantNotes') border-orange-400 @enderror" required 
                                    wire:model.debounce.500ms="tenantNotes"/>
                                </textarea>
                            </div>
                        </div>
                        <div class="mt-6 text-center">
                            <button class="bg-teal-300 py-2 px-4 rounded-md text-white hover:bg-teal-400
                                        transition duration-200"
                                    type="submit"
                                    @click="showModal = false">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
