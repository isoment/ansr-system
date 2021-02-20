<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PropertyListingShow extends Component
{
    public $propertyListing;

    public function render()
    {
        return view('livewire.property-listing-show');
    }
}
