<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\APIAuthentication;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix'=>'v1'],function(){

    Route::group(['middleware'=>'auth:api'],function(){
        Route::get('/',function(){
            return ['message' => 'Welcome to University of Uyo Journal API: v1'];
        });
    
        Route::get('/user',function(Request $request){
            return response()->json($request->user());
        });
    
        Route::post('/logout',[APIAuthentication::class,'logout'])->name('logout.api');
    });
    
    Route::group(['middleware'=>'guest'],function(){
        Route::post('/register',[APIAuthentication::class,'register'])->name('register.api');
        Route::post('/login',[APIAuthentication::class,'login'])->name('login.api');
    });
});

