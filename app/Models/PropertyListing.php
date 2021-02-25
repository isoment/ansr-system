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
        if ($field > 1) {
            return true;
        }
        return false;
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
     *  Method to determine if listing is new,
     *  created within last 24 hours.
     *  @return boolean
     */
    public function listingIsNew()
    {
        $compareDate = Carbon::now()->subDays(1);

        if ($this->created_at->gt($compareDate)) {
            return true;
        } else {
            return false;
        }
    }
}
