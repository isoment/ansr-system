<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Lease;
use App\Models\LeaseApplication;
use Illuminate\Support\Facades\Gate;

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
     * Manage lease
     * @return \Illuminate\Http\Response
     */
    public function leaseManage()
    {
        return view('employee.lease-manage');
    }

    /**
     *  Show lease
     *  @return \Illuminate\Http\Response
     */
    public function leaseShow(Lease $lease)
    {
        if (Gate::denies('propertyAndUserHaveSameRegion', $lease->property)
                && Gate::denies('isManagement')) {
            abort(403);
        }

        return view('employee.lease-show', [
            'lease' => $lease,
        ]);
    }
}
