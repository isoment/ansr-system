<div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">
            <h5 class="text-xl font-bold text-center">Manage Work Detail</h5>

            <div class="my-2">
                @include('inc.livewire-success')
            </div>

            <form wire:submit.prevent="editWorkDetail">
                <div class="md:px-6">
                    {{-- Details --}}
                    <div class="w-full mt-4">
                        <div class="flex justify-between items-center w-full">
                            <label for="details" class="text-xs text-gray-700 font-bold">Details:</label>
                            @error('details')
                                <div class="text-orange-400 text-xs font-bold italic">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="flex items-center mt-1">
                            <textarea id="details" name="details" rows="6"
                                class="px-4 w-full border bg-white rounded py-2 text-gray-700 focus:outline-none
                                    @error('details') border-orange-400 @enderror" 
                                wire:model.debounce.500ms="details"/>
                            </textarea>
                        </div>
                    </div>
                    {{-- Tenant Notes --}}
                    <div class="w-full mt-4">
                        <div class="flex justify-between items-center w-full">
                            <label for="tenantNotes" class="text-xs text-gray-700 font-bold">Tenant Notes:</label>
                            @error('tenantNotes')
                                <div class="text-orange-400 text-xs font-bold italic">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="flex items-center mt-1">
                            <textarea id="tenantNotes" name="tenantNotes" rows="3"
                                class="px-4 w-full border bg-white rounded py-2 text-gray-700 focus:outline-none
                                    @error('tenantNotes') border-orange-400 @enderror" 
                                wire:model.debounce.500ms="tenantNotes"/>
                            </textarea>
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
                                    @error('startdate') border-orange-400 @enderror"
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

        <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-4 
                   shadow-sm flex flex-col justify-between">
            <div>
                <h5 class="font-bold text-center mb-6">Work Detail Information</h5>
                <div class="my-2">
                    <span class="font-bold text-sm">Work Detail ID:</span> 
                    <div class="text-sm font-light mt-1">
                        {{$workDetail->id}}
                    </div>
                </div>
                <div class="my-2">
                    <span class="font-bold text-sm">Belongs to Work Order:</span> 
                    <a href="{{route('employee.manage-workorder', $workDetail->work_order_id)}}">
                        <div class="text-sm font-bold mt-1 text-teal-400">
                            {{$workDetail->work_order_id}}
                        </div>
                    </a>
                </div>
                <div class="my-2">
                    <span class="font-bold text-sm">Start Date:</span> 
                    <div class="text-sm mt-1">
                        @if ($workDetail->start_date)
                            {{\Carbon\Carbon::parse($workDetail->start_date)->toFormattedDateString()}}
                        @else 
                            Not Started
                        @endif
                    </div>
                </div>
                <div class="my-2">
                    <span class="font-bold text-sm">End Date:</span> 
                    <div class="text-sm mt-1">
                        @if ($workDetail->end_date)
                            {{\Carbon\Carbon::parse($workDetail->end_date)->toFormattedDateString()}}
                        @else 
                            Not Completed
                        @endif
                    </div>
                </div>
            </div>
            <div class="my-3 text-center">
                <button class="bg-orange-400 p-2 rounded-md text-white text-sm hover:bg-orange-500
                               transition duration-200"
                        wire:click="toggleEndDate({{$workDetail}})">
                    {{$workDetail->end_date ? 'Reopen Work Detail' : 'Complete Work Detail'}}
                </button>
            </div>
        </div>

    </div>

    <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-4 
                shadow-sm">
        File Uploads
    </div>
    
</div>
