<?php

namespace Tests\Feature;

use App\Http\Livewire\EmployeeServiceRequestManage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\ServiceRequestable;
use Tests\TestHelpable;
use Tests\Userable;
use Tests\WorkOrderable;

class EmployeeServiceRequestManangeTest extends TestCase
{
    use RefreshDatabase, Userable, ServiceRequestable, WorkOrderable, TestHelpable;

    /**
     *  @test
     * 
     *  Livewire component displays for employees only
     */
    public function employee_service_request_manage_displays_for_employees_only()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $request = $this->createServiceRequest($tenant->id);

        $this->actingAs($tenant);

        $this->get(route('employee.manage-request', $request->id))
            ->assertForbidden();

        $this->actingAs($manager);

        $this->get(route('employee.manage-request', $request->id))
            ->assertSeeLivewire('employee-service-request-manage');
    }

    /**
     *  @test
     * 
     *  Correct service request info is displayed
     */
    public function the_correct_service_request_info_is_displayed()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $request = $this->createServiceRequest($tenant->id);

        $this->actingAs($manager);

        Livewire::test(EmployeeServiceRequestManage::class, ['request' => $request])
            ->assertSee($request->issue)
            ->assertSee($request->description)
            ->assertSee($request->lease->id)
            ->assertSee($request->tenant_charges);
    }

    /**
     *  @test
     * 
     *  Administrative and Maintenance users cannot view requests outside
     *  their regions.
     */
    public function non_manangers_cannot_view_requests_outside_their_region()
    {
        // Three tenants in different regions
        $tenantOne = $this->createTestingTenant();
        $tenantTwo = $this->createTestingTenant();
        $tenantThree = $this->createTestingTenant();

        // Two employees assigned to a tenants region
        $admin = $this->createEmployeeSpecifyRegion('Administrative', $tenantOne->tenantRegion());
        $maint = $this->createEmployeeSpecifyRegion('Maintenance', $tenantTwo->tenantRegion());

        $tenantOneRequest = $this->createServiceRequest($tenantOne->id);
        $tenantTwoRequest = $this->createServiceRequest($tenantTwo->id);
        $tenantThreeRequest = $this->createServiceRequest($tenantThree->id);

        $this->actingAs($admin);

        // Admin can access this request because it's in the same region
        $this->get(route('employee.manage-request', $tenantOneRequest->id))
            ->assertStatus(200)
            ->assertSeeLivewire('employee-service-request-manage');

        // Admin should get 403 since this request is in a different region
        $this->get(route('employee.manage-request', $tenantTwoRequest->id))
            ->assertStatus(403);

        $this->actingAs($maint);

        $this->get(route('employee.manage-request', $tenantOneRequest->id))
            ->assertStatus(403);
    }
}
