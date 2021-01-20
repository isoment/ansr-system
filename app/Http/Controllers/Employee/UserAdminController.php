<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Employee;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    /**
     *  Display tenant index
     *
     * @return \Illuminate\Http\Response
     */
    public function tenantIndex()
    {
        return view('employee.tenant-index');
    }

    /**
     *  Display tenant edit
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
     *  Display employee index
     * 
     *  @return \Illuminate\Http\Response
     */
    public function employeeIndex()
    {
        return view('employee.employee-index');
    }

    /**
     *  Display create employee
     * 
     *  @return \Illuminate\Http\Response
     */
    public function employeeCreate()
    {
        return view('employee.employee-create');
    }

    /**
     *  Display edit employee
     * 
     *  @return \Illuminate\Http\Response
     */
    public function employeeEdit(Employee $employee)
    {
        return view('employee.employee-edit', [
            'employee' => $employee,
        ]);
    }
}
