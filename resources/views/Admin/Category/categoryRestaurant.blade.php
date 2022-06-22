@extends('layouts.admin')

@section('content')
    
<div class="row ">
    <div class="col">
        <div class="">
            <form action="">
                <div class="row">
                    <div class="col mb-3">
                        <label for="exampleInputEmail1" class="form-label">Category Name</label>
                        <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="categoryName">
                        <div id="categoryName" class="form-text">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col mb-3">
                        <label for="exampleInputEmail1" class="form-label">Category Description</label>
                        <input name="description" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="description">
                        <div id="description" class="form-text">
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>
                    <div class="col mb-3 mt-3" >
                        <button type="submit" class="btn btn-info mt-3"> Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12">

        <div>
            <table class="table table-info table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                
            </table>
        </div>

    </div>
</div>



@endsection