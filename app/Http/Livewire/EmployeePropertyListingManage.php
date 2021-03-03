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

    public $bedrooms;
    public $bathrooms;
    public $sqft;
    public $type;
    public $unit;
    public $available;
    public $rent;
    public $description;
    public $images = [];

    public function rules()
    {
        return [
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'sqft' => 'required|numeric',
            'available' => 'required',
            'rent' => 'required|numeric',
            'description' => 'required',
            'images.*' => 'image|max:5000'
        ];
    }

    public function mount($propertyListing)
    {
        $this->currentImages = $propertyListing->listingImages;
        $this->bedrooms = $propertyListing->bedrooms;
        $this->bathrooms = $propertyListing->bathrooms;
        $this->sqft = $propertyListing->sqft;
        $this->type = $propertyListing->type;
        $this->unit = $propertyListing->unit ? $propertyListing->unit : NULL;
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
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'sqft' => 'required|numeric',
            'available' => 'required',
            'rent' => 'required|numeric',
            'description' => 'required',
            'images.*' => 'image|max:5000'
        ]);

        $this->propertyListing->update([
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'unit' => $this->unit,
            'sqft' => $this->sqft,
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
     *  Delete property listing
     */
    public function deleteListing()
    {
        // Get ids of related listing images and delete them
        $listingIds = $this->propertyListing->listingImages->pluck('id');
        ListingImage::whereIn('id', $listingIds)->delete();

        $this->propertyListing->delete();

        session()->flash('success', 'Property listing deleted');
    
        return redirect()->to(route('employee.property-listing-index'));
    }

    public function render()
    {
        return view('livewire.employee-property-listing-manage');
    }
}
