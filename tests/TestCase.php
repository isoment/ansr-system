<?php

namespace Tests;

use App\Models\Lease;
use App\Models\Property;
use App\Models\Region;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     *  A helper to create a tenant and associated models
     */
    protected function createTestingTenant()
    {
        $region = Region::factory()->create([
            'region_name' => 'Test Region',
            'slug' => 'TST',
        ]);

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
