<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Comment=Comment::query()->where('request_for_delete',true)->paginate(15);
        return view('Admin.Comment.CommentShow',compact('Comment'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        dd('h');
        $comment=Comment::find($id);
        $comment->request_for_delete=false;
        $comment->save();
       return back();
    }
    public function destroy($id)
    {
        $comment=Comment::find($id);
        $comment->answer()->delete();
        $comment->delete();
        return back();
    }

}
