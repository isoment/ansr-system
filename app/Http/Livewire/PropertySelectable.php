<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Gate;
use App\Models\Property;

trait PropertySelectable
{
    /**
     *  Set the property based on input and
     *  verify that the property exists
     *  @param array
     */
    public function setProperty($property)
    {
        // Check if parameter is array
        if (!is_array($property)) {
            return;
        }

        // Get an array of allowed property ids based on role
        if (Gate::allows('isManagement')) {

            $propertyIds = Property::pluck('id')->toArray();

        } else {

            $propertyIds = Property::whereHas('region', function($query) {
                $query->where('region_name', users_region());
            })->pluck('id')->toArray();

        }

        // Check to make sure the property that is passed in is valid
        // Then set it to the slectedProperty
        if (in_array($property['id'], $propertyIds)) {
            $this->selectedProperty = $property;
        }
    }
}