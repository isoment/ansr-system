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

    /**
     *  Create property listings specify bedroom count
     * 
     *  @param int $propertyId
     *  @param int $count
     *  @param int $beds
     *  @return object
     */
    public function createPropertyListingBedCount(int $propertyId, int $count, int $beds)
    {
        return PropertyListing::factory()->count($count)->create([
            'property_id' => $propertyId,
            'bedrooms' => $beds
        ]);
    }

    /**
     *  Create property listings specify bathroom count
     * 
     *  @param int $propertyId
     *  @param int $count
     *  @param int $baths
     *  @return object
     */
    public function createPropertyListingBathCount(int $propertyId, int $count, int $baths)
    {
        return PropertyListing::factory()->count($count)->create([
            'property_id' => $propertyId,
            'bathrooms' => $baths
        ]);
    }

    /**
     *  Create a property listing of a specific type
     *  @param int $propertyId
     *  @param string $type
     *  @return object
     */
    public function createPropertyListingByType(int $propertyId, string $type)
    {
        return PropertyListing::factory()->create([
            'property_id' => $propertyId,
            'type' => $type
        ]);
    }

    /**
     *  Create a property listing by availability
     *  @param int $propertyId
     *  @param string $available
     *  @return object
     */
    public function createPropertyListingByAvailability(int $propertyId, string $available)
    {
        return PropertyListing::factory()->create([
            'property_id' => $propertyId,
            'available' => $available
        ]);
    }
}