<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function propertyListing()
    {
        return $this->belongsTo(PropertyListing::class);
    }
}
