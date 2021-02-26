@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-20 xl:px-32 pt-4 md:py-12 mx-auto">

    <div class="break-words bg-white text-gray-700 sm:border-1 sm:rounded-md
                mb-8">
        <div class="w-full px-3 sm:px-6 py-3 mb-8 md:mb-8 shadow-md flex flex-row justify-between items-center">
            <h3 class="font-bold text-lg lg:text-xl text-center">
                Property Listings
            <h3>
            <a href="{{route('employee.create-property-listing')}}" class="bg-teal-300 hover:bg-teal-400 text-white font-bold 
                    text-xs py-1 px-2 rounded transition-all duration-200">
                New Listing
            </a>
        </div>
    </div>

    <livewire:employee-property-listing-index />

</div>

@endsection