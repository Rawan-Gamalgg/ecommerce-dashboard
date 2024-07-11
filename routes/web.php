<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'dashboard','middleware'=>'auth'], function () {
    Route::get('/', [DashboardController::class,'index']);
    Route::group(['prefix' => 'products','as'=>'products.'], function () {

        Route::get('/',[ProductController::class,'index'])->name('index');
        Route::get('/create',[ProductController::class,'create'])->name('create');
        Route::post('/store',[ProductController::class,'store'])->name('store');
        Route::get('/edit/{id}',[ProductController::class,'edit'])->name('edit');
        Route::put('/update/{id}',[ProductController::class,'update'])->name('update');
        Route::delete('/destroy/{id}',[ProductController::class,'destroy'])->name('destroy');

    });

    Route::group(['prefix' => 'users','as'=>'users.'], function () {
        Route::get('/',[UserController::class,'index'])->name('index');
        Route::get('/create',[UserController::class,'create'])->name('create');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('edit');
        Route::get('/destroy/{id}',[UserController::class,'destroy'])->name('destroy');
    });
});
// Auth::routes(['verify'=>'true']);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
