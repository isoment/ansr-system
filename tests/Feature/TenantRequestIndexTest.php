<?php

namespace Tests\Feature;

use App\Models\Lease;
use App\Models\Property;
use App\Models\Region;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantRequestIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     *  @test
     * 
     *  Make sure the livewire component is displayed.
     */
    public function tenant_request_index_page_shows_livewire_component()
    {
        $this->actingAs($this->createTestingTenant());

        $this->get(route('tenant.request-index'))->assertSeeLivewire('tenant-request-index');
    }

    /**
     *  Create a tenant for testing
     */
    public function createTestingTenant()
    {
        $region = Region::factory()->create([
            'region_name' => 'Test Region',
            'slug' => 'TST',
        ]);

        $property = Property::factory()->create([
            'region_id' => $region->id
        ]);

        $lease = Lease::factory()->create([
            'property_id' => $property->id
        ]);

        $tenant = Tenant::factory()->create([
            'lease_id' => $lease->id
        ]);

        return User::factory()->create([
            'userable_type' => 'App\Models\Tenant',
            'userable_id' => $tenant->id
        ]);
    }
}
