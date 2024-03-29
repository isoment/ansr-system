<ul class="mt-6">
    <li class="relative px-6 py-3">
        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 
                transition-colors duration-150 hover:text-gray-800 
                {{
                    Route::current()->getName() == 'employee.dashboard' ? 'text-orange-400' : ''
                }}
                " 
           href="{{route('employee.dashboard')}}">
        <svg
            class="w-5 h-5"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
            ></path>
        </svg>
        <span class="ml-4">Dashboard</span>
        </a>
    </li>
    @can ('isMaintenance')
        <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors 
                    duration-150 hover:text-gray-800
                    {{
                        Route::current()->getName() == 'employee.my-work-orders' ? 'text-orange-400' : ''
                    }}
                    " 
            href="{{route('employee.my-work-orders')}}">
                <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                    ></path>
                </svg>
                <span class="ml-4">My Work Orders</span>
            </a>
        </li>
    @endcan
    <li class="relative px-6 py-3">
        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors 
                duration-150 hover:text-gray-800
                {{
                    Route::current()->getName() == 'employee.manage-workorder' ||
                    Route::current()->getName() == 'employee.manage-details' ||
                    Route::current()->getName() == 'employee.service-request-index' ||
                    Route::current()->getName() == 'employee.request-category' ||
                    Route::current()->getName() == 'employee.request-history' ||
                    Route::current()->getName() == 'employee.manage-request' ? 'text-orange-400' : ''
                }}
                " 
           href="{{route('employee.service-request-index')}}">
            <svg
                class="w-5 h-5"
                aria-hidden="true"
                fill="none"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                ></path>
            </svg>
            <span class="ml-4">Service Requests</span>
        </a>
    </li>
    @can('isAdministrativeOrManagement')
        <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors 
                    duration-150 hover:text-gray-800
                    {{
                        Route::current()->getName() == 'employee.tenant-edit' ||
                        Route::current()->getName() == 'employee.employee-create' ||
                        Route::current()->getName() == 'employee.employee-index' ||
                        Route::current()->getName() == 'employee.employee-edit' ||
                        Route::current()->getName() == 'employee.tenant-index' ? 'text-orange-400' : ''
                    }}
                    " 
            href="{{route('employee.tenant-index')}}">
                <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                    d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"
                    ></path>
                </svg>
                <span class="ml-4">User Administration</span>
            </a>
        </li>
    @endcan
    @can ('isAdministrativeOrManagement')
        <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors 
                    duration-150 hover:text-gray-800 
                    {{
                        Route::current()->getName() == 'employee.properties-index' || 
                        Route::current()->getName() == 'employee.properties-create' || 
                        Route::current()->getName() == 'employee.properties-edit' || 
                        Route::current()->getName() == 'employee.region' ? 'text-orange-400' : ''
                    }}" 
            href="{{route('employee.properties-index')}}">
                <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                    ></path>
                </svg>
                <span class="ml-4">Properties/Regions</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors 
                    duration-150 hover:text-gray-800
                    {{
                        Route::current()->getName() == 'employee.lease-manage' ||
                        Route::current()->getName() == 'employee.lease-show' ? 'text-orange-400' : ''
                    }}" 
               href="{{route('employee.lease-manage')}}">
                <svg fill="none" 
                     viewBox="0 0 24 24" 
                     stroke="currentColor" 
                     id="paper-clip" 
                     class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                    </path>
                </svg>
                <span class="ml-4">Leases</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors 
                    duration-150 hover:text-gray-800
                    {{
                        Route::current()->getName() == 'employee.lease-application-index' ||
                        Route::current()->getName() == 'employee.lease-application-manage' ? 'text-orange-400' : ''
                    }}" 
               href="{{route('employee.lease-application-index')}}">
                <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
                <span class="ml-4">Lease Applications</span>
            </a>
        </li>
        <li class="relative px-6 py-3">
            <a class="inline-flex items-center w-full text-sm font-semibold transition-colors 
                    duration-150 hover:text-gray-800
                    {{
                        Route::current()->getName() == 'employee.property-listing-index' ||
                        Route::current()->getName() == 'employee.property-listing-manage' ||
                        Route::current()->getName() == 'employee.create-property-listing' ? 'text-orange-400' : ''
                    }}
                    " 
               href="{{route('employee.property-listing-index')}}">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span class="ml-4">Property Listings</span>
            </a>
        </li>
    @endcan
</ul>