<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    /**
     *  ServiceRequest Relationship
     */
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    /**
     *  Tenant Relationship
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
