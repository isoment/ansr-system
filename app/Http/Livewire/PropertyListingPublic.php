<?php

namespace App\Http\Livewire;

use App\Models\PropertyListing;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyListingPublic extends Component
{
    use WithPagination;

    public $sortSelect = 'newest';
    public $types = [];

    /**
     *  A method to return an array of rental types based on input checkboxes
     *  @return array
     */
    public function rentalType() 
    {
        // On page load there will be no selection, so load all types
        if (empty($this->types)) {
            return ['apartment', 'house', 'townhouse'];
        }

        // Create an array to store checked values
        $newArray = array();

        // Loop over types input checkbox values, when checkbox is true
        // assign to array above
        foreach($this->types as $key => $val) {
            if ($val === true) {
                $newArray[] = $key;
            }
        }

        // If the new array is empty, ie all boxes unchecked (each value false)
        // return an array with all values, else return $newArray
        if (empty($newArray)) {
            return ['apartment', 'house', 'townhouse'];
        } else {
            return $newArray;
        }
    }

    public function render()
    {
        return view('livewire.property-listing-public', [

            'totalProperties' => PropertyListing::count(),

            'properties' => PropertyListing::with('property')
                ->whereIn('type', $this->rentalType())
                ->when($this->sortSelect === 'newest', function($query) {
                    $query->orderBy('created_at', 'desc');
                })->when($this->sortSelect === 'price-lo-hi', function($query) {
                    $query->orderBy('rent', 'asc');
                })->when($this->sortSelect === 'price-hi-lo', function($query) {
                    $query->orderBy('rent', 'desc');
                })->when($this->sortSelect === 'square-feet', function($query) {
                    $query->orderBy('sqft', 'desc');
                })->paginate(12),
        ]);
    }
}
