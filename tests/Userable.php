<?php

namespace Tests;

use App\Models\Lease;
use App\Models\Property;
use App\Models\Region;
use App\Models\Tenant;
use App\Models\User;

trait Userable 
{
    /**
     *  A helper to create a tenant and associated models
     */
    public function createTestingTenant()
    {
        $region = Region::factory()->create();

        $property = Property::factory()->create([
            'region_id' => $region->id
        ]);

        $lease = Lease::factory()->create([
            'property_id' => $property->id
        ]);

        $tenant = Tenant::factory()->create([
            'lease_id' => $lease->id
        ]);

        return User::create([
            'name' => 'TestTenant',
            'email' => $tenant->email,
            'userable_type' => 'App\Models\Tenant',
            'userable_id' => $tenant->id,
            'password' => bcrypt('password'),
        ]);
    }
}