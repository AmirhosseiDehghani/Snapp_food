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
                    @foreach ($Restaurants as  $kay => $Resruarant)
                    <tr>
                        <th scope="row">{{($Restaurants->currentpage()-1) * $Restaurants->perpage() + $kay + 1}}</th>
                        <td>{{$Resruarant->name}}</td>
                        <td>{{$Resruarant->phone}}</td>
                        <td>{{$Resruarant->account}}</td>
                        <td>
                            <div class="btn-group bg-primary" role="group" aria-label="Basic example">
                              <form action="{{route('Seller.Restaurant.edit',$Resruarant)}}" method="GET" >
                                 @csrf
                                <button type="button" class="btn btn-info">edit</button>
                                </form> 
                              <form action="{{route('Seller.Restaurant.delete',$Resruarant)}}" method="POST">
                                 @csrf
                                <button type="button" class="btn btn-danger">delete</button>
                                </form> 
                              <form action="{{route('Seller.Restaurant.show')}}" method="get">
                                 @csrf
                                <button type="button" class="btn btn-primary">see</button>
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