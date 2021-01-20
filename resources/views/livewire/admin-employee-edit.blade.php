<div class="flex flex-col">

    <div class="my-2">
        @include('inc.livewire-success')
    </div>
    

    <h2 class="font-bold text:lg lg:text-2xl text-center">Edit Employee</h2>
    <h6 class="font-bold text-sm mt-4 mb-8 text-center">You may edit this employee below. 
        All fields are required.
    </h6>

    <form wire:submit.prevent="editEmployee">

        {{-- First and Last Name --}}
        <div class="flex flex-col sm:flex-row items-center">
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
                <input type="email" id="email" name="email" placeholder="Email"
                    class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                        @error('email') border-orange-400 @enderror" required 
                    wire:model.debounce.500ms="email"/>
            </div>
        </div>

        {{-- Phone --}}
        <div class="w-full mt-4 sm:mt-8">
            <div class="flex justify-between items-center w-full">
                <label for="phone" class="text-xs text-gray-700 font-bold">Phone:</label>
                @error('phone')
                    <div class="text-orange-400 text-xs font-bold italic">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex items-center mt-1">
                <input type="text" id="phone" name="phone" placeholder="Phone"
                    class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                        @error('phone') border-orange-400 @enderror" required 
                    wire:model.debounce.500ms="phone"/>
            </div>
        </div>

        {{-- Region and Role --}}
        <div class="flex flex-col sm:flex-row items-center">
            <div class="w-full sm:w-1/2 mt-4 sm:mt-8">
                <label for="region" class="text-xs text-gray-700 font-bold">Region:</label>
                <div class="w-full mt-1">
                    <select name="region" required
                            class="text-sm pl-2 w-full border rounded py-2 bg-white focus:outline-none"
                            wire:model.debounce.500ms="region">
                        @foreach ($regions as $region)
                            <option value="{{$region}}">{{$region}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="w-full sm:w-1/2 sm:ml-4 mt-4 sm:mt-8">
                <label for="role" class="text-xs text-gray-700 font-bold">Role:</label>
                <div class="w-full mt-1">
                    <select name="role" required
                            class="text-sm pl-2 w-full border rounded py-2 bg-white focus:outline-none"
                            wire:model.debounce.500ms="role">
                        <option value="Management">Management</option>
                        <option value="Administrative">Administrative</option>
                        <option value="Maintenance">Maintenance</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Employee Id --}}
        <div class="w-full mt-4 sm:mt-8">
            <div class="flex justify-between items-center w-full">
                <label for="employeeId" class="text-xs text-gray-700 font-bold">Employee ID:</label>
                @error('employeeId')
                    <div class="text-orange-400 text-xs font-bold italic">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="flex items-center mt-1">
                <input type="text" id="employeeId" name="employeeId" placeholder="Employee ID"
                    class="px-4 w-full border rounded py-2 text-gray-700 focus:outline-none
                        @error('employeeId') border-orange-400 @enderror" required 
                    wire:model.debounce.500ms="employeeId"/>
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