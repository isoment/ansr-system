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
     *
     * @return \Illuminate\Http\Response
     */
    public function manageWorkOrder(WorkOrder $workOrder)
    {
        // We want to abort if the employee is not a manager, we also want to abort if
        // the region of the work order is different than the employees OR the employee is not
        // assigned to the work order. If a manager changes the employees region we still want
        // them to have access to previous work orders.
        if (! $workOrder->regionAndOwnerCheck() && Gate::denies('isManagement')) {
            abort(403);
        }

        return view('employee.work-order-manage', [
            'workOrder' => $workOrder,
        ]);
    }

    /**
     *  Display the manage details page
     * 
     *  @return \Illuminate\Http\Response
     */
    public function manageDetails(WorkDetails $workDetail)
    {
        if (Gate::denies('workDetailAndUserHaveSameRegion', $workDetail) && Gate::denies('isManagement')) {
            abort(403);
        }

        return view('employee.work-details-manage', [
            'workDetail' => $workDetail,
        ]);
    }

    /**
     *  Assigned work order index
     */
    public function assignedWorkOrderIndex()
    {
        return view('employee.my-work-orders');
    }

}
