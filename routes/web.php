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

Route::get('/valores/fecha1={fecha1}&fecha2={fecha2}', function($fecha1, $fecha2){
    return "Hola, estos son los valores " . $fecha1 . "; " . $fecha2;
});

Route::get('/generos', [apiController::class, 'generos']);

Route::get('/create', [apiController::class, 'create']);
Route::post('/store', [apiController::class, 'store']);
Route::resource('/some', SomeController::class);
//Route::post('/register', [apiController::class, 'register']);
