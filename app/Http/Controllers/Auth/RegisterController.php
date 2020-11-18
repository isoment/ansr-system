<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Tenant;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Rules\ValidateEmployee;
use App\Rules\ValidateTenant;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     *  Override above to redirect based on role
     */
    protected function redirectTo()
    {
        if (auth()->user()->userRole('App\Models\Employee')) {
            return route('employee.dashboard');
        }

        return route('tenant.dashboard');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $mainValidation = Validator::make($data, [
            'account_type' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Tenant specific validation
        if ($data['account_type'] == 'tenant') {
            return $mainValidation->sometimes('id', ['required', new ValidateTenant], function($input) {
                return $input->account_type == 'tenant';
            })->sometimes('email', ['required','string','email','max:255','unique:users', new ValidateTenant], function($input) {
                return $input->account_type == 'tenant';
            });
        }

        // Employee specific validation
        if ($data['account_type'] == 'employee') {
            return $mainValidation->sometimes('id', ['required', new ValidateEmployee], function($input) {
                return $input->account_type == 'employee';
            })->sometimes('email', ['required','string','email','max:255','unique:users', new ValidateEmployee], function($input) {
                return $input->account_type == 'employee';
            });
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Determine and set morphable type
        if ($data['account_type'] == 'tenant') {
            $userableType = 'App\Models\Tenant';
            $userableID = Tenant::where('lease_id', $data['id'])->first();
        } else {
            $userableType = 'App\Models\Employee';
            $userableID = Employee::where('employee_id_number', $data['id'])->first();
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'userable_type' => $userableType,
            'userable_id' => $userableID->id,
        ]);
    }
}
