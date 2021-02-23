<?php

namespace App\Http\Livewire;

use App\Models\Property;
use App\Models\PropertyListing;
use App\Models\Region;
use Livewire\Component;

class EmployeePropertyListingCreate extends Component
{
    public $regionList = [];
    public $propertyList = [];
    public $region;
    public $property;
    public $bedrooms;
    public $bathrooms;
    public $sqft;
    public $unit;
    public $type;
    public $available;
    public $rent;
    public $description;

    public function rules()
    {
        return [
            'property' => 'required',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'sqft' => 'required|numeric',
            'type' => 'required',
            'available' => 'required',
            'rent' => 'required|numeric',
            'description' => 'required',
        ];
    }

    public function mount()
    {
        $this->regionList = Region::pluck('region_name');

        // Initialize the region to the same as that of the auth user
        $this->region = $this->regionList->first(function($value, $key) {
            return $value === users_region();
        });

        $this->propertyList = $this->propertyListSet();

        // Initialize the property as the first property in the list
        $this->property = $this->propertyList->first();

        $this->type = 'apartment';

        $this->available = 1;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     *  When a region is seleced filter properties to that region
     */
    public function updatedRegion()
    {
        $this->propertyList = $this->propertyListSet();
    }

    /**
     *  Create listing
     */
    public function createListing()
    {
        $this->validate();

        PropertyListing::create([
            'property_id' => Property::where('name', $this->property)->first()->id,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'unit' => $this->unit,
            'sqft' => $this->sqft,
            'type' => $this->type,
            'available' => $this->available,
            'rent' => $this->rent,
            'description' => $this->description
        ]);

        $this->bedrooms = '';
        $this->bathrooms = '';
        $this->sqft = '';
        $this->type = '';
        $this->available = '';
        $this->rent = '';
        $this->description = '';
    }

    /**
     *  Set the list of properties based on selected region
     */
    private function propertyListSet()
    {
        return Property::whereHas('region', function($query) {
            $query->where('region_name', $this->region);
        })->pluck('name');
    }

    public function render()
    {
        return view('livewire.employee-property-listing-create', [

            'regions' => $this->regionList,

            'properties' => $this->propertyList,

        ]);
    }
}
