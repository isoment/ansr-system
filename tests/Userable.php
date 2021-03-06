<?php

namespace Tests;

use App\Models\Employee;
use App\Models\Lease;
use App\Models\Property;
use App\Models\Region;
use App\Models\Tenant;
use App\Models\User;

trait Userable 
{
    /**
     *  Create a tenant and associated models for testing
     * 
     *  @return object
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

    /**
     *  Create a tenant for a lease
     * 
     *  @param int $leaseId
     *  @return object
     */
    public function createTenantForLease(int $leaseId)
    {
        $tenant = Tenant::factory()->create([
            'lease_id' => $leaseId
        ]);

        return User::create([
            'name' => 'TestTenant',
            'email' => $tenant->email,
            'userable_type' => 'App\Models\Tenant',
            'userable_id' => $tenant->id,
            'password' => bcrypt('password'),
        ]);
    }

    /**
     *  Create an employee and associated models for testing
     * 
     *  @param string $role
     *  @return object
     */
    public function createEmployee(string $role)
    {
        $region = Region::factory()->create();

        $employee = Employee::factory()->create([
            'region_id' => $region->id,
            'role' => $role,
        ]);

        return User::create([
            'name' => 'TestMananger',
            'email' => $employee->email,
            'userable_type' => 'App\Models\Employee',
            'userable_id' => $employee->id,
            'password' => bcrypt('password'),
        ]);
    }

    /**
     *  Create an employee in a specific region
     * 
     *  @param string $role
     *  @param object $region
     *  @return object
     */
    public function createEmployeeSpecifyRegion(string $role, object $region)
    {
        $employee = Employee::factory()->create([
            'region_id' => $region->id,
            'role' => $role,
        ]);

        return User::create([
            'name' => 'TestMananger',
            'email' => $employee->email,
            'userable_type' => 'App\Models\Employee',
            'userable_id' => $employee->id,
            'password' => bcrypt('password'),
        ]);
    }
}