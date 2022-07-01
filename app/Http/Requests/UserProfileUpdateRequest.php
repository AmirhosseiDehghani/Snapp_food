<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Rules\IranPhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UserProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

    
        return true;
        // dd(Gate::allows('Seller'));
        // return  (Gate::allows('Seller'));

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>['required', new IranPhoneNumberRule ],
        ];
    }
}
