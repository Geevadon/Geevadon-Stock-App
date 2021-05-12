<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class PasswordExistsRule implements Rule
{
    protected $userPassword;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->userPassword = $password;
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
        if (Hash::check($value, $this->userPassword)) {
            return true;
        }else {
            return false;
        }
        // $hashed_password = Hash::make ($value);
        // dd ($hashed_password);

        // return User::where ('password', $hashed_password)->get ()->count () > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mot de passe invalide.';
    }
}
