<div>

    <div class="flex flex-col mt-8">

        {{-- Search --}}
        <div class="max-w-lg w-full lg:max-w-xs mb-0">
            <h5 class="font-bold text-xs mb-2 ml-2 text-gray-600">Search by last name, email or lease id</h5>
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

        <div class="w-full overflow-hidden rounded-lg shadow-xs my-4">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase 
                                  border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('last_name')" 
                                            class="font-bold uppercase">Name</button>
                                    @if ($sortColumn != 'last_name')
                                        <span></span>
                                    @elseif ($sortAscending)
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
                            <th class="px-4 py-3">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('lease_id')"
                                            class="font-bold uppercase">Lease ID</button>
                                    @if ($sortColumn != 'lease_id')
                                        <span></span>
                                    @elseif ($sortAscending)
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
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($tenants as $tenant)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{$tenant->last_name}}, {{$tenant->first_name}}
                                </td>
                                <td class="px-2 py-3 text-sm">
                                    {{$tenant->lease_id}}
                                </td>
                                <td class="px-2 py-3 text-sm">
                                    {{$tenant->email}}
                                </td>
                                <td class="px-2 py-3">
                                    {{$tenant->phone}}
                                </td>
                                <td class="px-2 py-3 text-sm">
                                    <a href="{{route('employee.tenant-edit', $tenant->id)}}" class="text-teal-400 hover:text-teal-600">Edit</a>
                                </td>
                            </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="my-4">
            {{ $tenants->links('vendor.livewire.pagination') }}
        </div>
        
    </div>

</div>
