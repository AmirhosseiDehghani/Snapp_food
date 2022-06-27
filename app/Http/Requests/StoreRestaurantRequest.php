<?php

namespace App\Http\Requests;

use App\Rules\IranPhoneNumberRule;
use App\Rules\OpenTimeMustLessCloseTimeAndActiveDay;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class StoreRestaurantRequest extends FormRequest
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
        // $Week=
        // [
        //     'Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday',
        // ];
        // $valDay=[];
        // foreach($Week as $day)
        // {
        //     $a=[
        //         $day.'_S'=>[(new OpenTimeMustLessCloseTimeAndActiveDay(request()->all()[$day.'_E'],request()->all()[($day.'_isActive')]?? true))  ],
        //         $day.'_E'=>[(new OpenTimeMustLessCloseTimeAndActiveDay(request()->all()[$day.'_S'],request()->all()[($day.'_isActive')]?? true))  ],
        //     ];
        //     $b=[];
        //     if(array_key_exists($day.'_isActive',request()->all() )){
                
        //         $b=[$day.'_isActive'=>'nullable'];
        //     }
        //     $valDay=array_merge($valDay,$a,$b);
        // }
        // // dd(request()->all());
        // $valDay=array_merge($valDay,[
        //     'name'=>'required|string',
        //     'phone'=>['required',(new IranPhoneNumberRule)],
        //     'address'=>'required|string',
        //     'category'=>'required|string',
            
        // ]);
        // return$valDay;

        return [
            'name'=>'required|string',
            'phone'=>['required',(new IranPhoneNumberRule)],
            'address'=>'required|string',
            'category'=>'required|string',
            'image'=>'image|required|mimes:jpg,png|max:5054',
            "account"=>'numeric|digits:16',
            "lat"=>'numeric',
            "long"=>'numeric',
        ];
    }
}
