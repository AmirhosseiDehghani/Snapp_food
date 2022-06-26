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
            @csrf
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
                    <input name="phone" value="{{old('phone')}}" type="text" class="form-control" id="exampleInput-phone" aria-describedby="emailHelp">
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
                    <input name="address" value="{{old('address')}}" type="text" class="form-control" id="exampleInput-address" aria-describedby="emailHelp">
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
                    <select name="category" id="select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
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
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Day</th>
                            <th scope="col">Open</th>
                            <th scope="col"></th>
                            <th scope="col">Close </th>
                            <th scope="col">you DeaActive</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($Week as $kay=>$day)
                            <tr>
                                <th scope="row">{{$day}}</th>
                                <td>
                                    <div class="d-flex ">
                                        <div>
                                            <input value="{{old("$day"."_S")}}" name="{{$day}}_S" class="form-control form-control-sm " type="time" placeholder="Hour" aria-label=".form-control-sm example">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div>
                                            <input value="{{old("$day"."_E")}}" name="{{$day}}_E" class="form-control form-control-sm " type="time" placeholder="Hour" aria-label=".form-control-sm example">
                                        </div>                                       
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input name="{{"$day"."_isActive"}}"  class="form-check-input" type="checkbox" value="0" id="flexCheckDefault"  {{ (! empty(old('use_signature')) ? 'checked' : '') }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                          
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
                
                <div class="col">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </div>
            
        </form>

    </div>
</div>
    
@endsection