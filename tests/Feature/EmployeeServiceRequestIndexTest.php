<?php

namespace Tests\Feature;

use App\Http\Livewire\EmployeeServiceRequestIndex;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\ServiceRequestable;
use Tests\TestCase;
use Tests\Userable;
use Tests\WorkOrderable;
use Tests\TestHelpable;

class EmployeeServiceRequestIndexTest extends TestCase
{
    use RefreshDatabase, Userable, ServiceRequestable, WorkOrderable, TestHelpable;

    /**
     *  @test
     * 
     *  Livewire component displays for employees only
     */
    public function employee_service_request_index_displays_for_employees_only()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $this->actingAs($tenant);

        $this->get(route('employee.service-request-index'))
            ->assertForbidden();

        $this->actingAs($manager);

        $this->get(route('employee.service-request-index'))
            ->assertSeeLivewire('employee-service-request-index');
    }

    /**
     *  @test
     * 
     *  Management user can see all service requests
     */
    public function management_user_can_see_all_service_requests()
    {
        // Create 3 users, all different regions
        $tenantOne = $this->createTestingTenant();
        $tenantTwo = $this->createTestingTenant();
        $tenantThree = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $tenantOneRequests = $this->createMultipleServiceRequests($tenantOne->id, 2);
        $tenantTwoRequests = $this->createMultipleServiceRequests($tenantTwo->id, 2);
        $tenantThreeRequests = $this->createMultipleServiceRequests($tenantThree->id, 2);

        $this->actingAs($manager);

        Livewire::withQueryParams(['open' => 'true'])
            ->test(EmployeeServiceRequestIndex::class)
            ->assertSee(
                $this->stringLimitOrNot($tenantOneRequests->shuffle()->first()->issue, 20)
            )
            ->assertSee(
                $this->stringLimitOrNot($tenantTwoRequests->shuffle()->first()->issue, 20)
            )
            ->assertSee(
                $this->stringLimitOrNot($tenantThreeRequests->shuffle()->first()->issue, 20)
            );
    }

    /**
     *  @test
     * 
     *  Administrative user can only see service requests within their region
     */
    public function administrative_can_only_see_requests_from_their_region()
    {
        $tenantOne = $this->createTestingTenant();
        $tenantTwo = $this->createTestingTenant();

        // Create an administrative user in the same region as $tenantOne 
        $administrative = $this->createEmployeeSpecifyRegion('Administrative', $tenantOne->tenantRegion());

        $tenantOneRequests = $this->createMultipleServiceRequests($tenantOne->id, 3);
        $tenantTwoRequests = $this->createMultipleServiceRequests($tenantTwo->id, 3);

        $this->actingAs($administrative);

        Livewire::withQueryParams(['open' => 'true'])
            ->test(EmployeeServiceRequestIndex::class)
            ->assertSee(
                $this->stringLimitOrNot($tenantOneRequests->shuffle()->first()->issue, 20)
            )
            ->assertDontSee(
                $this->stringLimitOrNot($tenantTwoRequests->shuffle()->first()->issue, 20)
            );
    }
}
