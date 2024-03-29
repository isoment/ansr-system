@extends('layouts.navless')

@section('content')

<div class="w-full h-screen flex items-center justify-center">
    <form class="w-full lg:w-1/2 max-w-2xl bg-white lg:border border-cool-gray-300 rounded-lg" 
          method="POST" action="{{ route('register') }}" id="register-form">
        @csrf

        <div class="flex font-bold justify-center mb-3 lg:mb-6 lg:mt-12">
            <a href="{{ route('landing') }}">
                <img src="img/house.svg" alt="Logo" class="h-20 w-20 mb-4">
            </a>
        </div>

        <div class="px-6 md:px-12 pb-10">

            <h2 class="font-bold text-lg mb-5 text-gray-600">Signup</h2>

            <div class="flex flex-col items-start">
                {{-- Account Type and Name --}}
                <div class="w-full mb-4">
                    <div class="flex items-center">
                        <div class="flex items-center w-2/3">
                            <i class='ml-3 fill-current text-teal-400 text-xs z-10 fas fa-user'></i>
                            <input name="name" type='text' id="name" placeholder="Name" 
                                value="{{ old('name') }}" required autocomplete="name" autofocus
                                class="-mx-6 px-8 w-full border rounded py-2 text-gray-700 focus:outline-none
                                    @error('name') border-orange-400 @enderror"/>
                        </div>
                        <div class="w-1/3 ml-4">
                            <select name="account_type" id="account_type" form="register-form" required
                                    class="text-sm pl-2 w-full border rounded py-1 bg-white focus:outline-none">
                                <option value="tenant" {{old('account_type') == 'tenant' ? 'selected' : ''}}>Tenant</option>
                                <option value="employee" {{old('account_type') == 'employee' ? 'selected' : ''}}>Employee</option>
                            </select>
                        </div>
                    </div>
                    @error('name')
                        <p class="text-orange-400 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="w-full mb-4">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-teal-400 text-xs z-10 fas fa-envelope-square'></i>
                        <input name="email" placeholder="Email" autocomplete="email" required value="{{ old('email') }}"
                               class="-mx-6 px-8 w-full border rounded py-2 text-gray-700 focus:outline-none
                                   @error('email') border-orange-400 @enderror"/>
                    </div>
                    @error('email')
                        <p class="text-orange-400 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Lease/Employee ID --}}
                <div class="w-full mb-4">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-teal-400 text-xs z-10 fas fa-passport'></i>
                        <input name="id" placeholder="Lease/Employee ID " autocomplete="id" required value="{{ old('id') }}"
                               class="-mx-6 px-8 w-full border rounded py-2 text-gray-700 focus:outline-none
                                   @error('id') border-orange-400 @enderror"/>
                    </div>
                    @error('id')
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

                {{-- Password Confirmation --}}
                <div class="w-full mb-4">
                    <div class="flex items-center">
                        <i class='ml-3 fill-current text-teal-400 text-xs z-10 fas fa-lock'></i>
                        <input name="password_confirmation" type='password' id="password-confirm" placeholder="Confirm Password"
                            required autocomplete="new-password"
                            class="-mx-6 px-8 w-full border rounded py-2 text-gray-700 focus:outline-none" />
                    </div>
                </div>
            </div>

            {{-- Submit and no account --}}
            <div class="flex flex-wrap">
                <button type="submit"
                    class="w-full select-none font-bold whitespace-no-wrap px-3 py-2 rounded-lg text-base 
                        leading-normal no-underline text-gray-100 bg-orange-400 hover:bg-orange-500 focus:outline-none">
                        Signup
                </button>

                @if (Route::has('register'))
                <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                    Have an account already?
                    <a class="text-teal-300 hover:text-teal-400 no-underline hover:underline" 
                       href="{{ route('login') }}">
                        Login
                    </a>
                </p>
                @endif
            </div>

        </div>

    </form>
</div>

@endsection
