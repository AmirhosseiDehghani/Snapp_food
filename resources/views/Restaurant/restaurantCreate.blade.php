@extends('layouts.seller')


@section('content')

<div class="row  ">
    <div class="col-12">
        <div class="p-5">
            <h1>Add Resturant</h1>
        </div>
    </div>
    <div class="col ">
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
                        <input name="image" class="form-control" type="file" id="formFile">
                    </div>
                        @error('image') 
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
               
                <div class="col"  >
                    <x-mapbox id="mapId"  style="height: 500px; width: 500px;"  :draggable="true"/>
                </div>
                               
                
                <input id="lat" type="hidden" name="lat" value="">
                <input id="long" type="hidden" name="long" value="">

                <div class="col p-3">
                    <button  type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
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
        </div> --}}

    </div>
</div>
    
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