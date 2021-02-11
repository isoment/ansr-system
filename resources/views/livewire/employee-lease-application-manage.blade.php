<div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm 
                    sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">
            <div class="text-lg font-bold flex items-center justify-between">
                <h5 class="font-prompt text-gray-400">Personal Details</h5>
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
                            {{$leaseApplication->first_name}}, {{$leaseApplication->last_name}}
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
                            {{$leaseApplication->drives_license_exp}}
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

        <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-2 
                    shadow-sm flex flex-col justify-between">
            TEST
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
        TEST
    </div>

</div>
