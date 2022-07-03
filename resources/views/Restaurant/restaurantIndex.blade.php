@extends('layouts.seller')

@section('content')
    
 
<div class="row ">

    <div class="col-12">
        <div class="">
            <h2 class="">
                Lists Restaurant
            </h2>
        </div>
        <div>
            <table class="table table-info table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">phone</th>
                    <th scope="col">account</th>
                    <th scope="col">Funcrion</th>                   
                </tr>
                </thead>
                <tbody>
                    @php
                        $count=1;
                    @endphp
                    @foreach ($Restaurants as  $kay => $Restaurant)
                    <tr>
                        <th scope="row">{{($Restaurants->currentpage()-1) * $Restaurants->perpage() + $kay + 1}}</th>
                        <td>{{$Restaurant->name}}</td>
                        <td>{{$Restaurant->phone}}</td>
                        <td>{{$Restaurant->account}}</td>
                        <td>
                            <div class="btn-group bg-primary" role="group" aria-label="Basic example">
                              <form action="{{route('Seller.Restaurant.edit',$Restaurant)}}" method="GET" >
                                 @csrf
                                <button type="submit" class="btn btn-info">edit</button>
                                </form> 
                              <form action="{{route('Seller.Restaurant.destroy',$Restaurant)}}" method="POST">
                                 @csrf
                                 @method('delete')
                                <button type="submit" class="btn btn-danger">delete</button>
                                </form> 
                              <form action="{{route('Seller.Restaurant.show',$Restaurant)}}" method="GET">
                                 @csrf
                                <button type="submit" class="btn btn-primary">see</button>
                                </form> 
                            </div>
                        </td>
                       

                    </tr>
                    
                        </div>
                        </div>
                    </div>






                        
                    @php $count++; @endphp
                    
                        
                     
                    @endforeach
            </table>
            {{ $Restaurants->links() }}
           

        </div>

    </div>
</div>
   


@endsection