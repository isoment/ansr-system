<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestFeatureController extends Controller
{
    /**
     *  Show the lease application form
     *
     * @return \Illuminate\Http\Response
     */
    public function leaseApplication()
    {
        return view('guest.lease-application');
    }
}