<div class="flex flex-col mt-8">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="flex justify-start">
                <div class="relative flex items-start">
                    <div class="mx-2 text-sm leading-5">
                        <label for="open" class="font-medium text-gray-700">Open Requests:</label>
                    </div>
                    <div class="flex items-center h-5">
                        <input id="open" type="checkbox"
                            wire:model="open"
                            class="form-checkbox h-4 w-4 text-teal-400 transition duration-150 ease-in-out">
                    </div>
                </div>
            </div>

            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mt-4">

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left">
                                <div class="flex items-center">
                                    <div class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Issue</div>
                                </div>
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left">
                                <div class="flex items-center">
                                    <button class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                            wire:click="sortDirection()">Date</button>
                                    @if ($sortAsc)
                                        <span>
                                            <svg class="w-4 text-gray-500 ml-2" 
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24" 
                                                xmlns="http://www.w3.org/2000/svg"><path 
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                            </svg>
                                        </span>
                                    @else 
                                        <span>
                                            <svg class="w-4 text-gray-500 ml-2" 
                                                fill="none" stroke="currentColor" 
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path 
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </span>
                                    @endif

                                </div>
                            </th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 bg-gray-50"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($requests as $request)
                        <tr>
                            <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                <div class="flex items-center">
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{Str::limit($request->issue, 20)}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                <div class="text-sm leading-5 text-gray-900">
                                        {{ \Carbon\Carbon::parse($request->created_at)->toFormattedDateString() }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap">
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
                            <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                <a href="#" class="text-teal-400 hover:text-teal-600">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- <div class="mt-8">
                {{ $users->links() }}
            </div> --}}
        </div>
    </div>
</div>