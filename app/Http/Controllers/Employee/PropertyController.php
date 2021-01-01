<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.property-index');
    }

    /**
     * Create a new property.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.property-create');
    }

    /**
     * Display a property edit form.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property) 
    {
        return view('employee.property-edit', [
            'property' => $property,
        ]);
    }

    /**
     * Display region page
     *
     * @return \Illuminate\Http\Response
     */
    public function region()
    {
        return view('employee.region');
    }
}
