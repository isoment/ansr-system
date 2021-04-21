<?php

namespace Tests\Feature;

use App\Http\Livewire\EmployeeWorkDetailManage;
use App\Models\DetailImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\ServiceRequestable;
use Tests\TestHelpable;
use Tests\Userable;
use Tests\WorkOrderable;

class EmployeeWorkDetailsTest extends TestCase
{
    use RefreshDatabase, Userable, ServiceRequestable, WorkOrderable, TestHelpable;

    /**
     *  @test
     * 
     *  Livewire component displays for employees only
     */
    public function manage_work_details_displays_for_employees_only()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $request = $this->createServiceRequest($tenant->id);

        $workOrder = $this->createBlankWorkOrder($request->id);

        $workDetail = $this->createWorkDetailFromWorkOrder($workOrder->id);

        $this->actingAs($tenant);

        $this->get(route('employee.manage-details', $workDetail->id))
            ->assertForbidden();

        $this->actingAs($manager);

        $this->get(route('employee.manage-details', $workDetail->id))
            ->assertSeeLivewire('employee-work-detail-manage');
    }

    /**
     *  @test
     * 
     *  Administrative users can only manage work details from their region
     */
    public function admin_users_can_only_manange_details_from_their_region()
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

        // Create work detail for each work order
        $tenantOneWorkDetail = $this->createWorkDetailFromWorkOrder($tenantOneWorkOrder->id);
        $tenantTwoWorkDetail = $this->createWorkDetailFromWorkOrder($tenantTwoWorkOrder->id);

        $this->actingAs($admin);

        $this->get(route('employee.manage-details', $tenantOneWorkDetail->id))
            ->assertStatus(200);

        $this->get(route('employee.manage-details', $tenantTwoWorkDetail->id))
            ->assertStatus(403);
    }

    /**
     *  @test
     * 
     *  A file can be uploaded
     */
    public function a_file_can_be_uploaded()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $request = $this->createServiceRequest($tenant->id);

        $workOrder = $this->createWorkOrderFromServiceRequest($request->id);

        $workDetail = $this->createWorkDetailFromWorkOrder($workOrder->id);

        $this->actingAs($manager);

        // Set the fake storage disk to public like we have setup in storeImage
        Storage::fake('public');

        // Create a fake image
        $file = UploadedFile::fake()->image('test.jpg');

        Livewire::test(EmployeeWorkDetailManage::class, ['workDetail' => $workDetail])
            ->set('images', $file)
            ->call('storeImage');

        // Check that the uploaded file exists
        Storage::disk('public')->assertExists(DetailImage::first()->image);
    }
}
