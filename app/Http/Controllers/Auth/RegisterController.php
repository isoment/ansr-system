<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Tenant;
use App\Providers\RouteServiceProvider;
use App\Models\User;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        // return Validator::make($data, [
        //     'account_type' => 'required',
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     'role_id' => ['required', 'exists:employees,employee_id_number'],
        //     'account_type' => ['required'],
        // ]);

        // Tommorow verify by email too

        $mainValidation = Validator::make($data, [
            'account_type' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($data['account_type'] == 'tenant') {
            return $mainValidation->sometimes('role_id', 'required|exists:tenants,lease_id', function($input) {
                return $input->account_type == 'tenant';
            });
        }

        if ($data['account_type'] == 'employee') {
            return $mainValidation->sometimes('role_id', 'required|exists:employees,employee_id_number', function($input) {
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
        // Get userable_type
        if ($data['account_type'] == 'tenant') {
            $userableType = 'App\Models\Tenant';
            $userableID = Tenant::where('lease_id', $data['role_id'])->first();
        } else {
            $userableType = 'App\Models\Employee';
            $userableID = Employee::where('employee_id_number', $data['role_id'])->first();
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
