<?php

namespace App\Http\Livewire;

use App\Models\PropertyListing;
use App\Models\Region;
use Illuminate\Support\Facades\Gate;
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

    /**
     *  Determine if we should filter by availability based on
     *  user input then pass true or false to query, we also want
     *  to display both if 'All' is selected or there is no selection
     */
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

    /**
     *  If the user is mananger allow filtering based on region
     *  otherwise if the user has a different role only show properties
     *  from their region.
     */
    public function regionQueryBasedOnRole($query)
    {
        if (Gate::allows('isManagement')) {

            return $query->when($this->filterByRegion, function($query) {
                $query->where('region_name', $this->regionToFilter);
            });

        } else {

            return $query->where('region_name', users_region());

        }
    }

    public function render()
    {
        return view('livewire.employee-property-listing-index', [

            'regions' => $this->regionList,

            'properties' => PropertyListing::whereHas('property.region', function($query) {

                    $this->regionQueryBasedOnRole($query);

                })->whereHas('property', function($query) {

                    $query->where('street', 'like', '%'.$this->search.'%')
                        ->orWhere('city', 'like', '%'.$this->search.'%');

                })->when($this->filterByAvailability, function($query) {

                    $query->where('available', $this->available);

                })->where('bedrooms', '>=', $this->bedCount)
                    ->where('bathrooms', '>=', $this->bathCount)
                    ->whereIn('type', $this->rentalType())
                    ->orderBy('created_at', 'desc')
                    ->paginate(10),

        ]);
    }
}
