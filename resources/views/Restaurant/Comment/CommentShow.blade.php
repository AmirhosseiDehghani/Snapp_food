@extends('layouts.seller')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="">
            <x-navbar-show-restaurant-component>
                <x-slot:href>
                   {{route('Seller.Restaurant.show',['Restaurant'=>$Restaurant->id])}}
                </x-slot>
               Restaurant:{{$Restaurant->name}}
            </x-navbar-show-restaurant-component>
        </div>
    </div>
    <div>



    <div class="col-12">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">massage</th>
                <th scope="col">reply</th>
                <th scope="col">Function</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($Comment as $kay=> $item)
                <tr>
                    <th scope="row">{{($Comment->currentpage()-1) * $Comment->perpage() + $kay + 1}}</th>
                    <td>{{$item->user->name}}</td>
                    <td><p>{{$item->body}}</p></td>
                    <td>
                        <div>
                            @if ($item->request_for_delete)

                                <button class="brn text-success" >Delete:Pending</button>
                             @else
                             <form action="{{ route('Seller.Restaurant.comment.replay', ['comment'=>$item->id,'Restaurant'=>$Restaurant->id]) }}" method="post">
                                <div class="d-flex flex-row justify-content-center align-items-center w-100">
                                    <div class="d-flex flex-row justify-content-center  align-items-center w-100">
                                        @csrf
                                    <x-input-component>
                                        <x-slot:label></x-slot:label>
                                        <x-slot:name>body</x-slot:name>
                                        <x-slot:class>w-75</x-slot:class>
                                        <x-slot:value>{{$item->answer?->body??''}}</x-slot:value>
                                    </x-input-component>
                                    <div class="w-25">
                                        <button type="submit" class="btn btn-success btn-sm">replay</button>
                                    </div>
                                </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div>

                            <div class="btn-group d-flex flex-row justify-content-center align-items-center"  role="group" aria-label="Basic example">
                               @if (!$item->read)
                                <form method="POST" action="{{ route('Seller.Restaurant.comment.update', ['comment'=>$item->id,'Restaurant'=>$Restaurant->id]) }}">
                                    @method('put')
                                    @csrf
                                <button type="submit"  class="btn btn-primary btn-sm">Accept</button>
                                </form>
                                @endif
                                @if ($item->request_for_delete)
                                        <button class="brn text-success" >Delete:Pending</button>

                                    @else
                                    <form method="POST" action="{{ route('Seller.Restaurant.comment.delete', ['comment'=>$item->id,'Restaurant'=>$Restaurant->id]) }}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit"  class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>


    </div>


</div>


@endsection
