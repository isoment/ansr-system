<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\ServiceRequestable;
use Tests\TestHelpable;
use Tests\Userable;
use Tests\WorkOrderable;

class EmployeeWorkOrderManageTest extends TestCase
{
    use RefreshDatabase, Userable, ServiceRequestable, WorkOrderable, TestHelpable;

    /**
     *  @test
     * 
     *  Livewire component displays for employees only
     */
    public function manage_work_order_displays_for_employees_only()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $request = $this->createServiceRequest($tenant->id);

        $workOrder = $this->createBlankWorkOrder($request->id);

        $this->actingAs($tenant);

        $this->get(route('employee.manage-workorder', $workOrder->id))
            ->assertForbidden();

        $this->actingAs($manager);

        $this->get(route('employee.manage-workorder', $workOrder->id))
            ->assertSeeLivewire('employee-work-order-manage');
    }

    /**
     *  @test
     * 
     *  Administrative users can only manage work orders for their region
     */
    public function administrative_users_can_only_manage_work_orders_for_their_region()
    {
        // Two tenants in different regions
        $tenantOne = $this->createTestingTenant();
        $tenantTwo = $this->createTestingTenant();

        $admin = $this->createEmployeeSpecifyRegion('Administrative', $tenantOne->tenantRegion());

        // Create a service request for each user
        $tenantOneRequest = $this->createServiceRequest($tenantOne->id);
        $tenantTwoRequest = $this->createServiceRequest($tenantTwo->id);

        // Create a work order for each service request
        $tenantOneWorkOrder = $this->createWorkOrderFromServiceRequest($tenantOneRequest->id);
        $tenantTwoWorkOrder = $this->createWorkOrderFromServiceRequest($tenantTwoRequest->id);

        $this->actingAs($admin);

        $this->get(route('employee.manage-workorder', $tenantOneWorkOrder->id))
            ->assertStatus(200);

        $this->get(route('employee.manage-workorder', $tenantTwoWorkOrder->id))
            ->assertStatus(403);
    }

    /**
     *  @test
     * 
     *  Maintenance employees only have access to work orders they are assigned to
     */
    public function maintenance_employees_only_have_access_to_work_orders_they_are_assigned_to()
    {
        // Two tenants in different regions
        $tenantOne = $this->createTestingTenant();
        $tenantTwo = $this->createTestingTenant();

        $admin = $this->createEmployeeSpecifyRegion('Administrative', $tenantOne->tenantRegion());

        // Create a service request for each user
        $tenantOneRequest = $this->createServiceRequest($tenantOne->id);
        $tenantTwoRequest = $this->createServiceRequest($tenantTwo->id);

        // Create a work order assigned to the admin employee and another one not
        $adminsWorkOrder = $this->createWorkOrderSpecifyRequestAndEmployee(
            $tenantOneRequest->id, $admin->userable->id
        );
        $workOrder = $this->createWorkOrderFromServiceRequest($tenantTwoRequest->id);

        $this->actingAs($admin);

        $this->get(route('employee.manage-workorder', $adminsWorkOrder->id))
            ->assertStatus(200);

        $this->get(route('employee.manage-workorder', $workOrder->id))
            ->assertStatus(403);
    }
}
