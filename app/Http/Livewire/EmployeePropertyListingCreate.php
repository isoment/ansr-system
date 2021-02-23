<?php

namespace App\Http\Livewire;

use App\Models\ListingImage;
use App\Models\Property;
use App\Models\PropertyListing;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmployeePropertyListingCreate extends Component
{
    use WithFileUploads;
    use FileNameable;

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
            'property' => 'required',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'sqft' => 'required|numeric',
            'type' => 'required',
            'available' => 'required',
            'rent' => 'required|numeric',
            'description' => 'required',
            'images.*' => 'required|image|max:8000'
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

    /**
     *  Realtime validation
     */
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
     *  Remove an  image from the images array
     */
    public function removeImage($image)
    {
        array_splice($this->images, $image, 1);
    }

    /**
     *  Create property listing
     */
    public function createListing()
    {
        // $customMessage = ['image' => 'Only images allowed'];

        $this->validate();

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

        // Loop over images and store
        foreach ($this->images as $key => $image) {
            $this->images[$key] = $image->storeAs('property-listings', $this->fileName($this->images[$key]), 'public');
        }

        // Create rows in database referencing images
        if ($this->images) {
            foreach ($this->images as $image) {
                ListingImage::create([
                    'property_listing_id' => $createdListing->id,
                    'image' => $image,
                ]);
            }
            $this->images = [];
        }

        session()->flash('success', 'Property listing created');

        return redirect()->to(route('employee.dashboard'));
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
