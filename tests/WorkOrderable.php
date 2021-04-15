<?php

namespace Tests;

use App\Models\Employee;
use App\Models\WorkOrder;

trait WorkOrderable
{
    /**
     *  Create a work order from on a service request
     * 
     *  @param integer
     *  @return object
     */
    public function createWorkOrderFromServiceRequest(int $requestId)
    {
        return WorkOrder::factory()->create([
            'service_request_id' => $requestId,
            'employee_id' => Employee::factory()->create()->id,
            'title' => 'aTestWorkOrder361723'
        ]);
    }
}