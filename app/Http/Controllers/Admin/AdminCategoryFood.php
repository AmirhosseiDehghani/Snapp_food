<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminCategoryFood extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categories=Category::where('type','food')->paginate(10);        ;
        return view('Admin.Category.categoryFood',compact('Categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);
        $create=Arr::add($request->all(),'type','food');
        Category::create($create);
        return back()->with('success_massage','successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

 


}
