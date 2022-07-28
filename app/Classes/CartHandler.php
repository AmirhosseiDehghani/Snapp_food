<?php
namespace App\Classes;

use App\Http\Resources\AddressResource;
use App\Http\Resources\CartInfoCollection;
use App\Http\Resources\CartInfoResource;
use App\Http\Resources\CartResource;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\PseudoTypes\CallableString;

use function PHPUnit\Framework\never;

class CartHandler{
    public readonly \Illuminate\Database\Eloquent\Relations\HasMany $cart;
    protected   $output=[];
    protected $massage='';
    protected bool $success;
    protected string $keyOutput='data';
    function __construct()
    {
        $this->cart=auth()->user()->cart();
    }
    protected function setOutput(array|object $value,string $key='data')
    {
        $this->output=$value;
        $this->keyOutput=$key;
    }

    public function output()
    {
        $array=['user'=>auth()->id()];
        $array['status']=($this->success??false)?'success':'fail';
        if(!empty(trim($this->massage))){
            $array['massage']=$this->massage;
        }
        if(!empty($this->output)){
            $array[$this->keyOutput]=$this->output;
        }
        return $array;
    }
    protected function isCartsEmpty()
    {
        return count($this->cart->get())==0;
    }
    protected function isCartExist($id)
    {
        return (count($this->thisCart($id))!=0);
    }
    protected function isThisFoodExist($id)
    {
        return count($this->cart->with('food')->where('food_id', $id)->get())!=0;
    }
    public function getCart()
    {
        $cart=$this->cart->get();
        if($this->isCartsEmpty())
        {
            $this->massage= 'your carts is empty';
            return $this->success =false;
        }
        $this->setOutput($cart->groupBy('cart_id')->sortBy('cart_id'),'cart');

        return $this->success= true;
    }
    protected function update(int $id,int $quantity,bool $plus=false)
    {
        if($plus)
        return $this->thisFood($id)->update([
            'quantity'=>$quantity+$this->thisFood($id)->quantity
        ]);

        return $this->thisFood($id)->update(['quantity'=>$quantity]);
    }
    protected function create(int $id,int $quantity,$cart_id=1)
    {
      return  $this->cart->create([
            'food_id'=>$id,
            'quantity'=>$quantity,
            'cart_id'=>$cart_id
        ]);
    }
    protected function thisFood($id)
    {
        return $this->cart->with('food')->where('food_id', $id)->first();;
    }
    protected function thisCart($id)
    {
        return $this->cart->where('cart_id',$id)->get();
    }

    public function setCart(array $data)
    {
        if($this->isCartsEmpty() or !$this->isThisFoodExist($data['food_id'])){
            $this->create($data['food_id'],$data['quantity']);
        }else
        {
            $this->massage='you do not have  such food';
            return $this->success= false;

        }
        $this->massage='the food add';
        return $this->success= true;
    }
    public function addItemCard(int $id)
    {
        if(!$this->cart->get() or !$this->thisFood($id)){
          $this->create($id,1);
        }else{
            $this->update($id,1,true);
        }
        $this->massage='the food add';
    }
    public function subItemCart(int $id) : bool
    {
        // $item=$this->thisFood($id);
        if($this->isCartsEmpty()){

            $this->massage='your cart is empty';
            return $this->success= false;

        }elseif(!$this->isThisFoodExist($id)){
            $this->massage='you Do not have such food';
            return $this->success= false;

        }elseif($this->thisFood($id)->quantity==1)
        {
            $this->thisFood($id)->delete();
            $this->massage='your food is delete';
        }else
        {
            $this->update($id,-1,true);
            $this->massage='the food reduces';
        }
        return $this->success= true;
    }
    public function deleteItemCart($id)
    {
        if(!$this->thisFood($id))
        {
            $this->massage='you do not have such food';
            return $this->success= false;

        }else
        {
            $this->thisFood($id)->delete();
            $this->massage='food is deleted';
            return $this->success= true;

        }
    }
    public function deleteCart($id)
    {
        $this->cart->where('cart_id',$id)->delete();
        $this->massage='your cart is empty';
        return $this->success= true;
    }

    protected function CartInfo()
    {
        $cartIds=$this->cart->pluck("food_id");
        return Restaurant::with(
            [
                'address'
                ,
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
        )
        ->get();

    }

    protected function CardIdInfo($id)
    {
        $cartIds=$this->cart->where('cart_id',$id)->pluck("food_id");

        return Restaurant::with([
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
            $this->massage='your cart is empty';
            return $this->success= true;
        }
        $this->setOutput(CartInfoResource::collection($this->CartInfo()),'Restaurant');
        return $this->success= true;
    }
    public function getCartId($id)
    {
        if($this->isCartExist($id))
        {
            $this->setOutput(new CartInfoResource($this->CardIdInfo($id)),'Restaurant');
            return $this->success= true;
        }else
        {
            $this->massage='your cart is empty';
            return $this->success= false;
        }
    }
    public function hasAddress():bool
    {
        $address=auth()->user()->addresses();
        if($address->get()->isEmpty()){
            $this->massage='please first add address';
            return false;
        }
        if($address->where('default',1)->get()->isEmpty()){
            $this->massage='please first chose a default address';
            return false;

        }
        return true;
    }

    public function payForCart($id)
    {
        $test=$this->getCartId($id);
        if($test){

            $rawData=json_decode(json_encode($this->output),true);


            if(!$this->hasAddress()){
                return $this->success= false;
            }

            $user=auth()->user();
            $restaurant=$this->thisCart($id)->first()->restaurant;
            $data=[
                'buyer'=>[
                    'name'=>$user->name,
                    'address'=>new AddressResource($user->addresses()->where('default',1)->first())
                ],
                'order'=>[
                    'food'=>$rawData['food'],
                    'total_price'=>$rawData['total_price']
                ],
                'restaurant'=>[
                    'name'=>$restaurant->name,
                    'phone'=>$restaurant->phone,
                    'account'=>$restaurant->account,
                ]
            ];
            // DB::transaction(function()use($id,$data){
                Order::create(['data'=>$data ,'restaurant_id'=>$id]);
            // });
            $this->output= [
                'user'=>auth()->id(),
                'massage'=>'successfully'
            ];
            return $this->success= true;
        }
        $this->output= [
            'user'=>auth()->id(),
            'massage'=>'fail try again'
        ];

        return $this->success= false;
    }


}
