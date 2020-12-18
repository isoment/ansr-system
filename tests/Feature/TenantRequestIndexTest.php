<?php

namespace Tests\Feature;

use App\Http\Livewire\TenantRequestIndex;
use App\Models\RequestCategory;
use App\Models\ServiceRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TenantRequestIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     *  @test
     * 
     *  The livewire component should display.
     */
    public function tenant_request_index_page_shows_livewire_component()
    {
        $this->actingAs($this->createTestingTenant());

        $this->get(route('tenant.request-index'))->assertSeeLivewire('tenant-request-index');
    }

    /**
     *  @test
     * 
     *  The tenant should see only their requests
     */
    public function tenant_should_only_see_their_service_requests()
    {
        $tenantOne = $this->createTestingTenant();

        $tenantTwo = $this->createTestingTenant();

        $requestTennantOne = ServiceRequest::factory()->create([
            'tenant_id' => $tenantOne->userable->id,
            'category_id' => RequestCategory::factory()->create()->id,
            'issue' => 'x*&hj3jdiosf983',
            'completed_date' => NULL,
        ]);

        $requestTennantTwo = ServiceRequest::factory()->create([
            'tenant_id' => $tenantTwo->userable->id,
            'category_id' => RequestCategory::factory()->create()->id,
            'issue' => '6@E87djdjiaf%b',
            'completed_date' => NULL,
        ]);

        $this->actingAs($tenantOne);

        Livewire::test(TenantRequestIndex::class)
            ->assertSee($requestTennantOne->issue)
            ->assertDontSee($requestTennantTwo->issue);
    }

    /**
     *  @test
     * 
     *  The livewire component shows the tenants service requests
     */
    public function tenant_service_requests_are_shown()
    {
        $tenant = $this->createTestingTenant();

        $this->actingAs($tenant);

        $requestOne = ServiceRequest::factory()->create([
            'tenant_id' => $tenant->userable->id,
            'category_id' => RequestCategory::factory()->create()->id,
            'issue' => 'Pipes',
            'completed_date' => NULL,
        ]);

        $requestTwo = ServiceRequest::factory()->create([
            'tenant_id' => $tenant->userable->id,
            'category_id' => RequestCategory::factory()->create()->id,
            'issue' => 'Fridge',
        ]);

        Livewire::test(TenantRequestIndex::class)
            ->assertSee($requestOne->issue)
            ->assertDontSee($requestTwo->issue)
            ->set('open', false)
            ->assertSee($requestTwo->issue)
            ->assertDontSee($requestOne->issue);
    }

    /**
     *  @test
     * 
     *  The requests can be sorted in asc or desc when column is clicked
     */
    public function request_are_displayed_in_asc_or_desc_order_by_created_date()
    {
        $tenant = $this->createTestingTenant();

        $this->actingAs($tenant);

        $requestOne = ServiceRequest::factory()->create([
            'tenant_id' => $tenant->userable->id,
            'category_id' => RequestCategory::factory()->create()->id,
            'issue' => 'anterior-91',
            'completed_date' => NULL,
            'created_at' => '2020-12-10 21:19:32'
        ]);

        $requestTwo = ServiceRequest::factory()->create([
            'tenant_id' => $tenant->userable->id,
            'category_id' => RequestCategory::factory()->create()->id,
            'issue' => 'suspicious-772',
            'completed_date' => NULL,
            'created_at' => '2020-12-12 09:12:22'
        ]);

        $requestThree = ServiceRequest::factory()->create([
            'tenant_id' => $tenant->userable->id,
            'category_id' => RequestCategory::factory()->create()->id,
            'issue' => 'structure-125',
            'completed_date' => NULL,
            'created_at' => '2020-12-14 11:07:02'
        ]);

        Livewire::test(TenantRequestIndex::class)
            ->assertSeeInOrder([
                $requestThree->issue,
                $requestTwo->issue,
                $requestOne->issue
            ])
            ->call('sortDirection')
            ->assertSeeInOrder([
                $requestOne->issue,
                $requestTwo->issue,
                $requestThree->issue
            ]);
    }

}
