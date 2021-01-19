<div>

    <div class="flex flex-col mt-8">

        {{-- Search --}}
        <div class="max-w-lg w-full lg:max-w-xs mb-0">
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
    
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mt-4">
    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('last_name')"
                                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</button>
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
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('lease_id')"
                                            class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Lease ID</button>
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
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Phone
                                </th>
                                <th class="px-6 py-3 bg-gray-50"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tenants as $tenant)
                            <tr>
                                <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                {{$tenant->last_name}}, {{$tenant->first_name}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">{{$tenant->lease_id}}</div>
                                </td>
                                <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">{{$tenant->email}}</div>
                                </td>
                                <td class="w-4/12 px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">{{$tenant->phone}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <a href="{{route('employee.tenant-edit', $tenant->id)}}" class="text-teal-400 hover:text-teal-600">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
            </div>
        </div>
        <div class="my-4">
            {{ $tenants->links('vendor.livewire.pagination') }}
        </div>
    </div>

</div>
