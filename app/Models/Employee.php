<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     *  One to one polymorphic to User
     */
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    /**
     *  Property Relationship
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     *  WorkOrder Relationship
     */
    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class, 'employee_id');
    }
}