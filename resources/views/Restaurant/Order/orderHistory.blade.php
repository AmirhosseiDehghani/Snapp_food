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
    <div>

    <div class="col-12">
        <div class="mt-2">

            <form action="">
                <select name="filter" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">

                    <option @if(request('filter')==1) selected  @endif value="1">one week</option>
                    <option @if(request('filter')==2) selected @endif value="2">one month</option>
                    <option @if(request('filter')==3) selected @endif value="3">all</option>
                </select>
                <button class="btn btn-info" type="submit">filter</button>
            </form>

        </div>
    </div>

    <div class="col-12 ">
        <h3 class="pt-2">Total Price= {{$Sum}}</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">address</th>
                <th scope="col">price</th>
                {{-- <th scope="col">status</th> --}}
                <th scope="col">see</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($Orders as $item)
                <tr>
                    <th scope="row">1</th>
                    <td>{{$item->data['buyer']['name']}}</td>
                    <td>{{$item->data['buyer']['address']['address']}}</td>
                    <td>{{$item->data['order']['total_price']}}</td>
                    {{-- <td>{{$item->showStatus}}</td> --}}
                    <td>
                        <form action="{{ route('Seller.Restaurant.order.show', ['Restaurant'=>$Restaurant,"order"=>$item])}}" method="get">
                            <button type="submit" class="btn btn-info">
                                see
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{$Orders->links()}}

    </div>


</div>


@endsection
