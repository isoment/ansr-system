<?php

namespace Tests\Feature;

use App\Http\Livewire\EmployeeServiceRequestIndex;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\ServiceRequestable;
use Tests\TestCase;
use Tests\Userable;
use Tests\WorkOrderable;
use Illuminate\Support\Str;

class EmployeeServiceRequestIndexTest extends TestCase
{
    use RefreshDatabase, Userable, ServiceRequestable, WorkOrderable;

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
        $tenantOne = $this->createTestingTenant();
        $tenantTwo = $this->createTestingTenant();
        $tenantThree = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $tenantOneRequests = $this->createMultipleServiceRequests($tenantOne->id, 8);
        $tenantTwoRequests = $this->createMultipleServiceRequests($tenantTwo->id, 6);
        $tenantThreeRequests = $this->createMultipleServiceRequests($tenantThree->id, 9);

        $this->actingAs($manager);

        Livewire::withQueryParams(['open' => 'true'])
            ->test(EmployeeServiceRequestIndex::class)
            ->assertSee(Str::limit($tenantOneRequests->shuffle()->first()->issue, 20));
    }
}
