<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            
            'title'=>$this->title,
            'address'=>$this->address,
            'lat'=>$this->lat,
            'long'=>$this->long,
            // $this->mergeWhen($this->)
           
            
        ];
    }
}
