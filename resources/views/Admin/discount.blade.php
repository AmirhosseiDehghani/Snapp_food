@extends('layouts.admin')

@section('content')

<div class="row ">
    <div class="col">
        <div class="">
            <form action="{{route('Admin.Discount.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col mb-3 ">
                     
                        <label for="basic-url" class="form-label">Discount Price</label>
                        <div class="input-group mb-3">
                            <input type="text" name="discount" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                            <span class="input-group-text" id="basic-addon3">%</span>
                        </div>
                        <div id="description" class="form-text">
                            @error('discount')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </div>
                    </div>
                    <div class="col mb-3">
                        <label for="exampleInputEmail1" class="form-label">Discount Name</label>
                        <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="description">
                        <div id="description" class="form-text">
                        @error('name')
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
    <div class="col-12">
        <div class="">
            <h2 class="">
                Lists
            </h2>
        </div>
        <div>
            <table class="table table-info table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">How many</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Edit</th>
                    <th scope="col">See</th>
                   
                </tr>
                </thead>
                <tbody>
                    @php
                        $count=1;
                    @endphp
                    @foreach ($Discounts as  $kay => $Discount)
                    <tr>
                        <th scope="row">{{($Discounts->currentpage()-1) * $Discounts->perpage() + $kay + 1}}</th>
                        <td>{{$Discount->name}}</td>
                        <td>{{$Discount->discount*100}}%</td>
                        <td>@mdo</td>
                        <td colspan="" >
                            
                            <div>
                                <form action="{{route('Admin.Discount.destroy',$Discount)}}" method="POST" >
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit"><i class="bi bi-trash3-fill"></i></button>
                                </form>
                            </div>
                            
                        </td>
                        <td>
                            <div>
                                {{-- Modal Buttem --}}
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$count}}">
                                    <i class="bi bi-tools"></i>
                                </button>
                            </div>
                        </td>
                        <td>
                            <div>
                                {{-- //TODO: make infomaitoin for category show --}}
                                <form action="" method="">
                                    @csrf
                                   
                                    <input  name="id" type="hidden" value="{{$Discount->id}}">
                                    <button type="button" class="btn btn-muted">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    {{-- Modal --}}

                    <div class="modal fade" id="staticBackdrop_{{$count }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">
                               
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="post" action='{{route('Admin.Discount.update',$Discount)}}'>
                                @csrf
                                @method('put')
                            <div class="modal-body">
                                    <input  type="hidden" name="Category_id" value="{{{$Discount->id}}}" >
                                    <div class="d-flex justify-content-around" >
                                        <div class="">
                                            <label for="exampleInputEmail1a" class="form-label">Category Name</label>
                                            <input name="name" value="{{$Discount->name}}" type="text" class="form-control" id="exampleInputEmail1a" aria-describedby="categoryName">
                                        </div>
                                        <div>
                                            <label for="exampleInputEmail1a" class="form-label">Category Description</label>
                                            <input name="description" value="{{$Discount->description}}" type="text" class="form-control" id="exampleInputEmail1a" aria-describedby="description">
                                        </div>
                                      
                                        
                                       
                                    </div>
                                   
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle-fill"></i>
                                    </button>
                                    <button class="btn btn-success" type="submit">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>






                        
                    @php $count++; @endphp
                    
                        
                     
                    @endforeach
            </table>
            {{ $Discounts->links() }}
           

        </div>

    </div>
</div>


    
@endsection