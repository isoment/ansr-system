<?php

namespace Tests;

use App\Models\Property;
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
}