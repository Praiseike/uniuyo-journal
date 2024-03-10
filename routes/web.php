<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/run-migrations',function (){
    \Artisan::call('migrate');
    return "migrated successfully";
});


Route::get('/seed-database',function (){
    \Artisan::call('db:seed');
    return "seeded successfully";

});

Route::get('/install-passport',function (){
    \Artisan::call('artisan passport:install --force');
    return "installed successfully";

});


Route::get('/run-migrations-fresh',function (){
    \Artisan::call('migrate:fresh --seed');
    return "migrated successfully";
});

Route::get('/clear-cache',function(){
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('view:clear');
    return "cleared cache successfully";
});