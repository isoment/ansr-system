<?php

namespace Tests\Feature;

use App\Http\Livewire\EmployeeLeaseManage;
use App\Models\Lease;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\Leaseable;
use Tests\Propertyable;
use Tests\TestCase;
use Tests\TestHelpable;
use Tests\Userable;

class EmployeeLeaseManageTest extends TestCase
{
    use RefreshDatabase, Userable, TestHelpable, Propertyable,
        Leaseable;

    /**
     *  @test
     * 
     *  The employee lease manage component displays for employees only
     */
    public function the_lease_manage_page_displays_for_employees_only()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $this->actingAs($tenant);

        $this->get(route('employee.lease-manage'))
            ->assertForbidden();

        $this->actingAs($manager);

        $this->get(route('employee.lease-manage'))
            ->assertSeeLivewire('employee-lease-manage');
    }

    /**
     *  @test
     * 
     *  Maintenance employees cannot see lease manage page
     */
    public function maintenance_employees_cannot_see_lease_manage_page()
    {
        $maintenance = $this->createEmployee('Maintenance');

        $this->actingAs($maintenance);

        $this->get(route('employee.lease-manage'))
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

        $manageableLeases = $this->createLeasesByPropertyId($propertyInRegion->id, 3);

        $unmanageableLeases = $this->createLeasesByPropertyId($propertyOutsideRegion->id, 3);

        $this->actingAs($admin);

        Livewire::test(EmployeeLeaseManage::class)
            ->assertSee($manageableLeases[0]->property->street)
            ->assertSee($manageableLeases[1]->property->city)
            ->assertDontSee($unmanageableLeases[1]->property->street)
            ->assertDontSee($unmanageableLeases[2]->property->city);
    }

    /**
     *  @test
     * 
     *  Managers can see all leases
     */
    public function managers_can_see_all_leases()
    {
        $manager = $this->createEmployee('Management');

        $propertyInRegion = $this->createPropertyByRegion($manager->userable->region->id);

        $propertyOutsideRegion = $this->createProperty();

        $manageableLeases = $this->createLeasesByPropertyId($propertyInRegion->id, 3);

        $unmanageableLeases = $this->createLeasesByPropertyId($propertyOutsideRegion->id, 3);

        $this->actingAs($manager);

        Livewire::test(EmployeeLeaseManage::class)
            ->assertSee($manageableLeases[0]->property->street)
            ->assertSee($manageableLeases[2]->property->city)
            ->assertSee($unmanageableLeases[1]->property->street)
            ->assertSee($unmanageableLeases[0]->property->city);
    }

    /**
     *  @test
     *  
     *  The lease search works as expected
     */
    public function the_lease_search_works_as_expected()
    {
        $manager = $this->createEmployee('Management');

        $propertyOne = $this->createProperty();
        $propertyTwo = $this->createProperty();

        $leasesPropertyOne = $this->createLeasesByPropertyId($propertyOne->id, 1);
        $leasesPropertyTwo = $this->createLeasesByPropertyId($propertyTwo->id, 1);

        $this->actingAs($manager);

        Livewire::test(EmployeeLeaseManage::class)
            ->assertSee($leasesPropertyOne[0]->property->street)
            ->assertSee($leasesPropertyTwo[0]->property->street)
            ->set('search', $leasesPropertyOne[0]->property->street)
            ->assertSee('ID: ' . $leasesPropertyOne[0]->id)
            ->assertDontSee('ID: ' . $leasesPropertyTwo[0]->id);
    }

    /**
     *  @test
     * 
     *  Property search in create lease modal works
     */
    public function property_search_in_modal_works()
    {
        $manager = $this->createEmployee('Management');

        $propertyOne = $this->createProperty();
        $propertyTwo = $this->createProperty();

        $propertyOneStreetCity = $propertyOne->street . ', ' . $propertyOne->city;
        $propertyTwoStreetCity = $propertyTwo->street . ', ' . $propertyTwo->city;

        $this->actingAs($manager);

        Livewire::test(EmployeeLeaseManage::class)
            ->assertSee($propertyOneStreetCity)
            ->assertSee($propertyTwoStreetCity)
            ->set('propertySearch', $propertyOne->street)
            ->assertSee($propertyOneStreetCity)
            ->assertDontSee($propertyTwoStreetCity);
    }

    /**
     *  @test
     * 
     *  A new lease can be created
     */
    public function a_new_lease_can_be_created()
    {
        $manager = $this->createEmployee('Management');

        $propertyOne = $this->createProperty();

        $this->actingAs($manager);

        $this->assertEmpty(Lease::first());

        Livewire::test(EmployeeLeaseManage::class)
            ->set('selectedProperty', $propertyOne->toArray())
            ->set('unit', 'dj2189ryheiajqo9328r')
            ->set('startDate', "2021-07-07")
            ->set('endDate', "2021-07-09")
            ->call('createLease')
            ->assertSee('Lease created successfully');

        $this->assertNotEmpty(Lease::first());
    }
}
