<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\WorkDetails;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    /**
     *  Display the manage work order page
     *
     * @return \Illuminate\Http\Response
     */
    public function manageWorkOrder(WorkOrder $workOrder)
    {
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
        return view('employee.work-details-manage', [
            'workDetail' => $workDetail,
        ]);
    }

}
