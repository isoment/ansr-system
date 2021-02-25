<?php

namespace App\Http\Livewire;

use App\Models\PropertyListing;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeePropertyListingIndex extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.employee-property-listing-index', [
            'properties' => PropertyListing::with('property')->paginate(10),
        ]);
    }
}
