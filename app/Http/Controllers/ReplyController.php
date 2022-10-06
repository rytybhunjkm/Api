<?php

namespace App\Http\Controllers;

use App\reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiResponseTrait;
class ReplyController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reply=reply::all();
        return $this->apiResponse($reply,'ok',200);
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
        $reply = reply::create([
            'body'=>$request->body,
            'comment_id'=>$request->comment_id,
            'user_id'=>$user_id,
        ]);

        if($reply){
            return $this->apiResponse($reply,'The reply Save',201);
        }

        return $this->apiResponse(null,'The reply Not Save',400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reply  $reply
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

        $reply=reply::find($id);

        if(!$reply){
            return $this->apiResponse(null,'The reply Not Found',404);
        }

        $reply->update([

        'body'=>$request->body,
        ]);

        if($reply){
            return $this->apiResponse($reply,'The reply update',201);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        $reply=reply::find($id);

        if(!$reply){
            return $this->apiResponse(null,'The reply Not Found',404);
        }

        $reply->delete($id);

        if($reply){
            return $this->apiResponse(null,'The reply deleted',200);
        }

    }
}
