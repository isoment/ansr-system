<div class="flex flex-col">

    <div class="mb-4">
        @include('inc.livewire-success')
    </div>

    <h2 class="font-bold text:lg lg:text-2xl text-center">Edit Property</h2>
    <h6 class="font-bold text-sm mt-4 mb-8 text-center">
        You can edit the property details using the form below.
    </h6>

    <form wire:submit.prevent="submitForm">

        @csrf

        {{-- Name & Region --}}
        <div class="flex flex-col sm:flex-row items-center">
            <div class="w-full sm:w-3/4">
                <div class="flex justify-between items-center w-full">
                    <label for="name" class="text-xs text-gray-700 font-bold">Property Name:</label>
                    @error('name')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input type="text" id="name" name="name"
                        class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                            @error('name') border-orange-400 @enderror" value="{{old('name')}}" required 
                        wire:model.debounce.500ms="name"/>
                </div>
            </div>
            <div class="w-full sm:w-1/4 sm:ml-8 mt-4 sm:mt-0">
                <label for="region" class="text-xs text-gray-700 font-bold">Region:</label>
                <div class="w-full mt-1">
                    <select name="region" id="region" required
                            class="text-sm pl-2 w-full border focus:border-teal-400 rounded py-2 bg-white focus:outline-none"
                            wire:model.debounce.500ms="region">
                        <option value="" disabled selected hidden>Select Region</option>
                        @foreach ($regions as $region)
                            <option value="{{$region}}" {{old('region') == $region ? 'selected' : ''}}>{{$region}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Street --}}
        <div class="w-full mt-4 sm:mt-8">
            <div class="flex justify-between items-center w-full">
                <label for="street" class="text-xs text-gray-700 font-bold">Street:</label>
                @error('street')
                    <div class="text-orange-400 text-xs font-bold italic">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex items-center mt-1">
                <input type="text" id="street" name="street" placeholder="Street"
                    class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                        @error('street') border-orange-400 @enderror" value="{{ old('street') }}" required 
                    wire:model.debounce.500ms="street"/>
            </div>
        </div>

        {{-- City --}}
        <div class="w-full mt-4 sm:mt-8">
            <div class="flex justify-between items-center w-full">
                <label for="city" class="text-xs text-gray-700 font-bold">City:</label>
                @error('city')
                    <div class="text-orange-400 text-xs font-bold italic">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex items-center mt-1">
                <input type="text" id="city" name="city" placeholder="City"
                    class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                        @error('city') border-orange-400 @enderror" value="{{ old('city') }}" required 
                    wire:model.debounce.500ms="city"/>
            </div>
        </div>

        {{-- State Zip --}}
        <div class="flex flex-col sm:flex-row items-center sm:mt-8">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
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
                        class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                            @error('state') border-orange-400 @enderror" value="{{ old('state') }}" required 
                        wire:model.debounce.500ms="state"/>
                </div>
            </div>
            <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
                <div class="flex justify-between items-center w-full">
                    <label for="zip" class="text-xs text-gray-700 font-bold">Zip:</label>
                    @error('zip')
                        <div class="text-orange-400 text-xs font-bold italic">
                            {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="flex items-center mt-1">
                    <input id="zip" name="zip" placeholder="Zip"
                        class="pl-4 pr-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                            @error('zip') border-orange-400 @enderror" value="{{ old('zip') }}" required 
                        wire:model.debounce.500ms="zip"/>
                </div>
            </div>
        </div>

        {{-- Phone and Email --}}
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
                        class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
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
                    <input type="text" id="phone" name="phone" placeholder="Phone Number"
                        class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                            @error('phone') border-orange-400 @enderror" value="{{ old('phone') }}" required 
                        wire:model.debounce.500ms="phone"/>
                </div>
            </div>
        </div>

        <div class="text-center mt-6">
            <button type="submit" class="w-full block sm:inline-block sm:w-1/4 px-6 py-3 bg-orange-400 
                hover:bg-orange-500 text-white rounded-lg mt-4 transition-all ease-in-out
                duration-200">Submit
            </button>
        </div>

    </form>

</div>
