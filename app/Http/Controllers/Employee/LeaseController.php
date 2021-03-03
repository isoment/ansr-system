<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Lease;
use App\Models\LeaseApplication;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    /**
     * Show index of lease applications
     * @return \Illuminate\Http\Response
     */
    public function leaseApplicationIndex()
    {
        return view('employee.lease-application-index');
    }

    /**
     * Show lease application
     * @return \Illuminate\Http\Response
     */
    public function leaseApplicationManange(LeaseApplication $leaseApplication)
    {
        return view('employee.lease-application-manage', [
            'leaseApplication' => $leaseApplication,
        ]);
    }

    /**
     * Show lease
     * @return \Illuminate\Http\Response
     */
    public function leaseManage()
    {
        return view('employee.lease-manage');
    }
}
