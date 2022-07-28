@extends('layouts.admin')

@section('content')

<div class="row">


    <div class="col-12">
        <h1>Request for delete</h1>
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
                            {{$item->answer?->body??'NO Reply'}}
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="{{ route('Admin.delete-request-comment.destroy', ['delete_request_comment'=>$item->id]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <form action="{{ route('Admin.delete-request-comment.update', ['delete_request_comment'=>$item->id]) }}" method="post">
                                    @method('put')
                                    @csrf
                                    <button type="submit" class="btn btn-info">It will not be deleted</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{$Comment->links()}}


    </div>


</div>


@endsection
