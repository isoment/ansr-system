<?php

namespace App\Rules;

use App\Models\Property;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class PropertyInUsersRegion implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (Gate::allows('isManagement')) {

            return Property::pluck('name')->contains($value);

        } else {

            return Property::whereHas('region', function($query) {
                $query->where('region_name', users_region());
            })->pluck('name')->contains($value);

        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid property selected.';
    }
}
