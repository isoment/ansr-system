<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    /**
     *  Property Relationship
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
