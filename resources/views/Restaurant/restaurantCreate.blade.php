@extends('layouts.seller')

@section('content')

<div class="row  ">
    <div class="col-12">
        <div class="p-5">
            <h1>Add Resturant</h1>

        </div>
    </div>
    <div class="col">
        <form action="{{route("Seller.Restaurant.store")}}" method="POST" enctype="multipart/form-data">
            <div class="row justify-content-start row-cols-sm-1 row-cols-md-3 row-cols-lg-4">
                <div class="col mb-3 ">
                    <label for="exampleInput-name" class="form-label fw-bolder">Name</label>
                    <input name="name" value="{{old('name')}}" type="text" class="form-control" id="exampleInput-name" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">
                        @error('name') 
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col mb-3 ">
                    <label for="exampleInput-phone" class="form-label fw-bolder">phone</label>
                    <input phone="phone" value="{{old('phone')}}" type="text" class="form-control" id="exampleInput-phone" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">
                        @error('phone') 
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col mb-3 ">
                    <label for="exampleInput-address" class="form-label fw-bolder">address</label>
                    <input address="address" value="{{old('address')}}" type="text" class="form-control" id="exampleInput-address" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">
                        @error('address') 
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col mb-3 ">
                    <label for="select" class="form-label fw-bolder">Category</label>
                    <select id="select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        <option selected>Chose one category</option>
                        @foreach ($Category as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <div id="emailHelp" class="form-text">
                        @error('address') 
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col mb-3 ">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Chose picture</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                        @error('image') 
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                
                <div class="col">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </div>
            
        </form>

    </div>
</div>
    
@endsection