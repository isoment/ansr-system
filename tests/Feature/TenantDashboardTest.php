<?php

namespace Tests\Feature;

use App\Models\ServiceRequest;
use App\Models\RequestCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantDashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     *  @test
     *  Only registered tenants should be able to view dashboard
     */
    public function guests_cannot_view_tenant_dashboard_pages()
    {
        $this->get(route('tenant.dashboard'))->assertRedirect('login');

        $this->get(route('replace.key'))->assertStatus(403);

        $this->get(route('tenant.service-request'))->assertStatus(403);

        $this->get(route('tenant.request-index'))->assertStatus(403);
    }
}
