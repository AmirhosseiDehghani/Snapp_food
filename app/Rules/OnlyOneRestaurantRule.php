<?php

namespace App\Rules;

use App\Models\Food;
use Illuminate\Contracts\Validation\Rule;

class OnlyOneRestaurantRule implements Rule
{
    public $cart;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cart=auth()->user()->cart();
        $this->food=new Food();
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
        $cart=$this->cart->get();

        if(count($cart)==0 or count($cart)==1){
            return true;
        }
        if($this->cart->first()->food->restaurant->id==$this->food->find($value)->restaurant->id   )
        {
            return true;
        }

        $this->massage='You can not Chose  food from different restaurant  ';
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->massage;
    }
}
