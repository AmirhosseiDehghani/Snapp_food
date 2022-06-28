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
                <form action="{{route('Seller.Restaurant.update',['Restaurant'=>$Restaurant->id])}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col mb-3 ">
                            <label for="exampleInput-name" class="form-label fw-bolder">Name</label>
                            <input name="name" value="{{old('name',$Restaurant->name)}}" type="text" class="form-control" id="exampleInput-name" aria-describedby="emailHelp">
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
                            <input name="phone" value="{{old('phone',$Restaurant->phone)}}" type="text" class="form-control" id="exampleInput-phone" aria-describedby="emailHelp">
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
                            <input name="account" value="{{old('account',$Restaurant->account)}}" type="text" class="form-control" id="exampleInput-account" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">
                                @error('account') 
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                    </div>
                    <div class="col p-3">
                        <div class="p-3">
                            <button type="submit" class="btn btn-success">
                                Change 
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

  
    {{-- --------------------------- date--------------------------------------- --}}

    <div class="col-12">
        <div class="col">
            <div class="h1">
                add delete date
            </div>
            <div class="row">
                <div class="row ">
                    <div class="col">
                        <div class="">
                            <form action="{{route('Seller.Restaurant.addDay',['Restaurant'=>$Restaurant->id])}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col mb-3 ">
                                        <label for="select" class="form-label fw-bolder">Day of Week</label>
                                        <select name="day" id="select" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                            <option selected>Chose one Day</option>
                                            @foreach ($Week as $item)
                                            <option value="{{$item}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                        <div id="emailHelp" class="form-text">
                                            @error('day') 
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Open Time</label>
                                        <input name="open_time" type="time" class="form-control" id="exampleInputEmail1" aria-describedby="description">
                                        <div id="description" class="form-text">
                                        @error('open_time')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Close Time</label>
                                        <input name="close_time" type="time" class="form-control" id="exampleInputEmail1" aria-describedby="description">
                                        <div id="description" class="form-text">
                                        @error('close_time')
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
                    </div>
                </div>
                <div class="col-12">
                    <div class="">
                        <h2 class="">
                            Day
                        </h2>
                    </div>
                    <div>
                        @if ($Times->isEmpty())
                        <h1>you dont set Time yet</h1>
                        @else
                        <table class="table table-info table-hover" id="table_id">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Day</th>
                                <th scope="col">open time</th>
                                <th scope="col">close time</th>
                                <th scope="col">Delete</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count=1;
                                   
                                @endphp
                                @foreach ($Times as  $kay => $value)
                                <tr>
                                    <th scope="row">{{$count++}}</th>
                                    <td>{{$value->day}}</td>
                                    <td>{{$value->open_time}}</td>
                                    <td>{{$value->close_time}}</td>
                                    <td colspan="" >
                                        
                                        <div>
                                            <form action="{{route('Seller.Restaurant.deleteDay',['Restaurant'=>$Restaurant->id])}}" method="POST" >
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="date_id" value="{{$value->id}}">
                                                <button class="btn btn-danger" type="submit"><i class="bi bi-trash3-fill"></i></button>
                                            </form>
                                        </div>
                                    </td>
            
                                </tr>
                                    
                                @php $count++; @endphp
                                
                                @endforeach
                        </table>
                        {{-- {{ $Time->links() }} --}}
                        @endif
            
                    </div>
            
                </div>
                
            </div>
        </div>
    </div>
    {{-- ------------------------------------------------------------------ --}}

 {{-- ---------------------------Category--------------------------------------- --}}
    <div class="col-12">
        <div class="col">
            <h1>
            add delete download image
            </h1>
        </div>
        <div class="col-12">
          

            
        </div>
    </div>
    {{-- ---------------------------address--------------------------------------- --}}
    <div class="col-12">
        <form action="{{route('Seller.Restaurant.updateAddress',['Restaurant'=>$Restaurant->id])}}" method="post">
            @method('put')
            @csrf
            <div class="row justify-content-center">
                <h1>
                    Address
                </h1>
            <div class="col mb-3 ">
                <label for="exampleInput-address" class="form-label fw-bolder">address</label>
                <input name="address" value="{{old('address',$Address->address)}}" type="text" class="form-control" id="exampleInput-address" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">
                    @error('address') 
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 align-self-center ">
                    <x-mapbox id="mapId"   style="height: 400px; width: 500px;"  :draggable="true"/>
                    <input type="text" value="{{old('lat',$Address->lat)}}" name="lat" hidden>
                    <input type="text" value="{{old('long',$Address->long)}}" name="long" hidden>
            </div>
            <div class="col p-3">
                <button type="submit" class="btn btn-success ">
                    Change map
                </button>
            </div>
            </div>
        </form>
    </div>
    {{-- ------------------------------------------------------------------ --}}
    

</div>

</div>


{{-- <div class="col">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>  --}}
@endsection


@push('script')
<script>
    marker.on('dragend', function(e) {
    // here you can get the coordinates as follows 
    // e.target.getLngLat().lng : to get the longitude
    // e.target.getLngLat().lat : to get the latitude
    document.getElementById('lat').value=e.target.getLngLat().lat
    document.getElementById('long').value=e.target.getLngLat().lng
});   
</script>
@endpush
