@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-20 py-12 mx-auto">

    <div class="break-words bg-white text-gray-700 sm:border-1 sm:rounded-md
                mb-8">
        <div class="w-full p-6 shadow-md">
            <h3 class="font-bold text:lg lg:text-2xl text-center">
                Request A Key Replacement
            <h3>
        </div>
    </div>

    <div class="break-words bg-white text-gray-700 sm:border-1 sm:rounded-md
                mb-8">
        <div class="w-full p-6 shadow-md">
            <div class="my-4 text-center border-2 bg-orange-50 border-orange-400 rounded-lg py-6 font-bold font-prompt">
                <div class="mb-2">{{ $property->street }}, {{$lease->unit}}</div>
                <div>{{$property->city}}, {{$property->state}} {{$property->zipcode}}</div>
            </div>

            <div class="mt-8">
                <h3 class="font-bold leading-relaxed">
                    {{auth()->user()->name}}, you are requesting a new key for the specified unit above.
                    By clicking the submit button below you agree to pay the key replacement fee of
                    <span class="text-2xl text-orange-400">$20</span> 
                    You can also specify any special instructions below.
                </h3>
                

                <form action="" method="POST">
                    <div class="w-full mb-4 mt-4">
                        <textarea name="notes" id="notes" cols="30" rows="10"
                            class=" px-2 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                            @error('notes') border-orange-400 @enderror"></textarea>
                        @error('notes')
                            <p class="text-orange-400 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </form>
            </div>

        </div>
    </div>


</div>

@endsection