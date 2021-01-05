<div>

    <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-8 py-6 px-4 md:px-12 shadow-sm">
        <div class="mb-4">
            @include('inc.livewire-success')
        </div>
        <div class="text-left">
            <h2 class="text-2xl font-bold mb-3">New Category</h2>
            <h6 class="text-sm font-bold mb-6">You can add a new category for service requests here. The application, by default comes with a few already.</h6>
        </div>
        <form wire:submit.prevent="submitForm">
            @csrf
            <div class="flex flex-col sm:flex-row items-center">
                <div class="w-full sm:w-1/2">
                    <div class="flex flex-col sm:flex-row justify-start sm:justify-between sm:items-center w-full">
                        <label for="name" class="text-xs text-gray-700 font-bold mb-1">Category Name:</label>
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
            </div>
            <div class="mt-4 text-left">
                <button type="submit" class="w-full block sm:inline-block sm:w-1/4 px-6 py-3 bg-orange-400 
                    hover:bg-orange-500 text-white rounded-lg mt-2 transition-all ease-in-out
                    duration-200">Submit
                </button>
            </div>
        </form>
    </div>

    <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-8 py-6 px-4 md:px-12 shadow-sm">
        <div class="mb-10 text-left">
            <h2 class="text-2xl font-bold mb-3">Categories</h2>
            <h6 class="text-sm font-bold mb-6">These are the categories currently in the app. You can delete
                a category as long as there is no service request associated with it yet.
            </h6>
        </div>
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-12">
            @foreach ($requestCategories as $category)
                <div class="bg-teal-50 border-2 border-teal-400 rounded shadow-md py-4 px-6 text-sm font-bold
                           text-center flex items-center justify-center relative">
                    <h5 class="text-sm text-gray-500">{{$category->name}}</h5>

                    @if (! $category->requestsAssociated())
                        <div>
                            <button type="button"
                                    class="text-red-500 hover:text-red-700 rounded overflow-hidden 
                                            p-1 focus:outline-none absolute top-1 right-1"
                                    wire:click="deleteCategory({{$category->id}})">
                                <svg
                                    class="h-4 w-auto"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                    fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </button>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $requestCategories->links('vendor.livewire.pagination') }}
        </div>
    </div>

</div>