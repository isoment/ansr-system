<?php

namespace App\Http\Livewire;

use App\Models\Region;
use Livewire\Component;

class EmployeePropertyEdit extends Component
{
    use EmployeePropertyForms;

    public $property;

    public function mount($property)
    {
        $this->name = $property->name;
        $this->region = $property->region->region_name;
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

    public function submitForm()
    {
        $this->validate();
        
        $this->property->update([
            'name' => $this->name,
            'region_id' => $this->determineRegionByRole(),
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

            'currentUserRegion' => users_region(),

        ]);
    }
}
