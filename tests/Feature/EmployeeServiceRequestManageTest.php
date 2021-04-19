<?php

namespace Tests\Feature;

use App\Http\Livewire\EmployeeServiceRequestManage;
use App\Models\ServiceRequest;
use App\Models\WorkOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Gate;
use Livewire\Livewire;
use Prophecy\Call\Call;
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

        // Two employees assigned to a tenants region
        $admin = $this->createEmployeeSpecifyRegion('Administrative', $tenantOne->tenantRegion());
        $maint = $this->createEmployeeSpecifyRegion('Maintenance', $tenantTwo->tenantRegion());

        $tenantOneRequest = $this->createServiceRequest($tenantOne->id);
        $tenantTwoRequest = $this->createServiceRequest($tenantTwo->id);

        $this->actingAs($admin);

        // Admin can access this request because it's in the same region
        $this->get(route('employee.manage-request', $tenantOneRequest->id))
            ->assertStatus(200)
            ->assertSeeLivewire('employee-service-request-manage');

        // Admin should get 403 since this request is in a different region
        $this->get(route('employee.manage-request', $tenantTwoRequest->id))
            ->assertStatus(403);

        $this->actingAs($maint);

        $this->get(route('employee.manage-request', $tenantTwoRequest->id))
            ->assertStatus(200);

        $this->get(route('employee.manage-request', $tenantOneRequest->id))
            ->assertStatus(403);
    }

    /**
     *  @test
     *  
     *  A work order can be added to a service request
     */
    public function a_work_order_can_be_added_to_a_service_request()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $request = $this->createServiceRequest($tenant->id);

        $this->actingAs($manager);

        Livewire::test(EmployeeServiceRequestManage::class, ['request' => $request])
            ->assertDontSee('Work Order ID:')
            ->call('newWorkOrder')
            ->assertSee('Work Order ID:');
    }

    /**
     *  @test
     * 
     *  A work order can be deleted from a service request
     */
    public function a_work_order_can_be_deleted_from_a_service_request()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $request = $this->createServiceRequest($tenant->id);

        $this->actingAs($manager);

        Livewire::test(EmployeeServiceRequestManage::class, ['request' => $request])
            ->assertDontSee('Work Order ID: ')
            ->call('newWorkOrder')
            ->assertSee('Work Order ID: ')
            ->call('deleteWorkOrder', WorkOrder::find(1)->id)
            ->assertDontSee('Work Order ID: ');
    }

    /**
     *  @test
     * 
     *  A service request can be completed when all work orders are complete
     */
    public function a_request_can_be_completed_if_all_work_orders_are_completed()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $request = $this->createServiceRequest($tenant->id);

        $workOrder = $this->createCompletedWorkOrderFromServiceRequest($request->id);

        $this->actingAs($manager);

        $this->assertEmpty($request->completed_date);

        Livewire::test(EmployeeServiceRequestManage::class, ['request' => $request])
            ->assertSee($request->issue)
            ->assertSee('Work Order ID: ')
            ->assertSee($workOrder->employee->last_name)
            ->assertSee('Complete Request')
            ->call('toggleComplete')
            ->assertSee('Reopen Request');

        $requestUpdated = ServiceRequest::find($request->id);

        $this->assertNotEmpty($requestUpdated->completed_date);
    }

    /**
     *  @test
     * 
     *  A service request cannot be completed when it has incomplete work orders.
     */
    public function a_request_cannot_be_completed_if_there_are_incomplete_work_orders()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $request = $this->createServiceRequest($tenant->id);

        $workOrder = $this->createWorkOrderFromServiceRequest($request->id);

        $this->actingAs($manager);

        $this->assertEmpty($request->completed_date);

        Livewire::test(EmployeeServiceRequestManage::class, ['request' => $request])
            ->assertSee($request->issue)
            ->assertSee($workOrder->employee->last_name)
            ->assertDontSee('Complete Request')
            ->call('toggleComplete')
            ->assertSee('All work orders must be completed to close this service request');

        $requestUpdated = ServiceRequest::find($request->id);

        $this->assertEmpty($requestUpdated->completed_date);
    }

    /**
     *  @test
     * 
     *  A service request can be reopened
     */
    public function a_request_can_be_reopened()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $request = $this->createServiceRequest($tenant->id);

        $workOrder = $this->createCompletedWorkOrderFromServiceRequest($request->id);

        // Close the service request
        $request->update(['completed_date' => now()]);

        $this->actingAs($manager);

        $this->assertNotEmpty($request->completed_date);

        Livewire::test(EmployeeServiceRequestManage::class, ['request' => $request])
            ->assertSee($request->issue)
            ->assertSee($workOrder->employee->last_name)
            ->assertSee('Reopen Request')
            ->call('toggleComplete')
            ->assertSee('Complete Request');

        $requestUpdated = ServiceRequest::find($request->id);

        $this->assertEmpty($requestUpdated->completed_date);
    }
}
