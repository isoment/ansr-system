<?php

namespace App\Http\Livewire;

use App\Models\ListingImage;
use Intervention\Image\Facades\Image;

trait PropertyListingManageable
{
    /**
     *  Realtime validation
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

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