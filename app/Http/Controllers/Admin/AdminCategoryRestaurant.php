<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminCategoryRestaurant extends Controller
{

    function __construct()
    {
        $this->middleware('isAdmin');
    }
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Categories=Category::where('type','restaurant')->paginate(10);        ;
        return view('Admin.Category.categoryRestaurant',compact('Categories'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(['name'=>'required']);
        $create=Arr::add($request->all(),'type','restaurant');
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['name'=>'required']);
        $flag=Category::query()->find($id)->update($request->all());


        return ($flag) ?
            back()->with('success_massage','Successful'):
            back()->with('fail_massage','Failed')

        ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flag=Category::query()->find($id)->delete();
        
        return ($flag) ?
            back()->with('success_massage','Successful'):
            back()->with('fail_massage','Failed')
        ;

    ;
    }
}
