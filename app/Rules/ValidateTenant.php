<?php

namespace App\Rules;

use App\Models\Tenant;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ValidateTenant implements Rule
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
     * Verify that the email and lease id are valid entries
     * in the tenants table.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Find tenant
        $tenant = DB::table('tenants')
            ->where('email', $_REQUEST['email'])
            ->where('lease_id', $_REQUEST['id'])
            ->first();

        if (isset($tenant)) {
            return true;
        };
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Lease ID AND E-mail must match our records.';
    }
}
