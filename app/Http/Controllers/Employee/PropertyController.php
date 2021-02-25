<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PropertyController extends Controller
{
    /**
     * Display property index.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.property-index');
    }

    /**
     * Create a new property.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.property-create');
    }

    /**
     * Display a property edit form.
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property) 
    {
        if (Gate::denies('propertyAndUserHaveSameRegion', $property) && Gate::denies('isManagement')) {
            abort(403);
        }

        return view('employee.property-edit', [
            'property' => $property,
        ]);
    }

    /**
     * Display region page
     * @return \Illuminate\Http\Response
     */
    public function region()
    {
        return view('employee.region');
    }

    /**
     *  Display property listing create page
     *  @return \Illuminate\Http\Response
     */
    public function createPropertyListing()
    {
        return view('employee.property-listing-create');
    }

    /**
     *  Display property listing index page
     *  @return \Illuminate\Http\Response
     */
    public function propertyListingIndex()
    {
        return view('employee.property-listing-index');
    }
}
