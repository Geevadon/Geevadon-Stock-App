<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;

class CantDeleteAdmin implements Rule
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
        if (auth ()->user ()->id == User::findOrFail ($value)->id) {
            return false;
        }else {
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
        return 'Cet utilisateur ne peut pas être supprimé.';
    }
}
