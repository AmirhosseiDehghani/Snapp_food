<?php
namespace App\Classes;

use App\Http\Resources\CartInfoCollection;
use App\Http\Resources\CartInfoResource;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\PseudoTypes\CallableString;

use function PHPUnit\Framework\never;

class CartHandler{
    public readonly \Illuminate\Database\Eloquent\Relations\HasMany $cart;
    public   $output=[];
    function __construct()
    {
        $this->cart=auth()->user()->cart();
    }
    public function isCartsEmpty()
    {
        return count($this->cart->get())==0;
    }
    public function isCartExist($id)
    {
        return (count($this->thisCart($id))!=0);
    }
    public function isThisFoodExist($id)
    {
        return count($this->cart->with('food')->where('food_id', $id)->get())!=0;
    }
    public function getCart()
    {
        $cart=$this->cart->get();
        if($this->isCartsEmpty())
        {
            $this->output= [
                'user'=>auth()->id(),
                'massage'=>'your carts is empty'
            ];
            return false;
        }
        $this->output= [
            'user'=>auth()->id(),
            'cart'=>$cart->groupBy('cart_id')
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
    public function thisCart($id)
    {
        return $this->cart->where('cart_id',$id)->get();
    }

    public function setCart(array $data)
    {
        if($this->isCartsEmpty() or !$this->isThisFoodExist($data['food_id'])){
            $this->create($data['food_id'],$data['quantity']);
        }else{
            $this->output=[
                'user_id'=>auth()->id(),
                'massage'=>'you have such food',
            ];
            // $this->update($data['food_id'],$data['quantity'],true);
        }
        $this->output=[
            'user_id'=>auth()->id(),
            'massage'=>'the food add',
        ];
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
        if($this->isCartsEmpty()){
            $this->output=[
                'user_id'=>auth()->id(),
                'massage'=>'your cart is empty'
            ];
            return false;
        }elseif(!$this->isThisFoodExist($id)){
            $this->output=[
                'user_id'=>auth()->id(),
                'massage'=>'you Do not have such food'
            ];
            return false;
        }elseif($this->thisFood($id)->quantity==1){
            $this->thisFood($id)->delete();
            $this->output=[
                'user_id'=>auth()->id(),
                'massage'=>'your food is delete'
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
    protected function CardIdInfo($id)
    {
        $cartIds=$this->cart->where('cart_id',$id)->pluck("food_id");

        return Restaurant::with([
            // 'carts'=>fn($query0)=>$query0->where([['cart_id',$id],['user_id',auth()->id()]]),
            'address',
            'food'=>fn($query)=>$query->with([
                'cart'=>fn($query0)=>$query0->where([['cart_id',$id],['user_id',auth()->id()]]),
            ])->whereIn('id',$cartIds)
        ])->find($id);
    }
    public function getCartInfo()
    {
        if($this->isCartsEmpty())
        {
            $this->output= [
                'user'=>auth()->id(),
                'massage'=>'your cart is empty'
            ];
            return false;
        }


        $this->output= [
            'user'=>auth()->id(),
            'Restaurant'=>CartInfoResource::collection($this->CartInfo())
        ];
        // $this->output=CartInfoResource::collection($this->CartInfo());

        return true;
    }
    public function getCartId($id)
    {
        if($this->isCartExist($id))
        {
            $this->output= [
                'user'=>auth()->id(),
                'Restaurant'=>new CartInfoResource($this->CardIdInfo($id))
            ];
             return true;
        }else
        {
            $this->output= [
                'user'=>auth()->id(),
                'massage'=>'your cart is empty'
            ];
            return false;

        }


        // $this->output=new CartInfoResource($this->CardIdInfo($id));
    }
    public function payForCart($id)
    {
        $test=$this->getCartId($id);
        if($test){

            DB::transaction(function(){

                
            });
            return true;
        }


        return false;
    }
}
