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
        //
    }

    /**
     * If the user is a manager we allow them to put a tenant on another
     * lease at any time, otherwise only if the lease will be ending soon.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (Gate::allows('isManagement')) {

            return true; 

        } else {

            $tenant = Tenant::where('id', $value['id'])->first();

            if ($tenant->lease->endingInAWeek()) {
                return true;
            } else {
                return false;
            }

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
