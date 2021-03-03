<div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm 
                    sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">
            <div class="text-lg font-bold flex items-center justify-between">
                <h5 class="font-prompt tracking-widest opacity-75">Personal Details</h5>
                @if ($leaseApplication->status === 'open')
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 text-teal-400">
                        Open
                    </span>
                @elseif ($leaseApplication->status === 'approved')
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-400">
                        Approved
                    </span>
                @else
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-red-100 text-red-400">
                        Denied
                    </span>
                @endif
            </div>
            <div class="grid grid-cols-3">
                <div class="col-span-2 mt-2">
                    <div class="my-2">
                        <span class="font-bold">Name</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->first_name}} {{$leaseApplication->last_name}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Previous Renter</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->previous_renter ? 'Yes' : 'No'}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">SSN</span> 
                        <div class="text-sm font-light mt-1">
                            {{$ssn}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Birthdate</span> 
                        <div class="text-sm font-light mt-1">
                            {{\Carbon\Carbon::parse($leaseApplication->birth_date)->toFormattedDateString()}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Phone</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->phone_number}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Email</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->email}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Drivers License Number</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->drivers_license_number}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">License State</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->drives_license_state}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">License Expiration</span> 
                        <div class="text-sm font-light mt-1">
                            {{\Carbon\Carbon::parse($leaseApplication->drives_license_exp)->toFormattedDateString()}}
                        </div>
                    </div>
                </div>
                <div class="col-span-1 mt-2">
                    <div class="my-2">
                        <span class="font-bold">Emergency Contact</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->emergency_contact}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Relationship</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->contact_relationship}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Contact Phone</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->contact_phone}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Contact Email</span> 
                        <div class="text-sm font-light mt-1">
                            @if ($leaseApplication->contact_email)
                                {{$leaseApplication->contact_relationship}}
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-4 
                    shadow-sm flex flex-col justify-between"
             x-data="{ showModal: @entangle('toggleModal') }">
            <div class="text-center">
                <h4 class="text-center font-bold text-xl mb-4 opacity-75">Lease Applicant</h4>
                <div class="my-2">
                    <span class="font-bold">Confirmation Number</span> 
                    <div class="text-md font-bold font-prompt text-green-400 mt-1">
                        {{$leaseApplication->confirmation_number}}
                    </div>
                </div>
                <div class="my-2">
                    <span class="font-bold">Tenant agreed to terms:</span> 
                    <span class="text-sm font-light">
                        @if ($leaseApplication->agree_terms)
                            <span class="text-green-400 font-bold">Yes</span>
                        @else
                            <span class="text-red-400 font-bold">No</span>
                        @endif
                    </span>
                </div>
                <div class="my-2">
                    <span class="font-bold">Tenant Signature</span> 
                    <div class="text-sm font-light mt-1">
                        {{$leaseApplication->signature}}
                    </div>
                </div>
                <div class="my-2">
                    <span class="font-bold">Signature Date</span> 
                    <div class="text-sm font-light mt-1">
                        {{\Carbon\Carbon::parse($leaseApplication->signature_date)->toFormattedDateString()}}
                    </div>
                </div>
                <div class="my-2">
                    <span class="font-bold">Property</span> 
                    <div class="text-sm font-light mt-1">
                        <div>{{$leaseApplication->propertyListing->property->street}}</div>
                        @if ($leaseApplication->propertyListing->unit)
                            <div>{{$leaseApplication->propertyListing->unit}}</div>
                        @endif
                        <div>
                            {{$leaseApplication->propertyListing->property->city}}, {{$leaseApplication->propertyListing->property->state}} {{$leaseApplication->propertyListing->property->zipcode}}
                        </div>
                    </div>
                </div>
            </div>
            @if (is_null($leaseApplication->lease))
                <div>
                    <div class="mx-4 my-2">
                        <div class="text-xs font-bold mb-1">Lease Application Status</div>
                        <select class="bg-white py-1 px-2 border border-gray-300 rounded-lg 
                                        w-full focus:outline-none"
                                wire:model="leaseStatus">
                            <option value="open">Open</option>
                            <option value="approved">Approved</option>
                            <option value="denied">Denied</option>
                        </select>
                    </div>
                    @if ($leaseApplication->status === "approved")
                        <div class="mx-4">
                            <button class="bg-teal-300 p-2 rounded-md text-white text-sm hover:bg-teal-400
                                        transition duration-200 w-full"
                                    @click="showModal = true"">
                                New Lease
                            </button>
                        </div>
                    @endif
                </div>
            @endif



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
                <div class="w-3/4 md:max-w-lg mx-auto rounded-md shadow-lg text-gray-700 whitespace-normal"
                        @click.away="showModal = false">
                    <div class="px-4 py-2 bg-white rounded-md text-center">
                        <h2 class="text-xl font-bold font-prompt my-4">Create New Lease?</h2>
                        <h6 class="font-thin my-2">Once you create a lease you cannot change the applications status!</h6>
                        <div>
                            <div class="flex flex-col sm:flex-row items-center sm:mt-8">
                                <div class="w-full sm:w-1/2 mt-4 sm:mt-0 sm:mr-1">
                                    <div class="flex flex-col items-start w-full">
                                        <label for="startDate" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Start Date:</label>
                                        @error('startDate')
                                            <div class="text-orange-400 text-xs font-bold italic">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <input type="date" id="startDate" name="startDate"
                                            class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                                @error('startDate') border-orange-400 @enderror" required 
                                            wire:model.debounce.500ms="startDate"/>
                                    </div>
                                </div>
                                <div class="w-full sm:w-1/2 mt-4 sm:mt-0 sm:ml-1">
                                    <div class="flex flex-col items-start w-full">
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
                        </div>
                        <button class="bg-orange-300 py-2 px-4 rounded-md text-white text-sm hover:bg-orange-400 
                                        transition duration-200 my-4" 
                                wire:click="newLease">
                            Create Lease
                        </button>
                    </div>
                </div>
            </div>

        </div>



    </div>

    <div class="mt-2 mb-4">
        @include('inc.livewire-error')
    </div>

    <div class="mt-2 mb-4">
        @include('inc.livewire-success')
    </div>

    <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4  
                shadow-sm py-6 px-4 md:px-12">
        <div class="grid grid-cols-1 md:grid-cols-3 md:gap-8">
            <div>
                <div>
                    <h5 class="font-prompt tracking-widest opacity-75 text-lg font-bold mb-4">Residence</h5>
                    <div class="my-2">
                        <span class="font-bold">Address</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->current_address}}<br>
                            {{$leaseApplication->city}}, {{$leaseApplication->state}} {{$leaseApplication->zip}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Monthly Payment</span> 
                        <div class="text-sm font-light mt-1">
                            ${{$leaseApplication->monthly_payment}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Durarion</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->living_duration}}
                        </div>
                    </div>
                    @if ($leaseApplication->landlord_name)
                    <div class="my-2">
                        <span class="font-bold">Landlord Name</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->landlord_name}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Landlord Phone</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->landlord_phone_number}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Landlord Email</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->landlord_email ? $leaseApplication->landlord_email : 'N/A'}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Lease End</span> 
                        <div class="text-sm font-light mt-1">
                            {{ Carbon\Carbon::parse($leaseApplication->lease_end)->toFormattedDateString() }}
                        </div>
                    </div>
                    @endif
                    <div class="my-2">
                        <span class="font-bold">Reason for Moving</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->moving_reason}}
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <h5 class="font-prompt tracking-widest opacity-75 text-lg font-bold mb-4">References</h5>
                    <div class="my-2">
                        <span class="font-bold">Reference One</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->ref_one_name}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Reference Phone</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->ref_one_phone}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Reference Email</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->ref_one_email}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Reference Two</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->ref_two_name}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Reference Phone</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->ref_two_phone}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Reference Email</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->ref_two_email}}
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="mt-8 md:mt-0">
                    <h5 class="font-prompt tracking-widest opacity-75 text-lg font-bold mb-4">Employer</h5>
                    <div class="my-2">
                        <span class="font-bold">Current Employer</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->current_employer}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Employer Email</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->employer_email}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Employer Address</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->employer_address}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Employer Phone</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->employer_phone}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Employement Duration</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->employment_duration}}
                        </div>
                    </div>
                </div>
                <div class="mt-8">
                    <h5 class="font-prompt tracking-widest opacity-75 text-lg font-bold mb-4">Income</h5>
                    <div class="my-2">
                        <span class="font-bold">Gross Monthly Income</span> 
                        <div class="text-sm font-light mt-1">
                            ${{$leaseApplication->gross_monthly_income}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Other Income Sources</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->income_other}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Gross Income Other</span> 
                        <div class="text-sm font-light mt-1">
                            ${{$leaseApplication->gross_income_other}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Child Support</span> 
                        <div class="text-sm font-light mt-1">
                            ${{$leaseApplication->child_support}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Alimony</span> 
                        <div class="text-sm font-light mt-1">
                            ${{$leaseApplication->alimony}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Car Payment</span> 
                        <div class="text-sm font-light mt-1">
                            ${{$leaseApplication->car_payment}}
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="mt-8 md:mt-0">
                    <h5 class="font-prompt tracking-widest opacity-75 text-lg font-bold mb-4">Other</h5>
                    <div class="my-2">
                        <span class="font-bold">Pets</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->pets}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Evictions</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->eviction}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Criminal History</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->criminal}}
                        </div>
                    </div>
                </div>
                @if ($leaseApplication->lease)
                    <div class="mt-8">
                        <h5 class="font-prompt tracking-widest opacity-75 text-lg font-bold mb-4">Associated Lease</h5>
                        <div class="bg-gray-100 rounded-md shadow-md p-2 flex flex-col">
                            <div class="my-1">
                                <div class="text-xs font-bold">
                                    Lease ID
                                </div>
                                <div class="font-thin">
                                    {{ $leaseApplication->lease->id }}
                                </div>
                            </div>
                            <div class="my-1">
                                <div class="text-xs font-bold">
                                    Start Date
                                </div>
                                <div class="font-thin">
                                    {{ Carbon\Carbon::parse($leaseApplication->lease->start_date)->toFormattedDateString() }}
                                </div>
                            </div>
                            <div class="my-1">
                                <div class="text-xs font-bold">
                                    End Date
                                </div>
                                <div class="font-thin">
                                    {{ Carbon\Carbon::parse($leaseApplication->lease->end_date)->toFormattedDateString() }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
