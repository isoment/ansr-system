<?php

namespace Tests\Feature;

use App\Http\Livewire\EmployeeServiceRequestHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\ServiceRequestable;
use Tests\TestCase;
use Tests\TestHelpable;
use Tests\Userable;
use Tests\WorkOrderable;

class EmployeeServiceRequestHistoryTest extends TestCase
{
    use RefreshDatabase, Userable, ServiceRequestable, WorkOrderable, TestHelpable;

    /**
     *  @test
     * 
     *  Livewire component displays for employees only
     */
    public function employee_service_request_history_displays_for_employees_only()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $this->actingAs($tenant);

        $this->get(route('employee.request-history'))
            ->assertForbidden();

        $this->actingAs($manager);

        $this->get(route('employee.request-history'))
            ->assertSeeLivewire('employee-service-request-history');
    }

    /**
     *  @test
     * 
     *  All selectable properties should be listed for managers.
     */
    public function all_selectable_properties_should_be_listed_for_managers()
    {
        // Create two tenants, each will have a different property
        $tenantOne = $this->createTestingTenant();
        $tenantTwo = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $this->actingAs($manager);

        Livewire::test(EmployeeServiceRequestHistory::class)
            ->assertSee($tenantOne->tenantProperty()->street)
            ->assertSee($tenantTwo->tenantProperty()->street)
            ->assertSee($tenantOne->tenantProperty()->zipcode)
            ->assertSee($tenantTwo->tenantProperty()->city);
    }

    /**
     *  @test
     * 
     *  Only properties in the same region should be listed for administrative
     *  and maintenance roles.
     */
    public function only_properties_in_the_same_region_are_listed_for_admin_and_maintenance()
    {
        // Create three tenants, each with a different property and region
        $tenantOne = $this->createTestingTenant();
        $tenantTwo = $this->createTestingTenant();
        $tenantThree = $this->createTestingTenant();

        $administrative = $this->createEmployeeSpecifyRegion('Administrative', $tenantOne->tenantRegion());
        $maintenance = $this->createEmployeeSpecifyRegion('Maintenance', $tenantTwo->tenantRegion());

        $this->actingAs($administrative);

        Livewire::test(EmployeeServiceRequestHistory::class)
            ->assertSee($tenantOne->tenantProperty()->street)
            ->assertDontSee($tenantTwo->tenantProperty()->street)
            ->assertDontSee($tenantThree->tenantProperty()->street);

        $this->actingAs($maintenance);

        Livewire::test(EmployeeServiceRequestHistory::class)
            ->assertSee($tenantTwo->tenantProperty()->street)
            ->assertDontSee($tenantOne->tenantProperty()->street)
            ->assertDontSee($tenantThree->tenantProperty()->street);
    }
}
