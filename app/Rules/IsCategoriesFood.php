<?php

namespace App\Rules;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class IsCategoriesFood implements Rule
{
    private array $category;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct( )
    {
        $this->category=Category::whereFood()->pluck('id')->toArray();
        // dd($this->category->toArray());
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
        dd($attribute, $value,$this->category, in_array($value,$this->category));
        return in_array($value,$this->category);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
