<?php

namespace App\Classes\Helper;

use App\Models\Food;

class FoodScore{

    protected Food $food;

    public function Score(int $score)
    {
        $this->food->score=$this->addScore($score);
        $this->food->count+=1;
        return $this->food->save();

    }
    protected function addScore(int $new):float
    {
        return  ($this->food->score*$this->food->count + $new   )/((float) $this->food->count+1)  ;
    }

	/**
	 * @param  int  $id
	 * @return FoodScore
	 */
	function setIdFood(int $id): self {
        $this->food=(new Food)->find($id);
		return $this;
	}
    /**
	 * @param \App\Models\Food $food you must give find food
	 * @return FoodScore
	 */
	function setModelFood( Food $food): self {
        $this->food=$food;
		return $this;
	}
}
