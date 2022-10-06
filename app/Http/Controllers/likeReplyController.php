<?php

namespace App\Http\Controllers;

use App\likeReply;
use Illuminate\Http\Request;

class likeReplyController extends Controller
{
    use ApiResponseTrait;
    public function create(Request $request)
    {
         $like=1;
        $user_id=auth()->user()->id;
        $get_like      = likeReply::where('like',1)
        ->where('user_id',$user_id)
        ->first();
        if(!$get_like){

        $like_reply = likeReply::create([
            'user_id'     =>$user_id,
            'reply_id'  =>$request->reply_id,
            'like'        =>$like,
        ]);

        if($like_reply){
            return $this->apiResponse($like_reply,'The like Save',201);
        }

    }elseif($get_like->like==1){
        likeReply::where('like',1)
        ->where('user_id',$user_id)
        ->delete();
    }


        return $this->apiResponse(null,'The like Not Save',400);
    }

    public function getCountLike(){
     $get_like      = likeReply::where('like',1)->get();
     $getcuont      =$get_like->count();
     return $this->apiResponse($getcuont,'ok',200);

    }

}
