@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-20 py-12 mx-auto">

    @if (session('status'))
        <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 
                    bg-green-100 px-3 py-4 mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{-- Greeting --}}
    <section class="flex flex-col break-words bg-white text-gray-700 sm:border-1 sm:rounded-md
                    mb-8">
        <div class="w-full p-6 shadow-md">
            <h3 class="font-bold text-lg text-center">
                Hello {{auth()->user()->name}}. What do you need help with?
            <h3>
        </div>
    </section>
    
    {{-- Help Cards --}}
    <section class="text-gray-700 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="">
            <a href="{{ route('replace.key') }}">
                <div class="h-full flex flex-col items-center justify-center text-center 
                            shadow-md rounded-lg py-6 px-20 bg-white">
                    <i class="text-orange-400 fas fa-key text-6xl"></i>
                    <h2 class="mt-4 font-bold text-xl font-prompt tracking-wider">I need a key replacement</h2>
                    <p class="mt-4">A lost key is our most common service request. Here you can quickly file a request
                        for a replacement key.
                    </p>
                </div>
            </a>
        </div>
        <div class="">
            <a href="#">
                <div class="h-full flex flex-col items-center justify-center text-center 
                            shadow-md rounded-lg py-6 px-20 bg-white">
                    <i class="text-orange-400 fas fa-toolbox text-6xl"></i>
                    <h2 class="mt-4 font-bold text-xl font-prompt tracking-wider">Service Request</h2>
                    <p class="mt-4">Here you can submit any other type of service request relating to your rental.</p>
                </div>
            </a>    
        </div>
        <div class="">
            <a href="#">
                <div class="h-full flex flex-col items-center justify-center text-center 
                            shadow-md rounded-lg py-6 px-20 bg-white">
                    <i class="text-orange-400 fas fa-copy text-6xl"></i>
                    <h2 class="mt-4 font-bold text-xl font-prompt tracking-wider">Leasing</h2>
                    <p class="mt-4">Any issues related to leasing including renewals.</p>
                </div>
            </a>
        </div>
        <div class="mb-8 lg:mb-0">
            <a href="#">
                <div class="h-full flex flex-col items-center justify-center text-center 
                            shadow-md rounded-lg py-6 px-20 bg-white">
                    <i class="text-orange-400 fas fa-list-alt text-6xl"></i>
                    <h2 class="mt-4 font-bold text-xl font-prompt tracking-wider">All other issues</h2>
                    <p class="mt-4">Anything not covered by the above categories.</p>
                </div>
            </a>
        </div>
    </section>
    
</div>

@endsection
