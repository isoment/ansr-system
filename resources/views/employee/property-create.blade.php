@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-20 xl:px-32 pt-4 md:py-12 mx-auto">

    <div class="break-words bg-white text-gray-700 sm:border-1 sm:rounded-md
                mb-8">
        <div class="w-full px-6 py-3 mb-10 shadow-md">
            <h3 class="font-bold text:lg lg:text-2xl text-center">
                Add New Property
            <h3>
        </div>
    </div>

    <div class="break-words bg-white text-gray-700 sm:border-1 sm:rounded-md mb-8 py-6 px-12">

        <livewire:employee-property-create />
        
    </div>

</div>

@endsection