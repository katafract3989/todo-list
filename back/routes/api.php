<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['namespace' => 'API'], function(){

    Route::apiResource('/test', TestController::class);
    Route::post('/create', [\App\Http\Controllers\API\TestController::class, 'create']);
    Route::get('/listing', [\App\Http\Controllers\API\TestController::class, 'listing']);
    Route::post('/update', [\App\Http\Controllers\API\TestController::class, 'update']);
    Route::post('/delete', [\App\Http\Controllers\API\TestController::class, 'delete']);
    Route::post('/status', [\App\Http\Controllers\API\TestController::class, 'status']);

});

