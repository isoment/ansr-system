<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    {{-- Col 1 --}}
    <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">
        <h5 class="text-xl font-bold text-center">Manage Work Order</h5>

        <div class="px-12">
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
                    <input type="text" id="assignment" name="assignment" placeholder="Assigned to"
                        class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                            @error('assignment') border-orange-400 @enderror" value="{{ old('assignment') }}" required 
                        wire:model.debounce.500ms="assignment"/>
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
                    <input type="date" id="startdate" name="startdate" placeholder="Assigned to"
                        class="px-4 w-full border bg-white rounded py-2 text-gray-700 focus:outline-none
                            @error('startdate') border-orange-400 @enderror" value="{{ old('startdate') }}" required 
                        wire:model.debounce.500ms="startdate"/>
                </div>
            </div>
        </div>
    </div>

    {{-- Col 2 --}}
    <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-4 
               shadow-sm flex flex-col justify-between">
        <h5 class="font-bold text-center mb-4">Work Order Details</h5>
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
                    {{\Carbon\Carbon::parse($workOrder->start_date)->toFormattedDateString()}}
                </div>
            </div>
            <div class="my-3">
                <span class="font-bold">End Date:</span>
                <div class="text-sm font-light mt-1">
                    {{\Carbon\Carbon::parse($workOrder->end_date)->toFormattedDateString()}}
                </div>
            </div>
        </div>
    </div>

</div>