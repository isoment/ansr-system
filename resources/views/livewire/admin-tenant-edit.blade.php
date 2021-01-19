<div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        {{-- Col 1 --}}
        <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">
            <h5 class="text-xl font-bold text-center">Edit Tenant Details</h5>
            <h6 class="font-bold text-xs text-center mt-1">You may edit the fields below</h6>
    
            <div class="my-2">
                @include('inc.livewire-success')
            </div>

            <form wire:submit.prevent="editTenant">
                {{-- First Name --}}
                <div class="w-full mt-4 sm:mt-8">
                    <div class="flex justify-between items-center w-full">
                        <label for="firstName" class="text-xs text-gray-700 font-bold">First Name:</label>
                        @error('firstName')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="text" id="firstName" name="firstName"
                            class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('firstName') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="firstName"/>
                    </div>
                </div>

                {{-- Last Name --}}
                <div class="w-full mt-4 sm:mt-8">
                    <div class="flex justify-between items-center w-full">
                        <label for="lastName" class="text-xs text-gray-700 font-bold">Last Name:</label>
                        @error('lastName')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="text" id="lastName" name="lastName"
                            class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('lastName') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="lastName"/>
                    </div>
                </div>

                {{-- Email --}}
                <div class="w-full mt-4 sm:mt-8">
                    <div class="flex justify-between items-center w-full">
                        <label for="email" class="text-xs text-gray-700 font-bold">Email:</label>
                        @error('email')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="email" id="email" name="email"
                            class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('email') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="email"/>
                    </div>
                </div>

                {{-- Phone --}}
                <div class="w-full mt-4 sm:mt-8">
                    <div class="flex justify-between items-center w-full">
                        <label for="phone" class="text-xs text-gray-700 font-bold">Phone Number:</label>
                        @error('phone')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="text" id="phone" name="phone"
                            class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('phone') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="phone"/>
                    </div>
                </div>
                <div class="mt-6 mb-2 text-center">
                    <button class="bg-teal-300 py-2 px-4 rounded-md text-white hover:bg-teal-400
                                transition duration-200"
                            type="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>
    
        {{-- Col 2 --}}
        <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-4 
                   shadow-sm flex flex-col">
            <h5 class="font-bold text-center mb-6">Associated Lease</h5>
            <div class="my-2">
                <span class="font-bold">Lease ID:</span> 
                <div class="text-sm font-light mt-1">
                    {{$tenant->lease->id}}
                </div>
            </div>
            <div class="my-2">
                <span class="font-bold">Property Name:</span> 
                <div class="text-sm font-light mt-1">
                    {{$tenant->lease->property->name}}
                </div>
            </div>
            <div class="my-2">
                <span class="font-bold">Address:</span> 
                <div class="text-sm font-light mt-1">
                    {{$tenant->lease->property->street}}<br>
                    @if ($tenant->lease->building)
                        Building: {{$tenant->lease->building}}<br>
                    @endif
                    @if ($tenant->lease->unit)
                        Unit: {{$tenant->lease->unit}}<br>
                    @endif
                    {{$tenant->lease->property->city}}, {{$tenant->lease->property->state}} {{$tenant->lease->property->zipcode}}
                </div>
            </div>
            <div class="my-2">
                <span class="font-bold">Start Date:</span> 
                <div class="text-sm font-light mt-1">
                    {{\Carbon\Carbon::parse($tenant->lease->start_date)->toFormattedDateString()}}
                </div>
            </div>
            <div class="my-2">
                <span class="font-bold">End Date:</span> 
                <div class="text-sm font-light mt-1">
                    {{\Carbon\Carbon::parse($tenant->lease->end_date)->toFormattedDateString()}}
                </div>
            </div>
        </div>
    
    </div>

</div>
