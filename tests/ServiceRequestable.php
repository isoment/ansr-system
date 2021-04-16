<?php

namespace Tests;

use App\Models\RequestCategory;
use App\Models\ServiceRequest;

trait ServiceRequestable
{
    /**
     *  Create a service request for a user.
     * 
     *  @param integer $tenantId
     *  @return object
     */
    public function createServiceRequest(int $tenantId)
    {
        return ServiceRequest::factory()->create([
            'tenant_id' => $tenantId,
            'category_id' => RequestCategory::factory()->create()->id,
            'completed_date' => NULL,
        ]);
    }

    /**
     *  Create closed service request
     * 
     *  @param integer $tenantId
     *  @return object
     */
    public function createClosedServiceRequest(int $tenantId)
    {
        return ServiceRequest::factory()->create([
            'tenant_id' => $tenantId,
            'category_id' => RequestCategory::factory()->create()->id,
        ]);
    }

    /**
     *  Create multiple service requests
     * 
     *  @param integer $tenantId
     *  @param integer $count
     *  @return object
     */
    public function createMultipleServiceRequests(int $tenantId, int $count)
    {
        return ServiceRequest::factory()->count($count)->create([
            'tenant_id' => $tenantId,
            'category_id' => RequestCategory::factory()->create()->id,
            'completed_date' => NULL,
        ]);
    }

}