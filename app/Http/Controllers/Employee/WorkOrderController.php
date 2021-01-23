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
        if (Gate::denies('workOrderAndUserHaveSameRegion', $workOrder) && Gate::denies('isManagement')) {
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

}
