<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/post')->group(function(){
    Route::post('/get-post-data', 'PostController@getPostData');
    Route::get('/get-posts', 'PostController@getPosts');
    Route::post('/create-post', 'PostController@createPost');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
