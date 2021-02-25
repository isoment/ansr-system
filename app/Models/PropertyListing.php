<?php

namespace App\Models;

use Carbon\Carbon;
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
     *  @return boolean
     */
    public function isPlural($field)
    {
        return $field > 1 ? true : false;
    }

    /**
     *  Method to get an image associated with listing
     *  @return string
     */
    public function getAnImage()
    {
        return $this->listingImages->first()->image;
    }

    /**
     *  Method to determine if listing was
     *  created within last 24 hours. Carbon instance
     *  is returned when using $this->created_at
     *  @return boolean
     */
    public function listingIsNew()
    {
        return $this->created_at->gt(Carbon::now()->subDays(1)) ? true : false;
    }
}
