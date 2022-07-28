<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Restaurant;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function index(Request $request,Restaurant $Restaurant)
    {
        $this->authorize('view',$Restaurant);
        $Comment=$Restaurant->comments()->with('user')->orderBy('created_at','desc')->paginate(10);
        // dd($Comment->toArray());

        return view('Restaurant.Comment.CommentShow',compact('Comment','Restaurant'));
    }
    public function store(Request $request,Restaurant $Restaurant ,Comment $comment)
    {
        $request->validate([
            'body'=>'required'
        ]);

        if($comment->answer()->exists())
        {
            $reply= $comment->answer;
            $reply->body=$request->get('body');
            $reply->save();
        }else
        {
            $reply = new Comment();
            $reply->body = $request->get('body');
            $reply->user_id=$Restaurant->users->first()->id;
            $reply->parent_id = $comment->id;
            $reply->read = true;

            $comment->read=true;
            $comment->comments()->save($reply);
        }

        return back();
    }
    public function update(Restaurant $Restaurant ,Comment $comment)
    {
        $comment->read= true ;
        $comment->save();
        return back();
    }
    public function destroy(Restaurant $Restaurant ,Comment $comment)
    {
        // dd(55);
        $comment->request_for_delete= true ;
        $comment->save();
        return back();

    }

}
