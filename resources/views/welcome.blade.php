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
                     x-show="navShow"
                     x-cloak
                     @click.away="navShow = false">
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
                        <div class="flex flex-col">
                            <div class="text-center">
                                <a href="{{route('property-listings')}}"
                                   class="block px-3 py-2 uppercase tracking-wide border border-teal-300 
                                          rounded-md text-teal-300 mx-8 my-4">
                                    Available Properties
                                </a>
                            </div>
                            <div>
                                <ul class="text-center">
                                    @if(Route::has('login'))
                                        @auth
                                            @can('isEmployee')
                                                <li>
                                                    <a href="{{route('employee.dashboard')}}" 
                                                    class="block px-3 py-2 tracking-wide 
                                                            bg-teal-300 rounded-md text-white
                                                    mx-8 mb-4">Dashboard</a>
                                                </li>
                                            @elsecan('isTenant')
                                                <li>
                                                    <a href="{{route('tenant.dashboard')}}" 
                                                    class="block px-3 py-2 tracking-wide 
                                                            bg-teal-300 rounded-md text-white
                                                    mx-8 mb-4">Dashboard</a>
                                                </li>
                                            @endcan
                                        @else
                                            <li>
                                                <a href="{{route('login')}}" 
                                                class="block px-3 py-2 uppercase tracking-wide border border-teal-300 rounded-md text-teal-300
                                                        mx-8 mb-4">
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
                        <a href="{{route('property-listings')}}"
                           class="sm:px-4 py-2 sm:hidden lg:block">
                            Available Properties
                        </a>
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
                                        <a href="{{route('register')}}" class="sm:px-4 py-2 block bg-teal-300 hover:bg-teal-400 
                                            text-white rounded-lg ml-4 transition-all ease-in-out duration-200">Register</a>
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
                    <h1 class="text-3xl lg:text-4xl xl:text-5xl leading-tight font-bold font-prompt">ANSR, the premier upkeep solution for property managers</h1>
                    <p class="text-base leading-snug text-gray-700 mt-4">Fusce dapibus, tellus ac cursus commodo, tortor mauris
                        condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                    <a href="#" class="w-full block sm:inline-block sm:w-auto px-6 py-3 bg-orange-400 
                                    hover:bg-orange-500 text-white rounded-lg mt-8 transition-all ease-in-out
                                    duration-200">Get Started</a>
                </div>

                <div class="w-full absolute bottom-0 right-0">
                    <img src="img/hero.svg" alt="hero">
                </div>
            </div>
        </section>

        {{-- Cards --}}
        <section class="bg-gray-50 text-center pt-20 pb-8 px-6 sm:px-8 lg:px-16 xl:px-40 2xl:px-96">
            <h1 class="text-3xl lg:text-3xl xl:text-4xl leading-tight font-bold lg:mb-4 font-prompt">By choosing ANSR you...</h1>
            <div class="flex flex-col md:flex-row justify-center py-8 max-width-1375 mx-auto">
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

        {{-- About --}}
        <section class="bg-gray-50 px-6 lg:pt-4 pb-20 sm:px-8 lg:px-16 xl:px-32 2xl:px-92">
            <h1 class="text-3xl lg:text-3xl xl:text-4xl leading-tight font-bold mb-16 lg:mb-16 font-prompt text-center">About our product...</h1>
            <div class="lg:mx-auto grid grid-cols-1 lg:grid-cols-2 gap-0 max-width-1375">
                <div class="bg-white rounded-t-lg lg:rounded-tr-none lg:rounded-tl-lg lg:rounded-bl-lg border border-teal-400">
                    <div class="mx-4 lg:ml-8 lg:mr-20 my-8 lg:my-20">
                        <h6 class="text-orange-500 uppercase font-bold text-lg">Full Featured</h6>
                        <h2 class="text-3xl leading-tight font-bold mb-16">Lorem ipsum dolor sit amet cotetur adipisicing.</h2>
                        <div class="flex flex-row items-start mb-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-20 rounded-lg bg-teal-400 text-white p-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            <div class="ml-4">
                                <h5 class="text-lg font-bold mb-2">List View</h5>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, perferendis inventore. Expedita treu corporis adipisci?</p>
                            </div>
                        </div>
                        <div class="flex flex-row items-start mb-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-20 rounded-lg bg-teal-400 text-white p-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            <div class="ml-4">
                                <h5 class="text-lg font-bold mb-2">List View</h5>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, perferendis inventore. Expedita treu corporis adipisci?</p>
                            </div>
                        </div>
                        <div class="flex flex-row items-start mb-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-20 rounded-lg bg-teal-400 text-white p-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            <div class="ml-4">
                                <h5 class="text-lg font-bold mb-2">List View</h5>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, perferendis inventore. Expedita treu corporis adipisci?</p>
                            </div>
                        </div>
                        <div class="flex flex-row items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-20 rounded-lg bg-teal-400 text-white p-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            <div class="ml-4">
                                <h5 class="text-lg font-bold mb-2">List View</h5>
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, perferendis inventore. Expedita treu corporis adipisci?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-white bg-teal-400 rounded-b-lg lg:rounded-tr-lg lg:rounded-bl-none lg:rounded-br-lg flex flex-col justify-center items-center">
                    <div class="flex flex-col items-center p-8 lg:p-0">
                        <div class="flex items-center mb-8 mr-3">
                            <div class="flex flex-col items-center">
                                <h2 class="font-extrabold text-4xl sm:text-6xl font-prompt">$99</h2>
                                <span class="-mt-4 text-teal-100">Setup Fee</span>
                            </div>
                            <div><span class="mx-8 sm:mx-16 text-3xl text-teal-100">+</span></div>
                            <div class="flex flex-col items-center">
                                <h2 class="font-extrabold text-4xl sm:text-6xl font-prompt">$15</h2>
                                <span class="-mt-4 text-teal-100">Per Month</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-px text-lg text-white">
                            <div class="bg-teal-500 px-4 py-4 rounded-tl-lg flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-2">Unlimited regions</span>
                            </div>
                            <div class="bg-teal-500 px-4 py-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-2">Unlimited employees</span>
                            </div>
                            <div class="bg-teal-500 px-4 py-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-2">No hidden fees</span>
                            </div>
                            <div class="bg-teal-500 px-4 py-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-2">Free support</span>
                            </div>
                            <div class="bg-teal-500 px-4 py-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-2">New features</span>
                            </div>
                            <div class="bg-teal-500 px-4 py-4 flex items-center rounded-br-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-2">Cancel anytime</span>
                            </div>
                        </div>
                            <a href="#" class="w-auto sm:w-full block text-center font-semibold text-lg px-6 py-3 bg-orange-400 
                                    hover:bg-orange-500 text-white rounded-lg mt-8 transition-all ease-in-out
                                    duration-200">Get Started</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Testimony --}}
        <section class="bg-gray-50 px-6 pb-20 sm:px-8 lg:px-16 xl:px-32 2xl:px-92">
            <h1 class="text-3xl lg:text-3xl xl:text-4xl leading-tight font-bold mb-12 lg:mb-12 text-center font-prompt">What customers are saying...</h1>
            <div class="flex flex-col md:flex-row md:justify-between md:items-center max-width-1375 mx-auto">
                <div class="lg:mx-12 mb-20 md:mb-0">
                    <h6 class="text-orange-500 uppercase font-bold text-sm">Lorem</h6>
                    <h2 class="text-2xl lg:text-2xl xl:text-3xl leading-tight font-bold">Lorem ipsum dolor sit amet consectetur adipisicing.</h2>
                    <p class="text-lg mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut eius ipsum nostrum laborum facilis nam rerum assumenda nobis?</p>
                    <a href="#" class="px-4 py-1 bg-orange-400 hover:bg-orange-500 text-white rounded-lg
                                transition-all ease-in-out duration-200">Learn More</a>
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

        {{-- Footer --}}
        <footer class="bg-white text-center lg:text-left">
            <div class="flex flex-col items-center lg:justify-around lg:items-start lg:flex-row max-width-1375 mx-auto py-12 lg:py-36">
                <div class="flex flex-col mb-6 lg:mb-0">
                    <h4 class="font-prompt text-lg font-bold mb-1 lg:mb-4 text-orange-500">Company</h4>
                    <a href="#">Resources</a>
                    <a href="#">About</a>
                </div>
                <div class="flex flex-col mb-6 lg:mb-0">
                    <h4 class="font-prompt text-lg font-bold mb-1 lg:mb-4 text-orange-500">Legal</h4>
                    <a href="#">Terms Of Service</a>
                    <a href="#">Information</a>
                    <a href="#">Privacy Policy</a>
                </div>
                <div class="flex flex-col mb-6 lg:mb-0">
                    <h4 class="font-prompt text-lg font-bold mb-1 lg:mb-4 text-orange-500">Contact</h4>
                    <a href="#">contact@ansr.test</a>
                    <p>4800 Commerce Pkwy</p>
                    <p>Summerdale, TN 89221</p>
                    <p>555-555-5555</p>
                </div>
                <div class="flex flex-col items-center lg:items-start mt-6 lg:mt-0">
                    <div>
                        <a href='#' class="flex items-center">
                            <img src="img/house.svg" alt="Logo" class="h-8 w-8">
                            <span class="text-xl font-bold ml-2 text-gray-500">ANSR</span>
                        </a>
                    </div>
                    <div class="mt-2">
                        Lorem, ipsum dolor sit amet consectetur<br> adipisicing elit. Soluta culpa at numquam!
                    </div>
                </div>
            </div>
            <div class="max-width-1375 mx-auto text-gray-700">
                <hr class="mb-4">
                <div class="mb-4 font-bold text-center">&#169; <span class="font-bold font-prompt">{{date("Y")}}</span></div>
            </div>
        </footer>


    </main>


</body>

</html>
