<?php

namespace App\Rules;

use App\Product;
use Illuminate\Contracts\Validation\Rule;

class StockSufficient implements Rule
{
    protected $product_id;
    protected $product_name;
    protected $product_quantity;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id, $name, $quantity)
    {
      $this->product_id = $id;
      $this->product_name = $name;
      $this->product_quantity = $quantity;
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
        return Product::where ('quantity', '>=', $value)
                    ->where ('id', $this->product_id)
                    ->get ()
                    ->count () > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Stock du produit "'.$this->product_name.'" insuffisant. (Stock actuel : '.$this->product_quantity. ')';
    }
}
