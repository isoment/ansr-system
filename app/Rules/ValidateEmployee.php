<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ValidateEmployee implements Rule
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
     * Verify that the email and employee id the user enters
     * match an entry from the employees table.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Find Employee
        $employee = DB::table('employees')
            ->where('email', $_REQUEST['email'])
            ->where('employee_id_number', $_REQUEST['id'])
            ->first();

        if (isset($employee)) {
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
        return 'The Employee ID AND E-mail must match our records.';
    }
}
