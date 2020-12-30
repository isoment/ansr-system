<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Models\Region;
use Livewire\Component;

class EmployeePropertyCreate extends Component
{
    public $name;
    public $region;
    public $street;
    public $city;
    public $state;
    public $zip;
    public $email;
    public $phone;

    protected $rules = [
        'name' => 'required',
        'region' => 'required',
        'street' => 'required',
        'city' => 'required',
        'state' => 'required',
        'zip' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
    ];

    // Realtime validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    // Get region names
    public function getRegions() 
    {
        return Region::all()->pluck('region_name');
    }

    public function submitForm()
    {
        $this->validate();

        Property::create([
            'name' => $this->name,
            'region_id' => Region::where('region_name', $this->region)
                                ->first()->id,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'zipcode' => $this->zip,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
    }

    public function render()
    {
        return view('livewire.employee-property-create', [

            'regions' => $this->getRegions(),

        ]);
    }
}
