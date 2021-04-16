<?php

namespace Tests;

use App\Models\Employee;
use App\Models\WorkDetails;
use App\Models\WorkOrder;

trait WorkOrderable
{
    /**
     *  Create a work order from a service request
     * 
     *  @param integer $requestId
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

    /**
     *  Create multiple work orders
     * 
     *  @param integer $requestId
     *  @param integer $count
     *  @return object
     */
    public function createWorkOrdersFromServiceRequest(int $requestId, int $count)
    {
        return WorkOrder::factory()->count($count)->create([
            'service_request_id' => $requestId,
            'employee_id' => Employee::factory()->create()->id,
        ]);
    }

    /**
     *  Create a work detail from a work order
     * 
     *  @param integer $workOrderId
     *  @return object
     */
    public function createWorkDetailFromWorkOrder(int $workOrderId)
    {
        return WorkDetails::factory()->create([
            'work_order_id' => $workOrderId,
        ]);
    }

    /**
     *  Create multiple work details
     * 
     *  @param integer $workOrderId
     *  @param integer $count
     *  @return object
     */
    public function createWorkDetailsFromWorkOrder(int $workOrderId, int $count)
    {
        return WorkDetails::factory()->count($count)->create([
            'work_order_id' => $workOrderId,
        ]);
    }
}