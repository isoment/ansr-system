<div>

    <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-8 py-6 px-4 md:px-12 shadow-sm">
        <div class="mb-4">
            @include('inc.livewire-success')
        </div>
        <div class="text-left">
            <h2 class="text-2xl font-bold mb-3">New Region</h2>
            <h6 class="text-sm font-bold mb-6">You can add a new region to the application here</h6>
        </div>
        <form wire:submit.prevent="submitForm">
            @csrf
            <div class="flex flex-col sm:flex-row items-center">
                <div class="w-full sm:w-1/2">
                    <div class="flex flex-col sm:flex-row justify-start sm:justify-between sm:items-center w-full">
                        <label for="name" class="text-xs text-gray-700 font-bold">Region Name:</label>
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
                <div class="w-full sm:w-1/2 sm:ml-8 mt-4 sm:mt-0">
                    <div class="flex flex-col sm:flex-row justify-start sm:justify-between sm:items-center w-full">
                        <label for="abbreviation" class="text-xs text-gray-700 font-bold">Abbreviation:</label>
                        @error('abbreviation')
                            <div class="text-orange-400 text-xs font-bold italic">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center mt-1">
                        <input type="text" id="abbreviation" name="abbreviation"
                            class="px-4 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                                @error('abbreviation') border-orange-400 @enderror" value="{{old('abbreviation')}}" required 
                            wire:model.debounce.500ms="abbreviation"/>
                    </div>
                </div>
            </div>
    
            <div class="mt-4 text-center">
                <button type="submit" class="w-full block sm:inline-block sm:w-1/4 px-6 py-3 bg-orange-400 
                    hover:bg-orange-500 text-white rounded-lg mt-2 transition-all ease-in-out
                    duration-200">Submit
                </button>
            </div>
        </form>
    </div>

    <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-8 py-6 px-4 md:px-12 shadow-sm">
        <div class="mb-10 text-left">
            <h2 class="text-2xl font-bold mb-3">Regions</h2>
            <h6 class="text-sm font-bold mb-6">These are the regions currently in the app. You can add new ones below.</h6>
        </div>
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-12">
            @foreach ($regions as $region)
                <div class="bg-teal-50 border-2 border-teal-400 rounded shadow-md p-4 text-sm font-bold
                           text-center">
                    <h5 class="mb-2 text-xl">{{$region->slug}}</h5>
                    <h5 class="text-sm text-gray-500">{{$region->region_name}}</h5>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $regions->links('vendor.livewire.pagination') }}
        </div>
    </div>

</div>
