<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\WorkDetails;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkOrderController extends Controller
{
    /**
     *  Display the manage work order page
     * @return \Illuminate\Http\Response
     */
    public function manageWorkOrder(WorkOrder $workOrder)
    {
        // For maintenance employees: If the employee isn't assigned the work order and
        // they are not part of the same region, abort.
        if (! $workOrder->regionAndOwnerCheck() && Gate::allows('isMaintenance')) {
            abort(403);
        }

        // For administrative employee: Abort if the work order region and employee region
        // are not the same.
        if (Gate::allows('isAdministrative') && Gate::denies('workOrderAndUserHaveSameRegion', $workOrder)) {
            abort(403);
        }

        return view('employee.work-order-manage', [
            'workOrder' => $workOrder,
        ]);
    }

    /**
     *  Display the manage details page
     *  @return \Illuminate\Http\Response
     */
    public function manageDetails(WorkDetails $workDetail)
    {
        $parentWorkOrder = $workDetail->workOrder;

        // For maintenance employees: If the work detail doesn't belong to the employees assigned
        // work order and they are not part of the same region, abort.
        if (! $parentWorkOrder->regionAndOwnerCheck() && Gate::allows('isMaintenance')) {
            abort(403);
        }

        // For administrative employee: Abort if the work detail parent work order and 
        // region are not the same
        if (Gate::allows('isAdministrative') && Gate::denies('workDetailAndUserHaveSameRegion', $workDetail)) {
            abort(403);
        }

        return view('employee.work-details-manage', [
            'workDetail' => $workDetail,
        ]);
    }

    /**
     *  Assigned work order index
     *  @return \Illuminate\Http\Response
     */
    public function assignedWorkOrderIndex()
    {
        return view('employee.my-work-orders');
    }

}
