@extends('layouts.app')

@section('content')

<div class="container px-4 lg:px-24 xl:px-60 pt-4 md:py-12 mx-auto">

    <div class="break-words bg-white text-gray-700 sm:border-1 sm:rounded-md
                mb-8">
        <div class="w-full p-4 shadow-md">
            <h3 class="font-bold text:lg lg:text-2xl text-center">
                Submit a Service Request
            <h3>
        </div>
    </div>

    <div class="break-words bg-white text-gray-700 sm:border-1 sm:rounded-md
                mb-8">
        <div class="w-full p-6 shadow-md">

            <div class="md:mt-4">
                <h3 class="font-bold text-sm md:text-base leading-relaxed mb-4 md:mb-6">
                    {{auth()->user()->name}}, please fill out the form below to submit a service request
                    for the unit on your lease. Provide as many details about the issue and we will get back
                    to you as soon as we review it.
                </h3>
                
                <div class="my-4 text-sm md:text-base text-center text-gray-600 bg-gray-50 shadow-sm rounded-lg py-6 font-bold font-prompt">
                    <div class="mb-2">{{$tenantDetails['street']}}, {{$tenantDetails['unit']}}</div>
                    <div>{{$tenantDetails['city']}}, {{$tenantDetails['state']}} {{$tenantDetails['zipcode']}}</div>
                </div>

                <form action="{{ route('tenant.service-request.store') }}" method="POST">

                    @csrf

                    {{-- Category --}}
                    <label for="category" class="text-sm font-bold">Please select the type of issue:</label>
                    <div class="w-full mb-4 mt-1">
                        <select name="category" id="category" required
                                class="text-sm pl-2 w-full border rounded py-1 bg-white focus:outline-none">
                            @foreach ($requestCategories as $category)
                                <option value="{{$category}}" {{old('category') == $category ? 'selected' : ''}}>{{$category}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Issue --}}
                    <label for="issue" class="text-sm font-bold">Please tell us what the issue is:</label>
                    <div class="w-full mb-4 mt-1">
                        <input type="text" id="issue" name="issue"
                            class="px-2 w-full border rounded py-2 text-gray-700 focus:outline-none
                                @error('issue') border-orange-400 @enderror" value="{{ old('issue') }}" required />
                        @error('issue')
                            <p class="text-orange-400 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <label for="description" class="text-sm font-bold mb-1">Please enter a detailed description of the issue:</label>
                    <div class="w-full mt-1">
                        <textarea name="description" id="description" cols="30" rows="5" required
                            class="px-2 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('description') border-orange-400 @enderror">{{ old('description') }}</textarea>
                        @error('description')
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