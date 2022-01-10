<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
/*
 *
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

Route::post('/register', [RegisterController::class,'store']) -> name('register')->middleware('guest');
Route::post('/login', [LoginController::class,'store']) -> name('login')->middleware('guest');

Route::post('/new_session', [\App\Http\Controllers\SessionsController::class,'store']) -> name('new_session');
Route::get('/sessions',[\App\Http\Controllers\SessionsController::class,'view']);
Route::get('/list_session', [\App\Http\Controllers\SessionsController::class,'turfSessions']) -> name('list_session')
    ->middleware('auth');
