<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\likeCommentController;
use App\Http\Controllers\likePostController;
use App\Http\Controllers\likeReplyController;
use App\reply;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    // Route::post('/logout', [AuthController::class, 'logout']);
    // Route::post('/refresh', [AuthController::class, 'refresh']);
     Route::get('/user-profile', [AuthController::class, 'userProfile']);
  Route::resource('/posts', PostController::class);
  Route::resource('/comments', CommentController::class);
  Route::post('/create_like', [likePostController::class, 'create']);
  Route::get('/get_count', [likePostController::class, 'getCountLike']);
  Route::post('/create_like_comment', [likeCommentController::class, 'create']);
  Route::get('/get_count_like_comment', [likeCommentController::class, 'getCountLike']);
  Route::resource('/reply', ReplyController::class);
  Route::post('/create_like_reply', [likeReplyController::class, 'create']);
  Route::get('/get_count_like_reply', [likeReplyController::class, 'getCountLike']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();

// }
// );



