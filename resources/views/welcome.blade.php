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

    <!-- Apline.js -->
    <script src="alpine.min.js" defer></script>
</head>

<body class="font-nunito">

    <main class="w-full">

        {{-- Header --}}
        <header class="w-full text-gray-500 bg-transparent absolute top-0 left-0 z-50 px-4 sm:px-8 lg:px-16 
                       xl:px-40 2xl:px-64 py-4"
                id="navbar"
                x-data="{ navShow: false }">
            <nav class="flex items-center justify-between">

                {{-- Brand --}}
                <div x-show="! navShow">
                    <a href='#' class="flex items-center">
                        <img src="img/house.svg" alt="Logo" class="h-8 w-8">
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
                     x-show="navShow">
                    <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                        <div class="px-5 pt-4 flex items-center justify-between">
                            <div>
                                <a href='#' class="flex items-center">
                                    <img src="img/house.svg" alt="Logo" class="h-6 w-6">
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
                        <div>
                            <div class="px-2 pt-2 pb-3 space-y-1">
                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-orange-50">Demo</a>
                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-orange-50">About Us</a>
                                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-orange-50">Pricing</a>
                            </div>
                            <div>
                                <a href="#" class="block w-full px-5 py-3 text-center font-medium text-orange-600 bg-gray-50 hover:bg-gray-100">
                                    Get Started
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Desktop Nav Items --}}
                <div class="hidden md:flex">
                    <ul class="flex flex-col sm:flex-row">
                        <li><a href="#" class="sm:px-4 py-2 block">Demo</a></li>
                        <li><a href="#" class="sm:px-4 py-2 sm:hidden lg:block">About Us</a></li>
                        <li><a href="#" class="sm:px-4 py-2 sm:hidden md:block">Pricing</a></li>
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
                                        hover:bg-teal-300 hover:text-white rounded-lg ml-4">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li>
                                        <a href="{{route('register')}}" class="sm:px-4 py-2 block bg-teal-300 hover:bg-teal-400 
                                            text-white rounded-lg ml-4">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>

            </nav>
        </header>

        {{-- Hero --}}
        <section class="relative bg-blue-100 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 pt-32 
                        pb-48 sm:pb-64 md:pt-40 md:pb-48 lg:pt-40 xl:pb-64 2xl:pt-56 2xl:pb-96 text-center 
                        sm:text-left">
            <div>
                <div class="relative w-full sm:w-2/3 lg:w-1/2 z-10">
                    <h1 class="text-3xl lg:text-4xl xl:text-5xl leading-tight font-bold">ANSR, the premier upkeep solution for property managers</h1>
                    <p class="text-base leading-snug text-gray-700 mt-4">Fusce dapibus, tellus ac cursus commodo, tortor mauris
                        condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                    <a href="#" class="w-full block sm:inline-block sm:w-auto px-6 py-4 bg-orange-400 hover:bg-orange-500 text-white rounded-lg mt-8">Get Started</a>
                </div>

                <div class="w-full absolute bottom-0 right-0">
                    <img src="img/hero.svg" alt="hero">
                </div>
            </div>
        </section>

        {{-- Cards --}}
        <section class="bg-gray-50 text-center py-20 px-6 sm:px-8 lg:px-16 xl:px-40 2xl:px-64">
            <h1 class="text-3xl lg:text-3xl xl:text-4xl leading-tight font-bold lg:mb-4">By choosing ANSR you are able to...</h1>
            <div class="flex flex-col md:flex-row justify-center py-8">
                <div class="my-8 mx-4 py-6 px-4 bg-white shadow-md rounded-lg">
                    <img class="mx-auto h-24 lg:h-32" src="img/buildings.svg" alt="buildings">
                    <h2 class="my-3 font-bold text-xl">Simplify Maintenance</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod, expedita!</p>
                </div>
                <div class="my-8 mx-4 py-6 px-4 bg-white shadow-md rounded-lg">
                    <img class="mx-auto h-24 lg:h-32" src="img/tenants.svg" alt="tenants">
                    <h2 class="my-3 font-bold text-xl">Increase tenant satisfaction</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, ullam.</p>
                </div>
                <div class="my-8 mx-4 py-6 px-4 bg-white shadow-md rounded-lg">
                    <img class="mx-auto h-24 lg:h-32" src="img/value.svg" alt="value">
                    <h2 class="my-3 font-bold text-xl">Up productivity, cut costs</h2>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Est, ipsam!</p>
                </div>
            </div>
        </section>

        {{-- Info --}}
        <section class="bg-gray-50 px-6 pb-20 lg:py-20 sm:px-8 lg:px-16 xl:px-32 2xl:px-64">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                <div class="lg:mx-12 mb-20 md:mb-0">
                    <h6 class="text-orange-500 uppercase font-bold text-sm">Lorem</h6>
                    <h2 class="text-2xl lg:text-2xl xl:text-3xl leading-tight font-bold">Lorem ipsum dolor sit amet consectetur adipisicing.</h2>
                    <p class="text-lg">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut eius ipsum nostrum laborum facilis nam rerum assumenda nobis?</p>
                </div>
                <div class="bg-white shadow-xl rounded-lg lg:mx-12 p-8">
                    <div class="flex items-center mb-3">
                        <img src="img/user-1.jpg" alt="user" class="rounded-full w-20 h-20">
                        <div class="ml-3">
                            <h3 class="font-bold text-lg">John Doe</h3>
                            <h6 class="text-sm text-gray-400 mb-3">Operations Manager</h6>
                        </div>
                    </div>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Provident at dignissimos illum sed, inventore ipsum?</p>
                </div>
            </div>
        </section>


    </main>


</body>

</html>
