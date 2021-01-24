<div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">
            <h5 class="text-xl font-bold text-center">Manage Work Detail</h5>

            <div class="my-2">
                @include('inc.livewire-success')
            </div>

            <form wire:submit.prevent="editWorkDetail">
                <div class="md:px-6">
                    {{-- Details --}}
                    <div class="w-full mt-4">
                        <div class="flex justify-between items-center w-full">
                            <label for="details" class="text-xs text-gray-700 font-bold">Details:</label>
                            @error('details')
                                <div class="text-orange-400 text-xs font-bold italic">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="flex items-center mt-1">
                            <textarea id="details" name="details" rows="7"
                                class="px-4 w-full border bg-white rounded py-2 text-gray-700 focus:outline-none
                                    @error('details') border-orange-400 @enderror" 
                                wire:model.debounce.500ms="details"/>
                            </textarea>
                        </div>
                    </div>
                    {{-- Tenant Notes --}}
                    <div class="w-full mt-4">
                        <div class="flex justify-between items-center w-full">
                            <label for="tenantNotes" class="text-xs text-gray-700 font-bold">Tenant Notes:</label>
                            @error('tenantNotes')
                                <div class="text-orange-400 text-xs font-bold italic">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="flex items-center mt-1">
                            <textarea id="tenantNotes" name="tenantNotes" rows="5"
                                class="px-4 w-full border bg-white rounded py-2 text-gray-700 focus:outline-none
                                    @error('tenantNotes') border-orange-400 @enderror" 
                                wire:model.debounce.500ms="tenantNotes"/>
                            </textarea>
                        </div>
                    </div>
                    {{-- Start Date --}}
                    <div class="w-full mt-4 sm:mt-8">
                        <div class="flex justify-between items-center w-full">
                            <label for="startdate" class="text-xs text-gray-700 font-bold">Start Date:</label>
                            @error('startdate')
                                <div class="text-orange-400 text-xs font-bold italic">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="flex items-center mt-1">
                            <input type="date" id="startdate" name="startdate"
                                class="px-4 w-full border bg-white rounded py-2 text-gray-700 focus:outline-none
                                    @error('startdate') border-orange-400 @enderror"
                                wire:model.debounce.500ms="startdate"/>
                        </div>
                    </div>
                    <div class="mt-6 text-center">
                        <button class="bg-teal-300 py-2 px-4 rounded-md text-white hover:bg-teal-400
                                    transition duration-200"
                                type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </form>

        </div>

        <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-4 
                   shadow-sm flex flex-col justify-between">
            <div>
                <h5 class="font-bold text-center mb-6">Work Detail Information</h5>
                <div class="my-2">
                    <span class="font-bold text-sm">Work Detail ID:</span> 
                    <div class="text-sm font-light mt-1">
                        {{$workDetail->id}}
                    </div>
                </div>
                <div class="my-2">
                    <span class="font-bold text-sm">Belongs to Work Order:</span> 
                    <a href="{{route('employee.manage-workorder', $workDetail->work_order_id)}}">
                        <div class="text-sm font-bold mt-1 text-teal-400">
                            {{$workDetail->work_order_id}}
                        </div>
                    </a>
                </div>
                <div class="my-2">
                    <span class="font-bold text-sm">Start Date:</span> 
                    <div class="text-sm mt-1">
                        @if ($workDetail->start_date)
                            {{\Carbon\Carbon::parse($workDetail->start_date)->toFormattedDateString()}}
                        @else 
                            Not Started
                        @endif
                    </div>
                </div>
                <div class="my-2">
                    <span class="font-bold text-sm">End Date:</span> 
                    <div class="text-sm mt-1">
                        @if ($workDetail->end_date)
                            {{\Carbon\Carbon::parse($workDetail->end_date)->toFormattedDateString()}}
                        @else 
                            Not Completed
                        @endif
                    </div>
                </div>
            </div>
            <div class="my-3 text-center">
                <button class="bg-orange-400 p-2 rounded-md text-white text-sm hover:bg-orange-500
                               transition duration-200"
                        wire:click="toggleEndDate({{$workDetail}})">
                    {{$workDetail->end_date ? 'Reopen Work Detail' : 'Complete Work Detail'}}
                </button>
            </div>
        </div>

    </div>

    <div class="mb-3">
        @include('inc.livewire-error')
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-6 px-4 
                    shadow-sm flex flex-col justify-center">
            <form>
                <div x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <h5 class="font-bold text-center mb-2">Upload</h5>
                    <h6 class="text-xs font-bold mb-4 text-center">Please select the 'Choose Files' to upload files, once completed
                        click 'Save' to attach them to this work detail.
                    </h6>
                    <div x-show="isUploading"
                            x-cloak
                            class="my-3">
                        <progress max="100" x-bind:value="progress" class="w-full"></progress>
                    </div>

                    @error('images.*')
                        <div class="text-orange-400 text-center mb-3">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="flex items-center">
                        <div class="px-4 py-2 border border-teal-300 text-teal-300 rounded-md text-sm font-bold
                                    cursor-pointer text-center w-1/2 mr-2"
                                @click="$refs.fileInput.click()">
                            Choose Files...
                        </div>
                        <div class="text-center w-1/2">
                            <button class="bg-teal-300 py-2 px-4 rounded-md text-white text-sm hover:bg-teal-400 transition duration-200
                                            w-full border border-teal-300 hover:border-teal-400 ml-2" 
                                    wire:click.prevent="storeImage">
                                Save
                            </button>
                        </div>
                    </div>

                    <input type="file" 
                            multiple 
                            class="hidden"
                            wire:model="images"
                            x-ref="fileInput">
                </div>
            </form>
        </div>

        <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 
                    rounded-sm sm:rounded-md mb-4 py-6 px-4 md:px-8 shadow-sm">
            <h5 class="font-bold text-center text-lg mb-6">Saved Images</h5>
            <div class="grid grid-cols-3 lg:grid-cols-6 gap-3 justify-items-center">
                @foreach ($savedFiles as $file)
                    <div x-data="{ showModal: false }">

                        <div class="flex flex-col items-center">
                            <a href="/storage/{{$file->image}}" target="_blank">
                                <div class="rounded-lg shadow-md overflow-hidden work-detail-image-wrapper opacity-75">
                                    <img src="/storage/{{$file->image}}" alt="file" class="image-sizing">
                                </div>
                            </a>
                            <a class="text-xs font-bold mt-1 text-red-400 hover:text-red-600 cursor-pointer"
                               @click="showModal = true"
                               >
                                Delete
                            </a>
                        </div>

                        {{-- Modal --}}
                        <div class="tenant-index-modal-background overflow-auto absolute inset-0 z-30 flex 
                                    items-center justify-center whitespace-normal"
                                x-show="showModal"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform"
                                x-transition:enter-end="opacity-100 transform"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 transform"
                                x-transition:leave-end="opacity-0 transform"
                                x-cloak>
                            <div class="w-3/4 md:max-w-lg mx-auto rounded-md shadow-lg text-gray-700 whitespace-normal"
                                    @click.away="showModal = false">
                                <div class="px-4 py-2 bg-white rounded-md text-center">
                                    <h2 class="text-xl font-bold font-prompt my-4">Delete File?</h2>
                                    <button class="bg-red-400 py-2 px-4 rounded-md text-white text-sm hover:bg-red-500 
                                                    transition duration-200 my-4" 
                                            wire:click="deleteImage({{$file->id}})"
                                            @click="showModal = false"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>

    </div>

</div>
