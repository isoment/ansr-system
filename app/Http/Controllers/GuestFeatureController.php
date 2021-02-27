<?php

namespace App\Http\Controllers;

use App\Models\PropertyListing;

class GuestFeatureController extends Controller
{
    /**
     *  Show the lease application form
     *
     * @return \Illuminate\Http\Response
     */
    public function leaseApplication(PropertyListing $propertyListing)
    {
        if (! $propertyListing->available) {
            abort(403);
        }

        return view('guest.lease-application', [
            'propertyListing' => $propertyListing,
        ]);
    }

    /**
     *  Show the lease application confirmation
     */
    public function leaseApplicationConfirmation()
    {
        return view('guest.lease-application-confirmation');
    }

    /**
     *  Display a listing of available properties
     */
    public function propertyListingsIndex()
    {
        return view('guest.property-listings-index');
    }

    /**
     *  Show the property listing
     */
    public function propertyListingShow(PropertyListing $propertyListing)
    {
        if (! $propertyListing->available) {
            abort(403);
        }

        return view('guest.property-listing-show', [

            'propertyListing' => $propertyListing,

            'relatedRentals' => $propertyListing->relatedRentals(),

        ]);
    }
}
