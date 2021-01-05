<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    {{-- Col 1 --}}
    <div class="break-words lg:col-span-2 bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-6 px-4 md:px-12 shadow-sm">
        <div class="text-xl font-bold flex items-center justify-between">
            <h5>Request ID: {{$request->id}}</h5>
            @if ($request->completed_date)
                <div
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-400">
                    Complete
                </div>
            @else
                <div
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 text-teal-400">
                    Open
                </div>
            @endif
        </div>
        
        <div class="mt-4">
            <div class="my-3">
                <span class="font-bold">Request Created:</span> 
                <div class="text-sm font-light mt-1">
                    {{\Carbon\Carbon::parse($request->created_at)->toFormattedDateString()}}
                </div>
            </div>
            <div class="my-3">
                <span class="font-bold">Tenant Name:</span> 
                <div class="text-sm font-light mt-1">
                    {{$request->tenant->first_name}} {{$request->tenant->last_name}}
                </div>
            </div>
            <div>
                <span class="font-bold">Lease ID:</span> 
                <div class="text-sm font-light mt-1">
                    {{$request->tenant->lease->id}}
                </div>
            </div>
            <div class="my-3">
                <span class="font-bold">Category:</span> 
                <div class="text-sm font-light mt-1">
                    {{$request->requestCategory->name}}
                </div>
            </div>
            <div class="my-3">
                <span class="font-bold">Issue:</span> 
                <div class="text-sm font-light mt-1">
                    {{$request->issue}}
                </div>
            </div>
            <div class="my-3">
                <span class="font-bold">Description:</span> 
                <div class="text-sm font-light mt-1">
                    {{$request->description}}
                </div>
            </div>
            <div class="my-3">
                <span class="font-bold">Tenant Charges:</span> 
                <div class="text-sm font-light mt-1">
                    ${{$request->tenant_charges}}
                </div>
            </div>
        </div>
    </div>

    {{-- Col 2 --}}
    <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-4 py-3 px-2 shadow-sm">
        <button class="bg-orange-400 p-2 rounded-md text-white text-sm hover:bg-orange-500"
                wire:click="toggleComplete">
            Toggle Completed
        </button>
    </div>

</div>
