<?php

namespace Tests;

use App\Models\Lease;
use App\Models\Property;
use App\Models\Region;
use Carbon\Carbon;

trait Leaseable
{
    /**
     *  Create a new lease
     * 
     *  @return object
     */
    public function createLease()
    {
        $region = Region::factory()->create();

        $property = Property::factory()->create([
            'region_id' => $region->id
        ]);

        return Lease::factory()->create([
            'property_id' => $property->id
        ]);
    }

    /**
     *  Create an open lease
     * 
     *  @return object
     */
    public function createOpenLease()
    {
        $region = Region::factory()->create();

        $property = Property::factory()->create([
            'region_id' => $region->id
        ]);

        return Lease::factory()->create([
            'property_id' => $property->id,
            'end_date' => Carbon::now()->addYear(),
        ]);
    }

    /**
     *  Create leases by property
     * 
     *  @param int $propertyId
     *  @param int $count
     *  @return object
     */
    public function createLeasesByPropertyId(int $propertyId, int $count)
    {
        return Lease::factory()->count($count)->create([
            'property_id' => $propertyId
        ]);
    }
    
}