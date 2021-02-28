<?php

namespace App\Http\Livewire;

use App\Models\ListingImage;
use App\Models\Property;
use App\Models\PropertyListing;
use App\Models\Region;
use App\Rules\PropertyInUsersRegion;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmployeePropertyListingCreate extends Component
{
    use WithFileUploads, FileNameable, PropertyListingManageable;

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
    public $images = [];

    public function rules()
    {
        return [
            'property' => ['required', new PropertyInUsersRegion],
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'sqft' => 'required|numeric',
            'type' => 'required',
            'available' => 'required',
            'rent' => 'required|numeric',
            'description' => 'required',
            'images.*' => 'image|max:8000'
        ];
    }

    public function mount()
    {
        $this->regionList = $this->regionListSet();

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

    /**
     *  Create property listing
     */
    public function createListing()
    {
        $this->validate([
            'property' => 'required',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'sqft' => 'required|numeric',
            'type' => 'required',
            'available' => 'required',
            'rent' => 'required|numeric',
            'description' => 'required',
            'images.*' => 'image|max:8000'
        ]);

        if ($this->images) {

            $createdListing = PropertyListing::create([
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
    
            $this->storeImage($createdListing->id);

            session()->flash('success', 'Property listing created');
    
            return redirect()->to(route('employee.property-listing-index'));

        } else {

            session()->flash('error', 'Please select at least one image');

        }
    }

    public function render()
    {
        return view('livewire.employee-property-listing-create', [

            'regions' => $this->regionList,

            'properties' => $this->propertyList,

        ]);
    }
}
