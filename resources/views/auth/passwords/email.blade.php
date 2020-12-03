@extends('layouts.navless')

@section('content')
{{-- <main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
    <div class="flex">
        <div class="w-full">

            @if (session('status'))
            <div class="text-sm text-green-700 bg-green-100 px-5 py-6 sm:rounded sm:border sm:border-green-400 sm:mb-6"
                role="alert">
                {{ session('status') }}
            </div>
            @endif

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="flex flex-wrap">

                        <input id="email" type="email"
                            class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap justify-center items-center space-y-6 pb-6 sm:pb-10 sm:space-y-0 sm:justify-between">
                        <button type="submit"
                        class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:w-auto sm:px-4 sm:order-1">
                            {{ __('Send Password Reset Link') }}
                        </button>

                        <p class="mt-4 text-xs text-blue-500 hover:text-blue-700 whitespace-no-wrap no-underline hover:underline sm:text-sm sm:order-0 sm:m-0">
                            <a class="text-blue-500 hover:text-blue-700 no-underline" href="{{ route('login') }}">
                                {{ __('Back to login') }}
                            </a>
                        </p>
                    </div>
                </form>
            </section>
        </div>
    </div>
</main> --}}

<div class="w-full h-screen flex items-center justify-center">
    <form class="w-full md:w-1/2 max-w-xl bg-white lg:border border-cool-gray-300 rounded-lg" 
          method="POST" action="{{ route('password.email') }}">
        @csrf

        @if (session('status'))
            <div class="text-sm text-teal-700 bg-teal-100 px-5 py-3 m-4 sm:rounded sm:border sm:border-teal-400 sm:mb-6"
                role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex font-bold justify-center mb-3 lg:mb-6 lg:mt-12">
            <a href="{{ route('landing') }}">
                <img src="/img/house.svg" alt="Logo" class="h-16 w-16 md:h-20 md:w-20 mb-4">
            </a>
        </div>

        <div class="px-12 pb-10">

            <h2 class="font-bold text-lg mb-5 text-gray-600">Reset Password</h2>

            {{-- Email --}}
            <div class="w-full mb-4">
                <div class="flex items-center">
                    <i class='ml-3 fill-current text-teal-400 text-xs z-10 fas fa-user'></i>
                    <input type="email" id="email" name="email" placeholder="Email"
                        class="-mx-6 px-8 w-full border focus:border-teal-400 rounded py-2 text-gray-700 focus:outline-none
                            @error('email') border-orange-400 @enderror" value="{{ old('email') }}" required />
                </div>
                @error('email')
                    <p class="text-orange-400 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Submit and no account --}}
            <div class="flex flex-wrap">
                <button type="submit"
                        class="w-full select-none font-bold whitespace-no-wrap px-3 py-2 rounded-lg text-base 
                            leading-normal no-underline text-gray-100 bg-orange-400 hover:bg-orange-500 focus:outline-none">
                        Send Password
                </button>

                <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                    <a class="text-teal-300 hover:text-teal-400 no-underline hover:underline" 
                       href="{{ route('login') }}">
                        Back to login
                    </a>
                </p>
            </div>

        </div>

    </form>
</div>
@endsection
