<?php

namespace App\Http\Resources;

use App\Models\Food;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'user_id'=>auth()->id(),
            'Cart'=>
                [
                    'food_id'=>$this->food_id,
                    "food_name"=>$this->food->name,
                    "restaurant_name"=>$this->food->restaurant->name,
                    'quantity'=>$this->quantity,
                ],

        ];
    }
}
