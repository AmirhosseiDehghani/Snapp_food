@extends('layouts.seller')

@section('content')

{{-- @dd($Restaurant->id) --}}
<div class="row">
    
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <h1>
                    base Resturant Edit model
               </h1>
            </div>
            <div class="col">
                <form action="">
                    <div class="row">
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
                            <label for="exampleInput-account" class="form-label fw-bolder">Account</label>
                            <input name="account" value="{{old('account')}}" type="text" class="form-control" id="exampleInput-account" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">
                                @error('account') 
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="row">
         Address
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
        </div>
    </div>

    <div class="col-12">
        <div class="col">
            add delete date
        </div>
    </div>

    <div class="col-12">
        <div class="col">
            add delete download image
        </div>
    </div>


</div>    
@endsection