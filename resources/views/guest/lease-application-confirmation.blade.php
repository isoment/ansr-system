@extends('layouts.guest')

@section('content')

<div class="relative pt-20 container mx-auto px-4 lg:px-20 xl:px-32 flex justify-center items-center h-screen md:h-3/4">

    <div class="break-words bg-white text-gray-700 sm:border-1 rounded-sm sm:rounded-md mb-8 
            py-6 px-4 md:px-12 shadow-sm">

        <div class="flex flex-col justify-center md:flex-row md:items-center my-8 md:my-20"
             x-data="">
            <div class="md:w-2/3 text-center md:text-left">
                <h3 class="text-4xl font-bold font-prompt mb-2">Thank You!</h3>
                <h5 class="font-prompt font-bold mb-8 text-green-400">Your lease application has been submitted</h5>
                <h6 class="tracking-wide md:leading-relaxed font-thin mb-2">We will make a decision 
                    on your request to lease this property as soon as the background investigation completes.</h6>
                <h6 class="tracking-wide md:leading-relaxed font-thin">If you need to contact us please reference this confirmation number.</h6>
            </div>
            <div class="flex flex-col items-center justify-center md:w-1/3 mt-12 md:mt-0">
                <div class="bg-green-200 p-6 rounded-lg mb-2">
                    <i class="fas fa-clipboard-check text-6xl text-white"></i>
                </div>
                <h5 class="font-prompt font-bold mb-2">Confirmation Number:</h5>
                <div class="font-prompt text-2xl font-bold text-green-400 tracking-wider mb-6">
                    @if (session()->has('confirmation_number'))
                        {{session('confirmation_number')}}
                    @else
                        TEST47928843
                    @endif
                </div>
                <button class="border border-green-400 text-green-400 hover:text-white hover:bg-green-400 
                               px-4 py-2 rounded-lg transition duration-200"
                        @click="window.print()">
                    <i class="fas fa-print text-xs"></i>
                    <span class="font-bold tracking-wide ml-2">Print Page</span>
                </button>
            </div>
        </div>

    </div>

</div>
    
@endsection