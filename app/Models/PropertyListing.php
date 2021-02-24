<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyListing extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     *  ListingImage Relationship
     */
    public function listingImages()
    {
        return $this->hasMany(ListingImage::class);
    }

    /**
     *  Property Relationship
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     *  LeaseApplication Relationship
     */
    public function leaseApplications()
    {
        return $this->hasMany(LeaseApplication::class);
    }

    /**
     *  Method to determine singular or plural for the bedroom
     *  and bathroom count
     */
    public function isPlural($field)
    {
        if ($field > 1) {
            return true;
        }
        return false;
    }

    /**
     *  Method to get an image associated with listing
     */
    public function getAnImage()
    {
        return $this->listingImages->first()->image;
    }
}
