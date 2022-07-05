<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileUpdateRequest;
use App\Models\User;
use App\Rules\IranPhoneNumberRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BuyerController extends Controller
{
   
    // public function update(UserProfileUpdateRequest $request, User $user)
    public function update(Request $request, User $user)
    {
        // dd(request()->all());
      
        $validated=$request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>['required', new IranPhoneNumberRule ],
            'password'=>'required'
        ]);
        if(Hash::check($request->get('password'),auth()->user()->getAuthPassword()))
        $status=$user->find(auth()->id())->update($validated);
        return[
            "status"=>$status,
            // ''
        ];
    }

    public function destroy($id)
    {
        //
    }
}
