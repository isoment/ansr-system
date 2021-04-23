<?php

namespace Tests\Feature;

use App\Http\Livewire\EmployeeLeaseShow;
use App\Models\Lease;
use App\Models\Tenant;
use Carbon\Carbon;
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

    /**
     *  @test
     * 
     *  The lease information is displayed
     */
    public function the_lease_information_is_displayed()
    {
        $manager = $this->createEmployee('Management');

        $lease = $this->createLease();

        $this->actingAs($manager);

        Livewire::test(EmployeeLeaseShow::class, ['lease' => $lease])
            ->assertSee($lease->property->street)
            ->assertSee($lease->property->city)
            ->assertSee($lease->property->zipcode);
    }

    /**
     *  @test
     * 
     *  Tenants on the lease are displayed
     */
    public function tenants_on_the_lease_are_displayed()
    {
        $manager = $this->createEmployee('Management');

        $lease = $this->createLease();

        $tenant = $this->createTenantForLease($lease->id);

        $this->actingAs($manager);

        Livewire::test(EmployeeLeaseShow::class, ['lease' => $lease])
            ->assertSee($tenant->first_name)
            ->assertSee($tenant->last_name)
            ->assertSee($tenant->email);
    }

    /**
     *  @test
     * 
     *  A new tenant can be created and added to lease
     */
    public function a_new_tenant_can_be_created_and_added_to_the_lease()
    {
        $manager = $this->createEmployee('Management');

        $lease = $this->createLease();

        $this->actingAs($manager);

        $this->assertEmpty(Tenant::first());

        Livewire::test(EmployeeLeaseShow::class, ['lease' => $lease])
            ->set('firstName', 'djoi38X')
            ->set('lastName', '9d9wqdw')
            ->set('email', 'test926@t3St.com')
            ->set('phone', '555-555-5555')
            ->call('createTenant');

        $newTenant = Tenant::first();

        $this->assertNotEmpty($newTenant);

        Livewire::test(EmployeeLeaseShow::class, ['lease' => $lease])
            ->assertSee($newTenant->first_name)
            ->assertSee($newTenant->last_name);
    }

    /**
     *  @test
     * 
     *  A lease can be extended
     */
    public function a_lease_can_be_extended()
    {
        $manager = $this->createEmployee('Management');

        $lease = $this->createLease();

        $tenant = $this->createTenantForLease($lease->id);

        $this->actingAs($manager);

        $aYearFromNow = Carbon::now()->addYear()->format('Y-m-d');

        Livewire::test(EmployeeLeaseShow::class, ['lease' => $lease])
            ->set('endDate', $aYearFromNow)
            ->call('extendLease')
            ->assertSee(Carbon::parse($aYearFromNow)->toFormattedDateString());
    }

    /**
     *  @test
     * 
     *  An existing tenant can be added to a lease
     */
    public function an_existing_tenant_can_be_added_to_a_lease()
    {
        $manager = $this->createEmployee('Management');

        $newLease = $this->createLease();

        $oldLease = $this->createLease();

        $tenant = $this->createTenantForLease($oldLease->id);

        $this->actingAs($manager);

        $this->assertEmpty($newLease->tenants);

        Livewire::test(EmployeeLeaseShow::class, ['lease' => $newLease])
            ->call('selectTenant', $tenant->userable->toArray())
            ->call('addExistingTenant')
            ->assertSee('Tenant removed from previous lease and added to this lease');

        $newLeaseTenants = Lease::find($newLease->id)->tenants;

        $this->assertNotEmpty($newLeaseTenants);

        $this->assertEmpty($oldLease->tenants);
    }
}
