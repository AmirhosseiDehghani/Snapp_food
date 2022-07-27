<?php

namespace App\Classes\Helper;

use App\Models\Restaurant;

class RestaurantScore{
    protected Restaurant $Restaurant;
    public function Score(int $score)
    {
        $this->Restaurant->score=$this->addScore($score);
        $this->Restaurant->count+=1;
        return$this->Restaurant->save();
    }
    protected function addScore(int $new):float
    {
        return  ($this->Restaurant->score*$this->Restaurant->count + $new   )/((float) $this->Restaurant->count+1)  ;
    }
	/**
	 * @param  int  $id
	 * @return FoodScore
	 */
	function setIdRestaurant(int $id): self {
        $this->Restaurant=(new Restaurant())->find($id);
		return $this;
	}
    /**
	 * @param \App\Models\Restaurant $food you must give me finding Restaurant
	 * @return FoodScore
	 */
	function setModelRestaurant( Restaurant $Restaurant): self {
        $this->Restaurant=$Restaurant;
		return $this;
	}
}
