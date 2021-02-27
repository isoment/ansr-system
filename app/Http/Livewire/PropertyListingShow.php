<?php

namespace App\Http\Livewire;

use App\Models\ListingImage;
use App\Models\PropertyListing;
use Livewire\Component;

class PropertyListingShow extends Component
{
    public $propertyListing;
    public $currentImage;

    public function mount()
    {
        $this->currentImage = $this->propertyListing->getAnImage();
    }

    /**
     *  Method to select an image
     */
    public function selectImage($id)
    {
        $this->currentImage = ListingImage::find($id)->image;
    }

    public function render()
    {
        return view('livewire.property-listing-show', [

            'photos' => $this->propertyListing->listingImages,

        ]);
    }
}
