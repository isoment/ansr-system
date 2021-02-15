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
                    shadow-sm flex flex-col justify-between">
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
            </div>
            @if ($leaseApplication->isOpen())
                <div class="flex items-center justify-around">
                    <button class="bg-teal-300 p-2 rounded-md text-white text-sm hover:bg-teal-400
                                   transition duration-200 w-1/3"
                            wire:click="approveLease">
                        Approve
                    </button>
                    <button class="bg-red-300 p-2 rounded-md text-white text-sm hover:bg-red-400
                                   transition duration-200 w-1/3"
                            wire:click="denyLease">
                        Deny
                    </button>
                </div>
            @else
                <div class="text-center">
                    <button class="bg-teal-300 p-2 rounded-md text-white text-sm hover:bg-teal-400
                                   transition duration-200 w-1/3"
                            wire:click="reopenLease">
                        Reopen
                    </button>
                </div>
            @endif
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
                        {{ Carbon\Carbon::parse($leaseApplication->lease_end)->toFormattedDateString()}}
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
            <div>
                <div>
                    <h5 class="font-prompt tracking-widest opacity-75 text-lg font-bold mb-4">Employer</h5>
                    <div class="my-2">
                        <span class="font-bold">Current Employer</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->current_employer}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Current Email</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->employer_email}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Current Address</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->employer_address}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Current Phone</span> 
                        <div class="text-sm font-light mt-1">
                            {{$leaseApplication->employer_phone}}
                        </div>
                    </div>
                    <div class="my-2">
                        <span class="font-bold">Current Address</span> 
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
                <div>
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
                <div class="mt-8">
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
            </div>
        </div>
    </div>

</div>
