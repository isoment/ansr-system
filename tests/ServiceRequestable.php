<?php

namespace Tests;

use App\Models\RequestCategory;
use App\Models\ServiceRequest;

trait ServiceRequestable
{
    /**
     *  Create a service request for a user.
     * 
     *  @param integer
     *  @return object
     */
    public function createServiceRequest($tenantId)
    {
        return ServiceRequest::factory()->create([
            'tenant_id' => $tenantId,
            'category_id' => RequestCategory::factory()->create()->id,
            'issue' => 'T3nantOneR3que$t',
            'completed_date' => NULL,
        ]);
    }
}