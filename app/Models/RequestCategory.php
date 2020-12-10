<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestCategory extends Model
{
    use HasFactory;

    /**
     *  ServiceRequest Relationship
     */
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    /**
     *  Scope a query for the 'New Key' category
     */
    public function scopeNewKeyCategory($query)
    {
        return $query->where('name', 'New Key');
    }
}
