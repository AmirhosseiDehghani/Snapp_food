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

    </div>

    <div class="col-12">
        <form action="{{route('Seller.Restaurant.food.store',['Restaurant'=>$Restaurant->id])}}" method="POST">
            @csrf
            <div class="row">
                <div class="col mb-3 ">
                    <x-input-component>
                        <x-slot:label>Name</x-slot:label>
                        <x-slot:name>name</x-slot:name>
                        <x-slot:value>{{old('name',$Food->name)}}</x-slot:value>
                    </x-input-component>
                </div>
                <div class="col mb-3 ">
                    <x-input-component>
                        <x-slot:label>Price</x-slot:label>
                        <x-slot:name>price</x-slot:name>
                        <x-slot:value>{{old('price',$Food->price)}}</x-slot:value>
                    </x-input-component>
                </div>
                <div class="col mb-3 ">
                    <x-input-component>
                        <x-slot:label>Make of</x-slot:label>
                        <x-slot:name>make_of</x-slot:name>
                        <x-slot:value>{{old('make_of',$Food->make_of)}}</x-slot:value>
                    </x-input-component>
                </div>
                <div class="col mb-3 ">
                    <label for="select" class="form-label fw-bolder">Category</label>

                    <select class="select" multiple data-mdb-filter="true" aria-label="select">

                        @foreach ($Categories as $item)
                        <option value="{{$item->id}}" @foreach($Food->categories as $catagory) @checked(true) @endforeach >{{$item->name}} </option>
                        @endforeach
                    </select>

                </div>
                <div class="col">
                    <button type="submit" class="btn btn-info">
                        update
                    </button>
                </div>
            </div>
        </form>
        <div class="col-12">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input name="image" class="form-control" type="file" id="formFile">
                  </div>
            </form>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-info">
                Add image
            </button>
        </div>
    </div>


</div>


@endsection
