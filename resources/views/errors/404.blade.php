@extends('layouts.navless')

@section('content')
    <div class="relative flex items-center justify-center min-h-screen bg-white-100 
                dark:bg-gray-900 sm:items-center sm:pt-0 font-prompt">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col items-center sm:justify-start">
                <div class="flex items-center">
                    <div class="pr-6 text-4xl text-gray-700 border-r-2 border-gray-400 font-bold 
                                tracking-wider lg:text-5xl">
                        404                 
                    </div>
                    <a href="/" class="flex items-center ml-6">
                        <img src="/img/house.svg" alt="Logo" class="h-10 w-10">
                    </a>
                </div>
                <div class="text-lg text-gray-700 uppercase tracking-wider mt-4">
                    Requested page not found.
                </div>
            </div>
        </div>
    </div>
@endsection