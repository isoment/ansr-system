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
            'tenantDetails' => auth()->user()->tenantDetails(),
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

            $validated = $request->validate([
                'quantity' => 'required|numeric|min:1|max:5',
                'notes' => 'min:5',
            ]);

            // Get category
            $category = RequestCategory::newKey()->first();

            // Key cost, hardcoded for now
            $keyCost = 20.00;

            ServiceRequest::create([
                'tenant_id' => auth()->user()->userable->id,
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
        return view('tenant.service-request', [
            'requestCategories' => RequestCategory::namesExceptNewKey(),
            'tenantDetails' => auth()->user()->tenantDetails(),
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

            // Get a specific category
            $categoryId = RequestCategory::specifiedCategory($validated['category'])->id;

            ServiceRequest::create([
                'tenant_id' => auth()->user()->userable->id,
                'category_id' => $categoryId,
                'issue' => $validated['issue'],
                'description' => $validated['description'],
            ]);

            return redirect(route('tenant.dashboard'))->with('success', 'Your service request was sent!');

        }
    }

    /**
     *  Index of tenants service requests
     * 
     *  @return \Illuminate\Http\Response
     */
    public function index() 
    {
        return view('tenant.request-index');
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

}
