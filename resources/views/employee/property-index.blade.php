@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-20 xl:px-32 pt-4 md:py-12 mx-auto">

    <div class="break-words bg-white text-gray-700 sm:border-1 sm:rounded-md
                mb-8">
        <div class="w-full px-6 py-3 mb-8 md:mb-8 shadow-md flex flex-col sm:flex-row justify-between items-center">
            <h3 class="font-bold text-lg lg:text-xl text-center mb-2 sm:mb-0">
                Property Management
            <h3>
            <div class="flex items-center">
                @can('isManagement')
                    <a href="{{route('employee.region')}}" 
                       class="bg-teal-300 hover:bg-teal-400 text-white font-bold 
                             text-xs p-2 rounded transition-all duration-200">Add Region</a>
                @endcan
                <a href="{{route('employee.properties-create')}}"
                   class="bg-teal-300 hover:bg-teal-400 text-white font-bold 
                         text-xs p-2 rounded transition-all duration-200 ml-2 lg:hidden">Add Property</a>      
            </div>
        </div>
    </div>

    <div class="relative">
        <div class="flex items-center ml-4">
            <a href="{{route('employee.properties-create')}}"
               class="bg-teal-300 hover:bg-teal-400 transition-all duration-200 text-white px-4
                      py-2 text-xs font-bold rounded-t-md absolute right-8 index-data-table-button-position
                      hidden lg:block">
                    Add Property
            </a>
        </div>
    </div>

    <livewire:employee-property-index />

</div>

@endsection