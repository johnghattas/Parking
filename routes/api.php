<?php

use App\Http\Middleware\IsOwner;
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

Route::group([

      'middleware' => 'api',
      'prefix' => 'auth'

  ], function () {

      Route::post('login', [App\Http\Controllers\AuthController::class,'login']);
      Route::post('logout', [App\Http\Controllers\AuthController::class,'logout']);
      Route::post('refresh',[App\Http\Controllers\AuthController::class,'refresh']);
      Route::post('me', [App\Http\Controllers\AuthController::class,'me']);

  });

Route::post('register', [App\Http\Controllers\RegisterController::class,'register']);


Route::group(['middleware' => ['owner']], function () {
    Route::resource('garages',(App\Http\Controllers\GarageController::class));
});
