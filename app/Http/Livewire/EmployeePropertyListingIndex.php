<?php

namespace App\Http\Livewire;

use App\Models\PropertyListing;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeePropertyListingIndex extends Component
{
    use WithPagination;
    use PropertyListingFilterable;

    public $search;
    public $availabilityInput = 'all';
    public $filterByAvailability = false;
    public $available;

    public function mount()
    {
        $this->regionList = Region::all()->pluck('region_name')->toArray();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedAvailabilityInput()
    {
        switch ($this->availabilityInput) {
            case "available":
                $this->filterByAvailability = true;
                $this->available = true;
                break;
            case "unavailable":
                $this->filterByAvailability = true;
                $this->available = false;
                break;
            default:
                $this->filterByAvailability = false;
                break;
        }
    }

    public function render()
    {
        return view('livewire.employee-property-listing-index', [

            'regions' => $this->regionList,

            'properties' => PropertyListing::whereHas('property.region', function($query) {

                    $query->when($this->filterByRegion, function($query) {
                        $query->where('region_name', $this->regionToFilter);
                    });

                })->whereHas('property', function($query) {

                    $query->where('street', 'like', '%'.$this->search.'%')
                        ->orWhere('city', 'like', '%'.$this->search.'%');

                })->when($this->filterByAvailability, function($query) {

                    $query->where('available', $this->available);

                })->where('bedrooms', '>=', $this->bedCount)
                    ->where('bathrooms', '>=', $this->bathCount)
                    ->whereIn('type', $this->rentalType())
                    ->paginate(10),

        ]);
    }
}
