<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\posts;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\imageTrait;
class PostController extends Controller
{
    use ApiResponseTrait;
    use imageTrait;

    public function index(){
        $posts = posts::get();
        return $this->apiResponse($posts,'ok',200);
    }

    public function show($id){

        $post = Posts::find($id);

        if($post){
            return $this->apiResponse( $post,'ok',200);
        }
        return $this->apiResponse(null,'The post Not Found',404);

    }
    // public static function img(Request $request){

        // }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
            //'photo' => 'required',
            // 'user_id' => 'required',
        ]);


        // $user_id=auth()->user()->id;

        // $data['user_id']=$user_id;

            //save photo in folder


        $file_name = $this->saveImage($request->photo, 'images/photo');
            // getImagis();
        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),400);
        }
        $user_id=auth()->user()->id;
        $post = Posts::create([

            'title'=>$request->title,
            'body'=>$request->body,
            'photo'=>$file_name,
            'user_id'=>$user_id,
        ]);
        if($post){
            return $this->apiResponse($post,'The post Save',201);
        }

        return $this->apiResponse(null,'The post Not Save',400);
    }


    public function update(Request $request ,$id){


        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
            'photo' => 'required',
            'user_id' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $post=Posts::find($id);

        if(!$post){
            return $this->apiResponse(null,'The post Not Found',404);
        }

        $file_name = $this->saveImage($request->photo, 'images/photo');
        $post->update([
        'title'=>$request->title,
        'body'=>$request->body,
        'photo'=>$file_name,
        'user_id'=>$request->user_id,]);

        if($post){
            return $this->apiResponse($post,'The post update',201);
        }

    }


    public function destroy($id){

        $post=Posts::find($id);

        if(!$post){
            return $this->apiResponse(null,'The post Not Found',404);
        }

        $post->delete($id);

        if($post){
            return $this->apiResponse(null,'The post deleted',200);
        }

    }
}
