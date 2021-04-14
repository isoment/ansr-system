<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Gate;

class ServiceRequestController extends Controller
{
    /**
     * Display service request index
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
     *  @return \Illuminate\Http\Response
     */
    public function requestCategory()
    {
        return view('employee.request-category');
    }

    /**
     *  Display request management
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

    /**
     *  Display request history
     *  @return \Illuminate\Http\Response
     */
    public function requestHistory()
    {
        return view('employee.service-request-history');
    }
}
