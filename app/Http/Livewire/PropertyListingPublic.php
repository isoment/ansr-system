<?php

namespace App\Http\Livewire;

use App\Models\PropertyListing;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyListingPublic extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.property-listing-public', [

            'totalProperties' => PropertyListing::count(),

            'properties' => PropertyListing::with('property')->paginate(12),

        ]);
    }
}
