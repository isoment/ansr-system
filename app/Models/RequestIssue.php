<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestIssue extends Model
{
    use HasFactory;

    /**
     *  ServiceRequest Relationship
     */
    public function serviceRequest()
    {
        return $this->hasOne(ServiceRequest::class, 'request_issue_id');
    }
}
