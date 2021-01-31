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
        // For maintenance employees if the employee isn't assigned the work order and
        // they are not part of the same region abort.
        if (! $workOrder->regionAndOwnerCheck() && Gate::allows('isMaintenance')) {
            abort(403);
        }

        // For administrative employee abort if the work order region and employee region
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
