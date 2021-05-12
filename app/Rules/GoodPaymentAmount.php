<?php

namespace App\Rules;

use App\Order;
use Illuminate\Contracts\Validation\Rule;

class GoodPaymentAmount implements Rule
{
    protected $due;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($due)
    {
        $this->due = $due;
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
        return $this->due >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le montant payé ne doit pas être supérieur à la dette.';
    }
}
