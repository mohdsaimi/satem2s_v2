<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Log_indeviceController;
use App\Models\Log_ins;

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

/* Route::post("/","Log_inController@insert"); */
Route::post("add", [Log_indeviceController::class, 'add']);
Route::post("add_vip", [Log_indeviceController::class, 'add_vip']);
Route::post("add_inout", [Log_indeviceController::class, 'add_inout']);
