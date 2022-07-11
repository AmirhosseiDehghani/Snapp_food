<?php

namespace App\Http\Resources;

use App\Models\Food;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CartInfoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        // return parent::toArray($request);
        return [

            (array) $this
        ];
        return [
            "Restaurant"=>
                [
                    // 'id'=>$this->data
                //   'name'=>$this->food->Restaurant,
                //   'image'=> $restaurant->images()->first()->image_path,
                ],

        ];

    }
}
