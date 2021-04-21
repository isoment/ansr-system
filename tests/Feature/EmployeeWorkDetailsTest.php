<?php

namespace Tests\Feature;

use App\Http\Livewire\EmployeeWorkDetailManage;
use App\Models\DetailImage;
use App\Models\WorkDetails;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Prophecy\Call\Call;
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
        $file = UploadedFile::fake()->image('iuJ8radjdjdkaoIDjw310930r0.jpg');

        Livewire::test(EmployeeWorkDetailManage::class, ['workDetail' => $workDetail])
            ->set('images', $file)
            ->call('storeImage')
            ->assertSeeHtml('iuJ8radjdjdkaoIDjw310930r0');

        // Check that the uploaded file exists
        Storage::disk('public')->assertExists(DetailImage::first()->image);
    }

    /**
     *  @test
     * 
     *  An uploaded file can be deleted
     */
    public function an_uploaded_file_can_be_deleted()
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
        $file = UploadedFile::fake()->image('iuJ8radjdjdkaoIDjw310930r0.jpg');

        Livewire::test(EmployeeWorkDetailManage::class, ['workDetail' => $workDetail])
            ->set('images', $file)
            ->call('storeImage')
            ->assertSeeHtml('iuJ8radjdjdkaoIDjw310930r0')
            ->call('deleteImage', DetailImage::first()->id)
            ->assertDontSeeHtml('iuJ8radjdjdkaoIDjw310930r0');

        $this->assertEmpty(DetailImage::first());
    }

    /**
     *  @test
     * 
     *  Work details can be edited
     */
    public function work_details_can_be_edited()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $request = $this->createServiceRequest($tenant->id);

        $workOrder = $this->createWorkOrderFromServiceRequest($request->id);

        $workDetail = $this->createWorkDetailFromWorkOrder($workOrder->id);

        $this->actingAs($manager);

        Livewire::test(EmployeeWorkDetailManage::class, ['workDetail' => $workDetail])
            ->assertSet('details', $workDetail->details)
            ->assertSet('tenantNotes', $workDetail->tenant_notes)
            ->set('details', 'testDetail132839djdidoasdDUd3')
            ->set('tenantNotes', 'kdo2r90j9feqjeqfijq3ur90qUSDew98')
            ->set('startdate', '2021-07-07')
            ->call('editWorkDetail')
            ->assertSee('Work detail updated');

        $updatedDetail = WorkDetails::find($workDetail->id);

        $this->assertEquals($updatedDetail->details, 'testDetail132839djdidoasdDUd3');
        $this->assertEquals($updatedDetail->tenant_notes, 'kdo2r90j9feqjeqfijq3ur90qUSDew98');
        $this->assertEquals($updatedDetail->start_date, '2021-07-07');
    }

    /**
     *  @test
     * 
     *  A work detail can be closed only if it has been started
     */
    public function a_work_detail_can_be_closed_only_if_it_has_been_started()
    {
        $tenant = $this->createTestingTenant();

        $manager = $this->createEmployee('Management');

        $request = $this->createServiceRequest($tenant->id);

        $workOrder = $this->createWorkOrderFromServiceRequest($request->id);

        $workDetail = $this->createUnstartedWorkDetail($workOrder->id);

        $this->actingAs($manager);

        Livewire::test(EmployeeWorkDetailManage::class, ['workDetail' => $workDetail])
            ->call('toggleEndDate')
            ->assertSee('Please set a start date before completing')
            ->set('startdate', '2021-07-07')
            ->call('editWorkDetail')
            ->call('toggleEndDate')
            ->assertSee('Jul 7, 2021');

        $updatedDetail = WorkDetails::find($workDetail->id);

        $this->assertNotEmpty($updatedDetail->end_date);
    }
}
