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
    public function propertyListing()
    {
        return $this->belongsTo(PropertyListing::class);
    }

    /**
     *  Lease Relationship
     */
    public function lease()
    {
        return $this->belongsTo(Lease::class);
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
