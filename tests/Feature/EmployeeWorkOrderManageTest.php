<?php

namespace Tests\Feature;

use App\Http\Livewire\EmployeeWorkOrderManage;
use App\Models\WorkDetails;
use App\Models\WorkOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
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

    /**
     *  @test
     * 
     *  A blank work order can be created and title and assigned to can be updated.
     */
    public function a_blank_work_order_can_be_created_and_updated()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployeeSpecifyRegion('Management', $tenant->tenantRegion());

        $employee = $this->createEmployeeSpecifyRegion('Maintenance', $tenant->tenantRegion());

        $request = $this->createServiceRequest($tenant->id);

        $workOrder = $this->createBlankWorkOrder($request->id);

        $this->actingAs($manager);

        $this->assertEmpty($workOrder->title);
        $this->assertEmpty($workOrder->employee_id);

        Livewire::test(EmployeeWorkOrderManage::class, ['workOrder' => $workOrder])
            ->assertDontSee('Work order updated')
            ->set('title', 'TestTitle42893e3')
            ->set('assignment', $employee->userable->employee_id_number)
            ->call('editWorkOrder')
            ->assertSee('Work order updated');

        $updatedWorkOrder = WorkOrder::find($workOrder->id);
        
        $this->assertNotEmpty($updatedWorkOrder->title);
        $this->assertNotEmpty($updatedWorkOrder->employee_id);
    }

    /**
     *  @test
     * 
     *  A work order cannot be completed if there are no details
     */
    public function a_work_order_cannot_be_completed_if_there_are_no_details()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployeeSpecifyRegion('Management', $tenant->tenantRegion());

        $request = $this->createServiceRequest($tenant->id);

        $workOrder = $this->createBlankWorkOrder($request->id);

        $this->actingAs($manager);

        $this->assertEmpty($workOrder->end_date);

        Livewire::test(EmployeeWorkOrderManage::class, ['workOrder' => $workOrder])
            ->call('toggleEndDate')
            ->assertSee('You cannot complete this order until details are added');

        $this->assertEmpty(WorkOrder::find($workOrder->id)->end_date);
    }

    /**
     *  @test
     * 
     *  A work order can be started only once.
     */
    public function a_work_order_can_be_started_only_once()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployeeSpecifyRegion('Management', $tenant->tenantRegion());

        $request = $this->createServiceRequest($tenant->id);

        $workOrder = $this->createBlankWorkOrder($request->id);

        $this->actingAs($manager);

        $this->assertEmpty($workOrder->start_date);

        Livewire::test(EmployeeWorkOrderManage::class, ['workOrder' => $workOrder])
            ->call('startWorkOrder')
            ->assertSee('Work order started')
            ->call('startWorkOrder')
            ->assertSee('Work order has already been started');

        $this->assertNotEmpty(WorkOrder::find($workOrder->id)->start_date);
    }

    /**
     *  @test
     * 
     *  A work order detail can be added to an incomplete work order
     */
    public function a_work_order_detail_can_be_added_to_an_incomplete_work_order()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployeeSpecifyRegion('Management', $tenant->tenantRegion());

        $request = $this->createServiceRequest($tenant->id);

        $workOrder = $this->createBlankWorkOrder($request->id);

        $this->actingAs($manager);

        $this->assertEmpty(WorkDetails::first());

        Livewire::test(EmployeeWorkOrderManage::class, ['workOrder' => $workOrder])
            ->set('tenantNotes', 'TenAnTNOTESi3jf89e0wfej')
            ->set('formDetails', 'formDetailslfasmosajfiwefhe')
            ->call('createWorkDetail')
            ->assertSee('TenAnTNOTESi3jf89e0wfej')
            ->assertSee('formDetailslfasmosajfiwefhe');

        $this->assertNotEmpty(WorkDetails::first());
    }

    /**
     *  @test
     * 
     *  When a work order is closed no new details can be added
     */
    public function no_new_details_can_be_added_to_a_closed_work_order()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployeeSpecifyRegion('Management', $tenant->tenantRegion());

        $request = $this->createServiceRequest($tenant->id);

        $workOrder = $this->createBlankWorkOrder($request->id);

        // Complete the work order
        $workOrder->update([
            'end_date' => now()
        ]);

        $this->actingAs($manager);

        $this->assertEmpty(WorkDetails::first());

        Livewire::test(EmployeeWorkOrderManage::class, ['workOrder' => $workOrder])
            ->set('tenantNotes', 'test')
            ->set('formDetails', 'test')
            ->call('createWorkDetail')
            ->assertSee('You cannot create new details for a completed work order');

        $this->assertEmpty(WorkDetails::first());
    }
}
