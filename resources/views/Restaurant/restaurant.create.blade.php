@extends('layouts.seller')

@section('content')

<div class="row">
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
                    <label for="select" class="form-label fw-bolder">address</label>
                    <select id="select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <div id="emailHelp" class="form-text">
                        @error('address') 
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
    
@endsection