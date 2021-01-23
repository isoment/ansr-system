<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\RequestCategory;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ServiceRequestController extends Controller
{
    /**
     * Display service request index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.service-request-index', [

            'totalRequests' => ServiceRequest::totalRequests(),
            'openRequests' => ServiceRequest::openRequests(),
            'closedRequests' => ServiceRequest::closedRequests(),
        ]);
    }

    /**
     *  Display request category page
     * 
     *  @return \Illuminate\Http\Response
     */
    public function requestCategory()
    {
        return view('employee.request-category');
    }

    /**
     *  Display request management
     * 
     *  @return \Illuminate\Http\Response
     */
    public function manageRequest(ServiceRequest $request)
    {
        if (Gate::denies('requestAndUserHaveSameRegion', $request) && Gate::denies('isManagement')) {
            abort(403);
        }

        return view('employee.service-request-manage', [
            'request' => $request,
        ]);
    }
}
