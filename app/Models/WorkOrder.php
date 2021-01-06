<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        if ($this->workDetails()->first()) {
            return true;
        } else {
            return false;
        }
    }
}
