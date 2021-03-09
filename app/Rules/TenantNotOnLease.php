<?php

namespace App\Rules;

use App\Models\Tenant;
use Illuminate\Contracts\Validation\Rule;

class TenantNotOnLease implements Rule
{
    public $lease;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($lease)
    {
        $this->lease = $lease;
    }

    /**
     * Make sure the selected tenant ($value) is not on the 
     * lease ($this->lease) we are passing in.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $tenant = Tenant::where('id', $value['id'])->first();
        
        if ($tenant->lease->id !== $this->lease['id']) {
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
        return 'Tenant is alread on this lease.';
    }
}
