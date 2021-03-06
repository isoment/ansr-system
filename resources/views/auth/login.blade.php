@extends('layouts.navless')

@section('content')

<div class="w-full h-screen flex items-center justify-center">
    <form class="w-full md:w-1/2 max-w-xl bg-white lg:border border-cool-gray-300 rounded-lg" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="flex font-bold justify-center mb-3 lg:mb-4 lg:mt-12">
            <a href="{{ route('landing') }}">
                <img src="img/house.svg" alt="Logo" class="h-20 w-20 mb-4">
            </a>
        </div>

        <div class="text-sm border rounded border-gray-200 text-center
                   px-3 py-3 mb-6 mx-12 text-gray-700" role="alert">
            <h2 class="mb-2 text-lg font-bold">Test Accounts...</h2>
            <h6 class="text-xs mb-2">Tenant: <br><span class="font-bold text-orange-400">tenant@test.com</span></h6>
            <h6 class="text-xs mb-2">Manager Employee: <br><span class="font-bold text-orange-400">manager@test.com</span></h6>
            <h6 class="text-xs mb-2">Administrative Employee: <br><span class="font-bold text-orange-400">administrative@test.com</span></h6>
            <h6 class="text-xs mb-2">Maintenance Employee: <br><span class="font-bold text-orange-400">maintenance@test.com</span></h6>
            <h2 class="text-md font-thin">Password for all accounts is <span class="text-orange-500">password</span></h2>
        </div>

        <div class="px-12 pb-10">

            <h2 class="font-bold text-lg mb-5 text-gray-600">Sign In</h2>

            {{-- Email --}}
            <div class="w-full mb-4">
                <div class="flex items-center">
                    <i class='ml-3 fill-current text-teal-400 text-xs z-10 fas fa-user'></i>
                    <input type="email" id="email" name="email" placeholder="Email"
                        class="-mx-6 px-8 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('email') border-orange-400 @enderror" value="{{ old('email') }}" required />
                </div>
                @error('email')
                    <p class="text-orange-400 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="w-full mb-4">
                <div class="flex items-center">
                    <i class='ml-3 fill-current text-teal-400 text-xs z-10 fas fa-lock'></i>
                    <input name="password" type='password' id="password" placeholder="Password"
                        class="-mx-6 px-8 w-full border rounded py-2 text-gray-700 focus:outline-none
                            @error('password') border-orange-400 @enderror"/>
                </div>
                @error('password')
                    <p class="text-orange-400 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Remember and forgot password --}}
            <div class="flex items-center my-4">
                <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                    <input type="checkbox" name="remember" id="remember" class="form-checkbox"
                        {{ old('remember') ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('Remember Me') }}</span>
                </label>

                @if (Route::has('password.request'))
                <a class="text-sm text-teal-300 hover:text-teal-400 whitespace-no-wrap no-underline hover:underline ml-auto"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>

            {{-- Submit and no account --}}
            <div class="flex flex-wrap">
                <button type="submit"
                    class="w-full select-none font-bold whitespace-no-wrap px-3 py-2 rounded-lg text-base 
                        leading-normal no-underline text-gray-100 bg-orange-400 hover:bg-orange-500 focus:outline-none">
                        {{ __('Login') }}
                </button>

                @if (Route::has('register'))
                <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                    {{ __("Don't have an account?") }}
                    <a class="text-teal-300 hover:text-teal-400 no-underline hover:underline" 
                       href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                </p>
                @endif
            </div>

        </div>

    </form>
</div>

@endsection
