<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discounts;
use Illuminate\Http\Request;

class AdminDiscount extends Controller
{

    public function __construct()
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
        // dd('hllo');
        $Discounts=Discounts::query()->paginate(10);
        // dd($Discounts);
       return view('admin.discount',compact('Discounts'));
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
        $request->validate([
            'name'=>'required',
            'discount'=>'required|min:1|max:99|numeric'
        ]);
       $flag= Discounts::create($request->all());

       return ($flag) ?
       back()->with('success_massage','Successful'):
       back()->with('fail_massage','Failed')
       ;

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //TODO front and back show Discount
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
        $request->validate(
            [
                'name'=>'required',
                'discount'=>'required|min:1|max:99|numeric'
            ]
        );
        $flag= Discounts::find($id)->update($request->all());
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
        $flag= Discounts::query()->find($id)->delete();
        return ($flag) ?
        back()->with('success_massage','Successful'):
        back()->with('fail_massage','Failed')
        ;
    }
}
