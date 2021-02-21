<?php

namespace App\Http\Livewire;

use App\Models\PropertyListing;
use Livewire\Component;

class PropertyListingShow extends Component
{
    public $propertyListing;

    public function render()
    {
        return view('livewire.property-listing-show', [

            'relatedRentals' => PropertyListing::whereHas('property.region', function($query) {
                $query->where('region_name', $this->propertyListing->property->region->region_name);
            })->inRandomOrder()->take(4)->get(),

        ]);
    }
}
