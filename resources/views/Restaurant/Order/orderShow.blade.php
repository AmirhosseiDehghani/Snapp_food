@extends('layouts.seller')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="">
            <x-navbar-show-restaurant-component>
                <x-slot:href>
                   {{route('Seller.Restaurant.show',['Restaurant'=>$Restaurant->id])}}
                </x-slot>
               Restaurant:{{$Restaurant->name}}
            </x-navbar-show-restaurant-component>
        </div>
    </div>
    

    <div class="col-12">
        <div style="min-height: 80vh;" class="w-100 d-flex d-flex justify-content-center d-flex align-items-center ">

                <div class="p-5">
                    <div class="row ">
                        <div class="col-12">
                            {{-- @dd($order->status) --}}
                            @if ($order->status!=3)
                                <form action="{{ route('Seller.Restaurant.order.update', ['Restaurant'=>$Restaurant,"order"=>$order]) }}" method='post' >
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-info">
                                        next level
                                    </button>
                                    <div><p>next is: {{$order->showNextStatus}}</p></div>
                                </form>
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                  <h5 class="card-title">Order</h5>
                                  <h6 class="card-subtitle mb-2 text-muted">{{$order->data['buyer']['name']}}</h6>
                                  <p class="card-text">
                                    <ul class="list-group ">
                                        <h6>Address</h6>
                                        <li class="list-group-item " aria-current="true">
                                          {{$order->data['buyer']['address']['address']}}
                                        </li>
                                    </ul>
                                    <hr>
                                    <h6>Food</h6>
                                      @foreach ($order->data['order']['food'] as $item)
                                    <ul class="list-group">
                                        <li class="list-group-item">name: {{$item['food_name']}}</li>
                                        <li class="list-group-item">Price: {{$item['food_price']}}</li>
                                        <li class="list-group-item">Quantity: {{$item['food_quantity']}}</li>
                                        @if ($item['food_quantity']*$item['food_price']!=$item['price'])
                                        <li class="list-group-item">Discount: {{$item['price']*100/$item['food_quantity']*$item['food_price']}}%</li>
                                        @endif
                                        <li class="list-group-item ">
                                            <div class="card-footer">
                                                Price this food: {{$item['price']}}
                                            </div>
                                        </li>
                                    </ul>
                                    @endforeach
                                    <ul class="list-group">
                                        <li class="list-group-item active" aria-current="true">Total Price:{{$order->data['order']['total_price']}}</li>
                                    </ul>
                                </p>

                                </div>
                              </div>
                        </div>

                    </div>
                </div>

        </div>
    </div>

</div>
@endsection
