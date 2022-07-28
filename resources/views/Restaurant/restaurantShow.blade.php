@extends('layouts.seller')
@section('content')


<div class="row">
    <div class="col-12">
        <div class="d-flex d-flex justify-content-between">
            <x-navbar-show-restaurant-component>
                <x-slot:href>
                   {{route('Seller.Restaurant.show',['Restaurant'=>$Restaurant->id])}}
                </x-slot>
               Restaurant:{{$Restaurant->name}}
            </x-navbar-show-restaurant-component>

            <div><a class="btn btn-info" href="{{ route('Seller.Restaurant.order.history', ['Restaurant'=>$Restaurant->id]) }}">History</a></div>
            <div><a class="btn btn-info" href="{{ route('Seller.Restaurant.comment.index', ['Restaurant'=>$Restaurant->id]) }}">Comment</a></div>
        </div>
    </div>

    <div class="col-12">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-12">
                        <h1>Food</h1>
                    </div>
                    <div class="col-12">
                        <form action="{{route('Seller.Restaurant.food.store',['Restaurant'=>$Restaurant->id])}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col mb-3 ">

                                    <label for="basic-name" class="form-label">Name</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="name" class="form-control" id="basic-name" aria-describedby="basic-addon3">
                                    </div>
                                    <div id="basic-name" class="form-text">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                <div class="col mb-3">
                                    <label for="exampleInputPrice" class="form-label">Price</label>
                                    <input name="price" type="text" class="form-control" id="exampleInputPrice" aria-describedby="Price">
                                    <div id="Price" class="form-text">
                                    @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="exampleInputMake_of" class="form-label">Make of</label>
                                    <input name="make_of" type="text" class="form-control" id="exampleInputMake_of" aria-describedby="Make_of">
                                    <div id="Make_of" class="form-text">
                                    @error('make_of')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col mb-3 ">
                                    <label for="select" class="form-label fw-bolder">Category</label>
                                    <select name="category" id="select" class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
                                        <option selected>Chose one category</option>
                                        @foreach ($Categories as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <div id="emailHelp" class="form-text">
                                        @error('category')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col mb-3 mt-3" >
                                    <button type="submit" class="btn btn-info mt-3"> Add</button>
                                </div>
                                <div class="col">
                                    <div>
                                        @if (session()->has('success_massage'))
                                         <div class="alert alert-success">{{ session('success_massage') }}</div>
                                        @endif
                                    </div>
                                    <div>
                                        @if (session()->has("fail_massage"))
                                         <div class="alert alert-danger">{{ session('fail_massage') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">price</th>
                                <th scope="col">make of</th>
                                <th scope="col">Category</th>
                                <th scope="col">Food Party</th>
                                <th scope="col">Function</th>
                              </tr>
                            </thead>
                            @php
                                $count=1;
                            @endphp
                            <tbody>
                                @foreach ($Food as $kay=> $item)
                                <tr>
                                    <th scope="row"></th>
                                    <td>{{$item->name}}</td>
                                  <td>{{$item->price}}</td>
                                  <td>{{$item->make_of??'-'}}</td>
                                  <td>
                                    @foreach ($item->categories as $category)
                                        {{$category->name.' '}}
                                    @endforeach
                                  </td>
                                  <td>
                                    <form action="{{route('Seller.Restaurant.food.party',['Restaurant'=>$Restaurant,"Food"=>$item->id])}}" method="post">
                                        @csrf
                                    <button type="submit" class="btn btn-warning">
                                        @if ($item->is_foodparty)
                                        remove
                                        @else
                                        add
                                        @endif
                                    </button>
                                    </form>
                                  </td>
                                  <td>
                                      <!-- Button trigger modal -->
                                      <div class="btn-group " role="group" aria-label="Basic example">
                                       <form action="{{route('Seller.Restaurant.food.destroy',['Restaurant'=>$Restaurant->id,'Food'=>$item->id] )}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        <a class="btn btn-info" href="{{route('Seller.Restaurant.food.edit',['Restaurant'=>$Restaurant->id,'Food'=>$item->id])}}" >
                                            Edit
                                        </a>
                                      </div>
                                  </td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                          {{$Food->links()}}

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-12">
        <h1>Order</h1>
        <div class="col">
            @if ($Orders->empty())
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">address</th>
                        <th scope="col">status</th>
                        <th scope="col">see</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($Orders as $item)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$item->data['buyer']['name']}}</td>
                            <td>{{$item->data['buyer']['address']['address']}}</td>
                            <td>{{$item->showStatus}}</td>
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
            @else
                <h2>no order</h2>
            @endif

        </div>
    </div>
</div>
@endsection

{{--
<div class="d-flex flex-row">
    <div>
        <x-input-component>
            <x-slot:label>Name</x-slot:label>
            <x-slot:name>name</x-slot:name>
            <x-slot:value>{{$item->name}}</x-slot:value>
        </x-input-component>
    </div>
    <div>
        <x-input-component>
            <x-slot:label>Price</x-slot:label>
            <x-slot:name>price</x-slot:name>
            <x-slot:value>{{$item->price}}</x-slot:value>
        </x-input-component>
    </div>

    <div>
        <x-input-component>
            <x-slot:label>Make of</x-slot:label>
            <x-slot:name>make_of</x-slot:name>
            <x-slot:value>{{$item->make_of}}</x-slot:value>
        </x-input-component>
    </div>
</div>


--}}
