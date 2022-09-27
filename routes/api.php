<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController;
use Laravel\Sanctum\Sanctum;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/register', [apiController::class, 'register']);
Route::post('/login', [apiController::class, 'login']);
Route::post('/infouser', [apiController::class, 'userInfo'])->middleware('auth:sanctum');
Route::post('/guardar', [apicontroller::class, 'apiGuardar'])->middleware('auth:sanctum');