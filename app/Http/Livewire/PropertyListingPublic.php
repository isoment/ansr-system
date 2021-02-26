<?php

namespace App\Http\Livewire;

use App\Models\PropertyListing;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyListingPublic extends Component
{
    use WithPagination;
    use PropertyListingFilterable;

    public $sortSelect = 'newest';

    public function mount()
    {
        $this->regionList = Region::all()->pluck('region_name')->toArray();
    }

    public function render()
    {
        return view('livewire.property-listing-public', [

            'totalProperties' => PropertyListing::count(),

            'regions' => $this->regionList,

            'properties' => PropertyListing::where('available', true)
                ->whereHas('property.region', function($query) {

                    $query->when($this->filterByRegion, function($query) {
                        $query->where('region_name', $this->regionToFilter);
                    });
                    
                })->with('property.region')
                ->where('bedrooms', '>=', $this->bedCount)
                ->where('bathrooms', '>=', $this->bathCount)
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
