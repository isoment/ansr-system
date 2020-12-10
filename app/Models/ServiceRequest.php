<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'issue',
    //     'description',
    //     'tenant_charges',
    //     'assigned_date',
    //     'completed_date',
    // ];

    protected $guarded = ['id'];

    /**
     *  RequestCategory Relationship
     */
    public function requestCategory()
    {
        return $this->belongsTo(RequestCategory::class);
    }

    /**
     *  Survey Relationship
     */
    public function survey()
    {
        return $this->hasOne(Survey::class, 'service_request_id');
    }

    /**
     *  RequestIssue Relationship
     */
    public function requestIssue()
    {
        return $this->belongsTo(RequestIssue::class);
    }

    /**
     *  WorkOrder Relationship
     */
    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class, 'service_request_id');
    }

    /**
     *  Tenant Relationship
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
