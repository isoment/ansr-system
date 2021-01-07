<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageWorkOrder(WorkOrder $workOrder)
    {
        return view('employee.work-order-manage', [
            'workOrder' => $workOrder,
        ]);
    }
}
