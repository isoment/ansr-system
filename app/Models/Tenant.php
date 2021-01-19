<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     *  One to one polymorphic to User
     */
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    /**
     *  Lease Relationship
     */
    public function lease()
    {
        return $this->belongsTo(Lease::class);
    }

    /**
     *  Survey Relationship
     */
    public function surveys()
    {
        return $this->hasMany(Survey::class, 'tenant_id');
    }

    /**
     *  ServiceRequest Relationship
     */
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'tenant_id');
    }
}
