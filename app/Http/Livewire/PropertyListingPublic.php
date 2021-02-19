<?php

namespace App\Http\Livewire;

use App\Models\PropertyListing;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyListingPublic extends Component
{
    use WithPagination;

    public $sortSelect = 'newest';
    public $types = [];
    public $bathCount = 1;
    public $bedCount = 1;
    public $regionList;
    public $filterByRegion = false;
    public $regionToFilter = 'All';

    public function mount()
    {
        $this->regionList = Region::all()->pluck('region_name')->toArray();
    }

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

    /**
     *  Method to determine number of bathrooms to filter by
     */
    public function filterBaths($number)
    {
        if (is_numeric($number) && $number > 0) {
            $this->bathCount = $number;
        }
    }

    /**
     *  Method to determine number of bedrooms to filter by
     */
    public function filterBeds($number)
    {
        if (is_numeric($number) && $number > 0) {
            $this->bedCount = $number;
        }
    }

    /**
     *  Method to determine if we will filter by region and if so
     *  which region
     */
    public function regionFilter($region)
    {
        if ($region === 'All') {
            $this->filterByRegion = false;
            $this->regionToFilter = 'All';
        }

        if (in_array($region, $this->regionList)) {
            $this->filterByRegion = true;
            $this->regionToFilter = $region;
        }
    }

    public function render()
    {
        return view('livewire.property-listing-public', [

            'totalProperties' => PropertyListing::count(),

            'regions' => $this->regionList,

            'properties' => PropertyListing::whereHas('property.region', function($query) {
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
