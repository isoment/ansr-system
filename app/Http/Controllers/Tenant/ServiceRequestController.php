<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\RequestCategory;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ServiceRequestController extends Controller
{
    /**
     *  Show the key request form
     *
     * @return \Illuminate\Http\Response
     */
    public function keyReplacement()
    {
        return view('tenant.replace-key', [
            'lease' => auth()->user()->tenantLease(),
            'property' => auth()->user()->tenantProperty(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function keyReplacementStore(Request $request)
    {
        if (Gate::allows('isTenant')) {

            // Get category
            $category = RequestCategory::newKeyCategory()->first();

            // Key cost, hardcoded for now
            $keyCost = 20.00;

            $validated = $request->validate([
                'quantity' => 'numeric|min:1|max:5',
                'notes' => 'min:5',
            ]);

            ServiceRequest::create([
                'tenant_id' => auth()->user()->id,
                'category_id' => $category->id,
                'issue' => 'Tenant requests new key.',
                'description' => 'Tenant Notes: ' . $validated['notes'],
                'tenant_charges' => $validated['quantity'] * $keyCost,
            ]);

            return redirect(route('tenant.dashboard'))->with('success', 'Your new key request was sent!');

        }
    }

    /**
     *  Show the service request form
     * 
     *  @return \Illuminate\Http\Response
     */
    public function createServiceRequest() 
    {
        $requestCategories = RequestCategory::all()->pluck('name');

        return view('tenant.service-request', [
            'requestCategories' => $requestCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function serviceRequestStore(Request $request)
    {
        if (Gate::allows('isTenant')) {

            $validated = $request->validate([
                'category' => 'required',
                'issue' => 'required|min:5',
                'description' => 'required|min:10',
            ]);

        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceRequest $serviceRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceRequest  $serviceRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        //
    }

}
