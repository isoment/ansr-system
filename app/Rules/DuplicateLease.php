<?php

namespace App\Rules;

use App\Models\Lease;
use Illuminate\Contracts\Validation\Rule;

class DuplicateLease implements Rule
{
    public $property;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($property)
    {
        $this->property = $property;
    }

    /**
     * Checking to make sure that the unit of the given property
     * is not currently being leased
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $lease = Lease::where('property_id', $this->property['id'])
            ->where('unit', $value)
            ->first();

        if (is_null($lease)) {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This unit is already leased';
    }
}
