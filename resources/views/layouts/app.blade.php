<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="/alpine.min.js" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

</head>
<body class="bg-gray-50 h-screen antialiased leading-none font-nunito">
<div id="app">
    <div class="flex h-screen bg-gray-50"
        :class="{ 'overflow-hidden': isSideMenuOpen }"
        x-data="mainAppDashboard()">

        {{-- Desktop Side Menu --}}
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0">
            <div class="py-4 text-gray-500">
                <a @can('isEmployee') href="{{route('employee.dashboard')}}" 
                   @elsecan('isTenant') href="{{route('tenant.dashboard')}}" 
                   @endcan 
                   class="flex items-center ml-6">
                    <img src="/img/house.svg" alt="Logo" class="h-8 w-8">
                    <span class="text-xl font-bold ml-2">ANSR</span>
                </a>

                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 
                                transition-colors duration-150 hover:text-gray-800" href="#">
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
                </ul>
                
                {{-- Sidebar Links --}}
                @can('isEmployee')
                    <x-employee-sidebar/>
                @elsecan('isTenant')
                    <x-tenant-sidebar/>
                @endcan

            </div>
        </aside>

        {{-- Darken screen mobile --}}
        <div x-show="isSideMenuOpen"
            x-cloak
            x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        </div>

        {{-- Mobile Sidebar --}}
        <aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white"
            x-show="isSideMenuOpen"
            x-cloak
            x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0 transform -translate-x-20"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 transform -translate-x-20"
            @click.away="closeSideMenu"
            @keydown.escape="closeSideMenu">

            <div class="py-4 text-gray-500">
                <a href='{{ route('tenant.dashboard') }}' class="flex items-center ml-6">
                    <img src="/img/house.svg" alt="Logo" class="h-8 w-8">
                    <span class="text-xl font-bold ml-2">ANSR</span>
                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 
                                transition-colors duration-150 hover:text-gray-800" href="#">
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
                </ul>

                {{-- Sidebar Links --}}
                @can('isEmployee')
                    <x-employee-sidebar/>
                @elsecan('isTenant')
                    <x-tenant-sidebar/>
                @endcan
                
            </div>
        </aside>

        {{-- Top Navigation --}}
        <div class="flex flex-col flex-1 w-full">
            <header class="z-10 py-4 bg-white shadow-md">
                <div class="flex items-center justify-between md:justify-end h-full px-6 mx-auto">

                    {{-- Mobile hamburger --}}
                    <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-orange" 
                            @click="toggleSideMenu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>

                    <div class="flex items-center flex-shrink-0 space-x-6">

                        {{-- Profile menu --}}
                        <div class="relative"
                             @click.away="isProfileMenuOpen = false"
                             @keydown.escape="isProfileMenuOpen = false">
                            <button class="align-middle rounded-full focus:shadow-outline-orange focus:outline-none"
                                    @click="toggleProfileMenu">
                                <img class="object-cover w-8 h-8 rounded-full"
                                src="/img/no-avatar.svg">
                            </button>
                        </div>

                        {{-- Profile Dropdown --}}
                        <div class="bg-gray-50 py-2 flex flex-col absolute top-14 right-9 rounded 
                                    shadow-md font-bold text-sm text-gray-600"
                             x-show="isProfileMenuOpen"
                             x-cloak>
                            <span class="block py-2 px-4 text-teal-500">{{auth()->user()->name}}</span>
                            <a href="#" class="block py-2 px-4 hover:bg-teal-100">Profile</a>
                            <div class="block py-2 px-4 hover:bg-teal-100">
                                <a href="{{ route('logout') }}" class="block"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>  

                    </div>
                </div>
            </header>

            <main class="h-full overflow-y-auto">
                @yield('content')
            </main>

        </div>

    </div>

</div>
<script>
    function mainAppDashboard() {

        return {
            isSideMenuOpen: false,
            isProfileMenuOpen: false,

            toggleSideMenu() {
                this.isSideMenuOpen = ! this.isSideMenuOpen;
            },

            closeSideMenu() {
                this.isSideMenuOpen = false;
            },

            toggleProfileMenu() {
                this.isProfileMenuOpen = ! this.isProfileMenuOpen;
            }
        };
    };
</script>
</body>
</html>
