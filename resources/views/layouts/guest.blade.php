<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    @livewireStyles

    <!-- Apline.js -->
    <script src="/alpine.min.js" defer></script>
</head>

<body class="w-full h-screen antialiased leading-none font-nunito bg-gray-50 text-gray-700">

    {{-- Header --}}
    <header class="w-full text-gray-500 bg-transparent absolute top-0 left-0 z-50 px-4 sm:px-8 lg:px-16 
                xl:px-40 2xl:px-64 py-4 bg-white"
            id="navbar"
            x-data="{ navShow: false }">
        <nav class="flex items-center justify-between">

            {{-- Brand --}}
            <div x-show="! navShow">
                <a href='/' class="flex items-center">
                    <img src="/img/house.svg" alt="Logo" class="h-8 w-8">
                    <span class="text-xl font-bold ml-2">ANSR</span>
                </a>
            </div>

            {{-- Hamburger --}}
            <div class="block md:hidden"
                x-show="! navShow">
                <button type="button" class="focus:outline-none focus:ring-2 focus:ring-inset"
                        @click="navShow = true">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            {{-- Mobile Nav Items --}}
            <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden"
                x-show="navShow"
                x-cloak
                @click.away="navShow = false">
                <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                    <div class="px-5 pt-4 flex items-center justify-between">
                        <div>
                            <a href='/' class="flex items-center">
                                <img src="/img/house.svg" alt="Logo" class="h-6 w-6">
                                <span class="text-xl font-bold ml-2">ANSR</span>
                            </a>
                        </div>
                        <div>
                            <button type="button" class="bg-white rounded-md inline-flex items-center pt-2
                                    justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 
                                    focus:ring-inset"
                                    @click="navShow = false">
                                <!-- X Icon -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div>
                            <ul class="text-center">
                                @if(Route::has('login'))
                                    @auth
                                        @can('isEmployee')
                                            <li>
                                                <a href="{{route('employee.dashboard')}}" 
                                                class="block px-3 py-2 tracking-wide 
                                                        bg-teal-300 rounded-md text-white
                                                mx-8 my-4">Dashboard</a>
                                            </li>
                                        @elsecan('isTenant')
                                            <li>
                                                <a href="{{route('tenant.dashboard')}}" 
                                                class="block px-3 py-2 tracking-wide 
                                                        bg-teal-300 rounded-md text-white
                                                mx-8 my-4">Dashboard</a>
                                            </li>
                                        @endcan
                                    @else
                                        <li>
                                            <a href="{{route('login')}}" 
                                            class="block px-3 py-2 uppercase tracking-wide border border-teal-300 rounded-md text-teal-300
                                                    mx-8 my-4">
                                            Login
                                            </a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li>
                                                <a href="{{route('register')}}" 
                                                class="block px-3 py-2 uppercase tracking-wide bg-teal-300 rounded-md text-white
                                                        mx-8 my-4">
                                                    Register
                                                </a>
                                            </li>
                                        @endif
                                    @endauth
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Desktop Nav Items --}}
            <div class="hidden md:flex">
                <ul class="flex flex-col sm:flex-row">
                    @if(Route::has('login'))
                        @auth
                            @can('isEmployee')
                                <li>
                                    <a href="{{route('employee.dashboard')}}" class="sm:px-4 py-2 block bg-teal-300 hover:bg-teal-400 
                                        text-white rounded-lg ml-4">Dashboard</a>
                                </li>
                            @elsecan('isTenant')
                                <li>
                                    <a href="{{route('tenant.dashboard')}}" class="sm:px-4 py-2 block bg-teal-300 hover:bg-teal-400 
                                        text-white rounded-lg ml-4">Dashboard</a>
                                </li>
                            @endcan
                        @else
                            <li>
                                <a href="{{route('login')}}" class="sm:px-4 py-2 block text-teal-300 border border-teal-300 
                                    hover:bg-teal-300 hover:text-white rounded-lg ml-4 transition-all ease-in-out duration-200">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{route('register')}}" class="sm:px-4 py-2 block bg-teal-300 hover:bg-teal-400 border border-teal-300
                                        text-white rounded-lg ml-4 transition-all ease-in-out duration-200 hover:border-teal-400">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>

        </nav>
    </header>

    @yield('content')
    @livewireScripts
</body>

</html>