<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

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
Route::get("data",[APIController::class,'getData']);
Route::post("add",[APIController::class,'add']);
Route::put("update",[APIController::class,'update']);
Route::delete("delete/{id}",[APIController::class,'delete']);
//Route::post("upload",[APIController::class,'upload']);
