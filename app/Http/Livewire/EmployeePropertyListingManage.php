<?php

namespace App\Http\Livewire;

use App\Models\ListingImage;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use App\Models\Property;
use App\Models\Region;
use App\Rules\PropertyInUsersRegion;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EmployeePropertyListingManage extends Component
{
    use WithFileUploads;
    use FileNameable;

    public $propertyListing;

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

    public $currentImages;
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
     *  When we try to preview non image files after upload an error is thrown
     *  because livewire does not allow this. Lets filter over the images each
     *  time the property is updated and remove any non images.
     */
    public function updatedImages($value)
    {
        foreach ($value as $key => $value) {
            $extension = pathinfo($value->getFileName(), PATHINFO_EXTENSION);
            if (! in_array($extension, ['jpg', 'jpeg', 'gif', 'bmp', 'png'])) {
                unset($this->images[$key]);
            }
        }
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

        // Loop over images and store
        foreach ($this->images as $key => $image) {
            $this->images[$key] = $image->storeAs('property-listings', $this->fileName($this->images[$key]), 'public');
        }

        // Create rows in database referencing images
        foreach ($this->images as $image) {
            ListingImage::create([
                'property_listing_id' => $this->propertyListing->id,
                'image' => $image,
            ]);
        }
        $this->images = [];

        session()->flash('success', 'Property listing updated');

        $this->currentImages = ListingImage::where('property_listing_id', $this->propertyListing->id)
            ->get();
    }

    /**
     *  Set the list of region depending on role
     */
    private function regionListSet()
    {
        if (Gate::allows('isManagement')) {
            return Region::pluck('region_name');
        } else {
            return Region::where('region_name', users_region())->pluck('region_name');
        }
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
