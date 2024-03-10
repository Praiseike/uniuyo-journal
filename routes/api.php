<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\APIAuthentication;
use App\Http\Controllers\Api\ArticleController;
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
    
        Route::get('/user',function(Request $request){
            return response()->json($request->user());
        });

        Route::post('/logout',[APIAuthentication::class,'logout'])->name('logout.api');


        Route::get('papers/search',[ArticleController::class,'search'])->name('paper.search');
        Route::apiResource('papers',ArticleController::class)
        ->missing(function () {
            return response()->json([
                'status' => 'error',
                'message' => 'The article with the requested ID does not exist.',
            ], 404);
        });
    
    });
    
    Route::group(['middleware'=>'guest'],function(){            
        Route::get('auth/google/redirect', [ APIAuthentication::class,'googleRedirect'])->name('google-auth');
        Route::get('auth/callback',[ APIAuthentication::class,'googleCallback']);

        Route::get('/',function(){
            return ['message' => 'Welcome to University of Uyo Journal API: v1'];
        });
        Route::post('/register',[APIAuthentication::class,'register'])->name('register.api');
        Route::post('/login',[APIAuthentication::class,'login'])->name('login.api');
    });
});

