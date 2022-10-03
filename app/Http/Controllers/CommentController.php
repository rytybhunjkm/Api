<?php

namespace App\Http\Controllers;

use App\comment;
use App\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiResponseTrait;
class CommentController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments=comment::find(1);
       $user_id=$comments->user;
       $post_id=$comments->post;
       return $this->apiResponse($post_id,'ok',200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',

        ]);


        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $user_id=auth()->user()->id;
        $comment = comment::create([
            'body'=>$request->body,
            'post_id'=>$request->post_id,
            'user_id'=>$user_id,
        ]);

        if($comment){
            return $this->apiResponse($comment,'The comment Save',201);
        }

        return $this->apiResponse(null,'The comment Not Save',400);
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id)
    {

        $validator = Validator::make($request->all(), [
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $comment=comment::find($id);

        if(!$comment){
            return $this->apiResponse(null,'The comment Not Found',404);
        }

        $comment->update([

        'body'=>$request->body,
        ]);

        if($comment){
            return $this->apiResponse($comment,'The post update',201);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $comment=comment::find($id);

        if(!$comment){
            return $this->apiResponse(null,'The comment Not Found',404);
        }

        $comment->delete($id);

        if($comment){
            return $this->apiResponse(null,'The comment deleted',200);
        }

    }
}
