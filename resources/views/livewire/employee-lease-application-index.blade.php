<div class="flex flex-col mt-12"
     x-data="{ filterOpen: false }">

    <div class="flex items-end justify-between">
        {{-- Search --}}
        <div class="max-w-lg w-full lg:max-w-xs mb-0">
            <h5 class="font-bold text-xs mb-2 ml-2 text-gray-600">Search by last name, region or confirmation #</h5>
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
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 
                          bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 
                           focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out"
                    placeholder="Search" 
                    type="search">
            </div>
        </div>
        {{-- Filter Button --}}
        <div>
            <button
                class="bg-teal-300 hover:bg-teal-400 transition-all duration-200 text-white px-4 
                       py-3 text-xs border border-teal-300 hover:border-teal-400 font-bold rounded ml-2"
                @click="filterOpen = !filterOpen">
                Filter
            </button>

        </div>
    </div>

    {{-- Filter Options --}}
    <div class="bg-white mt-2 rounded-md shadow-sm p-2"
         x-show.transition="filterOpen"
         x-cloak>
        <div class="flex items-center justify-between">
            <div class="px-4">
                <div class="text-xs font-bold flex items-center">
                    <div class="mr-2 whitespace-no-wrap">Filter By:</div>
                    <select class="text-sm w-full border rounded bg-white focus:outline-none"
                            wire:model="status">
                        <option value="open">Open</option>
                        <option value="approved">Approved</option>
                        <option value="denied">Denied</option>
                    </select>
                </div>
            </div>
            <div class="cursor-pointer"
                @click="filterOpen = false">
                <div>
                    <button type="button"
                            class="bg-red-100 text-red-500 hover:text-red-700 rounded overflow-hidden 
                                p-1 lg:p-2 focus:outline-none">
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
            </div>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs my-4">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase 
                              border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">
                            Name
                        </th>
                        <th class="px-4 py-3">
                            Confirmation #
                        </th>
                        <th class="px-4 py-3">
                            Date
                        </th>
                        <th class="px-4 py-3">
                            Status
                        </th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($leases as $lease)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                <div class="flex flex-col">
                                    <div>{{$lease->last_name}}, {{$lease->first_name}}</div>
                                    <div class="text-xxs text-gray-600">{{$lease->propertyListing->property->region->region_name}}</div>
                                </div>
                            </td>
                            <td class="px-2 py-3 text-sm">
                                {{$lease->confirmation_number}}
                            </td>
                            <td class="px-2 py-3">
                                {{\Carbon\Carbon::parse($lease->created_at)->toFormattedDateString()}}
                            </td>
                            <td class="px-2 py-3">
                                @if ($lease->status === 'open')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-teal-100 text-teal-400">
                                        Open
                                    </span>
                                @elseif ($lease->status === 'approved')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-400">
                                        Approved
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-red-100 text-red-400">
                                        Denied
                                    </span>
                                @endif
                            </td>
                            <td class="px-2 py-3 text-sm">
                                <a href="{{route('employee.lease-application-manage', $lease->id)}}"
                                    class="text-teal-400 hover:text-teal-600 cursor-pointer">Manage</a>
                            </td>
                        </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-between items-center">
        <div class="my-4">
            {{ $leases->links('vendor.livewire.pagination') }}
        </div>
    </div>

</div>
