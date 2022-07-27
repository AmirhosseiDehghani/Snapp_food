<?php

namespace App\Classes;

use App\Classes\Helper\FoodScore;
use App\Classes\Helper\RestaurantScore;
use App\Models\Comment;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\User;

class CommentHandler{

    // protected  $ResScore;
    // protected  $FoodScore;
    protected Food $Food;
    protected Restaurant $Restaurant;
    protected User $user;
    function __construct()
    {
        // $this->ResScore=new RestaurantScore ;
        // $this->foodScore=new FoodScore ;
        $this->Food=new Food();
        $this->Restaurant=new Restaurant;
        $this->user=auth()->user();
    }
    protected function FindFood($id)
    {
       return $this->Food->find($id);
    }
    protected function FindRestaurant($id)
    {
      return  $this->Restaurant->find($id);
    }
    ///------------score

    protected function addFoodScore(int $id,int $score)
    {

        return (new FoodScore)->setIdFood($id)->Score($score);
    }
    protected function addRestaurantScore(int $id, int $score)
    {
        return (new RestaurantScore)->setIdRestaurant($id)->Score($score);
    }
    ///------------addComment
    protected function addCommentFood(int $idFood, string $comment)
    {
        $Comment=new Comment();
        $Comment->body=$comment;
        $Comment->user_id=$this->user->id;
        $this->FindFood($idFood)->comments()->save($Comment);
    }
    protected function addCommentRestaurant(int $idFood, string $comment)
    {
        $Comment=new Comment();
        $Comment->body=$comment;
        $Comment->user_id=$this->user->id;
        $this->FindRestaurant($idFood)->comments()->save($Comment);
    }
    ///---------------------------------------

    protected function getCommentFood(int $id)
    {
        return $this->FindFood($id)->comments;
    }
    protected function getCommentRestaurant(int $id)
    {
        // dd($this->FindRestaurant($id)->comments);
        return $this->FindRestaurant($id)->comments;
    }
    ///---------------------------------------
    public function getComment(array $array)
    {
        $output=[];
        (!is_null($array['food_id']))?
         $output['comment_food']=
         [
            'Comment'=> $this->getCommentFood($array['food_id'])->toArray(),
            'score'=>$this->FindFood($array['food_id'])->score,
         ]   :
         $output    ;
        (!is_null($array['restaurant_id']))?
         $output['restaurant_id']=
         [
            'Comment'=> $this->getCommentRestaurant($array['restaurant_id'])->toArray(),
            'score'=>$this->FindRestaurant($array['restaurant_id'])->score
         ]   :
         $output    ;
        return $output;
    }
    public function postComment(array $array)
    {
        $this->addCommentRestaurant($array['cart_id'],$array['message']);
        $this->addRestaurantScore($array['cart_id'],$array['score']);
       $food=$this->user->cart()->where('cart_id','=',$array['cart_id'])->get();
       foreach ($food as  $value) {
            $this->addCommentFood($value['food_id'],$array['message']);
            $this->addFoodScore($value['food_id'],$array['score']);
       }
       return ['massage'=>'success'] ;

    }

}
