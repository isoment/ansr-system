<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Gate;
use App\Models\Region;
use App\Models\Property;
use App\Models\ListingImage;

trait PropertyListingManageable
{
    /**
     *  When we try to preview non image files after upload an error is thrown
     *  because livewire does not allow this. Lets filter over the images each
     *  time the images property is updated and remove any non images.
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
     *  Remove an  image from the images array
     */
    public function removeImage($image)
    {
        array_splice($this->images, $image, 1);
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
     *  Method to store images and update the ListingImage model
     *  @param int the id of the property listing the images will be tied to
     */
    private function storeImage($propertyListingId)
    {
        // Loop over images and store
        foreach ($this->images as $key => $image) {
            $this->images[$key] = $image->storeAs('property-listings', $this->fileName($this->images[$key]), 'public');
        }

        // Create rows in database referencing images
        foreach ($this->images as $image) {
            ListingImage::create([
                'property_listing_id' => $propertyListingId,
                'image' => $image,
            ]);
        }
        $this->images = [];
    }
}