<?php

namespace App\Rules;

use App\Models\Tenant;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class LeaseExpiresWithinAWeek implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        $tenant = Tenant::where('id', $value['id'])->first();

        if ($tenant->lease->endingInAWeek()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tenants previous lease must be ending within a week.';
    }
}
