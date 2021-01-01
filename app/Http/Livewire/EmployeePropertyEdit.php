<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Models\Region;
use Livewire\Component;

class EmployeePropertyEdit extends Component
{
    // Passed into livewire component
    public $property;

    // Form properties
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

    public function mount($property)
    {
        $this->name = $property->name;
        $this->region = Region::find($property->region_id)->region_name;
        $this->street = $property->street;
        $this->city = $property->city;
        $this->state = $property->state;
        $this->zip = $property->zipcode;
        $this->email = $property->email;
        $this->phone = $property->phone;
    }

    // Realtime validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm($id)
    {
        $this->validate();

        $property = Property::find($id);
        
        $property->update([
            'name' => $this->name,
            'region_id' => $this->property->region->id,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'zipcode' => $this->zip,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        session()->flash('success', 'Property updated successfully');
    }

    public function render()
    {
        return view('livewire.employee-property-edit', [

            'regions' => Region::all()->pluck('region_name'),

        ]);
    }
}
