<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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

         $sum=0 ;

        return [


                'title'=>$this->resource->first()->name,
                'address'=>$this->resource->first()->address->address,

                'Food'=>
                [
                $this->merge($this->transform($this->resource->first()->food,function($value)use(&$sum)
                    {
                        $array=[];
                        foreach($value as $food){
                        $arrayNew=[
                            'food_name'=>  $food->name,
                            'food_price'=>((int) $food->finalPrice) *  $food->cart[0]->quantity,
                            'food_quantity'=>$food->cart[0]->quantity,
                            ];
                            $sum+=$arrayNew['food_price'] ;
                            $array[]=$arrayNew;
                        }
                        return $array;
                    }
                )),

            ],
            'total_price'=>$sum
            ]


        ;
    }
}
