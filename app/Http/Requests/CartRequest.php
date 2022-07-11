<?php

namespace App\Http\Requests;

use App\Rules\OnlyOneRestaurantRule;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'food_id'=>['required','bail','exists:food,id',new OnlyOneRestaurantRule()],
            'quantity'=>'required|numeric',
        ];
    }
}
