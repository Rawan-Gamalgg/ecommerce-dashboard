<?php

use App\Http\Controllers\Apis\Auth\RegisterController;
use App\Http\Controllers\Apis\ProductController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'products'],function(){
Route::get('/',[ProductController::class,'index']);
Route::get('create',[ProductController::class,'create']);
Route::post('store',[ProductController::class,'store']);
Route::get('edit/{id}',[ProductController::class,'edit']);
Route::post('update/{id}',[ProductController::class,'update']);
Route::post('delete/{id}',[ProductController::class,'destroy']);


});

Route::group(['prefix'=>'users'],function(){

    Route::post('register',RegisterController::class);
});


//read about localization
//read about authentication token

