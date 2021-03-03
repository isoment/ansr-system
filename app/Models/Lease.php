<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     *  Property Relationship
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     *  Tenant Relationship
     */
    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    /**
     *  LeaseApplication Relationship
     */
    public function leaseApplications()
    {
        return $this->hasMany(LeaseApplication::class);
    }

    /**
     *  ServiceRequest Relationship
     */
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'lease_id');
    }

    /**
     *  Method to determine if a lease is active
     *  @return boolean
     */
    public function leaseIsActive()
    {
        return Carbon::parse($this->end_date)->gt(Carbon::now()) ? true : false;
    }
}
