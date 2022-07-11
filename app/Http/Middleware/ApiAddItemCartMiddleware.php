<?php

namespace App\Http\Middleware;

use App\Models\Food;
use Closure;
use Illuminate\Http\Request;

class ApiAddItemCartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
    //  * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$id)
    {
        $cart=auth()->user()->cart()->get();
        $food=new Food();
        // $value=
        dd($id);
        if(count($cart)==0 or count($cart)==1){
            return $next($request);
        }
        if($this->cart->first()->food->restaurant->id==$food->find($id)->restaurant->id   )
        {
            return $next($request);
        }

        // $this->massage='You can not Chose  food from different restaurant  ';
        abort(200,'You can not Chose  food from different restaurant');

    }
}
