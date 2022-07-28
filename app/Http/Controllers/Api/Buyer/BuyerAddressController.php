<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BuyerAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::query()->find(auth()->id())->addresses;
        // return auth()->user()->addresses;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated=$request->validate([
            'title'=>'required|string',
            'address'=>'required|string',
            "lat"=>'numeric',
            "long"=>'numeric',
        ]);
        $user=User::query()->find(auth()->id())->addresses();
        // return $user->get();
        if(count($user->get())==0)
        {
            $validated['default']=1;
            return $user->create($validated);
        }
        return $user->create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find(auth()->id())->addresses()->find($id);
    }
    // public function setAddress(Address $address,User $user ,$id)
    public function setAddress(Address $address,User $user ,$id)
    {

        // $this->authorize('update',$address);


            $user->query()->find(auth()->id())->addresses() ->where('default',1)->update(['default'=>0]);

            $a=$user->query()->find(auth()->id())->addresses()->find($id)->update(['default'=>1]);

            //  (new $user)->find($id)->update(['default'=>1]);
            // return response()->json(auth()->id());
            return ['massage'=>response()->json($a)];
        // }
        // return ['you not allow'];

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated=$request->validate([
            'title'=>'required|string',
            'address'=>'required|string',
            "lat"=>'numeric',
            "long"=>'numeric',
        ]);


        $user=User::query()->find(auth()->id())->addresses()->find($id)->update($validated);
        return   ($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::query()->find(auth()->id())->addresses()->find($id)->delete();
        return $user;

    }
}
