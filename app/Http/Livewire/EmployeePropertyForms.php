<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Gate;
use App\Models\Region;
use App\Rules\PhoneNumber;

trait EmployeePropertyForms
{
    /**
     *  Form related properties
     */
    public $name;
    public $region;
    public $street;
    public $city;
    public $state;
    public $zip;
    public $email;
    public $phone;

    /**
     *  Validation rules
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'region' => 'required',
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => ['required', 'digits:5'],
            'email' => ['required', 'email'],
            'phone' => ['required', new PhoneNumber],
        ];
    }

    /**
     *  Method to determine if a user can select from multiple regions (Management)
     *  or only their own (Administrative) based on role
     */
    private function determineRegionByRole()
    {
        if (Gate::allows('isManagement')) {
            return Region::where('region_name', $this->region)->first()->id;
        } else {
            return auth()->user()->userable->region->id;
        }
    }
}