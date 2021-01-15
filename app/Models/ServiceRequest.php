<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     *  RequestCategory Relationship
     */
    public function requestCategory()
    {
        return $this->belongsTo(RequestCategory::class, 'category_id');
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

    /**
     *  @return boolean A method to determine if associated work orders are complete
     */
    public function allWorkOrdersComplete()
    {
        return $this->workOrders->every(function($item, $key) {
            return $item['end_date'] !== NULL;
        });
    }

    /**
     *  @return String of current date time
     */
    private function getCurrentDateString()
    {
        return Carbon::now()->toDateTimeString();
    }

    /**
     *  @return String of the date time from a year ago
     */
    private function aYearAgoString()
    {
        return Carbon::now()->subYear()->toDateTimeString();
    }

    /**
     *  Scope a query for past years total service requests
     */
    public function scopeTotalRequests($query)
    {
        return $query->whereBetween('created_at', [$this->aYearAgoString(), $this->getCurrentDateString()])
            ->count();
    }

    /**
     *  Scope a query for total open requests
     */
    public function scopeOpenRequests($query)
    {
        return $query->where('completed_date', '=', null)->count();
    }

    /**
     *  Scope a query for closed requests from past year
     */
    public function scopeClosedRequests($query) 
    {
        return $query->whereBetween('created_at', [$this->aYearAgoString(), $this->getCurrentDateString()])
            ->where('completed_date', '!=', null)
            ->count();
    }
}
