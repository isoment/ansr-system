<div class="flex flex-col mt-8">

    <div class="flex items-center">
        {{-- Search --}}
        <div class="max-w-lg w-full lg:max-w-xs mb-0">
            <h5 class="font-bold text-xs mb-2 ml-2 text-gray-600">Search by issue, last name or lease id</h5>
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input wire:model="search"
                    id="search"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out"
                    placeholder="Search" 
                    type="search">
            </div>
        </div>
        {{-- Checkbox --}}
        <div class="relative flex items-start">
            <div class="ml-2 md:ml-12 mr-1 text-sm leading-5">
                <label for="open" class="font-bold text-xs text-gray-700">Open:</label>
            </div>
            <div class="flex items-center h-5">
                <input id="open" type="checkbox"
                        wire:model="open"
                        class="form-checkbox h-3 w-3 text-teal-400 transition duration-150 ease-in-out">
            </div>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs my-4">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase 
                              border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Issue</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($requests as $request)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-2 py-3 text-sm">
                                {{Str::limit($request->issue, 20)}}
                            </td>
                            <td class="px-2 py-3 text-sm">
                                {{$request->tenant->last_name}}, {{$request->tenant->first_name}}
                            </td>
                            <td class="px-2 py-3 text-sm">
                                {{\Carbon\Carbon::parse($request->created_at)->toFormattedDateString()}}
                            </td>
                            <td class="px-2 py-3">
                                @if ($request->completed_date)
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-400">
                                    Complete
                                </span>
                                @else
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 text-teal-400">
                                    Open
                                </span>
                                @endif
                            </td>
                            <td class="px-2 py-3 text-sm">
                                <a href="{{route('employee.manage-request', $request->id)}}"
                                   class="text-teal-400 hover:text-teal-600 cursor-pointer">
                                   Details
                                </a>
                            </td>
                        </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-between items-center">
        <div class="my-4">
            {{ $requests->links('vendor.livewire.pagination') }}
        </div>
    </div>

</div>