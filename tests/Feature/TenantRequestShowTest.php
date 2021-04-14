<?php

namespace Tests\Feature;

use App\Models\RequestCategory;
use App\Models\ServiceRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Userable;

class TenantRequestShowTest extends TestCase
{
    use RefreshDatabase;
    use Userable;

    /**
     *  @test
     * 
     *  The tenant request show component should display for the tenant.
     */
    public function tenant_request_show_page_shows_livewire_component()
    {
        $tenant = $this->createTestingTenant();

        $serviceRequest = ServiceRequest::factory()->create([
            'tenant_id' => $tenant->userable->id,
            'category_id' => RequestCategory::factory()->create()->id,
            'issue' => 'randomString39r8uidojewqf',
            'completed_date' => NULL,
        ]);

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

        $tenantOneRequest = ServiceRequest::factory()->create([
            'tenant_id' => $tenantOne->userable->id,
            'category_id' => RequestCategory::factory()->create()->id,
            'issue' => 'T3nantOneR3que$t',
            'completed_date' => NULL,
        ]);

        $this->actingAs($tenantTwo);

        $this->get(route('tenant.request-show', $tenantOneRequest->id))
            ->assertForbidden();
    }
}
