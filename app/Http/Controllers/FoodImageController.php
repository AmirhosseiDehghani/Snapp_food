<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodImageController extends Controller
{
    public function store(Request $request,Food $Food)
    {
       $image_path= Storage::put('images', $request->validated()['image']);

        $Food->images()->create(['image_path'=>$image_path]);
        return back()->with('success','successful');

    }
    public function destroy(Images $Images)
    {
        $Images->delete();
    }
}
