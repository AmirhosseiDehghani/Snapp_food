@extends('layouts.seller')
@section('content')

{{-- @dd($Restaurant->id) --}}
<div class="row">
    <div class="col-12">
        <x-navbar-show-restaurant-component>
            <x-slot:href>
               {{route('Seller.Restaurant.show',['Restaurant'=>$Restaurant->id])}}
            </x-slot>
           Restaurant:{{$Restaurant->name}}
        </x-navbar-show-restaurant-component>
    </div> 

    <div class="col-12">
        <div class="row">
            food add show change
        </div>
    </div>

    <div class="col-12">
        <div class="col">
            see ordes and change    
        </div>
    </div>
</div>    
@endsection