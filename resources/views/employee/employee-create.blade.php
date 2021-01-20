@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-20 xl:px-32 pt-4 md:py-12 mx-auto">

    <div class="flex items-center ml-4">
        <a href="{{route('employee.employee-index')}}"
           class="bg-teal-300 hover:bg-teal-400 transition-all duration-200 text-white px-4 
                  py-2 text-xs font-bold rounded-t-md">Employee Index</a>
    </div>

    <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-8 py-6 px-4 md:px-12 shadow-sm">
        <livewire:admin-employee-create />
    </div>

</div>

@endsection