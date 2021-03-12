<ul class="mt-6">
    <li class="relative px-6 py-3">
        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 
                transition-colors duration-150 hover:text-gray-800 {{Route::current()->getName() == 'tenant.dashboard' ? 'text-orange-400' : ''}}" 
           href="{{route('tenant.dashboard')}}">
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
    <li class="relative px-6 py-3">
        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors 
                duration-150 hover:text-gray-800 {{Route::current()->getName() == 'replace.key' ? 'text-orange-400' : ''}}" 
           href="{{route('replace.key')}}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" 
                     xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" 
                     stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                    </path>
                </svg>
            <span class="ml-4">New Key Request</span>
        </a>
    </li>
    <li class="relative px-6 py-3">
        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors 
                duration-150 hover:text-gray-800 {{Route::current()->getName() == 'tenant.service-request' ? 'text-orange-400' : ''}}" 
           href="{{route('tenant.service-request')}}">
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
            <span class="ml-4">New Service Request</span>
        </a>
    </li>
    <li class="relative px-6 py-3">
        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors 
                duration-150 hover:text-gray-800 {{Route::current()->getName() == 'tenant.request-index' ? 'text-orange-400' : ''}}" 
           href="{{route('tenant.request-index')}}">
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
            <span class="ml-4">My Service Requests</span>
        </a>
    </li>
    <li class="relative px-6 py-3">
        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors 
                duration-150 hover:text-gray-800" href="#">
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
            <span class="ml-4">Other</span>
        </a>
    </li>
</ul>