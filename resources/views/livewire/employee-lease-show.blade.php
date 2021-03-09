<div x-data="{
    newTenantModal: @entangle('showTenantModal'),
    extendLeaseModal: @entangle('showExtendLeaseModal'),
    existingTenantModal: @entangle('showExistingTenantModal'),
}">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 
                    rounded-sm sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm flex flex-col justify-between">
            <div>
                <div class="pb-4">
                    @include('inc.livewire-success')
                </div>
                <div class="flex items-center justify-between">
                    <h3 class="font-prompt font-bold text-lg tracking-wider">Lease ID: {{$lease->id}}</h3>
                    @if ($lease->leaseIsActive())
                        <div
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-400">
                            Active
                        </div>
                    @else
                        <div
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-400">
                            Ended
                        </div>
                    @endif
                </div>
                <div class="my-3">
                    <span class="font-bold">Property:</span> 
                    <div class="text-sm font-light mt-1">
                        {{$lease->property->street}}
                    </div>
                    @if ($lease->unit)
                        <div class="text-sm font-light">{{$lease->unit}}</div>
                    @endif
                    <div class="text-sm font-light">
                        {{$lease->property->city}}, {{$lease->property->state}} {{$lease->property->zipcode}}
                    </div>
                </div>
                <div class="my-3">
                    <span class="font-bold">Lease Start Date:</span> 
                    <div class="text-sm font-light mt-1">
                        {{\Carbon\Carbon::parse($lease->start_date)->toFormattedDateString()}}
                    </div>
                </div>
                <div class="my-3">
                    <span class="font-bold">Lease End Date:</span> 
                    <div class="text-sm font-light mt-1">
                        @if ($lease->end_date)
                            {{\Carbon\Carbon::parse($lease->end_date)->toFormattedDateString()}}
                        @else
                            N/A
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <div class="text-sm my-2">
                    If the tenant has never leased with us before use "New Tenant." If this is a new lease for a different unit
                    but the tenant has rented with us before, use "Add Existing Tenant." Note, this will remove the 
                    tenant from the old lease and add them to this lease.
                </div>
                @if ($lease->leaseIsActive())
                    <button class="bg-teal-300 hover:bg-teal-400 transition duration-200 
                                    px-3 py-1 text-white rounded-md text-sm my-1 focus:outline-none"
                            @click="newTenantModal = true">
                        New Tenant
                    </button>
                    <button class="bg-teal-300 hover:bg-teal-400 transition duration-200 
                                px-3 py-1 text-white rounded-md text-sm my-1 focus:outline-none"
                            @click="existingTenantModal = true">
                        Add Existing Tenant
                    </button>
                @endif

                <button class="bg-orange-300 hover:bg-orange-400 transition duration-200 
                               px-3 py-1 text-white rounded-md text-sm my-1 focus:outline-none"
                        @click="extendLeaseModal = true">
                    Extend Lease
                </button>

                {{-- New Tenant Modal --}}
                <div class="tenant-index-modal-background overflow-auto absolute inset-0 z-30 flex 
                            items-center justify-center whitespace-normal"
                        x-show="newTenantModal"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform"
                        x-transition:enter-end="opacity-100 transform"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform"
                        x-transition:leave-end="opacity-0 transform"
                        x-cloak>
                    <div class="w-3/4 md:max-w-lg mx-auto rounded-md shadow-lg text-gray-700 whitespace-normal"
                            @click.away="newTenantModal = false">
                        <div class="px-4 py-2 bg-white rounded-md text-center">
                            <h2 class="text-xl font-bold font-prompt mt-4">Create New Tenant</h2>
                            <h5 class="font-thin text-sm my-2">This will create a new tennat and attach them to this lease.</h5>
                            <div>
                                {{-- First Name --}}
                                <div class="w-full mt-4">
                                    <div class="flex justify-between items-center w-full">
                                        <label for="firstName" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>First Name:</label>
                                        @error('firstName')
                                            <div class="text-orange-400 text-xs font-bold italic">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <input type="text" id="firstName" name="firstName"
                                            class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                                @error('firstName') border-orange-400 @enderror" required 
                                            wire:model.debounce.500ms="firstName"/>
                                    </div>
                                </div>
                                {{-- Last Name --}}
                                <div class="w-full mt-4">
                                    <div class="flex justify-between items-center w-full">
                                        <label for="lastName" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Last Name:</label>
                                        @error('lastName')
                                            <div class="text-orange-400 text-xs font-bold italic">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <input type="text" id="lastName" name="lastName"
                                            class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                                @error('lastName') border-orange-400 @enderror" required 
                                            wire:model.debounce.500ms="lastName"/>
                                    </div>
                                </div>
                                {{-- Phone Number --}}
                                <div class="w-full mt-4">
                                    <div class="flex justify-between items-center w-full">
                                        <label for="phone" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Phone Number:</label>
                                        @error('phone')
                                            <div class="text-orange-400 text-xs font-bold italic">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <input type="text" id="phone" name="phone" placeholder="xxx-xxx-xxxx"
                                            class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                                @error('phone') border-orange-400 @enderror" required 
                                            wire:model.debounce.500ms="phone"/>
                                    </div>
                                </div>
                                {{-- Email --}}
                                <div class="w-full mt-4">
                                    <div class="flex justify-between items-center w-full">
                                        <label for="email" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Email:</label>
                                        @error('email')
                                            <div class="text-orange-400 text-xs font-bold italic">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <input type="email" id="email" name="email" placeholder="Email"
                                            class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                                @error('email') border-orange-400 @enderror" required 
                                            wire:model.debounce.500ms="email"/>
                                    </div>
                                </div>
                            </div>
                            <button class="bg-red-400 py-2 px-4 rounded-md text-white text-sm hover:bg-red-500 
                                            transition duration-200 my-4"
                                    wire:click="createTenant">
                                Create Tenant
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Extend Lease Modal --}}
                <div class="tenant-index-modal-background overflow-auto absolute inset-0 z-30 flex 
                            items-center justify-center whitespace-normal"
                        x-show="extendLeaseModal"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform"
                        x-transition:enter-end="opacity-100 transform"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform"
                        x-transition:leave-end="opacity-0 transform"
                        x-cloak>
                    <div class="w-3/4 md:max-w-lg mx-auto rounded-md shadow-lg text-gray-700 whitespace-normal"
                            @click.away="extendLeaseModal = false">
                        <div class="px-4 py-2 bg-white rounded-md text-center">
                            <h2 class="text-xl font-bold font-prompt mt-4">Extend Lease</h2>
                            <div>
                                {{-- End Date --}}
                                <div class="w-full mt-4">
                                    <div class="flex justify-between items-center w-full">
                                        <label for="endDate" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>End Date:</label>
                                        @error('endDate')
                                            <div class="text-orange-400 text-xs font-bold italic">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <input type="date" id="endDate" name="endDate"
                                            class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                                @error('endDate') border-orange-400 @enderror" required 
                                            wire:model.debounce.500ms="endDate"/>
                                    </div>
                                </div>
                            </div>
                            <button class="bg-red-400 py-2 px-4 rounded-md text-white text-sm hover:bg-red-500 
                                            transition duration-200 my-4"
                                    wire:click="extendLease">
                                Extend Lease
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Existing Tenant Modal --}}
                <div class="tenant-index-modal-background overflow-auto absolute inset-0 z-30 flex 
                            items-center justify-center whitespace-normal"
                        x-show="existingTenantModal"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform"
                        x-transition:enter-end="opacity-100 transform"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform"
                        x-transition:leave-end="opacity-0 transform"
                        x-cloak>
                    <div class="w-3/4 md:max-w-lg mx-auto rounded-md shadow-lg text-gray-700 whitespace-normal"
                            @click.away="existingTenantModal = false">
                        <div class="px-4 py-2 bg-white rounded-md text-center">
                            <div class="my-4">
                                <h2 class="text-xl font-bold font-prompt">Add Existing Tenant to Lease</h2>
                                <h5 class="font-thin text-sm mt-2">By adding the selected tenant to this lease you will remove them from any existing lease.</h5>
                                @can('isAdministrative')
                                    <h5 class="font-thin text-xs mt-2">You can only add tenants whose leases are about to end.</h5>
                                @endcan
                            </div>
                            <div>
                                <input type="text" class="border rounded-lg bg-white px-2 py-1 focus:outline-none w-full"
                                       placeholder="Search by last name or email"
                                       wire:model.debounce.500ms="tenantSearch">
                                <div class="text-xs top-10 right-0">
                                    @if ($tenantList->count() > 0)
                                        <div class="flex flex-wrap justify-center mt-3">
                                            @foreach ($tenantList as $tenant)
                                                <div class="border rounded-md border-orange-300 p-1 my-1 mx-1 cursor-pointer"
                                                     wire:click="selectTenant({{$tenant}})">
                                                    {{$tenant->first_name}} {{$tenant->last_name}}, {{$tenant->email}}
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="mt-3">No Results</div>
                                    @endif
                                </div>
                            </div>
                            <div class="my-2">
                                @error('selectedTenant')
                                    <div class="text-orange-400 text-xs font-bold italic sm:text-left mb-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="flex flex-col sm:flex-row items-center text-xs text-gray-700 font-bold">
                                    <div class="mr-1">Selected Tenant:</div>
                                    <div class="text-orange-400">
                                        {{isset($selectedTenant) ? $selectedTenant['first_name'] . ' ' . 
                                        $selectedTenant['last_name'] . ', ' . $selectedTenant['email'] : 'N/A'}}
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <button class="bg-red-400 py-2 px-4 rounded-md text-white text-sm hover:bg-red-500 
                                               transition duration-200 my-4 mx-1"
                                        wire:click="addExistingTenant">
                                    Add Tenant
                                </button>
                                <button class="text-red-400 border border-red-400 hover:text-white hover:bg-red-400 py-2 
                                               px-4 rounded-md text-sm transition duration-200 my-4 mx-1"
                                        @click="existingTenantModal = false">
                                    Cancel
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md 
                    mb-4 py-3 px-2 shadow-sm flex flex-col justify-between">

            <div class="text-center">
                <h3 class="font-prompt font-bold tracking-wider">Tenants on Lease</h3>
                <div>
                    @if ($tenantsOnLease->isNotEmpty())
                        @foreach ($tenantsOnLease as $tenant)
                            <div class="m-2 border border-orange-200 p-2 rounded-lg">
                                <div class="my-1 text-left">
                                    <span class="font-bold">Name:</span> 
                                    <div class="text-sm font-light mt-1">
                                        {{$tenant->first_name}} {{$tenant->last_name}}
                                    </div>
                                </div>
                                <div class="my-1 text-left">
                                    <span class="font-bold">Phone:</span> 
                                    <div class="text-sm font-light mt-1">
                                        {{$tenant->phone}}
                                    </div>
                                </div>
                                <div class="my-1 text-left">
                                    <span class="font-bold">Email:</span> 
                                    <div class="text-sm font-light mt-1">
                                        {{$tenant->email}}
                                    </div>
                                </div>
                                <div class="my-1 text-left">
                                    <span class="font-bold">Tenant Registered:</span> 
                                    <div class="text-sm font-light mt-1">
                                        {{\Carbon\Carbon::parse($lease->create_at)->toFormattedDateString()}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="my-2">No Tenants On This Lease</div>
                    @endif

                </div>
            </div>

            <div class="flex justify-between items-center">
                <div class="my-4">
                    {{ $tenantsOnLease->links('vendor.livewire.pagination') }}
                </div>
            </div>

        </div>

    </div>
    
</div>
