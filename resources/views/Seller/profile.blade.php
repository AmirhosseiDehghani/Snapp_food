@extends('layouts.seller')

@php
    $user=auth()->user();
@endphp

{{-- @dd() --}}
@section('content')
    
<div class="row  ">
    <div class="col-12   ">
        <form method="POST" action="{{route("Seller.profile.update")}}">
            {{-- @dd(auth()->user()); --}}
            @method('put')
            @csrf
            <div class="row row-col-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3  justify-content-start  bg-info ">
                <div class="col ">
                    <div class="">
                        <img src="https://picsum.photos/seed/picsum/200/300" class="img-thumbnail bg-info" alt="...">
                    </div>
                </div>
                <div class="col ">
                    <div>
                        <div class="col mb-3 ">
                            <label for="exampleInput-name" class="form-label fw-bolder">Name</label>
                            <input name="name" value="{{old('name',$user->name)}}" type="text" class="form-control" id="exampleInput-name" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">
                                @error('name') 
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
        
                        <div class="col mb-3">
                            <label for="exampleInput-phone" class="form-label fw-bolder">Phone</label>
                            <input name="phone" value="{{old('phone',$user->phone)}}" type="text" class="form-control" id="exampleInput-phone" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">
                                @error('phone') 
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
        
                        <div class="col mb-3">
                            <label for="exampleInput-email" class="form-label fw-bolder">email</label>
                            <input name="email" value="{{old('email',$user->email)}}" type="email" class="form-control" id="exampleInput-email" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">
                                @error('email') 
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col align-self-end">
                            <div class="m-4">
                                <button  class="btn btn-success m-3" type="submit">update</button>
                            </div>
                        </div>
                    </div>
                    
                </div>

                
                
                
            </div>
        </form>
    </div>

</div>

@if (session()->has('success') or session()->has('fial') )
    @if (session()->has('success'))
       <div class="alert alert-success" role="alert">
        @php session('success') @endphp
       </div>
    @else
       <div class="alert alert-denger" role="alert">
        @php session('fial') @endphp
       </div>
    @endif
@endif
{{-- @dd(auth()->user()) --}}
@endsection