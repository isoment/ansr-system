<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Livewire\Livewire;
use Tests\Leaseable;
use Tests\Propertyable;
use Tests\TestHelpable;
use Tests\Userable;

class EmployeeLeaseShowTest extends TestCase
{
    use RefreshDatabase, Userable, TestHelpable, Propertyable, Leaseable;

    /**
     *  @test
     * 
     *  The employee lease show component displays for employees only
     */
    public function the_lease_manage_page_displays_for_employees_only()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $lease = $this->createLease();

        $this->actingAs($tenant);

        $this->get(route('employee.lease-show', $lease->id))
            ->assertForbidden();

        $this->actingAs($manager);

        $this->get(route('employee.lease-show', $lease->id))
            ->assertSeeLivewire('employee-lease-show');
    }

    /**
     *  @test
     * 
     *  Maintenance employees cannot see lease show page
     */
    public function maintenance_employees_cannot_see_lease_show_page()
    {
        $maintenance = $this->createEmployee('Maintenance');

        $lease = $this->createLease();

        $this->actingAs($maintenance);

        $this->get(route('employee.lease-show', $lease->id))
            ->assertStatus(403);
    }

    /**
     *  @test
     * 
     *  Administrative employees can only see leases from their region
     */
    public function administrative_can_only_see_leases_from_their_region()
    {
        $admin = $this->createEmployee('Administrative');

        $propertyInRegion = $this->createPropertyByRegion($admin->userable->region->id);

        $propertyOutsideRegion = $this->createProperty();

        $manageableLeases = $this->createLeasesByPropertyId($propertyInRegion->id, 1);

        $unmanageableLeases = $this->createLeasesByPropertyId($propertyOutsideRegion->id, 1);

        $this->actingAs($admin);

        $this->get(route('employee.lease-show', $manageableLeases[0]->id))
            ->assertStatus(200);

        $this->get(route('employee.lease-show', $unmanageableLeases[0]->id))
            ->assertStatus(403);
    }
}
