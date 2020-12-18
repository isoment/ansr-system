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
    public function scopeNewKey($query)
    {
        return $query->where('name', 'New Key')->first();
    }

    /**
     *  Scope a query for all except 'New Key' category and return collection of names
     */
    public function scopeNamesExceptNewKey($query)
    {
        return $query->whereNotIn('name', ['New Key'])->pluck('name');
    }

    /**
     *  Scope a query for a specified category
     */
    public function scopeSpecifiedCategory($query, $category)
    {
        return $query->where('name', $category)->first();
    }
}
