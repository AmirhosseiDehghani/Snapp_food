<?php

namespace App\Http\Requests;

use App\Rules\IsCategoriesFood;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodRequest extends FormRequest
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
            "name" => "required",
            "price" => "required|numeric",
            "make_of" => "nullable|string",
            "category" => ['required', new IsCategoriesFood()],
        ];
    }
}
