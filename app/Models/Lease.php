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

    /**
     *  Method to determine if a lease is expiring within a week
     *  @return boolean
     */
    public function endingInAWeek()
    {
        $now = Carbon::now()->toDateTimeString();
        
        $addAWeek = Carbon::now()->addDays(7)->toDateTimeString();

        return Carbon::parse($this->end_date)->between($now, $addAWeek);
    }

    /**
     *  Format date as a string for passing into HTML inputs
     */
    public function endDateStringFormat()
    {
        return Carbon::parse($this->end_date)->toDateString();
    }
}
