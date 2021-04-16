<?php

namespace Tests\Feature;

use App\Http\Livewire\TenantRequestShow;
use App\Models\Employee;
use App\Models\WorkDetails;
use App\Models\WorkOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\ServiceRequestable;
use Tests\TestCase;
use Tests\Userable;
use Tests\WorkOrderable;

class TenantRequestShowTest extends TestCase
{
    use RefreshDatabase, Userable, ServiceRequestable, WorkOrderable;

    /**
     *  @test
     * 
     *  The tenant request show component should display for the tenant.
     */
    public function tenant_request_show_page_shows_livewire_component()
    {
        $tenant = $this->createTestingTenant();

        $serviceRequest = $this->createServiceRequest($tenant->userable->id);

        $this->actingAs($tenant);

        $this->get(route('tenant.request-show', $serviceRequest->id))
            ->assertSeeLivewire('tenant-request-show');
    }

    /**
     *  @test
     * 
     *  The tenant request show component should not be visible if the tenant
     *  did not file the request.
     */
    public function tenant_request_show_should_not_be_visible_to_non_owner()
    {
        $tenantOne = $this->createTestingTenant();

        $tenantTwo = $this->createTestingTenant();

        $tenantOneRequest = $this->createServiceRequest($tenantOne->userable->id);

        $this->actingAs($tenantTwo);

        $this->get(route('tenant.request-show', $tenantOneRequest->id))
            ->assertForbidden();
    }

    /**
     *  @test
     * 
     *  The tenant should be able to see service request and work orders
     */
    public function tenant_should_be_able_to_see_work_orders()
    {
        $tenant = $this->createTestingTenant();

        $request = $this->createServiceRequest($tenant->userable->id);

        $workOrder = $this->createWorkOrderFromServiceRequest($request->id);

        $this->actingAs($tenant);

        Livewire::test(TenantRequestShow::class, ['serviceRequest' => $request])
            ->assertSee($request->issue)
            ->assertSee($workOrder->title);
    }

    /**
     *  @test
     * 
     *  The tenant should be able to view details for the work order.
     */
    public function tenant_can_view_work_details()
    {
        $tenant = $this->createTestingTenant();

        $request = $this->createServiceRequest($tenant->userable->id);

        $workOrder = $this->createWorkOrderFromServiceRequest($request->id);

        $workDetail = $this->createWorkDetailFromWorkOrder($workOrder->id);

        Livewire::test(TenantRequestShow::class, ['serviceRequest' => $request])
            ->call('selectWorkOrder', $workOrder->id)
            ->assertSee($workDetail->tenant_notes);
    }
}
