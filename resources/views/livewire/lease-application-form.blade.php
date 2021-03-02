<div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-8 
            py-6 px-4 md:px-12 shadow-sm">

    {{-- Progress Bar --}}
    <div class="progress-bar justify-center items-center mt-2 mb-8 hidden sm:flex font-bold 
                font-prompt text-cool-gray-600">

        <div class="step text-center mx-8">
            <div class="bullet border-2 border-gray-600 h-8 w-8 my-1 rounded-full flex items-center 
                        justify-center relative {{$step >= 1 ? 'text-orange-400 border-orange-400' : ''}}">
                <span class="{{$step > 1 ? 'hidden' : 'block'}}">1</span>
                <div class="check fas fa-check absolute {{$step > 1 ? '' : 'check-hidden'}}"></div>
            </div>
        </div>
        <div class="step text-center mx-8">
            <div class="bullet border-2 border-gray-600 h-8 w-8 my-1 rounded-full flex items-center 
                        justify-center relative {{$step >= 2 ? 'text-orange-400 border-orange-400' : ''}}">
                <span class="{{$step > 2 ? 'hidden' : 'block'}}">2</span>
                <div class="check fas fa-check absolute {{$step > 2 ? '' : 'check-hidden'}}"></div>
            </div>
        </div>
        <div class="step text-center mx-8">
            <div class="bullet border-2 border-gray-600 h-8 w-8 my-1 rounded-full flex items-center 
                        justify-center relative {{$step >= 3 ? 'text-orange-400 border-orange-400' : ''}}">
                <span class="{{$step > 3 ? 'hidden' : 'block'}}">3</span>
                <div class="check fas fa-check absolute {{$step > 3 ? '' : 'check-hidden'}}"></div>
            </div>
        </div>
        <div class="step text-center mx-8">
            <div class="bullet border-2 border-gray-600 h-8 w-8 my-1 rounded-full flex items-center 
                        justify-center relative {{$step >= 4 ? 'text-orange-400 border-orange-400' : ''}}">
                <span class="{{$step > 4 ? 'hidden' : 'block'}}">4</span>
                <div class="check fas fa-check absolute {{$step > 4 ? '' : 'check-hidden'}}"></div>
            </div>
        </div>
        <div class="step text-center mx-8">
            <div class="bullet border-2 border-gray-600 h-8 w-8 my-1 rounded-full flex items-center 
                        justify-center relative {{$step >= 5 ? 'text-orange-400 border-orange-400' : ''}}">
                <span class="{{$step > 5 ? 'hidden' : 'block'}}">5</span>
                <div class="check fas fa-check absolute {{$step > 5 ? '' : 'check-hidden'}}"></div>
            </div>
        </div>
        <div class="step text-center mx-8">
            <div class="bullet border-2 border-gray-600 h-8 w-8 my-1 rounded-full flex items-center 
                        justify-center relative {{$step >= 6 ? 'text-orange-400 border-orange-400' : ''}}">
                <span class="{{$step > 6 ? 'hidden' : 'block'}}">6</span>
                <div class="check fas fa-check absolute {{$step > 6 ? '' : 'check-hidden'}}"></div>
            </div>
        </div>
    </div>

    {{-- Step 1 --}}
    @if ($step === 1)
    <h3 class="font-bold text-lg">Step 1: Personal Information</h3>
    <div class="mt-3 text-gray-600 flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <div>
            <h6 class="font-bold mb-1">Application For</h6>
            <div>
                {{$propertyListing->property->street}}
            </div>
            @if ($propertyListing->unit)
                <div>
                    {{$propertyListing->unit}}
                </div>
            @endif
            <div>
                {{$propertyListing->property->city}}, {{$propertyListing->property->state}} {{$propertyListing->property->zipcode}}
            </div>
        </div>
        <div class="flex sm:flex-col justify-between items-center mt-2 sm:mt-0">
            <div class="sm:mb-2 font-bold">
                Previous Renter
            </div>
            <div class="sm:w-full">
                <select name="" id="" class="sm:w-full bg-white border border-gray-300 rounded-lg px-2 py-2"
                        wire:model="previousRenter">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
    </div>
    <div>
        {{-- Name --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="firstName" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>First Name:</label>
                    @error('firstName')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="firstName" name="firstName" placeholder="First Name"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('firstName') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="firstName"/>
                </div>
            </div>
            <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="lastName" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Last Name:</label>
                    @error('lastName')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="lastName" name="lastName" placeholder="Last Name"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('lastName') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="lastName"/>
                </div>
            </div>
        </div>

        {{-- Email Phone --}}
        <div class="flex flex-col sm:flex-row items-center mt-4 sm:mt-8">
            <div class="w-full sm:w-2/3">
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
            <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="phone" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Phone:</label>
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
        </div>

        {{-- SSN & Birthdate --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="birthDate" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Birthdate:</label>
                    @error('birthDate')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="date" id="birthDate" name="birthDate" placeholder="First Name"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('birthDate') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="birthDate"/>
                </div>
            </div>
            <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="ssn" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Social Security Number:</label>
                    @error('ssn')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="ssn" name="ssn" placeholder="xxx-xx-xxxx"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('ssn') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="ssn"/>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6">
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
    <h3 class="font-bold text-lg">Step 2: Drivers License & Emrgency Contact</h3>
    <div>

        {{-- Drivers License # --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="driversLicenseNumber" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Drivers License Number:</label>
                    @error('driversLicenseNumber')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="driversLicenseNumber" name="driversLicenseNumber" placeholder="License Number"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('driversLicenseNumber') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="driversLicenseNumber"/>
                </div>
            </div>
        </div>

        {{-- Expiration and State --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="driversLicenseExp" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Expiration:</label>
                    @error('driversLicenseExp')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="date" id="driversLicenseExp" name="driversLicenseExp" placeholder="Expiration Date"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('driversLicenseExp') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="driversLicenseExp"/>
                </div>
            </div>
            <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="driversLicenseState" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Isssuing State:</label>
                    @error('driversLicenseState')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="driversLicenseState" name="driversLicenseState" placeholder="State"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('driversLicenseState') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="driversLicenseState"/>
                </div>
            </div>
        </div>

        {{-- Contact Name, Relationship --}}
        <div class="flex flex-col sm:flex-row items-center mt-4 sm:mt-8">
            <div class="w-full sm:w-2/3">
                <div class="flex justify-between items-center w-full">
                    <label for="emergencyContact" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Emergency Contact:</label>
                    @error('emergencyContact')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="emergencyContact" id="emergencyContact" name="emergencyContact" placeholder="Emergency Contact"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('emergencyContact') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="emergencyContact"/>
                </div>
            </div>
            <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="contactRelationship" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Relationship:</label>
                    @error('contactRelationship')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="contactRelationship" name="contactRelationship" placeholder="Relationship"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('contactRelationship') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="contactRelationship"/>
                </div>
            </div>
        </div>

        {{-- Contact Phone and Email --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="contactPhone" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Contact Phone:</label>
                    @error('contactPhone')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="contactPhone" name="contactPhone" placeholder="Contact Phone"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
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
                    <input type="text" id="contactEmail" name="contactEmail" placeholder="Contact Email"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
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
    <h3 class="font-bold text-lg">Step 3: Previous Residence</h3>
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
                    <label for="currentAddress" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Address:</label>
                    @error('currentAddress')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="currentAddress" name="currentAddress" placeholder="Address"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('currentAddress') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="currentAddress"/>
                </div>
            </div>
        </div>

        {{-- City, State --}}
        <div class="flex flex-col sm:flex-row items-center mt-4 sm:mt-8">
            <div class="w-full sm:w-2/3">
                <div class="flex justify-between items-center w-full">
                    <label for="city" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>City:</label>
                    @error('city')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="city" id="city" name="city" placeholder="City"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('city') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="city"/>
                </div>
            </div>
            <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="state" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>State:</label>
                    @error('state')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="state" name="state" placeholder="State"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('state') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="state"/>
                </div>
            </div>
        </div>

        {{-- Zip, Payment and Duration --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/3 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="livingDuration" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Zip Code:</label>
                    @error('zip')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="zip" name="zip" placeholder="Zip Code"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('zip') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="zip"/>
                </div>
            </div>
            <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="livingDuration" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>How long have you been here?</label>
                    @error('livingDuration')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="livingDuration" name="livingDuration" placeholder="Duration"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('livingDuration') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="livingDuration"/>
                </div>
            </div>
            <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="monthlyPayment" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Monthly Payment:</label>
                    @error('monthlyPayment')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <div class="font-prompt text-lg mr-1 z-10 input-icon-padding-6px">$</div>
                    <input type="number" min="1" max="100000" step=".01" id="monthlyPayment" name="monthlyPayment"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none -mx-5 text-right
                            @error('monthlyPayment') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="monthlyPayment"/>
                </div>
            </div>
        </div>

        {{-- Reason for Moving --}}
        <div class="w-full mt-4 sm:mt-8">
            <div class="flex justify-between items-center w-full">
                <label for="movingReason" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Reason for moving:</label>
                @error('movingReason')
                    <div class="text-orange-400 text-xs font-bold italic">
                        {{ $message }} 
                    </div>
                @enderror
            </div>
            <div class="flex items-center mt-1">
                <textarea name="movingReason" rows="5"
                          class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
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
                        <label for="landlordName" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Landlord Name:</label>
                        @error('landlordName')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }} 
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="text" id="landlordName" name="landlordName" placeholder="Landlord Name"
                            class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                @error('landlordName') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="landlordName"/>
                    </div>
                </div>
                <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                    <div class="flex justify-between items-center w-full">
                        <label for="leaseEnd" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Lease End Date:</label>
                        @error('leaseEnd')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="date" id="leaseEnd" name="leaseEnd" placeholder="Expiration Date"
                            class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                @error('leaseEnd') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="leaseEnd"/>
                    </div>
                </div>
            </div>

            {{-- Landlord Phone and Email --}}
            <div class="flex flex-col sm:flex-row items-center sm:mt-8">
                <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                    <div class="flex justify-between items-center w-full">
                        <label for="landlordPhone" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Landlord Phone:</label>
                        @error('landlordPhone')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="text" id="landlordPhone" name="landlordPhone" placeholder="xxx-xxx-xxxx"
                            class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
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
                            class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
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

    @if ($step === 4)
    <h3 class="font-bold text-lg">Step 4: Sources of Income</h3>
    <div>
        {{-- Employer and Duration --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="currentEmployer" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Employer:</label>
                    @error('currentEmployer')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="currentEmployer" name="currentEmployer" placeholder="Employer"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('currentEmployer') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="currentEmployer"/>
                </div>
            </div>
            <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="employmentDuration" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Employment Duration:</label>
                    @error('employmentDuration')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="employmentDuration" name="employmentDuration" placeholder="Employment Duration"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('employmentDuration') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="employmentDuration"/>
                </div>
            </div>
        </div>

        {{-- Employer Address--}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="employerAddress" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Employer Address:</label>
                    @error('employerAddress')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="employerAddress" name="employerAddress" placeholder="Employer Address"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('employerAddress') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="employerAddress"/>
                </div>
            </div>
        </div>

        {{-- Employer Email and Phone --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-2/3 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="employerEmail" class="text-xs text-gray-700 font-bold">Employer Email:</label>
                    @error('employerEmail')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="employerEmail" name="employerEmail" placeholder="Employer Email"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('employerEmail') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="employerEmail"/>
                </div>
            </div>
            <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="employerPhone" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Employer Phone:</label>
                    @error('employerPhone')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="employerPhone" name="employerPhone" placeholder="Employer Phone"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('employerPhone') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="employerPhone"/>
                </div>
            </div>
        </div>

        {{-- Other Income --}}
        <div class="w-full mt-4 sm:mt-8">
            <div class="flex justify-between items-center w-full">
                <label for="incomeOther" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>List other sources of income:</label>
                @error('incomeOther')
                    <div class="text-orange-400 text-xs font-bold italic">
                        {{ $message }} 
                    </div>
                @enderror
            </div>
            <div class="flex items-center mt-1">
                <textarea name="incomeOther" rows="5"
                            class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                @error('incomeOther') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="incomeOther">
                </textarea>
            </div>
        </div>

        {{-- Employment and other income --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="grossMonthlyIncome" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Job gross monthly income:</label>
                    @error('grossMonthlyIncome')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <div class="font-prompt text-lg mr-1 z-10 input-icon-padding-6px">$</div>
                    <input type="number" min="1" max="100000" step=".01" id="grossMonthlyIncome" name="grossMonthlyIncome"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none -mx-5 text-right
                            @error('grossMonthlyIncome') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="grossMonthlyIncome"/>
                </div>
            </div>
            <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="grossIncomeOther" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Monthly income Other:</label>
                    @error('grossIncomeOther')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <div class="font-prompt text-lg mr-1 z-10 input-icon-padding-6px">$</div>
                    <input type="number" min="1" max="100000" step=".01" id="grossIncomeOther" name="grossIncomeOther"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none -mx-5 text-right
                            @error('grossIncomeOther') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="grossIncomeOther"/>
                </div>
            </div>
        </div>

        {{-- Other expenses --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/3 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="childSupport" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Child Support Monthly:</label>
                    @error('childSupport')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <div class="font-prompt text-lg mr-1 z-10 input-icon-padding-6px">$</div>
                    <input type="number" min="1" max="100000" step=".01" id="childSupport" name="childSupport"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none -mx-5 text-right
                            @error('childSupport') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="childSupport"/>
                </div>
            </div>
            <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="alimony" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Alimony Monthly:</label>
                    @error('alimony')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <div class="font-prompt text-lg mr-1 z-10 input-icon-padding-6px">$</div>
                    <input type="number" min="1" max="100000" step=".01" id="alimony" name="alimony"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none -mx-5 text-right
                            @error('alimony') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="alimony"/>
                </div>
            </div>
            <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="carPayment" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Car Payment Monthly:</label>
                    @error('carPayment')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <div class="font-prompt text-lg mr-1 z-10 input-icon-padding-6px">$</div>
                    <input type="number" min="1" max="100000" step=".01" id="carPayment" name="carPayment"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none -mx-5 text-right
                            @error('carPayment') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="carPayment"/>
                </div>
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <button class="px-4 py-2 bg-orange-300  hover:bg-orange-400 text-white rounded-lg 
                        mt-4 transition-all ease-in-out duration-200"
                    wire:click="back(3)">
                Back
            </button>
            <button class="px-4 py-2 bg-teal-300  hover:bg-teal-400 text-white rounded-lg 
                          mt-4 transition-all ease-in-out duration-200"
                    wire:click="stepFourSubmit">
                Next
            </button>
        </div>

    </div>
    @endif

    @if ($step === 5)
    <h3 class="font-bold text-lg">Step 5: References and Pets</h3>
    <div>
        {{-- Reference One --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="refOneName" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Reference:</label>
                    @error('refOneName')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="refOneName" name="refOneName" placeholder="Reference"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('refOneName') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="refOneName"/>
                </div>
            </div>
        </div>

        {{-- Reference Email and Phone --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="refOneEmail" class="text-xs text-gray-700 font-bold">Reference Email:</label>
                    @error('refOneEmail')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="refOneEmail" name="refOneEmail" placeholder="Reference Email"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('refOneEmail') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="refOneEmail"/>
                </div>
            </div>
            <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="refOnePhone" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Reference Phone:</label>
                    @error('refOnePhone')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="refOnePhone" name="refOnePhone" placeholder="Reference Phone"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('refOnePhone') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="refOnePhone"/>
                </div>
            </div>
        </div>

        {{-- Reference Two --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="refTwoName" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Reference:</label>
                    @error('refTwoName')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="refTwoName" name="refTwoName" placeholder="Reference"
                        class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('refTwoName') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="refTwoName"/>
                </div>
            </div>
        </div>

        {{-- Reference Email and Phone --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="refTwoEmail" class="text-xs text-gray-700 font-bold">Reference Email:</label>
                    @error('refTwoEmail')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="refTwoEmail" name="refTwoEmail" placeholder="Reference Email"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('refTwoEmail') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="refTwoEmail"/>
                </div>
            </div>
            <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="refTwoPhone" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Reference Phone:</label>
                    @error('refTwoPhone')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="refTwoPhone" name="refTwoPhone" placeholder="Reference Phone"
                        class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                            @error('refTwoPhone') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="refTwoPhone"/>
                </div>
            </div>
        </div>

        {{-- Pets --}}
        <div class="w-full mt-4 sm:mt-8">
            <div class="flex justify-between items-center w-full">
                <label for="pets" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Describe any pets you have.</label>
                @error('pets')
                    <div class="text-orange-400 text-xs font-bold italic">
                        {{ $message }} 
                    </div>
                @enderror
            </div>
            <div class="flex items-center mt-1">
                <textarea name="pets" rows="5" placeholder="List pets including type and size"
                            class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                @error('pets') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="pets">
                </textarea>
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <button class="px-4 py-2 bg-orange-300  hover:bg-orange-400 text-white rounded-lg 
                        mt-4 transition-all ease-in-out duration-200"
                    wire:click="back(4)">
                Back
            </button>
            <button class="px-4 py-2 bg-teal-300  hover:bg-teal-400 text-white rounded-lg 
                        mt-4 transition-all ease-in-out duration-200"
                    wire:click="stepFiveSubmit">
                Next
            </button>
        </div>
    </div>  
    @endif

    @if ($step === 6)
    <h3 class="font-bold text-lg">Step 6: Background Check Authorization</h3>
    <div>
        {{-- Criminal History --}}
        <div class="w-full mt-4 sm:mt-8">
            <div class="flex justify-between items-center w-full">
                <label for="criminal" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Have you ever been convicted of a crime?</label>
                @error('criminal')
                    <div class="text-orange-400 text-xs font-bold italic">
                        {{ $message }} 
                    </div>
                @enderror
            </div>
            <div class="flex items-center mt-1">
                <textarea name="criminal" rows="5" placeholder="Provide details here"
                            class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                @error('criminal') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="criminal">
                </textarea>
            </div>
        </div>

        {{-- Eviction History --}}
        <div class="w-full mt-4 sm:mt-8">
            <div class="flex justify-between items-center w-full">
                <label for="eviction" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Have you ever been evicted?</label>
                @error('eviction')
                    <div class="text-orange-400 text-xs font-bold italic">
                        {{ $message }} 
                    </div>
                @enderror
            </div>
            <div class="flex items-center mt-1">
                <textarea name="eviction" rows="5" placeholder="Provide details about any evictions"
                            class="pl-4 pr-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                @error('eviction') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="eviction">
                </textarea>
            </div>
        </div>

        <div class="w-full mt-8">
            <h5 class="font-bold text-lg tracking-wide my-2">Signature</h5>
            <div class="flex flex-col sm:flex-row items-center mt-2">
                <div class="w-full sm:w-2/3">
                    <div class="flex justify-between items-center w-full">
                        <label for="signature" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Enter your name to sign:</label>
                        @error('signature')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="signature" id="signature" name="signature" placeholder="Sign Here"
                            class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                @error('signature') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="signature"/>
                    </div>
                </div>
                <div class="w-full sm:w-1/3 sm:ml-4 mt-4 sm:mt-0">
                    <div class="flex justify-between items-center w-full">
                        <label for="dateSigned" class="text-xs text-gray-700 font-bold"><span class="text-orange-300 mr-1">&#9913;</span>Date:</label>
                        @error('dateSigned')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="date" id="dateSigned" name="dateSigned"
                            class="px-4 w-full border-2 rounded-lg py-2 text-gray-700 focus:outline-none
                                @error('dateSigned') border-orange-400 @enderror" required 
                            wire:model.debounce.500ms="dateSigned"/>
                    </div>
                </div>
            </div>
        </div>

        {{-- Agree Terms --}}
        <div class="w-full mt-8">
            <h5 class="font-bold text-lg text-center tracking-wide mt-2 mb-4">Terms and Authorization for background check</h5>
            <p class="text-sm">By signing above you agree to the following terms</p>
            <p class="text-sm my-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi hic corporis itaque dignissimos nulla, quam officiis 
                quae repellat delectus, a tempore, quod at maiores illum! Ratione tempore quasi aspernatur 
                nostrum reiciendis enim dolores necessitatibus, obcaecati dolore consectetur eos nulla 
                est illo assumenda expedita laudantium beatae vero explicabo consequuntur ipsam totam soluta at 
                numquam. Recusandae, eveniet.
            </p>
            <p class="text-sm my-2">
                Nostrum obcaecati lorem ipsum dolor sit amet consectetur adipisicing elit. Totam eligendi, maiores accusantium veniam distinctio 
                ex tenetur consequuntur suscipit. Vitae dolorem vero ipsum eos quam enim nemo tenetur doloremque 
                blanditiis doloribus ratione, explicabo nostrum obcaecati minus consequatur reiciendis laborum.
            </p>
            <p class="text-sm my-2">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea eveniet, modi quae doloribus minima dolorum quos dolore explicabo quisquam 
                qui, amet quis. Expedita non maiores autem doloremque at. Libero.
            </p>
            <div class="flex items-center justify-center mt-6">
                <input type="checkbox"
                       class="form-checkbox h-3 w-3 text-teal-400 transition duration-150 ease-in-out"
                       wire:model="agreeTerms">
                <div class="ml-2">I agree to the above terms</div>
                <span class="text-orange-300 ml-1 text-xs font-bold">&#9913;</span>
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <button class="px-4 py-2 bg-orange-300  hover:bg-orange-400 text-white rounded-lg 
                        mt-4 transition-all ease-in-out duration-200"
                    wire:click="back(5)">
                Back
            </button>
            @if ($agreeTerms)
                <button class="px-4 py-2 bg-teal-300  hover:bg-teal-400 text-white rounded-lg 
                            mt-4 transition-all ease-in-out duration-200"
                        wire:click="stepFinal">
                    Submit
                </button>
            @endif

        </div>
    </div>
    @endif

</div>
