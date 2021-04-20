<?php

namespace Tests;

use App\Models\Employee;
use App\Models\WorkDetails;
use App\Models\WorkOrder;
use Faker\Factory;

trait WorkOrderable
{
    /**
     *  Create blank service request
     * 
     *  @param integer
     *  @return object
     */
    public function createBlankWorkOrder(int $requestId)
    {
        return WorkOrder::create([
            'service_request_id' => $requestId,
        ]);
    }

    /**
     *  Create a work order from a service request
     * 
     *  @param integer $requestId
     *  @return object
     */
    public function createWorkOrderFromServiceRequest(int $requestId)
    {
        return WorkOrder::create([
            'service_request_id' => $requestId,
            'employee_id' => Employee::factory()->create()->id,
            'title' => '98321ruqjfeq9e8h9djwqi09832ju8fjewfe',
            'start_date' => now(),
            'end_date' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     *  Create a complete work order from a service request
     * 
     *  @param integer $requestId
     *  @return object
     */
    public function createCompletedWorkOrderFromServiceRequest(int $requestId)
    {
        return WorkOrder::create([
            'service_request_id' => $requestId,
            'employee_id' => Employee::factory()->create()->id,
            'title' => 'd93d09euqf89qu3fqko9kied310r9u3if9rw',
            'start_date' => now(),
            'end_date' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     *  Create a work order from service request and employee
     * 
     *  @param integer $requestId
     *  @param integer $employeeId
     *  @return object
     */
    public function createWorkOrderSpecifyRequestAndEmployee(int $requestId, int $employeeId)
    {
        return WorkOrder::create([
            'service_request_id' => $requestId,
            'employee_id' => $employeeId,
            'title' => uniqid('title_', true)
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