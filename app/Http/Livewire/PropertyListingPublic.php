<?php

namespace App\Http\Livewire;

use App\Models\PropertyListing;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyListingPublic extends Component
{
    use WithPagination;

    public $sortSelect = 'newest';

    /**
     *  Lifecycle hook runs this function when sortSelect
     *  is updated
     */
    // public function updatedSortSelect()
    // {
    //     dump($this->sortSelect);
    // }

    public function render()
    {
        return view('livewire.property-listing-public', [

            'totalProperties' => PropertyListing::count(),

            'properties' => PropertyListing::with('property')
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
