<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
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

    /**
     *  Display a tenant index
     *
     * @return \Illuminate\Http\Response
     */
    public function tenantEdit(Tenant $tenant)
    {
        return view('employee.tenant-edit', [
            'tenant' => $tenant,
        ]);
    }

    /**
     *  Display a employee index
     * 
     *  @return \Illuminate\Http\Response
     */
    public function employeeIndex()
    {
        return view('employee.employee-index');
    }
}
