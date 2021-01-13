<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     *  WorkDetails Relationship
     */
    public function workDetails()
    {
        $this->belongsTo(WorkDetails::class, 'work_detail_id');
    }
}
