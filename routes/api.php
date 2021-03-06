<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('register','AuthController@register');//注册
Route::post('login','AuthController@login');//登录


Route::get('look_list','ThirdController@lookList');//查看空气质量
Route::post('suggestion','ThirdController@suggestion');//填写建议

