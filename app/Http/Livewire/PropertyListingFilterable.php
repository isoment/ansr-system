<?php

namespace App\Http\Livewire;

trait PropertyListingFilterable
{
    public $regionList;
    public $filterByRegion = false;
    public $regionToFilter = 'All';
    public $bathCount = 1;
    public $bedCount = 1;
    public $types = [];

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
     *  Method to determine number of bathrooms to filter by
     */
    public function filterBaths($number)
    {
        if (is_numeric($number) && $number > 0) {
            $this->bathCount = $number;
        }
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
}