<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Lang; 

class PasswordValidation implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character:
        return preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Lang::get('passwords.weak');
    }
}
