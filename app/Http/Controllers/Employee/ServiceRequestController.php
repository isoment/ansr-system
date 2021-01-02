<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    /**
     * Display service request index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.service-request-index');
    }
}
