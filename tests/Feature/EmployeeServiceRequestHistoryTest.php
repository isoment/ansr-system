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

    /**
     *  @test
     * 
     *  The property search works as expected
     */
    public function the_property_search_works_as_expected()
    {
        // Create three tenants, each with a different property and region
        $tenantOne = $this->createTestingTenant();
        $tenantTwo = $this->createTestingTenant();
        $tenantThree = $this->createTestingTenant();

        $employee = $this->createEmployee('Management');

        $this->actingAs($employee);

        Livewire::test(EmployeeServiceRequestHistory::class)
            ->set('propertySearch', $tenantOne->tenantProperty()->street)
            ->assertSee($tenantOne->tenantProperty()->street)
            ->assertSee($tenantOne->tenantProperty()->city)
            ->assertDontSee($tenantTwo->tenantProperty()->street)
            ->assertDontSee($tenantThree->tenantProperty()->street);
    }

    /**
     *  @test
     * 
     *  When a property is selected service requests are displayed
     */
    public function when_property_is_selected_requests_are_displayed()
    {
        $tenantOne = $this->createTestingTenant();
        $tenantTwo = $this->createTestingTenant();

        $employee = $this->createEmployee('Management');

        $tenantOneRequests = $this->createMultipleServiceRequests($tenantOne->id, 3);
        $tenantTwoRequests = $this->createMultipleServiceRequests($tenantTwo->id, 3);

        $this->actingAs($employee);

        Livewire::test(EmployeeServiceRequestHistory::class)
            ->call('setProperty', $tenantOne->tenantProperty()->toArray())
            ->assertSee($this->stringLimitOrNot($tenantOneRequests[0]['issue'], 25))
            ->assertDontSee($this->stringLimitOrNot($tenantTwoRequests[0]['issue'], 25))
            ->call('setProperty', $tenantTwo->tenantProperty()->toArray())
            ->assertSee($this->stringLimitOrNot($tenantTwoRequests[1]['issue'], 25))
            ->assertDontSee($this->stringLimitOrNot($tenantOneRequests[1]['issue'], 25));
    }

    /**
     *  @test
     * 
     *  The search allows filtering by unit
     */
    public function unit_search_filters_by_unit_correctly()
    {
        $tenantOne = $this->createTestingTenant();

        $employee = $this->createEmployee('Management');

        $request = $this->createServiceRequest($tenantOne->id);

        $this->actingAs($employee);

        Livewire::test(EmployeeServiceRequestHistory::class)
            ->call('setProperty', $tenantOne->tenantProperty()->toArray())
            ->assertSee($this->stringLimitOrNot($request->issue, 25))
            ->set('unitSearch', $tenantOne->userable->lease->unit)
            ->assertSee($this->stringLimitOrNot($request->issue, 25))
            ->set('unitSearch', uniqid())
            ->assertDontSee($this->stringLimitOrNot($request->issue, 25));
    }
}
