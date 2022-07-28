<?php

namespace App\Http\Controllers\Api\Comment;

use App\Classes\CommentHandler;
use App\Classes\Helper\RestaurantScore;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentGetRequest;
use App\Http\Requests\CommentStoreRequest;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index(CommentGetRequest $request)
    {
        // var_dump(new RestaurantScore);
        $Comment=new CommentHandler;
        return $Comment->getComment($request->validated()) ;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function store(CommentStoreRequest $request)
    {
        // return$request->all();
        $Comment=new CommentHandler;
        return $Comment->postComment($request->validated());
    }


}
