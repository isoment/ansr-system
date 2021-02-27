<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     *  Property Relationship
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     *  Lease Relationship
     */
    public function leases()
    {
        return $this->hasMany(Lease::class);
    }

    /**
     *  PropertyListing Relationship
     */
    public function propertyListings()
    {
        return $this->hasMany(PropertyListing::class);
    }
}
