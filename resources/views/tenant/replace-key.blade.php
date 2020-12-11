@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-24 xl:px-60 pt-4 md:py-12 mx-auto">

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

            <div class="md:mt-4">
                <h3 class="font-bold text-sm md:text-base leading-relaxed mb-4 md:mb-12">
                    {{auth()->user()->name}}, you are requesting a new key for the specified unit.
                    By clicking the submit button below you agree to pay the fee of
                    <span class="text-orange-400">$20</span> per key as stipulated in your lease.
                    You can also specify a how many keys and any special instructions below.
                </h3>
                
                <div class="my-4 text-sm md:text-base text-center text-gray-500 border-2 bg-teal-50 border-teal-400 rounded-lg py-6 font-bold font-prompt">
                    <div class="mb-2">{{ $property->street }}, {{$lease->unit}}</div>
                    <div>{{$property->city}}, {{$property->state}} {{$property->zipcode}}</div>
                </div>

                <form action="{{ route('replace.key.store') }}" method="POST">

                    @csrf

                    {{-- Key Quantity --}}
                    <label for="quantity" class="text-sm font-bold">Key Quantity:</label>
                    <div class="w-full mb-4 mt-1">
                        <div class="flex items-center">
                            <i class='ml-3 fill-current text-teal-400 text-xs z-10 fas fa-key'></i>
                            <input type="number" min="1" max="5" id="quantity" value="1" name="quantity" placeholder="Key Quantity"
                                class="-mx-6 px-8 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                                    @error('quantity') border-orange-400 @enderror" value="{{ old('quantity') ? old('quantity') : 1 }}" required />
                        </div>
                        @error('quantity')
                            <p class="text-orange-400 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Notes --}}
                    <label for="notes" class="text-sm font-bold mb-1">Notes:</label>
                    <div class="w-full mt-1">
                        <textarea name="notes" id="notes" cols="30" rows="5"
                            class=" px-2 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                            @error('notes') border-orange-400 @enderror">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-orange-400 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="w-full block sm:inline-block sm:w-1/4 px-6 py-3 bg-orange-400 
                            hover:bg-orange-500 text-white rounded-lg mt-4 transition-all ease-in-out
                            duration-200">Submit
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>


</div>

@endsection