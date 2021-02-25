@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-20 xl:px-32 pt-4 md:py-12 mx-auto">

    <div class="break-words bg-white text-gray-700 sm:border-1 sm:rounded-md
                mb-8">
        <div class="w-full px-6 py-3 mb-8 md:mb-8 shadow-md flex flex-col sm:flex-row justify-between items-center">
            <h3 class="font-bold text-lg lg:text-xl text-center">
                Lease Applications
            <h3>
        </div>
    </div>

    <livewire:employee-lease-application-index />

</div>

@endsection