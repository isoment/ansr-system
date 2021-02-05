<div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-8 
            py-6 px-4 md:px-12 shadow-sm">

    <h3 class="font-bold text-lg">Step: {{$step}}</h3> 

    {{-- Step 1 --}}
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
                            @error('email') border-orange-400 @enderror" value="{{ old('email') }}" required 
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
                            @error('phone') border-orange-400 @enderror" value="{{ old('phone') }}" required 
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
                    <label for="SSN" class="text-xs text-gray-700 font-bold">Social Security Number:</label>
                    @error('SSN')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="SSN" name="SSN" placeholder="xxx-xx-xxxx"
                        class="pl-4 pr-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('SSN') border-orange-400 @enderror" required 
                        wire:model.debounce.500ms="SSN"/>
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
            <button type="submit" 
                    class="px-4 py-2 bg-gray-300 text-white rounded-lg 
                        mt-4 transition-all ease-in-out duration-200 cursor-not-allowed"
                    disabled>
                Back
            </button>
            <button type="submit" 
                    class="px-4 py-2 bg-teal-300  hover:bg-teal-400 text-white rounded-lg 
                          mt-4 transition-all ease-in-out duration-200">Next
            </button>
        </div>
    </div>

</div>
