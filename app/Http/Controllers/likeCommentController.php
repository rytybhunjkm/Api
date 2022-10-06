<?php

namespace App\Http\Controllers;

use App\likeComment;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponseTrait;

class likeCommentController extends Controller
{
    use ApiResponseTrait;
    public function create(Request $request)
    {
         $like=1;
        $user_id=auth()->user()->id;
        $get_like      = likeComment::where('like',1)
        ->where('user_id',$user_id)
        ->first();
        if(!$get_like){

        $like_comment = likeComment::create([
            'user_id'     =>$user_id,
            'post_id'     =>$request->post_id,
            'comment_id'  =>$request->comment_id,
            'like'        =>$like,
        ]);

        if($like_comment){
            return $this->apiResponse($like_comment,'The like Save',201);
        }

    }elseif($get_like->like==1){
        likeComment::where('like',1)
        ->where('user_id',$user_id)
        ->delete();
    }


        return $this->apiResponse(null,'The like Not Save',400);
    }

    public function getCountLike(){
     $get_like      = likeComment::where('like',1)->get();
     $getcuont      =$get_like->count();
     return $this->apiResponse($getcuont,'ok',200);

    }

}
