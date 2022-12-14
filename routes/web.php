<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;
use App\Http\Controllers\SomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/asdf', function(){
    return __DIR__;
});

Route::get('/', function () {
    return "<h1>Hello World!</h1>";
});

Route::get('/login', [apiController::class, 'webLogin']);
Route::post('/login', [apiController::class, 'webAuth']);

Route::get('/create', [apiController::class, 'create']);
Route::post('/store', [apiController::class, 'store']);
//Route::post('/register', [apiController::class, 'register']);
