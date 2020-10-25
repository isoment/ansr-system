<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDetails extends Model
{
    use HasFactory;

    /**
     *  WorkOrder Relationship
     */
    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }
}
