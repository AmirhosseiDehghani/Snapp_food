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
                                  <td>{{$item->make_of}}</td>
                                  <td>
                                    @foreach ($item->categories as $category)
                                        {{$category->name.' '}}
                                    @endforeach 
                                  </td>
                                  <td>
                                      <!-- Button trigger modal -->
                                      <div class="btn-group " role="group" aria-label="Basic example">
                                       <form action="{{route('Seller.Restaurant.food.destroy',['Restaurant'=>$Restaurant->id,'Food'=>$item->id] )}}" method="POST">
                                        @csrf
                                        @method('delete')
                                           <button type="button" class="btn btn-danger">delete</button>
                                        </form>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$count}}">
                                            edit
                                        </button>
                                       
                                      </div>
                                        
                                        <form action="{{route('Seller.Restaurant.food.update',['Restaurant'=>$Restaurant->id,'Food'=>$item->id])}}" method="post">
                                        <!-- Modal -->
                                        @csrf
                                        @method('put')
                                        <div class="modal fade" id="staticBackdrop_{{$count}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
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
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Understood</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>                                         
                                    </form>
                                  </td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <div class="col-12">
        <div class="col">
            see ordes and change    
        </div>
    </div>
</div>    
@endsection