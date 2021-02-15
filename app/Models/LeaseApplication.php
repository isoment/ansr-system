<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaseApplication extends Model
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
     *  Application is Reopenable
     */
    public function reopenable()
    {
        return $this->status === 'approved' || $this->status === 'denied';
    }

    /**
     *  Application is open
     */
    public function isOpen()
    {
        return $this->status === 'open';
    }

}
