@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-20 py-12 mx-auto">

    {{-- Greeting --}}
    <section class="flex flex-col break-words bg-white text-gray-700 sm:border-1 sm:rounded-md
                    mb-8">
        <div class="w-full p-6 shadow-md">
            <h3 class="font-bold text-lg text-center">
                Hello {{auth()->user()->name}}.
            <h3>
        </div>
    </section>

    <div class="mb-8 shadow-md rounded-md"
         x-show="alertOpen"
         x-transition:leave="transition duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        @include('inc.messages')
    </div>
    
    
    {{-- Help Cards --}}
    <section class="text-gray-700 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
            <a href="{{route('employee.service-request-index')}}">
                <div class="h-full flex flex-col items-center justify-center text-center 
                            shadow-md rounded-lg py-6 px-20 bg-white">
                    <i class="text-orange-400 fas fa-toolbox text-6xl"></i>
                    <h2 class="mt-4 font-bold text-xl font-prompt tracking-wider">Service Requests</h2>
                    <p class="mt-4">
                        View and work with service requests here. You can also manage categories for service requests.
                    </p>
                </div>
            </a>    
        </div>
        @can('isAdministrative')
            <div>
                <a href="{{route('employee.properties-index')}}">
                    <div class="h-full flex flex-col items-center justify-center text-center 
                                shadow-md rounded-lg py-6 px-20 bg-white">
                        <i class="text-orange-400 fas fa-key text-6xl"></i>
                        <h2 class="mt-4 font-bold text-xl font-prompt tracking-wider">Properties and Regions</h2>
                        <p class="mt-4">
                            Here you can manage the properties of your organization and add new regions.
                        </p>
                    </div>
                </a>
            </div>
        @endcan
        @can('isMaintenance')
            <div class="mb-8 lg:mb-0">
                <a href="#">
                    <div class="h-full flex flex-col items-center justify-center text-center 
                                shadow-md rounded-lg py-6 px-20 bg-white">
                        <i class="text-orange-400 fas fa-list-alt text-6xl"></i>
                        <h2 class="mt-4 font-bold text-xl font-prompt tracking-wider">My Work Orders</h2>
                        <p class="mt-4">Keep track of and manage your work orders and details.</p>
                    </div>
                </a>
            </div>
        @endcan
        <div>
            <a href="#">
                <div class="h-full flex flex-col items-center justify-center text-center 
                            shadow-md rounded-lg py-6 px-20 bg-white">
                    <i class="text-orange-400 fas fa-copy text-6xl"></i>
                    <h2 class="mt-4 font-bold text-xl font-prompt tracking-wider">Leasing</h2>
                    <p class="mt-4">Any issues related to leasing including renewals.</p>
                </div>
            </a>
        </div>
        <div>
            <a href="{{route('employee.service-request-index')}}">
                <div class="h-full flex flex-col items-center justify-center text-center 
                            shadow-md rounded-lg py-6 px-20 bg-white">
                    <i class="text-orange-400 fas fa-chart-pie text-6xl"></i>
                    <h2 class="mt-4 font-bold text-xl font-prompt tracking-wider">Statistics</h2>
                    <p class="mt-4">
                        View data related to app usage.
                    </p>
                </div>
            </a>    
        </div>
    </section>
    
</div>

@endsection
