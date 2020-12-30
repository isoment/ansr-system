<div class="flex flex-col">

    <h6 class="font-bold text-sm mt-4 mb-8 text-center">Please fill out the form below with the relevant property information. All fields are required!</h6>

    {{-- Name & Region --}}
    <div class="flex flex-col sm:flex-row items-center">
        <div class="w-full sm:w-3/4">
            <label for="name" class="text-xs text-gray-700 font-bold">Property Name:</label>
            <div class="flex items-center mt-1">
                <input type="text" id="name" name="name" placeholder="Property Name"
                    class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                        @error('name') border-orange-400 @enderror" value="{{ old('name') }}" required />
            </div>
            @error('name')
                <p class="text-orange-400 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="w-full sm:w-1/4 sm:ml-8 mt-4 sm:mt-0">
            <label for="category" class="text-xs text-gray-700 font-bold">Region:</label>
            <div class="w-full mt-1">
                <select name="category" id="category" required
                        class="text-sm pl-2 w-full border focus:border-teal-400 rounded py-2 bg-white focus:outline-none">
                    {{-- @foreach ($requestCategories as $category)
                        <option value="{{$category}}" {{old('category') == $category ? 'selected' : ''}}>{{$category}}</option>
                    @endforeach --}}
                    <option value="First">First</option>
                    <option value="Second">Second</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Street --}}
    <div class="w-full mt-4 sm:mt-8">
        <label for="street" class="text-xs text-gray-700 font-bold">Street:</label>
        <div class="flex items-center mt-1">
            <input type="text" id="street" name="street" placeholder="Street"
                class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                    @error('street') border-orange-400 @enderror" value="{{ old('street') }}" required />
        </div>
        @error('street')
            <p class="text-orange-400 text-xs italic mt-4">
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- City State Zip --}}
    <div class="flex flex-col sm:flex-row items-center mt-4 sm:mt-8">
        <div class="w-full sm:w-1/2">
            <label for="street" class="text-xs text-gray-700 font-bold">City:</label>
            <div class="flex items-center mt-1">
                <input type="text" id="city" name="city" placeholder="City"
                    class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                        @error('city') border-orange-400 @enderror" value="{{ old('city') }}" required />
            </div>
            @error('city')
                <p class="text-orange-400 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="w-full sm:w-1/4 sm:ml-4 mt-4 sm:mt-0">
            <label for="state" class="text-xs text-gray-700 font-bold">State:</label>
            <div class="flex items-center mt-1">
                <input type="text" id="state" name="state" placeholder="State"
                    class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                        @error('state') border-orange-400 @enderror" value="{{ old('state') }}" required />
            </div>
            @error('state')
                <p class="text-orange-400 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="w-full sm:w-1/4 sm:ml-4 mt-4 sm:mt-0">
            <label for="zip" class="text-xs text-gray-700 font-bold">Zip Code:</label>
            <div class="flex items-center mt-1">
                <input type="number" id="zip" name="zip" placeholder="Zip"
                    class="pl-4 pr-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                        @error('zip') border-orange-400 @enderror" value="{{ old('zip') }}" required />
            </div>
            @error('zip')
                <p class="text-orange-400 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>

    {{-- Phone and Email --}}
    <div class="flex flex-col sm:flex-row items-center mt-4 sm:mt-8">
        <div class="w-full sm:w-1/2">
            <label for="email" class="text-xs text-gray-700 font-bold">Email:</label>
            <div class="flex items-center mt-1">
                <input type="email" id="email" name="email" placeholder="Email"
                    class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                        @error('email') border-orange-400 @enderror" value="{{ old('email') }}" required />
            </div>
            @error('email')
                <p class="text-orange-400 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-0">
            <label for="phone" class="text-xs text-gray-700 font-bold">Phone:</label>
            <div class="flex items-center mt-1">
                <input type="text" id="phone" name="phone" placeholder="Phone Number"
                    class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                        @error('phone') border-orange-400 @enderror" value="{{ old('phone') }}" required />
            </div>
            @error('phone')
                <p class="text-orange-400 text-xs italic mt-4">
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>

    <div class="text-center mt-6">
        <button type="submit" class="w-full block sm:inline-block sm:w-1/4 px-6 py-3 bg-orange-400 
            hover:bg-orange-500 text-white rounded-lg mt-4 transition-all ease-in-out
            duration-200">Submit
        </button>
    </div>

</div>
