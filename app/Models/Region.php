<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     *  Employee Relationship
     */
    public function employees()
    {
        return $this->hasMany(Employee::class, 'region_id');
    }

    /**
     *  Property Relationship
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
