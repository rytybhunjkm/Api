<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\likePost;
use App\Http\Controllers\ApiResponseTrait;

class likePostController extends Controller
{
    use ApiResponseTrait;
    public function create(Request $request)
    {
         $like=1;
        $user_id=auth()->user()->id;
        $get_like      = likePost::where('like',1)
        ->where('user_id',$user_id)
        ->first();
        if(!$get_like){

        $like_post = likePost::create([
            'user_id'  =>$user_id,
            'post_id'  =>$request->post_id,
            'like'     =>$like,
        ]);

        if($like_post){
            return $this->apiResponse($like_post,'The like Save',201);
        }

    }elseif($get_like->like==1){
        likePost::where('like',1)
        ->where('user_id',$user_id)
        ->delete();
    }


        return $this->apiResponse(null,'The like Not Save',400);
    }

    public function getCountLike(){
     $get_like      = likePost::where('like',1)->get();
     $getcuont      =$get_like->count();
     return $this->apiResponse($getcuont,'ok',200);

    }

}
