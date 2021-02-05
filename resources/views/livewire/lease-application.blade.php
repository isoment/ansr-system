<div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-8 
            py-6 px-4 md:px-12 shadow-sm">

    <h3 class="font-bold text-lg">Step: {{$step}}</h3>

    {{-- Step 1 --}}
    @if ($step === 1)
    <div>
        {{-- Name --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="firstName" class="text-xs text-gray-700 font-bold">First Name:</label>
                    @error('firstName')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="firstName" name="firstName" placeholder="First Name"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('firstName') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="firstName"/>
                </div>
            </div>
            <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="lastName" class="text-xs text-gray-700 font-bold">Last Name:</label>
                    @error('lastName')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="lastName" name="lastName" placeholder="Last Name"
                        class="pl-4 pr-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('lastName') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="lastName"/>
                </div>
            </div>
        </div>

        {{-- Email Phone --}}
        <div class="flex flex-col sm:flex-row items-center mt-4 sm:mt-8">
            <div class="w-full sm:w-2/3">
                <div class="flex justify-between items-center w-full">
                    <label for="email" class="text-xs text-gray-700 font-bold">Email:</label>
                    @error('email')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="email" id="email" name="email" placeholder="Email"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('email') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="email"/>
                </div>
            </div>
            <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="phone" class="text-xs text-gray-700 font-bold">Phone:</label>
                    @error('phone')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="phone" name="phone" placeholder="xxx-xxx-xxxx"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('phone') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="phone"/>
                </div>
            </div>
        </div>

        {{-- SSN & Birthdate --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="birthDate" class="text-xs text-gray-700 font-bold">Birthdate:</label>
                    @error('birthDate')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="date" id="birthDate" name="birthDate" placeholder="First Name"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('birthDate') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="birthDate"/>
                </div>
            </div>
            <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="ssn" class="text-xs text-gray-700 font-bold">Social Security Number:</label>
                    @error('ssn')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="ssn" name="ssn" placeholder="xxx-xx-xxxx"
                        class="pl-4 pr-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('ssn') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="ssn"/>
                </div>
            </div>
        </div>

        {{-- Property --}}
        <div class="flex flex-col sm:flex-row items-center">
            <div class="w-full sm:w-full mt-4 sm:mt-8">
                <label for="propertyId" class="text-xs text-gray-700 font-bold">What property are you instrested in?</label>
                <div class="w-full mt-1">
                    <select name="propertyId" required
                            class="text-sm pl-2 w-full border rounded py-2 bg-white focus:outline-none"
                            wire:model.debounce.500ms="propertyId">
                        @foreach ($properties as $property)
                            <option value="{{$property}}">{{$property}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <button class="px-4 py-2 bg-gray-300 text-white rounded-lg 
                        mt-4 transition-all ease-in-out duration-200 cursor-not-allowed"
                    disabled>
                Back
            </button>
            <button class="px-4 py-2 bg-teal-300  hover:bg-teal-400 text-white rounded-lg 
                          mt-4 transition-all ease-in-out duration-200"
                    wire:click="stepOneSubmit">
                Next
            </button>
        </div>

    </div>
    @endif

    {{-- Step 2 --}}
    @if ($step === 2)
    <div>

        {{-- Drivers License # --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="driversLicenseNumber" class="text-xs text-gray-700 font-bold">Drivers License Number:</label>
                    @error('driversLicenseNumber')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="driversLicenseNumber" name="driversLicenseNumber" placeholder="License Number"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('driversLicenseNumber') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="driversLicenseNumber"/>
                </div>
            </div>
        </div>

        {{-- Expiration and State --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="driversLicenseExp" class="text-xs text-gray-700 font-bold">Expiration:</label>
                    @error('driversLicenseExp')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="date" id="driversLicenseExp" name="driversLicenseExp" placeholder="Expiration Date"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('driversLicenseExp') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="driversLicenseExp"/>
                </div>
            </div>
            <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="driversLicenseState" class="text-xs text-gray-700 font-bold">Isssuing State:</label>
                    @error('driversLicenseState')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="driversLicenseState" name="driversLicenseState" placeholder="State"
                        class="pl-4 pr-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('driversLicenseState') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="driversLicenseState"/>
                </div>
            </div>
        </div>

        {{-- Contact Name, Relationship --}}
        <div class="flex flex-col sm:flex-row items-center mt-4 sm:mt-8">
            <div class="w-full sm:w-2/3">
                <div class="flex justify-between items-center w-full">
                    <label for="emergencyContact" class="text-xs text-gray-700 font-bold">Emergency Contact:</label>
                    @error('emergencyContact')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="emergencyContact" id="emergencyContact" name="emergencyContact" placeholder="Emergency Contact"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('emergencyContact') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="emergencyContact"/>
                </div>
            </div>
            <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="contactRelationship" class="text-xs text-gray-700 font-bold">Relationship:</label>
                    @error('contactRelationship')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="contactRelationship" name="contactRelationship" placeholder="Relationship"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('contactRelationship') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="contactRelationship"/>
                </div>
            </div>
        </div>

        {{-- Contact Phone and Email --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="contactPhone" class="text-xs text-gray-700 font-bold">Contact Phone:</label>
                    @error('contactPhone')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="contactPhone" name="contactPhone" placeholder="Contact Phone"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('contactPhone') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="contactPhone"/>
                </div>
            </div>
            <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="contactEmail" class="text-xs text-gray-700 font-bold">Contact Email:</label>
                    @error('contactEmail')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="contactEmail" name="contactEmail" placeholder="State"
                        class="pl-4 pr-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('contactEmail') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="contactEmail"/>
                </div>
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <button class="px-4 py-2 bg-orange-300  hover:bg-orange-400 text-white rounded-lg 
                        mt-4 transition-all ease-in-out duration-200"
                    wire:click="back(1)">
                Back
            </button>
            <button class="px-4 py-2 bg-teal-300  hover:bg-teal-400 text-white rounded-lg 
                          mt-4 transition-all ease-in-out duration-200"
                    wire:click="stepTwoSubmit">
                Next
            </button>
        </div>

    </div>
    @endif

    {{-- Step 3 --}}
    @if ($step === 3)
    <div>

        {{-- Rental --}}
        <div class="flex items-center mt-2 justify-end">
            <span class="text-sm text-teal-800 font-bold mr-2">Residence is a rental</span>
            <div class="flex items-center h-5">
                <input type="checkbox"
                       wire:model="rental"
                       class="form-checkbox h-3 w-3 text-teal-400 transition duration-150 ease-in-out">
            </div>
        </div>

        {{-- Address--}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-2">
            <div class="w-full mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="currentAddress" class="text-xs text-gray-700 font-bold">Address:</label>
                    @error('currentAddress')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="currentAddress" name="currentAddress" placeholder="Address"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('currentAddress') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="currentAddress"/>
                </div>
            </div>
        </div>

        {{-- City, State --}}
        <div class="flex flex-col sm:flex-row items-center mt-4 sm:mt-8">
            <div class="w-full sm:w-2/3">
                <div class="flex justify-between items-center w-full">
                    <label for="city" class="text-xs text-gray-700 font-bold">City:</label>
                    @error('city')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="city" id="city" name="city" placeholder="City"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('city') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="city"/>
                </div>
            </div>
            <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="state" class="text-xs text-gray-700 font-bold">State:</label>
                    @error('state')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="state" name="state" placeholder="State"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('state') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="state"/>
                </div>
            </div>
        </div>

        {{-- Zip, Payment and Duration --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/3 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="livingDuration" class="text-xs text-gray-700 font-bold">Zip Code:</label>
                    @error('zip')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="zip" name="zip" placeholder="Zip Code"
                        class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('zip') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="zip"/>
                </div>
            </div>
            <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="livingDuration" class="text-xs text-gray-700 font-bold">How long have you been here?</label>
                    @error('livingDuration')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="livingDuration" name="livingDuration" placeholder="Duration"
                        class="pl-4 pr-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('livingDuration') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="livingDuration"/>
                </div>
            </div>
            <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="monthlyPayment" class="text-xs text-gray-700 font-bold">Monthly Payment:</label>
                    @error('monthlyPayment')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <div class="font-prompt text-lg mr-1 z-10 input-icon-padding-6px">$</div>
                    <input type="number" min="1" max="100000" step=".01" id="monthlyPayment" name="monthlyPayment"
                        class="pl-4 pr-4 w-full border rounded py-2 text-gray-700 focus:outline-none -mx-5 text-right
                            @error('monthlyPayment') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="monthlyPayment"/>
                </div>
            </div>
        </div>

        {{-- Reason for Moving --}}
        <div class="w-full mt-4 sm:mt-8">
            <div class="flex justify-between items-center w-full">
                <label for="movingReason" class="text-xs text-gray-700 font-bold">Reason for moving:</label>
                @error('movingReason')
                    <div class="text-orange-400 text-xs font-bold italic">
                        {{ $message }} 
                    </div>
                @enderror
            </div>
            <div class="flex items-center mt-1">
                <textarea name="movingReason" rows="5"
                          class="pl-4 pr-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('movingReason') border-orange-400 @enderror" required 
                          wire:model.debounce.500ms="movingReason">
                </textarea>
            </div>
        </div>

        @if ($rental)
            {{-- Landlord Name and Lease End Date --}}
            <div class="flex flex-col sm:flex-row items-center sm:mt-8">
                <div class="w-full sm:w-2/3 mt-4 sm:mt-0">
                    <div class="flex justify-between items-center w-full">
                        <label for="landlordName" class="text-xs text-gray-700 font-bold">Landlord Name:</label>
                        @error('landlordName')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }} 
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="text" id="landlordName" name="landlordName" placeholder="Landlord Name"
                            class="pl-4 pr-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('landlordName') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="landlordName"/>
                    </div>
                </div>
                <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                    <div class="flex justify-between items-center w-full">
                        <label for="leaseEnd" class="text-xs text-gray-700 font-bold">Lease End Date:</label>
                        @error('leaseEnd')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="date" id="leaseEnd" name="leaseEnd" placeholder="Expiration Date"
                            class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('leaseEnd') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="leaseEnd"/>
                    </div>
                </div>
            </div>

            {{-- Landlord Phone and Email --}}
            <div class="flex flex-col sm:flex-row items-center sm:mt-8">
                <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                    <div class="flex justify-between items-center w-full">
                        <label for="landlordPhone" class="text-xs text-gray-700 font-bold">Landlord Phone:</label>
                        @error('landlordPhone')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="text" id="landlordPhone" name="landlordPhone" placeholder="xxx-xxx-xxxx"
                            class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('landlordPhone') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="landlordPhone"/>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
                    <div class="flex justify-between items-center w-full">
                        <label for="landlordEmail" class="text-xs text-gray-700 font-bold">Landlord Email:</label>
                        @error('landlordEmail')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }} 
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="text" id="landlordEmail" name="landlordEmail" placeholder="Landlord Email"
                            class="pl-4 pr-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('landlordEmail') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="landlordEmail"/>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex justify-between mt-6">
            <button class="px-4 py-2 bg-orange-300  hover:bg-orange-400 text-white rounded-lg 
                        mt-4 transition-all ease-in-out duration-200"
                    wire:click="back(2)">
                Back
            </button>
            <button class="px-4 py-2 bg-teal-300  hover:bg-teal-400 text-white rounded-lg 
                          mt-4 transition-all ease-in-out duration-200"
                    wire:click="stepThreeSubmit">
                Next
            </button>
        </div>

    </div> 
    @endif

</div>
