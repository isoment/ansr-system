<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     *  WorkOrder Relationship
     */
    public function workOrder()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    /**
     *  DetailImage Relationship
     */
    public function detailImages()
    {
        return $this->hasMany(DetailImage::class, 'work_detail_id');
    }
}
