<?php

namespace Tests;

use App\Models\Property;
use App\Models\PropertyListing;
use App\Models\Region;

trait Propertyable
{
    /**
     *  Create a property
     * 
     *  @return object
     */
    public function createProperty()
    {
        $region = Region::factory()->create();

        return Property::factory()->create([
            'region_id' => $region->id
        ]);
    }

    /**
     *  Create a property specifying region
     * 
     *  @param int $regionId
     *  @param int $count
     *  @return object
     */
    public function createPropertyByRegion(int $regionId)
    {
        return Property::factory()->create([
            'region_id' => $regionId
        ]);
    }

    /**
     *  Create property listing
     * 
     *  @param int $propertyId
     *  @return object
     */
    public function createPropertyListing(int $propertyId)
    {
        return PropertyListing::factory()->create([
            'property_id' => $propertyId
        ]);
    }

    /**
     *  Create property listing
     * 
     *  @param int $propertyId
     *  @return object
     */
    public function createPropertyListings(int $propertyId, int $count)
    {
        return PropertyListing::factory()->count($count)->create([
            'property_id' => $propertyId
        ]);
    }
}