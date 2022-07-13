<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CartInfoResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $sum=0;
        return [
            'title'=> $this->name,
            'address'=> $this->address->address,
            "cart"=>$this->id,
            'food'=>$this->transform($this->food,function($value)use(&$sum) {
                // return $value;
                $sum=0;
                $array=[];
                foreach($value as $food){
                $arrayNew=[
                    'food_name'=>  $food->name,
                    'food_price'=>$food->price,
                    'price'=>((int) $food->finalPrice) *  $food->cart[0]->quantity,
                    'food_quantity'=>$food->cart[0]->quantity,
                    ];
                    $sum+=$arrayNew['food_price'] ;
                    $array[]=$arrayNew;
                }
                return $array;
            }),
            'total_price'=>$sum

        ];

    }
}
