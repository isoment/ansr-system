<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    /**
     *  Display a tenant index
     *
     * @return \Illuminate\Http\Response
     */
    public function tenantIndex()
    {
        return view('employee.tenant-index');
    }
}
