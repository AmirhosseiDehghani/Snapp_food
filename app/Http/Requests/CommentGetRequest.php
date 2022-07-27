<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CommentGetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'food_id' => [Rule::requiredIf(request('restaurant_id')==null),'nullable' ,'integer' ],
            'restaurant_id' => [Rule::requiredIf(request('food_id')==null),'nullable','integer' ],
        ];
    }
}
