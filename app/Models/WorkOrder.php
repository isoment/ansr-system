<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class WorkOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     *  ServiceRequest Relationship
     */
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    /**
     *  WorkDetails Relationship
     */
    public function workDetails()
    {
        return $this->hasMany(WorkDetails::class, 'work_order_id');
    }

    /**
     *  Employee Relationship
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     *  Method to check if there are work details created yet
     */
    public function hasWorkDetails()
    {
        if ($this->workDetails->first()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *  Get employees in the same region as the work order
     */
    public function employeesInRegion()
    {
        return $this->serviceRequest->tenant->lease->property->region->employees;
    }

    /**
     *  Get employee_id_numbers from the same region as the work order
     */
    public function getEmployeeIdsInRegion()
    {
        return $this->employeesInRegion()->pluck('employee_id_number');
    }

    /**
     *  Method to check if all associated work details are completed
     */
    public function allDetailsCompleted()
    {
        return $this->workDetails->every(function($item, $key) {
            return $item['end_date'] !== NULL;
        });
    }

    /**
     *  Work order and user have same region OR work order is owned by current user
     */
    public function regionAndOwnerCheck()
    {
        if (Gate::allows('workOrderAndUserHaveSameRegion', $this) || 
                $this->employee_id === auth()->user()->userable->id) {
            return true;
        } else {
            return false;
        }
    }
}
