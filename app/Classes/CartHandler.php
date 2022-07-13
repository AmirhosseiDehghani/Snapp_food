<?php
namespace App\Classes;

use App\Http\Resources\CartInfoCollection;
use App\Http\Resources\CartInfoResource;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\PseudoTypes\CallableString;

class CartHandler{
    public  $cart;
    public  $output=[];
    function __construct()
    {
        $this->cart=auth()->user()->cart();
    }
    public function isCartEmpty()
    {
        return empty($this->cart->get());
    }
    public function getCart()
    {
        $cart=$this->cart->get();
        if($this->isCartEmpty())
        {
            $this->output= [
                'user'=>auth()->id(),
                'massage'=>'your cart is empty'
            ];
            return false;
        }
        $this->output= [
            'user'=>auth()->id(),
            'cart'=>$cart
        ];
        return true;
    }
    public function update(int $id,int $quantity,bool $plus=false)
    {
        if($plus)
        return $this->thisFood($id)->update([
            'quantity'=>$quantity+$this->thisFood($id)->quantity
        ]);

        return $this->thisFood($id)->update(['quantity'=>$quantity]);
    }
    public function create(int $id,int $quantity,$cart_id=1)
    {
      return  $this->cart->create([
            'food_id'=>$id,
            'quantity'=>$quantity,
            'cart_id'=>$cart_id
        ]);
    }
    public function thisFood($id)
    {
        return $this->cart->with('food')->where('food_id', $id)->first();;
    }
    public function setCart(array $data)
    {
        if(!$this->cart->get() or !$this->thisFood($data['food_id'])){
            $cart=$this->create($data['food_id'],$data['quantity']);
        }else{
            $cart=$this->update($data['food_id'],$data['quantity'],true);
        }
        $this->output=[
            'user_id'=>auth()->id(),
            'massage'=>'the food add',
            // 'Cart'=>CartResource::collection( $this->thisFood($data['food_id']))
        ];
        // return $cart;
    }
    public function addItemCard(int $id)
    {
        if(!$this->cart->get() or !$this->thisFood($id)){
          $this->create($id,1);
        }else{
            $this->update($id,1,true);
        }
        $this->output=[
            'user_id'=>auth()->id(),
            'massage'=>'the food add',
            // 'Cart'=>$this->thisFood($id)
        ];
    }
    public function subItemCart(int $id) : bool
    {
        // $item=$this->thisFood($id);
        if(!$this->cart->get()){
            $this->output=[
                'user_id'=>auth()->id(),
                'massage'=>'your cart is empty'
            ];
            return false;
        }elseif(!$this->thisFood($id)){
            $this->output=[
                'user_id'=>auth()->id(),
                'massage'=>'you Do not have such food'
            ];
            return false;
        }elseif($this->thisFood($id)->quantity==1){
            $this->thisFood($id)->delete();
            $this->output=[
                'user_id'=>auth()->id(),
                'massage'=>'your item is delete'
            ];
            return false;
        }else{
          $cart=  $this->update($id,-1,true);
          $this->output=[
            'user_id'=>auth()->id(),
            'massage'=>'the food reduces',
            // 'Cart'=>$this->thisFood($id)
        ];
            return true;
        }
    }
    public function deleteItemCart($id)
    {
        if(!$this->thisFood($id))
        {
            $this->output=[
                'user_id'=>auth()->id(),
                'massage'=>'you do not have such food',
            ];
        }else
        {
            $this->thisFood($id)->delete();
            $this->output=[
                'user_id'=>auth()->id(),
                'massage'=>'food is deleted',
                // 'Cart'=>$this->thisFood($id)
            ];
        }
    }
    public function deleteCart($id)
    {
        $this->cart->where('cart_id',$id)->delete();
        $this->output= [
            'user'=>auth()->id(),
            'massage'=>'your cart is empty'
        ];
    }
    protected function CartInfo()
    {
        $cartIds=$this->cart->pluck("food_id");

        return Restaurant::with(
            [
                'address',
                'food'=>fn($query0)=>$query0->with
                (
                    [
                        'cart'=>fn($query2)=>$query2->where('user_id',auth()->id())
                    ]
                )->whereIn('id',$cartIds)])
        ->whereHas
        (
            'food',
            function(Builder $query) use($cartIds)
            {
                $query->whereIn('id',$cartIds);
            }
        )->get();
    }
    public function getCartInfo()
    {
        if($this->isCartEmpty())
        {
            $this->output= [
                'user'=>auth()->id(),
                'massage'=>'your cart is empty'
            ];
            return false;
        }


        // $this->output= [
        //     'user'=>auth()->id(),
        //     'Restaurant'=>new CartInfoResource($this->CartInfo())
        // ];
        $this->output=CartInfoResource::collection($this->CartInfo());

        return true;
    }
    public function payForCart()
    {
        // $this->getCartInfo();
        // // dd($this->output);
        // $cart= json_decode(json_encode($this->output),true)  ;
        // $price= $cart['Restaurant']['total_price'];
        // $TotalPrice=

        return $this->CartInfo();
    }
}
