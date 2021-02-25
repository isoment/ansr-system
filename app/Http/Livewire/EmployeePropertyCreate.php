<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Models\Region;
use Livewire\Component;

class EmployeePropertyCreate extends Component
{
    use PropertyFormable;

    /**
     *  Need to mount any values going into a select html element and
     *  assign a default or else the default is null.
     */
    public function mount()
    {
        $this->region = users_region();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $this->validate();

        Property::create([
            'name' => $this->name,
            'region_id' => $this->determineRegionByRole(),
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'zipcode' => $this->zip,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->formReset();

        session()->flash('success', 'Property successfully added');
    }

    private function formReset() 
    {
        $this->name = '';
        $this->region = '';
        $this->street = '';
        $this->city = '';
        $this->state = '';
        $this->zip = '';
        $this->email = '';
        $this->phone = '';
    }

    public function render()
    {
        return view('livewire.employee-property-create', [

            'regions' => Region::all()->pluck('region_name'),

            'currentUserRegion' => users_region(),

        ]);
    }
}
