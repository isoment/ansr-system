@extends('layouts.navless')

@section('content')
    <div class="relative flex items-center justify-center min-h-screen bg-white-100 
                dark:bg-gray-900 sm:items-center sm:pt-0 font-prompt">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col items-center sm:justify-start">
                <div class="flex items-center">
                    <div class="pr-6 text-4xl text-gray-700 border-r-2 border-gray-400 font-bold 
                                tracking-wider lg:text-5xl">
                        403                 
                    </div>
                    @guest
                            <a href="/" class="flex items-center ml-6">
                                <img src="/img/house.svg" alt="Logo" class="h-10 w-10">
                            </a>
                    @endguest
                    @auth
                        @can('isEmployee')
                            <a href="{{route('employee.dashboard')}}" class="flex items-center ml-6">
                                <img src="/img/house.svg" alt="Logo" class="h-10 w-10">
                            </a>
                        @elsecan('isTenant')
                            <a href="{{route('tenant.dashboard')}}" class="flex items-center ml-6">
                                <img src="/img/house.svg" alt="Logo" class="h-10 w-10">
                            </a>
                        @endcan
                    @endauth
                </div>
                <div class="text-lg text-gray-700 uppercase tracking-wider mt-4">
                    This action is unauthorized.
                </div>
                <div class="text-orange-300 uppercase tracking-wider mt-2 font-bold">
                    <a href="{{ url()->previous() }}">Go Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection