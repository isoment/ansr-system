<?php

namespace App\Http\Livewire;

use App\Models\ListingImage;
use Livewire\Component;
use App\Models\Property;
use App\Rules\PropertyInUsersRegion;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EmployeePropertyListingManage extends Component
{
    use WithFileUploads, FileNameable, PropertyListingManageable;

    public $propertyListing;
    public $currentImages;

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

    public function mount($propertyListing)
    {
        $this->regionList = $this->regionListSet();
        $this->region = $propertyListing->property->region->region_name;
        $this->propertyList = $this->propertyListSet();
        $this->property = $propertyListing->property->name;
        $this->currentImages = $propertyListing->listingImages;
        $this->bedrooms = $propertyListing->bedrooms;
        $this->bathrooms = $propertyListing->bathrooms;
        $this->sqft = $propertyListing->sqft;
        $this->unit = $propertyListing->unit ? $propertyListing->unit : NULL;
        $this->type = $propertyListing->type;
        $this->available = $propertyListing->available;
        $this->rent = $propertyListing->rent;
        $this->description = $propertyListing->description;
    }

    /**
     *  Delete seleced previously uploaded image from the database
     */
    public function deleteCurrentImage($imageID)
    {
        $currentImage = ListingImage::find($imageID);

        Storage::disk('public')->delete($currentImage->image);

        $currentImage->delete();

        $this->currentImages = $this->currentImages->where('id', '!=', $imageID);
    }

    /**
     *  Update a property listing
     */
    public function updatePropertyListing()
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

        $this->propertyListing->update([
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

        $this->storeImage($this->propertyListing->id);

        session()->flash('success', 'Property listing updated');

        $this->currentImages = ListingImage::where('property_listing_id', $this->propertyListing->id)
            ->get();
    }

    /**
     *  Get related
     */

    public function render()
    {
        return view('livewire.employee-property-listing-manage', [

            'regions' => $this->regionList,

            'properties' => $this->propertyList,

        ]);
    }
}
