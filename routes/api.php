<?php

use App\Http\Controllers\Api\LaboratorioController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(LaboratorioController::class)->group(function(){
    Route::get('/laboratorios','index');
    Route::post('/laboratorio','store');
    Route::post('/laboratorio/bulk','bulkStore');
    Route::get('/laboratorio/{id}','show');
    Route::put('/laboratorio/{id}','update');
    Route::delete('/laboratorio/{id}','destroy');
});