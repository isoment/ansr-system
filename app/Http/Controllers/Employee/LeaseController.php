<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    /**
     * Show index of lease applications
     *
     * @return \Illuminate\Http\Response
     */
    public function leaseApplicationIndex()
    {
        return view('employee.lease-application-index');
    }
}
