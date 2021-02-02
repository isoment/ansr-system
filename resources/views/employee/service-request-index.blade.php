@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-20 xl:px-32 pt-4 md:py-12 mx-auto">

    <div class="break-words bg-white text-gray-700 sm:border-1 sm:rounded-md
                mb-8">
        <div class="w-full px-6 py-3 mb-8 md:mb-8 shadow-md flex flex-col sm:flex-row justify-between items-center">
            <h3 class="font-bold text:lg lg:text-2xl text-center mb-2 sm:mb-0">
                Service Requests
            <h3>
            <div class="flex items-center">
                @can('isManagement')
                <a href="{{route('employee.request-category')}}" 
                   class="bg-teal-300 hover:bg-teal-400 text-white font-bold 
                         text-xs p-2 rounded transition-all duration-200">Add Category</a>
                @endcan
                @can('isAdministrativeOrManagement')
                    <a href="#"
                       class="bg-teal-300 hover:bg-teal-400 text-white font-bold 
                             text-xs p-2 rounded transition-all duration-200 ml-2 lg:hidden">New Request</a>
                @endcan  
            </div>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row justify-around items-center my-4">
        <div class="bg-white rounded shadow-md text-center px-8 py-6 mb-3 sm:mb-0 w-2/3 sm:w-auto">
            <h3 class="text-teal-300 font-prompt font-bold text-3xl mb-4">{{$totalRequests}}</h3>
            <h6 class="text-uppercase font-thin text-sm">Requests this Year</h6>
        </div>
        <div class="bg-white rounded shadow-md text-center px-8 py-6 mb-3 sm:mb-0 w-2/3 sm:w-auto">
            <h3 class="text-orange-300 font-prompt font-bold text-3xl mb-4">{{$openRequests}}</h3>
            <h6 class="text-uppercase font-thin text-sm">Open requests</h6>
        </div>
        <div class="bg-white rounded shadow-md text-center px-8 py-6 mb-3 sm:mb-0 w-2/3 sm:w-auto">
            <h3 class="text-orange-300 font-prompt font-bold text-3xl mb-4">{{$closedRequests}}</h3>
            <h6 class="text-uppercase font-thin text-sm">Completed requests</h6>
        </div>
    </div>

    <div class="relative">
        <div class="flex items-center ml-4">
            @can('isAdministrativeOrManagement')
                <a href="#"
                   class="bg-teal-300 hover:bg-teal-400 transition-all duration-200 text-white px-4 
                         py-2 text-xs font-bold rounded-t-md absolute index-data-table-button-position 
                         right-8 hidden lg:block">
                    New Request
                </a>
            @endcan
        </div>
    </div>

    <livewire:employee-service-request-index />

</div>

@endsection